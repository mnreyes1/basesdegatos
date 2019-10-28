<?php include('../templates/header.php');   ?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT DISTINCT region FROM
		  Recursos NATURAL JOIN Comunas
		  WHERE status='en trámite';";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Región</th>
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