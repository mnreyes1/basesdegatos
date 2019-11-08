<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.php');   ?>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT fecha, lugar, personas,
  presupuesto from (
  SELECT movilizacion.id, presupuesto, tipo from (
  SELECT id from ong WHERE nombre = '".$nombre."') as ongs
  INNER JOIN movilizacion on ongs.id = movilizacion.ongid) as total
  NATURAL JOIN marcha;";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query2 = "SELECT tipo_contenido, fecha_comienzo, duracion,
  presupuesto from (
  SELECT movilizacion.id, tipo, presupuesto from (
  SELECT id from ong WHERE nombre = '".$nombre."') as ongs
  INNER JOIN movilizacion on ongs.id = movilizacion.ongid) as total
  NATURAL JOIN movredessociales;";
	$result2 = $db2 -> prepare($query2);
	$result2 -> execute();
	$datos2 = $result2 -> fetchAll();
  ?>

  <table cellspacing=10>
    <tr>
      <th>Marchas</th>
      <th>Redes Sociales</th>
    </tr>
    <tr valign=top>
      <td bgcolor=lightgreen>
        <table cellspacing=5>
            <tr>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Estimación personas</th>
                <th>Presupuesto ($)</th>
            </tr>
            <?php
              foreach ($datos as $data) {
      		        echo "<tr>
                          <td align=center>$data[0]</td>
                          <td align=center>$data[1]</td>
                          <td align=center>$data[2]</td>
                          <td align=center>$data[3]</td>
                        </tr>";
    	             }
                   ?>
        </table>
      </td>
      <td bgcolor = lightblue>
        <table cellspacing=5>
            <tr>
                <th>Tipo de contenido</th>
                <th>Fecha</th>
                <th>Duración (días)</th>
                <th>Presupuesto ($)</th>
            </tr>
            <?php
    	       foreach ($datos2 as $data) {
      		       echo "<tr>
                        <td align=center>$data[0]</td>
                        <td align=center>$data[1]</td>
                        <td align=center>$data[2]</td>
                        <td align=center>$data[3]</td>
                        </tr>";
    	             }
                   ?>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
