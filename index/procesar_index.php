<?php
header("Content-Type: application/json");
include("../conexion.php");
$data = json_decode(file_get_contents("php://input"), true);
if (!$data) exit(json_encode(['success'=>false,'mensaje'=>'No hay datos']));
extract($data);
if (!$usuario||!$producto||$cantidad<1||$precio<=0) {
  exit(json_encode(['success'=>false,'mensaje'=>'Datos inválidos']));
}
$sql="INSERT INTO pedidos(usuario,producto,cantidad,precio,total,estado,delivery,metodo_pago,fecha,hora)
      VALUES(?,?,?,?,?,?,?,?,?,?)";
$stmt=$conexion->prepare($sql);
$stmt->bind_param("ssiddissss",$usuario,$producto,$cantidad,$precio,$total,$estado,$delivery,$metodo_pago,$fecha,$hora);
if (!$stmt->execute()) {
  exit(json_encode(['success'=>false,'mensaje'=>$stmt->error]));
}
$count=$conexion->prepare("SELECT COUNT(*) AS total FROM pedidos WHERE usuario=? AND estado!=2");
$count->bind_param("s",$usuario);
$count->execute();
$total = $count->get_result()->fetch_assoc()['total'];
echo json_encode(['success'=>true,'totalPedidos'=>$total]);
