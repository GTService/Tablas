<?php
if(isset($_SESSION['usuario']))
{
    if($_SESSION['permiso']==0)
    {
?>
<table class="table table-bordered table-hover">
    <thead>
        <th>id archivo</th>
        <th>nombre</th>
        <th>tipo</th>
        <th>creación</th>
        <th>año</th>
        <th>periodo</th>
        <th>opcion</th>
    </thead>
    <tbody>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/archivos_timbrado/includes/database.php");
$consulta=$db->query("select au.id as id, au.nombre as nombre,t.nombre as tipo,au.creacion as creacion,au.periodo as periodo,au.anio as anio from tipo_archivo as t inner join archivos_usuarios as au on t.id=au.tipo inner join usuarios as u on au.usuario=u.id and u.usuario='".$_SESSION['usuario']."' union select ag.id as id, concat(ag.nombre,'(global)') as nombre, t.nombre as tipo, ag.creacion as creacion, ag.periodo as periodo, ag.anio as anio from archivos_globales as ag inner join tipo_archivo as t on ag.tipo=t.id");
if($db->num_rows($consulta)>0)
{
    while($fila_archivo=$db->fetch_array($consulta))
    {
        $nombre_aux=explode("---",$fila_archivo['nombre']);
        echo "<tr>";
        echo "<td>".$fila_archivo['id']."</td>";
        echo "<td>".$nombre_aux[1]."</td>";
        echo "<td>".$fila_archivo['tipo']."</td>";
        echo "<td>".$fila_archivo['creacion']."</td>";
        echo "<td>".$fila_archivo['anio']."</td>";
        echo "<td>".$fila_archivo['periodo']."</td>";
        $nombre_aux2=explode("(global)",$nombre_aux[1]);
        echo "<td><i class='fa fa-download icoButton' onclick=\"descargar('".$nombre_aux[0]."---".$nombre_aux2[0]."','".$_SESSION['usuario']."')\" aria-hidden='true'></i></td>";
        echo "</tr>";
    }
}
?>
    </tbody>
</table>
<?php
    }
    else
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}
?>