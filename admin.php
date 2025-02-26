<!doctype html>
<html>

<head>
	<meta charset="UTF-8">

	<meta charset="UTF-8" name="viewport" content="width=device-width">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>

		$(document).ready(function () {



		});
	</script>



	<title>Admin</title>
</head>

<body>

	<?php
	include("conexion.php");

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


	//--------------conexion local a virtual machine desde mi computadora
	//ssh -i ~/.ssh/id_rsa brionariomen@35.223.94.102
	
	//--------------(transferir archivos desde mi pc a vm)
	//scp conexion.php brionariomen@35.223.94.102:/
	//scp procesar.php brionariomen@35.223.94.102:/var/www/elpollovolantuso/asi_sistema/hotel  
	
	//mover carpetas
	//scp imagenes brionariomen@35.223.94.102:/
	
	//copiar archivos desde maquina virtual a local
	//scp root@191.162.0.2:/writing/articles/SCP.zip Users/Edward/Desktop
	

	/*
	
	 ```bash
   gcloud compute scp --zone=us-central1-c brionariomen@elranchodelpollovolantuso:/home/brionariomen/myfile.txt .
   ```

   Or to copy to specific folder:
    ```bash
    gcloud compute scp --zone=us-central1-c brionariomen@elranchodelpollovolantuso:/var/www/elpollovolantuso/index.php /cloudshell/coding
    ```
   If you want to copy a directory use -r flag:
    ```bash
    gcloud compute scp -r --zone=us-central1-c brionariomen@elranchodelpollovolantuso:/home/brionariomen/my_directory /cloudshell
    ```
	*/

	/*Codigo de reinicio de id sql*/

	/*
										 SET  @num := 0;

									 UPDATE bodega_asiyasao SET id = @num := (@num+1);

									 ALTER TABLE bodega_asiyasao AUTO_INCREMENT =1;
									 
									 
									 */


	////envio de correo con mail jet
	/*
								  Mailjet
				  Clave secreta :b63d3c96dba5b73effbe0ac7e6253409

				  API Key:871890ba68f1afe48c467b2342b266ce

				  configurar dns
				  Configuración SPF
				  en el dns del dominio y en gcp
				  */


	/*
				
			   
	   

				
	<!--
	triggers
		
	CREATE TRIGGER `after_pedidos_delete` AFTER DELETE ON `pedidos` FOR EACH ROW INSERT INTO `ventas` (`id`,`usuario`,`producto`,`cantidad`,`precio`,`total`,`estado`,`fecha`,`hora`) VALUES (OLD.id,OLD.usuario,OLD.producto,OLD.cantidad,OLD.precio,OLD.total,OLD.estado,OLD.fecha,OLD.hora)

	DELIMITER ;

	-->




   <!---conectarse a vm desde clud shell en gcp--->
	 //gcloud compute ssh elranchodelpollovolantuso --zone=us-central1-c
				*/

	?>

	<?php include("asi_sistema/info/cuadro_balance.php"); ?>
	<br>
	<!--saldo diario-->
	<div>

		<?php

		$muestra_finanzas = mysqli_query($conexion, "SELECT * FROM finanzas");

		while ($finanzas = mysqli_fetch_array($muestra_finanzas)) {

			echo "<br><a href='asi_sistema/info/saldo'>saldo : " . $finanzas['negocio'] . "</a><br>";
		}
		?>
	</div>
	<!--logo-->
	<!--<a href="index.php"><img src="imagenes/logo.jpg" style="height:50px;width:50px"></a>-->
	<a href="index.php"><img src="imagenes/logo.jpeg" style="height:40px;width:40px"></a>

	<!----->
	<div style="text-align: center">

		<ul>
			<style>
				li {
					display: inline;
				}
			</style>
			<li><!----->
				<a href="index.php"><img src="imagenes/carta.png"
						style="width: 40px;height: 40px;text-decoration:none"></a>
			</li>
			<li><a href="asi_sistema/info/usuarios/compras_clientes"><img src="imagenes/usuarios.png"
						style="width: 40px;height: 40px"></a></li>
			<li><a href="pedidos.php"><img src="imagenes/camarero.jpeg" style="width: 40px;height: 40px"></a></li>
			<li><a href="compras"><img src="imagenes/carrito.png" style="width: 40px;height: 40px"></a></li>
			<li><a href="asi_sistema/info/saldo"><img src="imagenes/finanzas.png" style="width: 40px;height: 40px"></a>
			</li>
			<li><a href="asi_sistema/info/pagos"><img src="imagenes/pago.png" style="width: 40px;height: 40px"></a>
			</li>
			<li>
				<!----->
				<a href="asi_sistema/info/tareas"><img src="imagenes/tareas.png"
						style="width: 40px;height: 40px;text-decoration:none"></a>

				<a
					style=" background: lightblue; border-radius: 50%; width: 25px;height: 20px;color:red;text-decoration:none">

					<?php
					$buscar_tareas = mysqli_query($conexion, "SELECT count(tareas) AS tareas FROM tareas");

					$tareas = mysqli_fetch_assoc($buscar_tareas);

					echo $tareas['tareas'];
					?>
				</a>




			</li>

			<li><a href="testpedidos.php">Pt</a>
			</li>
		</ul>











	</div>


	<?php
	//include("pedidos.php");
	?>
	<div id="test"></div>

	<hr>
	<div>

		<?php

		include("asi_sistema/info/ventas/grafica_ventas.php");
		include("asi_sistema/finanzas/comparacion_ventas_xmes.php");
		?>
	</div>
</body>

</html>