<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password - Tickets</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            background: #f8fafc;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            color: #1e293b;
        }

        .forgot-container {
            background: white;
            border-radius: 16px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);
            overflow: hidden;
            width: 100%;
            max-width: 400px;
            animation: fadeIn 0.5s ease-out;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .forgot-header {
            background: #1e293b;
            padding: 40px 32px;
            text-align: center;
            color: white;
        }

        .logo {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 12px;
            font-size: 1.875rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .logo-icon {
            width: 40px;
            height: 40px;
            background: #3b82f6;
            border-radius: 8px;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
        }

        .logo-icon::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 16px;
            height: 16px;
            background: white;
            border-radius: 2px;
            transform: translate(-50%, -50%);
        }

        .forgot-subtitle {
            font-size: 0.875rem;
            opacity: 0.8;
            font-weight: 400;
        }

        .forgot-form {
            padding: 32px;
        }

        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 24px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .alert-error {
            background: #fef2f2;
            color: #dc2626;
            border: 1px solid #fecaca;
        }

        .alert-success {
            background: #f0fdf4;
            color: #16a34a;
            border: 1px solid #bbf7d0;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-label {
            display: block;
            margin-bottom: 6px;
            font-weight: 500;
            color: #374151;
            font-size: 0.875rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 1px solid #d1d5db;
            border-radius: 8px;
            font-size: 0.875rem;
            transition: all 0.2s ease;
            background: white;
            color: #1e293b;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .form-input::placeholder {
            color: #9ca3af;
        }

        .form-input.error {
            border-color: #dc2626;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.75rem;
            margin-top: 4px;
            display: block;
        }

        .forgot-button {
            width: 100%;
            padding: 12px 16px;
            background: #1e293b;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 0.875rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .forgot-button:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        .forgot-button:active {
            transform: translateY(0);
        }

        .forgot-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .forgot-footer {
            text-align: center;
            margin-top: 24px;
            padding-top: 20px;
            border-top: 1px solid #e5e7eb;
        }

        .back-to-login {
            color: #3b82f6;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.2s ease;
        }

        .back-to-login:hover {
            color: #2563eb;
        }

        .loading {
            display: inline-block;
            width: 16px;
            height: 16px;
            border: 2px solid #ffffff;
            border-radius: 50%;
            border-top-color: transparent;
            animation: spin 1s ease-in-out infinite;
            margin-right: 8px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @media (max-width: 480px) {
            .forgot-container {
                margin: 10px;
                border-radius: 12px;
            }

            .forgot-header {
                padding: 32px 24px;
            }

            .forgot-form {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="forgot-container">
        <div class="forgot-header">
            <div class="logo">
                <div class="logo-icon"></div>
                <span>Tickets</span>
            </div>
            <div class="forgot-subtitle">Forgot your password? No problem. Just let us know your email address and we
                will email you a password reset link.</div>
        </div>

        <form class="forgot-form" method="POST" action="{{ route('password.email') }}">
            @csrf

            {{-- Display session errors --}}
            @if (session('error'))
                <div class="alert alert-error">
                    {{ session('error') }}
                </div>
            @endif

            {{-- Display session success messages --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            {{-- Display validation errors --}}
            @if ($errors->any())
                <div class="alert alert-error">
                    <ul style="margin: 0; padding-left: 16px;">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input @error('email') error @enderror"
                    placeholder="Enter your email address" value="{{ old('email') }}" required>
                @error('email')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="forgot-button" id="forgotBtn">
                Send Password Reset Link
            </button>

            <div class="forgot-footer">
                <p><a href="{{ route('login') }}" class="back-to-login">Back to login</a></p>
            </div>
        </form>
    </div>

    <script>
        // Add loading state to button on form submission
        document.querySelector('.forgot-form').addEventListener('submit', function() {
            const btn = document.getElementById('forgotBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading"></span>Sending...';
        });

        // Add subtle focus effects
        document.querySelectorAll('.form-input').forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'translateY(-1px)';
            });

            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>

</html>
