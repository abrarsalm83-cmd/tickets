<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Password</title>
    <style>
        body {
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, sans-serif;
            line-height: 1.6;
            color: #1e293b;
            background-color: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }

        .header {
            background-color: #1e293b;
            color: white;
            padding: 40px 32px;
            text-align: center;
        }

        .logo {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 8px;
        }

        .content {
            padding: 40px 32px;
        }

        .greeting {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 16px;
            color: #1e293b;
        }

        .message {
            font-size: 1rem;
            color: #4b5563;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .button {
            display: inline-block;
            background-color: #3b82f6;
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 500;
            margin: 24px 0;
            transition: background-color 0.2s ease;
        }

        .button:hover {
            background-color: #2563eb;
        }

        .footer {
            background-color: #f1f5f9;
            padding: 24px 32px;
            text-align: center;
            color: #64748b;
            font-size: 0.875rem;
        }

        .warning {
            background-color: #fef3c7;
            border: 1px solid #f59e0b;
            border-radius: 8px;
            padding: 16px;
            margin: 24px 0;
            color: #92400e;
        }

        .expiry {
            font-size: 0.875rem;
            color: #6b7280;
            margin-top: 16px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <div class="logo">Tickets</div>
        </div>

        <div class="content">
            <div class="greeting">Hello {{ $user->name }},</div>

            <div class="message">
                You are receiving this email because we received a password reset request for your account.
            </div>

            <div style="text-align: center;">
                <a href="{{ url('/reset-password/' . $token) }}" class="button">
                    Reset Password
                </a>
            </div>

            <div class="warning">
                <strong>Important:</strong> If you did not request a password reset, no further action is required.
            </div>

            <div class="expiry">
                This password reset link will expire in 1 hour.
            </div>
        </div>

        <div class="footer">
            <p>If you're having trouble clicking the "Reset Password" button, copy and paste the URL below into your web
                browser:</p>
            <p style="word-break: break-all; color: #3b82f6;">{{ url('/reset-password/' . $token) }}</p>
        </div>
    </div>
</body>

</html>
