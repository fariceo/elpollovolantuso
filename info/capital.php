<!doctype html>
<html>
<head>
<meta charset="UTF-8">
	<meta charset="UTF-8" name="viewport" content="width=device-width">

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
	<script>
		
		$(document).ready(function(){
			 
	
				 
		});
		
		
		function agregar_objeto(){
				var precio=prompt("precio de "+$("#nuevo_objeto").val());
				$.ajax({	
				type:'POST',
				//url:'menu_clientes.php',
				url:'capital.php',
				data:{nuevo_objeto:$("#nuevo_objeto").val(),precio_objeto:precio},
				success:function(result){
					$("body	").html(result);
					//$("#menu_carta").css("display","none");
				}
				
			});
		}

		function cambiar_precio(e){
		
			var cambiar_precio=prompt("Cambiar el precio de la compra");
			$.ajax({	
				type:'POST',
				url:'capital.php',
				data:{cambiar_precio:cambiar_precio,id_cambiar_precio:e},
				success:function(result){
					$("body	").html(result);
					//$("#menu_carta").css("display","none");
				}
			
			});

		}
	</script>
<title>Capital</title>
</head>

<body>
	
	<?php include('../../conexion.php');?>
	
	<!------logo---->
	<a href="saldo.php"><img src="../../imagenes/logo.jpeg" style="height:50px;width:50px"></a>
	
	
	<!---acciones de sistema--->
	<?php
		
		$nuevo_objeto=mysqli_query($conexion,"INSERT INTO capital (`objeto`,`precio`) VALUES ('$_POST[nuevo_objeto]','$_POST[precio_objeto]')");
	?>

	<?php
	///cambiar precio de la compra
	if($_POST['id_cambiar_precio']!=""){

		$nuevo_objeto=mysqli_query($conexion,"UPDATE capital SET precio='$_POST[cambiar_precio]' WHERE id='$_POST[id_cambiar_precio]'");
	}
	?>
	
	
	<div>
	
		Objeto : <input type="text" id="nuevo_objeto"/><button onClick="agregar_objeto()">ADD</button>
	
	</div>
	
	<hr>
	
	<h3 id="inversion"></h3>
	<?php
	
			$muestra_capital=mysqli_query($conexion,"SELECT * FROM capital");
	
	
			while($capital=mysqli_fetch_array($muestra_capital)){
				
				?>
	
	
	
				<table>
	
					<tr>
						<td style="width: 100px;">
							<?php echo $capital['objeto'];?>		
						</td>
						<td style="width: 100px;text-align: center" onclick="cambiar_precio('<?php echo $capital[id]?>')">
							<?php echo "$ ".$capital['precio'];?>		
						</td>
						
					</tr>
					
				</table>
	<?php
		
				$total_invertido+=$capital['precio'];
			}
	
			echo "<script> $('#inversion').html('<h3>Total invertido $ $total_invertido</h3>')</script>";
		
	?>
	
	
</body>
</html>