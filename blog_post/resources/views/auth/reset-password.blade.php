<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #fafafa;
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
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            padding: 40px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05);
        }
        .auth-header {
            text-align: center;
            margin-bottom: 32px;
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
        }
        .auth-icon i { color: #ffffff; font-size: 22px; }
        .auth-header h1 {
            font-size: 24px;
            font-weight: 700;
            letter-spacing: -0.02em;
            margin-bottom: 6px;
        }
        .auth-header p {
            font-size: 14px;
            color: #737373;
        }
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
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            color: #0a0a0a;
            background: #ffffff;
            transition: all 0.2s;
            outline: none;
        }
        .form-control-custom::placeholder { color: #a3a3a3; }
        .form-control-custom:focus {
            border-color: #0a0a0a;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.08);
        }
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
        }
        .auth-footer a {
            color: #0a0a0a;
            font-weight: 500;
            text-decoration: none;
        }
        .auth-footer a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="auth-card">
        <div class="auth-header">
            <div class="auth-icon">
                <i class="bi bi-shield-lock"></i>
            </div>
            <h1>Reset Password</h1>
            <p>Enter your new password below.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="/reset-password">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">

            <div class="form-group">
                <label class="form-label">Email</label>
                <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="you@example.com" class="form-control-custom" required>
            </div>

            <div class="form-group">
                <label class="form-label">New Password</label>
                <div class="input-group-wrap">
                    <input type="password" name="password" placeholder="New password (min 8 chars)" class="form-control-custom" required>
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group">
                <label class="form-label">Confirm Password</label>
                <div class="input-group-wrap">
                    <input type="password" name="password_confirmation" id="password_confirmation" placeholder="Confirm password" class="form-control-custom" required>
                    <button type="button" class="password-toggle" data-target="#password_confirmation">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button type="submit" class="submit-btn">
                <i class="bi bi-check-circle"></i> Reset Password
            </button>
        </form>

        <div class="auth-footer">
            <a href="/signin"><i class="bi bi-arrow-left"></i> Back to Sign In</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.password-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const input = document.querySelector(this.dataset.target) || this.parentElement.querySelector('input');
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
        });
    </script>
</body>
</html>

