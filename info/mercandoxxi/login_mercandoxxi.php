
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">


<?php
include 'conexion_mercandoxxi.php'; 
session_start();

if($_SESSION["usuario"]!=""){
    header("Location:ticket.php");
}
?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST['usuario'];
    $password = $_POST['password'];

    $sql = "SELECT id, usuario, password FROM usuarios_registrados WHERE usuario = ?";
    $stmt = $conexion->prepare($sql);
    $stmt->bind_param("s", $usuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        $usuario = $resultado->fetch_assoc();
        
        if (password_verify($password, $usuario['password'])) { // Verificar contraseña
            $_SESSION['usuario'] = $usuario['usuario'];
            header("Location:ticket.php");
            exit();
        } else {
            echo "Contraseña incorrecta.";
        }
    } else {
        echo "El usuario no existe.";
    }

    $stmt->close();
    $conexion->close();
}
?>

<div style="text-align:center; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 100vh;">


<a style=""><img src="https://th.bing.com/th/id/OIP.sSXfZIqxTRZ5hFg6wgttagHaHa?w=202&h=201&c=7&r=0&o=5&pid=1.7" style="width:150px;height:150px"></a>



<form method="post">
    <p>Usuario : </p><input type="usuario" name="usuario" required><br>
    <p>Contraseña : </p><input type="password" name="password" required><br><br>
    <button type="submit">Iniciar sesión</button>
</form>

<a href="registro_usuarios_mercandoxxi.php">Registrarse</a>
</div>
