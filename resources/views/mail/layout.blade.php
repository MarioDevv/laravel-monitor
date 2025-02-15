<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>@yield('title', 'Notificación')</title>
        <style>
            /* Estilos comunes para emails */
            body {
                font-family: Arial, sans-serif;
                background-color: #f7f7f7;
                margin: 0;
                padding: 20px;
            }

            .container {
                background-color: #ffffff;
                padding: 30px;
                border-radius: 8px;
                max-width: 600px;
                margin: auto;
                box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            }

            h1,
            h2,
            h3,
            p {
                margin: 0 0 15px;
            }

            a {
                color: #3498db;
                text-decoration: none;
            }

            .footer {
                margin-top: 20px;
                font-size: 12px;
                color: #999;
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div class="container">
            @yield('content')
        </div>
        <div class="footer">
            <p>Este correo se generó automáticamente, por favor, no responda a este mensaje.</p>
        </div>
    </body>
</html>
