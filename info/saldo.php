<meta charset="UTF-8">

<meta charset="UTF-8" name="viewport" content="width=device-width">

<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.bundle.js"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>



<!--<script src="../../jquery-3.4.0.min.js"></script>-->
<?php

include ("../../conexion.php");

error_reporting(0);

?>
<!--fecha-->
<?php
ini_set('date.timezone', 'America/Guayaquil');


//echo date("F l h:i");


setlocale(LC_ALL, "es_ES");
strftime("%A %d de %B del %Y");

//$fecha=strftime("%A %d de %B del %Y");
$fecha = date("Y-m-d");
//$fecha='2020-01-13';
$hora = date("G:i");



?>



<!--logo-->
<a href="../../admin"><img src="../../imagenes/logo.jpeg" style="height:50px;width:50px"></a>


<!--saldo por cobrar-->

<?php

$muestra_saldo_cobrar = mysqli_query($conexion, "SELECT * FROM saldo_pendiente");

while ($saldo_pendiente = mysqli_fetch_array($muestra_saldo_cobrar)) {


	if ($saldo_pendiente['accion'] == 1) {

		$saldo_cobrar_ += $saldo_pendiente['saldo_pendiente'];
	}

	if ($saldo_pendiente['accion'] == 2) {

		$saldo_pagar_ += $saldo_pendiente['saldo_pendiente'];
	}

}



echo "<a style='color: #AABE2B' href='pagos'\">cobrar $ " . $saldo_cobrar_ . "</a> / ";

echo " <a style='color:red'  href='pagos'\">Deuda ---  $ " . $saldo_pagar_ . "</a> / ";



$mostrar_stock = mysqli_query($conexion, "SELECT * FROM bodega");

while ($stock = mysqli_fetch_array($mostrar_stock)) {

	$ganancias_estimadas += $stock['aproxprofit'] * $stock['porciones'];
}

echo " <a style='color: #9E9E9E;text-decoration:none'  href='../../compras'\">expect profit $ " . $ganancias_estimadas . "</a> / ";
echo "<a id='saldo_futuro'></a>";
?>
<br>

<a href="capital">Unidad de Negocio</a><a href="../finanzas/reparto_proporcional" style="margin-left: 50px">inversores</a>
<?php
/*saldo*/
$saldo = mysqli_query($conexion, "SELECT * FROM finanzas");

while ($muestra_saldo = mysqli_fetch_array($saldo)) {

	echo "<br>Saldo Negocio: $ <a style='color:green' onClick='saldo(1)'>" . $muestra_saldo['negocio'] . "</a>";




	//if($_POST['finanzas']==1){
	?>


	<h3>Mercado Financiero</h3>

	<hr>
	<table>
		<tr>

			<td style='width:100px;'>Negocio</td>
			<td onClick="cambiar_saldo_negocio('negocio')">
				<?php echo $muestra_saldo['negocio'];
				$saldo_negocio_disponible = $muestra_saldo['negocio']; ?>
			</td>

		</tr>
		<tr>

			<td style='width:100px;'>Diezmo</td>
			<td onClick="cambiar_saldo_negocio('diezmo')">
				<?php echo $muestra_saldo['diezmo'] ?>
			</td>
		</tr>

		<tr>

			<td style='width:100px;'>beneficio</td>
			<td onClick="cambiar_saldo_negocio('beneficio')">
				<?php echo $muestra_saldo['beneficio'] ?>
			</td>
		</tr>
		<tr>

			<td style='width:100px;'>Salud</td>
			<td onClick="cambiar_saldo_negocio('salud')">
				<?php echo $muestra_saldo['salud'] ?>
			</td>
		</tr>
		<tr>

			<td style='width:100px;'>Deudas</td>
			<td onClick="cambiar_saldo_negocio('deudas')">
				<?php echo $muestra_saldo['deudas'] ?>
			</td>
		</tr>
		<tr>

			<td style='width:100px;'>Necesidades basicas</td>
			<td onClick="cambiar_saldo_negocio('basicos')">
				<?php echo $muestra_saldo['basicos'] ?>
			</td>
		</tr>

		<tr>

			<td style='width:100px;'>Iva</td>
			<td onClick="cambiar_saldo_negocio('basicos')">
				<?php echo $muestra_saldo['impuestos'] ?>
			</td>
		</tr>

	</table>



	<!--test-->

	<?php
	//echo floor(date("t")/7);
	?>


	<!--informacion de volumen de venta anual-->

	<div>

		<?php

		$volumen_venta_total = mysqli_query($conexion, "SELECT SUM(total) as venta_anual FROM ventas ");

		$venta_ano = mysqli_fetch_assoc($volumen_venta_total);

		$sales = round($venta_ano['venta_anual'], 2);
		echo "<br> <a style='text-align:center'>Venta del aÃ±o : $ " . $sales . "</a>";

		?>

	</div>




	<?php
	//}


}



