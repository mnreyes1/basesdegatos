<?php $tipo = $_GET['id']; ?>

<?php include('../templates/header.php');   ?>

    <div class="container-home" style="background-color:#f1f1f1">
        <button onclick="history.go(-1);" class="cancelbtn">Volver</button>
    </div>

    <?php
  #Llama a conexión, crea el objeto PDO y obtiene la variable $db
  require("../config/conexion.php");

 	$query = "SELECT pnombre FROM Proyectos
	WHERE tipo = '".$tipo."';";
	$result = $db1 -> prepare($query);
	$result -> execute();
	$datos = $result -> fetchAll();
  ?>

    <table>
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
</body>

</html>
