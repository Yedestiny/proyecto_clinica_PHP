<div class="tabla_doctores">
    <h1>Lista de Doctores</h1>
    <table>
        <tr>
            <td>Nombre</td>
            <td>Apellidos</td>
            <td>Telefono</td>
            <td>Especialidad</td>
        </tr>
        <?php
        require_once('./Models/BaseDatos.php');
        $bd = new BaseDatos();
        $bd->ver_doctores()
        ?>
    </table>

</div>