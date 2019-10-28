<?php include 'templates/header.php';?>
<div style="text-align: center;">

    <h1>¿Como desea ingresar?</h1>
    <br>

        <div style="text-align: center;">
            <form align="center" action="login_socio.php" method="post">
                <button type="submit">Ingresar como socio</button>
            </form>
            <br>
            <form align="center" action="login_ong.php" method="post">
                <button type="submit">Ingresar como ONG</button>
            </form>

            <div class="container" style="background-color:#f1f1f1">
                <button onclick="history.go(-1);" class="cancelbtn">Volver </button>
            </div>
            </form>
        </div>
    </body>
</div>