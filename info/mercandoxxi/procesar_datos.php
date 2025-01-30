<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
<script></script>
<?php

$conect = mysqli_connect("localhost", "root", "clave", "volantuso");

include("conexion.php");
?>




<?php
////buscar productos
if ($_POST['buscar_producto'] != "") {

    $buscar_producto_menu = mysqli_query($conect, "SELECT * FROM gastos WHERE producto like '%" . $_POST['buscar_producto'] . "%'");

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
            </tr>
            <tr>
                <td><button>+</button></td>
            </tr>
        </table>

        <?php

        echo "<script>$(\"#usuario\").html('byrito');</script>";

    }




}
?>


<?php
if ($_POST['enviar_datos'] != "") {




    $insertar_mandado = mysqli_query($conexion, "INSERT INTO `mandados` (`usuario`,`producto`,`cantidad`,`precio`,`location`,`localizador`,`especificacion`) VALUES ('$_POST[usuario]','$_POST[producto]','$_POST[cantidad]','$_POST[precio]','$_POST[location]','$_POST[localizador]','$_POST[especificacion]')");


}
?>


<?php

if($_POST['buscar_usuario']!=""){

    $buscar_usuario = mysqli_query($conexion, "SELECT DISTINCT usuario FROM mandados WHERE usuario like '%" . $_POST['buscar_usuario'] . "%'");

    while($usuario=mysqli_fetch_array($buscar_usuario)) {
        echo $usuario['usuario'];
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