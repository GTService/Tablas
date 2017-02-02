<?php
require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
$id=$_POST['id'];
$tabla=$_POST['tabla'];
$eliminar=$db->query("delete from $tabla where nombre='$id'");
ob_start();
include 'mostrar_archivos.php';
$pagina = ob_get_clean();
if($eliminar)
{
    unlink($_SERVER['DOCUMENT_ROOT']."/tablas/archivos/".$id);
    $mensaje = array("header" => "success","body" => "archivo eliminado", "content" => $pagina);
}
else
{
    $mensaje = array("header" => "error","body" => "el archivo que intenta eliminar no existe", "content" => $pagina);
}
echo json_encode($mensaje);
?>