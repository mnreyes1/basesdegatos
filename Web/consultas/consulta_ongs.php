<?php include('../templates/header.html');   ?>

<?php include('../templates/footer.html'); ?>

<body>

<table>
   <tr>
     <td>A</td>
     <td>B</td>
   </tr>
   <tr>
     <td><a href="detalle_ong.php?id=0">Consulta</a></td>
     <td>D</td>
   </tr>
</table>

<?php echo "<a href=\"detalle_ong.php?id=0\">Consulta</a>"; ?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT nombre FROM ONG;";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Nombre ONG</th>
    </tr>
  <?php
	foreach ($datos as $data) {
  		echo "<tr> <td><a href=\"detalle_ong.php?id=0\">$data[0]</a></td></tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
