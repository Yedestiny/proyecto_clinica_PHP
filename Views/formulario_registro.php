
<div style="background-color: beige;">
    <form action="controllers/validar_inicio_sesion.php" method="POST">
        <h1>Inicio de Sesion</h1>
        <p>Usuario</p>
        <input id="usuario" name="usuario" type="text" placeholder="Usuario" require>
        <br>
        <p>Contraseña</p>
        <input id="contraseña" name="password" type="password" placeholder="Contraseña" require>
        <br>
        <input id="enviar" value="Enviar" type="submit" class="boton_form"> <br>

        <a href="Views/form_registrar_usuario.php"><input type="button" value="Registar Usuario" class="boton_form"></a> <br>


    </form>
</div>