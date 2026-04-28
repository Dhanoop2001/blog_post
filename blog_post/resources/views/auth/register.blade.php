<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign Up - {{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 48px 16px;
            background: #fafafa;
        }
        .signup-container {
            width: 100%;
            max-width: 440px;
            background: #ffffff;
            border: 1px solid #e5e5e5;
            border-radius: 16px;
            padding: 40px 32px;
            box-shadow: 0 1px 3px rgba(0,0,0,0.08), 0 4px 12px rgba(0,0,0,0.05);
        }
        .signup-header {
            text-align: center;
            margin-bottom: 32px;
        }
        .signup-icon {
            width: 48px;
            height: 48px;
            background: #0a0a0a;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 20px;
        }
        .signup-icon i { color: #ffffff; font-size: 24px; }
        .signup-header h2 {
            font-size: 26px;
            font-weight: 700;
            color: #0a0a0a;
            letter-spacing: -0.02em;
            margin-bottom: 8px;
        }
        .signup-header p {
            font-size: 14px;
            color: #737373;
        }
        .signup-header a {
            color: #0a0a0a;
            font-weight: 600;
            text-decoration: none;
        }
        .signup-header a:hover { text-decoration: underline; }
        .alert {
            padding: 12px 16px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 14px;
            border: none;
        }
        .alert-danger {
            background: #fef2f2;
            color: #991b1b;
        }
        .alert-danger ul { margin: 0; padding-left: 20px; }
        .alert-danger li { margin-bottom: 4px; }
        .alert-danger li:last-child { margin-bottom: 0; }
        .alert-success {
            background: #f0fdf4;
            color: #166534;
        }
        .form-group { margin-bottom: 20px; }
        .form-label {
            display: block;
            font-size: 13px;
            font-weight: 600;
            color: #0a0a0a;
            margin-bottom: 8px;
        }
        .input-wrapper { position: relative; }
        .input-icon {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: #a3a3a3;
            font-size: 16px;
            pointer-events: none;
        }
        .form-input {
            width: 100%;
            padding: 12px 16px 12px 40px;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 14px;
            color: #0a0a0a;
            background: #ffffff;
            transition: all 0.2s;
            outline: none;
        }
        .form-input::placeholder { color: #a3a3a3; }
        .form-input:focus {
            border-color: #0a0a0a;
            box-shadow: 0 0 0 3px rgba(0,0,0,0.08);
        }
        .form-input.is-invalid { border-color: #ef4444; }
        .form-input.has-toggle { padding-right: 44px; }
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
        .error-message {
            font-size: 13px;
            color: #dc2626;
            margin-top: 6px;
        }
        .hint-text {
            font-size: 12px;
            color: #737373;
            margin-top: 6px;
        }
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
        .signin{
            color: #0a0a0a; 
            font-weight: 500;
            text-decoration: none;
        }
        .signin:hover
         { text-decoration: underline; }
         .btn-primary-custom {
            padding: 12px 20px;
            background: #0a0a0a;
            color: #ffffff;
         }
        .submit-btn:hover { background: #262626; }
        .terms-text {
            text-align: center;
            font-size: 12px;
            color: #737373;
            margin-top: 20px;
        }
        .terms-text a {
            color: #0a0a0a;
            text-decoration: none;
            font-weight: 500;
        }
        .terms-text a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <div class="signup-container">
        <div class="signup-header">
            <div class="signup-icon">
                <i class="bi bi-person-plus-fill"></i>
            </div>
            <h2>Create your account</h2>
        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="form-group">
                <label for="name" class="form-label">Full name</label>
                <div class="input-wrapper">
                    <i class="bi bi-person input-icon"></i>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required 
                           placeholder="Full name"
                           class="form-input @error('name') is-invalid @enderror">
                </div>
                @error('name')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="email" class="form-label">Email address</label>
                <div class="input-wrapper">
                    <i class="bi bi-envelope input-icon"></i>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                           placeholder="Email address"
                           class="form-input @error('email') is-invalid @enderror">
                </div>
                @error('email')
                    <p class="error-message">{{ $message }}</p>
                @enderror
            </div>

            <div class="form-group">
                <label for="password" class="form-label">Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock input-icon"></i>
                    <input id="password" name="password" type="password" required 
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                           title="Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&). Min 8 characters."
                           placeholder="Password"
                           class="form-input has-toggle @error('password') is-invalid @enderror">
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
                @error('password')
                    <p class="error-message">{{ $message }}</p>
                @enderror
                <p class="hint-text">Must be at least 8 characters with uppercase, lowercase, number, and special character.</p>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm Password</label>
                <div class="input-wrapper">
                    <i class="bi bi-lock-fill input-icon"></i>
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           placeholder="Confirm password"
                           class="form-input has-toggle">
                    <button type="button" class="password-toggle">
                        <i class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="form-group" style="margin-bottom: 0; margin-top: 24px;">
                <button type="submit" class="submit-btn">
                    <i class="bi bi-arrow-right-circle"></i>
                    Sign up
                </button>
            </div>

            <div class="auth-footer" style="text-align: center; margin-top: 20px; font-size: 14px; color: #737373;">
                <p style="margin-bottom: 4px;">Already have an account?</p>
                <a href="/signin" class="signin">Sign in to your existing account</a>
            </div>

            <p class="terms-text">
                By signing up, you agree to our 
                <a href="#">Terms of Service</a> 
                and 
                <a href="#">Privacy Policy</a>.
            </p>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.password-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const input = toggle.parentElement.querySelector('input');
                    const icon = toggle.querySelector('i');
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

