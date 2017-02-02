<?php
require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
$usuario=$_POST['usuario'];
$password=md5($_POST['password']);
$consulta=$db->query("select * from usuarios where usuario='$usuario' and password='$password'");
if($db->num_rows($consulta)==1)
{
    $fila_usuario=$db->fetch_array($consulta);
    session_start();
    $_SESSION['usuario'] = $usuario;
    $mensaje = array("header" => "success","body" => "Bienvenido ".$fila_usuario['nombre'], "contenido" => "index.php");
}
else
{
    if(isset($_SESSION['usuario']))
    {
        session_unset();
        session_destroy();
    }
    $mensaje = array("header" => "error","body" => "El nombre de usuario o password es incorrecto");
}
echo json_encode($mensaje);
?>