<?php
require_once($_SERVER['DOCUMENT_ROOT']."/archivos_timbrado/includes/database.php");
$id=$_POST['id'];
$q=$db->query("select * from archivos_usuarios where usuario='$id'");
if($db->num_rows($q)==0)
{
    $eliminar=$db->query("delete from usuarios where id='$id'");
    ob_start();
    include 'mostrar_usuarios.php';
    $pagina = ob_get_clean();
    if($eliminar)
    {
        $mensaje = array("header" => "success","body" => "usuario eliminado", "content" => $pagina);
    }
    else
    {
        $mensaje = array("header" => "error","body" => "el usuario que intenta eliminar no existe", "content" => $pagina);
    }
}
else
{
    ob_start();
    include 'mostrar_usuarios.php';
    $pagina = ob_get_clean();
    $mensaje = array("header" => "error","body" => "no se puede eliminar a este usuario porque tiene archivos relacionados a el", "content" => $pagina);
}
echo json_encode($mensaje);
?>