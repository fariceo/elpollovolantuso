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
                mostrarPorCategoria(categoriaInicial);
            });
    }

    // Mostrar productos por categoría
    function mostrarPorCategoria(cat) {
        $.post('index/buscar_por_categoria.php', { categoria: cat })
            .done(html => document.querySelector('tbody').innerHTML = html);
        document.getElementById('menuLateral').style.display = 'none';
    }

    // CLICK EN BOTÓN "AGREGAR"
    document.addEventListener('click', e => {
        const btn = e.target.closest('.agregarBtn');
        if (btn) {

            if (!usuarioSesion) {
                alert("Debe ingresar un ID de pedido para agregar productos.");
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
