<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Sign Up - {{ config('app.name', 'Laravel') }}</title>
@vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    </head>
    <body class="antialiased  min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
        <div class="max-w-md w-full space-y-8 bg-white/80 backdrop-blur-xl rounded-2xl shadow-2xl p-8">
            <div>
                <h2 class="mt-6 text-center text-3xl font-bold tracking-tight text-gray-900">
                    Create your account
                </h2>
                <p class="mt-2 text-center text-sm text-gray-600">
                    Or <a href="/signin" class="font-medium text-indigo-600 hover:text-indigo-500">Signin</a>
                </p>
            </div>
            <form method="POST" action="{{ route('register') }}" class="mt-8 space-y-6">
                @csrf
                <!-- Name -->
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Full Name</label>
                    <input id="name" name="name" type="text" value="{{ old('name') }}" required 
                           class="appearance-none rounded-xl relative block w-full px-5 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('name') border-red-500 @enderror
                           shadow-sm sm:text-sm">
                    @error('name')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Email -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">Email Address</label>
                    <input id="email" name="email" type="email" value="{{ old('email') }}" required 
                           class="appearance-none rounded-xl relative block w-full px-5 py-3 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('email') border-red-500 @enderror
                           shadow-sm sm:text-sm">
                    @error('email')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                </div>
                <!-- Password -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <div class="position-relative">
                    <input id="password" name="password" type="password" required 
                           pattern="^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$"
                           title="Password must contain at least one lowercase letter, one uppercase letter, one digit, and one special character (@$!%*?&). Min 8 characters."
                           class="appearance-none rounded-xl relative block w-full px-5 py-3 pe-5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 @error('password') border-red-500 @enderror form-control
                           shadow-sm sm:text-sm">
                    <button class="btn btn-link password-toggle position-absolute end-0 top-50 translate-middle-y p-2 text-muted" type="button" style="z-index: 10; line-height: 1; border: none; background: transparent;">
                        <i class="bi bi-eye fs-6"></i>
                    </button>
                    </div>
                    @error('password')
                        <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                    @enderror
                    <!-- Password requirements -->
                    {{-- <ul class="mt-2 text-xs text-gray-500 space-y-1">
                        <li><i class="bi bi-check-lg text-green-500 me-1"></i>At least 8 characters</li>
                        <li><i class="bi bi-check-lg text-green-500 me-1"></i>One lowercase letter (a-z)</li>
                        <li><i class="bi bi-check-lg text-green-500 me-1"></i>One uppercase letter (A-Z)</li>
                        <li><i class="bi bi-check-lg text-green-500 me-1"></i>One number (0-9)</li>
                        <li><i class="bi bi-check-lg text-green-500 me-1"></i>One special character (@ $ ! % * ? &)</li>
                    </ul> --}}
                </div>
                <!-- Confirm Password -->
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700 mb-2">Confirm Password</label>
                    <div class="position-relative">
                    <input id="password_confirmation" name="password_confirmation" type="password" required 
                           class="appearance-none rounded-xl relative block w-full px-5 py-3 pe-5 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 shadow-sm sm:text-sm form-control">
                    <button class="btn btn-link password-toggle position-absolute end-0 top-50 translate-middle-y p-2 text-muted" type="button" style="z-index: 10; line-height: 1; border: none; background: transparent;">
                        <i class="bi bi-eye fs-6"></i>
                    </button>
                    </div>
                </div>
                <div>
                    <button type="submit" 
                            class="group relative flex w-full justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-xl text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 transition duration-200 shadow-xl">
                        Sign up
                    </button>
                </div>
                @if (session('success'))
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-xl" role="alert">
                        {{ session('success') }}
                    </div>
@endif
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
            </form>
        </div>
    </body>
</html>
