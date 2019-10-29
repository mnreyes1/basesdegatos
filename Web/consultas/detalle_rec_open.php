<?php $nombre = $_GET['id']; ?>

<?php include('../templates/header.php'); ?>

<div class="container-home" >
	<?php echo '
    <form align="center" action="detalle_rec_closed.php?id='.$nombre.'" method="post">
      <input type="submit" value="Recursos Cerrados">
    </form>';
	?>
</div>

<?php
	#Llama a conexión, crea el objeto PDO y obtiene la variable $db
	require("../config/conexion.php");
	include('../paginador/paginador.php');

	$aux_query = "select nombre from proyecto where nombre = '$nombre';";
	$result_aux = $db2 -> prepare($aux_query);
	$result_aux -> execute();

	if($result_aux -> fetchAll()){

	$query = "SELECT recurso.id, recurso.causa_contaminante, recurso.area_influencia,
  	recurso.descripcion, recurso.fecha_apertura, recurso.status, comuna.nombre,
  	proyecto.nombre
  	FROM recurso, recursoabierto, proyecto, comuna
  	where recurso.id = recursoabierto.recursoid
  	and proyecto.nombre = '$nombre'
  	and proyecto.id = recurso.proyectoid
  	and comuna.id = recurso.comunaid";
	$limit = 8;
	$order_by = "recurso.id";
	$datos = NULL;
	$total_pages = NULL;
	list($datos, $total_pages) = paginate($query, $limit, $order_by, $db2);
?>

<div class="header">
<?php
get_links($total_pages, $nombre);
?>
</div>

<?php
	}
	else{

	$query = "SELECT recurso.id, recurso.causa_contaminante, recurso.area_influencia,
  recurso.descripcion, recurso.fecha_apertura, recurso.status, comuna.nombre,
  proyecto.nombre
  FROM recurso, recursoabierto, ong, comuna, o_r, proyecto
  where o_r.recursoid = recurso.id
  and o_r.ongid = ong.id
  and proyecto.id = recurso.proyectoid
  and recurso.id = recursoabierto.recursoid
  and ong.nombre = '$nombre'
  and comuna.id = recurso.comunaid";
	$limit = 8;
	$order_by = "recurso.id";
	$datos = NULL;
	$total_pages = NULL;
	list($datos, $total_pages) = paginate($query, $limit, $order_by, $db2);
?>

<div class="header">
<?php
get_links($total_pages, $nombre);
?>
</div>

<?php
}
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
						<th>ONGs participantes</th>
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
                          <td><a href=\"rec_to_ongs.php?id=$data[0]\">ONGs</a></td>
                          <td><a href=\"detalle_proy.php?id=$data[7]\">$data[7]</a></td>
                        </tr>";
								}
									?>
				</table>
		</tr>
	</table>
</body>

</html>
