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
      $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
      $query = "SELECT * FROM pacientes WHERE correo='$correo'";
      $result = mysqli_query($con, $query);
      $cuenta =   mysqli_fetch_all($result);
      return $cuenta;
    }
    public function citas($correo_paciente){
        $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
        $query = "select pacientes.nombre,doctores.nombre,citas.fecha,citas.hora from citas,doctores,pacientes where citas.paciente_id = pacientes.id and citas.doctor_id = doctores.id and pacientes.correo ='$correo_paciente'";
        $result = mysqli_query($con, $query);
        $citas =   mysqli_fetch_all($result);
        return $citas;
    }
}
