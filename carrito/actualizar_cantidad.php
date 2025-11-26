<?php
include("../../../conexion.php");

if (!isset($_POST['id']) || !isset($_POST['cantidad'])) {
    echo "Datos incompletos";
    exit;
}

$id = intval($_POST['id']);
$cantidad = intval($_POST['cantidad']);

if ($cantidad < 1) {
    echo "Cantidad inválida";
    exit;
}

// Obtener precio actual
$stmt = $conexion->prepare("SELECT precio FROM pedidos WHERE id = ?");
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo "No existe";
    exit;
}

$row = $res->fetch_assoc();
$precio = floatval($row['precio']);
$nuevoTotal = $precio * $cantidad;

// Solo actualizamos cantidad y total (no tocamos el estado)
$update = $conexion->prepare("UPDATE pedidos SET cantidad = ?, total = ? WHERE id = ?");
$update->bind_param("idi", $cantidad, $nuevoTotal, $id);

if ($update->execute()) {
    echo "OK";
} else {
    echo "Error SQL";
}

$update->close();
$stmt->close();
$conexion->close();
?>
