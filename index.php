<?php
session_start();
include("conexion.php");

// Obtener categoría aleatoria
$categoriaAleatoria = "";
$result = mysqli_query($conexion, "SELECT DISTINCT categoria FROM menu ORDER BY RAND() LIMIT 1");
if ($row = mysqli_fetch_assoc($result)) {
    $categoriaAleatoria = $row['categoria'];
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Menú del Restaurante</title>
  <link rel="stylesheet" href="css/index.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <script>
    const categoriaInicial = "<?=htmlspecialchars($categoriaAleatoria)?>";
  </script>
  <script src="js/index.js" defer></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
</head>

<body data-usuario="<?= isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : '' ?>">

  <h2 id="textoEncabezado">
    <a href="admin.php"><img id="imgLogo" src="imagenes/logo.jpeg"></a>
    Menú del Restaurante
  </h2>

  <button id="btnMenuHamburguesa">
    <i class="fas fa-utensils"></i>
  </button>

  <?php if (isset($_SESSION['usuario'])): ?>
    <!-- Usuario logueado -->
    <div class="iconos">
      <a id="cerrarSesion" href="sesion/cerrar_sesion.php">👤 <?=htmlspecialchars($_SESSION['usuario'])?></a>
      <input type="hidden" id="pedidoId" value="<?=htmlspecialchars($_SESSION['usuario'])?>">
    </div>

    <?php
    $consulta = $conexion->prepare("SELECT COUNT(*) AS cantidad FROM pedidos WHERE usuario = ? AND estado != 2");
    $consulta->bind_param("s", $_SESSION['usuario']);
    $consulta->execute();
    $res = $consulta->get_result()->fetch_assoc();
    $pendientes = $res['cantidad'];
    ?>

    <div class="carrito">
      <div id="n_productos"><?=$pendientes?></div>
      <a href="asi_sistema/info/carrito/carrito.php">🛒</a>
    </div>

  <?php else: ?>

    <!-- Formulario para ingresar usuario -->
    <div class="login-id">
      <label for="pedidoId">ID del Pedido:</label>
      <input type="text" id="pedidoId" placeholder="Ingrese tu ID">
      <button id="guardarUsuario">Intro</button>
      <div id="errorPedidoId"></div>
    </div>

  <?php endif; ?>

  <!-- Menu lateral -->
  <div id="menuLateral">
    <button id="cerrarMenu">&times; Cerrar</button>
    <ul id="listaCategorias"></ul>
  </div>

  <!-- Tabla -->
  <div class="tabla-wrapper" style="height: 500px; overflow-y: auto; overflow-x: hidden;">
    <table id="tablaMenu"><tbody></tbody></table>
  </div>

  <!-- Modal cantidad -->
  <div id="modalCantidad" style="display: none; position: fixed; top: 0; left: 0;
       width: 100%; height: 100%; background: rgba(0,0,0,0.7);
       justify-content: center; align-items: center; z-index: 9999;">

    <div class="modal-inner"
         style="background: white; padding: 20px; border-radius: 10px; text-align: center; width: 300px; max-width: 90%;">
      <h3 id="tituloProducto" style="margin-bottom: 10px;"></h3>
      <p>Precio: $<span id="precioProducto"></span></p>

      <input type="number" id="inputCantidad" value="1" min="1"
             style="width: 80px; padding: 5px; font-size: 16px;">

      <div style="margin-top: 15px;">
        <button id="btnConfirmarCantidad"
                style="margin-right: 10px; padding: 8px 16px; background: #28a745; color: white; border: none; border-radius: 5px;">
          ✅ Confirmar
        </button>

        <button id="btnCancelarCantidad"
                style="padding: 8px 16px; background: #dc3545; color: white; border: none; border-radius: 5px;">
          ❌ Cancelar
        </button>
      </div>
    </div>
  </div>

</body>
</html>
