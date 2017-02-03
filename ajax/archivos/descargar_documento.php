<?php
require_once($_SERVER['DOCUMENT_ROOT']."/archivos_timbrado/includes/database.php");
date_default_timezone_set('America/Tijuana');
$file_name = $_GET['file_name'];
$usuario = $_GET['usuario'];
$aux=explode("---",$file_name);

$db->query("insert into bitacora(usuario,archivo,fecha_descarga) values('$usuario','$file_name','".date("Y-m-d H:i:s")."')");
$folder = $_SERVER['DOCUMENT_ROOT']."/archivos_timbrado/archivos/";

header('Content-type: / "multipart"  / "text" ');
header('Content-Disposition: attachment; filename="'.$aux[1].'"');
readfile($folder."/".$file_name);
exit();
?>