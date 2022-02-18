<div>
<?php 
require_once('./Controllers/micuenta.php');
foreach ($array as $campo) {
    echo '<div class="info"> Nombre: '.$campo[1].
    "<br>Apellidos:  ".$campo[2].
    "<br>Correo electronico: ".$campo[3]." </div>";
     
}


?>
</div>