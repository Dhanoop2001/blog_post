<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign In - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body.bg {
            background-image: url("../images/blue-vintage-decorative-balls-background.jpg");
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            color: #0a0a0a;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 16px;
        }
        .auth-card {
            width: 100%;
            max-width: 420px;
            background: rgba(255, 255, 255, 0.25);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 20px;
            padding: 40px 32px;
            box-shadow: 0 8px 32px rgba(0,0,0,0.1), 0 4px 20px rgba(0,0,0,0.05) inset;
            animation: fadeInUp 0.7s cubic-bezier(0.22, 1, 0.36, 1) both;
            transition: all 0.3s ease;
        }
        .auth-card:hover {
            transform: translateY(-4px) scale(1.01);
            box-shadow: 0 12px 40px rgba(0,0,0,0.15), 0 6px 24px rgba(0,0,0,0.08) inset;
        }
        .auth-card.shake {
            animation: shake 0.5s cubic-bezier(0.36, 0.07, 0.19, 0.97) both;
        }
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px) scale(0.96);
            }
            to {
                opacity: 1;
                transform: translateY(0) scale(1);
            }
        }
        @keyframes shake {
            10%, 90% { transform: translate3d(-1px, 0, 0); }
            20%, 80% { transform: translate3d(2px, 0, 0); }
            30%, 50%, 70% { transform: translate3d(-4px, 0, 0); }
            40%, 60% { transform: translate3d(4px, 0, 0); }
        }
        @keyframes pulseGlow {
            0% { box-shadow: 0 0 0 0 rgba(10, 10, 10, 0.15); }
            70% { box-shadow: 0 0 0 12px rgba(10, 10, 10, 0); }
            100% { box-shadow: 0 0 0 0 rgba(10, 10, 10, 0); }
        }
        .auth-header {
            text-align: center;
            margin-bottom: 32px;
            animation: fadeInUp 0.6s 0.15s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .auth-icon {
            width: 48px;
            height: 48px;
            background: #0a0a0a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
            animation: pulseGlow 2.5s infinite;
        }
        .auth-icon i { color: #ffffff; font-size: 22px; }
        .auth-header h1 {
            font-size: 26px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }
        .auth-header p {
            font-size: 14px;
            color: #737373;
        }
        .auth-header a {
            color: #0a0a0a;
            font-weight: 600;
            text-decoration: none;
        }
        .auth-header a:hover { text-decoration: underline; }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border: none;
        }
        .alert-success { background: #f0fdf4; color: #166534; }
        .alert-danger { background: #fef2f2; color: #991b1b; }
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #0a0a0a;
            margin-bottom: 8px;
        }
        .form-control-custom {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid rgba(255, 255, 255, 0.18);
            border-radius: 12px;
            font-size: 14px;
            color: #0a0a0a;
            background: rgba(255, 255, 255, 0.4);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
            outline: none;
            box-shadow: 0 2px 8px rgba(0,0,0,0.05);
        }
        .form-control-custom::placeholder { color: #a3a3a3; }
        .form-control-custom:focus {
            border-color: rgba(255, 255, 255, 0.5);
            box-shadow: 0 0 0 4px rgba(255, 255, 255, 0.2), 0 4px 12px rgba(0,0,0,0.1);
            background: rgba(255, 255, 255, 0.6);
            transform: translateY(-1px);
        }
        .form-group {
            margin-bottom: 20px;
            animation: fadeInUp 0.5s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .form-group:nth-of-type(1) { animation-delay: 0.25s; }
        .form-group:nth-of-type(2) { animation-delay: 0.35s; }
        .submit-btn-wrap {
            animation: fadeInUp 0.5s 0.45s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .auth-footer {
            animation: fadeInUp 0.5s 0.55s cubic-bezier(0.22, 1, 0.36, 1) both;
        }
        .submit-btn.loading {
            pointer-events: none;
            opacity: 0.85;
        }
        .submit-btn .spinner {
            display: none;
            width: 18px;
            height: 18px;
            border: 2px solid rgba(255,255,255,0.3);
            border-top-color: #ffffff;
            border-radius: 50%;
            animation: spin 0.6s linear infinite;
        }
        .submit-btn.loading .spinner { display: inline-block; }
        .submit-btn.loading .btn-text { display: none; }
        .submit-btn.loading .btn-icon { display: none; }
        @keyframes spin { to { transform: rotate(360deg); } }
        .form-control-custom.is-invalid { border-color: #ef4444; }
        .invalid-feedback { font-size: 13px; color: #dc2626; margin-top: 6px; }
        .input-group-wrap { position: relative; }
        .input-group-wrap .form-control-custom { padding-right: 44px; }
        .password-toggle {
            position: absolute;
            right: 12px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            color: #a3a3a3;
            cursor: pointer;
            padding: 4px;
            font-size: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: color 0.2s;
        }
        .password-toggle:hover { color: #737373; }
        .submit-btn {
            width: 100%;
            padding: 14px 24px;
            background: #0a0a0a;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            transition: all 0.2s;
        }
        .submit-btn:hover { background: #262626; }
        .auth-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #737373;
        }
        .auth-footer a {
            color: #0a0a0a;
            font-weight: 500;
            text-decoration: none;
        }
        .auth-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body class="bg">
    <div class="auth-card @if($errors->any()) shake @endif">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="bi bi-box-arrow-in-right"></i>
            </div>
            <h1>Welcome back</h1>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                {{ $errors->first() }}
            </div>
        @endif

        <form id="signin-form" action="/login" method="POST">
            @csrf
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input type="email" name="email" class="form-control-custom @error('email') is-invalid @enderror" placeholder="you@example.com" value="{{ old('email') }}" required>
                @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label class="form-label">Password</label>
                <div class="input-group-wrap">
                    <input type="password" name="password" class="form-control-custom" placeholder="Enter your password" required>
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="submit-btn-wrap">
                <button type="submit" class="submit-btn" id="submit-btn">
                    <i class="bi bi-arrow-right-circle btn-icon"></i>
                    <span class="btn-text">Sign In</span>
                    <span class="spinner"></span>
                </button>
            </div>
        </form>

        <div class="auth-footer">
            <p style="color: #737373; margin-bottom: 4px;"><a href="/forgot-password">Forgot your password?</a></p>
            <p style="color: #737373; margin-bottom: 4px; margin-top: 12px;">Don't have an account?</p>
            <a href="/register">Create a new account</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Password toggle
            document.querySelectorAll('.password-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const input = this.parentElement.querySelector('input');
                    const icon = this.querySelector('i');
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('bi-eye');
                        icon.classList.add('bi-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.add('bi-eye');
                        icon.classList.remove('bi-eye-slash');
                    }
                });
            });

            // Form loading state
            const form = document.getElementById('signin-form');
            const submitBtn = document.getElementById('submit-btn');
            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.classList.add('loading');
                    submitBtn.disabled = true;
                });
            }
        });
    </script>
</body>
</html>
