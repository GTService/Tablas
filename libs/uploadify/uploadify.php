<?php
    /*
    Uploadify v2.1.4
    Release Date: November 8, 2010

    Copyright (c) 2010 Ronnie Garcia, Travis Nickels

    Permission is hereby granted, free of charge, to any person obtaining a copy
    of this software and associated documentation files (the "Software"), to deal
    in the Software without restriction, including without limitation the rights
    to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
    copies of the Software, and to permit persons to whom the Software is
    furnished to do so, subject to the following conditions:

    The above copyright notice and this permission notice shall be included in
    all copies or substantial portions of the Software.

    THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
    IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
    FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
    AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
    LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
    OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
    THE SOFTWARE.
    */
    if (!empty($_FILES)) {

        $vehiculo_id = $_POST['id'];

        $max_fotos = 10;

        //Conexion base de datos
        require_once("../../../includes/database.php");

        $result = mysqli_query($con,"SELECT * FROM fotos_vehiculos WHERE id_vehiculo=$vehiculo_id ORDER BY id DESC");

        $num_row = mysqli_num_rows($result);

        if($num_row < $max_fotos){

            $row = mysqli_fetch_array($result);

            $numeracion = intval($row['numeracion']) +1;




            //Guardar foto de vehiculo
            $tempFile = $_FILES['Filedata']['tmp_name'];
            $targetPath = $_SERVER['DOCUMENT_ROOT'] . $_REQUEST['folder'] . '/';

            // Set ext to path
            $ext =  $_FILES['Filedata']['name'];

            $pos = strpos($ext, '.');
            $ext = substr($ext, $pos);
            //echo $ext;


            $targetFile = str_replace('//', '/', $targetPath) . "$vehiculo_id" . "_".$numeracion.$ext;

            move_uploaded_file($tempFile, $targetFile);

            chmod($targetFile, 0755);
            echo "OK";

            $ubicacion = $vehiculo_id .'_'.$numeracion.$ext;

            //Guardar nueva imagen
            mysqli_query($con, "INSERT INTO fotos_vehiculos (
                ubicacion,
                registro,
                activo,
                id_vehiculo,
                numeracion
                ) VALUES (
                '$ubicacion',
                NOW(),
                1,
                $vehiculo_id,
                $numeracion
                )
            ");
            echo $error =  mysqli_errno($con);

        }
        else{
            echo "Solo puede subir ".$max_fotos." todos por auto";
        }



    }
?>