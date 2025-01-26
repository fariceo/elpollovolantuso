<meta charset="UTF-8">
<meta charset="UTF-8">
<meta charset="UTF-8" name="viewport" content="width=device-width">
<?php
session_start();
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script>

    $(document).ready(function () {

        let lastScrollTop = 0;  // Variable para almacenar la posición del scroll anterior

        $("#muestra_menu").scroll(function () {
            let currentScrollTop = $("#muestra_menu").scrollTop();  // Obtener la posición actual del scroll

            if (currentScrollTop < lastScrollTop) {
                // Scroll hacia arriba
                $("#categorias").fadeIn();  // Mostrar el div
                $("#encabezado").fadeIn();  // Mostrar el div
                $("#footer").fadeIn();  // Mostrar el div

                // $('#footer').css('opacity','0');

            } else {
                // Scroll hacia abajo
                $("#categorias").fadeOut();  // Ocultar el div
                $("#encabezado").fadeOut();  // Ocultar el div
                $("#footer").fadeOut();  // Ocultar el div
            }

            lastScrollTop = currentScrollTop;  // Actualizar la posición del scroll anterior
        });


        setInterval(function () {
            // Aquí va el código que deseas ejecutar continuamente

            var usuario = $("#usuario").val();

            $.ajax({

                type: 'POST',
                //url:'menu_clientes.php',
                url: 'asi_sistema/info/procesar2.php',
                data: { articulos: 1, articulos_usuario: usuario },
                success: function (result) {
                    $("#n_articulos").html(result);
                    //$("#menu_carta").css("display","none");
                }

            });


        }, 2000);



        // var contenidoCargado = false; // Para evitar cargar el contenido varias veces
        //$("#footer").css('opacity', '0');


        $(window).scroll(function () {
            var divPos = $('#footer').offset().top; // Posición del div
            var divHeight = $('#footer').outerHeight(); // Altura del div
            var windowHeight = $(window).height(); // Altura de la ventana
            var scrollPos = $(window).scrollTop(); // Posición de desplazamiento actual

            // Verificar si el div ha llegado a la mitad de la pantalla
            // if (scrollPos + windowHeight / 2 >= divPos + divHeight / 2 && !contenidoCargado) {
            if (scrollPos + windowHeight / 2 >= divPos + divHeight / 2) {
                // contenidoCargado = true; // Evitar que se vuelva a cargar
                console.log('El div ha llegado a la mitad de la pantalla.');

                // Cargar más contenido o incluir un documento
                //  $('#footer').css('opacity','1');


                // Ejemplo: cargar contenido desde un documento externo (por ejemplo, 'contenido.html')
                // $('#footer').load('contenido.html');
            }
        });

        ///////////

    });



    function categorias_menu(e, f) {
        //alert(e)


        $.ajax({
            type: 'POST',
            //url:'menu_clientes.php',
            url: 'index.php',
            data: { categoria: e, usuario: f },
            success: function (result) {
                $("body	").html(result);
                //$("#menu_carta").css("display","none");
                $("#categorias").fadeOut();

                $("#encabezado").fadeOut();  // Ocultar el div
                // $("#footer").fadeOut();  // Ocultar el div
            }

        });
    }



    function agregar(e, f, g, h) {
        //alert (e+f);

        if ($("#usuario").val() == "") {

            alert("Debes Introducir un ID de pedido para el localizador");
            //prompt("<?php echo $usuario_anonimo; ?>");
        } else {


            var cantidad = prompt("introduce cantidad para " + e);


            //alert(e+f+g+h)
            var total = g * cantidad;
            $.ajax({
                type: "POST",
                url: "index.php",
                data: { usuario: f, producto: e, cantidad: cantidad, precio: g, categoria: h, total: total },
                success: function (result) {
                    $("body").html(result);

                }


            });


            $.ajax({
                type: "POST",
                url: "asi_sistema/info/procesar2.php",
                data: { producto: e, cantidad: cantidad, restar_stock: 1 },
                success: function (result) {



                }

            });
        }


    }




    function usuario(e) {
        var usuario = $("#usuario").val();


        $.ajax({

            type: "POST",
            url: "index.php",
            data: { usuario: $("#usuario").val(), inicio_sesion: 1 },
            success: function (result) {

                //$("body").html(result);
                if (usuario == 'volantuso') {

                    //  $("body").load("admin.php");
                } else {

                    // $("body").html(result);
                }
                //$("body").html(result);
                location.href = "index.php";
            }
        });
    }

    function cambiar_usuario() {

        $.ajax({

            type: "POST",
            url: "index.php",
            data: { cambiar_usuario: 1 },
            success: function (result) {

                // $("body").html(result);
                location.href = "index.php";
            }
        });
    }


    function eliminar_producto(e, f, g) {
        //alert(g);
        $.ajax({
            type: "POST",
            url: "index.php",
            data: { eliminar_id: e, seccion: f, categoria: f, nombre_archivo_servidor: g },
            success: function (result) {
                $("body").html(result);
            }

        });
    }


    function comandas(e) {


        $.ajax({
            type: "POST",
            url: "comandas.php",
            data: { usuario: e },
            success: function (result) {
                $("body").html(result)
            }


        });
    }

    function detalles(e, f, g) {
        // alert(e)
        // alert(f)
        var detalles = prompt("Escribir una descripcion del plato");


        if (detalles != "") {


            $.ajax({
                type: "POST",
                url: "asi_sistema/info/procesar2.php",
                data: { detalles: detalles, id_detalles_plato: f },
                success: function (result) {
                    $("body	").html(result);
                }


            });
            $.ajax({
                type: 'POST',
                //url:'menu_clientes.php',
                url: 'index.php',
                data: { categoria: f, usuario: g },
                success: function (result) {

                    //$("#menu_carta").css("display","none");
                }

            });
        } else {

            detalles = prompt("Escribir una descripcion del plato");
        }
    }

    function tiempo_aprox(e, f, g) {

        // alert(e)
        var tiempo_aprox = prompt("Elegir el tiempo aproximado de preparacion");

        //var timing = "00:" + tiempo_aprox + ":00";


        $.ajax({
            type: "POST",
            url: "asi_sistema/info/procesar2.php",
            data: { tiempo_aprox_id: e, tiempo_aprox: tiempo_aprox },
            success: function (result) {
                // $("body").html(result)
            }


        });

        $.ajax({
            type: 'POST',
            //url:'menu_clientes.php',
            url: 'index.php',
            data: { categoria: f, usuario: g },
            success: function (result) {
                $("body	").html(result);
                //$("#menu_carta").css("display","none");
            }

        });
    }


    function test() {
        $("#contenedor").html("hola");
    }

    function historial_compra() {
        /// alert(1)
        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'asi_sistema/info/usuarios/saldo_clientes.php',
            data: { historial_cliente: "<?php echo $_SESSION[usuario] ?>" },
            success: function (result) {
                $("#contenedor").html(result);
                //$("#menu_carta").css("display","none");
            }

        });
    }

    function ver_deuda(e) {
        //alert(e)
        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'asi_sistema/info/usuarios/saldo_clientes.php',
            data: { deuda_cliente: e },
            success: function (result) {
                $("#contenedor").html(result);
                //$("#menu_carta").css("display","none");
            }

        });
    }



    /*
    
        $("#muestra_menu").mouseenter(function () {
            $("#categorias").hide();  // Oculta el div cuando el cursor está encima
        }).mouseleave(function () {
            $("#categorias").show();  // Muestra el div cuando el cursor sale
        });
"
    $("#muestra_menu").on('scroll', function () {
        $("#categorias").hide();  // Oculta el div al hacer scroll
    });*/





