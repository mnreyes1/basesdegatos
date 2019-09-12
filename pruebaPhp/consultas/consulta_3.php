<?php include('../templates/header.html');   ?>

<body>

<?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

	$fecha_inicio = $_POST["fecha_inicio"];
	$fecha_final = $_POST["fecha_final"];

	# Arreglar la consulta que esta toda cerda uwu
 	$query = "SELECT Recursos.numero, Recursos.causa_contaminante, Recursos.area_influencia, 
	 		  Recursos.descripcion, Recursos.fecha_apertura, Recursos.comuna_tramitacion, 
			  CyR.region, Recursos.status
	 		  FROM Recursos, Mineras, RyP, CyR 
	 		  WHERE Recursos.numero=RyP.numero_recurso
	 		  AND Mineras.nombre_proyecto=RyP.nombre_proyecto
			  AND CyR.comuna=Recursos.comuna_tramitacion
			  AND Recursos.fecha_apertura>'$fecha_inicio'
			  AND Recursos.fecha_apertura<'$fecha_final';";
	$result = $db -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

	<table>
    <tr>
	  <th>Número</th>
	  <th>Causa contaminante</th>
	  <th>Área influencia (kms)</th>
	  <th>Descripción</th>
	  <th>Fecha apertura</th>
	  <th>Comuna de tramitación</th>
	  <th>Región de tramitación</th>
	  <th>Status</th>
    </tr>
  <?php
	foreach ($datos as $data) {
		  echo "<tr> <td>$data[0]</td> <td>$data[1]</td> <td>$data[2]</td>
		  <td>$data[3]</td> <td>$data[4]</td> <td>$data[5]</td> <td>$data[6]</td>
		  <td>$data[7]</td> </tr>";
	}
  ?>
	</table>

<?php include('../templates/footer.html'); ?>
