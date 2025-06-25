<?php

namespace App\Http\Controllers;

use App\Models\Invigilator;
use Illuminate\Http\Request;

class LandingPageController extends Controller
{
    // Function to return Landing Page view
    public function index() {
        return view('invigilator.landingPage');
    }

    // Function to return Invigilator Auth Page view
    public function viewInvigilatorAuthPage()
    {
        // Redirect to dashboard if already logged in
        if (session()->has('invigilator_logged_in')) {
            return redirect()->route('invigilator.dashboard');
        }

        return view('invigilator.invigilatorAuthPage');
    }

    // Function to return Admin Auth Page view
    public function viewAdminAuthPage() {
        return view('admin.adminAuthPage');
    }
}
