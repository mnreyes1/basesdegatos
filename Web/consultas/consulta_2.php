<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT pnombre FROM Proyectos WHERE tipo='vertedero';";
	$result = $db -> prepare($query);
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
