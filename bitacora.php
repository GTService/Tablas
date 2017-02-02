<?php
//ini_set("session.cookie_lifetime",20);
//ini_set("session.gc_maxlifetime",20);
session_start();
if(isset($_SESSION['usuario']))
{
    if($_SESSION['permiso']==1)
    {
?>
<html lang="en">
    <head>        
         <?php    require_once("includes/plugins.php");?>
        <script type="text/javascript" src="js/funciones_generales.js"></script>
    </head>
    <header>
    <?php
        require("menu_admin.php");
    ?>
    </header>
    <body>
        <div class="container"> 
            <table class="table table-bordered table-hover">
                <thead>
                        <th>#</th>
                        <th>usuario</th>
                        <th>archivo</th>
                        <th>fecha de  descarga</th>
                </thead>
                <tbody>
                    <?php
                    require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
                    $bitacora=$db->query("select * from bitacora order by fecha_descarga desc");
                    if($db->num_rows($bitacora)>0)
                    {
                        while($fila_bitacora=$db->fetch_array($bitacora))
                        {
                            echo "<tr>";
                            echo "<td>".$fila_bitacora['id']."</td>";
                            echo "<td>".$fila_bitacora['usuario']."</td>";
                            echo "<td>".$fila_bitacora['archivo']."</td>";
                            echo "<td>".$fila_bitacora['fecha_descarga']."</td>";
                            echo "</tr>";
                        }
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </body>
</html>
<?php
    }
    else
    {
        session_unset();
        session_destroy();
        header("Location: login.php");
    }
}
else
{
    session_unset();
    session_destroy();
    header("Location: login.php");
}
?>