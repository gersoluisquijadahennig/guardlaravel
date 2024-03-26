<!DOCTYPE html>
<html>
<head>
    <title>Comprobante de Solicitud</title>
</head>
<body>
    <h1>Estimado(a) {{ $solicitud->nombre_solicitante }},</h1>
    <p>Gracias por enviar tu solicitud. Hemos recibido tu solicitud con éxito.</p>

    <p>Detalles de la Solicitud:</p>
    <ul>
        <li>ID de Solicitud: {{ $solicitud->id }}</li>
        <li>Fecha de Solicitud: {{ $solicitud->fecha_solicitud }}</li>
        <!-- Agrega aquí más detalles si los tienes -->
    </ul>

    <p>Estamos procesando tu solicitud y te responderemos a la brevedad posible. Por favor, guarda este correo electrónico como comprobante de tu solicitud.</p>

    <p>Si tienes alguna pregunta, no dudes en contactarnos.</p>

    <p>Gracias,</p>
    <p>El Equipo</p>
</body>
</html>