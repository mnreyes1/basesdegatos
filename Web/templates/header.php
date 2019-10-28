<?php
$url_grupo = explode("/", $_SERVER['REQUEST_URI'])[1];
$url_index = "/{$url_grupo}/index.php";
?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <title> Entrega 3 </title>
    <!-- Bootstrap(CSS), Jquery (javascripts), etc... -->

    <!-- para que sea index.php pueda importarlo -->
    <link rel="stylesheet" href="styles/style.css">
    <!-- para que una consulta.php pueda importarlo -->
    <link rel="stylesheet" href="../styles/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>



<body>

<form method="get" action="<?php echo $url_index; ?>">
    <button class='homebtn', type="submit"><i class='fa fa-home'></i></button>
</form>

        