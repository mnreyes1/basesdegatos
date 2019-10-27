<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.html');   ?>

<div class="container-home" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
</div>

<body>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT nombre, pais, descripcion FROM ONG
	WHERE nombre = '".$nombre."';";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

    <table cellspacing=5>
        <tr>
            <th>Nombre ONG</th>
            <th>País</th>
            <th>Descripción</th>
            <th>Movilizaciones</th>
            <th>Recursos</th>
        </tr>
        <?php
	foreach ($datos as $data) {
  		echo "<tr>
			   <td>$data[0]</td>
                           <td>$data[1]</td>
                           <td>$data[2]</td>
                           <td><a href=\"detalle_mov.php?id=$data[0]\">Movilizaciones</a></td>
                           <td><a href=\"detalle_rec_open.php?id=$data[0]\">Recursos</a></td>
                </tr>";
	}
  ?>
    </table>

</body>

</html>
