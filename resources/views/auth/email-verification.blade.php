<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            text-align: center;
        }
        .message {
            margin-top: 20px;
            font-size: 18px;
        }
        .login-button {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #A31E4C;
            color: #fff;
            text-decoration: none;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
        .login-button:hover {
            background-color: #6b0101;
        }
    </style>
</head>
<body>
    <h1>Email Verification</h1>
    <div class="message">
        @if ($status == 'verified')
            <p>Your email has been successfully verified.</p>
        @elseif ($status == 'already_verified')
            <p>Your email is already verified.</p>
        @else
            <p>Invalid verification link.</p>
        @endif
    </div>
    <a href="{{ $appUrl }}" class="login-button">Login</a>
</body>
</html>
