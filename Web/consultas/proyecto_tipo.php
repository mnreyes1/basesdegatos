<?php $tipo = $_GET['id']; ?>

<?php include('../templates/header.php'); ?>

<?php
require("../config/conexion.php");
include('../paginador/paginador.php');
$query = "SELECT pnombre FROM Proyectos
	WHERE tipo = '".$tipo."'";
$limit = 18;
$order_by = "pnombre";
$datos = NULL;
$total_pages = NULL;
list($datos, $total_pages) = paginate($query, $limit, $order_by, $db1);
?>


<table align="center", style="width:100%;">
	<tr>
		<th>Nombre Proyecto</th>
	</tr>
	<?php
	foreach ($datos as $data) {
		echo "<tr align=center>
              <td><a href=\"detalle_proy.php?id=$data[0]\">$data[0]</a></td>
            </tr>";
	}
		?>
	</table>

	<br>

<div class="footer">
<?php
get_links($total_pages, $tipo);
?>
</div>

</body>



</html>
