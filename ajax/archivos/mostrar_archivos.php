<table class="table table-bordered table-hover">
    <thead>
        <th>id archivo</th>
        <th>nombre</th>
        <th>tipo</th>
        <th>usuario</th>
        <th>creación</th>
        <th>año</th>
        <th>periodo</th>
        <th>opcion</th>
    </thead>
    <tbody>
<?php
require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
$consulta=$db->query("select a.anio as anio, a.periodo as periodo, a.nombre as nombre, a.id as id, t.nombre as tipo, u.usuario as usuario, a.creacion as creacion 
from usuarios as u inner join archivos_usuarios as a on u.id=a.usuario inner join tipo_archivo as t on a.tipo=t.id");
if($db->num_rows($consulta)>0)
{
    while($fila_archivo=$db->fetch_array($consulta))
    {
        $nombre_aux=explode("-",$fila_archivo['nombre']);
        echo "<tr>";
        echo "<td>".$fila_archivo['id']."</td>";
        echo "<td>".$nombre_aux[1]."</td>";
        echo "<td>".$fila_archivo['tipo']."</td>";
        echo "<td>".$fila_archivo['usuario']."</td>";
        echo "<td>".$fila_archivo['creacion']."</td>";
        echo "<td>".$fila_archivo['anio']."</td>";
        echo "<td>".$fila_archivo['periodo']."</td>";
        echo "<td><button onclick=\"eliminar_archivo('archivos_usuarios','".$fila_archivo['nombre']."')\"><i class='fa fa-eraser' aria-hidden='true'></button></i></td>";
        echo "</tr>";
    }
}
$consulta2=$db->query("select a.anio as anio, a.periodo as periodo, a.nombre as nombre, a.id as id, t.nombre as tipo, a.creacion as creacion from archivos_globales as a inner join tipo_archivo as t on a.tipo=t.id");
if($db->num_rows($consulta2)>0)
{
    while($fila_archivo2=$db->fetch_array($consulta2))
    {
        $nombre_aux=explode("-",$fila_archivo2['nombre']);
        echo "<tr>";
        echo "<td>".$fila_archivo2['id']."</td>";
        echo "<td>".$nombre_aux[1]."(global)</td>";
        echo "<td>".$fila_archivo2['tipo']."</td>";
        echo "<td>Global</td>";
        echo "<td>".$fila_archivo2['creacion']."</td>";
        echo "<td>".$fila_archivo2['anio']."</td>";
        echo "<td>".$fila_archivo2['periodo']."</td>";
        echo "<td><button onclick=\"eliminar_archivo('archivos_globales','".$fila_archivo2['nombre']."')\"><i class='fa fa-eraser' aria-hidden='true'></button></i></td>";
        echo "</tr>";
    }
}
?>
    </tbody>
</table>
