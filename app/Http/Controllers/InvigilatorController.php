<?php

namespace App\Http\Controllers;
use App\Models\Invigilator;
use App\Models\SurveillanceTimetable;
use App\Models\SurveillanceExchange;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class InvigilatorController extends Controller { 

  // AUTHENTICATE INVIGILATOR LOGIN
  public function authenticate(Request $request) {
      $request->validate([
          'userID' => 'required',
          'userPassword' => 'required',
      ]);

      // Trim and clean invisible characters
      $userID = preg_replace('/[\x00-\x1F\x7F\xA0\s]+/u', '', trim($request->input('userID')));
      $userPassword = preg_replace('/[\x00-\x1F\x7F\xA0\s]+/u', '', trim($request->input('userPassword')));

      // Use cleaned userID for lookup
      $invigilator = Invigilator::where('userID', $userID)->first();

      if ($invigilator && Hash::check($userPassword, $invigilator->userPassword)) {
          session([
              'invigilator_logged_in' => true,
              'invigilator_id' => $invigilator->id,
              'invigilator_name' => $invigilator->userName,
          ]);

          return redirect()->route('invigilator.dashboard');
      }

      return back()->withErrors(['Invalid credentials.'])->withInput();
  }

  // REDIRECT TO INVIGILATOR DASHBOARD
  public function dashboard()
  {
      if (! session('invigilator_logged_in')) {
          return redirect()->route('invigilator.invigilatorAuthPage');
      }

      $inv = Invigilator::findOrFail(session('invigilator_id'));

      // Count total assignments
      $assignmentCount = SurveillanceTimetable::where('userID', $inv->userID)->count();

      // Next upcoming session
      $next = SurveillanceTimetable::where('userID', $inv->userID)
                ->where('examDate', '>=', now()->toDateString())
                ->orderBy('examDate')
                ->orderBy('startTime')
                ->first();

      $nextSession = $next
          ? \Carbon\Carbon::parse($next->examDate)->format('M j, Y') . ' @ ' .
            \Carbon\Carbon::parse($next->startTime)->format('h:i A')
          : null;

      // All dates for the date‐picker
      $surveillanceDates = SurveillanceTimetable::where('userID', $inv->userID)
                            ->orderBy('examDate')
                            ->pluck('examDate')
                            ->unique();

      // **NEW**: load the full schedule collection
      $schedules = SurveillanceTimetable::where('userID', $inv->userID)
                    ->orderBy('examDate')
                    ->orderBy('startTime')
                    ->get();

      // Prepare events for FullCalendar
      $calendarEvents = $schedules->map(function ($schedule) {
            return [
                'title' => $schedule->courseCode . ' @ ' . $schedule->venue,
                'start' => $schedule->examDate . 'T' . $schedule->startTime,
                'end' => $schedule->examDate . 'T' . $schedule->endTime,
                'borderColor' => '#4a148c',
                'backgroundColor' => '#4a148c'
            ];
        });

      return view('invigilator.invigilatorDashboard', [
          'invigilator'       => $inv,
          'assignmentCount'   => $assignmentCount,
          'nextSession'       => $nextSession,
          'surveillanceDates' => $surveillanceDates,
          'schedules'         => $schedules,
          'calendarEvents'    => $calendarEvents
      ]);
  }

  // ---------------------------------------------------------------------------------------- AUTHENTICATION SECTION ENDS ---------------------------------------------------------------------------------------

  // LOG OUT FUNCTION 
  public function logout(Request $request)
  {
    $request->session()->invalidate(); // Invalidate the session
    $request->session()->regenerateToken(); // Regenerate CSRF token

    return redirect()->route('invigilator.invigilatorAuthPage')->with('message', 'Logged out successfully!');
  }

  // SHOW INVIGILATOR PROFILE
  public function profile()
  {
      if (!session('invigilator_logged_in')) {
          return redirect()->route('invigilator.invigilatorAuthPage');
      }

      $invigilator = Invigilator::findOrFail(session('invigilator_id'));

      return view('invigilator.invigilatorProfile', compact('invigilator'));
  }

  // UPDATE INVIGILATOR PROFILE
  public function updateProfile(Request $request)
  {
      if (!session('invigilator_logged_in')) {
          return redirect()->route('invigilator.invigilatorAuthPage');
      }

      $invigilator = Invigilator::findOrFail(session('invigilator_id'));

      $request->validate([
          'userName' => 'required|string|max:255',
          'contact' => 'nullable|string|max:255',
      ]);

      // Update basic info
      $invigilator->userName = $request->userName;
      $invigilator->contact = $request->contact;

      $invigilator->save();

      return redirect()->route('invigilator.profile')->with('success', 'Profile updated successfully!');
  }

  // UPDATE INVIGILATOR PASSWORD
  public function updatePassword(Request $request)
  {
      if (!session('invigilator_logged_in')) {
          return redirect()->route('invigilator.invigilatorAuthPage');
      }

      $invigilator = Invigilator::findOrFail(session('invigilator_id'));

      $request->validate([
          'current_password' => 'required',
          'new_password' => 'required|min:8|confirmed',
      ]);

      // Verify current password
      if (!Hash::check($request->current_password, $invigilator->userPassword)) {
          return back()->withErrors(['current_password' => 'Current password does not match.']);
      }

      // Update password
      $invigilator->userPassword = Hash::make($request->new_password);
      $invigilator->save();

      return redirect()->route('invigilator.profile')->with('success', 'Password changed successfully!');
  }

}
