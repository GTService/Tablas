<?php
session_start();
require_once($_SERVER['DOCUMENT_ROOT']."/archivos_timbrado/includes/database.php");
$nombre=$_POST['nombre'];
$usuario=$_POST['usuario'];
$password=md5($_POST['password']);
$tipo=$_POST['tipo'];
$ciudad=$_POST['ciudad'];
$insertar=$db->query("insert into usuarios(nombre, usuario, password, tipo, ciudad) values('$nombre','$usuario','$password','$tipo','$ciudad')");
if($insertar)
{
    ob_start();
    include 'mostrar_usuarios.php';
    $pagina = ob_get_clean();
    $mensaje = array("header" => "success","body" => "usuario $usuario creado correctamente", "content" => $pagina);
}
else
{
    ob_start();
    include 'mostrar_usuarios.php';
    $pagina = ob_get_clean();
    $mensaje = array("header" => "error","body" => "el nombre de usuario $usuario ya existe y no puede usarse", "content" => $pagina);
}
echo json_encode($mensaje);
?>