<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        body { font-family: Arial, sans-serif; max-width: 400px; margin: 50px auto; padding: 20px; }
        .alert { padding: 10px; margin-bottom: 20px; border-radius: 4px; }
        .alert-success { background-color: #d4edda; color: #155724; border: 1px solid #c3e6cb; }
        .alert-danger { background-color: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; }
        form { display: flex; flex-direction: column; }
        input { margin-bottom: 10px; padding: 10px; border: 1px solid #ddd; border-radius: 4px; }
        button { padding: 10px; background: #007bff; color: white; border: none; border-radius: 4px; cursor: pointer; }
    </style>
</head>
<body>
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

    <h1>Reset Password</h1>
    
    <form method="POST" action="/reset-password">

        @csrf
        <input type="hidden" name="token" value="{{ $token }}">
        <input type="email" name="email" value="{{ $email ?? old('email') }}" placeholder="Email" required>
        
        <div class="input-group position-relative">
            <input type="password" name="password" class="form-control pe-5" placeholder="New Password (min 8 chars)" required>
            <button class="btn btn-link password-toggle position-absolute end-0 top-50 translate-middle-y p-2 text-muted" type="button" style="z-index: 10; line-height: 1; border: none; background: transparent;">
                <i class="bi bi-eye fs-6"></i>
            </button>
        </div>
        
        <input type="password" name="password_confirmation" class="form-control pe-5" placeholder="Confirm Password" required>
        <div class="input-group position-relative">
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control pe-5" placeholder="Confirm Password" required>
            <button class="btn btn-link password-toggle position-absolute end-0 top-50 translate-middle-y p-2 text-muted" type="button" style="z-index: 10; line-height: 1; border: none; background: transparent;" data-target="#password_confirmation">
                <i class="bi bi-eye fs-6"></i>
            </button>
        </div>
        
        <button type="submit">Reset Password</button>
    </form>
    
    <p class="mt-3 text-center">
        <a href="/signin">← Back to Sign In</a>
    </p>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.password-toggle').forEach(function(toggle) {
                toggle.addEventListener('click', function() {
                    const input = document.querySelector(this.dataset.target || this.parentElement.querySelector('input[type=password]'));
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

