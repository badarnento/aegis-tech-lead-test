<!DOCTYPE html>
<html>
<head>
    <title>Confirm Your Registration</title>
</head>
<body>
    <h1>Hello, {{ $user->name }}</h1>
    <p>Thank you for registering. Please confirm your registration by clicking the link below:</p>
    <a href="{{ route('user.confirmation', ['token' => $user->confirmation_token]) }}">Confirm Registration</a>
</body>
</html>
