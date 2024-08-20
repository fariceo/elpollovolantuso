<!doctype html>
<html>

<head>
    <meta charset="UTF-8">
    <meta charset="UTF-8" name="viewport" content="width=device-width">

    <title>pedidos</title>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>



        function ingresar() {

            var total = $("#cantidad").val() * $("#precio").val();
            //alert($("#usuario").val()+$("#producto").val()+$("#cantidad").val()+total)
            $.ajax({
                type: "POST",
                url: "pedidos.php",
                data: { usuario: $("#usuario").val(), producto: $("#producto").val(), cantidad: $("#cantidad").val(), precio: $("#precio").val(), total: total },
                success: function (result) {

                    $("body").html(result);
                }

            });
        }

        function cambiar_fecha(e) {
            var fecha = prompt("cambiar fecha " + e);

            $.ajax({

                type: "POST",
                url: "pedidos.php",
                data: { fecha: fecha, id_fecha: e },
                success: function (result) {

                    $("body").html(result);
                }
            })
        }

        //vaciar la tabla pedidos
        function truncate() {

            $.ajax({

                type: "POST",
                url: "pedidos.php",
                data: { tabla_pedidos: 1 },
                success: function (result) {
                    $("body").html(result);
                }
            });

        }

        function listo(e, f) {
            //	alert(f);
            $.ajax({

                type: "POST",
                url: "pedidos.php",
                data: { pedido_listo: 1, id_pedido: e },
                success: function (result) {
                    $("body").html(result);
                }
            });

            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { usuario: 1, cobrar: 1, negocio: f },
                success: function (result) {
                    //$("body").html(result);
                }
            });

        }

        //buscar producto

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
        /*

        function buscar_usuario() {

            //alert($("#producto").val());
            var usuario = $("#usuario").val();

            // var texto = $('#texto').text();
            var textoConMayuscula = usuario.charAt(0).toUpperCase() + usuario.slice(1);
            $('#usuario').val(textoConMayuscula);

            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { buscar_deudor: usuario, buscar_usuario: 1 },
                success: function (result) {
                    $("#ventana_usuario").html(result);

                }
            });

        }
*/

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
        function outfocus() {
            ///	$("#ventana_usuario").html("");
        }

        function metodo_pago(e, f, g, h) {
            //alert(e+f+g+h);
            //alert(h);

            //fiado
            if (e == 2) {

                //alert(f);
                var saldo_pendiente = prompt("Saldo pendiente");

                //if(saldo_pendiente!=NULL && saldo_pendiente!="" && !isNam(saldo_pendiente)){
                $.ajax({

                    type: "POST",
                    url: "asi_sistema/info/procesar.php",
                    data: { metodo_pago: e, id_metodo_pago: f, saldo_pendiente_pago: saldo_pendiente, credito_usuario: g, fecha: h },
                    success: function (result) {

                    }
                });



            }
            //efectivo
            if (e == 1) {

                $.ajax({

                    type: "POST",
                    url: "asi_sistema/info/procesar.php",
                    data: { metodo_pago: e, id_metodo_pago: f },
                    success: function (result) {

                    }
                });

            }



            $.ajax({

                type: "POST",
                url: "pedidos.php",
                data: { metodo_pago: e, id_metodo_pago: f },
                success: function (result) {
                    $("body").html(result);
                }
            });
        }



        function elegir_usuario(e) {

            $("#usuario").val(e);

            $.ajax({

                type: "POST",
                url: "asi_sistema/info/procesar.php",
                data: { buscar_deudor: $("#usuario").val(), buscar_usuario: 2 },
                success: function (result) {
                    $("#ventana_usuario").html(result);
                    $("#ventana_usuario").html("");

                }
            });
        }

        /*almacen de products temporales antes de agregar al carrito de usuario */
        function sumar() {
            //alert(e);

            var tot = 0;

            for (x of algo) {
                // tot=tot+x.precio;
                tot = tot + x.total;

            }

            //if(tot!=0 || tot!="Null" || tot!=""){
            document.getElementById('total').innerHTML = "Total : $ " + tot;
            //}

        }
        const algo = [];

        var cant = 0;
        function add_list(e, f) {
            //alert(e+f)	
            var producto = e;
            var precio = parseFloat(f);
            var cantidad = parseFloat($("#id" + cant).val());
            var total = precio * cantidad;

            algo.push({
                "id": cant,
                "producto": producto,
                "cantidad": cantidad,
                "precio": precio,
                "total": total
            });
            //var calculo=precio*cantidad;

            var id_row = 'row' + cant;
            var id_cantidad = 'id' + cant;
            var total_producto = 'total_producto' + cant;
            var fila = '<tr id=' + id_row + '><td>- ' + producto + '</td><td> $ ' + precio + '</td><td> X cantidad : <input type="text" style="width:15px" id=' + id_cantidad + ' onchange="cantidad(' + cant + ')" placeholder="cantidad"/> = </td><td id=' + total_producto + '>' + total_producto + '</td><td onclick="quitar(' + cant + ')">X</td><tr>';

            //document.getElementById('lista').insertRow(-1).innerHTML = '<tr id='+id_row+'><td>'+id_row+producto+'</td><td>'+precio+'</td><td onclick="quitar('+cant+')">X</td><tr>';
            //agregar a la tablass 
            $("#lista").append(fila);
            $("#producto").focus();
            //$("#producto").val('');

            cant++;
            sumar();
            cantidad();

            var expor = algo;

            $("#producto").val(expor);

        }





        function quitar(row) {
            ///remover la fila de la tabla
            $("#row" + row).remove();

            //eliminar del array

            var i = 0;
            var posision = 0;
            for (x of algo) {
                if (x.id == row) {
                    posision = i;
                }
                i++;
            }
            algo.splice(posision, 1);
            sumar();
            //add_list();

        }

        function cantidad(row) {

            //alert(row,e)
            //var canti=parseFloat(prompt('cantidad'));
            var canti = $("#id" + row).val();
            //alert(canti+'-----'+row);
            algo[row].cantidad = canti;
            algo[row].total = algo[row].cantidad * algo[row].precio;

            var calculo = algo[row].total;

            $("#id" + row).val(canti);
            $("#total_producto" + row).html(calculo);

            //document.getElementById('total').innerHTML="Total : $ "+tot;
            /*codgo para cambiar desde la propia fila de tabla
            var filaid=document.getElementById("row"+row);
            celda=filaid.getElementByTagName('td');
            celda[2].innerHTML=canti;
            celda[3].innerHTML=algo[row].total;

            */


            sumar();
            //alert(calculo);
        }
    </script>
