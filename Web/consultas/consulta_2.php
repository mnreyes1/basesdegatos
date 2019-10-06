<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT pnombre FROM Proyectos NATURAL JOIN Comunas 
	 		  WHERE tipo='vertedero'
	 		  AND region LIKE '%Metropolitana%';";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Nombre proyecto</th>
    </tr>
  <?php
	foreach ($datos as $data) {
  		echo "<tr> <td>$data[0]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
