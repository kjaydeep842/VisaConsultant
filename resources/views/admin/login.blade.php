<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login | NV Visa Consultancy</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:wght@700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('css/admin.css') }}">
</head>
<body class="admin-login-body">
<div class="admin-login-card">
    <div class="login-logo">
        <div class="login-logo-icon"><i class="fas fa-user-shield"></i></div>
        <h1><span style="color:#0B3D91;">NV</span><span style="color:#00A4E4;">Visa</span> Admin</h1>
        <p>Sign in to access the administration panel</p>
    </div>

    @if(session('error'))
        <div class="login-error"><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</div>
    @endif
    @if($errors->has('email'))
        <div class="login-error"><i class="fas fa-exclamation-circle"></i> {{ $errors->first('email') }}</div>
    @endif

    <form action="{{ route('admin.login.post') }}" method="POST" class="login-form">
        @csrf
        <div class="admin-form-group">
            <label for="email"><i class="fas fa-envelope" style="color:#00A4E4;margin-right:6px;"></i>Email Address</label>
            <input type="email" name="email" id="email" class="admin-form-control" placeholder="admin@nvvisa.com" value="{{ old('email') }}" required autofocus>
        </div>
        <div class="admin-form-group">
            <label for="password"><i class="fas fa-lock" style="color:#00A4E4;margin-right:6px;"></i>Password</label>
            <div style="position:relative;">
                <input type="password" name="password" id="password" class="admin-form-control" placeholder="••••••••" required style="padding-right:44px;">
                <button type="button" onclick="togglePw()" style="position:absolute;right:14px;top:50%;transform:translateY(-50%);background:none;border:none;color:#64748b;cursor:pointer;font-size:15px;" id="pwEye">
                    <i class="fas fa-eye"></i>
                </button>
            </div>
        </div>
        <div style="display:flex;justify-content:space-between;align-items:center;margin-bottom:20px;font-size:13px;">
            <label style="display:flex;align-items:center;gap:6px;cursor:pointer;color:#475569;">
                <input type="checkbox" name="remember" style="accent-color:#0B3D91;"> Remember me
            </label>
        </div>
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt"></i> Sign In to Admin Panel
        </button>
    </form>

    <div class="login-back">
        <a href="{{ route('home') }}"><i class="fas fa-arrow-left"></i> Back to Website</a>
    </div>

    <div style="margin-top:24px;padding-top:20px;border-top:1px solid #e2e8f0;text-align:center;font-size:11px;color:#94a3b8;">
        &copy; {{ date('Y') }} NV Visa Consultancy. Admin access only.
    </div>
</div>

<script>
function togglePw() {
    const pw = document.getElementById('password');
    const eye = document.getElementById('pwEye').querySelector('i');
    if (pw.type === 'password') { pw.type = 'text'; eye.className = 'fas fa-eye-slash'; }
    else { pw.type = 'password'; eye.className = 'fas fa-eye'; }
}
</script>
</body>
</html>
