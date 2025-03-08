
$(document).ready(function () {



});



function enviar_datos() {
    //alert(e)

    var usuario = $("#usuario").val();
    var producto = $("#producto").val();
    var location = $("#location").val();
    $.ajax({
        type: 'POST',
        //url:'menu_clientes.php',
        url: 'mandados.php',
        data: { usuario: usuario, producto: producto, location: location },
        success: function (result) {
            $("body").html(result);
            //$("#menu_carta").css("display","none");
        }

    });
}

function buscar_usuario(e) {


    $.ajax({
        type: 'POST',
        //url:'menu_clientes.php',              
        url: 'mandados.php',
        data: { usuario: e },
        success: function (result) {
            $("body").html(result);
            //$("#menu_carta").css("display","none");
        }

    });

}
function cambiar_precio(e) {
    //alert(e);

    var precio=prompt("cambia precio de servicio");

    $.ajax({
        type: 'POST',
        //url:'menu_clientes.php',              
        url: 'mandados.php',
        data: { cambiar_precio_id: e,cambiar_precio:precio },
        success: function (result) {
            $("body").html(result);
            //$("#menu_carta").css("display","none");
        }

    });

}
//localizador

function localizador() {
    var e = $("#localizador").val();
//alert(e);
    $.ajax({
        type: 'POST',
        //url:'menu_clientes.php',
        url: 'mandados.php',
        data: { localizador: e, usuario: 1 },
        success: function (result) {
            $("body").html(result);
            //$("#menu_carta").css("display","none");
        }

    });
}


function eliminar_mandado(e){

    $.ajax({
        type: 'POST',
        //url:'menu_clientes.php',              
        url: 'mandados.php',
        data: { eliminar_mandado_id:e,localizador: "", usuario: ""},
        success: function (result) {
            $("body").html(result);
            //$("#menu_carta").css("display","none");
        }

    });
}

function especificacion(e){ 
   var especificacion_mandado=$("#especificacion_tarea_"+e).val();
  //alert(especificacion_tarea+" / "+e);
  $.ajax({
    type: 'POST',
    //url:'menu_clientes.php',              
    url: 'procesar_datos.php',
    data: { especificacion_mandado:especificacion_mandado,id_especificacion_mandado:e},
    success: function (result) {
        $("body").html(result);
        //$("#menu_carta").css("display","none");
    }

});

}