?>

<?php $s = $saldo_negocio_disponible + $saldo_cobrar_ + $ganancias_estimadas - $saldo_pagar_;
echo "<script>$(\"#saldo_futuro\").html('Balance $ $s')</script>"; ?>



<!--ganancias mes actual-->
<div style="text-align: center">
	<?php
	//if($_POST['finanzas']==1){
	
	echo "<hr>";

	$hoy = date("j");
	$v = $hoy - 1;

	$primero_mes = date("Y-m-d", strtotime($fecha . "- $v days"));
	//echo "<br>".$primero_mes="2021-02-01"; 
	
	$ventas_mes = mysqli_query($conexion, "SELECT * FROM ventas WHERE fecha BETWEEN '$primero_mes' AND '$fecha'");

	while ($muestra_ventas_mes = mysqli_fetch_array($ventas_mes)) {

		if ($muestra_ventas_mes['estado'] != 2) {
			$venta_mes_actual += $muestra_ventas_mes['total'];
		}

	}


	echo "<br> Vol de venta del mes  " . $primero_mes . " al " . $fecha . " /<a style='color:green'>  $ " . $venta_mes_actual . "</a>";

	?>
	<br>
	<button onClick="info_ventas('semana')">1 semana</button>
	<button onClick="info_ventas('mes')">1 mes</button>
	<button onClick="info_ventas('aÃ±o')">1 aÃ±o</button>
	<hr>

	<?php //} ?>
</div>




<?php

//if($_POST['finanzas']==1){


?>

<!--informacionde ventas segun las fechas-->
<br>
<div>
	<?php

	if ($_POST['info_ventas'] == 'semana') {
		//$info_fecha_venta=date("Y-m-d",strtotime($fecha."- 1 week"));
		//fecha desde hoy hasta el ultimo lunes
		$dia_hoy = date("N");
		$ultimo_lunes = $dia_hoy - 1;


		echo $info_fecha_venta = date("Y-m-d", strtotime($fecha . "- $ultimo_lunes days"));
		echo " a " . $fecha;
	}


	if ($_POST['info_ventas'] == 'mes') {
		//$info_fecha_venta=date("Y-m-d",strtotime($fecha."- 1 month"));
		//$inicio_mes=date("Y-m-d",strtotime($fecha."- 1 month"));
	
		//fecha desde hoy hasta el primero de mes
	

		$ultimo_mes = $dia_mes - 1;
		echo $inicio_mes = date("Y-m-d", strtotime($fecha . "- $ultimo_mes days"));
		echo " a " . $fecha;
		$info_fecha_venta = date("Y-m-d", strtotime($fecha . "- $ultimo_mes days"));






	}


	if ($_POST['info_ventas'] == 'aÃ±o') {
		//$info_fecha_venta=date("Y-m-d",strtotime($fecha."- 1 year"));
		//fecha desde hoy hasta el primero de enero
		echo $dia_ano = date("z");

		echo "aa" . $ultimo_ano = $dia_ano - 1;

		$info_fecha_venta = date("Y-m-d", strtotime($fecha . "- $ultimo_ano days"));
	}



	?>
</div>


