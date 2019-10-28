<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.php');   ?>

<div class="container-home" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
</div>

<div class="container-home">
    <button onclick="history.go(-1);">Recursos Abiertos</button>
</div>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $aux_query = "select nombre from proyecto where nombre = '$nombre';";
  $result_aux = $db2 -> prepare($aux_query);
  $result_aux -> execute();

  if($result_aux -> fetchAll()){
    $query2 = "SELECT recurso.id, recurso.causa_contaminante, recurso.area_influencia,
  recurso.descripcion, recurso.fecha_apertura, recurso.status, comuna.nombre,
  proyecto.nombre
   FROM recurso, recursocerrado, proyecto, comuna
    where recurso.id = recursocerrado.recursoid
    and proyecto.nombre = '$nombre'
    and proyecto.id = recurso.proyectoid
    and comuna.id = recurso.comunaid;";
	$result = $db2 -> prepare($query2);
	$result -> execute();
	$datos2 = $result -> fetchAll();
  }else{
    $query2 = "SELECT recurso.id, recurso.causa_contaminante, recurso.area_influencia,
  recurso.descripcion, recurso.fecha_apertura, recursocerrado.fecha_dictamen, recurso.status, comuna.nombre,
  proyecto.nombre
   FROM recurso, recursocerrado, ong, comuna, o_r, proyecto
   where o_r.recursoid = recurso.id
   and o_r.ongid = ong.id
   and proyecto.id = recurso.proyectoid
   and recurso.id = recursocerrado.recursoid
   and ong.nombre = '$nombre'
   and comuna.id = recurso.comunaid;";
	$result = $db2 -> prepare($query2);
	$result -> execute();
	$datos2 = $result -> fetchAll();
  }

  ?>

  <table cellspacing=10>
    <tr>
      <th>Recursos Cerrados</th>
    </tr>
    <tr valign=top>
      <td bgcolor = lightblue>
        <table cellspacing=5>
            <tr>
              <th>ID</th>
              <th>Causa contaminante</th>
              <th>Área influencia (kms)</th>
              <th>Descripción</th>
              <th>Fecha de apertura</th>
              <th>Fecha del dictamen</th>
              <th>Status</th>
              <th>Comuna</th>
              <th>ONGs participantes</th>
              <th>Proyecto</th>
            </tr>
            <?php
    	       foreach ($datos2 as $data) {
      		       echo "<tr>
                 <td align=center>$data[0]</td>
                 <td align=center>$data[1]</td>
                 <td align=center>$data[2]</td>
                 <td align=center>$data[3]</td>
                 <td align=center>$data[4]</td>
                 <td align=center>$data[5]</td>
                 <td align=center>$data[6]</td>
                 <td align=center>$data[7]</td>
                 <td><a href=\"rec_to_ongs.php?id=$data[0]\">ONGs</a></td>
                 <td><a href=\"detalle_proy.php?id=$data[8]\">$data[8]</a></td>
                        </tr>";
    	             }
                   ?>
        </table>
      </td>
    </tr>
  </table>
</body>

</html>
