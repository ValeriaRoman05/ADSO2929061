<?php
// Inicia la sesión para poder acceder a las variables de sesión
session_start();

// Destruye todas las variables de sesión
session_unset();

// Destruye la sesión completa
session_destroy();

// Redirige al usuario a la página de inicio (login)
header("Location: ../index.php");
exit; // Asegura que el script se detenga aquí y no ejecute más código
?>