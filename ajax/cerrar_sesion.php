<?php
session_start();
if(isset($_SESSION['usuario']))
{
    session_unset();
    session_destroy();
}
$mensaje = array("header" => "soccess","body" => "Adios");
echo json_encode($mensaje);
?>