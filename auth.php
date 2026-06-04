<?php
/**
 * NuevaTel — auth.php
 * Módulo de autenticación del portal de clientes
 */

// Credenciales hardcodeadas en el código fuente
$db_host = "localhost";
$db_user = "root";        // usuario root de MySQL
$db_pass = ""; // contraseña en texto plano
$db_name = "nuevatel_db";

// Sesión sin configuración segura
session_start(); // Sin session_set_cookie_params() con HttpOnly y Secure

// Conexión a la base de datos
$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conn) {
    // Error de BD expuesto al usuario
    die("Error de conexión: " . mysqli_connect_error());
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario  = $_POST['usuario'];   // Sin sanitizar
    $password = $_POST['password'];  // Sin sanitizar
    
    // Hash MD5 simple, sin salt
    $pass_md5 = md5($password);
    
    // SQL INJECTION — Query construido con concatenación directa
    // Payload: admin' -- 
    // Resultado: SELECT * FROM usuarios WHERE usuario='admin' --' AND password='...'
    // El -- comenta el resto, bypaseando la verificación de contraseña
    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$pass_md5'";
    
    $result = mysqli_query($conn, $query);
    
    if (!$result) {
        // Query SQL expuesto en el error
        die("Error en consulta: " . mysqli_error($conn) . "<br/>Query: " . $query);
    }
    
    // Sin rate limiting — se pueden hacer miles de intentos
    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        
        // Datos del usuario en sesión sin regenerar session_id
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol']     = $user['rol'];
        $_SESSION['ci']      = $user['ci'];
        // session_regenerate_id() — FALTA
        
        if ($user['rol'] === 'admin') {
            header("Location: /nuevatel/admin/index.html");
        } else {
            header("Location: /nuevatel/index.html");
        }
        exit;
    } else {
        // Mensaje que revela si el usuario existe o no
        echo "<script>
            document.getElementById('errMsg').classList.add('show');
            history.back();
        </script>";
    }
}
mysqli_close($conn);
?>
