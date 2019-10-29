<?php include '../templates/header.php';?>

    <div style="text-align: center;">
        <h2>Ingresar como ONG</h2>

        <form action="validar_ong.php" method="post">

            <div class="container">
                <label for="uname"><b>Nombre ONG</b></label>
                <br>
                <input type="text" placeholder="Ingrese nombre ONG" name="uname" required autofocus=true>
                <br>
                <br>

                <label for="psw"><b>Contraseña</b></label>
                <br>
                <input type="password" placeholder="Ingrese contraseña" name="psw" required>
                <br>

                <button type="submit">Ingresar</button>
                <br>
            </div>

            <div class="container" style="background-color:#f1f1f1">
                <button onclick="history.go(-1);" class="cancelbtn">Volver </button>
            </div>
        </form>

    </div>
</body>

</html>