@extends('layouts.adminLayout')

@section('title', 'Kemaskini Jadual - Sistem e-Invigilator UiTM')

@section('content')
<div class="main">
    <div class="main-header">
        <h1 class="main-title">Kemaskini Jadual</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.adminManageSchedule') }}" class="btn btn-primary">Kembali ke Jadual</a>
        </div>
    </div>

    <div style="background-color: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
                <ul style="list-style-type: disc; padding-left: 1.5rem;">
                    @foreach($errors->all() as $e) <li>{{ $e }}</li> @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.updateSchedule', $schedule->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                <div>
                    <label for="userID" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">ID Pengguna</label>
                    <input type="text" id="userID" name="userID" value="{{ old('userID', $schedule->userID) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="userName" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nama</label>
                    <input type="text" id="userName" name="userName" value="{{ old('userName', $schedule->userName) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="position" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Jawatan</label>
                    <select id="position" name="position" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                        <option value="">-- Pilih Jawatan --</option>
                        @foreach($jawatan as $jabatan)
                            <option value="{{ $jabatan }}" {{ old('position', $schedule->position) == $jabatan ? 'selected' : '' }}>{{ $jabatan }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="faculty" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Fakulti</label>
                    <select id="faculty" name="faculty" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                        <option value="">-- Pilih Fakulti --</option>
                        @foreach($faculties as $faculty)
                            <option value="{{ $faculty }}" {{ old('faculty', $schedule->faculty) == $faculty ? 'selected' : '' }}>{{ $faculty }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="role" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tugas</label>
                    <select id="role" name="role" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                        <option value="">-- Pilih Tugas --</option>
                        @foreach($tugas as $tugasItem)
                            <option value="{{ $tugasItem }}" {{ old('role', $schedule->role) == $tugasItem ? 'selected' : '' }}>{{ $tugasItem }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div>
                    <label for="examDate" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tarikh Peperiksaan</label>
                    <input type="date" id="examDate" name="examDate" value="{{ old('examDate', $schedule->examDate) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="examDay" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Hari Peperiksaan</label>
                    <input type="text" id="examDay" name="examDay" value="{{ old('examDay', $schedule->examDay) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;" readonly>
                </div>
                
                <div>
                    <label for="startTime" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Masa Mula</label>
                    <input type="time" id="startTime" name="startTime" value="{{ old('startTime', $schedule->startTime) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="endTime" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Masa Tamat</label>
                    <input type="time" id="endTime" name="endTime" value="{{ old('endTime', $schedule->endTime) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="programCode" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Kod Program</label>
                    <input type="text" id="programCode" name="programCode" value="{{ old('programCode', $schedule->programCode) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="courseCode" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Kod Kursus</label>
                    <input type="text" id="courseCode" name="courseCode" value="{{ old('courseCode', $schedule->courseCode) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="group" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Kumpulan</label>
                    <input type="text" id="group" name="group" value="{{ old('group', $schedule->group) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="totalStudent" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Jumlah Pelajar</label>
                    <input type="number" id="totalStudent" name="totalStudent" value="{{ old('totalStudent', $schedule->totalStudent) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="venue" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Tempat</label>
                    <input type="text" id="venue" name="venue" value="{{ old('venue', $schedule->venue) }}" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
            </div>

            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-success">Kemaskini Jadual</button>
                <a href="{{ route('admin.adminManageSchedule') }}" class="btn" style="margin-left: 1rem; color: #6b7280; text-decoration: none;">Batal</a>
            </div>
        </form>
    </div>
</div>

@section('page_scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
        // 1) Auto-fill Exam Day from the Date picker
        const dateInput = document.querySelector('input[name="examDate"]');
        const dayInput  = document.querySelector('input[name="examDay"]');
        if (dateInput && dayInput) {
            const fillDay = () => {
            if (!dateInput.value) return dayInput.value = '';
            const [y,m,d] = dateInput.value.split('-');
            const dt = new Date(y, m-1, d);
            dayInput.value = dt.toLocaleDateString('ms-MY', { weekday: 'long' });
            };
            dateInput.addEventListener('change', fillDay);
            fillDay(); // run on page load (for edit form)
        }
        });
    </script>
@endsection

@endsection