</script>


<style>
    a {
        text-decoration: none;
    }
</style>

<!--logo-->
<a href="index.php" onClick="usuario()"><img src="imagenes/logo.jpeg" style="height:50px;width:50px"></a>



<div id="encabezado" style="display:">
    <a style="float:right;margin-right:25%" href="https://wa.me/593981770519">
        <br>Contactanos <img src="imagenes/whatsapp.jpeg" style="width:25px;height:25px">
    </a>

    <?php if ($_SESSION["usuario"] != "" && $_SESSION["usuario"] != "volantuso") { ?>
        <a href="index.php"><img src="https://elpollovolantuso.com/imagenes/carta.png" style="width:25px;height:25px"></a>

        <a onClick="historial_compra('$_SESSION[usuario]')"><img src="https://elpollovolantuso.com/imagenes/historial.png"
                style="width:25px;height:25px"></a>

        <a onClick="ver_deuda('<?php echo $_SESSION[usuario] ?>')"><img src="https://elpollovolantuso.com/imagenes/pago.png"
                style="width:25px;height:25px"></a>


        <a href="mipedido.php"><img src="https://elpollovolantuso.com/imagenes/carrito.png"
                style="width:25px;height:25px"></a>
        <a id="n_articulos">



        </a>


    <?php } ?>



    <!--categorias-->

    <?php




    if ($_SESSION['usuario'] == "") {
        ?>
        ID pedido : <input type="text" id="usuario" onchange="usuario('<?php echo $_POST[categoria] ?>')" />

    <?php } else {



        echo "<a onClick=\"cambiar_usuario(' $_POST[categoria]')\" style='background:#E6FF71'>ID : " . $str = ucfirst($_SESSION['usuario']) . "</a><input id='usuario' type='hidden' value='$_SESSION[usuario]'/>";





        /*carrito*/
        $comanda_realizada = mysqli_query($conexion, "SELECT * FROM pedidos WHERE usuario='$_SESSION[usuario]' AND estado!=2");


        while ($muestra_comanda = mysqli_fetch_array($comanda_realizada)) {

            $n_pedidos += count($muestra_comanda['producto']);

            if ($muestra_comanda['delivery'] == 'delivery') {

                $n_delivery++;
            }
            ;
        }


        if ($n_pedidos > 0) {



            //echo "<a style='color:red;margin-top:10px;float:rigth' onClick=\"comandas('$_SESSION[usuario]')\"><img src=\"../../imagenes/carrito.png\" style=\"width: 30px;height: 30px\">" . $n_pedidos . "</a>";
            echo "<a style='color:red;margin-top:10px;float:rigth' href='mipedido.php'><img src=\"../../imagenes/carrito.png\" style=\"width: 30px;height: 30px\">" . $n_pedidos . "</a>";

        }

        if ($n_delivery > 0) {

            echo "<a href=\"menu_cocina.php\" style='color:red'><img src=\"imagenes/delivery.png\" style=\"height: 23px;width: 23px\"></a>";
        }





    } ?>
    <a
        href="https://storage.cloud.google.com/archivos_proyectos/photoshop/72808578_30chavo69941376366372_4409039424063537152_o.jpg"></a>

    <!--admin-->

    <?php
    if ($_SESSION['usuario'] == 'volantuso') {
        ?>
        <a href="admin.php" style="padding-left: 20px;text-align: right">Admin</a>
    <?php } ?>



    <a id="show_categorias"></a>

    <hr>
