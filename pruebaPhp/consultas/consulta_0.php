<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT * FROM syp;";
	$result = $db -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Apellido</th>
      <th>Nombre</th>
      <th>Proyecto</th>
    </tr>
  <?php
	foreach ($datos as $data) {
  		echo "<tr> <td>$data[0]</td> <td>$data[1]</td> <td>$data[2]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
