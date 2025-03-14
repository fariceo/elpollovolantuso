       <?php session_start(); ?>
       <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">

            <meta charset="UTF-8" name="viewport" content="width=device-width">
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
            <script src="funciones_mercandoxxi.js"></script>
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
                                //$("#contenedor").html(result);
                                //$("#menu_carta").css("display","none");
                            }

                        });
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
     
                div{
                    display: table;
                }
            #contenedor {
                background: black;
                color: white;
            }
        </style>

        <?php
        $conect = mysqli_connect("localhost", "root", "clave", "mercandoxxi");
        ?>
   <?php 
                if($_SESSION["usuario"]==""){
                 header("Location:login_mercandoxxi.php");
                }
                ?>
        <body>
            <a href="mandados">Inicio</a>
            <h3>TICKET</h3>
            <div style="background: #98b4be;">
              
                   
                    <input required type="text" placeholder="Usuario" id="usuario" onkeyup="buscar_cliente()" value="<?php echo $_SESSION[usuario]?>"/>
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
                  <br>
                    <textarea required id="especificacion_tarea" name="especificacion_tarea" rows="4" cols="50" placeholder="Escribe aquí los detalles de la tarea..." style="width:200px"></textarea>
                                
                
                    <a>
                        <?php

                        $n_ticket = rand(1000, 9999);
                        echo "<br><input type='text' id='localizador' value='$n_ticket' required \>";

                        //echo "<script>$(\"#ticket\").html('Ticket'.$n_ticket)</script>";
                        // echo "<script>$(\"#usuario\").val($n_ticket)</script>";
                        
                        ?>
                    </a>
                    <br>
                    <button style="text-align: center;" onClick="enviar_datos()">Enviar</button>

               
                </div>
                <br>
                <div id="contenedor" style="width:150px">


                </div>
            


            <div>
                <h3>Peticiones</h3>
                <?php
                    $mostrar_mandados=mysqli_query($conect,"	SELECT * FROM mandados WHERE usuario= '$_SESSION[usuario]'");
                    while ($mandados = mysqli_fetch_array($mostrar_mandados)){

                       echo $mandados['producto'].'<br>';
                    }
                ?>
            </div>
        </body>

        </html>