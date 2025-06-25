<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Notification;
use App\Models\Invigilator;
use App\Models\SurveillanceTimetable;
use App\Services\TelegramService;
use Carbon\Carbon;

class NotificationController extends Controller
{
    protected $telegramService;

    public function __construct(TelegramService $telegramService)
    {
        $this->telegramService = $telegramService;
    }

    /**
     * Show notification management page
     */
    public function index()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $notifications = Notification::with('invigilator')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        $invigilators = Invigilator::orderBy('userName')->get();

        return view('admin.notifications', compact('notifications', 'invigilators'));
    }

    /**
     * Show manual notification form
     */
    public function showManualForm(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $faculties = [
            'FAKULTI SAINS GUNAAN',
            'FAKULTI SAINS KOMPUTER & MATEMATIK',
            'FAKULTI PENGURUSAN & PERNIAGAAN',
            'FAKULTI PERAKAUNAN',
            'FAKULTI SAINS SUKAN & REKREASI',
            'FAKULTI PERTANIAN & AGROTEKNOLOGI',
            'KOLEJ ALAM BINA',
            'BAHAGIAN HAL EHWAL AKADEMIK'
        ];
        $positions = ['PENSYARAH KANAN', 'PENSYARAH', 'PENSYARAH (SEPARUH MASA)', 'STAF'];

        $invigilators = Invigilator::query()
            ->when($request->filterUserID, fn($q) => $q->where('userID', 'like', "%{$request->filterUserID}%"))
            ->when($request->filterUserName, fn($q) => $q->where('userName', 'like', "%{$request->filterUserName}%"))
            ->when($request->filterFaculty, fn($q) => $q->where('faculty', $request->filterFaculty))
            ->when($request->filterPosition, fn($q) => $q->where('position', $request->filterPosition))
            ->orderBy('userName')
            ->get();

        return view('admin.notifications.manual', compact('invigilators', 'faculties', 'positions'));
    }

    /**
     * Send manual notification to specific invigilator
     */
    public function sendManual(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $request->validate([
            'userID' => 'required|exists:invigilators,userID',
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $invigilator = Invigilator::where('userID', $request->userID)->first();

        if (!$invigilator->chat_id) {
            return back()->withErrors(['userID' => 'This invigilator does not have a Telegram chat ID. Please ask them to start a chat with the bot.']);
        }

        // Replace template variables
        $title = $this->replaceTemplateVariables($request->title, $invigilator);
        $message = $this->replaceTemplateVariables($request->message, $invigilator);

        // Create notification record
        $notification = Notification::create([
            'userID' => $invigilator->userID,
            'userName' => $invigilator->userName,
            'chat_id' => $invigilator->chat_id,
            'contact' => $invigilator->contact,
            'title' => $title,
            'message' => $message,
            'type' => 'manual',
            'status' => 'pending',
        ]);

        // Send Telegram message
        $result = $this->telegramService->sendMessage(
            $invigilator->chat_id,
            $title,
            $message
        );

        // Update notification status
        if ($result['success']) {
            $notification->update([
                'status' => 'sent',
                'sent_at' => now(),
            ]);
            return redirect()->route('admin.notifications')->with('success', 'Notification sent successfully!');
        } else {
            $notification->update([
                'status' => 'failed',
                'error_message' => $result['error'],
            ]);
            return back()->withErrors(['message' => 'Failed to send notification: ' . $result['error']]);
        }
    }

    /**
     * Show bulk notification form
     */
    public function showBulkForm(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $faculties = [
            'FAKULTI SAINS GUNAAN',
            'FAKULTI SAINS KOMPUTER & MATEMATIK',
            'FAKULTI PENGURUSAN & PERNIAGAAN',
            'FAKULTI PERAKAUNAN',
            'FAKULTI SAINS SUKAN & REKREASI',
            'FAKULTI PERTANIAN & AGROTEKNOLOGI',
            'KOLEJ ALAM BINA',
            'BAHAGIAN HAL EHWAL AKADEMIK'
        ];
        $positions = ['PENSYARAH KANAN', 'PENSYARAH', 'PENSYARAH (SEPARUH MASA)', 'STAF'];

        $invigilators = Invigilator::query()
            ->when($request->filterUserID, fn($q) => $q->where('userID', 'like', "%{$request->filterUserID}%"))
            ->when($request->filterUserName, fn($q) => $q->where('userName', 'like', "%{$request->filterUserName}%"))
            ->when($request->filterFaculty, fn($q) => $q->where('faculty', $request->filterFaculty))
            ->when($request->filterPosition, fn($q) => $q->where('position', $request->filterPosition))
            ->orderBy('userName')
            ->get();

        return view('admin.notifications.bulk', compact('invigilators', 'faculties', 'positions'));
    }

    /**
     * Send bulk notification to multiple invigilators
     */
    public function sendBulk(Request $request)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $request->validate([
            'userIDs' => 'required|array|min:1',
            'userIDs.*' => 'exists:invigilators,userID',
            'title' => 'required|string|max:255',
            'message' => 'required|string|max:1000',
        ]);

        $invigilators = Invigilator::whereIn('userID', $request->userIDs)->get();
        $successCount = 0;
        $failedCount = 0;

        foreach ($invigilators as $invigilator) {
            if (!$invigilator->chat_id) {
                $failedCount++;
                continue;
            }

            // Replace template variables for each invigilator
            $title = $this->replaceTemplateVariables($request->title, $invigilator);
            $message = $this->replaceTemplateVariables($request->message, $invigilator);

            // Create notification record
            $notification = Notification::create([
                'userID' => $invigilator->userID,
                'userName' => $invigilator->userName,
                'chat_id' => $invigilator->chat_id,
                'contact' => $invigilator->contact,
                'title' => $title,
                'message' => $message,
                'type' => 'bulk',
                'status' => 'pending',
            ]);

            // Send Telegram message
            $result = $this->telegramService->sendMessage(
                $invigilator->chat_id,
                $title,
                $message
            );

            // Update notification status
            if ($result['success']) {
                $notification->update([
                    'status' => 'sent',
                    'sent_at' => now(),
                ]);
                $successCount++;
            } else {
                $notification->update([
                    'status' => 'failed',
                    'error_message' => $result['error'],
                ]);
                $failedCount++;
            }
        }

        $message = "Bulk notification completed. {$successCount} sent successfully, {$failedCount} failed.";
        return redirect()->route('admin.notifications')->with('success', $message);
    }

    /**
     * Replace template variables with actual invigilator data
     */
    protected function replaceTemplateVariables($template, $invigilator)
    {
        $variables = [
            '{invigilator_name}' => $invigilator->userName,
            '{invigilator_id}' => $invigilator->userID,
            '{position}' => $invigilator->position ?? 'Not specified',
            '{faculty}' => $invigilator->faculty ?? 'Not specified',
            '{contact}' => $invigilator->contact ?? 'Not provided',
            '{chat_id}' => $invigilator->chat_id ?? 'Not provided',
            '{created_at}' => $invigilator->created_at ? $invigilator->created_at->format('d/m/Y H:i') : '-',
            '{updated_at}' => $invigilator->updated_at ? $invigilator->updated_at->format('d/m/Y H:i') : '-',
            '{current_date}' => Carbon::now()->format('d/m/Y'),
            '{current_day}' => Carbon::now()->format('l'),
            '{current_time}' => Carbon::now()->format('g:i A'),
            '{current_year}' => Carbon::now()->format('Y'),
            '{current_month}' => Carbon::now()->format('F'),
            '{current_datetime}' => Carbon::now()->format('d/m/Y H:i'),
        ];

        return str_replace(array_keys($variables), array_values($variables), $template);
    }

    /**
     * Test Telegram connection
     */
    public function testConnection()
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $isConnected = $this->telegramService->testConnection();
        $botInfo = $this->telegramService->getBotInfo();

        if ($isConnected && $botInfo) {
            return back()->with('success', "Telegram connection test successful! Bot: @{$botInfo['username']}");
        } else {
            return back()->withErrors(['connection' => 'Telegram connection test failed. Please check your bot token.']);
        }
    }

    /**
     * Delete a notification by ID
     */
    public function destroy($id)
    {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        $notification = Notification::find($id);
        if (!$notification) {
            return back()->withErrors(['message' => 'Notification not found.']);
        }

        $notification->delete();
        return back()->with('success', 'Notification deleted successfully.');
    }
} 