<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $socio = $_POST["uname"];
  $pieces = explode(" ", $socio);

	$query = "SELECT * FROM Socios
        	WHERE snombre ILIKE '%$pieces[0]%'
          AND apellido ILIKE '%$pieces[1]%';";
	$result = $db1 -> prepare($query);
	$result -> execute();
    $datos = $result -> fetch();
    session_start();
    
    if ($datos){
        $_SESSION['user_name'] = $datos[0];
        $_SESSION['user_last_name'] = $datos[1];
        $_SESSION['type'] = 'socio';
        header('Location: ../index.php');
    }
    else{
        echo "<h1>[ERROR] No se pudo iniciar sesion. Nombre o contraseña incorrectos</h1>";
    }
  ?>

<br>
<form action="../login/login_ong.php" method="get">
    <input type="submit" value="Volver">
</form>