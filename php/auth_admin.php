<?php
// NuevaTel — auth_admin.php
// Autenticación del panel administrativo

$db_host = "localhost";
$db_user = "root";
$db_pass = "";
$db_name = "nuevatel_db";

$conn = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
if (!$conn) {
    die("Error de conexión: " . mysqli_connect_error());
}

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario  = $_POST['usuario'];
    $password = $_POST['password'];
    $pass_md5 = md5($password);

    // SQL Injection activa
    $query = "SELECT * FROM usuarios WHERE usuario='$usuario' AND password='$pass_md5' AND rol='admin'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Error: " . mysqli_error($conn) . "<br/>Query: " . $query);
    }

    if (mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);
        $_SESSION['usuario'] = $user['usuario'];
        $_SESSION['rol']     = $user['rol'];
        $_SESSION['admin']   = true;
        header("Location: ../admin/dashboard.html");
        exit;
    } else {
        header("Location: ../admin/login.html?error=1");
        exit;
    }
}
mysqli_close($conn);
?>
