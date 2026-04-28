<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, 'Helvetica Neue', Arial, sans-serif;
            background: #ffffff;
            color: #0a0a0a;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }
        .hero {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            padding: 80px 24px;
        }
        .hero-content { max-width: 640px; }
        .hero-icon {
            width: 64px;
            height: 64px;
            background: #0a0a0a;
            border-radius: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0 auto 32px;
        }
        .hero-icon i { color: #ffffff; font-size: 28px; }
        .hero h1 {
            font-size: 56px;
            font-weight: 700;
            letter-spacing: -0.03em;
            line-height: 1.1;
            margin-bottom: 20px;
            color: #0a0a0a;
        }
        .hero p {
            font-size: 18px;
            color: #737373;
            line-height: 1.6;
            margin-bottom: 40px;
        }
        .btn-primary-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: #0a0a0a;
            color: #ffffff;
            border: none;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-primary-custom:hover {
            background: #262626;
            color: #ffffff;
            transform: translateY(-1px);
        }
        .btn-outline-custom {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 14px 28px;
            background: #ffffff;
            color: #0a0a0a;
            border: 1px solid #e5e5e5;
            border-radius: 10px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .btn-outline-custom:hover {
            border-color: #0a0a0a;
            color: #0a0a0a;
            transform: translateY(-1px);
        }
        .footer {
            text-align: center;
            padding: 24px;
            font-size: 13px;
            color: #a3a3a3;
            border-top: 1px solid #f5f5f5;
        }
    </style>
</head>
<body>
    <div class="hero">
        <div class="hero-content">
            <div class="hero-icon">
                <i class="bi bi-journal-text"></i>
            </div>
            <h1>Write. Share. Inspire.</h1>
            <p>A minimal blogging platform designed for creators who value clarity and craft. Publish your thoughts with elegance.</p>
            <div class="d-flex gap-3 justify-content-center flex-wrap">
                @auth
                    <a href="{{ route('blogs.index') }}" class="btn-primary-custom">
                        <i class="bi bi-grid-3x3-gap"></i> My Blogs
                    </a>
                    <a href="{{ route('blogs.all') }}" class="btn-outline-custom">
                        <i class="bi bi-globe"></i> Explore
                    </a>
                @else
                    <a href="{{ route('register') }}" class="btn-primary-custom">
                        <i class="bi bi-person-plus"></i> Get Started
                    </a>
                    <a href="{{ route('login') }}" class="btn-outline-custom">
                        <i class="bi bi-box-arrow-in-right"></i> Sign In
                    </a>
                @endauth
            </div>
        </div>
    </div>
    <div class="footer">
        &copy; {{ date('Y') }} {{ config('app.name', 'Laravel') }}. All rights reserved.
    </div>
</body>
</html>

