<!doctype html>
<html>

<head>

	<meta charset="UTF-8">
	<meta charset="UTF-8" name="viewport" content="width=device-width">


	<title>Ventas</title>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script src="functions.js"></script>
	<script>
		$(document).ready(function () {


		});
		//funcionesa
		{
			function calendario(e) {
				var fecha = $("#calendario").val();
				$.ajax({
					type: "POST",
					url: "info_ventas.php",
					data: { fecha: fecha },
					success: function (result) {

						$("body").html(result);
					}



				});
			}


			function deuda(e) {
				$.ajax({
					type: "POST",
					url: "info_ventas.php",
					data: { usuario: e },
					success: function (result) {

						$("body").html(result);
					}



				});

			}

			function cobrar_saldo_pendiente(e, f, g) {

				//alert(e+f+g);

				var cantidad_pendiente = prompt("introducir cantidad a cancelar");

				if (!isNaN(cantidad_pendiente) && cantidad_pendiente != "" && cantidad_pendiente != null) {
					$.ajax({
						type: "POST",
						url: "procesar.php",
						data: { usuario: e, id: f, cantidad_pendiente: cantidad_pendiente, fecha_pendiente: g },
						success: function (result) {

							//$("body").html(result);
						}



					});

				} else {

					alert("Debes introducir una cantidad valida");
				}

				$.ajax({
					type: "POST",
					url: "info_ventas.php",
					data: { fecha: g, usuario: e },
					success: function (result) {

						$("body").html(result);
					}



				});

			}


			function eliminar_venta(e, f, g) {
				var opcion = confirm("Quieres eliminar esta compra?");

				if (opcion == true) {
					$.ajax({
						type: "POST",
						url: "procesar.php",
						data: { usuario: e, id: f, fecha: g, eliminar_venta: 1 },

						success: function (result) {

							$("body").load("info_ventas.php");
						}

					});
				}

			}


			function pendiente_pago(e, f, g) {

				$.ajax({
					type: "POST",
					url: "procesar.php",
					data: { usuario: e, fecha_pendiente: f, pendiente_pago: 1, id: g },
					success: function (result) {

						$("body").html(result);
					}



				});

				$.ajax({
					type: "POST",
					url: "info_ventas.php",
					data: { fecha: f },
					success: function (result) {

						$("body").html(result);
					}



				});
			}

			function insertar_deuda(e, f, g) {
				//alert(e+f+g)
				$.ajax({
					type: "POST",
					url: "procesar.php",
					data: { usuario: e, fecha: f, hora: g, insertar_deuda: 1 },

					success: function (result) {

						$("body").html(result);
					}

				});

			}

			function cobrado(e, f, g) {

				var cantidad = prompt("introducir cantidad");

				if (!isNaN(cantidad) && cantidad != "" && cantidad != null) {
					$.ajax({
						type: "POST",
						url: "procesar.php",
						data: { usuario: e, fecha: f, hora: g, cobrado: 1, cantidad: cantidad },

						success: function (result) {

							$("body").html(result);
						}

					});

				} else {

					alert("Introduce un valor valido");
				}
			}

			function cambiar_fecha(e, f, g) {

				//alert(e+f)
				var nueva_fecha = prompt("introduce la nueva fecha");

				$.ajax({
					type: "POST",
					url: "procesar.php",
					data: { cambiar_fecha_id: e, nueva_fecha: nueva_fecha, usuario: f, buscar: f, producto: g },

					success: function (result) {

						$("body").load("info_ventas.php");
					}

				});

			}

			/*fin funciones*/

		}



		if ($("#buscar").val() == "") {



		}

		function buscar() {



			if ($("#buscar").val() != "") {
				$.ajax({
					type: "POST",
					url: "procesar.php",
					data: { buscar: $("#buscar").val() },

					success: function (result) {

						$("#expositor").html(result);
					}

				});

			} else {
				$.ajax({
					type: "POST",
					url: "info_ventas.php",
					data: { buscar: $("#buscar").val() },

					success: function (result) {

						$("body").html(result);
					}

				});

			}

		}




	</script>
</head>

