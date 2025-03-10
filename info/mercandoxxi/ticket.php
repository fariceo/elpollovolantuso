       <?php session_start(); ?>
       <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">

            <meta charset="UTF-8" name="viewport" content="width=device-width">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script>

                $(document).ready(function () {


                });


                function buscar_producto() {

                    var producto = $("#producto").val();


                    // alert(usuario); 

                    $.ajax({
                        type: 'POST',
                        //url:'menu_clientes.php',
                        url: 'procesar_datos.php',
                        data: { buscar_producto: producto },
                        success: function (result) {
                            $("#contenedor").html(result);
                            //$("#menu_carta").css("display","none");
                        }

                    });


                    $.ajax({
                            type: 'POST',
                            //url:'menu_clientes.php',
                            url: 'ticket.php',
                            data: { buscar_usuario: $("#usuario").val() },
                            success: function (result) {
                                $("#contenedor").html(result);
                                //$("#menu_carta").css("display","none");
                            }

                        });
                }


                function enviar_datos() {

                    var usuario = $("#usuario").val();
                    var producto = $("#producto").val();
                    var especificacion_tarea=$("#especificacion_tarea").val();
                    var cantidad = $("#cantidad").val();
                    var location = $("#location").val();


                    if ($("#usuario").val() != "" && $("#producto").val() != "" && $("#cantidad").val != "" && $("#location").val() != "") {




                        $.ajax({
                            type: 'POST',
                            //url:'menu_clientes.php',
                            url: 'procesar_datos.php',
                            data: { enviar_datos: 1, usuario: usuario, producto: producto, cantidad: cantidad, precio: 0, location: location, localizador: 1, especificacion: especificacion_tarea },
                            success: function (result) {
                                $("#contenedor").html(result);
                                //$("#menu_carta").css("display","none");
                            }

                        });
                    } else {

                        alert("Introduce usuario");

                    }

                }

                function buscar_cliente(e){
                    $.ajax({
                            type: 'POST',
                            //url:'menu_clientes.php',
                            url: 'procesar_datos.php',
                            data: { buscar_usuario: $("#usuario").val() },
                            success: function (result) {
                                $("#contenedor").html(result);
                                //$("#menu_carta").css("display","none");
                            }

                        });


                }

            </script>
            <title>TICKET</title>
        </head>
        <style>
            div {
                display: inline-table;
            }

            #contenedor {
                background: black;
                color: white;
            }
        </style>

        <?php
        $conect = mysqli_connect("localhost", "root", "clave", "volantuso");
        ?>

        <body>
            <a href="mandados">Inicio</a>
            <div>
                <div style="width:200px">
                    <h3 style="text-align:center">TICKET</h3>
                    <input required type="text" placeholder="Usuario" id="usuario" onkeyup="buscar_cliente()"/>
                    <br><br>
                    <input required type="text" placeholder="Producto" id="producto" onkeyup="buscar_producto()" />
                    <br>
                    <br>
                <input type="text" placeholder="Cantidad" id="cantidad" style="width:50px;" />
                    X $
                    <a id="precio">0.00</a>

                    = $ <a id="total_producto">0</a>

                    <a id="total"></a>
                    <br>
                    <br>

                    <input required type="text" placeholder="Localizacion" id="location" />

                    <br>
                    <br>
                                        
                    <label for="especificacion_tarea" style="width:200px;background:#dedee6">Especificación de la Tarea:</label>
                    <textarea required id="especificacion_tarea" name="especificacion_tarea" rows="4" cols="50" placeholder="Escribe aquí los detalles de la tarea..." style="width:200px"></textarea>
                                
                
                    <a>
                        <?php

                        $n_ticket = rand(1000, 9999);
                        echo "<input type='text' id='localizador' value='$n_ticket' required \>";

                        //echo "<script>$(\"#ticket\").html('Ticket'.$n_ticket)</script>";
                        // echo "<script>$(\"#usuario\").val($n_ticket)</script>";
                        
                        ?>
                    </a>
                    <br>
                    <button style="text-align: center;" onClick="enviar_datos()">Enviar</button>

                </div>

                <div id="contenedor" style="width:150px">


                </div>
            </div>
        </body>

        </html>