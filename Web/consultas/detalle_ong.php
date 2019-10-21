<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.html');   ?>

<div class="container-home" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
</div>

<body>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT nombre, pais, descripcion FROM ONG where nombre = '".$nombre."';";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

    <table cellspacing=5>
        <tr>
            <th>Nombre ONG</th>
            <th>País</th>
            <th>Descripción</th>
        </tr>
        <?php
	foreach ($datos as $data) {
  		echo "<tr> <td>$data[0]</td>
                           <td>$data[1]</td>
                           <td>$data[2]</td>
                </tr>";
	}
  ?>
    </table>

</body>

</html>