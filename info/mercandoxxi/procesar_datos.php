<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script src="funciones_mercandoxxi.js"></script>
<?php

$conexion = mysqli_connect("localhost", "root", "clave", "mercandoxxi");

include("conexion.php");
?>




<?php
////buscar productos
if ($_POST['buscar_producto'] != "") {

    $buscar_producto_menu = mysqli_query($conexion, "SELECT * FROM gastos WHERE producto like '%" . $_POST['buscar_producto'] . "%'");

    ?>
    <br>
    <h3>Producto</h3>
    <?php
    while ($producto = mysqli_fetch_array($buscar_producto_menu)) {


        ?>
        <table>
            <tr>
                <td><?php echo $producto["producto"]; ?></td>
                <td><?php echo " $ ".$producto["total"]; ?></td>

                <?php
                
                echo "<script>$('#precio').html('$producto[total]')</script>";

                echo "<script>$('#total_producto').html('$producto[total]*$('#total_producto').val()')</script>";
                ?>
            </tr>
            <tr>
                <td><button onclick="agregar('<?php echo $producto['producto']?>')">+</button></td>
            </tr>
        </table>

        <?php

        echo "<script>$(\"#usuario\").html('byrito');</script>";

    }




}
?>


<?php
if ($_POST['enviar_datos'] != "") {




    $insertar_mandado = mysqli_query($conexion, "INSERT INTO `mandados` (`usuario`,`producto`,`cantidad`,`precio`,`location`,`localizador`,`especificacion`,`estado`) VALUES ('$_POST[usuario]','$_POST[producto]','$_POST[cantidad]','$_POST[precio]','$_POST[location]','$_POST[localizador]','$_POST[especificacion]','0')");


}
?>


<?php

if($_POST['buscar_usuario']!=""){

    $buscar_usuario = mysqli_query($conexion, "SELECT DISTINCT usuario FROM mandados WHERE usuario like '%" . $_POST['buscar_usuario'] . "%'");

    while($usuario=mysqli_fetch_array($buscar_usuario)) {
        echo "<br>".$usuario['usuario'];
    }
}

?>



<?php
///registrar usuario

if ($_POST["ci"] != "") {

    $insertar_registro = mysqli_query($conexion, "INSERT INTO `usuarios` (`usuario`,`ci`,`telefono`,`email`,`roll`,`pasword`,`localidad`) VALUES ('$_POST[usuario]','$_POST[ci]','$_POST[telefono]','$_POST[email]','$_POST[roll]','$_POST[password]','$_POST[localidad]')");
    echo "<p>Registro de usuario con exito</p>";
}
?>




<?php
/// especificacion del mandado

$especificacion_mandado=mysqli_query($conexion,"UPDATE mandados SET especificacion='$_POST[especificacion_mandado]' WHERE id='$_POST[id_especificacion_mandado]'");

?>