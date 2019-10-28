<?php include('../templates/header.php');   ?>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT apellido, snombre, pnombre, count FROM
		  (SELECT pnombre, COUNT(*) AS count FROM
		  Recursos NATURAL JOIN RecursosProyectos
		  WHERE status='en trámite'
		  GROUP BY pnombre) AS np NATURAL JOIN SociosProyectos 
		  ORDER BY 
		  apellido,
		  count DESC;";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
      <th>Apellido socio</th>
      <th>Nombre socio</th>
      <th>Nombre proyecto</th>
      <th>Numero recursos asociados al proyecto</th>
    </tr>
  <?php
	foreach ($datos as $data) {
  		echo "<tr> <td>$data[0]</td><td>$data[1]</td><td>$data[2]</td><td>$data[3]</td></tr>";
	}
  ?>
	</table>
	<br><br>
<form action="../index.php" method="get">
    <input type="submit" value="Volver">
</form>
</body>

</html>