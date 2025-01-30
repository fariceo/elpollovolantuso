<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mandados</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {



        });



        function enviar_datos() {
            //alert(e)

            var usuario = $("#usuario").val();
            var producto = $("#producto").val();
            var location = $("#location").val();
            $.ajax({
                type: 'POST',
                //url:'menu_clientes.php',
                url: 'mandados.php',
                data: { usuario: usuario, producto: producto, location: location },
                success: function (result) {
                    $("body").html(result);
                    //$("#menu_carta").css("display","none");
                }

            });
        }

        function buscar_usuario(e) {


            $.ajax({
                type: 'POST',
                //url:'menu_clientes.php',              
                url: 'mandados.php',
                data: { usuario: e },
                success: function (result) {
                    $("body").html(result);
                    //$("#menu_carta").css("display","none");
                }

            });

        }
        function cambiar_precio(e) {
            //alert(e);

            var precio=prompt("cambia precio de servicio");

            $.ajax({
                type: 'POST',
                //url:'menu_clientes.php',              
                url: 'mandados.php',
                data: { cambiar_precio_id: e,cambiar_precio:precio },
                success: function (result) {
                    $("body").html(result);
                    //$("#menu_carta").css("display","none");
                }

            });

        }
        //localizador

        function localizador() {
            var e = $("#localizador").val();
//alert(e);
            $.ajax({
                type: 'POST',
                //url:'menu_clientes.php',
                url: 'mandados.php',
                data: { localizador: e, usuario: 1 },
                success: function (result) {
                    $("body").html(result);
                    //$("#menu_carta").css("display","none");
                }

            });
        }


    </script>

</head>
<?php

//conexion 
$con = mysqli_connect("localhost", "root", "clave", "mercandoxxi");
?>


<?php

if($_POST['cambiar_precio_id']!= ""){

    $cambiar_precio=mysqli_query($con,"UPDATE mandados SET precio='$_POST[cambiar_precio]' WHERE id='$_POST[cambiar_precio_id]'");
}


?>


<body>
    <?php echo "hola mundo";?>
    <?php
    //formulario
    
    if ($_POST["location"] != "") {

        $insertar_mandado = mysqli_query($con, "INSERT INTO `mandados` (`usuario`,`producto`,`cantidad`,`location`) VALUES ('$_POST[usuario]','$_POST[producto]','$$_POST[cantidad]','$_POST[location]')");
    }
    ?>




    <h3 style="text-align:center" onClick="buscar_usuario()">Ordenes</h3>
    <hr>


    <a id="ticket" href="ticket.php">Generar Ticket</a>
    <div id="contenedor">









        <table style="margin:auto">
            <?php
            if ($_POST['usuario'] == "") {
                ?>
                <th style="width:200px"> Usuario </th>

                <th style="width:200px"> Localizacion</th>
                <th style="width:200px"> Precio Servicio</th>
                <tr>
                    <td style="float: right;"><input type="text" placeholder="Nº" id="localizador"
                            onchange="localizador()" /></td>
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
            $buscar_mandados = mysqli_query($con, "SELECT * FROM mandados WHERE usuario='$_POST[usuario]' || usuario='$_POST[localizador]'");

        } else {
            $buscar_mandados = mysqli_query($con, "SELECT * FROM mandados");
        }

        while ($mandados = mysqli_fetch_array($buscar_mandados)) {



            ?>

        </div>
        <div style="background:black;color:white;overflow-y: scroll;">
            <table style="margin:auto">
                <tr>

                    <?php
                    if ($_POST["usuario"] == "" && $_POST['ticket'] == "" || $_POST[localizador]!="") {
                        ?>




                        <td style="width:200px" onClick="buscar_usuario('<?php echo $mandados[usuario] ?>')">
                            <?php echo $mandados['usuario']; ?>
                        </td>

                        <!--  <td style="width:200px"><?php //echo $mandados['producto']; ?></td>-->



                        <td style="width:200px"><?php echo $mandados['producto']; ?></td>
                        <td style="width:200px"><?php echo $mandados['location']; ?></td>

                        <td style="width:200px" onclick="cambiar_precio('<?php echo $mandados[id] ?>')">
                            <?php echo $mandados['precio']; ?>
                        </td>
                        <?php $total += $mandados['precio']; ?>
                        <?php



                        ///////////////////////
                





                    } else {
                        ?>

                        <td style="width:200px" onClick="buscar_usuario('<?php echo $mandados[usuario] ?>')">
                            <?php echo $mandados['producto']; ?>

                        </td>

                        <td style="width:200px"><?php echo " X " ?></td>

                        <td><?php echo $mandados['cantidad']; ?></td>
                        <?php

                    }
                    ?>








                </tr>
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