<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_final = $_POST["fecha_final"];

	$query = "SELECT numero FROM 
		  Recursos NATURAL JOIN RecursosProyectos NATURAL JOIN Mineras
		  WHERE fecha_apertura >= '$fecha_inicio' AND fecha_apertura <= '$fecha_final';";
	$result = $db -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
	  <th>Número recurso</th>
    </tr>
  <?php
	foreach ($datos as $data) {
		  echo "<tr> <td>$data[0]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
