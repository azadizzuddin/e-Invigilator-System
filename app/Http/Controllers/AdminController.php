<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Validator;
use App\Models\Invigilator;
use App\Models\Admin;
use App\Models\SurveillanceTimetable;
use Carbon\Carbon;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class AdminController extends Controller {

    // DISPLAY ADMIN AUTH PAGE
    public function showLoginForm() {
        return view('admin.adminAuthPage');
    }

    // VALIDATE ADMIN AUTHENTICATION
    public function authenticateAdmin(Request $request) {
        // VALIDATE FORM INPUTS
        $request->validate([
            'adminID' => 'required',
            'adminPassword' => 'required',
        ]);

        // FETCH ADMIN BY adminID
        $admin = Admin::where('adminID', $request->adminID)->first();

        // CHECK IF ADMIN EXISTS AND PASSWORD IS CORRECT
        if ($admin && Hash::check($request->adminPassword, $admin->adminPassword)) {
            // SET SESSION TO INDICATE ADMIN IS LOGGED IN
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
            ]);

            return redirect()->route('admin.dashboard');
        }

        // AUTHENTICATION FAILED
        return back()->withErrors(['Invalid credentials.'])->withInput();
    }

    // REDIRECT ADMIN TO DASHBOARD
    public function dashboard() {
        if (!session('admin_logged_in')) {
            return redirect()->route('admin.loginForm');
        }

        return view('admin.adminDashboard'); 
    }

    // DISPLAY CREATE ADMIN PAGE
    public function createAdminForm() {
        return view('admin.createAdmin');
    }

    // STORE NEW ADMIN
    public function storeAdmin(Request $request) {
        $request->validate([
            'adminID' => 'required|unique:admins,adminID',
            'adminName' => 'required',
            'adminPassword' => 'required|min:6',
            'adminContact' => 'required',
        ]);

        Admin::create([
            'adminID' => $request->adminID,
            'adminName' => $request->adminName,
            'adminPassword' => Hash::make($request->adminPassword),
            'adminContact' => $request->adminContact,
        ]);

        return redirect()->route('admin.createForm')->with('success', 'Admin created successfully!');
    }

    // ------------------------------------------------------------------------ INVIGILATOR MANAGEMENT -----------------------------------------------------------------------------

    // DISPLAY INVIGILATOR MANAGEMENT PAGE
    public function manageInvigilators(Request $request) {
        $faculty = $request->input('faculty');

        $invigilators = Invigilator::when($faculty, function ($query, $faculty) {
            return $query->where('faculty', $faculty);
        })->get();

        return view('admin.adminManageInvigilator', compact('invigilators', 'faculty'));
    }
    
    // SHOW ADD INVIGILATOR FORM
    public function addInvigilatorForm() {
        $positions = ['PENSYARAH KANAN',  'PENSYARAH', 'PENSYARAH (SEPARUH MASA)', 'STAF'];
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
    
        return view('admin.adminAddInvigilator', compact('positions', 'faculties'));
    }    

    // STORE NEW INVIGILATOR TO DATABASE
    public function storeInvigilator(Request $request)
    {
        $request->validate([
            'userID' => 'required|unique:invigilators,userID',
            'userPassword' => 'required',
            'userName' => 'required|unique:invigilators,userName',
            'position' => 'required',
            'faculty' => 'required',
            'contact' => 'nullable|unique:invigilators,contact',
        ]);

        Invigilator::create([
            'userID' => $request->userID,
            'userPassword' => Hash::make($request->userPassword), // BCRYPT HASH
            'userName' => $request->userName,
            'position' => $request->position,
            'faculty' => $request->faculty,
            'contact' => $request->contact,
        ]);

        return redirect()->route('admin.adminManageInvigilator')->with('success', 'Invigilator added successfully!');
    }

    // IMPORT INVIGILATOR FROM EXCEL
    public function importInvigilators(Request $request)
    {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        $data = Excel::toArray([], $request->file('excel_file'));

        foreach ($data[0] as $index => $row) {
            if ($index === 0) continue; // SKIP HEADER

            // VALIDATE INDIVIDUAL ROW
            $validator = Validator::make([
                'userID' => $row[0],
                'userPassword' => $row[1],
                'userName' => $row[2],
                'position' => $row[3],
                'faculty' => $row[4],
                'contact' => $row[5],
            ], [
                'userID' => 'required|unique:invigilators,userID',
                'userPassword' => 'required',
                'userName' => 'required',
                'position' => 'required',
                'faculty' => 'required',
                'contact' => 'nullable',
            ]);

            if ($validator->fails()) {
                continue; // SKIP INVALID ROWS
            }

            Invigilator::create([
                'userID' => trim($row[0]),
                'userPassword' => bcrypt(trim($row[1])), 
                'userName' => trim($row[2]),
                'position' => trim($row[3]),
                'faculty' => trim($row[4]),
                'contact' => trim($row[5]),
            ]);
        }

        return back()->with('success', 'Invigilators imported successfully.');
    }

    // SHOW EDIT INVIGILATOR FORM
    public function editInvigilatorForm($id) {
        $invigilator = Invigilator::findOrFail($id);
        $positions = ['PENSYARAH KANAN',  'PENSYARAH', 'PENSYARAH (SEPARUH MASA)', 'STAF'];
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
    
        return view('admin.adminEditInvigilator', compact('invigilator', 'positions', 'faculties'));
    }

    // UPDATE INVIGILATOR IN DATABASE
    public function updateInvigilator(Request $request, $id) {
        
        $invigilator = Invigilator::findOrFail($id);

        // Prepare data except password
        $data = $request->except('userPassword');

        // Only hash and update password if it's set and not empty
        if ($request->filled('userPassword')) {
            $data['userPassword'] = bcrypt($request->input('userPassword'));
        }

        $invigilator->update($data);

        return redirect()->route('admin.adminManageInvigilator')->with('success', 'Invigilator updated!');
    }


    // DELETE INVIGILATOR
    public function deleteInvigilator($id) {
        Invigilator::destroy($id);
        return redirect()->route('admin.adminManageInvigilator')->with('success', 'Invigilator deleted!');
    }

    // ----------------------------------------------------------------------- SCHEDULE MANAGEMENT ----------------------------------------------------------------------------------
    // RETURN SCHEDULE MANAGEMENT PAGE
    public function manageSchedule(Request $request) {
        $query = SurveillanceTimetable::query();

        if ($request->filled('userID')) {
            $query->where('userID', 'like', '%' . $request->userID . '%');
        }

        if ($request->filled('userName')) {
            $query->where('userName', 'like', '%' . $request->userName . '%');
        }

        if ($request->filled('examDate')) {
            $query->whereDate('examDate', $request->examDate);
        }

        if ($request->filled('faculty')) {
            $query->where('faculty', $request->faculty);
        }

        $schedules = $query->orderBy('userID')->orderBy('examDate')->paginate(50);

        return view('admin.adminManageSchedule', compact('schedules'));
    }

    // Show the "Add Schedule" form
    public function addScheduleForm()
    {
        // Define faculties and roles for dropdowns
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

        $jawatan = [
            'PENSYARAH',
            'PENSYARAH KANAN',
            'STAF'
        ];

        $tugas = [
            'KETUA PENGAWAS',
            'P. KETUA PENGAWAS',
            'PENGAWAS'
        ];

        return view('admin.adminAddSchedule', compact('faculties', 'jawatan', 'tugas'));
    }

    // Handle the form submission and create
    public function storeSchedule(Request $request)
    {
        $request->validate([
            'userID'          => 'required',
            'userName'        => 'required',
            'position'        => 'required',
            'faculty'         => 'required',
            'role'            => 'required',
            'examDate'        => 'required|date',
            'examDay'         => 'required',
            'startTime'       => 'required',
            'endTime'         => 'required',
            'programCode'     => 'required',
            'courseCode'      => 'required',
            'group'           => 'required',
            'totalStudent'    => 'required|integer',
            'venue'           => 'required',
        ]);

        // Convert time format to include AM/PM
        $startTime = $request->startTime;
        $endTime = $request->endTime;

        // Create the schedule with the new time format
        SurveillanceTimetable::create([
            'userID'          => $request->userID,
            'userName'        => $request->userName,
            'position'        => $request->position,
            'faculty'         => $request->faculty,
            'role'            => $request->role,
            'examDate'        => $request->examDate,
            'examDay'         => $request->examDay,
            'startTime'       => $startTime,
            'startTimeAMPM'   => date('A', strtotime($startTime)), // Extract AM/PM from time
            'endTime'         => $endTime,
            'endTimeAMPM'     => date('A', strtotime($endTime)), // Extract AM/PM from time
            'programCode'     => $request->programCode,
            'courseCode'      => $request->courseCode,
            'group'           => $request->group,
            'totalStudent'    => $request->totalStudent,
            'venue'           => $request->venue,
        ]);

        return redirect()->route('admin.adminManageSchedule')->with('success', 'Schedule added!');
    }
    

    // Show the "Edit Schedule" form
    public function editScheduleForm($id)
    {
        $schedule = SurveillanceTimetable::findOrFail($id);
        
        // Define faculties and roles for dropdowns
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

        $jawatan = [
            'PENSYARAH',
            'PENSYARAH KANAN',
            'STAF'
        ];

        $tugas = [
            'KETUA PENGAWAS',
            'P. KETUA PENGAWAS',
            'PENGAWAS'
        ];

        return view('admin.adminEditSchedule', compact('schedule', 'faculties', 'jawatan', 'tugas'));
    }

    // Handle the form submission to update
    public function updateSchedule(Request $request, $id)
    {
        $request->validate([
            'userID'          => 'required',
            'userName'        => 'required',
            'position'        => 'required',
            'faculty'         => 'required',
            'role'            => 'required',
            'examDate'        => 'required|date',
            'examDay'         => 'required',
            'startTime'       => 'required',
            'endTime'         => 'required',
            'programCode'     => 'required',
            'courseCode'      => 'required',
            'group'           => 'required',
            'totalStudent'    => 'required|integer',
            'venue'           => 'required',
        ]);

        $schedule = SurveillanceTimetable::findOrFail($id);
        
        // Convert time format to include AM/PM
        $startTime = $request->startTime;
        $endTime = $request->endTime;

        $schedule->update([
            'userID'          => $request->userID,
            'userName'        => $request->userName,
            'position'        => $request->position,
            'faculty'         => $request->faculty,
            'role'            => $request->role,
            'examDate'        => $request->examDate,
            'examDay'         => $request->examDay,
            'startTime'       => $startTime,
            'startTimeAMPM'   => date('A', strtotime($startTime)), // Extract AM/PM from time
            'endTime'         => $endTime,
            'endTimeAMPM'     => date('A', strtotime($endTime)), // Extract AM/PM from time
            'programCode'     => $request->programCode,
            'courseCode'      => $request->courseCode,
            'group'           => $request->group,
            'totalStudent'    => $request->totalStudent,
            'venue'           => $request->venue,
        ]);

        return redirect()->route('admin.adminManageSchedule')->with('success', 'Schedule updated!');
    }

    // Delete action
    public function deleteSchedule($id)
    {
        SurveillanceTimetable::destroy($id);
        return redirect()->route('admin.adminManageSchedule')->with('success', 'Schedule deleted!');
    }

    // IMPORT SCHEDULE FROM EXCEL
    public function importSchedule(Request $request) {
        $request->validate([
            'excel_file' => 'required|mimes:xlsx,xls'
        ]);

        $data = \Maatwebsite\Excel\Facades\Excel::toArray([], $request->file('excel_file'));

        $inserted = 0;
        $skipped = 0;

        foreach ($data[0] as $index => $row) {
            if ($index === 0) continue; // Skip header

            // Get the invigilator by userID
            $invigilator = Invigilator::where('userID', trim($row[0]))->first();

            if (!$invigilator) {
                Log::warning("Invigilator not found for userID", ['userID' => $row[0]]);
                $skipped++;
                continue;
            }

            // Parse date safely
            try {
                $examDate = is_numeric($row[5])
                    ? Date::excelToDateTimeObject($row[5])->format('Y-m-d')
                    : Carbon::parse($row[5])->format('Y-m-d');
            } catch (\Exception $e) {
                Log::error("Invalid examDate", ['value' => $row[5], 'error' => $e->getMessage()]);
                $skipped++;
                continue;
            }

            // Format time and AM/PM
            $startTime = Carbon::parse($row[7])->format('h:i'); // 12-hour format
            $startAMPM = strtoupper(trim($row[8]));

            $endTime = Carbon::parse($row[9])->format('h:i');   // 12-hour format
            $endAMPM = strtoupper(trim($row[10]));


            // Validate required fields
            $validator = Validator::make([
                'examDate'        => $examDate,
                'examDay'         => $row[6],
                'startTime'       => $startTime,
                'startTimeAMPM'   => $startAMPM,
                'endTime'         => $endTime,
                'endTimeAMPM'     => $endAMPM,
                'programCode'     => $row[11],
                'courseCode'      => $row[12],
                'group'           => $row[13],
                'totalStudent'    => $row[14],
                'venue'           => $row[15],
            ], [
                'examDate'        => 'required|date',
                'examDay'         => 'required',
                'startTime'       => 'required',
                'startTimeAMPM'   => 'required|in:AM,PM',
                'endTime'         => 'required',
                'endTimeAMPM'     => 'required|in:AM,PM',
                'programCode'     => 'required',
                'courseCode'      => 'required',
                'group'           => 'required',
                'totalStudent'    => 'required|numeric',
                'venue'           => 'required',
            ]);

            if ($validator->fails()) {
                Log::warning('Validation failed for row', ['row' => $row, 'errors' => $validator->errors()->all()]);
                $skipped++;
                continue;
            }

            // Create the schedule entry
            SurveillanceTimetable::create([
                'userID'          => $invigilator->userID,
                'userName'        => $invigilator->userName,
                'position'        => $invigilator->position,
                'faculty'         => $invigilator->faculty,
                'role'            => $row[4] ?? null,
                'examDate'        => $examDate,
                'examDay'         => $row[6],
                'startTime'       => $startTime,
                'startTimeAMPM'   => $startAMPM,
                'endTime'         => $endTime,
                'endTimeAMPM'     => $endAMPM,
                'programCode'     => $row[11],
                'courseCode'      => $row[12],
                'group'           => $row[13],
                'totalStudent'    => $row[14],
                'venue'           => $row[15],
            ]);

            $inserted++;
        }

        return back()->with('success', "{$inserted} schedules imported. {$skipped} rows skipped.");
    }

    public function showInvigilatorChatIds(Request $request)
    {
        $query = \App\Models\Invigilator::query();

        // Filter by search (name or userID)
        $search = $request->input('search');
        if ($search) {
            $query->where(function($q) use ($search) {
                $q->where('userName', 'like', "%$search%")
                  ->orWhere('userID', 'like', "%$search%") ;
            });
        }

        // Filter by chat_id status
        $chatIdStatus = $request->input('chat_id_status');
        if ($chatIdStatus === 'has') {
            $query->whereNotNull('chat_id')->where('chat_id', '!=', '');
        } elseif ($chatIdStatus === 'none') {
            $query->where(function($q) {
                $q->whereNull('chat_id')->orWhere('chat_id', '');
            });
        }

        $invigilators = $query->select('userName', 'userID', 'chat_id')->get();
        return view('admin.invigilatorChatIds', compact('invigilators', 'search', 'chatIdStatus'));
    }

}
