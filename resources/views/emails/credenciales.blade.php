<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Bienvenido a la UMA</title>
</head>
<body style="font-family: Arial, sans-serif; color: #333;">
    <h2>¡Bienvenido/a a la Universidad María Auxiliadora!</h2>
    <p>Estimado/a <strong>{{ $nombres }}</strong>,</p>

    <p>Hemos recibido correctamente tu registro como postulante al proceso de admisión.</p>

    <p>A continuación, te enviamos tus credenciales de acceso:</p>

    <ul>
        <li><strong>Usuario:</strong> {{ $usuario }}</li>
        <li><strong>Contraseña:</strong> {{ $password }}</li>
    </ul>

    <p>Con estas credenciales podrás continuar con tu postulación y seguimiento desde nuestra plataforma.</p>

    <p>Si tienes alguna duda, no dudes en comunicarte con nuestro equipo de admisión.</p>

    <p>Atentamente,<br>
    <strong>Oficina de Admisión - UMA</strong></p>
</body>
</html>
