<script src="funciones_merchanica.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
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



<div>

    <?php

    if ($_POST['cliente_nuevo'] != "") {

        // $cliente_nuevo = mysqli_query($conexion2, "INSERT INTO `tareas` (`cliente`, `mecanico`, `tarea`, `fecha`, `hora`) VALUES ('$_POST[cliente_nuevo]', 'default', 'default', '$fecha', '$hora')");
    }


    ?>
</div>

<?php
/*
if ($_POST['intro_tarea'] != "") {
    $intro_tarea = mysqli_query($conexion, "INSERT INTO `tareas` (`cliente`,`tarea`,`mecanico`) VALUES ('$_POST[cliente]','$_POST[nueva_tarea]','default')");
}
*/
?>


<h3>Servicio</h3>
<!---->
<?php if ($_POST['tarea'] == "" || $_POST['tarea'] == 0) { ?>

    <div style="background:#e3e5e7">
        <button style="width:20px;float:right;margin-right:25%;text-align:center" onClick="otra_tarea()">+</button>
        <a style="float:right;sticky;color:silver">Añadir tarea</a>
    </div>
    <br>
    <div style="overflow-y: scroll;height: 375px;width:100%">
        
        <?php
        // if ($_POST['a'] != '') {
    
        $buscar_clientes = mysqli_query($conexion2, "SELECT DISTINCT cliente FROM tareas WHERE estado=10");

        while ($clientes = mysqli_fetch_array($buscar_clientes)) {


            ?>

            <h2 style="background:#e9ffff ;width:100%" onclick="otra_tarea('<?php echo ucfirst($clientes[cliente]) ?>')">
                <?php echo ucfirst($clientes['cliente']) . "<hr>"; ?>
            </h2>
            <br>
            <div>
         
            <?php
                // Número de productos agregados en el carrito
                $buscar_n_tareas = mysqli_query($conexion2, "SELECT COUNT(tarea) AS n_tarea FROM tareas WHERE cliente='$clientes[cliente]' AND estado=0");
                $n_tareas = mysqli_fetch_assoc($buscar_n_tareas);


                echo  $n_tareas['n_tarea']
                ?>
              
                <a onclick="ampliar_ventana('<?php echo $clientes[cliente] ?>')"><img src="https://static.vecteezy.com/system/resources/previews/007/770/289/non_2x/hammer-and-wrench-icon-isolated-on-white-background-free-vector.jpg" style="width:25px;height:25px"></a>
                <a id="n_tareas"></a>

                <a onclick="ampliar_ventana('<?php echo $clientes[cliente] ?>')"><img src="toolgreen.png" style="width:25px;height:25px"></a>
                <a id="n_tareas"></a>

                <a onclick="ampliar_ventana('<?php echo $clientes[cliente] ?>')"><img src="toolsred.png" style="width:25px;height:25px"></a>
                <a id="n_tareas"></a>

                <?php
                // Número de productos agregados en el carrito
                $buscar_productos = mysqli_query($conexion2, "SELECT COUNT(producto) AS n_producto FROM pedidos WHERE usuario='$clientes[cliente]'");
                $n_productos = mysqli_fetch_assoc($buscar_productos);


                ?>
                <a style="float:right;margin-right:25px"
                    onclick="ver_pedido('<?php echo $clientes[cliente] ?>')"><?php echo "Nº Articulos : " . $n_productos['n_producto']; ?><img
                        src="../../imagenes/carrito.png" style="widht:25;height: 25px;"></a><br>

            </div>


            <?php
            //$buscar_tareas = mysqli_query($conexion2, "SELECT * FROM tareas WHERE cliente ='$clientes[cliente]' ");
    

            ?>

            <div id="tareas_<?php echo $clientes['cliente']; ?>">

            </div>

            <?php
        }

        ?>

    </div>

<?php } ?>


<!--añadir tarea-->
<?php if ($_POST['tarea'] == 1) { ?>


    <h2>Cliente : <input type="text" placeholder="Cliente" onkeyup="buscar_cliente()" id="cliente_nuevo" value="<?php if ($_POST['cliente_nuevo'] != "") {
        echo ucfirst($_POST['cliente_nuevo']);
    } ?>" style="capitalize" /></h2>






   
    <div id="resultado_buscar_cliente" style="overflow-y: scroll;background:silver;color:black"></div>
    <br>
    <input type="text" style="overflow-wrap" id="intro_tarea" placeholder="Agregar Tarea"/> 
    <button style="width:20px;" onClick="otra_tarea(2)">+</button>

<?php } ?>