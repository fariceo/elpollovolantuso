// ==============================
//      INDEX.JS COMPLETO
// ==============================

window.addEventListener('DOMContentLoaded', () => {
    const modalCant = document.getElementById('modalCantidad');
    const tituloProducto = document.getElementById('tituloProducto');
    const precioProducto = document.getElementById('precioProducto');
    const inputCantidad = document.getElementById('inputCantidad');
    let productoSeleccionado = {};

    // USUARIO DESDE SESIÓN PHP
    const usuarioSesion = document.body.dataset.usuario || "";


    // Mostrar productos por categoría
  // Cargar categorías
function cargarCategorias() {
    fetch('index/obtener_categorias.php')
        .then(res => res.json())
        .then(data => {
            const lista = document.getElementById('listaCategorias');
            lista.innerHTML = '';
            data.forEach(categoria => {
                const li = document.createElement('li');
                li.innerHTML = `<button>${categoria}</button>`;
                li.onclick = () => mostrarPorCategoria(categoria);
                lista.appendChild(li);
            });

            // Intentar mostrar categoría inicial aleatoria primero
            mostrarPorCategoria(categoriaInicial, data);
        });
}

// Mostrar productos por categoría
function mostrarPorCategoria(cat, categoriasDisponibles = []) {
    $.post('index/buscar_por_categoria.php', { categoria: cat })
        .done(html => {
            const tbody = document.querySelector('tbody');
            tbody.innerHTML = html;

            // Si no hay productos, intentar con otra categoría disponible
            if (!html.trim() && categoriasDisponibles.length > 0) {
                // Quitar la categoría que falló
                const otrasCategorias = categoriasDisponibles.filter(c => c !== cat);
                if (otrasCategorias.length > 0) {
                    mostrarPorCategoria(otrasCategorias[0], otrasCategorias);
                } else {
                    tbody.innerHTML = '<tr><td colspan="5">No hay productos disponibles.</td></tr>';
                }
            }
        });

    document.getElementById('menuLateral').style.display = 'none';
}



  // CLICK EN BOTÓN "AGREGAR"
document.addEventListener('click', e => {
    const btn = e.target.closest('.agregarBtn');
    if (btn) {

        if (!usuarioSesion) {
            // Mostrar alerta
            alert("Debe ingresar un ID de pedido para agregar productos.");

            // Obtener el input del ID
            const inputPedido = document.getElementById('pedidoId');
            if (inputPedido) {
                // Poner foco
                inputPedido.focus();
                // Cambiar color de borde o fondo para resaltar
                inputPedido.style.border = '2px solid red';
                inputPedido.style.backgroundColor = '#ffe6e6';
                
                // Opcional: quitar el color cuando el usuario escriba
                inputPedido.addEventListener('input', () => {
                    inputPedido.style.border = '';
                    inputPedido.style.backgroundColor = '';
                }, { once: true });
            }

            return;
        }

        productoSeleccionado = {
            producto: btn.dataset.producto,
            precio: parseFloat(btn.dataset.precio)
        };

        tituloProducto.textContent = productoSeleccionado.producto;
        precioProducto.textContent = productoSeleccionado.precio.toFixed(2);
        modalCant.style.display = 'flex';
    }
});


   // CONFIRMAR CANTIDAD
document.getElementById('btnConfirmarCantidad').addEventListener('click', () => {

    if (!usuarioSesion) {
        alert("Debe ingresar un ID de pedido antes de agregar.");
        modalCant.style.display = 'none';
        return;
    }

    const cantidad = parseInt(inputCantidad.value);

    if (!cantidad || cantidad < 1) {
        alert("Debe ingresar una cantidad válida");
        return;
    }

    const total = cantidad * productoSeleccionado.precio;

    fetch('index/procesar_index.php', {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({
            usuario: usuarioSesion,
            ...productoSeleccionado,
            cantidad,
            total
        })
    })
    .then(res => res.json())
    .then(data => {
        alert(data.mensaje);
        modalCant.style.display = 'none';

        // ==========================
        // ACTUALIZAR CONTADOR DE CARRITO
        // ==========================
        const contador = document.getElementById('n_productos');
        if (contador) {
            // Aumentar en la cantidad agregada
            let actual = parseInt(contador.textContent) || 0;
            contador.textContent = actual + cantidad;
        }
    });
});


    // CANCELAR
    document.getElementById('btnCancelarCantidad').addEventListener('click', () => {
        modalCant.style.display = 'none';
    });

    // Menú lateral
    document.getElementById('btnMenuHamburguesa').addEventListener('click', () => {
        document.getElementById('menuLateral').style.display = 'block';
    });

    document.getElementById('cerrarMenu').addEventListener('click', () => {
        document.getElementById('menuLateral').style.display = 'none';
    });

    cargarCategorias();
});


// =====================================
//   LOGIN DE USUARIO (ID DEL PEDIDO)
// =====================================

document.addEventListener("DOMContentLoaded", () => {
    const sesionUsuario = document.body.dataset.usuario;

    if (sesionUsuario) {
        const loginForm = document.querySelector(".login-id");
        if (loginForm) loginForm.style.display = "none";
    }

    const guardarBtn = document.getElementById("guardarUsuario");
    const inputPedido = document.getElementById("pedidoId");

    // ENTER para guardar usuario
    if (inputPedido) {
        inputPedido.addEventListener("keypress", function (e) {
            if (e.key === "Enter") {
                guardarBtn.click();
            }
        });
    }

    // CLICK en botón
    if (guardarBtn) {
        guardarBtn.addEventListener("click", () => {
            const usuarioVal = inputPedido.value.trim();

            if (!usuarioVal) {
                document.getElementById("errorPedidoId").innerText = "Debes ingresar un ID válido.";
                return;
            }

            fetch("index/guardar_usuario.php", {
                method: "POST",
                headers: { "Content-Type": "application/json" },
                body: JSON.stringify({ usuario: usuarioVal })
            })
            .then(res => res.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    document.getElementById("errorPedidoId").innerText = data.mensaje;
                }
            });
        });
    }
});