<!--grafica informativa-->
<a id="i_ventas_totales"></a>
<div class="grafica">
	<canvas id="myChart">
		<script>

			var php = parseInt($("#test").val());


			var ctx = document.getElementById('myChart').getContext('2d');

			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'line',

				// The data for our dataset
				data: {
					//labels: ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'],

					/*info fechas*/// info Ventas
					labels: [<?php
					//$fechas=mysqli_query($conexion,"SELECT DISTINCT fecha FROM ventas ORDER BY `fecha` ASC "); 
					/*informacion del total de las ventas en un periodo de tiempo*/

					if ($_POST['info_ventas'] == "") {
						//ventas
						$fechas = mysqli_query($conexion, "SELECT DISTINCT fecha FROM ventas WHERE estado!=2 ORDER BY `fecha` ASC");
						$total_ventas = mysqli_query($conexion, "SELECT fecha, SUM(total) AS su FROM ventas GROUP BY fecha");



					} else {
						//ventas
						$fechas = mysqli_query($conexion, "SELECT DISTINCT fecha FROM ventas WHERE estado!=2 AND fecha BETWEEN '$info_fecha_venta' AND '$fecha' ORDER BY `fecha` ASC");
						$total_ventas = mysqli_query($conexion, "SELECT fecha, SUM(total) AS su FROM ventas WHERE fecha BETWEEN '$info_fecha_venta' AND '$fecha' GROUP BY fecha");
						//compras
					}
					while ($muestra_fecha = mysqli_fetch_array($fechas)) {
						echo "'" . $muestra_fecha['fecha'] . "',";
					} ?>],
					datasets: [
						{
							label: 'VENTAS',
							backgroundColor: 'rgba(0,153, 0, 0.5)',
							fillOpacity: 0.3,
							borderWidth: 1,


							 /*Etiqueta ventas : info total segun fechas
								data: [<?php //$ventas=mysqli_query($conexion,"SELECT * FROM ventas");
								
								//while($muestra_ventas=mysqli_fetch_array($ventas)){ $t+=$muestra_ventas['total']; echo $t.",";  }  ?>]
						* /*/
							 
							 data: [<?php



							 while ($muestra_total_ventas = mysqli_fetch_array($total_ventas)) {
								 echo round($muestra_total_ventas['su'], 2) . ",";

								 //$i_ventas_totales+=$muestra_total_ventas['su'];
							 

							 }
							 ?> ]


			//data: [1,5,8] info Compras

			///fecha de gastos X semana
			<?php

			?>


				}, {
				label: 'COMPRAS',
					backgroundColor: 'rgba(255, 0, 0, 0.5)',
						borderWidth: 1,
							data: [<?php
							//compras
							/*fecha del gasto*/


							$fecha_inicio = "2021-01-01";


							//$fecha_gasto=mysqli_query($conexion,"SELECT DISTINCT fecha FROM gastos ORDER BY `fecha` ASC");
							if ($_POST['info_ventas'] == "") {
								$fecha_gasto = mysqli_query($conexion, "SELECT DISTINCT fecha FROM ventas WHERE estado!=2 ORDER BY `fecha` ASC");
							} else {
								$fecha_gasto = mysqli_query($conexion, "SELECT DISTINCT fecha FROM ventas WHERE estado!=2 AND fecha BETWEEN '$info_fecha_venta' AND '$fecha' ORDER BY `fecha` ASC");
							}
							while ($muestra_fecha_gasto = mysqli_fetch_array($fecha_gasto)) {
								//$muestra_fecha_gasto['fecha'];
								/*toal de gasto*/

								$total_compras = mysqli_query($conexion, "SELECT fecha, SUM(total) AS gasto FROM gastos WHERE fecha='$muestra_fecha_gasto[fecha]'");






								while ($muestra_compras_ = mysqli_fetch_array($total_compras)) {
									echo $muestra_compras_['gasto'] . ",";
								}
							} ?>],


			}, { label: 'test' }
						 ]
						},


			// Configuration options go here
			options: { }
					});



			//$("#myChart").hide();
		</script>



	</canvas>
</div>




<!--ventas por mes-->
<?php
$meses_pasados = date("d M,Y");
//echo $meses_pasados;
$mes_actual = date('m');
/*
							for ($i = 0; $i < $mes_actual; ++$i) {
								 echo $months[$m] = $m = date("F", strtotime("January +$i months"));
							   //echo $months[$m].",";
							

$fechas = "2018-11-25";

echo date("M", strtotime($fechas));


for($i=1; $i<$mes_actual;++$i){
							   
							   //echo $i.",";
							   $t="2021-$i";
							   echo date("M", strtotime($t)).",";
						   }
}*/


$muestra_ventas_mes_anteriores = mysqli_query($conexion, "SELECT DISTINCT fecha FROM ventas ORDER BY `fecha` ASC");
//mes en palabras echo date("M");
while ($ventas_mes_anteriores = mysqli_fetch_array($muestra_ventas_mes_anteriores)) {

	// echo $ventas_mes_anteriores['fecha'];	


	$meses_vendidos = date("M", strtotime($ventas_mes_anteriores['fecha']));


	if ($meses_vendidos == 'Jan') {
		$january = 'Enero';

		//test

		$conversion_fecha = date("");
	}

	if ($meses_vendidos == 'Feb') {
		$febrero = 'Febrero';
	}

	if ($meses_vendidos == 'Mar') {
		$marzo = 'Marzo';
	}

	if ($meses_vendidos == 'Apr') {
		$abril = 'Abril';
	}

	if ($meses_vendidos == 'May') {
		$mayo = 'Mayo';
	}

	if ($meses_vendidos == 'Jun') {
		$junio = 'junio';
	}

	if ($meses_vendidos == 'Jul') {
		$julio = 'julio';
	}

	if ($meses_vendidos == 'Aug') {
		$agosto = 'agosto';
	}

	if ($meses_vendidos == 'Sep') {
		$septiembre = 'septiembre';
	}

	if ($meses_vendidos == 'Oct') {
		$octubre = 'octubre';
	}

	if ($meses_vendidos == 'Nov') {
		$noviembre = 'noviembre';
	}

	if ($meses_vendidos == 'Dic') {
		$diciembre = 'diciembre';
	}



}

