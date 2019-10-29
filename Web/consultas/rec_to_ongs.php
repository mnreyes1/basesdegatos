<?php $id = $_GET['id']; ?>

<?php include('../templates/header.php'); ?>

<?php
require("../config/conexion.php");
include('../paginador/paginador.php');
$query = "SELECT nombre FROM ONG
  INNER JOIN o_r on ONG.id = o_r.ongid
  INNER JOIN recurso on o_r.recursoid = recurso.id
  WHERE o_r.recursoid = '".$id."'";
$limit = 18;
$order_by = "nombre";
$datos = NULL;
$total_pages = NULL;
list($datos, $total_pages) = paginate($query, $limit, $order_by, $db2);
?>

<table align="center", style="width:100%;">
	<tr>
		<th>Nombre ONG</th>
	</tr>
<?php
	foreach ($datos as $data) {
		echo "<tr align=center> <td><a href=\"detalle_ong.php?id=$data[0]\">$data[0]</a></td></tr>";
	}
?>
</table>

<div class="footer">
<?php
get_links($total_pages, $id);
?>
</div>
</body>

</html>
