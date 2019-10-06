<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT DISTINCT Proyectos.pnombre FROM Recursos, RecursosProyectos, Proyectos 
			  WHERE Proyectos.pnombre=RecursosProyectos.pnombre 
			  AND Recursos.numero=RecursosProyectos.numero
		  	  AND Recursos.status='aprobado'
		  	  AND Proyectos.operativo=TRUE;";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
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

<?php include('../templates/footer.html'); ?>
