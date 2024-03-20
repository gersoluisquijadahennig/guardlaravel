<!DOCTYPE html>
<html>
<head>
    <title>Confirmación de Recepción de Documentación</title>
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
    <h2>Estimado(a) {{ $nombre }},</h2>

    <p> Nos complace informarle que hemos recibido su documentación con el folio {{ $autofolio }}. Esta documentación será revisada de acuerdo con la información proporcionada. Le mantendremos informado sobre el estado de su solicitud, ya sea que se acepte o se rechace.</p>

    <p>Los detalles de la documentación que ha presentado al departamento de partes son los siguientes:</p>
    <ul>
        <li>Cantidad de Documentos: {{ $cantidad_archivos }}</li>
        <li>Folio de Envío: {{ $autofolio }}</li>
        <li>Funcionario que registra: {{ $nombre }}</li>
        <li>Institución: {{ $institucion_origen }}</li>
        <li>Observación: {{ $observaciones }}</li>
    </ul>

    <p>La documentación sera remitida al los siguientes destinos:</p>
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

    <p>Agradecemos su cooperación y paciencia durante este proceso. Si tiene alguna pregunta o necesita más información, no dude en ponerse en contacto con nosotros.</p>

    <p>Atentamente,<br>
    Servicio de Salud Biobío.</p>

    <p>PD: Este es un mensaje automático, por favor no responda a este correo electrónico.</p>
</body>
</html>