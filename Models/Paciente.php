<?php


class Paciente
{
    function __construct(
        public  $servidor = "127.0.0.1",
        public  $usuario = "angel",
        public  $pass = "angel",
        public  $nombre_bd = "miclinica",
    ) {
    }
    public function extraer_info()
    {
    }
    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function getNombre(): string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre)
    {
        $this->nombre = $nombre;
    }

    public function getApellidos(): string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos)
    {
        $this->apellidos = $apellidos;
    }

    public function getCorreo(): string
    {
        return $this->correo;
    }

    public function setCorreo(string $correo)
    {
        $this->correo = $correo;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }
    public function micuenta($correo)
    {
        try {
            $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
            $sql = "SELECT * FROM miclinica.pacientes WHERE correo=?";
            $insert = $con->prepare($sql);
            $insert->execute([$correo]);
            $resultado = $insert->fetchAll(PDO::FETCH_COLUMN, 0);
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
    public function citas($correo_paciente)
    {
        try {
            $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->exec("SET CHARACTER SET utf8");
            $sql = "select pacientes.nombre,doctores.nombre,citas.fecha,citas.hora,citas.id from miclinica.citas,miclinica.doctores,miclinica.pacientes where citas.paciente_id = pacientes.id and citas.doctor_id = doctores.id and pacientes.correo =?";
            $resultado = $con->prepare($sql);
            $resultado->execute(array($correo_paciente));
            return $resultado;
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
    public function nueva_cita($id_doctor, $fecha, $hora)
    {
        try {
            session_start();
            $id_paciente = $this->micuenta($_SESSION['paciente'])[0][0];
            $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
            $sql = "INSERT INTO miclinica.citas VALUES(null,'$id_paciente',?,?,?)";
            $insert = $con->prepare($sql);
            $insert->execute([$id_doctor, $fecha, $hora]);
            header('Location: ./../index.php?pag=4');
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
    public function borrar_cita($id_cita)
    {
        try {
            $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
            $sql = "DELETE FROM miclinica.citas WHERE id=?";
            $insert = $con->prepare($sql);
            $insert->execute([$id_cita]);
            header('Location: ./../index.php?pag=4');
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
}
