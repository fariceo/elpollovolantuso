<?php //include("conexion_merchanica.php"); 
session_start(); ?>
<?php
include("conexion_merchanica.php");
?>
<?php


if ($_POST['ver_historial'] != "") {

    $buscar_historial = mysqli_query($conexion2, "SELECT * FROM ventas ");

    while ($ver_historial = mysqli_fetch_array($buscar_historial)) {


        ?>
        <table>
            <tr>
                <td style="color:blue"><?php echo $ver_historial["usuario"]; ?></td>
                <td><?php echo $ver_historial["producto"]; ?></td>

            </tr>
            <tr>
                <td><?php echo "Total - $ " . $ver_historial["total"]; ?></td>
            </tr>
            <tr>
                <td style="color:silver"><?php echo "Fecha : " . $ver_historial["fecha"]; ?></td>
            </tr>
        </table>

        <hr>

        <?php

        // $array = explode(',', $ver_historial["producto"]);



    }

    // Recorrer el array y mostrar elementos con saltos de línea
    /*
    foreach ($array as $elemento) {
        echo $elemento . "<br>";
    }
    echo "<hr>"; // Separador entre registros de la consulta
    */
}
?>