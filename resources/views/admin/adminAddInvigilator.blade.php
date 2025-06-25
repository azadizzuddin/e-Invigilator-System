@extends('layouts.adminLayout')

@section('title', 'Add Invigilator')

@section('content')
<div class="main">
    <div class="main-header">
        <h1 class="main-title">Tambah Pengawas Baharu</h1>
        <div class="action-buttons">
            <a href="{{ route('admin.adminManageInvigilator') }}" class="btn btn-primary">KEMBALI</a>
        </div>
    </div>

    <div style="background-color: white; padding: 2rem; border-radius: 0.5rem; box-shadow: 0 1px 3px rgba(0,0,0,0.1);">
        @if ($errors->any())
            <div style="background-color: #fee2e2; color: #b91c1c; padding: 1rem; border-radius: 0.375rem; margin-bottom: 1.5rem;">
                <ul style="list-style-type: disc; padding-left: 1.5rem;">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.storeInvigilator') }}" method="POST">
            @csrf
            <div style="display: grid; grid-template-columns: repeat(2, 1fr); gap: 1.5rem;">
                <div>
                    <label for="userID" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">ID Pengguna</label>
                    <input type="text" id="userID" name="userID" value="{{ old('userID') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="userPassword" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Kata Laluan</label>
                    <input type="password" id="userPassword" name="userPassword" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="userName" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Nama</label>
                    <input type="text" id="userName" name="userName" value="{{ old('userName') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="position" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Jawatan</label>
                    <select id="position" name="position" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                        <option value="">-- Pilih Jawatan --</option>
                        <option value="PENSYARAH KANAN" {{ old('position') == 'PENSYARAH KANAN' ? 'selected' : '' }}>PENSYARAH KANAN</option>
                        <option value="PENSYARAH" {{ old('position') == 'PENSYARAH' ? 'selected' : '' }}>PENSYARAH</option>
                        <option value="PENSYARAH (SEPARUH MASA)" {{ old('position') == 'PENSYARAH (SEPARUH MASA)' ? 'selected' : '' }}>PENSYARAH (SEPARUH MASA)</option>
                        <option value="STAF" {{ old('position') == 'STAF' ? 'selected' : '' }}>STAF</option>
                    </select>
                </div>
                
                <div>
                    <label for="faculty" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Fakulti</label>
                    <select id="faculty" name="faculty" required style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                        <option value="">-- Pilih Fakulti --</option>
                        <option value="FAKULTI SAINS GUNAAN" {{ old('faculty') == 'FAKULTI SAINS GUNAAN' ? 'selected' : '' }}>FAKULTI SAINS GUNAAN</option>
                        <option value="FAKULTI SAINS KOMPUTER & MATEMATIK" {{ old('faculty') == 'FAKULTI SAINS KOMPUTER & MATEMATIK' ? 'selected' : '' }}>FAKULTI SAINS KOMPUTER & MATEMATIK</option>
                        <option value="FAKULTI PENGURUSAN & PERNIAGAAN" {{ old('faculty') == 'FAKULTI PENGURUSAN & PERNIAGAAN' ? 'selected' : '' }}>FAKULTI PENGURUSAN & PERNIAGAAN</option>
                        <option value="FAKULTI PERAKAUNAN" {{ old('faculty') == 'FAKULTI PERAKAUNAN' ? 'selected' : '' }}>FAKULTI PERAKAUNAN</option>
                        <option value="FAKULTI SAINS SUKAN & REKREASI" {{ old('faculty') == 'FAKULTI SAINS SUKAN & REKREASI' ? 'selected' : '' }}>FAKULTI SAINS SUKAN & REKREASI</option>
                        <option value="FAKULTI PERTANIAN & AGROTEKNOLOGI" {{ old('faculty') == 'FAKULTI PERTANIAN & AGROTEKNOLOGI' ? 'selected' : '' }}>FAKULTI PERTANIAN & AGROTEKNOLOGI</option>
                        <option value="KOLEJ ALAM BINA" {{ old('faculty') == 'KOLEJ ALAM BINA' ? 'selected' : '' }}>KOLEJ ALAM BINA</option>
                        <option value="BAHAGIAN HAL EHWAL AKADEMIK" {{ old('faculty') == 'BAHAGIAN HAL EHWAL AKADEMIK' ? 'selected' : '' }}>BAHAGIAN HAL EHWAL AKADEMIK</option>
                    </select>
                </div>
                
                <div>
                    <label for="contact" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">No. Telefon</label>
                    <input type="text" id="contact" name="contact" value="{{ old('contact') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;">
                </div>
                
                <div>
                    <label for="chat_id" style="display: block; margin-bottom: 0.5rem; font-weight: 500;">Telegram Chat ID (Opsional)</label>
                    <input type="text" id="chat_id" name="chat_id" value="{{ old('chat_id') }}" style="width: 100%; padding: 0.5rem; border: 1px solid #d1d5db; border-radius: 0.375rem;" placeholder="e.g., 123456789">
                    <small style="color: #6b7280; font-size: 0.875rem; margin-top: 0.25rem; display: block;">
                        Boleh ditambah kemudian. Didapati dengan kod : php get_chat_ids.php
                    </small>
                </div>
            </div>
            
            <div style="margin-top: 2rem;">
                <button type="submit" class="btn btn-success">TAMBAH PENGAWAS</button>
                <a href="{{ route('admin.adminManageInvigilator') }}" style="margin-left: 1rem; color: #6b7280; text-decoration: none;">Cancel</a>
            </div>
        </form>
    </div>
</div>
@endsection