<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="../functions.js"></script>
    <script>

        $(document).ready(function () {



        });
    </script>
</head>

<body>

    <?php
    include("../../../conexion.php");

    ?>




    <!--fecha-->
    <?php
    ini_set('date.timezone', 'America/Guayaquil');


    //echo date("F l h:i");
    
    /*
        setlocale(LC_ALL, "es_ES");
        strftime("%A %d de %B del %Y");
    */
    //$fecha=strftime("%A %d de %B del %Y");
    $fecha = date("Y-m-d");
    //$fecha='2020-01-13';
    $hora = date("G:i");



    ?>

    <!--logo-->
    <a href="../../../admin.php"><img src="../../../imagenes/logo.jpeg" style="height:50px;width:50px"></a>

    <h3 style="text-align:center">Compra de clientes</h3>
    <a id="total_ventas"></a><br>
    <a id="nusuarios"></a>
    <!---buscador-->
    <img src="../../../imagenes/lupa.png" style="width: 20px;height: 20px"><input type="text" id="buscar"
        placeholder="Buscar" onKeyUp="buscar('../procesar.php')" value="<?php echo $_POST['buscar'] ?>" />

    <hr>
    <!---busqueda de ventas --->

    <div style="margin-top:25px" id="expositor">
        <?php
        $buscar_compras_usuarios = mysqli_query($conexion, "SELECT DISTINCT usuario FROM ventas");

        while ($compras_usuario = mysqli_fetch_array($buscar_compras_usuarios)) {





            $buscar_total_compra = mysqli_query($conexion, "SELECT usuario, SUM(total) AS compra_total FROM ventas GROUP BY usuario ORDER BY compra_total DESC");

            if ($compras_usuario['usuario'] == $compras_total['usuario']) {
                while ($compras_total = mysqli_fetch_array($buscar_total_compra)) {


                    ?>

        <table style="margin-left: auto;margin-right: auto;">
            <tr>
                <td>
                    <?php
                    echo $posicion += count($compras_usuario['usuario']);
                    ?>
                    -
                </td>
                <td style="width:200px"
                    onClick="cambiar_nombre_usuario('../procesar.php','<?php echo $compras_total['usuario'] ?>')">
                    <?php echo $compras_total['usuario']; ?>
                </td>
                <td style="width:100px">
                    <?php echo " $ " . round($compras_total['compra_total'], 2); ?>
                </td>
            </tr>

        </table>

        <?php

                $total_ventas += round($compras_total['compra_total'], 2);
                //total numero de usuarios
                $numero_usuarios += count($compras_total['usuario']);
                echo "<script>$(\"#total_ventas\").html('Total Ventas : $ '+$total_ventas)</script>";
                echo "<script>$(\"#nusuarios\").html('Nº usuarios :  '+$numero_usuarios)</script>";
                }



            }








            //echo "<br>" . $compras_usuario['usuario'] . " $ " . $compras_total['compra_total'];
        
            // echo "<br>".$compras_total['compra_total'];
        
            // "SELECT producto, SUM(cantidad_vendida) AS total_vendido FROM ventas GROUP BY producto ORDER BY total_vendido DESC;";
        
            //echo "<br>".$compras_usuario['usuario'];
        


        }
        ?>
    </div>


    <div>

    
    </div>

</body>

</html>