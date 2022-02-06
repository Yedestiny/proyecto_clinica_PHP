<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="estilos.css">
    <title>Clinica</title>
</head>

<body>
    <div class="cabecera">
        <img src="https://thumbs.dreamstime.com/b/m%C3%A9dico-saludable-coraz%C3%B3n-cruza-cl%C3%ADnicas-personas-sanas-dise%C3%B1o-del-logo-de-atenci%C3%B3n-vida-icono-sobre-fondo-blanco-m%C3%A9dica-161525466.jpg">
        <h1>Clinica Angel</h1>
    </div>

    <div class="contenido">
        <?php session_start(); ?>

        <div class="login">
            <?php
            if (!isset($_SESSION['paciente'])) {
                require_once('Views/formulario_registro.php');
            } else {
                require_once('Views/paciente_iniciado.php');
            }
            ?>
        </div>



        <?php
        if (isset($_GET['pag'])) {
            if ($_GET['pag'] == 1) {
                require_once('Views/vista_doctores.php');
            } elseif ($_GET['pag'] == 2) {
                require_once('Views/micuenta.php');
            }
        } else {
            require_once('Views/sin_iniciar_sesion.php');
        }
        ?>


    </div>
</body>

</html>