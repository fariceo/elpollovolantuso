
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
include ('conexion_mercandoxxi.php'); // Archivo para conectar a la base de datos

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $nombre = $_POST['nombre'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Encriptar contraseña
    $saldo = 0;


    $sql = mysqli_query($conexion,"INSERT INTO usuarios_registrados (`usuario`, `nombre`, `password`, `saldo`) VALUES ('$usuario', '$nombre','$password', '$saldo')");
   
/*
    if ($stmt->execute()) {
        echo "Registro exitoso. <a href='login_volantuso.php'>Iniciar sesión</a>";
    } else {
        echo "Error en el registro.";
    }
   // $stmt->close();
    //$conexion->close();

    */
}
?>

<div style="text-align:center; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh;">


<a style=""><img src="https://th.bing.com/th/id/OIP.sSXfZIqxTRZ5hFg6wgttagHaHa?w=202&h=201&c=7&r=0&o=5&pid=1.7" style="width:150px;height:150px"></a>



<form method="post">
    <p>Usuario :</p> <input type="text" name="usuario" required><br>
    <p>Nombre :</p> <input type="text" name="nombre" required><br>
    <p>Contraseña :</p> <input type="password" name="password" required><br>
    <p>Nombre:</p> <input type="text" name="nombre" required><br>
    <p>Contraseña:</p> <input type="password" name="password" required><br>
    <button type="submit">Registrarse</button>
    <br><br>
    <a href="login_mercandoxxi.php">Iniciar sesión</a>
</form>
</div>