</head>
<style>
    #pedidos td {
        border: groove;

    }
</style>

<body>
    <?php
    error_reporting(0);
    session_start();
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
        $insertar_pedido = mysqli_query($conexion, "INSERT INTO pedidos (`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`delivery`,`metodo_pago`,`fecha`,`hora`) VALUES ('$usuario','$_POST[producto]','$_POST[cantidad]','$_POST[precio]','$_POST[total]','0','default','default','$fecha','$hora')");
    }


    if ($_POST['id_fecha'] != "") {

        $fecha_actual = mysqli_query($conexion, "UPDATE pedidos SET fecha='$_POST[fecha]' WHERE id='$_POST[id_fecha]'");
    }


    //Vaciar tabla pedidos
    
    if ($_POST['tabla_pedidos'] != "") {

        $truncatetable = mysqli_query($conexion, "TRUNCATE TABLE pedidos");
    }


    //pedido listo
    
    if ($_POST['pedido_listo'] != "") {


        $pedido_listo = mysqli_query($conexion, "UPDATE pedidos SET estado='3'  WHERE id='$_POST[id_pedido]'");

        $eliminar_pedido_listo = mysqli_query($conexion, "DELETE FROM pedidos WHERE id='$_POST[id_pedido]'");
    }
    ?>

    <a href="admin">
        <img src="imagenes/logo.jpeg" style="height: 50px;width: 50px">
    </a>

    <br>
    <div style="text-align: center;">

        <a style="color: blue;margin-left: 25px" href="asi_sistema/info/info_ventas.php"><img
                src="../../imagenes/historial.png" style="height:30px;width:30px;padding-right:20px"></a>
        <a href="asi_sistema/info/pagos"><img src="imagenes/pago.png" style="width: 40px;height: 40px"></a>
    </div>


    <!--tabla ingresar pedidos-->
    <div style="background:#FCF3CF">
        <h3 style="text-align: center">Ingresar pedidos</h3>
        <table style="margin-left: auto;margin-right: auto">

            <!--ventana buscador de producto-->
            <tr>

                <td>Usuario : </td>
                <td> <?php
                if ($_POST['usuario'] == "") {
                    ?>
                        <input type="text" id="usuario" onKeyup="buscar_usuario()" />
                        <?php
                } else {
                    ?>
                        <input type="text" id="usuario" onKeyup="buscar_usuario()"
                            value="<?php echo $_POST['usuario'] ?>" />
                        <?php
                }
                ?>
                </td>

            </tr>



            <tr>

                <td></td>
                <td id="ventana_usuario"></td>
            </tr>

            <tr>

                <!--ventana que muestra producto--->
                <td>Producto</td>
            </tr>


            <tr>
                <td id="ventana_lista_productos"></td>
            </tr>


            <tr>
                <td></td>
                <td><input type="text" id="producto" onKeyup="buscar_producto()" /></td>
            </tr>

            <!--lista de productos agregados--->
            <tr>
                <td></td>
            </tr>


            <tr>

                <td></td>
                <td id="ventana_buscador"
                    style="width: 150px;border: 1px solid #000000;border-color: silve;background:#D4CFCF">
                    <!--ventana buscador de producto-->

                </td>
            </tr>


            <tr>
                <td>cantidad</td>
                <td><input type="text" id="cantidad" /></td>
            </tr>

            <tr>
                <td>precio</td>
                <td><input type="text" id="precio" /></td>
            </tr>


            <tr>
                <td style="color: white"></td>
            </tr>
            <td></td>
            <td style="text-align: center"><button onClick="ingresar()">intro</button></td>
            </tr>
        </table>

        <table id="lista">
            <tr>
                <td id="total"></td>
            </tr>

        </table>


        <!--informacion monetaria intradia--->
        <p style="text-align:center"><a id="total_efectivo" Style="color:green"></a><a id="total_fiado"
                style="color:red;margin-left:20px"></a><a id="total" style="margin-left:20px"></a></p>
    </div>
    <script>

        function ingresar() {

            var total = $("#cantidad").val() * $("#precio").val();
            //alert($("#usuario").val()+$("#producto").val()+$("#cantidad").val()+total)
            $.ajax({
                type: "POST",
                url: "pedidos.php",
                data: { usuario: $("#usuario").val(), producto: $("#producto").val(), cantidad: $("#cantidad").val(), precio: $("#precio").val(), total: total },
                success: function (result) {

                    $("body").html(result);
                }

            });
        }
    </script>

    <hr>
    <br>


    <!--informacion financiera de pedidos fiados +++++++++++++++++++++++++++++++++++++++++++-->
    <div>
        <?php
        $buscar_productos_fiados = mysqli_query($conexion, "SELECT * FROM historial_credito WHERE fecha='$fecha' ");
        //$buscar_productos_fiados=mysqli_query($conexion,"SELECT * FROM historial_credito ");
        
        while ($productos_fiados = mysqli_fetch_array($buscar_productos_fiados)) {

            $saldo_fiado += $productos_fiados['saldo'];
        }


        ?>

    </div>



    <!--Despliegue de listado de pedidos realizados-->
    <?php

    $muestra_pedidos = mysqli_query($conexion, "SELECT * FROM pedidos WHERE estado!='2'");

    while ($pedidos = mysqli_fetch_array($muestra_pedidos)) {
        ?>

        <table style="margin:0 auto">
            <tr style="">

                <td style="width:  100px;color: blue">
                    <?php echo $pedidos['usuario'] ?>
                </td>


                <td style="width:  250px;">
                    <?php echo $pedidos['producto'] ?>
                </td>
                <td style="width:  50px;">
                    <?php echo " $ " . $pedidos['total'] ?>
                </td>
                <!--<td style="width:  30px"><?php // echo $pedidos['cantidad']                            ?></td>-->

                <td><input type="checkbox"
                        onClick="listo('<?php echo $pedidos['id'] ?>','<?php echo $pedidos['total'] ?>')" />
                </td>


                <?php
                // total efectivo
                if ($pedidos['metodo_pago'] == 'efectivo') {
                    $total_efectivo += $pedidos['total'];

                }

                //total fiado
                if ($pedidos['metodo_pago'] == 'fiado') {
                    $total_fiado += $pedidos['total'];

                }
                /// total
            
                $total += $pedidos['total'];
                ?>
            </tr>
            <tr>
                <td></td>
            </tr>
            <tr>

                <td onClick="cambiar_fecha('<?php echo $pedidos['id'] ?>')" style="30px">
                    <?php echo $pedidos['fecha'] ?>
                </td>

                <!---metodo de pago-->
                <td>
                    <?php
                    if ($pedidos['metodo_pago'] == 'default') {

                        ?>
                        <a>Efectivo</a><input type="radio" onclick="metodo_pago(1,'<?php echo $pedidos['id'] ?>')"
                            name="metodo_pago" />
                        <a>Fiado</a><input type="radio"
                            onclick="metodo_pago(2,'<?php echo $pedidos['id'] ?>','<?php echo $pedidos['usuario'] ?>','<?php echo $pedidos['fecha'] ?>')"
                            name="metodo_pago" />
                        <?php

                    }
                    ?>

                    <?php
                    if ($pedidos['metodo_pago'] == 'efectivo') {
                        ?>
                        <a style="color:green">Efectivo</a>

                        <?php
                    }
                    ?>

                    <?php
                    if ($pedidos['metodo_pago'] == 'fiado') {
                        ?>
                        <a style="color:red">Fiado</a>
                        <?php
                    }
                    ?>

                </td>

            </tr>
        </table>
        <?php
    }
    echo "<script>$(\"#total_efectivo\").html('Efectivo : $ '+$total_efectivo);</script>";
    $total_fiado = $saldo_fiado;
    echo "<script>$(\"#total_fiado\").html('Fiado : $ '+$total_fiado);</script>";
    echo "<script>$(\"#total\").html('Total : $ '+$total);</script>";

    ?>



    <br><br>
    <div style="text-align: center">
        <button onClick="truncate()">Borrar tablas</button>
    </div>


</body>

</html>



<?php
/*Codigo de reinicio de id sql*/

/*
       SET  @num := 0;

   UPDATE bodega_asiyasao SET id = @num := (@num+1);

   ALTER TABLE bodega_asiyasao AUTO_INCREMENT =1;
   
   
   */
?>