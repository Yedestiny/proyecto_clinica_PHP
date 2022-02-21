<?php
require_once('Doctor.php');
require_once('Paciente.php');
class BaseDatos
{

  function __construct(
    public  $servidor = "127.0.0.1",
    public  $usuario = "angel",
    public  $pass = "angel",
    public  $nombre_bd = "miclinica",
  ) {
  }
  public function validar_email($email)
  {
    $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);

    $comprobar_usuario = "SELECT * FROM pacientes WHERE email = '$email'";
    $buscar_email = mysqli_query($con, $comprobar_usuario);

    if ($buscar_email && mysqli_num_rows($buscar_email) >= 1) {
      return false;
    } else {
      return true;
    }
  }
  public function insertar_usuario($nombre, $apellidos, $correo, $contraseña)
  {
    try {
      $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
      $sql = "INSERT INTO miclinica.pacientes (nombre,apellidos,correo,password) VALUES (?,?,?,?)";
      $insert = $con->prepare($sql);
      $insert->execute([$nombre, $apellidos, $correo, $contraseña]);
    } catch (Exception $e) {
      echo "Error: " . $e;
    }
  }
  public function nuevo_usuario($nombre_nuevo, $apellidos_nuevos, $email_nuevo, $contraseña_nueva)
  {
    if ($this->validar_email($email_nuevo)) {
      $this->insertar_usuario($nombre_nuevo, $apellidos_nuevos, $email_nuevo, $contraseña_nueva);
      header('Location: ./../index.php');
    } else {
      header('Location: ./../index.php');
    }
  }

  public function cerrar_sesion()
  {
    session_start();
    session_unset();
    session_destroy();
    header('Location:../index.php');
  }

  public function conectar()
  {
    $conexion = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
    echo "conectado";
  }

  public function info_paciente($paciente)
  {
    try {
      $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $con->exec("SET CHARACTER SET utf8");
      $sql = "SELECT * FROM miclinica.pacientes WHERE nombre = ?";
      $resultado = $con->prepare($paciente);
      $resultado->execute(array());
      return $resultado;
    } catch (Exception $e) {
      echo "Error: " . $e;
    }
  }


  public function validar_usuario($correo, $password)
  {

    try {
      $con = new PDO("mysql:host=localhost;bdname=miclinica", 'angel', 'angel');
      $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $con->exec("SET CHARACTER SET utf8");
      $sql = "SELECT * FROM miclinica.pacientes WHERE correo = ? AND password = ?";
      $resultado = $con->prepare($sql);
      $resultado->execute(array($correo, $password));
      if ($resultado && $resultado->fetchColumn() >= 1) {
        return true;
      } else {
        return false;
      }
    } catch (Exception $e) {
      echo "Error: " . $e;
    }
  }
  public function iniciar_sesion($supuesto_usuario)
  {
    $_SESSION['paciente'] = $supuesto_usuario;
    header('Location: ./../index.php?pag=1');
  }
  public function completar_inicio($supuesto_usuario, $supuesta_password)
  {
    if ($this->validar_usuario($supuesto_usuario, $supuesta_password) == true) {
      session_start();
      $this->iniciar_sesion($supuesto_usuario);
      header("Location: ./../index.php?pag=1");
    } else {
      setcookie("error", 1, time() + 10);
      header("Location: ./../index.php");
    }
  }
}
