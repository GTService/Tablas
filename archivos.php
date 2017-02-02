<?php
//ini_set("session.cookie_lifetime",20);
//ini_set("session.gc_maxlifetime",20);
session_start();
if(isset($_SESSION['usuario']))
{
    if($_SESSION['permiso']==1)
    {
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        
        <?php    require_once("includes/plugins.php");?> 
        <script type="text/javascript" src="js/uploadify/swfobject.js"></script>
        <script type="text/javascript" src="js/uploadify/jquery.uploadify.js"></script>
        <script type="text/javascript" src="js/archivos/archivos.js"></script>
        <title>Archivos</title>
    </head>
    <header >
    <?php
        require("menu_admin.php");
    ?>
    </header>
    <body class="nav-md" onload="activeTabChoose(1)">
           <div class="col-md-4">
            <button type="button" class="col-md-4 btn btn-info btnPanel" onclick="abrir_modal('modal_nuevo_archivo')" >
                <i class="fa fa-plus" aria-hidden="true"></i>Agregar archivo
            </button>
           </div>
            <div class="col-xs-2 col-md-12" id="tabla"> 
            <?php
            include("ajax/archivos/mostrar_archivos.php");
            ?>
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
<!-- nuevo usuario -->
<div class="modal fade" id="modal_nuevo_archivo" role="dialog">
    <div class="modal-dialog">

      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title">Nuevo archivo</h4>
        </div>
        <div class="modal-body">
          <form id="subir_archivo" class="form form-horizontal col-md-12" onsubmit="subir_archivo();return false" autocomplete="off">
              <div class="form-group">
               
               
                <!--Nombre-->
                
                <label>Que usuario podrá ver este archivo?</label>
                <div class="input-group margin-bottom-sm">
                  <span class="input-group-addon"><i class="fa fa-eye fa-fw" aria-hidden="true"></i></span>
                        <select name="usuario" class="form-control has-feedback-left validar" id="usuario_archivo" required>
                            <option value=''>selecciona una opcion</option>
                            <option value='todos'>Todos</option>
                            <?php
                            require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
                            $consulta=$db->query("select * from usuarios where tipo!='1';");
                            if($db->num_rows($consulta)>0)
                            {
                                while($fila=$db->fetch_array($consulta))
                                {
                                    echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                                }
                            }
                            ?>
                        </select>
                </div>
              </div>
                <div class="form-group">
                <label>Semanal o mensual?</label>
                <div class="input-group margin-bottom-sm">
                    <span class="input-group-addon"><i class="fa fa-calendar fa-fw" aria-hidden="true"></i></span>
                    <select name="tipo" id="tipo_archivo" class="form-control" required>
                        <?php
                        require_once($_SERVER['DOCUMENT_ROOT']."/tablas/includes/database.php");
                        $consulta=$db->query("select * from tipo_archivo");
                        if($db->num_rows($consulta)>0)
                        {
                            echo "<option value=''>elige una opcion</option>";
                            while($fila=$db->fetch_array($consulta))
                            {
                                echo "<option value='".$fila['id']."'>".$fila['nombre']."</option>";
                            }
                        }
                        else
                        {
                            echo "<option value=''>No hay opciones en la bd</option>";
                        }
                        ?>
                    </select>
                </div>
              </div>
              <div class="form-group">
                <label>de que año es?</label>
                 
                  <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-calendar-o fa-fw" aria-hidden="true"></i></span>
                      <select class="form-control" id="anio_archivo" name="anio" required>
                        <?php
                        for($i=date("Y");$i>(date("Y")-20);$i--)
                        {
                            echo "<option value=".$i.">$i</option>";
                        }
                        ?>
                      </select>
                  </div>
              </div>
              <div class="form-group ">
                <label>periodo</label>
                 
                  <div class="input-group margin-bottom-sm">
                      <span class="input-group-addon"><i class="fa fa-calendar-check-o fa-fw" aria-hidden="true"></i></span>
                      <input name="periodo" type="text" id="periodo_archivo" class="form-control" maxlength="3" value=
                    <?php
                     $periodo=52;
                     $fecha_hoy = new DateTime("2017-05-06");
                     //echo $fecha_hoy->format("Y.m.d");
                     $año_actual=$fecha_hoy->format("Y");
                     $año_actual-=1;
                     $primer_lunes = new dateTime($año_actual."-12-31");
                     $primer_lunes->modify('next monday');
                     $c=0;
                     while($primer_lunes->format("Y-m-d")<=$fecha_hoy->format("Y-m-d")) 
                     {
                         $periodo++;
                         if($periodo==53)
                         {
                             $periodo=1;
                         }
                         $primer_lunes->modify('next monday');
                     }
                     echo "\"".$periodo."\"";
                    ?>>
                  </div>
              </div>
                <div class="form-group">
                <label>Selecciona el archivo</label>
                    <div><input type="file" name="nombre" id="file_upload"></div>
              </div>
              <div id="boton_subir"><button type="submit" class="btn btn-primary col-md-12"> <i class="fa fa-upload" aria-hidden="true"></i> Subir</button></div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" onclick="cancelar_archivo()">Cancelar</button>
        </div>
      </div>

    </div>
</div>