<?php include('../templates/header.html');   ?>

<body>

    <div class="container-home" style="background-color:#f1f1f1">
        <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
    </div>

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
</body>

</html>