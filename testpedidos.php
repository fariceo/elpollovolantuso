<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>

        //buscar producbbbto

        function buscar_producto() {
            //alert($("#producto").val());
            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { buscar_producto: $("#producto").val() },
                success: function (result) {
                    $("#ventana_buscador").html(result);
                }
            });


        }

        function add_list(e, f) {
            // alert(e + f);
            var cantidad = prompt("Cantidad");
        }

        function buscar_usuario() {
            //alert($("#producto").val());
            var usuario = $("#usuario").val();

            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { buscar_deudor: usuario, buscar_usuario: 1 },
                success: function (result) {
                    $("#ventana_usuario").html(result);

                }
            });


        }
        function elegir_usuario(e) {

            $("#usuario").val(e);

            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { buscar_deudor: $("#usuario").val(), buscar_usuario: "", pedidos: 1 },
                success: function (result) {
                    $("#ventana_usuario").html(result);

                }
            });
        }
        /*
        function mostrar_lista_pedidos() {

            $.ajax({
                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { mostrar_lista_pedidos: 1 },
                success: function (result) {
                    $("body").html(result);
                }

            });
        }*/

        function ingresar(e, f) {
            //  alert(e + f)

            var cantidad = prompt("cantidad");

            var total = cantidad * f;
            //alert($("#usuario").val()+$("#producto").val()+$("#cantidad").val()+total)
            $.ajax({
                type: "POST",
                url: "testpedidos.php",
                data: { usuario: $("#usuario").val(), producto: e, cantidad: cantidad, precio: f, total: total },
                success: function (result) {

                    // $("body").html(result);
                    //$("body").html(result);

                }


            });


            $.ajax({
                type: "POST",
                url: "asi_sistema/info/procesar2.php",
                data: { producto: e, cantidad: cantidad, restar_stock: 1 },
                success: function (result) {



                }

            });

            $.ajax({

                type: "POST",
                url: "testpedidos.php",
                data: { i: 1 },
                success: function (result) {
                    $("body").html(result);
                    // $("#lista_pedidos").html(result);
                    // $("body").html(result);
                }
            });
        }



        function metodo_pago(e, f, g, h) {



            //fiado
            if (e == 2) {

                alert(" metodo pago " + e + " id : " + f + " usuario : " + g + " fecha : " + h)
                var saldo_pendiente = prompt("Saldo pendiente");

                //if(saldo_pendiente!=NULL && saldo_pendiente!="" && !isNam(saldo_pendiente)){
                $.ajax({

                    type: "POST",
                    url: "asi_sistema/info/procesar.php",
                    data: { metodo_pago: e, id_metodo_pago: f, saldo_pendiente_pago: saldo_pendiente, credito_usuario: g, fecha: h },
                    success: function (result) {
                        // $("body").html(result);
                    }
                });



            }
            //efectivo
            if (e == 1) {
                // alert(" metodo pago " + e + " id : " + f + " usuario : " + g + " fecha : " + h)
                $.ajax({

                    type: "POST",
                    url: "asi_sistema/info/procesar.php",
                    data: { metodo_pago: e, credito_usuario: g, id_metodo_pago: f },
                    success: function (result) {

                    }
                });

            }



            $.ajax({

                type: "POST",
                url: "testpedidos.php",
                data: { metodo_pago: e, id_metodo_pago: f },
                success: function (result) {
                    $("body").html(result);
                }
            });


        }

        function listo(e, f) {

            //alert(e + f);
            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { i: 1, mostrar_lista_pedidos: 1, usuario_pedido: e, productos_pedido: f, cobrar: 1, usuario: 1, negocio: f },
                success: function (result) {
                    //$("body").html(result);
                    // $("#lista_pedidos").html(result);
                    // $("body").html(result);
                }
            });
            $.ajax({

                type: "POST",
                url: "testpedidos.php",
                data: { i: 1 },
                success: function (result) {
                    $("body").html(result);
                    // $("#lista_pedidos").html(result);
                    // $("body").html(result);
                }
            });


            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar2.php",
                data: { pedido_listo: 1, usuario_pedido: e },
                success: function (result) {
                    //$("#lista_pedidos").html(result);
                    //$("#lista_pedidos").html(result);
                }
            });
            //mostrar_lista_pedidos();

        }



        //vaciar la tabla pedidos
        function truncate() {

            $.ajax({

                type: "POST",
                url: "testpedidos.php",
                data: { tabla_pedidos: 1 },
                success: function (result) {
                    $("body").html(result);
                }
            });

        }



    </script>
