<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8" name="viewport" content="width=device-width">
    <title>Documento sin tÃ­tulo</title>


    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {



        });


        //$insertar_pedido=mysqli_query($conexion,"INSERT INTO menu (`categoria`,`seccion`,`producto`,`raciones`,`precio`,`estado`,`img`) VALUES ('$_POST[seccion]','$_POST[seccion]','$_POST[nuevo_plato]','0','$_POST[precio]','1','$_POST[img]')"); 






        function subir_imagenes(e) {
            //alert("producto "+$("#nuevo_plato").val());
            var producto = $("#nuevo_plato").val();
            /// alert(producto);
            /*
            $.ajax({
                type: "POST",
                url: "subir_img.php",
                data: { producto: producto },
                success: function (result) {
                    //$("body").html(result);

                }


            });

*/
        }


        function nuevo_plato(e) {
            // alert(e)
            var precio = prompt("precio para " + $("#nuevo_plato").val());

            var seccion = prompt("especifica la seccion");

            // alert($("#nuevo_plato").val());

            $.ajax({
                type: "POST",
                url: "subir_img.php",
                data: { nuevo_plato: $("#nuevo_plato").val(), precio: precio, seccion: seccion, categoria: seccion, img: e },
                success: function (result) {
                    $("body").html(result);
                    //$("form").css("display","block");
                    //$("body").load("../menu_cocina.php");

                }


            });
        }
    </script>
</head>
<style>


</style>

