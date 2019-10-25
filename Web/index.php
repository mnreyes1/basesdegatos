<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<?php include 'templates/header.html';?>

<body>

    <div class="tab">
        <button class="tablinks" onclick="openCity(event, 'Home')" id="defaultOpen">Home</button>
        <button class="tablinks" onclick="openCity(event, 'Socio')">Menu socio</button>
        <button class="tablinks" onclick="openCity(event, 'ONG')">Menu ONG</button>
    </div>


    <div class="container-home">

        <div id="Home" class="tabcontent">
            <form align="center" action="consultas/consulta_proy.php" method="post">
                <input type="submit" value="Ver todos los proyectos">
            </form>
            <form align="center" action="consultas/consulta_ongs.php" method="post">
                <input type="submit" value="Ver todas las ONGs">
            </form>

        </div>

        <div id="Socio" class="tabcontent">
            <?php
if ($_SESSION['user_name']) {
    if ($_SESSION['type'] != "ong") {
        echo ("<button onclick=\"location.href='login/cerrar_sesion.php'\">Cerrar sesion</button>");
        echo "<p align='center'> Bienvenido " . $_SESSION['user_name'] . "</p>";
    } else {
        echo "No se puede ingresar a este menu, pues ya esta logeado como ONG";
    }
} else {
    echo ("<button onclick=\"location.href='login/login_socio.php'\">Iniciar sesion</button>");
}
?>

        </div>

        <div id="ONG" class="tabcontent">
            <?php
if ($_SESSION['user_name']) {
    if ($_SESSION['type'] != "socio") {
        echo ("<button onclick=\"location.href='login/cerrar_sesion.php'\">Cerrar sesion</button>");
        echo "<p align='center'> Bienvenido " . $_SESSION['user_name'] . "</p>";
    } else {
        echo "No se puede ingresar a este menu, pues ya esta logeado como Socio";
    }
} else {
    echo ("<button onclick=\"location.href='login/login_ong.php'\">Iniciar sesion</button>");
}
?>
        </div>

    </div>

    <script>
    function openCity(evt, cityName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    // Get the element with id="defaultOpen" and click on it
    document.getElementById("defaultOpen").click();
    </script>

</body>

</html>