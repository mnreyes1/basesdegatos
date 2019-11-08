<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.php');   ?>

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
		if ($data[1]=="minera") {
		$query2 = "SELECT pnombre, mineral FROM mineras
		WHERE pnombre = '".$data[0]."';";
		$result2 = $db1 -> prepare($query2);
		$result2 -> execute();
		$datos2 = $result2 -> fetchAll();

		$data[1] = 'minera ('.$datos2[0][1].')'
      ?>
      <?php
    }


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
