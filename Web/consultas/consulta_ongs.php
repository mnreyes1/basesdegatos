<?php include('../templates/header.php');   ?>

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
  		echo "<tr> <td><a href=\"detalle_ong.php?id=$data[0]\">$data[0]</a></td></tr>";
	}
  ?>
    </table>
</body>

</html>