</head>

<body onload="mostrar_lista_pedidos()">

    <a href="admin">
        <img src="imagenes/logo.jpeg" style="height: 50px;width: 50px">
    </a>
    <br>
    <div style="text-align: center;">
        <a href="asi_sistema/info/pagos"><img src="imagenes/pago.png" style="width: 40px;height: 40px"></a>
    </div>


    <?php
    include("conexion.php");

    ?>
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
    /*acciones de funciones*/
    //insertar producto en carrito
    if ($_POST['producto'] != "") {

        $usuario = ucfirst($_POST['usuario']);
        $insertar_pedido = mysqli_query($conexion, "INSERT INTO pedidos (`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`delivery`,`metodo_pago`,`fecha`,`hora`) VALUES ('$usuario','$_POST[producto]','$_POST[cantidad]','$_POST[precio]','$_POST[total]','0','default','default','$fecha','$hora'
        )");
    }

    //Vaciar tabla pedidos
    
    if ($_POST['tabla_pedidos'] != "") {

        $truncatetable = mysqli_query($conexion, "TRUNCATE TABLE pedidos");
    }
    ?>
    <div style="text-align:center">
        <p>Usuario</p>
        <?php
        if ($_POST['usuario'] == "") {
            ?>
            <input type="text" id="usuario" onKeyup="buscar_usuario()" /><br><br>
            <?php
        } else {
            ?>
            <input type="text" id="usuario" onKeyup="buscar_usuario()" value="<?php echo $_POST['usuario'] ?>" /><br><br>
            <?php
        }
        ?>
        <a id="ventana_usuario"></a>
        <p>Producto</p>
        <input type="text" id="producto" onKeyup="buscar_producto()" />
    </div>



    <a id="ventana_buscador" style="border: 1px solid #000000;border-color: silver;">
        <!--ventana buscador de producto-->

    </a>



    <div style="text-align:center" id="lista_pedidos">

    </div>



    <!--muestra lista de pedidos del carrito en pedidos---->

    <!------ingresar pedido a carrito-->
    <?php




    //if ($_POST['mostrar_lista_pedidos'] != "") {
    



    $musuario = mysqli_query($conexion, "SELECT DISTINCT usuario FROM pedidos WHERE estado!='2' ");
    while ($usuario = mysqli_fetch_array($musuario)) {


        echo "<hr>";
        //echo "<a id='usuario'></a>";
    
        echo "<a style='color:blue'>" . $usuario['usuario'] . "</a>";
        ?>
        <table style="margin-left:auto;margin-right:auto">
            <tr style="margin-left:25%">
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio</th>
                <th>Total</th>
            </tr>

        </table>

        <?php

        // $buscar_compra = mysqli_query($conexion, "SELECT * FROM pedidos WHERE usuario='$usuario[usuario]'");
        $buscar_compra = mysqli_query($conexion, "SELECT * FROM pedidos WHERE estado!=2");
        while ($compra = mysqli_fetch_array($buscar_compra)) {

            if ($compra["usuario"] == $usuario["usuario"]) {

                $total = $compra['cantidad'] * $compra['precio'];
                $totalfinal += $total;

                $id = $compra['usuario'];
                $n = count($compra['producto']);
                $id2 = $usuario['usuario'] . $n;



                ?>


                <table style="margin:auto">

                    <tr>
                        <td style="width:100px">
                            <?php echo $compra['producto'] ?>
                        </td>
                        <td style="width:50px">
                            <?php echo $compra['cantidad'] . " X " ?>
                        </td>
                        <td style="width:50px">
                            <?php echo $compra['precio'] . " = " ?>
                        </td>
                        <td style="width:50px">
                            <?php echo " $ " . $total ?>
                        </td>
                    </tr>

                </table>




                <?php

                //filtro para metodo pago
                /*
                            $arr = array("" . $compra['metodo_pago'] . "");
                            $str = ", " . implode(", ", $arr) . ",";
                            $count = substr_count($str, ' fiado,');
                            echo $str . "<br>";
                            echo $count;
                            */
            }



        }









        ?>

        <table style="margin:auto">
            <tr>
                <td>
                    <!---total fiados-->
                    <?php





                    $total_fiados = mysqli_query($conexion, "SELECT COUNT(metodo_pago) AS met FROM pedidos WHERE usuario='$usuario[usuario]' AND metodo_pago='fiado' AND estado!='2'");

                    $total_fiado = mysqli_fetch_assoc($total_fiados);



                    if ($total_fiado['met'] > 0) {
                        echo $total_fiado['met'];

                        echo "<a style='color:red'>Fiado</a>";
                        $m = mysqli_query($conexion, "UPDATE pedidos SET metodo_pago='fiado' WHERE usuario='$usuario[usuario]'");

                    } else {


                        $metodos_pagos = mysqli_query($conexion, "SELECT * FROM pedidos WHERE usuario='$usuario[usuario]' AND estado!='2'");


                        while ($metodo_pago = mysqli_fetch_array($metodos_pagos)) {


                            $metodo = $metodo_pago['metodo_pago'];




                            if ($metodo_pago['metodo_pago'] == 'default' && $metodo_pago['usuario'] == $usuario['usuario']) {
                                echo $default += count($metodo_pago['metodo_pago']);
                                ?>

                                <a>Efectivo</a><input type="radio"
                                    onclick="metodo_pago(1,'<?php echo $metodo_pago['id'] ?>','<?php echo $usuario['usuario'] ?>','<?php echo $metodo_pago[fecha] ?>')"
                                    name="metodo_pago" />
                                <a>Fiado</a><input type="radio"
                                    onclick="metodo_pago(2,'<?php echo $metodo_pago['id'] ?>','<?php echo $usuario['usuario'] ?>','<?php echo $metodo_pago[fecha] ?>')"
                                    name="metodo_pago" />
                                <?php
                            }

                            if ($metodo == 'efectivo' && $metodo_pago['usuario'] == $usuario['usuario']) {

                                echo "<a style='color:green'>efectivo</a>";
                                $m = mysqli_query($conexion, "UPDATE pedidos SET metodo_pago='efectivo' WHERE usuario='$usuario[usuario]'");


                            }





                        }
                    }

                    ?>


                </td>
            </tr>
            <tr>
                <td>
                    <?php echo "<br>Total : $ "; ?>

                    <?php $total_compras = mysqli_query($conexion, "SELECT SUM(total) AS tot FROM pedidos WHERE usuario='$usuario[usuario]' AND estado!='2'");

                    $total_compra = mysqli_fetch_assoc($total_compras);


                    $total_compra['tot'];
                    echo $t = intval($total_compra['tot']);
                    ?>
                </td>



            </tr>
            <tr>
                <td>
                    <?php
                    echo $fiado;
                    //  echo "<br><button onClick=\"listo('$id','$t')\">$usuario[usuario]</button><br>"; ?>

                    <?php echo "Orden para " . $usuario['usuario'] . " Listo"; ?> <input type="checkbox"
                        onClick="listo('<?php echo $id ?>','<?php echo $t ?>')" />
                </td>
            </tr>
        </table>

        <?php



        // }
    

    }


    ?>
    <hr>

    <br><br>
    <div style="text-align: center">
        <button onClick="truncate()">Borrar tablas</button>
        <br>

    </div>

</body>

</html>




<!--probando codigo--->