<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.html');   ?>

<div class="container-home" style="background-color:#f1f1f1">
    <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
</div>

<div class="container-home" >
  <?php echo '
    <form align="center" action="detalle_rec_closed.php?id='.$nombre.'" method="post">
      <input type="submit" value="Recursos Cerrados">
    </form>';
  ?>
</div>

<body>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query = "SELECT recursoid, causa_contaminante, area_influencia,
  descripcion, fecha_apertura, status, nombre as comnombre,
  ongnombre, proynombre FROM
  (SELECT * FROM
  (SELECT recursoid, causa_contaminante, area_influencia,
  descripcion, fecha_apertura, status, ongnombre,
  nombre as proynombre, comunaid FROM
  (SELECT recursoid, causa_contaminante, area_influencia,
  descripcion, fecha_apertura, status, ongnombre,
  proyectoid, comunaid FROM (
  SELECT ongid, nombre as ongnombre, recursoid FROM (
  SELECT id, nombre from ong WHERE nombre = '".$nombre."') as ongs
  INNER JOIN o_r on ongs.id = o_r.ongid) as recs
  INNER JOIN recurso on recs.recursoid = recurso.id) as proy
  INNER JOIN proyecto on proy.proyectoid = proyecto.id) as com
  INNER JOIN comuna on com.comunaid = comuna.id) as total
  NATURAL JOIN recursoabierto;";
	$result = $db2 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

  <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

  $query2 = "SELECT recursoid, causa_contaminante, area_influencia,
  descripcion, fecha_apertura, fecha_dictamen, status, nombre as comnombre,
  ongnombre, proynombre FROM
  (SELECT * FROM
  (SELECT recursoid, causa_contaminante, area_influencia,
  descripcion, fecha_apertura, status, ongnombre,
  nombre as proynombre, comunaid FROM
  (SELECT recursoid, causa_contaminante, area_influencia,
  descripcion, fecha_apertura, status, ongnombre,
  proyectoid, comunaid FROM (
  SELECT ongid, nombre as ongnombre, recursoid FROM (
  SELECT id, nombre from ong WHERE nombre = '".$nombre."') as ongs
  INNER JOIN o_r on ongs.id = o_r.ongid) as recs
  INNER JOIN recurso on recs.recursoid = recurso.id) as proy
  INNER JOIN proyecto on proy.proyectoid = proyecto.id) as com
  INNER JOIN comuna on com.comunaid = comuna.id) as total
  NATURAL JOIN recursocerrado;";
	$result2 = $db2 -> prepare($query2);
	$result2 -> execute();
	$datos2 = $result2 -> fetchAll();
  ?>

  <table cellspacing=10>
    <tr>
      <th>Recursos Abiertos</th>
    </tr>
    <tr valign=top>
      <td bgcolor=lightgreen>
        <table cellspacing=5>
            <tr>
                <th>ID</th>
                <th>Causa contaminante</th>
                <th>Área influencia (kms)</th>
                <th>Descripción</th>
                <th>Fecha de apertura</th>
                <th>Status</th>
                <th>Comuna</th>
                <th>ONG</th>
                <th>Proyecto</th>
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
                          <td align=center>$data[7]</td>
                          <td align=center>$data[8]</td>
                        </tr>";
    	             }
                   ?>
        </table>
    </tr>
  </table>
</body>

</html>
