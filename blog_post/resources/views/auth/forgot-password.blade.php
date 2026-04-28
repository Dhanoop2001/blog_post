<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - {{ config('app.name', 'Laravel') }}</title>
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
            margin-bottom: 8px;
        }
        .auth-header p {
            font-size: 14px;
            color: #737373;
            line-height: 1.5;
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
                <i class="bi bi-key"></i>
            </div>
            <h1>Forgot Password?</h1>
            <p>Enter your email and we'll send you a link to reset your password.</p>
        </div>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
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

        <form method="POST" action="/forgot-password">
            @csrf
            <div class="form-group">
                <label class="form-label">Email address</label>
                <input type="email" name="email" value="{{ old('email') }}" placeholder="you@example.com" class="form-control-custom" required>
            </div>
            <button type="submit" class="submit-btn">
                <i class="bi bi-send"></i> Send Reset Link
            </button>
        </form>

        <div class="auth-footer">
            <a href="/signin"><i class="bi bi-arrow-left"></i> Back to Sign In</a>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

