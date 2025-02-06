<?php include("conexion_merchanica.php");
session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

    <script src="funciones_merchanica.js"></script>
    <script src="funciones_merchanica2.js"></script>
    <script>


        $(document).ready(function () {
            // Aquí puedes agregar tu código
        });

    </script>

    <title>Document</title>
</head>

<body>
    <?php
    session_start();

    echo $_POST['usuario_sesion'];

    ///INICIAR SESION

    //$_SESSION['usuario']="gato";
   // echo 'Usuario :' . $_SESSION['usuario']; ?>

    ID : <input type="text" placeholder="Usuario" onchange="usuario(1)" id="usuario_sesion"/>

    <a onClick="cerrar_sesion()" style="float: right;margin:right:20px ;">Cerrar Sesion</a>

    <?php
echo "<br>".$_SESSION['usuario'];



    /*

    if (!empty($_SESSION["usuario"])) {
        header("Location: inicio.php");
        exit;
    }
*/

    ?>

    <!--Logo-->

    <div style="background: #173b50;color:#838383;width:100%;height:25px;text-align:center">

        <h3>MERCHANICA</h3>

    </div>

    <!--botonera-->
    <div style="text-align:center">

        <a href="inicio.php"> <img src="https://cdn-icons-png.flaticon.com/512/6522/6522516.png" style="width:25px;height:25px"></a>
        <!--<a><img src="../../imagenes/carrito.png" style="width:25px;height:25px"></a>-->
        <a onClick="tareas()"><img src="../../imagenes/tareas.png" style="width:25px;height:25px"></a>
        <a onClick="cobros()"><img src="../../imagenes/pago.png" style="width:25px;height:25px"></a>
        
        <a href="grafica_ventas_merchanica.php"><img src="../../imagenes/finanzas.png"
                style="width:25px;height:25px"></a>


    </div>

    <div style="width:100%;height:1px;background:silver;"></div>

    <!--contenedor-->
    <div id="contenedor">

        <!-- <h3 style="text-align:center">"WELCOME"</h3>-->
        <?php
        $buscar_tareas = mysqli_query($conexion2, "SELECT * FROM tareas WHERE mecanico='$_SESSION[usuario]'");

        while ($tareas = mysqli_fetch_array($buscar_tareas)) {


            ?>
            <table style="margin:auto">

                <tr>
                    <td>
                        <h4><?php echo $tareas['cliente'] ?></h4>
                    </td>
                </tr>
                <tr>
                    <td><?php echo $tareas['tarea'] ?></td>

                    <?php if ($tareas['estado'] == 0) { ?>
                        <td><input type="checkbox" onClick="tarea_lista('<?php echo $tareas["id"] ?>')" /></td><?php } else { ?>

                        <td>
                        <td><input type="checkbox" checked /></td>
                        </td>

                    <?php } ?>
                </tr>
            </table>

            <?php

        }

        ?>



    </div>
    <?php

    if (isset($_POST['cerrar_sesion'])) {

        session_destroy();
    }
    ?>

    <footer></footer>
</body>

</html>