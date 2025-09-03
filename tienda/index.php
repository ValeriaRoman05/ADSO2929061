<?php
session_start();

// Si no hay una sesión activa, redirige al login
if (isset($_SESSION['usuario_id'])) {
    header("Location: tablero.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión / Registrarse</title>
    <style>
        /* Paleta de colores: */
        /* Fondo: #fef1f1ff (Rosado muy claro) */
        /* Contenedor: #ffffff (Blanco puro) */
        /* Texto principal: #4a1c1c (Marrón rojizo oscuro) */
        /* Títulos: #8b0000 (Rojo oscuro/Borgoña) */
        /* Botones y enlaces: #c0392b (Rojo brillante) */
        /* Hover de botones: #a5281a (Rojo más oscuro) */
        /* Border: #d8a0a0 (Rosa pálido) */

        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-color: #fef1f1ff;
            color: #4a1c1c;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .contenedor {
            background-color: #fff;
            padding: 2.5em;
            border-radius: 12px;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 450px;
            text-align: center;
        }

        h2 {
            color: #8b0000;
            border-bottom: 3px solid #8b0000;
            padding-bottom: 0.7em;
            margin-bottom: 1.5em;
        }

        .grupo-formulario {
            text-align: left;
            margin-bottom: 1.8em;
        }

        .grupo-formulario label {
            display: block;
            margin-bottom: 0.6em;
            font-weight: 600;
            color: #5d0000;
        }

        .grupo-formulario input {
            width: 100%;
            padding: 12px;
            border: 1px solid #d8a0a0;
            border-radius: 6px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.3s ease;
        }

        .grupo-formulario input:focus {
            border-color: #8b0000;
            outline: none;
            box-shadow: 0 0 5px rgba(139, 0, 0, 0.3);
        }

        button {
            width: 100%;
            padding: 15px;
            border: none;
            background-color: #c0392b;
            color: white;
            font-size: 18px;
            font-weight: bold;
            border-radius: 6px;
            cursor: pointer;
            margin-top: 1em;
            transition: background-color 0.3s ease;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        button:hover {
            background-color: #a5281a;
        }

        .opcion-enlace {
            margin-top: 2em;
            font-size: 14px;
        }

        .opcion-enlace a {
            color: #8b0000;
            text-decoration: none;
            font-weight: bold;
            transition: color 0.3s ease;
        }

        .opcion-enlace a:hover {
            color: #5d0000;
            text-decoration: underline;
        }

        .oculto {
            display: none;
        }
        
        /* Estilos para los mensajes de éxito y error */
        .mensaje-exito {
            background-color: #e8f5e9;
            color: #2e7d32;
            border: 1px solid #c8e6c9;
            padding: 15px;
            margin: 20px auto;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
        }

        .mensaje-error {
            background-color: #ffebee;
            color: #c62828;
            border: 1px solid #ffcdd2;
            padding: 15px;
            margin: 20px auto;
            border-radius: 8px;
            text-align: center;
            max-width: 600px;
        }
    </style>
</head>

<body>
    <div class="contenedor">
        <?php if (isset($_SESSION['mensaje'])) : ?>
            <div class="mensaje-exito">
                <?php
                echo $_SESSION['mensaje'];
                unset($_SESSION['mensaje']);
                ?>
            </div>
        <?php endif; ?>
        <?php if (isset($_SESSION['error'])) : ?>
            <div class="mensaje-error">
                <?php
                echo $_SESSION['error'];
                unset($_SESSION['error']);
                ?>
            </div>
        <?php endif; ?>

        <div id="login-form">
            <h2>Iniciar Sesión</h2>
            <form action="config/iniciar_sesion.php" method="POST">
                <div class="grupo-formulario">
                    <label for="usuario_login">Correo Electrónico:</label>
                    <input type="text" id="usuario_login" name="correo" required>
                </div>
                <div class="grupo-formulario">
                    <label for="contrasena_login">Contraseña:</label>
                    <input type="password" id="contrasena_login" name="contrasena" required>
                </div>
                <button type="submit">Entrar</button>
            </form>
            <p class="opcion-enlace">¿No tienes una cuenta? <a id="mostrar-registro">Regístrate aquí</a></p>
        </div>

        <div id="registro-form" class="oculto">
            <h2>Registrarse</h2>
            <form action="usuario/crear_usuario.php" method="POST">
                <div class="grupo-formulario">
                    <label for="usuario_registro">Nombre:</label>
                    <input type="text" id="usuario_registro" name="nombre" required>
                </div>
                <div class="grupo-formulario">
                    <label for="correo_registro">Correo Electrónico:</label>
                    <input type="email" id="correo_registro" name="correo" required>
                </div>
                <div class="grupo-formulario">
                    <label for="contrasena_registro">Contraseña:</label>
                    <input type="password" id="contrasena_registro" name="contrasena" required>
                </div>
                <button type="submit">Crear Cuenta</button>
            </form>
            <p class="opcion-enlace">¿Ya tienes una cuenta? <a id="mostrar-login">Inicia sesión</a></p>
        </div>
    </div>

    <script>
        const loginForm = document.getElementById('login-form');
        const registroForm = document.getElementById('registro-form');
        const mostrarRegistroBtn = document.getElementById('mostrar-registro');
        const mostrarLoginBtn = document.getElementById('mostrar-login');

        mostrarRegistroBtn.addEventListener('click', () => {
            loginForm.classList.add('oculto');
            registroForm.classList.remove('oculto');
        });

        mostrarLoginBtn.addEventListener('click', () => {
            registroForm.classList.add('oculto');
            loginForm.classList.remove('oculto');
        });
    </script>
</body>

</html>