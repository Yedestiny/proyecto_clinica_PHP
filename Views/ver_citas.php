<div class="tabla_doctores">
    <h1>Lista de Doctores</h1>
    <table>
        <tr>
            <td>Paciente</td>
            <td>Doctor</td>
            <td>Fecha</td>
            <td>Hora</td>
        </tr>
        <?php
        require_once('./Controllers/ver_citas.php');
        foreach ($citas as $dato) {
            echo "<tr><td>" . $dato[0] . "</td><td>" . $dato[1] . "</td><td>" . $dato[2] . "</td><td>" . $dato[3] . "</td></tr>";
        }?>
    </table>

</div>