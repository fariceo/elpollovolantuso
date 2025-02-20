<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>


    <script>
        $(document).ready(function () {

        });



    </script>
    <title>Historial de credito</title>
</head>

<body>

    <!--fecha-->
    <?php
    ini_set('date.timezone', 'America/Guayaquil');


    //echo date("F l h:i");
    

    setlocale(LC_ALL, "es_ES");
    strftime("%A %d de %B del %Y");

    //$fecha=strftime("%A %d de %B del %Y");
    $fecha = date("Y-m-d");
    //$fecha='2020-01-13';
    $hora = date("G:i");



    ?>

    <?php

    include("../../conexion.php");
    /**/


    if (isset($_POST['fio'])) {
        /*busqueda de la deuda de deudor*/
        $muestra_deuda_usuario = mysqli_query($conexion, "SELECT * FROM saldo_pendiente WHERE usuario='$_POST[usuario_deudor]'");

        while ($deuda_usuario = mysqli_fetch_array($muestra_deuda_usuario)) {


            echo $deuda_pendiente = $deuda_usuario['saldo_pendiente'];




        }
        if ($deuda_pendiente == 0) {
            $deuda_pendiente = 0;
        }

        $deuda = $deuda_pendiente + $_POST['saldo'];
        $actualizar_deuda = mysqli_query($conexion, "UPDATE saldo_pendiente SET saldo_pendiente='$deuda' WHERE usuario='$_POST[usuario_deudor]'");

        $insertar_historial = mysqli_query($conexion, "INSERT INTO `historial_credito` (`usuario`,`saldo`,`saldo_contable`,`fecha`) VALUES ('$_POST[usuario_deudor]','$_POST[saldo]','$deuda','$fecha')");

        $insertar_pedido = mysqli_query($conexion, "INSERT INTO `ventas` (`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`delivery`,`metodo_pago`,`fecha`,`hora`) VALUES ('$_POST[usuario_deudor]','$_POST[mensaje]','1','$_POST[saldo]','$_POST[saldo]','0','default','default','$fecha','$hora')");
        ////insertar registro en el historial_credito.php

        


    }





    if ($_POST[saldo] == 0) {
        $_POST['saldo_contable'] = 0;
        $eliminar_deuda = mysqli_query($conexion, "DELETE FROM historial_credito WHERE usuario='$_POST[usuario_deudor]'");

    }




    ///
    // $insertar_historial = mysqli_query($conexion, "INSERT INTO `historial_credito` (`usuario`,`saldo`,`saldo_contable`,`fecha`) VALUES ('$_POST[usuario_deudor]','$_POST[saldo]','$deuda','$fecha')");
    //INSERT INTO `historial_credito` (`id`, `usuario`, `saldo`, `fecha`) VALUES ('1', 'test', '1', '2023-07-03');
    




    /**/
    //$buscar_historial_credito=mysqli_query($conexion,"SELECT * FROM historial_credito");     
    
    ?>



    <!--corregir cantidad deuda-->
    <?php
    if ($_POST["corregir_deuda"] != "") {

        $corregir_deuda = mysqli_query($conexion, "UPDATE historial_credito SET saldo_contable='$_POST[saldo_corregir]' WHERE id='$_POST[id_deuda]' AND usuario='$_POST[usuario_deudor]'");
    }
    ?>



<!---->


</body>

</html>