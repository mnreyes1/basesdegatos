<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}
?>

<?php include('templates/header.html');   ?>

<body>

  <?php 
  if ($_SESSION['user_name']){
    echo("<button style='position: absolute; right: 0;' onclick=\"location.href='login/cerrar_sesion.php'\">Cerrar sesion</button>");
    echo "<p align='center'> Bienvenido " . $_SESSION['user_name'] . "</p>";
  }
  else{
    echo("<button style='position: absolute; right: 0;' onclick=\"location.href='login/index.php'\">Iniciar sesion</button>");
  }
  ?>
  
  <br>
  <br>
  <br>
  <br>
  
  <form align="center" action="consultas/consulta_1.php" method="post">
  <input type="submit" value="Ver todas las centrales termoelectricas">
  </form>
  
  <br>
  <br>
  <br>

  <form align="center" action="consultas/consulta_2.php" method="post">
    <input type="submit" value="Ver todos los vertederos de RM">
  </form>
  
  <br>
  <br>
  <br>

  <h3 align="center">Ver recursos asociados a minas entre las siguientes fechas:</h3>

  <form align="center" action="consultas/consulta_3.php" method="post">
    Fecha inicio:
    <input type="text" name="fecha_inicio">
    <br/>
    Fecha final:
    <input type="text" name="fecha_final">
    <br/><br/>
    <input type="submit" value="Buscar">
  </form>
  
  
  <br>
  <br>
  <br>

  <form align="center" action="consultas/consulta_4.php" method="post">
    <input type="submit" value="Ver regiones con algun recurso vigente">
  </form>
  
  <br>
  <br>
  <br>

  <form align="center" action="consultas/consulta_5.php" method="post">
    <input type="submit" value="Ver socios y todos sus proyectos">
  </form>
  
  <br>
  <br>
  <br>

  <form align="center" action="consultas/consulta_6.php" method="post">
    <input type="submit" value="Ver proyectos en operación con recurso aprobado">
  </form>
  
  <br>
  <br>
  <br>


</body>
</html>
