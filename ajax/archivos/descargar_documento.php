<?php
require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
date_default_timezone_set('America/Tijuana');
$file_name = $_GET['file_name'];
$usuario = $_GET['usuario'];
$aux=explode("-",$filename);
$filename=$aux[1];
$db->query("insert into bitacora(usuario,archivo,fecha_descarga) values('$usuario','$file_name','".date("Y-m-d H:i:s")."')");
$folder = $_SERVER['DOCUMENT_ROOT']."/tablas/archivos/";
//$file = "poll-2016-03-02 0847.dat";

// Add a file type check here for security purposes so that nobody can-
// download PHP files or other sensitive files from your server by spoofing this script
header('Content-type: / "multipart"  / "text" ');
header('Content-Disposition: attachment; filename="'.$file_name.'"');
readfile($folder."/".$aux[0].$file_name);
exit();
?>