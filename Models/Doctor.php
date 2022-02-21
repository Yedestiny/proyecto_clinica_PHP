<?php



class Doctor
{

    function __construct(
  

        public  $servidor = "127.0.0.1",
        public  $usuario = "angel",
        public  $pass = "angel",
        public  $nombre_bd = "miclinica",


    ) {
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

    public function getTelefono(): string
    {
        return $this->telefono;
    }

    public function setTelefono(string $telefono)
    {
        $this->telefono = $telefono;
    }

    public function getEspecialidad(): string
    {
        return $this->especialidad;
    }
    public function ver_doctores()
    {
        try {
            $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
            $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $con->exec("SET CHARACTER SET utf8");
            $sql = "SELECT * FROM miclinica.doctores";
            $resultado = $con->prepare($sql);
            $resultado->execute(array());
            return $resultado;
            
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }
    public function obtener_id_doctor($nombre_doctor){
        
        try {
            $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
            $sql = "SELECT doctores.id from miclinica.citas,miclinica.doctores where doctores.id = citas.doctor_id and doctores.nombre=?";
            $insert = $con->prepare($sql);
            $insert->execute([$nombre_doctor]);
            $id = $insert->fetchAll(PDO::FETCH_COLUMN, 0);
            return $id;
        } catch (Exception $e) {
            echo "Error: " . $e;
        }
    }



    public static function fromArray(array $data): Doctor
    {
        return new Doctor(
            $data['id'],
            $data['nombre'],
            $data['apellidos'],
            $data['telefono'],
            $data['especialidad'],

        );
    }
    
}
