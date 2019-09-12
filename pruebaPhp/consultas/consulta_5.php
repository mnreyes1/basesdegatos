<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	# arreglar consulta
 	$query = "SELECT * FROM syp;";
	$result = $db -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Nombre socio</th>
      <th>Nombre proyecto</th>
      <th>Numero recursos asociados al proyecto</th>
    </tr>
  <?php
	foreach ($datos as $data) {
  		echo "<tr> <td>$data[0]</td><td>$data[1]</td><td>$data[2]</td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
