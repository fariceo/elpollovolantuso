<?php //include("conexion_merchanica.php"); 
session_start(); ?>
<?php
include("conexion_merchanica.php");

?>


<?php
/*
if ($_POST['a'] != "") {

    $buscar_cobros = mysqli_query($conexion22, "SELECT * FROM saldo_pendiente");

    while ($cobros = mysqli_fetch_array($buscar_cobros)) {



        ?>


        <table style="margin:auto">
            <tr>
                <td style="width:150px;text-indent: -10px"><?php echo $cobros["usuario"]; ?></td>

                <td><?php echo " $ " . $cobros["saldo_pendiente"]; ?></td>
            </tr>


        </table>

        <?php

    }
}
*/
?>


<!doctype html>
<html>

<head>

    <title>Pagos</title>
    <meta charset="UTF-8">

    <meta charset="UTF-8" name="viewport" content="width=device-width">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="funciones_merchanica.js"></script>
    <script>


        $(document).ready(function () { });



    </script>


    <title>administracion</title>


    <style>
        table {
            //display: inline-table;


        }

        .tabla_menu td {
            border: groove;
            background: green;
        }

        .expositor {
            width: 350px;
            height: 100%;
            background: #F5F7D2;
            margin: auto;

        }
    </style>
</head>



<!--fecha-->
<?php


ini_set('date.timezone', 'America/Guayaquil');


//echo date("F l h:i");


setlocale(LC_ALL, "es_ES");
strftime("%A %d de %B del %Y");

//$fecha=strftime("%A %d de %B del %Y");
$fecha = date("Y-m-d");
//$fecha='2020-01-13';
$hora = date("G:i:s");



?>

<body>

<!--<h4 style="text-align: center;color:white;background:black">Cobros & Pagos</h4>-->

    <!--acciones de sistema-->
    <div>

        <?php



        //eliminar deuda
        if ($_POST['id_deuda'] != "") {

            $eliminar_deuda = mysqli_query($conexion2, "DELETE FROM saldo_pendiente WHERE id='$_POST[id_deuda]'");


        }

        /*nuevo deudor*/
        echo $_POST['cantidad_deuda'];
        if ($_POST["usuario_deudor"] != "") {

            $nueva_deuda = mysqli_query($conexion2, "INSERT INTO `saldo_pendiente` (`usuario`,`saldo_pendiente`,`accion`,`fecha`,`hora`) VALUES('$_POST[usuario_deudor]','$_POST[cantidad_deuda]','0','$fecha','$hora')");

        }

        if ($_POST['accion'] != "") {

            $cambiar_accion = mysqli_query($conexion2, "UPDATE saldo_pendiente SET accion='$_POST[accion]' WHERE usuario='$_POST[usuario_deudor]'");
        }





        ?>

    </div>


    <!--informacion de dinero del negocio-->
    <div>

        <?php

        $mostrar_caja = mysqli_query($conexion2, "SELECT * FROM finanzas");

        while ($caja = mysqli_fetch_array($mostrar_caja)) {

            $saldo = $caja['negocio'];
        }


        ?>
        <!--<p>Saldo : $-->
            <?php echo $saldo; ?>
            <!---buscador-->
           <!-- <img src="../../imagenes/lupa.png" style="width: 20px;height: 20px"><input type="text" id="buscar_deudor"
                placeholder="Buscar" onKeyUp="buscar_deudor()" value="<?php echo $_POST['buscar_deudor'] ?>" />-->
     <!--   </p>-->
    </div>


    <!--<a href="../../pedidos.php"><img src="../../imagenes/orden.png" style="height:30px;width:30px"></a>-->

   <!-- <a style="color: blue;margin-left: 25px" href="info_ventas"> <a href="info_ventas.php"><img
                src="../../imagenes/historial.png" style="height:30px;width:30px"></a></a>-->
    <!--saldo por cobrar-->

    <?php

    $muestra_saldo_cobrar = mysqli_query($conexion2, "SELECT * FROM saldo_pendiente");

    while ($saldo_pendiente = mysqli_fetch_array($muestra_saldo_cobrar)) {


        if ($saldo_pendiente['accion'] == 1) {

            $saldo_cobrar_ += $saldo_pendiente['saldo_pendiente'];
        }

        if ($saldo_pendiente['accion'] == 2) {

            $saldo_pagar_ += $saldo_pendiente['saldo_pendiente'];
        }

    }



    echo "<a style='color: #AABE2B' href='asi_sistema/info/administracion_financiera'\">cobrar $ " . $saldo_cobrar_ . "</a> / ";
    echo " <a style='color:red'  href='asi_sistema/info/administracion_financiera'\">Deuda ---  $ " . $saldo_pagar_ . "</a> / ";

    ?>
    <br>
    <hr>


    <hr>
    <div class="expositor">





        <!--credito-->

        <?php

        ?>

        <?php
        $credito = mysqli_query($conexion2, "SELECT * FROM saldo_pendiente ORDER BY saldo_pendiente DESC");

        while ($muestra_credito = mysqli_fetch_array($credito)) {

            ?>

            <table>
                <tr style="padding-top: 35px">
                    <td style="width: 75px;" onClick="ver_historial_credito('<?php echo $muestra_credito['usuario'] ?>')">
                        <?php echo $muestra_credito['usuario']; ?>
                    </td>

                    <!--actualizar saldo de deuda-->
                    <td style="width: 50px;"
                        onClick="actualizar_cantidad('<?php echo $muestra_credito['usuario'] ?>','<?php echo $muestra_credito['saldo_pendiente'] ?>','<?php echo $fecha ?>')">
                        <?php echo " $ " . $muestra_credito['saldo_pendiente']; ?>
                    </td>

                    <!--accion-->
                    <td style="width: 50px" onClick="accion('<?php echo $muestra_credito['usuario'] ?>')">
                        <?php

                        if ($muestra_credito['accion'] == 0) {
                            echo "<a style='color:blue'>No accion</a>";
                        }



                        if ($muestra_credito['accion'] == 1) {
                            echo "<a style='color:green'>Cobrar</a>";
                        }

                        if ($muestra_credito['accion'] == 2) {
                            echo "<a style='color:red'>Pagar</a>";
                        }
                        ?>


                    </td>
                    <!--eliminar_deudas-->
                    <td style="width:50px;padding-top: 20px"><button style="color: red;margin-left: 50px;"
                            onClick="eliminar_deuda('<?php echo $muestra_credito['id'] ?>','<?php echo $muestra_credito['usuario'] ?>','<?php echo $fecha ?>')">X</button>
                    </td>

                </tr>


            </table>




            <?php
        }

        echo "<table><tr><td><input type='text' id='deudor'/></td><td><button onClick=\"nueva_deuda('$fecha')\">Intro</button></td></tr></table>";


        ?>


    </div>



</body>

</html>