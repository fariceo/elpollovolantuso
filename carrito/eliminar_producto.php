<?php
include '../../../conexion.php';
session_start();

if (isset($_POST['id'])) {

    $id = intval($_POST['id']);

    // Marcar como eliminado (estado = 2)
    $sql = "UPDATE pedidos SET estado = 2 WHERE id = $id";
    mysqli_query($conexion, $sql);

    // Contar los productos restantes del usuario
    $usuario = $_SESSION['usuario'];
    $sql2 = "SELECT COUNT(*) AS total 
             FROM pedidos 
             WHERE usuario = '$usuario' AND estado != 2";

    $res = mysqli_query($conexion, $sql2);
    $row = mysqli_fetch_assoc($res);
    $total = $row['total']; // número actual de productos en carrito

    // Respuesta para JS
    echo "OK|" . $total;

} else {
    echo "ERROR|ID no recibido";
}
?>
