<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

#Llama a conexión, crea el objeto PDO y obtiene la variable $db
require "../config/conexion.php";

$socio = $_POST["uname"];
$psw = $_POST["psw"];
$pieces = explode(" ", $socio);

$query = "SELECT * FROM passwords
        	WHERE snombre ILIKE '$pieces[0]'
          AND apellido ILIKE '$pieces[1]' AND password='$psw';";
$result = $db1->prepare($query);
$result->execute();
$datos = $result->fetch();

if ($datos) {
    $_SESSION['user_name'] = $datos[0];
    $_SESSION['user_last_name'] = $datos[1];
    $_SESSION['type'] = 'socio';
    header('Location: ../index.php');
} else {
    echo "<h3 class='container'>[ERROR] No se pudo iniciar sesion. Nombre o contraseña incorrectos</h3>";
}
?>
<?php include 'templates/header.php';?>
<br>

<div class="container" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver </button>
</div>
</form>
</body>