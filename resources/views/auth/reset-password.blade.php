<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password - Tickets</title>
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

        .reset-container {
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

        .reset-header {
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

        .reset-subtitle {
            font-size: 0.875rem;
            opacity: 0.8;
            font-weight: 400;
        }

        .reset-form {
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

        .reset-button {
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

        .reset-button:hover {
            background: #334155;
            transform: translateY(-1px);
        }

        .reset-button:active {
            transform: translateY(0);
        }

        .reset-button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
        }

        .reset-footer {
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

        /* Password strength indicator */
        .password-strength {
            margin-top: 6px;
            font-size: 0.75rem;
            color: #6b7280;
        }

        .strength-weak {
            color: #dc2626;
        }

        .strength-medium {
            color: #f59e0b;
        }

        .strength-strong {
            color: #10b981;
        }

        @media (max-width: 480px) {
            .reset-container {
                margin: 10px;
                border-radius: 12px;
            }

            .reset-header {
                padding: 32px 24px;
            }

            .reset-form {
                padding: 24px;
            }
        }
    </style>
</head>

<body>
    <div class="reset-container">
        <div class="reset-header">
            <div class="logo">
                <div class="logo-icon"></div>
                <span>Tickets</span>
            </div>
            <div class="reset-subtitle">Reset your password</div>
        </div>

        <form class="reset-form" method="POST" action="{{ route('password.update') }}">
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

            <input type="hidden" name="token" value="{{ $token }}">
            <input type="hidden" name="email" value="{{ $email }}">

            <div class="form-group">
                <label for="email" class="form-label">Email Address</label>
                <input type="email" id="email" name="email" class="form-input" value="{{ $email }}"
                    readonly>
            </div>

            <div class="form-group">
                <label for="password" class="form-label">New Password</label>
                <input type="password" id="password" name="password"
                    class="form-input @error('password') error @enderror" placeholder="Enter your new password"
                    required>
                @error('password')
                    <span class="error-message">{{ $message }}</span>
                @enderror
                <div class="password-strength" id="passwordStrength"></div>
            </div>

            <div class="form-group">
                <label for="password_confirmation" class="form-label">Confirm New Password</label>
                <input type="password" id="password_confirmation" name="password_confirmation"
                    class="form-input @error('password_confirmation') error @enderror"
                    placeholder="Confirm your new password" required>
                @error('password_confirmation')
                    <span class="error-message">{{ $message }}</span>
                @enderror
            </div>

            <button type="submit" class="reset-button" id="resetBtn">
                Reset Password
            </button>

            <div class="reset-footer">
                <p><a href="{{ route('login') }}" class="back-to-login">Back to login</a></p>
            </div>
        </form>
    </div>

    <script>
        // Add loading state to button on form submission
        document.querySelector('.reset-form').addEventListener('submit', function() {
            const btn = document.getElementById('resetBtn');
            btn.disabled = true;
            btn.innerHTML = '<span class="loading"></span>Resetting...';
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

        // Password strength checker
        document.getElementById('password').addEventListener('input', function() {
            const password = this.value;
            const strengthIndicator = document.getElementById('passwordStrength');

            if (password.length === 0) {
                strengthIndicator.textContent = '';
                return;
            }

            let strength = 0;

            // Check password criteria
            if (password.length >= 8) strength++;
            if (/[A-Z]/.test(password)) strength++;
            if (/[0-9]/.test(password)) strength++;
            if (/[^A-Za-z0-9]/.test(password)) strength++;

            // Display strength
            if (strength < 2) {
                strengthIndicator.textContent = 'Weak password';
                strengthIndicator.className = 'password-strength strength-weak';
            } else if (strength < 3) {
                strengthIndicator.textContent = 'Medium strength';
                strengthIndicator.className = 'password-strength strength-medium';
            } else {
                strengthIndicator.textContent = 'Strong password';
                strengthIndicator.className = 'password-strength strength-strong';
            }
        });
    </script>
</body>

</html>
