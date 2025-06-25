<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Document;
use App\Models\SurveillanceTimetable;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Invigilator;

class DocumentController extends Controller
{
    // Show upload form and list (Admin)
    public function adminIndex() {
        $documents = Document::all();
        return view('admin.documents', compact('documents'));
    }

    // Handle upload (Admin)
    public function upload(Request $request) {
        $request->validate([
            'title' => 'required|string|max:255',
            'file' => 'required|mimes:pdf|max:10240', // 10MB
        ]);

        $filePath = $request->file('file')->store('documents', 'public');

        Document::create([
            'title' => $request->title,
            'file_path' => $filePath,
        ]);

        return redirect()->route('admin.documents')->with('success', 'PDF uploaded!');
    }

    // List and Download for Users (Invigilator)
    public function invigilatorIndex() {
        $documents = Document::all();
        return view('invigilator.documents', compact('documents'));
    }

    public function download($id) {
        $document = Document::findOrFail($id);
        return response()->download(storage_path('app/public/' . $document->file_path), $document->title . '.pdf');
    }

    // Print schedule 
    public function printSchedulePdf() {
        // Check if invigilator is logged in via session
        if (!session('invigilator_logged_in')) {
            return redirect()->route('invigilator.invigilatorAuthPage');
        }

        // Get invigilator from session
        $invigilator = Invigilator::findOrFail(session('invigilator_id'));
        $userID = $invigilator->userID;
        
        $schedules = \App\Models\SurveillanceTimetable::where('userID', $userID)->get();

        $pdf = Pdf::loadView('invigilator.scheduleDownload', compact('schedules', 'invigilator'));
        return $pdf->download('invigilator_schedule.pdf');
    }
}

