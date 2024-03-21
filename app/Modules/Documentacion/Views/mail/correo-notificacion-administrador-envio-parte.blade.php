<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        ul {
            list-style-type: none;
        }
    </style>
</head>
<body>
    <h2>Estimado Administrador,</h2>

    <p> Se ha recibido una nueva documentación con el folio {{ $autofolio }} enviada por el usuario {{ $nombre }} ({{ $emailTo }}). Esta documentación será revisada de acuerdo con la información proporcionada.</p>

    <p>Los detalles de la documentación que ha presentado el usuario son los siguientes:</p>
    <ul>
        <li>Cantidad de Documentos: {{ $cantidad_archivos }}</li>
        <li>Folio de Envío: {{ $autofolio }}</li>
        <li>Funcionario que registra: {{ $nombre }}</li>
        <li>Institución: {{ $institucion_origen }}</li>
        <li>Observación: {{ $observaciones }}</li>
    </ul>

    <p>La documentación sera remitida a los siguientes destinos:</p>
    <ul>
        @foreach ( $destinos as $destino )
            <li>Destino: {{ $destino }}</li>
        @endforeach
    </ul>

    <p>Para ver los archivos adjuntos, por favor haga clic en los siguientes enlaces:</p>
    <ul>
        @foreach ( $archivos as $archivo )
            <li><a href="{{ $archivo['nombre'] }}">{{ $archivo['link']}}</a></li>
        @endforeach
    </ul>

    <p>Por favor, revisa la documentación y toma las acciones necesarias.</p>

    <p>Atentamente,<br>
    Sistema Automatizado.</p>

    <p>PD: Este es un mensaje automático, por favor no responda a este correo electrónico.</p>
</body>
</html>