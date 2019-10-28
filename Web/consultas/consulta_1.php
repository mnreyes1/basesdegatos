<?php include('../templates/header.php');   ?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT pnombre FROM Centrales
		  WHERE generacion='termoeléctrica';";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

<?php

if (isset($_GET["page"])) { $page  = $_GET["page"]; } else { $page=1; }; 

$recortds = 10; // change here for records per page

$start_from = ($page-1) * $records;

$qry = pg_query($db1,"select count(*) as total from Centrales"); 
$row_sql = pg_fetch_row($qry); 
$total_records = $row_sql[0]; 
$total_pages = ceil($total_records / $records);

$select = pg_query($dbconn,"select * from Centrales limit $records offset $start_from");

while($row = pg_fetch_assoc($select )){
    echo $row['col1'].' | '.$row['col2'].' | '.$row['col3'].'<br />';
}


?>



	<table>
    <tr>
      <th>Nombre proyecto</th>
    </tr>
  <?php
	foreach ($datos as $data) {
  		echo "<tr> <td>$data[0]</td></tr>";
	}
  ?>
	</table>

	<br><br>
<form action="../index.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>