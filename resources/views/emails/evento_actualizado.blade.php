<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Actualización de Evento</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            width: 80%;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        h1 {
            color: #2d3e50;
            text-align: center;
        }

        p {
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 10px;
        }

        .evento-details {
            background-color: #f0f8ff;
            padding: 10px;
            border-radius: 5px;
            margin-top: 20px;
        }

        .evento-details p {
            margin: 5px 0;
        }

        .highlight {
            font-weight: bold;
            color: #2d3e50;
        }

        footer {
            text-align: center;
            margin-top: 30px;
            font-size: 14px;
            color: #777;
        }

        footer a {
            color: #5c6bc0;
            text-decoration: none;
        }

        footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>¡El Evento ha Sufrido una Actualización!</h1>

        <div class="evento-details">
            <p><span class="highlight">Título:</span> {{ $evento->titulo }}</p>
            <p><span class="highlight">Descripción:</span> {{ $evento->descripcion }}</p>
            <p><span class="highlight">Fecha de Inicio:</span> {{ $evento->fecha_inicio }}</p>
            <p><span class="highlight">Fecha de Fin:</span> {{ $evento->fecha_fin }}</p>
            <p><span class="highlight">Estado:</span> {{ $evento->estado }}</p>
        </div>

        <p>Te invitamos a revisar la información actualizada del evento. ¡Esperamos verte allí!</p>
    </div>

    <footer>
        <p>Para más detalles, visita nuestra <a href="#">página web</a>.</p>
    </footer>
</body>
</html>
