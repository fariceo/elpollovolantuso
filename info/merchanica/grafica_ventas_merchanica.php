<!DOCTYPE html>
<html lang="en">


<head>


    <meta charset="UTF-8" name="viewport" content="width=device-width">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gráficas con chart.js | By Parzibyte</title>
    <!-- Agrega la biblioteca Chart.js 
        -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="funciones_merchanica.js"></script>

    <!-- Agrega la biblioteca jQuery (opcional) -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>-->



    <script>

        $(document).ready(function () {



        });
        
    </script>
    <style>
        #grafica {
            width: 300px;
            height: 400px;
        }
    </style>


</head>

<body>
    <?php
    include("conexion_merchanica.php");
    ini_set('date.timezone', 'America/Guayaquil');


    //echo date("F l h:i");
    

    setlocale(LC_ALL, "es_ES");
    strftime("%A %d de %B del %Y");

    //$fecha=strftime("%A %d de %B del %Y");
    $fecha = date("Y-m-d");
    //$fecha='2020-01-13';
    $hora = date("G:i");
    ?>
   <!--Logo-->

   <div style="background: #619eff;width:100%;height:25px;text-align:center">

<h3>MERCHANICA</h3>

</div>
        <h2 style="" onClick="redireccionarPagina()">Finanzas</h2>

    <hr>
    <div>
        <button onClick="ventas('semana')">Semana</button>
        <button onClick="ventas('mes')">Mes</button>
        <button onClick="ventas('año')">Año</button>
    </div>

    <a onClick="ver_historial()"><img src="../../imagenes/historial.png" style="width:25px;height:25px"></a>


    <div id="contenedor">
    <?php
    //$info_historial_ventas = "";
    


    ///ventas de la semana
    
    if ($_POST["info_fecha_ventas"] == "semana") {


        $lunes = date("N") - 1;

        $lunes_actual = date("Y-m-d", strtotime($fecha . "- $lunes days"));

        echo "Lunes : " . $info_historial_ventas = $lunes_actual;


        $buscar_ventas = mysqli_query($conexion2, "SELECT DISTINCT ventas.fecha FROM ventas  WHERE estado!=2 AND fecha BETWEEN '$info_historial_ventas' AND '$fecha' ORDER BY `fecha` ASC");
        $total_ventas = mysqli_query($conexion2, "SELECT fecha, SUM(total) AS suma_total FROM ventas WHERE fecha BETWEEN '$info_historial_ventas' AND '$fecha' GROUP BY fecha");

    }






    //ventas del mes
    if ($_POST["info_fecha_ventas"] == "mes" || $_POST["info_fecha_ventas"] == "") {

        $primero_mes = date("j") - 1;

        echo $mes_actual = date("Y-m-d", strtotime($fecha_actual . "- $primero_mes days"));

        echo " - " . $fecha;

        $info_historial_ventas = $mes_actual;


        $buscar_ventas = mysqli_query($conexion2, "SELECT DISTINCT ventas.fecha FROM ventas  WHERE estado!=2 AND fecha BETWEEN '$info_historial_ventas' AND '$fecha' ORDER BY `fecha` ASC");
        $total_ventas = mysqli_query($conexion2, "SELECT fecha, SUM(total) AS suma_total FROM ventas WHERE fecha BETWEEN '$info_historial_ventas' AND '$fecha' GROUP BY fecha");
    }



    ?>
    <canvas id="grafica"></canvas>
    <script>



        const ctx = document.getElementById('grafica');

        new Chart(ctx, {
            type: 'bar',
            data: {
                // labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                labels: [<?php



                if ($_POST['info_fecha_ventas'] == "año") {
                    $buscar_ventas = mysqli_query($conexion2, "SELECT DISTINCT ventas.fecha FROM ventas  WHERE estado!=2 AND fecha BETWEEN '2023-01-01' AND '$fecha' ORDER BY `fecha` ASC");

                } else {
                    $buscar_ventas = mysqli_query($conexion2, "SELECT DISTINCT ventas.fecha FROM ventas  WHERE estado!=2 AND fecha BETWEEN '$info_historial_ventas' AND '$fecha' ORDER BY `fecha` ASC");

                }

                while ($suma_ventas = mysqli_fetch_array($buscar_ventas)) {

                    /* echo "<br>";
                     $fechatest = "2022-05-04";
                     $fechaSegundos = strtotime($fechatest);

                     $dia = date("j", $fechaSegundos);
                     echo $mess = date("F", $fechaSegundos);
                     $año = date("Y", $fechaSegundos);
                     */
                    ///
                    $suma_ventas["fecha"];
                    $fechaSegundos = strtotime($suma_ventas["fecha"]);
                    $mess = date("F", $fechaSegundos);

                    echo "'" . $suma_ventas["fecha"] . $mess . "',";


                }

                ?>],

                datasets: [{
                    label: 'Ventas semana',
                    backgroundColor: 'rgba(0,153, 0, 0.5)',
                    data: [<?php
                    if ($_POST['info_fecha_ventas'] == "año") {
                        $total_ventas = mysqli_query($conexion2, "SELECT fecha, SUM(total) AS suma_total FROM ventas WHERE fecha BETWEEN '2023-01-01' AND '$fecha' GROUP BY fecha");

                    } else {
                        $total_ventas = mysqli_query($conexion2, "SELECT fecha, SUM(total) AS suma_total FROM ventas WHERE fecha BETWEEN '$info_historial_ventas' AND '$fecha' GROUP BY fecha");
                    }
                    while ($muestra_total_ventas = mysqli_fetch_array($total_ventas)) {
                        $total = round($muestra_total_ventas['suma_total'], 2);

                        echo "'" . $total . "',";
                        $total_semana += round($muestra_total_ventas['suma_total'], 2);
                    } ?>],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

    </script>

    <?php
    echo "<br>Total semana : $ " . $total_semana;



    ?>


    <div>

        <?php

        //ventas del año
        
        if ($_POST['info_fecha_ventas'] == "año") {
            $mes = date("Y-m-01");
            $info_historial_ventas = $mes;


            $numero_mes = date("n");


            for ($contador = 1; $contador < $numero_mes + 1; $contador = $contador + 1) {
                setlocale(LC_TIME, 'es_ES');
                $contador;

                // $monthNumber = 5;
        
                $dateObject = DateTime::createFromFormat('!m', $contador);
                $monthName = $dateObject->format('F'); // March
        
                echo "Mes : " . $monthName;



                ///buscar el total de ventas segun mes
        




            }





        } ?>
    </div>
    </div>

</body>

</html>