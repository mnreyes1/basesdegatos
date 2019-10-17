<?php $id = $_GET['id']; ?>

<?php include('../templates/header.html');   ?>

<?php include('../templates/footer.html'); ?>

<body>

    <a href="consulta_1.php">Consulta</a>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT nombre FROM ONG where id = ".$id.";";
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
  		echo "<tr> <td>$data[0]</td></tr>";
	}
  ?>
    </table>

    <?php include('../templates/footer.html'); ?>