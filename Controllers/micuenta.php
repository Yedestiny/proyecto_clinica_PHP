<?php 
require_once('./Models/BaseDatos.php');
$bd = new BaseDatos();
$array = $bd->micuenta($_SESSION['paciente']);

foreach ($array as $campo) {
    echo '<div class="info"> Nombre: '.$campo[1].
    "<br>Apellidos:  ".$campo[2].
    "<br>Correo electronico: ".$campo[3]." </div>";
}


?>