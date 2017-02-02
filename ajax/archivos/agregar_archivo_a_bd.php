<?php
date_default_timezone_set('America/Tijuana');
require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
$tipo=$_POST['tipo'];
$anio=$_POST['anio'];
$periodo=$_POST['periodo'];
$nombre=$_POST['nombre'];
$cliente=$_POST['usuario'];
$nombre=$cliente."-".$nombre;
session_start();
$_SESSION['id_aux']=$cliente;

$consulta_archivos=$db->query("select * from archivos_usuarios where nombre='$nombre' union select * from archivos_usuarios where nombre='$nombre'");
if($db->num_rows($consulta_archivos)==0)
{
    if($cliente=="todos")
    {
        $query="insert into archivos_globales(tipo,anio,periodo,nombre,creacion) values('$tipo','$anio','$periodo','$nombre','".date("Y-m-d H:i:s")."')";
    }
    else
    {
        $query="insert into archivos_usuarios(tipo,anio,periodo,nombre,creacion,usuario) values('$tipo','$anio','$periodo','$nombre','".date("Y-m-d H:i:s")."','$cliente')";
    }
    $insertar_archivo=$db->query($query);
    ob_start();
    include 'mostrar_archivos.php';
    $pagina = ob_get_clean();
    if($insertar_archivo)
    {
        $mensaje = array("header" => "success","body" => "el archivo guardado", "content" => $pagina);
    }
    else
    {
        $mensaje = array("header" => "error","body" => "el archivo ya existe, seleccione otro o elimine el existente", "content" => $pagina);
    }
}
else
{
    ob_start();
    include 'mostrar_archivos.php';
    $pagina = ob_get_clean();
    $mensaje = array("header" => "error","body" => "el archivo ya existe, seleccione otro o elimine el existente", "content" => $pagina);
}
echo json_encode($mensaje);
?>