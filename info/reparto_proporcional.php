<!doctype html>
<html>

<head>
    <meta charset="UTF-8">

    <meta charset="UTF-8" name="viewport" content="width=device-width">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script>

        $(document).ready(function () {



        });




        function inversion(e) {


            var inversion = prompt("colocar inversion");

            $.ajax({
                type: "POST",
                url: "reparto_proporcional.php",
                data: { inversion: inversion, inversionista: e },
                success: function (result) {
                    $("body").load('reparto_proporcional.php');
                    //$("form").css("display","block");
                    //$("body").load("../menu_cocina.php");

                }


            });
        }

        function nuevo_inversor() {
            var inversionista = prompt("nuevo inversor");


            $.ajax({
                type: "POST",
                url: "reparto_proporcional.php",
                data: { nuevo_inversionista: inversionista },
                success: function (result) {
                    $("body").load('reparto_proporcional.php');
                    //$("form").css("display","block");
                    //$("body").load("../menu_cocina.php");

                }


            });
        }

        function borrar_inversionista(e) {

            //	alert(e)
            $.ajax({
                type: "POST",
                url: "reparto_proporcional.php",
                data: { borrar_inversionista: e },
                success: function (result) {
                    $("body").load('reparto_proporcional.php');
                    //$("form").css("display","block");
                    //$("body").load("../menu_cocina.php");

                }


            });

        }
    </script>
</head>

<body onLoad="total_invertido()">



    <!--


            capital

            reparto proporcional consiste en la distribuciÃ³n de una cantidad en partes proporcionales a la inversion colocada.

            a,b,c

            
            700

            a=100
            b=150
            c=50
            -------
            capital total invertido = 300



            inversion .              dividendo


        a:	100     *   700 / 300 = 233,33

        b:	150     *  700 / 300 = 350

        c:	50      *  700 / 300 = 116,66


                50
        -->

    <!----->




    <div>

        <?php

        include ("../../conexion.php");
        ?>



        <!--logo-->
        <a href="../info/saldo.php"><img src="../../imagenes/logo.jpeg" style="height:50px;width:50px"></a>


        <div style="background:black;color:white">
        <?php


        ////acciones de sis
        
        if ($_POST['inversion'] != "") {

            $inversion = mysqli_query($conexion, "UPDATE invest SET inversion='$_POST[inversion]' WHERE usuario='$_POST[inversionista]'");
        }




        //nuevo inversionista
        if ($_POST['nuevo_inversionista'] != "") {
            $nuevo_inversionista = mysqli_query($conexion, "INSERT INTO invest (`usuario`,`inversion`,`dividendos`) VALUES('$_POST[nuevo_inversionista]','0','1')");
        }

        // borrar_inversionista
        
        $borrar_inversionista = mysqli_query($conexion, "DELETE FROM invest WHERE usuario='$_POST[borrar_inversionista]'");








        /// finanzas
        
        $muestra_beneficio = mysqli_query($conexion, "SELECT negocio FROM finanzas");

        $beneficio = mysqli_fetch_assoc($muestra_beneficio);
        echo "<h3>Negocio</h3>";
        echo $beneficio['negocio'];


        //beneficio d empresa
        echo "<h3>Empresa</h3>";
        echo $beneficio_empresa = round($beneficio['negocio'] * 80 / 100, 2);
        //dividendos
        echo "<h3>Dividendos</h3>";
        echo $reparto_beneficio = round($beneficio['negocio'] * 20 / 100, 2);





               ?>
</div>

<h2 style="text-align:center">Reparto Proporcional inversores</h2>
        <h3>Inversion total :</h3><a id='total_inversion'></a>



        <h3>Investing</h3>

        <table>

            <tr>
                <td style="width: 100px">Usuario</td>
                <td style="width: 100px">Inversion</td>
                <td style="width: 100px">Profit</td>
            </tr>
        </table>
        <?php

        $muestra_inversion = mysqli_query($conexion, "SELECT * FROM `invest`");

        while ($inversion = mysqli_fetch_array($muestra_inversion)) {

            ?>


            <table>

                <tr>
                    <td style="width: 100px"><?php echo $inversion['usuario']; ?></td>
                    <td style="width: 100px" onClick="inversion('<?php echo $inversion[usuario]; ?>')">
                        <?php echo " $ ".$inversion['inversion']; ?>
                    </td>
                    <td style="width: 100px">
                        <?php echo " $ ".$dividendos = round($inversion['inversion'] * $reparto_beneficio / $_POST[total_invertido], 2); ?>
                    </td>
                    <td><button onClick="borrar_inversionista('<?php echo $inversion[usuario]; ?>')"
                            style="color:red">X</button></td>
                </tr>
            </table>


            <?php
            $total_invertido += $inversion['inversion'];

        }
        echo "<script> $('#total_inversion').html('$ $total_invertido');
							
							
								function total_invertido(e){
									
								$.ajax({	
									type:'POST',
									url:'reparto_proporcional.php',
									data:{total_invertido:'$total_invertido'},
									success:function(result){
										$('body').html(result);
					
									}
				
								});
								}
							</script>";

        ?>

    </div>



    <div>

        <input placeholder="inversor" name="inversor" /><button onClick="nuevo_inversor()">intro</button>

    </div>


</body>

</html>