<body>

	<?php
	include("../../conexion.php");
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
	<a href="../../admin.php"><img
			src="https://elpollovolantuso.com/imagenes/logo.jpeg"
			style="height:50px;width:50px"></a>
	<h3>Informacion de Ventas</h3>

	<!--informacion de ventas administrador-->

	<input type="date" id="calendario" onChange="calendario()" value="<?php if ($_POST['fecha'] == "") {
		echo "en general";
	} else {
		echo $_POST['fecha'];
	} ?>" />



	<!---buscador-->
	<img src="../../imagenes/lupa.png" style="width: 20px;height: 20px"><input type="text" id="buscar"
		placeholder="Buscar" onKeyUp="buscar()" value="<?php echo $_POST['buscar'] ?>" />
	<hr>


	<!--<div id="test">-->
	<div id="expositor">
		<?php
		//if($_POST['fecha']=="" && $_POST['buscar']==""){	
		if ($_POST['fecha'] == "" || $_POST['buscar'] == "") {

			$ventas = mysqli_query($conexion, "SELECT * FROM ventas ORDER BY fecha DESC;");
		}



		if ($_POST['fecha'] != "" || $_POST['usuario'] != "") {

			$ventas = mysqli_query($conexion, "SELECT * FROM ventas WHERE fecha='$_POST[fecha]' || usuario='$_POST[usuario]' ");

			$saldo_deuda = mysqli_query($conexion, "SELECT * FROM saldo_pendiente WHERE usuario='$_POST[usuario]'");

			while ($muestra_saldo_deuda = mysqli_fetch_array($saldo_deuda)) {
				$deuda += $muestra_saldo_deuda['saldo_pendiente'];
			}

		}


		?>

		<!--Total de deuda-->





		<a id="total_deuda"></a>

		<?php

		if ($_POST['usuario'] != "") { ?>

			<input type="text" value="<?php echo $deuda ?>" style="width: 25px;color:red"
				onchange="cobrado('<?php echo $_POST['usuario'] ?>','<?php echo $fecha ?>','<?php echo $hora ?>')" />

		<?php }
		if ($deuda == 0 && $deuda == 0) {

			?>
			<button
				onClick="insertar_deuda('<?php echo $_POST['usuario'] ?>','<?php echo $fecha ?>','<?php echo $hora ?>')">+</button>

		<?php } ?>

		<?php
		while ($muestra_ventas = mysqli_fetch_array($ventas)) {


			//info_deuda;
			if ($_POST['usuario'] != "" && $muestra_ventas['estado'] == 0) {
				$total_deuda += $muestra_ventas['total'];
				echo "<script>$(\"#total_deuda\").html(\"Total pendiente 	: $ <a style='color:red'>$total_deuda</a>\")</script>";
			}
			?>


			<table>
				<tr>
					<td style="width: 100px">
						<?php echo "<br>" . $muestra_ventas['usuario']; ?>
					</td>
					<td style="width: 200px">
						<?php echo "<br>" . $muestra_ventas['producto']; ?>
					</td>
					<td style="width: 50px">
						<?php echo "<br>" . $muestra_ventas['cantidad']; ?>
					</td>

					<!--<td style="width: 100px" onClick="cambiar_fecha('<?php echo $muestra_ventas['id'] ?>','<?php echo $muestra_ventas['usuario'] ?>')"><?php echo "<br>" . $muestra_ventas['fecha']; ?></td>-->

				</tr>
				<tr>

					<!--fecha-->
					<td style="width: 100px">
						<?php echo "<br>" . $muestra_ventas['fecha']; ?>
					</td>

					<td style='color:red'>
						<?php echo $muestra_ventas['metodo_pago'] ?>
					</td>

					<td style="width: 50px;">
						<?php echo " $ <a onClick=\"actualizar_saldo()\">" . $muestra_ventas['total'] . "</a>"; ?>
					</td>
					<!--informacion de pago-->
					<td>
						<?php

						//pendiente de pago
						if ($muestra_ventas['estado'] == 0) {

							//	echo "<a style='color:red' onClick=\"deuda('$muestra_ventas[usuario]')\">Pendiente de pago</a>";
						}

						//cancelado
						if ($muestra_ventas['estado'] == 2) {

							//echo "<a style='color: #8B0236' onClick=\"deuda('$muestra_ventas[usuario]')\">Anulado	</a>";
							echo "<button onClick=\"eliminar_venta('$muestra_ventas[usuario]','$muestra_ventas[id]','$muestra_ventas[fecha]')\">X</button>";
						}

						//pagado
						if ($muestra_ventas['estado'] == 4) {

							//echo "<a style='color:green' onClick=\"pendiente_pago('$muestra_ventas[usuario]','$muestra_ventas[fecha]','$muestra_ventas[id]')\">Pedido cancelado</a>";
					
						}

						?>


					</td>



					<!--boton cancelar-->
					<td style=" width:100px">
						<?php

						//if ($muestra_ventas['estado'] == 0) {
					
						//echo "<button onClick=\"cobrar_saldo_pendiente('$muestra_ventas[usuario]','$muestra_ventas[id]','$muestra_ventas[fecha]')\" style='color:green'>cobrar</button><button style='color:red;margin-left:10px;' onClick=\"eliminar_venta('$muestra_ventas[usuario]','$muestra_ventas[id]','$muestra_ventas[fecha]')\">X</button>";
						echo "<button style='color:red;margin-left:10px;' onClick=\"eliminar_venta('$muestra_ventas[usuario]','$muestra_ventas[id]','$muestra_ventas[fecha]')\">X</button>";
						//}
						?>

					</td>



				</tr>



			</table>

			<hr>


			<?php
		}
		?>

	</div>




</body>

</html>