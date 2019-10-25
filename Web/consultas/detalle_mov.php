<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.html');   ?>

<div class="container-home" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
</div>

<body>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT fecha, lugar, personas from (
  SELECT movilizacion.id, tipo from (
  SELECT id, pais from ong WHERE nombre = '".$nombre."') as ongs
  INNER JOIN movilizacion on ongs.id = movilizacion.ongid) as total
  NATURAL JOIN marcha;";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query2 = "SELECT tipo_contenido, fecha_comienzo, duracion from (
  SELECT movilizacion.id, tipo from (
  SELECT id, pais from ong WHERE nombre = '".$nombre."') as ongs
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
      <td>
        <table cellspacing=5>
            <tr>
                <th>Fecha</th>
                <th>Lugar</th>
                <th>Estimación personas</th>
            </tr>
            <?php
              foreach ($datos as $data) {
      		        echo "<tr>
                          <td align=center>$data[0]</td>
                          <td align=center>$data[1]</td>
                          <td align=center>$data[2]</td>
                        </tr>";
    	             }
                   ?>
        </table>
      </td>
      <td>
        <table cellspacing=5>
            <tr>
                <th>Tipo de contenido</th>
                <th>Fecha</th>
                <th>Duración</th>
            </tr>
            <?php
    	       foreach ($datos2 as $data) {
      		       echo "<tr>
                        <td align=center>$data[0]</td>
                        <td align=center>$data[1]</td>
                        <td align=center>$data[2]</td>
                        </tr>";
    	             }
                   ?>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