$january;
$febrero;
$marzo;
$abril;
$mayo;
$junio;
$julio;
$agosto;
$septiembre;
$octubre;
$noviembre;
$diciembre;



?>


<h3>Ventas mensuales</h3>
<div class="grafica">

	<canvas id="myChart_2">

		<script>

			var php = parseInt($("#test").val());


			var ctx = document.getElementById('myChart_2').getContext('2d');

			var chart = new Chart(ctx, {
				// The type of chart we want to create
				type: 'bar',

				// The data for our dataset
				data: {
					//labels: ['lunes', 'martes', 'miercoles', 'jueves', 'viernes', 'sabado', 'domingo'],

					/*info fechas*/// info Ventas


					labels: [
						'<?php if ($january != "") {
							echo $january;
						} ?>', '<?php if ($febrero != "") {
							 echo $febrero;
						 } ?>', '<?php if ($marzo != "") {
							  echo $marzo;
						  } ?>', '<?php if ($abril != "") {
							   echo $abril;
						   } ?>', '<?php if ($mayo != "") {
								echo $mayo;
							} ?>', '<?php if ($junio != "") {
								 echo $junio;
							 } ?>', '<?php if ($julio != "") {
								  echo $julio;
							  } ?>', '<?php if ($agosto != "") {
								   echo $agosto;
							   } ?>', '<?php if ($septiembre != "") {
									echo $septiembre;
								} ?>', '<?php if ($octubre != "") {
									 echo $octubre;
								 } ?>', '<?php if ($noviembre != "") {
									  echo $noviembre;
								  } ?>', '<?php if ($diciembre != "") {
									   echo $diciembre;
								   } ?>'
					],
					datasets: [
						{
							label: 'VENTAS',
							backgroundColor: 'rgba(0,153, 0, 0.5)',
							fillOpacity: 0.3,
							borderWidth: 1,


							 /*Etiqueta ventas : info total segun fechas
								data: [<?php //$ventas=mysqli_query($conexion,"SELECT * FROM ventas");
								
								//while($muestra_ventas=mysqli_fetch_array($ventas)){ $t+=$muestra_ventas['total']; echo $t.",";  }  ?>]
						* /
							 
								 <?php

								 $year = date("Y");
								 ?>
								 
								 
							 data: ['<?php

							 /*enero*/
							 $muestra_ventas_enero = mysqli_query($conexion, "SELECT SUM(total) as ventas_enero FROM ventas WHERE fecha BETWEEN '$year-01-01' AND '$year-01-31'");

							 $v = mysqli_fetch_assoc($muestra_ventas_enero);
							 echo $v['ventas_enero'];

							 ?>','<?php /*febrero*/
							 $muestra_ventas_febrero = mysqli_query($conexion, "SELECT SUM(total) as ventas_febrero FROM ventas WHERE fecha BETWEEN '$year-02-01' AND '$year-02-28'");

							 $v = mysqli_fetch_assoc($muestra_ventas_febrero);
							 echo $v['ventas_febrero']; ?>','<?php

							   /*marzo*/
							   $muestra_ventas_marzo = mysqli_query($conexion, "SELECT SUM(total) as ventas_marzo FROM ventas WHERE fecha BETWEEN '$year-03-01' AND '$year-03-31'");

							   $v = mysqli_fetch_assoc($muestra_ventas_marzo);
							   echo $v['ventas_marzo']; ?>','<?php

								 /*abril*/
								 $muestra_ventas_abril = mysqli_query($conexion, "SELECT SUM(total) as ventas_abril FROM ventas WHERE fecha BETWEEN '$year-04-01' AND '$year-04-31'");

								 $v = mysqli_fetch_assoc($muestra_ventas_abril);
								 echo $v['ventas_abril']; ?>','<?php

								   /*mayo*/
								   $muestra_ventas_mayo = mysqli_query($conexion, "SELECT SUM(total) as ventas_mayo FROM ventas WHERE fecha BETWEEN '$year-05-01' AND '$year-05-31'");

								   $v = mysqli_fetch_assoc($muestra_ventas_mayo);
								   echo $v['ventas_mayo']; ?>','<?php

									 /*junio*/
									 $muestra_ventas_junio = mysqli_query($conexion, "SELECT SUM(total) as ventas_junio FROM ventas WHERE fecha BETWEEN '$year-06-01' AND '$year-06-31'");

									 $v = mysqli_fetch_assoc($muestra_ventas_junio);
									 echo $v['ventas_junio']; ?>','<?php

									   /*julio*/
									   $muestra_ventas_julio = mysqli_query($conexion, "SELECT SUM(total) as ventas_julio FROM ventas WHERE fecha BETWEEN '$year-07-01' AND '$year-07-31'");

									   $v = mysqli_fetch_assoc($muestra_ventas_julio);
									   echo $v['ventas_julio']; ?>','<?php

										 /*agosto*/
										 $muestra_ventas_agosto = mysqli_query($conexion, "SELECT SUM(total) as ventas_agosto FROM ventas WHERE fecha BETWEEN '$year-08-01' AND '$year-08-31'");

										 $v = mysqli_fetch_assoc($muestra_ventas_agosto);
										 echo $v['ventas_agosto'];

										 ?>','<?php

										 /*septiembre*/
										 $muestra_ventas_septiembre = mysqli_query($conexion, "SELECT SUM(total) as ventas_septiembre FROM ventas WHERE fecha BETWEEN '$year-09-01' AND '$year-09-30'");

										 $v = mysqli_fetch_assoc($muestra_ventas_septiembre);
										 echo $v['ventas_septiembre'];

										 ?>','<?php

										 /*octubre*/
										 $muestra_ventas_octubre = mysqli_query($conexion, "SELECT SUM(total) as ventas_octubre FROM ventas WHERE fecha BETWEEN '$year-010-01' AND '$year-010-29'");

										 $v = mysqli_fetch_assoc($muestra_ventas_octubre);
										 echo $v['ventas_octubre'];

										 ?>','<?php

										 /*noviembre*/
										 $muestra_ventas_noviembre = mysqli_query($conexion, "SELECT SUM(total) as ventas_noviembre FROM ventas WHERE fecha BETWEEN '$year-11-01' AND '$year-11-30'");

										 $v = mysqli_fetch_assoc($muestra_ventas_noviembre);
										 echo $v['ventas_noviembre'];

										 ?>','<?php

										 /*diciembre*/
										 $muestra_ventas_diciembre = mysqli_query($conexion, "SELECT SUM(total) as ventas_diciembre FROM ventas WHERE fecha BETWEEN '$year-12-01' AND '$year-12-31'");

										 $v = mysqli_fetch_assoc($muestra_ventas_diciembre);
										 echo $v['ventas_diciembre'];

										 ?>' ]


			//data: [1,5,8] info Compras

			///fecha de gastos X semana
			<?php

			?>
							 
							 
							}, 
						 ]
						},


			// Configuration options go here
			options: { }
					});



			//$("#myChart").hide();
		</script>
	</canvas>


</div>


<?php //} ?>

<script>

	function saldo(e) {

		$.ajax({
			type: "POST",
			//url:"menu_cocina.php",
			url: "saldo.php",
			data: { finanzas: e },
			success: function (result) {
				$("body").html(result);
				//$("#expositor").hide();
			}


		});
	}

	function cambiar_saldo_negocio(e) {

		var cambiar_saldo_negocio = prompt("Cambiar el saldo neto de " + e);
		$.ajax({
			type: "POST",
			url: "procesar.php",
			data: { cambiar_saldo_negocio: cambiar_saldo_negocio, departamento: e },
			success: function (result) {
				//$("body").html(result);
				//$("#expositor").hide();
			}


		});

		$.ajax({
			type: "POST",
			url: "saldo.php",
			data: { finanzas: 1 },
			success: function (result) {
				$("body").html(result);
				//$("#expositor").hide();
			}


		});
	}

	function info_ventas(e) {
		$.ajax({
			type: "POST",
			url: "saldo.php",
			data: { info_ventas: e, finanzas: 1 },
			success: function (result) {
				$("body").html(result);
				//$("#expositor").hide();
			}


		});

	}



	function test(e) {
		alert(e)
	}
</script>