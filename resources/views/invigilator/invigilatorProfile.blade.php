@extends('layouts.invigilatorLayout')

@section('title', 'Profil Saya - UiTM e-Invigilator')

@section('content')
<style>
    /* ===== UiTM Brand Colors ===== */
    :root {
        --uitm-purple: #4B0082;
        --uitm-purple-dark: #3A006F;
        --uitm-purple-light: #5B1A8B;
        --uitm-gold: #FFD700;
        --uitm-gold-dark: #FFC500;
        --uitm-white: #ffffff;
        --uitm-gray: #f5f5f5;
        --uitm-gray-light: #fafafa;
        --uitm-gray-dark: #333333;
        --uitm-border: #ddd;
        --uitm-text-primary: #333;
        --uitm-text-secondary: #666;
        --uitm-text-muted: #999;
        --uitm-success: #28a745;
        --uitm-danger: #dc3545;
        
        --uitm-shadow-light: 0 2px 4px rgba(0,0,0,0.1);
        --uitm-shadow-medium: 0 4px 8px rgba(0,0,0,0.15);
        --uitm-shadow-heavy: 0 8px 16px rgba(0,0,0,0.2);
        --uitm-border-radius: 8px;
        --uitm-border-radius-sm: 4px;
        --uitm-transition: all 0.3s ease;
    }

    body {
        font-family: Arial, 'Helvetica Neue', sans-serif;
        background-color: var(--uitm-gray);
        color: var(--uitm-text-primary);
    }

    /* ===== Main Container ===== */
    .profile-container {
        max-width: 900px;
        margin: 30px auto;
        background: var(--uitm-white);
        padding: 0;
        border-radius: var(--uitm-border-radius);
        box-shadow: var(--uitm-shadow-medium);
        border: 1px solid var(--uitm-border);
        overflow: hidden;
        position: relative;
    }

    /* ===== UiTM Header Section ===== */
    .profile-header {
        background: linear-gradient(rgba(75, 0, 130, 0.9), rgba(75, 0, 130, 0.9));
        color: var(--uitm-white);
        padding: 40px 50px;
        text-align: center;
        position: relative;
        overflow: hidden;
    }

    .profile-header::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 200px;
        height: 200px;
        background: radial-gradient(circle, rgba(255, 215, 0, 0.1) 0%, transparent 70%);
        border-radius: 50%;
    }

    .profile-header::after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 0;
        width: 100%;
        height: 4px;
        background: linear-gradient(90deg, var(--uitm-gold) 0%, transparent 100%);
    }

    .profile-header h1 {
        font-size: 2.5rem;
        font-weight: bold;
        margin: 0 0 10px 0;
        position: relative;
        z-index: 2;
    }

    .profile-subtitle {
        font-size: 1.1rem;
        color: rgba(255, 255, 255, 0.9);
        margin: 0;
        position: relative;
        z-index: 2;
    }

    /* ===== Content Area ===== */
    .profile-content {
        padding: 40px 50px;
    }

    /* ===== UiTM Alert Messages ===== */
    .alert {
        padding: 16px 20px;
        margin-bottom: 30px;
        border-radius: var(--uitm-border-radius);
        font-size: 14px;
        font-weight: 500;
        position: relative;
        border-left: 4px solid;
        animation: slideInAlert 0.3s ease;
    }

    .alert-success {
        background: linear-gradient(135deg, #ECFDF5 0%, #D1FAE5 100%);
        color: #065F46;
        border-left-color: var(--uitm-success);
    }

    .alert-success::before {
        content: '✓';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--uitm-success);
        font-weight: bold;
        font-size: 16px;
    }

    .alert-success {
        padding-left: 45px;
    }

    .alert-danger {
        background: linear-gradient(135deg, #FEF2F2 0%, #FEE2E2 100%);
        color: #991B1B;
        border-left-color: var(--uitm-danger);
    }

    .alert-danger::before {
        content: '⚠';
        position: absolute;
        left: 15px;
        top: 50%;
        transform: translateY(-50%);
        color: var(--uitm-danger);
        font-weight: bold;
        font-size: 16px;
    }

    .alert-danger {
        padding-left: 45px;
    }

    @keyframes slideInAlert {
        from {
            transform: translateX(-100%);
            opacity: 0;
        }
        to {
            transform: translateX(0);
            opacity: 1;
        }
    }

    /* ===== UiTM Form Sections ===== */
    .form-section {
        margin-bottom: 40px;
        padding: 30px;
        background: var(--uitm-gray-light);
        border-radius: var(--uitm-border-radius);
        border: 1px solid var(--uitm-border);
        position: relative;
        overflow: hidden;
    }

    .form-section::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 3px;
        background: linear-gradient(90deg, var(--uitm-purple) 0%, var(--uitm-gold) 100%);
    }

    .form-section:last-child {
        margin-bottom: 0;
    }

    .form-section h3 {
        color: var(--uitm-purple);
        margin-bottom: 25px;
        font-size: 1.4rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* ===== UiTM Form Styling ===== */
    .form-group {
        margin-bottom: 25px;
    }

    .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: var(--uitm-purple);
        font-size: 14px;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .form-control {
        width: 100%;
        padding: 15px 20px;
        border: 2px solid var(--uitm-border);
        border-radius: var(--uitm-border-radius-sm);
        font-size: 14px;
        background-color: var(--uitm-white);
        color: var(--uitm-text-primary);
        transition: var(--uitm-transition);
        font-family: Arial, 'Helvetica Neue', sans-serif;
    }

    .form-control:focus {
        outline: none;
        border-color: var(--uitm-purple);
        box-shadow: 0 0 0 3px rgba(75, 0, 130, 0.1);
        transform: translateY(-1px);
    }

    .form-control:read-only {
        background-color: var(--uitm-gray-light);
        cursor: not-allowed;
        border-color: #e0e0e0;
        color: var(--uitm-text-muted);
    }

    /* ===== UiTM Button Styling ===== */
    .btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 15px 30px;
        border: none;
        border-radius: var(--uitm-border-radius-sm);
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        cursor: pointer;
        transition: var(--uitm-transition);
        position: relative;
        overflow: hidden;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .btn::before {
        content: '';
        position: absolute;
        top: 0;
        left: -100%;
        width: 100%;
        height: 100%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
        transition: left 0.5s;
    }

    .btn:hover::before {
        left: 100%;
    }

    .btn-submit {
        background: var(--uitm-gold);
        color: var(--uitm-purple);
        border: 2px solid var(--uitm-gold);
    }

    .btn-submit:hover {
        background: var(--uitm-gold-dark);
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    .btn-password {
        background: var(--uitm-danger);
        color: var(--uitm-white);
        border: 2px solid var(--uitm-danger);
    }

    .btn-password:hover {
        background: #c82333;
        transform: translateY(-2px);
        box-shadow: var(--uitm-shadow-medium);
    }

    /* ===== Form Actions ===== */
    .form-actions {
        text-align: right;
        margin-top: 30px;
        padding-top: 20px;
        border-top: 1px solid var(--uitm-border);
    }

    /* ===== Profile Info Card ===== */
    .profile-info-card {
        background: linear-gradient(135deg, #f8f4ff 0%, #f0f8ff 100%);
        border: 2px solid rgba(75, 0, 130, 0.2);
        border-radius: var(--uitm-border-radius);
        padding: 25px;
        margin-bottom: 30px;
    }

    .profile-info-card h4 {
        color: var(--uitm-purple);
        margin-bottom: 15px;
        font-size: 1.1rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .profile-info-card p {
        color: var(--uitm-text-secondary);
        margin: 0;
        line-height: 1.6;
        font-size: 14px;
    }

    /* ===== Security Notice ===== */
    .security-notice {
        background: linear-gradient(135deg, #fff8f0 0%, #fef3e0 100%);
        border: 2px solid rgba(255, 193, 7, 0.3);
        border-radius: var(--uitm-border-radius);
        padding: 20px;
        margin-bottom: 25px;
    }

    .security-notice h5 {
        color: #b07b00;
        margin-bottom: 10px;
        font-size: 1rem;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .security-notice ul {
        color: #856404;
        margin: 0;
        padding-left: 20px;
        font-size: 13px;
    }

    .security-notice li {
        margin-bottom: 5px;
    }

    /* ===== Responsive Design ===== */
    @media (max-width: 768px) {
        .profile-container {
            margin: 20px 15px;
            max-width: none;
        }

        .profile-header {
            padding: 30px 25px;
        }

        .profile-header h1 {
            font-size: 2rem;
        }

        .profile-content {
            padding: 30px 25px;
        }

        .form-section {
            padding: 20px;
        }

        .form-actions {
            text-align: center;
        }

        .btn {
            width: 100%;
            justify-content: center;
        }
    }

    @media (max-width: 480px) {
        .profile-header h1 {
            font-size: 1.5rem;
        }

        .profile-header {
            padding: 25px 20px;
        }

        .profile-content {
            padding: 25px 20px;
        }

        .form-section {
            padding: 15px;
        }
    }

    /* ===== Focus and Accessibility ===== */
    .btn:focus,
    .form-control:focus {
        outline: 2px solid var(--uitm-gold);
        outline-offset: 2px;
    }

    /* ===== Animation Enhancements ===== */
    .form-section {
        animation: fadeInUp 0.5s ease-out;
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* ===== Loading States ===== */
    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
        transform: none !important;
    }

    /* ===== Input Enhancement ===== */
    .form-group {
        position: relative;
    }

    .form-control:focus + .form-label,
    .form-control:not(:placeholder-shown) + .form-label {
        transform: translateY(-25px) scale(0.8);
        color: var(--uitm-purple);
    }

    /* ===== Icon Enhancement ===== */
    .icon {
        font-size: 18px;
    }
</style>

<div class="profile-container">
    <!-- UiTM Header -->
    <div class="profile-header">
        <h1>👤 Profil Saya</h1>
        <p class="profile-subtitle">Kemaskini maklumat peribadi dan kata laluan anda</p>
    </div>

    <div class="profile-content">
        <!-- Alert Messages -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger">
                <ul style="margin: 0; padding-left: 20px;">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Profile Information Card -->
        <div class="profile-info-card">
            <h4>📋 Maklumat Akaun</h4>
            <p>Kemaskini maklumat peribadi anda di bawah. Pastikan maklumat yang diberikan adalah tepat dan terkini untuk memudahkan komunikasi berkaitan tugasan pengawasan.</p>
        </div>

        <!-- Personal Information Form -->
        <div class="form-section">
            <h3>
                <span class="icon">👨‍💼</span>
                Maklumat Peribadi
            </h3>
            <form action="{{ route('invigilator.profile.update') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="userName">Nama Penuh</label>
                    <input type="text" id="userName" name="userName" class="form-control" value="{{ old('userName', $invigilator->userName) }}" required placeholder="Masukkan nama penuh anda">
                </div>

                <div class="form-group">
                    <label for="userID">ID Pengguna (Tidak Boleh Diubah)</label>
                    <input type="text" id="userID" name="userID" class="form-control" value="{{ $invigilator->userID }}" readonly>
                </div>
                
                <div class="form-group">
                    <label for="contact">Nombor Telefon</label>
                    <input type="text" id="contact" name="contact" class="form-control" value="{{ old('contact', $invigilator->contact) }}" placeholder="Contoh: 012-3456789">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-submit">
                        💾 Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>

        <!-- Security Notice -->
        <div class="security-notice">
            <h5>
                🔐 Amaran Keselamatan
            </h5>
            <ul>
                <li>Sila gunakan kata laluan yang kuat (minimum 8 aksara)</li>
                <li>Campurkan huruf besar, huruf kecil, nombor dan simbol</li>
                <li>Jangan kongsikan kata laluan anda dengan sesiapa</li>
                <li>Tukar kata laluan secara berkala untuk keselamatan</li>
            </ul>
        </div>

        <!-- Password Change Form -->
        <div class="form-section">
            <h3>
                <span class="icon">🔒</span>
                Tukar Kata Laluan
            </h3>
            <form action="{{ route('invigilator.password.update') }}" method="POST">
                @csrf
                
                <div class="form-group">
                    <label for="current_password">Kata Laluan Semasa *</label>
                    <input type="password" id="current_password" name="current_password" class="form-control" required placeholder="Masukkan kata laluan semasa">
                </div>
                
                <div class="form-group">
                    <label for="new_password">Kata Laluan Baru *</label>
                    <input type="password" id="new_password" name="new_password" class="form-control" required placeholder="Masukkan kata laluan baru">
                </div>

                <div class="form-group">
                    <label for="new_password_confirmation">Sahkan Kata Laluan Baru *</label>
                    <input type="password" id="new_password_confirmation" name="new_password_confirmation" class="form-control" required placeholder="Ulang kata laluan baru">
                </div>

                <div class="form-actions">
                    <button type="submit" class="btn btn-password">
                        🔄 Tukar Kata Laluan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-hide success/error messages after 5 seconds
        setTimeout(() => {
            const alerts = document.querySelectorAll('.alert');
            alerts.forEach(alert => {
                alert.style.transition = 'opacity 0.5s, transform 0.5s';
                alert.style.opacity = '0';
                alert.style.transform = 'translateY(-20px)';
                setTimeout(() => alert.style.display = 'none', 500);
            });
        }, 5000);

        // Enhanced button interactions
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            button.addEventListener('mouseenter', function() {
                if (!this.disabled) {
                    this.style.transform = 'translateY(-2px)';
                }
            });
            
            button.addEventListener('mouseleave', function() {
                if (!this.disabled) {
                    this.style.transform = 'translateY(0)';
                }
            });
        });

        // Form submission loading states
        const forms = document.querySelectorAll('form');
        forms.forEach(form => {
            form.addEventListener('submit', function() {
                const submitBtn = this.querySelector('button[type="submit"]');
                if (submitBtn && !submitBtn.disabled) {
                    submitBtn.disabled = true;
                    if (submitBtn.classList.contains('btn-submit')) {
                        submitBtn.innerHTML = '⏳ Menyimpan...';
                    } else if (submitBtn.classList.contains('btn-password')) {
                        submitBtn.innerHTML = '⏳ Menukar...';
                    }
                }
            });
        });

        // Enhanced form input interactions
        const formInputs = document.querySelectorAll('.form-control');
        formInputs.forEach(input => {
            input.addEventListener('focus', function() {
                if (!this.readOnly) {
                    this.style.transform = 'translateY(-1px)';
                    this.style.boxShadow = '0 4px 8px rgba(75, 0, 130, 0.15)';
                }
            });
            
            input.addEventListener('blur', function() {
                this.style.transform = 'translateY(0)';
                this.style.boxShadow = '';
            });
        });

        // Password strength indicator (simple version)
        const newPasswordInput = document.getElementById('new_password');
        if (newPasswordInput) {
            newPasswordInput.addEventListener('input', function() {
                const password = this.value;
                const strength = calculatePasswordStrength(password);
                
                // Remove any existing strength indicator
                const existingIndicator = this.parentElement.querySelector('.password-strength');
                if (existingIndicator) {
                    existingIndicator.remove();
                }
                
                if (password.length > 0) {
                    const indicator = document.createElement('div');
                    indicator.className = 'password-strength';
                    indicator.style.marginTop = '5px';
                    indicator.style.fontSize = '12px';
                    indicator.style.fontWeight = '500';
                    
                    if (strength < 3) {
                        indicator.style.color = '#dc3545';
                        indicator.textContent = '⚠ Kata laluan lemah';
                    } else if (strength < 5) {
                        indicator.style.color = '#ffc107';
                        indicator.textContent = '🔶 Kata laluan sederhana';
                    } else {
                        indicator.style.color = '#28a745';
                        indicator.textContent = '✅ Kata laluan kuat';
                    }
                    
                    this.parentElement.appendChild(indicator);
                }
            });
        }

        // Password confirmation validation
        const confirmPasswordInput = document.getElementById('new_password_confirmation');
        if (confirmPasswordInput && newPasswordInput) {
            confirmPasswordInput.addEventListener('input', function() {
                const password = newPasswordInput.value;
                const confirmation = this.value;
                
                // Remove any existing match indicator
                const existingIndicator = this.parentElement.querySelector('.password-match');
                if (existingIndicator) {
                    existingIndicator.remove();
                }
                
                if (confirmation.length > 0) {
                    const indicator = document.createElement('div');
                    indicator.className = 'password-match';
                    indicator.style.marginTop = '5px';
                    indicator.style.fontSize = '12px';
                    indicator.style.fontWeight = '500';
                    
                    if (password === confirmation) {
                        indicator.style.color = '#28a745';
                        indicator.textContent = '✅ Kata laluan sepadan';
                    } else {
                        indicator.style.color = '#dc3545';
                        indicator.textContent = '❌ Kata laluan tidak sepadan';
                    }
                    
                    this.parentElement.appendChild(indicator);
                }
            });
        }
    });

    function calculatePasswordStrength(password) {
        let strength = 0;
        
        // Length check
        if (password.length >= 8) strength++;
        if (password.length >= 12) strength++;
        
        // Character variety checks
        if (/[a-z]/.test(password)) strength++;
        if (/[A-Z]/.test(password)) strength++;
        if (/[0-9]/.test(password)) strength++;
        if (/[^a-zA-Z0-9]/.test(password)) strength++;
        
        return strength;
    }
</script>
@endsection