<!-- resources/views/pdf/invigilator_schedule.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Surat Lantikan Pengawas Peperiksaan</title>
    <style>
        @page {
            margin: 0;
        }
        body {
            font-family: Arial, sans-serif;
            font-size: 12px;
            margin: 0;
            padding: 0 2cm;
            color: #333;
        }
        .header-bar {
            background-color: #4B0082; /* Deep violet */
            color: white;
            padding: 5px 2cm;
            text-align: right;
            font-weight: bold;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 25px;
        }
        .header-content {
            margin-top: 50px;
            display: table;
            width: 100%;
        }
        .logo {
            display: table-cell;
            vertical-align: top;
            width: 70%;
        }
        .logo img {
            width: 150px;
        }
        .campus-info {
            display: table-cell;
            text-align: right;
            vertical-align: top;
        }
        .campus-info p {
            margin: 0;
            font-weight: bold;
        }
        .address-section {
            margin-top: 20px;
            display: table;
            width: 100%;
        }
        .recipient-info {
            display: table-cell;
            width: 60%;
        }
        .letter-meta {
            display: table-cell;
            width: 40%;
            text-align: left;
            vertical-align: top;
            padding-left: 20%;
        }
        .letter-meta p {
            margin: 0;
        }
        .recipient-info p, .salutation p {
            margin: 0;
            font-weight: bold;
        }
        .salutation {
            margin-top: 15px;
        }
        .letter-title {
            margin-top: 15px;
            text-align: left;
            font-weight: bold;
        }
        .letter-title p {
            margin: 0;
        }
        .letter-body {
            margin-top: 15px;
            text-align: justify;
        }
        .letter-body p {
            margin: 5px 0;
        }
        table {
            border-collapse: collapse;
            width: 100%;
            margin-top: 15px;
            font-size: 11px;
        }
        th, td {
            border: 1px solid #000;
            padding: 6px;
            text-align: left;
        }
        th {
            background: #f2f2f2;
            font-weight: bold;
            text-align: center;
        }
        .closing {
            margin-top: 20px;
        }
        .closing p {
            margin: 0;
        }
        .signature {
            margin-top: 15px;
            font-weight: bold;
        }
        .signature p {
            margin: 0;
        }
        .footer-notes {
            margin-top: 30px;
            font-size: 9px;
            font-style: italic;
        }
        .footer-notes p {
            margin: 2px 0;
        }
        .bold {
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header-bar">
        www.uitm.edu.my
    </div>

    <br>

    <div class="header-content">
        <div class="logo">
            <img src="{{ public_path('images/UiTM Logo.png') }}" alt="UiTM Logo">
        </div>
        <div class="campus-info">
            <p>Cawangan Perlis</p>
            <p>Kampus Arau</p>
        </div>
    </div>

    <br><br>

    <div class="address-section">
        <div class="recipient-info">
            <p class="bold">Prof/Tuan/Puan</p>
            @if($invigilator)
                <p>{{ strtoupper($invigilator->userName) }}</p>
                <p>{{ strtoupper($invigilator->position) }}</p>
                <p>{{ strtoupper($invigilator->faculty) }}</p>
            @endif
        </div>
        <div class="letter-meta">
            <p><span class="bold">No. Rujukan : 600-UiTMPs (HEA 2/2/13)</span></p>
            <p><span class="bold">Tarikh:</span> {{ \Carbon\Carbon::now()->format('d-M-y') }}</p>
        </div>
    </div>

    <br>

    <div class="salutation">
        <p>Prof/Tuan/Puan,</p>
    </div>

    <br><br><br>

    <div class="letter-title">
        <p>PELANTIKAN SEBAGAI PENGAWAS PEPERIKSAAN BAGI PEPERIKSAAN AKHIR SEMESTER</p>
    </div>

    <div class="letter-body">
        <p>Dengan segala hormatnya dimaklumkan bahawa Prof/Tuan/Puan telah dilantik sebagai Pengawas Peperiksaan bagi Peperiksaan Akhir Semester (PEP. AKHIR JULAI 2025) yang akan bermula pada <span class="bold">15/07/2025</span> hingga <span class="bold">04/08/2025</span>.</p><br>
        <p class="bold">2. Berikut adalah Jadual Pengawasan Prof/Tuan/Puan*</p>
    </div>

    <table>
        <thead>
            <tr>
                <th>Bil</th>
                <th>Tarikh</th>
                <th>Hari</th>
                <th>Masa Peperiksaan Bermula</th>
                <th>Tempat Peperiksaan</th>
                <th>Tugas</th>
            </tr>
        </thead>
        <tbody>
            @forelse($schedules as $index => $schedule)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($schedule->examDate)->format('d/m/Y') }}</td>
                <td style="text-align: center;">{{ strtoupper($schedule->examDay) }}</td>
                <td style="text-align: center;">{{ \Carbon\Carbon::parse($schedule->startTime)->format('g:i A') }}</td>
                <td style="text-align: center;">{{ $schedule->venue }}</td>
                <td style="text-align: center;">{{ $schedule->role }}</td>
            </tr>
            @empty
            <tr>
                <td colspan="6" style="text-align: center;">Tiada jadual pengawasan ditemui.</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <br>

    <div class="letter-body">
        <p><span class="bold">3. Sila lapor diri di Bilik Operasi Peperiksaan, HEA, 1 jam sebelum peperiksaan bermula.</span></p>
        <p>Sehubungan dengan itu, diharap Prof/Tuan/Puan dapat melaksanakan tugas tersebut seperti yang dimaklumkan dalam Taklimat Peperiksaan atau berpandukan Buku Panduan Pengawasan Peperiksaan.</p>
        <p>Di atas kerjasama yang diberikan didahului dengan ucapan terima kasih.</p>
    </div>
    
    <br>

    <div class="closing">
        <p>Sekian.</p>
        <p>Yang benar,</p>
    </div>

    <br>

    <div class="signature">
        <p>PROF MADYA DR AHMAD FIKRI BIN MOHD KASSIM</p>
        <p>Timbalan Rektor (Akademik)</p>
        <p>Merangkap Pengerusi Jawatankuasa Pengurusan Peperiksaan</p>
    </div>

    <div class="footer-notes">
        <p>*Surat ini adalah cetakan komputer, tandatangan tidak diperlukan.</p>
        <p>*Jadual ini telah dimuktamadkan. Menjadi tanggungjawab Prof/Tuan/Puan mencari pengganti jika menghadapi kesukaran mengawas pada tarikh yang ditetapkan.</p>
    </div>

</body>
</html>