<body>


    <?php

    session_start();
    include("../conexion.php");
    error_reporting(0);
    //ini_set('display_errors', 'On');
    





    ?>
    <br>
    <a href="../index.php"><img src="logo.jpeg" style="height:40px;width:40px"></a>



    <br>





    <?php

    if ($_POST['nuevo_plato'] != "") {

        //$insertar_pedido=mysqli_query($conexion,"INSERT INTO menu (`categoria`,`seccion`,`producto`,`raciones`,`precio`,`estado`,`img`) VALUES ('$_POST[seccion]','$_POST[seccion]','$_POST[nuevo_plato]','0','$_POST[precio]','1','$_POST[img]')"); 
    
        $insertar_pedido = mysqli_query($conexion, "INSERT INTO `menu` (`categoria`, `seccion`, `producto`, `raciones`, `precio`, `estado`,`detalles`,`tiempo_aprox`, `img`) VALUES ('$_POST[seccion]','$_POST[seccion]','$_POST[nuevo_plato]', '1', '$_POST[precio]', '1', 'default','00','$_POST[img]');
        ");


    }



    echo $_POST['nuevo_plato'] . " " . $_POST['seccion'] . " " . $_POST['categoria'] . " " . $_POST['precio'] . " " . $_POST['img'];
    ?>



    <!--acciones de subir imagen-->
    <?php

    $nombre = $_FILES['archivo']['name'];
    $guardado = $_FILES['archivo']['tmp_name'];

    $tipo_imagen = $_FILES['archivo']['type'];
    $tamano_imagen = $_FILES['archivo']['size'];
    //$destino=$_SERVER['DOCUMENT_ROOT'].'/var/www/mercandoxxi/archivos_php/asi/imagenes/';
    



    /*condicion para subir imagen . TamaÃ±o y tipo de imagen*/

    //if($tamano_imagen<=1000000){
    if ($tipo_imagen == "image/jpeg" || $tipo_imagen == "image/jpg" || $tipo_imagen == "image/gif" || $tipo_imagen == "image/png") {
        $destino = '/var/www/elpollovolantuso/imagenes/';

        $guardar_archivo = move_uploaded_file($guardado, $destino . $nombre);
    }
    /*
     if($tamano_imagen!=1000000){
             
             if($tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpeg" || $tipo_imagen=="image/jpg" || $tipo_imagen=="image/gif" || $tipo_imagen=="image/png" ){
             $destino='/var/www/mercandoxxi/archivos_php/asi/imagenes/';
             
             $guardar_archivo=move_uploaded_file($guardado, $destino.$nombre);
         
                 //Nuevo plato en el manu
     
                     
             
     }else{
         
     echo "<br>Solo se pueden subir imagenes de tipo png / jpeg / jpg / gif";
             }
     }else{
         
         echo "<br>el tamaÃ±o del archivo es demasiado grande";
     }
     
     */
    /*
       
       if(move_uploaded_file($guardado,$destino.$nombre)){
                       echo "<br>archivo guardado con exito";
           
                   
                   }else{
                       
                       echo "<br>archivo no se pudo guardar";
           
                       echo "<br>".$nombre." nombre imagen <br>";
                       echo "<br>producto / ".$_POST['producto']."<br>";
               //$img_nombre=mysqli_query($conexion,"UPDATE menu SET img='$nombre' WHERE producto='madera'");
                   }
       
       
       */







    /*
               if(!file_exists('archivos')){
                   mkdir('archivos',0777,true);
                   if(file_exists('archivos')){
                       //move_uploaded_file($_FILES['pdf']['tmp_name'],"/var/www/html/docs/"."$nombreImagen".".pdf");
                       if(move_uploaded_file($guardado, '/var/www/mercandoxxi/archivos_php/asi/imagenes/'.$nombre)){
                           echo "archivo guardado con exito";
                       }else{
                           echo "archivo no se pudo guardar";
                       }
                   }
               }else{
                   if(move_uploaded_file($guardado, '/var/www/mercandoxxi/archivos_php/asi/imagenes/'.$nombre)){
                       echo "archivo guardado con exito";
                   }else{
                       
                       echo "archivo no se pudo guardar";
                   }
                   
                   
               }*/
    ?>




    <?php
    //if($nombre!="" && $_POST['img']==""){
    ?>

    <form action="subir_img.php" method="post" enctype="multipart/form-data">

        <input type="file" name="archivo" />

        <!--<input type="submit"/>-->
        <button onClick="subir_imagenes()"> subir archivo</button>

    </form>

    <?php // } ?>




    <!--muestra de imagen servidor-->
    <div>
        <?php

        if ($nombre != "" && $_POST['img'] == "") {
            ?>
            <a><img src="../imagenes/<?php echo $nombre ?>"></a>

            <br>
            Agregar nombre del Plato:<input type="text" id="nuevo_plato" /><button
                onClick="nuevo_plato('<?php echo $nombre ?>')">Agregar</button>




            <br>
            <?php
        }
        ?>

    </div>




    <?php
    /*
       Permisos para subir archivos remotamente al sevidor apache
           sudo chown apache:apache /var/www/mercandoxxi/archivos_php/asi/imagenes
           sudo chown www-data:www-data /var/www/dennis-php-ejemplos/uploads
           sudo chmod 755 /var/www/mercandoxxi/asi/imagenes/
           
           
           ///version funcional
           - Cambia el propietario por www-data:
               sudo chown www-data /var/www/html/testsite/
           - Cambia el grupo de usuario del directorio:
               sudo chgrp www-data /var/www/html/testsite/
               
           - Configura los permisos adecuados (lectura, escritura y ejecuciÃ³n para usuario y grupo, sÃ³lo lectura y ejecuciÃ³n para el resto):
               sudo chmod ug+w /var/www/html/testsite/
               
           - Asigna el â€œsticky bitâ€ para el grupo (para que los archivos y directorios que se creen arrastren la propiedad del grupo www-data):
               sudo chmod g+s /var/www/html/testsite/
               
           - Asigna los permisos por defecto (para que los directorios que se creen arrastren los mismos permisos):
               sudo setfacl -d -m g::rwx /var/www/html/testsite/
           
           - Ahora agrega tantos usuarios como necesites que puedan acceder en tu servidor web (en mi caso el usuario victor):
               sudo usermod -a -G www-data victor 
           
            
       */
    ?>










</body>

</html>
