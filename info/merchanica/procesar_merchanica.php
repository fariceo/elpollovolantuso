<?php //include("conexion_merchanica.php"); 
session_start(); ?>

<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
<script src="funciones_merchanica.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="funciones_merchanica.js"></script>
<script>


    $(document).ready(function () {

    }


</script>
<?php



include("conexion_merchanica.php");

?>

<?php




//fecha-->

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
if ($_POST['buscar_cliente'] != "") {

    $buscar_cliente = mysqli_query($conexion2, "SELECT * FROM tareas WHERE cliente='$_POST[buscar_cliente]'");

    while ($tareas_cliente = mysqli_fetch_array($buscar_cliente)) {

        ?>
<hr>
        <table>
            <tr>
                <td style="width:150px"><?php echo "<br>" . $tareas_cliente['tarea']; ?></td>
                <td></td>
                <td style="float:right;margin-right:20px"> <button style="color:red;width:10px"
                        onclick="eliminar_tarea('<?php echo $tareas_cliente['id'] ?>')">X</button></td>
            </tr>
        </table>

        <?php
    }
}


if ($_POST['intro_tarea'] != "") {

    ucfirst($_POST['buscar_pedido']);
    $intro_tarea = mysqli_query($conexion2, "INSERT INTO `tareas` (`cliente`, `mecanico`, `tarea`, `estado`,`fecha`, `hora`) VALUES ('$_POST[buscar_cliente]', 'default', '$_POST[intro_tarea]','0','$fecha', '$hora')");
    $intro_tarea = mysqli_query($conexion2, "INSERT INTO `pedidos` (`usuario`, `producto`, `cantidad`, `precio`, `total`, `estado`, `delivery`, `metodo_pago`, `fecha`, `hora`) VALUES ('$_POST[buscar_cliente]','$_POST[intro_tarea]','1','0','0','0','default','default','$fecha', '$hora')");
}

?>


<?php if ($_POST['eliminar_tarea'] != "") {
    $eliminar_tarea = mysqli_query($conexion2, "DELETE FROM tareas WHERE id='$_POST[eliminar_tarea]'");
} ?>



<!--taraea lista-->
<?php

$tarea_lista = mysqli_query($conexion2, "UPDATE tareas SET estado='10' WHERE id='$_POST[tarea_lista]'");


?>





<?php

if ($_POST['ampliar_cliente'] != "") {

    ?>

    <br>
    <?php
    $buscar_tareas = mysqli_query($conexion2, "SELECT * FROM tareas WHERE cliente ='$_POST[ampliar_cliente]' ");

    while ($tareas = mysqli_fetch_array($buscar_tareas)) {


        ?>
        <table>


            <tr>
                <td><?php echo $tareas['tarea'] ?></td>

            </tr>

            <!--si no hay mecanico no hay checkbox de tarea lista por parte del mecanico-->


            <?php if ($tareas['mecanico'] != 'default') { ?>
                <tr>
                    <?php if ($tareas['estado'] != 10) { ?>
                        <td><input type="checkbox" onClick="tarea_lista('<?php echo $tareas['id'] ?>')" /></td>
                    <?php } else { ?>
                        <td><input type="checkbox" checked /></td>

                    <?php } ?>
                    <td><button style="color:red;width:10px">X</button></td>

                </tr>
            <?php } ?>


            <tr>
                <!--mecanico acepta tareea-->
                <?php if ($tareas['mecanico'] == "default") { ?>
                    <td><button
                            onclick="aceptar_tarea('<?php echo $_SESSION[usuario] ?>','<?php echo $tareas[id] ?>','<?php echo $tareas[tarea]?>')">Mecanico</button>
                    </td>

                <?php } else { ?>
                    <td style="color:silver">
                        <?php echo "Mecanico : " . $tareas['mecanico']; ?>
                    </td>
                <?php } ?>
            </tr>

        </table>
        <hr>
        <?php

    }

}
?>



<?php
if ($_POST['introducir_producto_cliente'] != "") {

    $introducir_compra_pedido = mysqli_query($conexion2, "INSERT INTO `pedidos` (`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`delivery`,`metodo_pago`,`fecha`,`hora`) VALUES ('$_POST[introducir_producto_cliente]','$_POST[producto]','$_POST[cantidad]','$_POST[precio]','$_POST[total]','0','default','default','$fecha','$hora')");
    /* $introducir_compra_pedido = mysqli_query($conexion2, "INSERT INTO `pedidos` (`usuario`, `producto`, `cantidad`, `precio`, `total`, `estado`, `delivery`, `metodo_pago`, `fecha`, `hora`) VALUES ('byrito', 'cadena', '1', '12', '12', '1', 'default', 'default', '2024-11-12', '05:43:41')
 ");*/

}

?>

<?php
if ($_POST['id_cambiar_cantidad'] != "") {


    $total = $_POST['cantidad'] * $_POST['precio'];
    $cambiar_cantidad = mysqli_query($conexion2, "UPDATE pedidos SET cantidad='$_POST[cantidad]', total='$total' WHERE id='$_POST[id_cambiar_cantidad]'");
}
?>


<?php

if($_POST["precio_servicio"] != "") {

$poner_precio_servicio=mysqli_query($conexion2,"UPDATE pedidos SET precio='$_POST[precio_servicio]' WHERE id='$_POST[id_poner_precio]'");
}

?>



<?php
///compra de cliente lista.. pedidos
if ($_POST['compra_cliente_listo'] != "") {




    //if ($usuario['usuario'] == $compra['usuario']) {
    //$t = "<script>$(\"#$id2\").val()</script>";
    //echo $compra['usuario'] . $t . $totalfinal



    ////analizar y cambiar codigo para adaptar 
    $mostrar_pedido = mysqli_query($conexion2, "SELECT * FROM pedidos WHERE usuario='$_POST[cliente_listo]' AND estado!='2'");
    $t[0];
    while ($pedido = mysqli_fetch_array($mostrar_pedido)) {


        $t[] = "$pedido[producto]" . " x " . "$pedido[cantidad]" . " = $ " . "$pedido[total]" . "<br>";
        $quitar_pedidos_usuario_delista = mysqli_query($conexion2, "UPDATE pedidos SET estado='2' WHERE usuario='$pedido[usuario]' AND estado!='2'");
        $total_pedido += $pedido['total'];
    }
    $m = implode(" ", $t);
    /*
    echo "<h3>Pedido Ingresado</h3>";
    */
    // echo ",,,,," . $m;

    $insertar_pedido = mysqli_query($conexion2, "INSERT INTO pedidos (`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`delivery`,`metodo_pago`,`fecha`,`hora`) VALUES ('$_POST[cliente_listo]','$m','1','1','$total_pedido','0','default','default','$fecha','$hora')");


    //$venta = mysqli_query($conexion, "DELETE FROM pedidos WHERE usuario='$_POST[usuario_pedido]' AND estado !='2'");
    $pedido_listo = mysqli_query($conexion2, "DELETE FROM pedidos WHERE usuario='$_POST[cliente_listo]' AND estado !='2'");
}
?>





<!---actualiza la deuda de usuario y registra transaccion-->
<?php
if ($_POST['actualizar_cantidad'] != "") {


    $actualizar_deuda = mysqli_query($conexion2, "UPDATE saldo_pendiente SET saldo_pendiente='$_POST[actualizar_cantidad]' WHERE usuario='$_POST[usuario]'");

    ?>


    <?php

    ///historial de transacciones

    $buscar_historial_credito = mysqli_query($conexion2, "SELECT * FROM historial_credito WHERE usuario='$_POST[usuario]' ORDER BY id DESC");

    //usuario saldo fecha

    ?>
    <br>
    <h3>Usuario</h3>
    <a style='width:200px'>
        <?php echo $_POST['usuario']; ?>
    </a>
    <table>

        <tr>
            <td>

                <?php
                //buscar pedidos de clientes segun fecha dada
                if ($_POST["buscar_pedido"] != "") {

                    $buscar_pedido = mysqli_query($conexion2, "SELECT * FROM ventas WHERE usuario='$_POST[usuario]' AND fecha='$_POST[buscar_pedido]'");

                    while ($pedido = mysqli_fetch_array($buscar_pedido)) {
                        ?>
                        <br>
                        <table>
                            <tr>
                                <td style="background:#F3E2A9">Pedido
                                    <?php echo $count_pedido += count($pedido['producto']) ?>:
                                </td>
                                <td>
                                    <?php echo $pedido['producto'] ?>
                                </td>
                            </tr>
                        </table>
                        <?php
                    }
                    ?>


                    <hr>
                    <br>
                    <?php
                }
                ?>
            </td>
        </tr>

    </table>

    <?php
    while ($historial_credito = mysqli_fetch_array($buscar_historial_credito)) {
        ?>

        <table>

            <tr>
                <?php
                if ($historial_credito['saldo'] != 0) {
                    ?>
                    <td style="opacity: 0.9;color:silver">Saldo Fiado : </td>
                    <td style="opacity: 0.9;color:silver">Fecha de consumo</td>

                    <td style="opacity: 0.9;color:silver">Deuda</td>
                </tr>
                <tr>
                    <td style='width:50px'>
                        <?php echo "$ " . $historial_credito['saldo'] ?>
                    </td>
                <?php } else { ?>
                    <td style='width:50px;color:red'>
                        <?php echo "$ " . $historial_credito['saldo'] ?>
                    </td>
                <?php } ?>
                <td style='width:200px'
                    onClick="buscar_pedido('<?php echo $historial_credito['usuario'] ?>','<?php echo $historial_credito['fecha'] ?>')">
                    <?php echo $historial_credito['fecha'] ?>
                </td>
                <td></td>
                <td>
                    <?php echo "<a onClick=\"actualizar_deuda_pendiente('$historial_credito[usuario]','$historial_credito[id]')\">" . $historial_credito['saldo_contable'] . "</a>" ?>
                </td>
            </tr>


        </table>

        <?php


    }

}
?>


<?php
//login



?>


<!---registrar_usuario-->
<?php if (isset($_POST["empresa"])) {


    $password_hashed = password_hash($_POST['password'], PASSWORD_DEFAULT);


    $registrar_usuario = mysqli_query($conexion2, "INSERT INTO `usuarios_registrados` (`usuario`,`nombre`,`saldo`,`email`,`telefono`,`empresa`,`contraseña`) VALUES ('$_POST[usuario]','$_POST[usuario]','0','$_POST[email]','$_POST[telefono]','$_POST[empresa]',' $password_hashed')");
    //$registrar_usuario = mysqli_query($conexion2, "INSERT INTO `usuarios_registrados` (`id`, `usuario`, `nombre`, `saldo`, `email`, `telefono`, `empresa`, `pasword`) VALUES ('1', 'test', 'test', '1.5', 'brionariomen@gmail.com', '123456', 'volantuso', ' $password_hashed')");

    $_SESSION['usuario'] = $_POST['usuario'];
    header("Location:inicio.php");

  
}

?>


<!---aceptar tarea-->
<?php
if ($_POST["usuario_acepto_tarea"] != "") {

    $usuario_acepto_tarea = mysqli_query($conexion2, "UPDATE tareas SET mecanico='$_POST[usuario_acepto_tarea]' WHERE id='$_POST[id_acepto_tarea]'");
    $tarea_lista2 = mysqli_query($conexion2, "UPDATE pedidos SET delivery='$_POST[usuario_acepto_tarea]' WHERE producto='$_POST[producto_acepto_tarea]'");

}

?>

<?php

if (isset($_POST['iniciar_sesion'])) {
    $email = mysqli_real_escape_string($conexion2, $_POST['email']);
    $password = trim($_POST['password']);

    $query = "SELECT usuario, contraseña FROM usuarios_registrados WHERE email = '$email'"; // Campo correcto: contraseña
    $result = mysqli_query($conexion2, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $userData = mysqli_fetch_assoc($result);

        if (password_verify($password, $userData['contraseña'])) { // Verificar contra el hash
            $_SESSION['usuario'] = $userData['usuario'];
            // La redirección se maneja en el cliente (jQuery) ahora
            echo "<p style='color: green;'>Inicio de sesión exitoso. Redirigiendo...</p>"; // Mensaje de éxito
            // header("Location: inicio.php");  No es necesario aquí
            exit;
        } else {
            echo "<p style='color: red;'>La contraseña es incorrecta.</p>";
        }
    } else {
        echo "<p style='color: red;'>El correo no está registrado.</p>";
    }
}

?>



<?php

if($_POST['usuario_sesion']!=""){

    $_SESSION['usuario'] = $_POST['usuario_sesion'];
    Location("inicio.php");
}
?>