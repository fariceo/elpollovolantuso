<script src="funciones_merchanica.js"></script>
<?php

include("conexion_merchanica.php");
?>


<div>
    <!---->
    <?php

    ///Diseño temporal
    


    if ($_POST['pedido_cliente'] != "") {

        // $pedido_cliente=ucfirst($_POST['pedido_cliente']);
    echo "<h4>Articulos</h4>";
        $buscar_pedidos = mysqli_query($conexion2, "SELECT * FROM pedidos WHERE usuario='$_POST[pedido_cliente]' AND estado!='2'");


        while ($pedido = mysqli_fetch_array($buscar_pedidos)) {

            ?>

            <table style="margin:auto">
                <tr>
                    <td style="width:150px"><?php echo $pedido['producto']; ?></td>
                    <td><input type="text" style="width:15px" value="<?php echo $pedido['cantidad']; ?>"
                            onchange="cambiar_cantidad('<?php echo $pedido[usuario] ?>','<?php echo $pedido[id] ?>','<?php echo $pedido[precio] ?>')"
                            id="cambiar_cantidad_<?php echo $pedido['id'] ?>" /></td>
                    <td onclick="poner_precio('<?php echo $pedido[usuario] ?>','<?php echo $pedido[id]?>')"><?php echo " x $ ".$pedido['precio']; ?></td>
                    <td><?php echo " = " . $totall=$pedido['cantidad']*$pedido['precio']; ?></td>
                </tr>


                <?php $total += $totall; ?>
            </table>


           
            <?php
        }
?>


            <?php
        }

    
    //fin de diseño temporal*********
    ?>

    <?php

    if ($total > 0) {
        ?>
        <a style="float:right;margin-right:45%;color:green"><?php echo "Total : $ " . $total; ?></a>

        <br><br>
        <button style="margin:auto;color:green" onclick="listo('<?php echo $_POST[pedido_cliente] ?>')">Listo</button>
    <?php } ?>
    <div style="width:100%;height:1px;background:blue"></div>
    <h3 style="text-align:center">Introducir compra</h3>
    <table style="margin:auto">
        <tr>
            <td> <input type="text" placeholder="usuario" value="<?php if ($_POST['pedido_cliente'] != "") {
                echo $_POST['pedido_cliente'];
            } ?>" id="cliente" /></td>
        </tr>
        <tr>
            <td><input type="text" placeholder="Producto" id="intro_producto" /></td>
        </tr>
        <tr>
            <td> <input type="text" placeholder="cantidad" id="cantidad" /></td>
        </tr>
        <tr>
            <td> <input type="text" placeholder="precio" id="precio" /></td>
        </tr>
        <!--
        <tr>
            <td> <input type="text" placeholder="total" id="total" /></td>
        </tr>-->
        <tr>
            <td><button style="width:50px" onclick="intro_compra('<?php echo $_POST[pedido_cliente] ?>')">Intro</button>
            </td>
        </tr>
    </table>


</div>