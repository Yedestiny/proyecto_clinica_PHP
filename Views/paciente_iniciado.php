<?php 

echo '<h3>Bienvenido,<br> '.$_SESSION['paciente']."</h3>";
?>

<a href="index.php?pag=2">Mi cuenta</a> <br>
<a href="index.php?pag=1">Lista de Doctores</a> <br>
<a href="index.php?pag=4">Citas</a> <br> 
<a href="index.php?pag=5">Crear cita</a> <br><br>

<a href="Controllers/cerrar_sesion.php"> <button type="submit" name="cerrar_sesion" value="Cerrar sesion" >Cerrar Sesion </button> </a> <br>