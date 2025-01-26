<!doctype html>
<html>

<head>
	<meta charset="UTF-8">
	<meta charset="UTF-8" name="viewport" content="width=device-width">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

	<script>
		$(document).ready(function () {


		});


		function compra() {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { compra: "1" },
				success: function (result) {
					$("body").html(result)
				}


			});
		}

		function almacen() {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { almacen: 1 },
				success: function (result) {
					$("body").html(result)
				}


			});
		}


		function calendario(e) {

			if (e == "") {
				$.ajax({

					type: "POST",
					url: "compras.php",
					data: { fecha: $("#calendario").val(), gastos: 1 },
					success: function (result) {

						$("body").html(result);
					}
				});
			} else {
				$.ajax({

					type: "POST",
					url: "compras.php",
					data: { fecha: e, gastos: 1 },
					success: function (result) {

						$("body").html(result);
					}
				});


			}
		};

		function agregar_lista() {
			var producto = $("#producto").val();
			var precio = $("#precio").val();
			var peso = $("#peso").val();
			var total = peso * precio;

			//alert(producto+precio+peso+total)
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { producto: producto, peso: peso, precio: precio, compra: 1 },
				success: function (result) {
					$("body").html(result);
				}
			});





		}

		function lanzar_producto() {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { lanzar_producto: 1 },
				success: function (result) {
					$("body").html(result)
				}


			});
		}

		function habilitar_producto(e, f, g, h) {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { habilitar_producto: e, categoria: f, seccion: g, lanzar_producto: 1, estado: h, seleccionar_categoria: f },
				success: function (result) {
					$("body").html(result)
				}


			});
		}

		function historial() {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { historial: 1 },
				success: function (result) {
					$("body").html(result)
				}


			});
		}

		function categoria(e) {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { categoria: e, almacen: 1 },
				success: function (result) {
					$("body").html(result)
				}


			});
		}


		function fecha_menu(e) {
			var fecha = prompt("cambiar fecha");
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { id_fecha_menu: e, fecha_menu: fecha, lanzar_producto: 1 },
				success: function (result) {
					$("body").html(result)
				}


			});
		}

		function seleccionar_categorias(e) {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { lanzar_producto: 1, seleccionar_categoria: e },
				success: function (result) {
					$("body").html(result)
				}


			});
		}



		function receta(e, f) {


			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { lanzar_producto: 1, seleccionar_categoria: 'nada', receta: e },
				success: function (result) {
					$("body").html(result)
				}


			});

		}

		function cambiar_precio(e, f) {
			var cambiar_precio = prompt('Introducir precio');
			alert()

			if (!isNaN(cambiar_precio) && cambiar_precio != null && cambiar_precio != "") {
				$.ajax({
					type: "POST",
					url: "compras.php",
					data: { id_precio: e, lanzar_producto: 1, categoria: f, cambiar_precio: cambiar_precio },
					success: function (result) {
						$("body").html(result);
					}

				});
			} else {

				alert("Debes introducir solo valores numericos");
			}
		}


		//////


		function comprado(e, f, g) {
			//alert(e+"ooho"+f+g);


			$.ajax({

				type: "POST",
				url: "compras.php",
				data: { id_comprado: e, precio: f, peso: g },
				success: function (result) {

					$("body").html(result);
				}
			});
		}


		function cambiar_total(e) {

			//alert(e);
			var total = prompt('total de producto');
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { id_cambiar_total: e, nuevo_total: total },
				success: function (result) {
					$("body").html(result);
				}

			});
		}


		function nuevo_producto(e) {
			//alert($("#nuevo_producto").val());
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { nuevo_producto: $("#nuevo_producto").val(), almacen: 1 },
				success: function (result) {
					$("body").html(result);
				}

			});
		}

		function eliminar_producto(e) {

			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { id_eliminar_producto: e, almacen: "" },
				success: function (result) {
					$("body").html(result);
				}

			});
		}

		function gasto(e) {
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { gastos: e },
				success: function (result) {
					$("body").html(result);
				}

			});

		}

		function restar_stock(e, f) {
			//alert(f)
			//restar porciones
			var restar_stock = parseInt(f) - 1;
			//alert(restar_stock);
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { id_producto_bodega: e, almacen: 1, actualizar_stock: restar_stock },
				success: function (result) {
					$("body").html(result);
				}

			});
		}

		function cambiar_fecha(e) {
			//alert(f)
			var nueva_fecha = prompt("nueva fecha");
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { id_nueva_fecha: e, nueva_fecha_compra: nueva_fecha },
				success: function (result) {
					$("body").html(result);
				}

			});



		}


		function agregar_relacion(e, f) {
			var a = prompt("agregar plato al producto " + " " + e);

			var agregar_relacion = f + "," + a;

			//alert(agregar_relacion);
			$.ajax({
				type: "POST",
				url: "asi_sistema/info/procesar2.php",
				data: { seleccionar_categorias: 3, agregar_relacion: agregar_relacion, producto: e },
				success: function (result) {
					//$("body").html(result);
				}

			});
			$.ajax({
				type: "POST",
				url: "compras.php",
				data: { almacen: 1 },
				success: function (result) {
					$("body").html(result);
				}

			});

		}
	</script>
	<title>Compras</title>

