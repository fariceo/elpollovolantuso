               <?php session_start(); ?>
               <!DOCTYPE html>
                <html lang="en">

                <head>
                    <meta charset="UTF-8">
                    <meta name="viewport" content="width=device-width, initial-scale=1.0">
                    <title>Mandados</title>
                    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
                    <script src="funciones_mercandoxxi.js"></script>


                </head>
                <?php
                session_start();
                //conexion 
                $con = mysqli_connect("localhost", "root", "clave", "mercandoxxi");
                ?>

                <?php 
                if($_SESSION["usuario"]==""){
                 header("Location:login_mercandoxxi.php");
                }
                ?>

                <?php

                if($_POST['cambiar_precio_id']!= ""){

                    $cambiar_precio=mysqli_query($con,"UPDATE mandados SET precio='$_POST[cambiar_precio]' WHERE id='$_POST[cambiar_precio_id]'");
                }


                ?>


                <body>
                
                    <?php
                    //formulario
                    
                    if ($_POST["location"] != "") {

                        $insertar_mandado = mysqli_query($con, "INSERT INTO `mandados` (`usuario`,`producto`,`cantidad`,`location`,`especificacion`,`estado`) VALUES ('$_POST[usuario]','$_POST[producto]','$$_POST[cantidad]','$_POST[location]','especificacion','0')");
                    }
                    ?>


                <?php
                ///eliminar datos mandados
                if ($_POST["eliminar_mandado_id"] != "") {

                    mysqli_query($con,"UPDATE mandados SET estado=2 WHERE id='$_POST[eliminar_mandado_id]'");

                }

                ?>

                    <h3 style="text-align:center" onClick="buscar_usuario()">Ordenes</h3>
                    <div style="text-align:center;">

                    <a style=""><img src="https://th.bing.com/th/id/OIP.sSXfZIqxTRZ5hFg6wgttagHaHa?w=202&h=201&c=7&r=0&o=5&pid=1.7" style="width:150px;height:150px"></a>
                    </div>
                
                                    <a style="float: right;"><input type="text" placeholder="Nº" id="localizador"
                                            onchange="localizador()" /></a>
                        
                    <hr>

                <?php if ($_POST['usuario'] != "" || $_POST['localizador']) {
                        ?>
                    <a href="mandados.php">Volver atras</a>


                    <?php }else{ ?>
                        <a id="ticket" href="ticket.php">Generar Ticket</a> 
                        
                        <?php }?>
                    <div>









                        <table style="margin:auto; margin-bottom: 20px;margin-top: 20px;background:#49482f;color:white">
                            <?php
                            if ($_POST['usuario'] == "") {
                                ?>
                                <tr>
                                <th style="width:200px"> Usuario </th>

                                <th style="width:200px"> Localizacion</th>
                                <th style="width:200px"> Precio Servicio</th>
                            </tr>
                            
                                <?php
                            } else {
                                ?>

                                <th style="width:200px" id="info_usuario_name"> <?php //echo $_POST['usuario'] ?></th>
                                <?php
                            }
                            ?>



                        </table>
                        <?php
                        ///
                        
                        //Busqueda de Mandados
                        
                        if ($_POST['usuario'] != "" || $_POST['localizador']) {
                            $buscar_mandados = mysqli_query($con, "SELECT * FROM mandados WHERE estado!=2 AND  usuario='$_POST[usuario]' || usuario='$_POST[localizador]' ");

                        } else {
                            $buscar_mandados = mysqli_query($con, "SELECT * FROM mandados WHERE estado!=2");
                        }

                        while ($mandados = mysqli_fetch_array($buscar_mandados)) {



                            ?>

                        </div>
                        <div style="overflow-y: scroll;" id="contenedor">
                            <table style="margin:auto; margin-bottom: 20px;">
                                <tr>

                                    <?php
                                    if ($_POST["usuario"] == "" && $_POST['ticket'] == "" || $_POST[localizador]!="") {
                                        ?>




                                        <td style="width:100px;background:#999bdb" onClick="buscar_usuario('<?php echo $mandados[usuario] ?>')">
                                            <?php echo $mandados['usuario']; ?>
                                        </td>

                                        <!--  <td style="width:200px"><?php //echo $mandados['producto']; ?></td>-->



                                    <!--  <td style="width:200px;height:50px;background:#d7d7e5"><?php //echo $mandados['producto']; ?></td>-->
                                        <td style="width:100px;background:#d7d7e5"><?php echo $mandados['location']; ?></td>

                                        <td style="width:50px;background:#d7d7e5" onclick="cambiar_precio('<?php echo $mandados[id] ?>')">
                                            <?php echo $mandados['precio']; ?>
                                        </td>
                                        <td onclick="eliminar_mandado('<?php echo $mandados[id] ?>')" style="width: 20px; height: 20px; background-color: red; color: white; border-radius: 5px; text-align: center; cursor: pointer;">X</td>
                                        <?php $total += $mandados['precio']; ?>

                                        </tr>
                                        <?php


                                    } else {

                                        /////////al buscar usuario para ver la especificacion del mandado


                                        ?>
                                    <tr>
                                        <td style="width:200px;background:#d7d7e5" onClick="buscar_usuario('<?php echo $mandados[usuario] ?>')">
                                            <?php echo $mandados['producto']; ?>

                                        </td>

                                        <td style="text-align:center;background:#d7d7e5"> X <?php echo $mandados['cantidad']; ?></td>

                                        <td style="width:50px;text-align:center;background:#d7d7e5" onclick="cambiar_precio('<?php echo $mandados[id] ?>')">
                                            $ <?php echo $mandados['precio']; ?>
                                        </td>
                        
                                    </tr>



                                    <?php
                                    if($mandados['especificacion'] == "algo"){
                                    ?>
                                    <tr>

                                    <td style="width:200px">
                                    
                                        <label for="especificacion_tarea" style="width:200px;background:#dedee6">Especificación de la Tarea:</label>
                                        <textarea  onblur="especificacion('<?php echo $mandados[id] ?>')" id="especificacion_tarea_<?php echo $mandados['id'] ?>" name="especificacion_tarea" rows="4" cols="50" placeholder="Escribe aquí los detalles de la tarea..." style="width:200px"></textarea>
                                    </td>   
                                    </tr>
                                        <?php $total += $mandados['precio']; ?>
                                        <?php

                                    }else{

                                            
                                        ?>
                                        <tr>
                                    <td style="width:200px"><label for="especificacion_tarea" style="width:200px;background:#dedee6">Especificación de la Tarea:</label></td>
                                        <?php $total += $mandados['precio']; ?>
                                    
                                        </tr>

                                        <tr>


                                        <td style="width:200px"><?php echo $mandados['especificacion']; ?></td>
                                        </tr>
                                    <?php

                                    }
                                    

                                }
                                    ?>








                                
                            </table>

                            <?php
                            //info_usuario_name
                            $u = $mandados['usuario'];
                        }

                        echo "Total : $ " . $total;

                        echo "<script>$(\"#info_usuario_name\").html('$u')</script>";
                        ///////
                        ?>

                        <hr>





                    </div>


                </body>

                </html>