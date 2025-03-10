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

<form method="post">
    Usuario: <input type="text" name="usuario" required><br>
    Nombre: <input type="text" name="nombre" required><br>
    Contraseña: <input type="password" name="password" required><br>
    <button type="submit">Registrarse</button>
</form>