</head>

<!--<link href="menu_cocina.css" rel="stylesheet" type="text/css">-->

<body>


	<?php
	error_reporting(0);
	include ("conexion.php");
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

	<!--acciones de sistema-->
	<div>
		<?php
		/*proceso de actividades*/


		//stock
		if ($_POST['actualizar_stock'] != "") {

			//$actualizar_stock = mysqli_query($conexion, "UPDATE bodega SET porciones='$_POST[actualizar_stock]' WHERE  id='$_POST[id]' || id='$_POST[id_producto_bodega]'");
			$actualizar_stock = mysqli_query($conexion, "UPDATE `bodega` SET `porciones` = '$_POST[actualizar_stock]' WHERE id='$_POST[id_producto_bodega]'");

		}



		//compra
		
		if ($_POST['peso'] != "") {

			$gastos = mysqli_query($conexion, "INSERT INTO gastos (`producto`,`peso`,`total`,`fecha`,`hora`,`estado`) VALUES ('$_POST[producto]','$_POST[peso]','$_POST[precio]','$fecha','$hora','0')");





		}


		//nuevo precio
		if ($_POST['precio'] != "") {

			$precio = mysqli_query($conexion, "UPDATE bodega SET aproxprofit='$_POST[precio]' WHERE id='$_POST[id]'");
		}


		// nuevo producto
		
		if ($_POST['nuevo_producto'] != "") {

			$nuevo_producto = mysqli_query($conexion, "INSERT INTO `bodega` (`producto`,`relacion`,`porciones`,`aproxprofit`) VALUES ('$_POST[nuevo_producto]',`relacion`,'0','0')");

		}

		//habilitar_producto
		
		if ($_POST['habilitar_producto'] != "") {

			$habilitar_producto = mysqli_query($conexion, "UPDATE menu SET estado='$_POST[estado]',categoria='$_POST[categoria]',seccion='$_POST[seccion]' WHERE producto='$_POST[habilitar_producto]'");
		}

		//eliminar producto
		
		if ($_POST['eliminar'] != "") {

			$eliminar_producto = mysqli_query($conexion, "DELETE FROM bodega WHERE id='$_POST[eliminar]'");
		}

		//actualizar capital de producto
		
		if ($_POST[id_capital_acumulado] != "") {

			$actualizar_capital = mysqli_query($conexion, "UPDATE bodega SET capital='$_POST[actualizar_capital]' WHERE id='$_POST[id_capital_acumulado]'");
		}



		// fecha de lanzamiento del plato
		
		if ($_POST['fecha_menu'] != "") {

			$fecha_menu = mysqli_query($conexion, "UPDATE menu SET fecha='$_POST[fecha_menu]' WHERE id='$_POST[id_fecha_menu]'");
		}

		// precio del plato
		if ($_POST['id_precio'] != "") {
			$cambiar_precio = mysqli_query($conexion, "UPDATE menu SET precio='$_POST[cambiar_precio]' WHERE id='$_POST[id_precio]'");

		}


		//producto comprado
		
		if ($_POST[id_comprado] != "") {

			$producto_comprado = mysqli_query($conexion, "UPDATE gastos SET estado='1' WHERE id='$_POST[id_comprado]'");

			$actualizar_fecha_compra = mysqli_query($conexion, "UPDATE gastos SET fecha='$fecha' WHERE id='$_POST[id_comprado]'");

			$total_gasto = $_POST['precio'];

			//restar saldo de la tabla finanzas
			$restar_dinero_negocio = mysqli_query($conexion, "SELECT * FROM finanzas");

			while ($muestra_finanzas = mysqli_fetch_array($restar_dinero_negocio)) {
				$negocio = $muestra_finanzas['negocio'];
			}

			$restar_saldo_negocio = $negocio - $total_gasto;

			$actualizar_dinero_negocio = mysqli_query($conexion, "UPDATE finanzas SET negocio='$restar_saldo_negocio'");

			//actualizar cantidad del producto
		
		}


		/// cambiar total
		
		if ($_POST['id_cambiar_total'] != "") {

			$cambiar_tatal = mysqli_query($conexion, "UPDATE gastos SET total='$_POST[nuevo_total]' WHERE id='$_POST[id_cambiar_total]'");
		}

		/// eliminar producto
		
		if ($_POST['id_eliminar_producto'] != "") {

			$id_eliminar_producto = mysqli_query($conexion, "DELETE FROM gastos WHERE id='$_POST[id_eliminar_producto]'");
		}


		///nueva fecha compra
		
		if ($_POST['id_nueva_fecha'] != "") {

			$id_nueva_fecha = mysqli_query($conexion, "UPDATE gastos SET fecha='$_POST[nueva_fecha_compra]' WHERE id='$_POST[id_nueva_fecha]'");
		}

		?>

	</div>



	<div style="text-align: center">
		<a href="admin"><img src="imagenes/logo.jpeg" style="height: 50px;width: 50px"></a>
		<!--<a href="menu_cocina.php"><img src="imagenes/carta.png" style="height: 50px;width: 50px"></a>-->
		<!--<a href="compras.php" ><img src="imagenes/barriles.png" style="height: 50px;width: 50px"></a>-->
		<a><img src="imagenes/carrito.png" style="height: 50px;width: 50px" onClick="compra()"></a>
		<a><img src="imagenes/barriles.jpeg" style="height: 50px;width: 50px" onClick="almacen()"></a>

		<a onClick="lanzar_producto()"><img src="imagenes/chef.jpeg" style="height: 50px;width: 50px"></a>


		<a href="asi_sistema/info/pagos"><img src="imagenes/pago.png" style="width: 50px;height: 50px"></a>
		
       
				
					
				
        <hr>


        <button><a href="imagenes/subir_img">subir plato</a></button>
		<!--calendario-->

		<?php
		if ($_POST['historial' != ""]) {
			?>

			Fecha : <input type="date" id="calendario" onChange="calendario()" value="<?php if ($_POST['fecha'] != "") {
				echo $_POST['fecha'];
			} ?>" />

			<h5 onClick="historial()">Historial</h5>
			<hr>
			<?php
		}
		?>

	</div>


	<div>

		<!--menu de navegacion lanzar producto*********************************************************************-->

		<?php
		if ($_POST['lanzar_producto'] == 1) {
			?>



			<table style="background: black;color:white;margin-left: auto;margin-right: auto">
				<tr>
					<td>categoria</td>
					<!--<td>seccion</td>-->
					<td>producto</td>
					<td>estado</td>
					<td>Fecha de lanzamiento</td>
				</tr>
			</table>




			<?php

			$muestra_categorias = mysqli_query($conexion, "SELECT DISTINCT menu.categoria FROM menu");

			while ($categorias = mysqli_fetch_array($muestra_categorias)) {
				?>
<br>
				<button onClick="seleccionar_categorias('<?php echo $categorias['categoria'] ?>')">
					<?php echo $categorias['categoria']; ?>
				</button>

                <br>
				<?php
			}

		} ?>



		<!--menu navegacion  almacen*********************************************************************-->

		<?php


		if ($_POST['almacen'] != "") {

			echo "<h3 style='text-align:center'>ALMACEN</h3>";
			?>


			<?php




			$seleccion = mysqli_query($conexion, "SELECT DISTINCT bodega.clasificacion FROM bodega");

			while ($muestra_seleccion = mysqli_fetch_array($seleccion)) {
				?>
				<button onClick="categoria('<?php echo $muestra_seleccion['clasificacion']; ?>')">
					<?php echo $muestra_seleccion['clasificacion']; ?>
				</button>


				<?php
			}
			?>



		<?php } ?>
	</div>

	<div id="contenedor">



		<!--historial de compras por fechas-->

		<?php
		if ($_POST["historial"] != "") {

			/*Historial de las fechas en las que se realizo la compra*/
			$date = mysqli_query($conexion, "SELECT DISTINCT fecha FROM gastos");
			echo "<br>";
			while ($muestra_date = mysqli_fetch_array($date)) {
				echo " - <a style='color:blue' onClick=\"calendario('$muestra_date[fecha]')\">" . $muestra_date['fecha'] . "</a><br>";
			}

		}

		?>





		<?php


		$gastos = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha='$_POST[fecha]'");

		/**/
		if ($_POST['fecha'] != "") {
			echo "<h3>Gastos</h3>";

			echo "Fecha : " . $_POST['fecha'];

			echo "<a id='gasto_total' style='color:red'></a>" . "<hr>";
		}

		while ($muestra_gastos = mysqli_fetch_array($gastos)) {
			?>


			<!--lista de compra realizada-->
			<table>
				<tr>

					<td>
						<?php echo $muestra_gastos['producto']; ?>
					</td>
					<td>
						<?php echo $muestra_gastos['peso']; ?>
					</td>

					<!--gasto total-->
					<td>
						<?php
						echo $muestra_gastos['total'];
						$total_gasto += $muestra_gastos['total'] * $muestra_gastos['peso'];
						echo "<script>$(\"#gasto_total\").html(' / $ $total_gasto')</script>";
						?>

					</td>

					<!--total-->
					<td>

						<?php

						echo "$ " . $muestra_gastos['total'] * $muestra_gastos['peso'];

						?>
					</td>

				</tr>


			</table>

			<hr>

			<?php
		}


		?>






		<!------------------------------------compras--------------------------------------------->



		<?php if ($_POST['almacen'] == "" && $_POST['lanzar_producto'] == "") { ?>

		<div>


<h3 style="text-align: center;"><a href="asi_sistema/mercandoxxi/mandados.php">Mercandoxxi</a></h3>


			<!--compra de producto-->
				<h3 style="text-align: center"> Lista de compra</h3>




				<!--Calculo de fecha para la ultima semana en la que se realizo la compra-->
				<div style="text-align: center">
					<?php

					$lunes = 1;
					$dia_numerico_actual = date("N");

					$transcurso_dias = $dia_numerico_actual - $lunes;

					//resto 1 día
					$fecha_lunes = date("Y-m-d", strtotime($fecha . "- $transcurso_dias days"));


					//mes
				
					//$fecha_lunes=date("Y-m-d",strtotime($fecha."- 9 days"));
					//echo "<br>dias del mes " . $fecha_mes = date("Y-m-d", strtotime($fecha . "- j days"));
					$mes_corriente = date("Y-m-01");
					"<br>dias del mes " . $fecha_mes = $mes_corriente;



					?>

					<?php














					while ($muestra_gastos_semana = mysqli_fetch_array($gastos_ultima_semana)) {
						$muestra_gastos_semana['fecha'];


					}

					if ($_POST['gastos'] == 'd') {

						$total_gasto = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha = '$fecha' AND estado='1'");
					}

					if ($_POST['gastos'] == 's' || $_POST['gastos'] == "") {

						$total_gasto = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_lunes' AND '$fecha' AND estado='1'");
					}

					if ($_POST['gastos'] == 'm') {

						$total_gasto = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_mes' AND '$fecha' AND estado='1'");
					}

					if ($_POST['gastos'] == 'lista') {

						//$total_gasto = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_mes' AND '$fecha' AND estado='1'");
						$total_gasto = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_lunes' AND '$fecha' AND estado='0'");
					}






					while ($muestra_total_gasto = mysqli_fetch_array($total_gasto)) {

						//$gasto_semana+=$muestra_total_gasto['total']*$muestra_total_gasto['peso'];
						$gasto += $muestra_total_gasto['total'];
					}

					//echo "<p style='background:black;color:white;' >Gastos de semana del ".$fecha_lunes." al ".$fecha." / <a id='gasto_semana' style='color:red'>$ $gasto_semana</a></p>"; 
				


					echo "<p style='background:black;color:white;' >Total gastado  / $ <a id='gasto_semana' style='color:red'> $gasto</a>--Total en lista<a id='gasto_lista'></a></p>";

					//Total gastado
				


					?>
					<a>Gastos : </a>
					<button onClick="gasto('d')">Diario</button>
					<button onClick="gasto('s')">Semana</button>
					<button onClick="gasto('m')">Mes</button>
					<a>----</a>
					<button onClick="gasto('lista')" style='background:green'>Compras Pendientes</button>
				</div>

				<!--Lista de compra-->
				<h3 style='text-align:center'>Agregar compra</h3>

				<table style="margin-right: auto;margin-left: auto; border-collapse: collapse;">
					<tr>
						<td style="border: 1px solid black;width: 100px">
							<h3>Producto</h3>
						</td>
						<td style="border: 1px solid black;width: 100px">
							<h3>Cantidad</h3>
						</td>
						<td style="border: 1px solid black;width: 100px">
							<h3>Precio</h3>
						</td>

					</tr>

					<tr>
						<td><input type="text" id="producto" style="width: 100px;" /></td>
						<td><input type="text" id="peso" style="width: 30px;" /></td>
						<td><input type="text" id="precio" style="width: 30px;" /><button id="gastar"
								onClick="agregar_lista()">Add</button></td>


					</tr>
				</table>
				<hr>
				<div style="overflow-y: scroll;height: 300px">
					<table style="margin-right: auto;margin-left: auto">



						<?php

						//compras de hoy
					
						if ($_POST['gastos'] == 'd') {

							//$seleccionar_lista=mysqli_query($conexion,"SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_lunes' AND '$fecha' ORDER BY estado ASC");
							$seleccionar_lista = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha = '$fecha' ORDER BY estado ASC");
						}

						//compras de la semana
					
						if ($_POST['gastos'] == 's' || $_POST['gastos'] == "") {

							$seleccionar_lista = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_lunes' AND '$fecha' ORDER BY estado ASC");

						}

						//compras del mes
					
						if ($_POST['gastos'] == 'm') {

							$seleccionar_lista = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_mes' AND '$fecha' ORDER BY estado ASC");

						}

						//compras pendientes
						if ($_POST['gastos'] == 'lista') {

							$seleccionar_lista = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_mes' AND '$fecha' AND estado='0' ORDER BY estado ASC");
							$seleccionar_lista = mysqli_query($conexion, "SELECT * FROM gastos WHERE fecha BETWEEN '$fecha_mes' AND '$fecha' AND estado='0' ORDER BY estado ASC");

						}
						while ($lista = mysqli_fetch_array($seleccionar_lista)) {



							?>

							<tr style="height:50px">
								<td style="width:100px;color:blue">
									<?php echo $lista['producto'] ?>
								</td>
								<td style="width: 100px;text-align: center">
									<?php echo $lista['peso'] ?>
								</td>

								<!--cambiar_ total-->
								<?php if ($lista['estado'] == 0) { ?>
									<td style="width: 100px;text-align: center" onClick="cambiar_total('<?php echo $lista[id] ?>')">
										<?php echo $lista['total'] ?>
									</td>
								<?php } else { ?>
									<td style="width: 100px;text-align: center">
										<?php echo $lista['total'] ?>
									</td>
								<?php } ?>

								<!---listo--->
						<?php if ($lista['estado'] == 0) { ?>
						<td><input type="checkbox"
								onClick="comprado('<?php echo $lista[id] ?>','<?php echo $lista[total]; ?>','<?php $lista[peso]; ?>')" />
						</td>
						<td><button onClick="eliminar_producto('<?php echo $lista[id] ?>')"
								style="color: red;margin-left: 25px">X</button></td>
						<?php } ?>
					</tr>

					<tr>
						<td onClick="cambiar_fecha('<?php echo $lista[id]; ?>')">
							<?php echo $lista['fecha']; ?>
						</td>
					</tr>
					<?php if ($lista['estado'] == 0) {
						$total_lista += $lista['total'];
					} ?>

					<?php } ?>


					<?php echo "<script> $(\"#gasto_lista\").html(' / $ '+$total_lista);</script>"; ?>


				</table>
			</div>


		</div>
		<?php }
		  ?>










		<!--bodega----------------------------------------------------------------------------------->

		<div>
			<?php
			if ($_POST['almacen'] == 1) {


				/*insertar productos*/

				?>

			<table style="margin:auto;">
				<tr>

					<td style="width: 150px">Nuevo Producto : </td>
					<td><input type="text" id="nuevo_producto" /></td>
					<td><button onClick="nuevo_producto('<?php echo $_POST['categoria'] ?>')">Introucir
							producto</button>
					</td>

				</tr>
			</table>
			<table style="margin-right: auto;margin-left: auto">


				<tr style="background: black;color: white">
					<td>Producto</td>
					<td style="width: 50px">stock</td>
					<td>aprox profit</td>
					<td>Eliminar</td>
				</tr>

				<tr style="height:50px">
					<!--Calculo de fecha para la ultima semana-->
						<?php

						$lunes = 1;
						$dia_numerico_actual = date("N");

						$transcurso_dias = $dia_numerico_actual - $lunes;

						//resto 1 día
						$fecha_lunes = date("Y-m-d", strtotime($fecha . "- $transcurso_dias days"));
						//$fecha_lunes=date("Y-m-d",strtotime($fecha."- 9 days"));
					
						//echo "<a style='background:black;color:white'>semana del ".$fecha_lunes." al ".$fecha."</a>"; 
						?>



						<?php


						$menu = mysqli_query($conexion, "SELECT * FROM bodega");

						while ($muestra_productos = mysqli_fetch_array($menu)) {

							?>


							<td>


								<?php


								echo $muestra_productos['producto'] . "<br><a style='color:silver' onClick=\"agregar_relacion('$muestra_productos[producto]','$muestra_productos[relacion]')\">" . $muestra_productos['relacion'] . "</a>";


								?>



							</td>

							<!--stock-->
							<td style="text-align: center;height: 50px"
								onClick="actualizar_stock('<?php echo $muestra_productos['porciones'] ?>','<?php echo $muestra_productos['producto'] ?>','<?php echo $muestra_productos['id'] ?>','<?php echo $_POST[categoria] ?>')">

								<?php
								if ($muestra_productos['porciones'] <= 2) {
									echo "<a style='color:red'>" . $muestra_productos['porciones'] . "</a>";
								}

								if ($muestra_productos['porciones'] >= 3 && $muestra_productos['porciones'] <= 6) {
									echo "<a style='color:yellowgreen'>" . $muestra_productos['porciones'] . "</a>";
								}

								if ($muestra_productos['porciones'] >= 6) {
									echo "<a style='color:green'>" . $muestra_productos['porciones'] . "</a>";
								}



								?>
							</td>

							<!--precio-->
							<td onClick="precio('<?php echo $muestra_productos['producto'] ?>','<?php echo $muestra_productos['id'] ?>','<?php echo $_POST[categoria] ?>')"
								style="width: 28px"> $
								<?php echo $muestra_productos['aproxprofit'];
								echo "<a style='color: #9E9E9E;'> " . $aprox = $muestra_productos['porciones'] * $muestra_productos['aproxprofit'] . "</a>"; ?>
							</td>

							<!--Eliminar producto-->

							<td><button
									onClick="restar_stock('<?php echo $muestra_productos[id] ?>','<?php echo $muestra_productos[porciones] ?>')">-</button>
								<button onClick="eliminar_producto('<?php echo $muestra_productos[id] ?>')"
									style="color: red;margin-left: 30px">X</button>
							</td>



							<?php ?>

							<!--informacion de ventas--------*¿?¿?¿?¿?¿???????????¿?¿?¿?¿?¿?¿?*****************************¨*¨*¨*^*^*^*?¿?¿?¿?¿^^*^*^*¨*¨*¨*¨-->

						</tr>











						<?php


						}
						?>

				</table>
				<!--eventos para almacen-->
				<script>
					function elegir_producto() {

						$.ajax({
							type: "POST",
							url: "compras.php",
							data: { categoria: e },
							success: function (result) {
								$("body").html(result)
							}


						});
					}

					function actualizar_stock(e, f, g, h) {

						var stock = e;
						//alert(stock);
						var cantidad = prompt("Cantidad de " + f);

						var actualizar_stock = parseInt(cantidad) + parseInt(e);
						//var total=cantidad*i;
						//alert(actualizar_stock);

						if (!isNaN(cantidad) && cantidad != null && cantidad != "") {

							$.ajax({
								type: "POST",
								url: "compras.php",
								data: { actualizar_stock: actualizar_stock, id_producto_bodega: g, categoria: h, porciones: cantidad, producto: f, almacen: 1 },
								success: function (result) {
									$("body").html(result)
								}


							});
						} else {
							alert("no has introducido una cantidad correcta");
						}

					}

					function comprar(e, f, g, h) {

						var cantidad = prompt("cantidad de " + e);
						var actualizar_stock = parseInt(cantidad) + parseInt(h);
						if (!isNaN(cantidad) && cantidad != null && cantidad != "") {

							$.ajax({
								type: "POST",
								url: "compras.php",
								data: { producto: e, gastos: 1, peso: cantidad, precio: f, actualizar_stock: actualizar_stock, id: g, categoria: "<?php echo $_POST[categoria] ?>" },
								success: function (result) {
									$("body").html(result)
								}


							});

						} else {
							alert("no has introducido una cantidad correcta");
						}
					}

					function precio(e, f, g) {


						var precio = prompt("Precio para " + e)

						if (!isNaN(precio) && precio != null && precio != "") {
							$.ajax({
								type: "POST",
								url: "compras.php",
								data: { precio: precio, id: f, categoria: g, almacen: 1 },
								success: function (result) {
									$("body").html(result);
								}

							});

						} else {

							alert("Debes introducir valores numericos");
						}
					}



					function eliminar_producto(e) {

						$.ajax({
							type: "POST",
							url: "compras.php",
							data: { eliminar: e, categoria: "<?php echo $_POST['categoria'] ?>" },
							success: function (result) {
								$("body").html(result);
							}

						});
					}

					function capital_acumulado(e) {
						var capital = prompt("introducir cantidad");

						$.ajax({
							type: "POST",
							url: "compras.php",
							data: { id_capital_acumulado: e, actualizar_capital: capital, categoria: '<?php echo $_POST['categoria'] ?>' },
							success: function (result) {
								$("body").html(result);
							}

						});
					}




					<?php


					?>

				</script>

			<?php } ?>
		</div>






		<!--Lanzar producto Chef-->

		<div>


			<?php
			if ($_POST['lanzar_producto'] != "") {


				
				?>

<h3><?php echo $_POST['seleccionar_categoria']; ?></h3>
			
				<?php
				//$productos_=mysqli_query($conexion,"SELECT * FROM menu WHERE estado=0");
			

				if ($_POST['seleccionar_categoria'] == "") {
					$productos_ = mysqli_query($conexion, "SELECT * FROM menu WHERE categoria='jugos'");
				}
				if ($_POST['seleccionar_categoria'] != '') {

					$productos_ = mysqli_query($conexion, "SELECT * FROM menu WHERE categoria='$_POST[seleccionar_categoria]'");
				}
				if ($_POST['seleccionar_categoria'] == 'nada') {
					$productos_ = mysqli_query($conexion, "SELECT * FROM menu WHERE categoria='nada'");
				}


				while ($muestra_productos_ = mysqli_fetch_array($productos_)) {


					?>
					<table>

						<tr>

							<!--<td><? php // echo $muestra_productos_['seccion'];                                                                     ?></td>-->
							<td onClick="receta('<?php echo $muestra_productos_[producto] ?>')">
								<?php echo $muestra_productos_['producto']; ?>
							</td>



							<td style="width: 50px">

								<?php

								if ($muestra_productos_['estado'] == 1) {
									?>
									<input type="checkbox" checked
										onClick="habilitar_producto('<?php echo $muestra_productos_['producto'] ?>','<?php echo $muestra_productos_['categoria'] ?>','<?php echo $muestra_productos_['seccion'] ?>',0)" />
									<?php
								} else {
									?>
									<input type="checkbox"
										onClick="habilitar_producto('<?php echo $muestra_productos_['producto'] ?>','<?php echo $muestra_productos_['categoria'] ?>','<?php echo $muestra_productos_['seccion'] ?>',1)" />
									<?php

								}
								?>




							</td>
							<td>
								<a
									onClick="cambiar_precio('<?php echo $muestra_productos_[id]; ?>','<?php echo $muestra_productos_[categoria]; ?>')">$
									<?php echo $muestra_productos_['precio'] ?>
								</a>
							</td>


							<td onClick="fecha_menu('<?php echo $muestra_productos_[id] ?>')">
								<?php echo $muestra_productos_['fecha'] ?>
							</td>
						</tr>

					</table>
					<hr>
					<?php
				}


				include ('receta.php');

			}
			?>



		</div>


	</div>
</body>

</html>