</div>
<br>





<!---menu de navegacion-
<div>


<a href="carta.php"><img src="imagenes/chef.jpeg" style="width: 20px;height: 20px"></a>
    <a href="menu_clientes.php"><img src="imagenes/carta.png" style="width: 20px;height: 20px"></a>

    
<a href="delivery.php"><img src="imagenes/delivery.png" style="width: 20px;height: 20px"></a>
    
<a href="info_pedidos.php"><img src="imagenes/camarero.jpeg" style="width: 20px;height: 20px"></a>
    
    
</div>

-->



<div>


    <?php

    error_reporting(0);

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




    //fin de semana
    
    // echo "<br>".$finde=date("w");
    $finde = date("w");
    ?>



    <?php

    /*acciones de sistema*/
    //insertar producto en carrito
    if ($_POST['producto'] != "") {


        $insertar_pedido = mysqli_query($conexion, "INSERT INTO pedidos (`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`delivery`,`metodo_pago`,`fecha`,`hora`) VALUES ('$_SESSION[usuario]','$_POST[producto]','$_POST[cantidad]','$_POST[precio]','$_POST[total]',0,'default','default','$fecha','$hora')");
    }


    //eliminar_producto de menu
    
    if ($_POST['eliminar_id'] != "") {

        $eliminar_producto_menu = mysqli_query($conexion, "DELETE FROM menu WHERE id='$_POST[eliminar_id]'");

        $nombre_archivo_servidor = $_POST['nombre_archivo_servidor'];

        //unlink('imagenes/'.$nombre_archivo_servidor.'jpeg');
        unlink('imagenes/' . $nombre_archivo_servidor);

    }



    echo $_POST['id_textarea'];
    ?>









    <!---INICIO de sesion usuario--->
    <div>
        <!---Inicio de sesion-->

        <?php



        ////
        if ($_POST['inicio_sesion'] != "") {

            $_SESSION['usuario'] = $_POST['usuario'];


        } else {

            $_SESSION['usuario'] = $_SESSION['usuario'];
            //$_POST['usuario'] = $_SESSION['usuario'];
        }

        ?>




        <?php
        if ($_SESSION['usuario'] != "") {
            include("asi_sistema/info/usuarios/saldo_clientes.php");
        }
        ?>


        <?php

        if ($_POST['cambiar_usuario'] != "") {

            session_destroy();
        }
        ?>

    </div>

    <br>

    <!---categorias--->
    <div id="contenedor" style="text-align: center;);">


        <div id="categorias" style="background: linear-gradient(to bottom,#f8f593, white);">




            <?php
            $categoriasMenu[0];
            $muestra_categorias = mysqli_query($conexion, "SELECT DISTINCT categoria FROM menu");

            while ($categoria = mysqli_fetch_array($muestra_categorias)) {

                ?>


            <?php
            if ($_POST['categoria'] == $categoria['categoria']) {

                ?>
            <button onClick="categorias_menu('<?php echo $categoria['categoria'] ?>','<?php echo $_POST[usuario] ?>')"
                style="color: #A9A9A9;background:#FEF9E7">
                <?php echo $categoria['categoria'] ?>
            </button>
            <?php
            } else {


                ?>
            <button onClick="categorias_menu('<?php echo $categoria['categoria'] ?>','<?php echo $_POST[usuario] ?>')">
                <?php echo $categoria['categoria'] ?>
            </button>

            <?php }

            ///muestra el menu eligiendo una categoria aleatoria
        
            $categoria['categoria'];
            $categoriasMenu[] = ("$categoria[categoria]");
            ?>

            <?php
            } ?>

        </div>

        <br>
        <?php

        //recorre array 
        for ($i = 0; $i < count($categoriasMenu); ++$i) {
            //echo "<br>" . $categoriasMenu[$i];
            //echo "<br>" . $categoriasMenu[$i];
            //echo $i;
            $n_aleatorio = $i;
        }
        // $m = implode(" ", $categoriasMenu);
        $menu_aleatorio = rand(0, $n_aleatorio);



        ?>





        <?php
        if ($_POST['categoria'] == "") {
            echo "<h5 style='text-align:center'>" . $categoriasMenu[$menu_aleatorio] . "</h5>";
        } else {
            // echo "<h5 style='text-align:center'>" . $_POST['categoria'] . "</h5>";
        

            echo " <script>$(\"#show_categorias\").html(\"<h5 style='text-align:center'>$_POST[categoria]</h5>\")</script>";
        } ?>












        <div style="overflow-y: scroll;height: 375px" id="muestra_menu">



            <?php


            if ($_POST['categoria'] == "") {
                $muestra_menu = mysqli_query($conexion, "SELECT * FROM menu WHERE categoria='$categoriasMenu[$menu_aleatorio]' AND estado='1'");
            } else {


                $muestra_menu = mysqli_query($conexion, "SELECT * FROM menu WHERE categoria='$_POST[categoria]' AND estado!=0");
            }
            while ($menu = mysqli_fetch_array($muestra_menu)) {


                ?>

            <table style="margin: auto">
                <hr style="width:300px">


                <tr>
                    <td>

                        <h3>
                            <?php echo $menu['producto']; ?>
                        </h3>
                    </td>
                </tr>
                <tr>

                    <td>

                        <?php if ($_SESSION['usuario'] == 'volantuso') { ?>
                        <a id='<?php echo str_replace(' ', '', $menu['producto'] . "img") ?>'><img
                                src="imagenes/<?php echo $menu['img'] ?>"
                                onClick="detalles('<?php echo $menu[producto] ?>','<?php echo $menu[id] ?>','<?php echo $_POST[usuario] ?>')"></a>

                        <?php } else {
                            ?>

                        <a id='<?php echo str_replace(' ', '', $menu['producto'] . "img") ?>'><img
                                src="imagenes/<?php echo $menu['img'] ?>"></a>


                        <?php } ?>

                        <?php  ///
                            $test += count($menu['producto']);
                            ?>
                    </td>


                </tr>
                <tr>
                    <td style="width: 100px;color:#818B97">
                        <?php echo $menu['detalles']; ?>
                    </td>
                </tr>

                <tr>
                    <td>
                        <?php echo "$ " . $menu['precio'] ?>
                    </td>

                </tr>
                <tr>
                    <td>
                        <button id='<?php echo str_replace(' ', '', $menu['producto']) ?>' style="color: green"
                            onClick="agregar('<?php echo $menu['producto'] ?>','<?php echo $_SESSION['usuario'] ?>','<?php echo $menu['precio'] ?>','<?php echo $_POST['categoria'] ?>')">Agregar</button>
                    </td>
                </tr>
                <tr>
                    <td>
                        <!--dvvvddvdvdvd-->
                            <?php


                            $pedidos = mysqli_query($conexion, "SELECT * FROM pedidos WHERE producto='$menu[producto]' AND usuario='$_SESSION[usuario]' AND estado!='2'");
                            while ($pedidos = mysqli_fetch_array($pedidos)) {


                                if ($menu['producto'] == $pedidos['producto']) {
                                    echo "<a style='color:red'>Agregado</a>";

                                    ?>

                                    <!--condicion para poder quitar producto-->
                                    <?php


                                    ?>

                                    <!--<button style="color: red;margin-left: 50px;" onClick="quitar_producto('<?php //echo $muestra_pedidos['id'] ?>','<?php //echo $_SESSION[usuario] ?>','<?php //echo $_POST[categoria] ?>')">X</button>-->



                                    <?php
                                    $t = str_replace(' ', '', $menu['producto'] . "img");



                                    echo "<script> 
					$('#$t').css('opacity','0.3')
					</script>";

                                    $s = str_replace(' ', '', $menu['producto']);
                                    echo "<script> 
					$('#$s').css('display','none');
					</script>";

                                }
                                ?>






                                <?php


                            }





                            ?>
                        </td>
                    </tr>

                    <?php
                    if ($_SESSION['usuario'] == 'volantuso') {



                        ?>
                        <tr>

                            <td>
                                <button
                                    onClick="eliminar_producto('<?php echo $menu['id'] ?>','<?php echo $menu[seccion] ?>','<?php echo $menu['img'] ?>')"
                                    style="color: red">x</button>

                            <?php } ?>
                        </td>
                    </tr>
                    <tr>
                        <?php
                        if ($_SESSION['usuario'] == 'volantuso') {
                            ?>
                            <td style="color: blue;">
                                <?php echo "Tiempo de Preparacion <a onClick=\"tiempo_aprox('$menu[id]','$_POST[categoria]','$_POST[usuario]')\">" . $menu['tiempo_aprox'] . "</a> Min" ?>
                            </td>
                        <?php } else { ?>
                            <td style="color: blue;">
                                <?php echo "Tiempo de Preparacion <a>" . $menu['tiempo_aprox'] . "</a> Min" ?>
                            </td>
                        <?php } ?>
                    </tr>
                </table>

            <?php } ?>
            <?php include("receta.php"); ?>






        </div>

    </div>

</div>


<div id="footer">

    <?php include("asi_sistema/info/footer.php"); ?>


</div>
