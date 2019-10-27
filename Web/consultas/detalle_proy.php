<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.html');   ?>

<div class="container-home" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
</div>

<body>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT pnombre, tipo, latitud, longitud, comuna, fecha_apertura,
  operativo FROM Proyectos
	WHERE pnombre = '".$nombre."';";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

    <table cellspacing=5>
        <tr>
            <th>Nombre Proyecto</th>
            <th>Tipo</th>
            <th>Latitud</th>
            <th>Longitud</th>
            <th>Comuna</th>
            <th>Fecha de apertura</th>
            <th>Operativo</th>
            <th>Recursos de protección</th>
        </tr>
        <?php
	foreach ($datos as $data) {
  		echo "<tr>
              <td align=center>$data[0]</td>
              <td align=center>$data[1]</td>
              <td align=center>$data[2]</td>
              <td align=center>$data[3]</td>
              <td align=center>$data[4]</td>
              <td align=center>$data[5]</td>
              <td align=center>$data[6]</td>
              <td align=center><a href=\"detalle_rec_open.php?id=$data[0]\">Recursos</a></td>
            </tr>";
	}
  ?>
    </table>

</body>

</html>
