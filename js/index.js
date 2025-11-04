window.addEventListener('DOMContentLoaded', () => {
  const modalImg = document.getElementById('modalImagen');
  const modalCant = document.getElementById('modalCantidad');
  const tituloProducto = document.getElementById('tituloProducto');
  const precioProducto = document.getElementById('precioProducto');
  const inputCantidad = document.getElementById('inputCantidad');
  let productoSeleccionado = {};

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

  // Click en “Agregar”
  document.addEventListener('click', e => {
    const btn = e.target.closest('.agregarBtn');
    if (btn) {
      productoSeleccionado = {
        producto: btn.dataset.producto,
        precio: parseFloat(btn.dataset.precio)
      };
      tituloProducto.textContent = productoSeleccionado.producto;
      precioProducto.textContent = productoSeleccionado.precio.toFixed(2);
      modalCant.style.display = 'flex';
    }
  });

  // Confirmar cantidad
  document.getElementById('btnConfirmarCantidad').addEventListener('click', () => {
    const cantidad = parseInt(inputCantidad.value);
    const usuario = document.getElementById('pedidoId')?.value.trim() || 'Invitado';
    const total = cantidad * productoSeleccionado.precio;

    fetch('index/procesar_index.php', {
      method: 'POST',
      headers: { 'Content-Type': 'application/json' },
      body: JSON.stringify({ usuario, ...productoSeleccionado, cantidad, total })
    })
      .then(res => res.json())
      .then(data => {
        alert(data.mensaje);
        modalCant.style.display = 'none';
      });
  });

  // Cancelar
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
