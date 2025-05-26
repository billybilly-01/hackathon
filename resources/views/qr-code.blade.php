<!DOCTYPE html>
<html>

<head>
    <title>QR Code Utilisateur</title>
</head>

<body>
    <h1>QR Code de {{ $user->name }}</h1>
    {!! $qrCode !!}
</body>

</html>