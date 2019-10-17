<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require "../config/conexion.php";

$ong = $_POST["uname"];

$query = "SELECT * FROM ong
        	WHERE nombre ILIKE '$ong';";
$result = $db2->prepare($query);
$result->execute();
$datos = $result->fetch();

if ($datos) {
    $_SESSION['user_name'] = $datos[1];
    $_SESSION['type'] = 'ong';
    header('Location: ../index.php');
} else {
    echo "<h3 class='container'>[ERROR] No se pudo iniciar sesion. Nombre o contraseña incorrectos</h3>";
}
?>

<link href="../styles/style.css" rel="stylesheet">

<br>

<div class="container" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver </button>
</div>
</form>