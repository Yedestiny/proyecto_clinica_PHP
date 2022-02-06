<?php
require_once('Doctor.php');
require_once('Paciente.php');
class BaseDatos
{
  public mixed $resultado; //mixed novedad en PHP cualquier valor

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
    $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
    $insert = "INSERT INTO pacientes (nombre,apellidos,correo,password) VALUES ('$nombre','$apellidos','$correo','$contraseña')";
    $con->query($insert);
  }
  public function nuevo_usuario($nombre_nuevo, $apellidos_nuevos, $email_nuevo, $contraseña_nueva)
  {
    if ($this->validar_email($email_nuevo)) {
      $this->insertar_usuario($nombre_nuevo, $apellidos_nuevos, $email_nuevo, $contraseña_nueva);
      header('Location: ./../index.php');
    } else {
      header('Location: index.php');
    }
  }
  public function micuenta($correo)
  {
    $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
    $query = "SELECT * FROM pacientes WHERE correo='$correo'";
    $result = mysqli_query($con, $query);
    $cuenta =   mysqli_fetch_all($result);
    return $cuenta;
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
    $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
    $comprobar_usuario = "SELECT * FROM pacientes WHERE nombre = '$paciente'";
    $usuario_encontrado = mysqli_query($con, $comprobar_usuario);
    return $usuario_encontrado;
  }
  public function ver_doctores()
  {
    $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
    $query = "SELECT * FROM doctores";
    $result = mysqli_query($con, $query);
    $fila =   mysqli_fetch_all($result);

    foreach ($fila as $doctor) {
      echo "<tr><td>" . $doctor[1] . "</td><td>" . $doctor[2] . "</td><td>" . $doctor[3] . "</td><td>" . $doctor[4] . "</td></tr>";
    }
  }

  public function validar_usuario($correo, $password)
  {
    $con = new mysqli($this->servidor, "angel", "angel", $this->nombre_bd);
    $comprobar_usuario = "SELECT * FROM pacientes WHERE correo = '$correo' AND password = '$password'";
    $buscar_usuario = mysqli_query($con, $comprobar_usuario);

    if ($buscar_usuario && mysqli_num_rows($buscar_usuario) >= 1) {
      return true;
    } else {
      return false;
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
      include("iniciar_sesion.php");
      $this->iniciar_sesion($supuesto_usuario);
      header("Location: ./../index.php?pag=1");
    } else {
      setcookie("error", 1, time() + 10);
      header("Location: ./../index.php");
    }
  }
}