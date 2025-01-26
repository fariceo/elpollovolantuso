

function tareas() {
    //alert()
    $.ajax({

        type: 'POST',
        //url:'menu_clientes.php',
        url: 'task.php',
        data: { a: 1 },
        success: function (result) {
            $("#contenedor").html(result);
            //$("#menu_carta").css("display","none");
        }

    });
    $("#desplegar_ventana").show();
    $('#tareas_' + e).focus();
}



function cobros() {

    $.ajax({

        type: 'POST',
        //url:'menu_clientes.php',
        url: 'cobros_merchanica.php',
        data: { a: 1 },
        success: function (result) {
            $("#contenedor").html(result);
            //$("#menu_carta").css("display","none");
        }

    });
}


///funciones task.php
{





    function cliente_nuevo() {
        //alert($("#cliente_nuevo").val());
        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'task.php',
            data: { cliente_nuevo: $("#cliente_nuevo").val() },
            success: function (result) {
                $("#contenedor").html(result);
                //$("#menu_carta").css("display","none");
            }

        });


    }

    function buscar_cliente() {

        // alert($("#cliente_nuevo").val());
        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'procesar_merchanica.php',
            data: { buscar_cliente: $("#cliente_nuevo").val(), cliente_nuevo: $("#cliente_nuevo").val() },
            success: function (result) {
                $("#resultado_buscar_cliente").html(result);
                //$("#menu_carta").css("display","none");
            }

        });

        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'task.php',
            data: { cliente_nuevo: $("#cliente_nuevo").val() },
            success: function (result) {
                // $("#resultado_buscar_cliente").html(result);
                //$("#menu_carta").css("display","none");
            }

        });


    }




    function otra_tarea(e) {




        if (e == 2) {

            $.ajax({

                type: 'POST',
                //url:'menu_clientes.php',
                url: 'procesar_merchanica.php',
                data: { buscar_cliente: $("#cliente_nuevo").val(), intro_tarea: $("#intro_tarea").val() },
                success: function (result) {
                    // $("#contenedor").html(result);
                    //$("#menu_carta").css("display","none");
                }

            });



            $.ajax({

                type: 'POST',
                //url:'menu_clientes.php',
                url: 'task.php',
                data: { tarea: 1, cliente_nuevo: $("#cliente_nuevo").val() },
                success: function (result) {
                    $("#contenedor").html(result);


                    //$("#menu_carta").css("display","none");
                }

            });

            buscar_cliente();

        } else {

            $.ajax({

                type: 'POST',
                //url:'menu_clientes.php',
                url: 'task.php',
                data: { tarea: 1, cliente_nuevo: e },
                success: function (result) {
                    $("#contenedor").html(result);


                    //$("#menu_carta").css("display","none");
                }

            });

            setInterval(buscar_cliente, 1000);

        }

    }




    function aceptar_tarea(e, f,g) {

        // alert(e + ".... " + f);

        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'procesar_merchanica.php',
            data: { usuario_acepto_tarea: e, id_acepto_tarea: f,producto_acepto_tarea:g },
            success: function (result) {
                ampliar_ventana(e);
            }

        });
    }

    /////funciones task


}

{
    /**/
    function eliminar_tarea(e) {


        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'procesar_merchanica.php',
            data: { eliminar_tarea: e },
            success: function (result) {
                // $("#contenedor").html(result);


                //$("#menu_carta").css("display","none");
            }

        });
        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'task.php',
            data: { tarea: 1 },
            success: function (result) {
                // $("#contenedor").html(result);


                //$("#menu_carta").css("display","none");
            }

        });

        buscar_cliente();


    }


    function tarea_lista(e) {

        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'procesar_merchanica.php',
            data: { tarea_lista: e },
            success: function (result) {
                //  $("#contenedor").html(result);


                //$("#menu_carta").css("display","none");
            }

        });
        $.ajax({

            type: 'POST',
            //url:'menu_clientes.php',
            url: 'task.php',
            data: { a: 0 },
            success: function (result) {
                $("#contenedor").html(result);


                //$("#menu_carta").css("display","none");
            }

        });

        $("checkbox").focus();
    }





    $('[id^=plegar_ventana_]').hide();
    //$('[id^=desplegar_ventana_]').hide();

    //$("id^=plegar_ventana_").hide(); // Esto no es válido, debe corregirse.

    function ampliar_ventana(e) {
        // Oculta todos los contenedores de tareas
        $('[id^=tareas_]').hide();

        // Muestra el contenedor del cliente seleccionado
        $('#tareas_' + e).show();

        // Realiza la solicitud AJAX para cargar las tareas del cliente seleccionado
        $.ajax({
            type: 'POST',
            url: 'procesar_merchanica.php',
            data: { ampliar_cliente: e, tarea: 0 },
            success: function (result) {
                // Inserta el resultado en el contenedor correspondiente
                $('#tareas_' + e).html(result);
                //$('#tareas_' + e).focus();

                // Alterna la visibilidad de los botones desplegar/plegar para el cliente seleccionado
                $('#plegar_ventana_' + e).show();
                $('#plegar_ventana_' + e).focus();
                $('#desplegar_ventana_' + e).hide();
                $('[id^=desplegar_ventana_]').hide();
            },
        });


        // Asegurarse de que el elemento tenga una posición relativa al viewport

    }


    /////

}

function ver_pedido(e) {
    // alert(e)
    $.ajax({
        type: 'POST',
        url: 'pedidos_merchanica.php',
        data: { pedido_cliente: e },
        success: function (result) {
            // Inserta el resultado en el contenedor correspondiente
            $('#contenedor').html(result);


        }
    });
}



////pedidos_merchanica

function intro_compra(e) {
    //alert(e)

    var producto = $("#intro_producto").val();
    var cantidad = $("#cantidad").val();
    var precio = $("#precio").val();
    var total = cantidad * precio;


    //alert(e + " " + producto + " " + cantidad + " " + precio + " " + total);

    $.ajax({
        type: 'POST',
        url: 'procesar_merchanica.php',
        data: { introducir_producto_cliente: e, producto: producto, cantidad: cantidad, precio: precio, total: total },
        success: function (result) {
            // Inserta el resultado en el contenedor correspondiente
            // $('#contenedor').html(result);


        }
    });

    ver_pedido(e);
}

function cambiar_cantidad(e, f, g) {


    var cantidad = $('#cambiar_cantidad_' + f).val();
    //alert(cantidad);
    $.ajax({
        type: 'POST',
        url: 'procesar_merchanica.php',
        data: { id_cambiar_cantidad: f, precio: g, cantidad: cantidad, pedido_cliente: e },
        success: function (result) {
            // Inserta el resultado en el contenedor correspondiente
            // $('#contenedor').html(result);


        }
    });

    ver_pedido(e);



}

function poner_precio(e,f){
var precio_servicio=prompt("Precio para servicio");
    $.ajax({
        type: 'POST',
        url: 'procesar_merchanica.php',
        data: { id_poner_precio: f,precio_servicio:precio_servicio },
        success: function (result) {
            // Inserta el resultado en el contenedor correspondiente
            // $('#contenedor').html(result);


        }
    });
    ver_pedido(e);
}


function listo(e) {

    $.ajax({
        type: 'POST',
        url: 'procesar_merchanica.php',
        data: { compra_cliente_listo: 1, cliente_listo: e },
        success: function (result) {
            // Inserta el resultado en el contenedor correspondiente
            // $('#contenedor').html(result);


        }
    });

    tareas();
}


{



    ////Historial de ventas


    function ver_historial() {

        // alert();/*
        $.ajax({
            type: 'POST',
            url: 'ver_historial.php',
            data: { ver_historial: 1 },
            success: function (result) {
                // Inserta el resultado en el contenedor correspondiente
                $('#contenedor').html(result);


            }
        });
    }

}
///logoin_merchanica
{


    function iniciarSesion() {
            var email = $('#email').val();
            var password = $('#password').val();
alert(email+" "+password);
            $.ajax({
                type: 'POST',
                url: 'procesar_login.php',
                data: { email: email, password: password },
                success: function(response) {
                    $('#message').html(response);
                },
                error: function() {
                    alert("Ocurrió un error. Intente de nuevo.");
                }
            });
        }

    function registrar_usuario(e) {
        // alert(2);
        var url;


        // Definir la URL según el valor de `e`

        if (e == 2) {


            url = 'login_merchanica.php';
        }



        // Obtener valores de los campos
        /*
        var usuario = $("#usuario").val().trim();

        // alert(usuario);
        var email = $("#email").val().trim();
        var telefono = $("#telefono").val().trim();
        var empresa = $("#empresa").val().trim();
        var password = $("#password").val().trim();
        // var r_password = $("#r_password").val().trim();
*/
        // Validar campos

        // Si pasó todas las validaciones, realiza la solicitud AJAX

        $.ajax({
            type: 'POST',
            url: url,
            // data: { registrar_usuario: e, usuario: usuario, email: email, telefono: telefono, empresa: empresa, password: password },
            data: { registrar_usuario: e },
            success: function (result) {
                $("body").html(result); // Reemplaza el contenido del cuerpo con la respuesta del servidor
            }
        });
        /////


    }


    function validar_formulario_registro() {

        // Limpiar mensajes de error previos
        $(".error").remove();

        var isValid = true;

        var usuario = $("#usuario").val().trim();
        var email = $("#email").val().trim();
        var telefono = $("#telefono").val().trim();
        var empresa = $("#empresa").val().trim();
        var password = $("#password").val().trim();
        var r_password = $("#r_password").val().trim();

        // Validar campo usuario
        if (usuario === "") {
            $("#usuario").after("<br><span class='error'>El campo 'Usuario' no puede estar vacío.</span>");
            $("#usuario").focus();
            isValid = false;
        }

        // Validar campo email
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === "") {
            $("#email").after("<br><span class='error'>El campo 'Email' no puede estar vacío.</span>");
            if (isValid) $("#email").focus();
            isValid = false;
        } else if (!emailRegex.test(email)) {
            $("#email").after("<br><span class='error'>Por favor, ingresa un correo electrónico válido.</span>");
            if (isValid) $("#email").focus();
            isValid = false;
        }

        // Validar campo teléfono
        if (telefono === "") {
            $("#telefono").after("<br><span class='error'>El campo 'Teléfono' no puede estar vacío.</span>");
            if (isValid) $("#telefono").focus();
            isValid = false;
        } else if (!/^\d+$/.test(telefono)) {
            $("#telefono").after("<br><span class='error'>El campo 'Teléfono' solo debe contener números.</span>");
            if (isValid) $("#telefono").focus();
            isValid = false;
        }

        // Validar campo empresa
        if (empresa === "") {
            $("#empresa").after("<br><span class='error'>El campo 'Empresa' no puede estar vacío.</span>");
            if (isValid) $("#empresa").focus();
            isValid = false;
        }

        // Validar contraseñas
        if (password === "") {
            $("#password").after("<br><span class='error'>El campo 'Contraseña' no puede estar vacío.</span>");
            if (isValid) $("#password").focus();
            isValid = false;
        } else if (password !== r_password) {
            $("#r_password").after("<br><span class='error'>Las contraseñas no coinciden.</span>");
            if (isValid) $("#r_password").focus();
            isValid = false;
        }
        // alert(isValid);
        //  return isValid; // Retorna true si todo es válido, false en caso contrario

        // registrar_usuario(2);



        if (isValid === true) {


            $.ajax({
                type: 'POST',
                url: "procesar_merchanica.php",
                data: { usuario: usuario, email: email, telefono: telefono, empresa: empresa, password: password },
                //data: { registrar_usuario: 1 },
                success: function (result) {
                    $("body").html(result); // Reemplaza el contenido del cuerpo con la respuesta del servidor
                }
            });
        }


    }

}




///cobros y pagos
{




    function actualizar_cantidad(e, f, g) {
        //alert(e+f)
        var cantidad = prompt("actualiza la cantidad por pagar");

        var calculo = parseFloat(cantidad) + parseFloat(f);
        calculo = parseFloat(calculo);

        $.ajax({

            type: "POST",
            url: "cobros_merchanica.php",
            data: { algo: 1 },
            success: function (result) {

                //$("body").html(result);
                // $("#contenedor").html(result);
            }

        });


        $.ajax({

            type: "POST",
            url: "procesar_merchanica.php",
            data: { usuario: e, actualizar_cantidad: calculo, buscar_deudor: e, buscar_usuario: 1 },
            success: function (result) {
                $("#contenedor").html(result);

            }

        });
        //alert(e+cantidad+g)
        $.ajax({

            type: "POST",
            url: "historial_credito.php",
            //data: { usuario_deudor: e, saldo: calculo, fecha: g, saldo_contable: calculo, fio: 1 },
            data: { usuario_deudor: e, saldo: cantidad, fecha: g, fio: 1 },
            success: function (result) {


            }

        });


        ///enviar notificacion de correo del evento 
        $.ajax({

            type: "POST",
            url: "../notificaciones.php",
            data: { usuario_deudor: e, saldo: cantidad, fecha: g, fio: 1 },
            success: function (result) {

                //$("body").html(result);
                //$(".expositor").html(result);


            }

        });

        cobros();

    }

    function eliminar_deuda(e, f, g) {

        //alert(e)
        var confirmacion = window.confirm('Estas seguro de eliminar deuda a ' + f + ' ?');


        if (confirmacion == true) {
            $.ajax({

                type: "POST",
                url: "cobros_merchanica.php",
                data: { peticion: "credito", id_deuda: e },
                success: function (result) {

                    $("#contenedor").html(result);
                }

            });



            $.ajax({

                type: "POST",
                url: "historial_credito.php",
                data: { usuario_deudor: f, saldo: 0, fecha: g, fio: 1 },
                success: function (result) {
                    //$(".expositor").html(result);

                }

            });

            $.ajax({

                type: "POST",
                url: "procesar_merchanica.php",
                data: { buscar_deudor: "" },
                success: function (result) {

                    //$("body").load("pagos.php");

                }

            });

        }
    }


    function nueva_deuda(e, f) {



        if ($("#deudor").val() != "") {
            var cantidad = prompt("cantidad");

            if (!isNaN(cantidad) && cantidad != "" && cantidad != null) {
                $.ajax({

                    type: "POST",
                    url: "cobros_merchanica.php",
                    data: { peticion: "credito", cantidad_deuda: cantidad, usuario_deudor: $("#deudor").val() },
                    success: function (result) {

                        $("#contenedor").html(result);
                    }

                });

            }

            $.ajax({

                type: "POST",
                url: "procesar_merchanica.php",
                data: { buscar_deudor: e },
                success: function (result) {


                }

            });

            $.ajax({

                type: "POST",
                url: "historial_credito.php",
                data: { usuario_deudor: $("#deudor").val(), saldo: cantidad, fecha: e, saldo_contable: cantidad },
                success: function (result) {


                }

            });


        } else {

            alert("el usuario deudor esta vacio");
        }






    }

    function accion(e) {
        var accion = prompt("Accion a realizar// insertar 1 para cobrar , 2 para pagar.");

        if (accion == 1 || accion == 2 && accion != "" && accion != null && !isNaN(accion)) {
            $.ajax({

                type: "POST",
                url: "cobros_merchanica.php",
                data: { peticion: "credito", accion: accion, usuario_deudor: e },
                success: function (result) {

                    $("#contenedor").html(result);
                }

            });

        } else {
            alert("introduce un valor valido. 1 para cobrar , 2 para pagar");
        }


        $.ajax({

            type: "POST",
            url: "procesar_merchanica.php",
            data: { buscar_deudor: e },
            success: function (result) {


            }

        });
    }


    function ver_historial_credito(e) {
        //alert(e)
        $.ajax({

            type: "POST",
            url: "procesar_merchanica.php",
            data: { usuario: e, actualizar_cantidad: 'algo' },
            success: function (result) {

                $("body").html(result);
            }

        });
    }



    function buscar_deudor() {




        $.ajax({
            type: "POST",
            url: "procesar.php",
            data: { buscar_deudor: $("#buscar_deudor").val(), buscar_usuario: 0 },

            success: function (result) {

                $("#contenedor").html(result);
            }

        });



    }

    function buscar_pedido(e, f) {
        //alert(e+f)
        $.ajax({
            type: "POST",
            url: "procesar.php",
            data: { usuario: e, buscar_pedido: f, actualizar_cantidad: "algo" },

            success: function (result) {

                $("body").html(result);
            }

        });

    }
    function actualizar_deuda_pendiente(e, f) {
        //alert(e + f)
        var actualizar_deuda_pagar = prompt("deuda");
        $.ajax({

            type: "POST",
            url: "historial_credito.php",
            data: { usuario_deudor: e, saldo_corregir: actualizar_deuda_pagar, id_deuda: f, corregir_deuda: 1 },
            success: function (result) {
                $("#contenedor").html(result);

            }

        });

        //ver_historial_credito(usuario_deudor);


    }

    /*
    function cobros() {
 
        $.ajax({
 
            type: 'POST',
            //url:'menu_clientes.php',
            url: 'cobros_merchanica.php',
            data: { a: 1 },
            success: function (result) {
                $("#contenedor").html(result);
                //$("#menu_carta").css("display","none");
            }
 
        });
    }
 
*/

}



function cerrar_sesion() {
    $.ajax({

        type: 'POST',
        //url:'menu_clientes.php',
        url: 'inicio.php',
        data: { cerrar_sesion: 1 },
        success: function (result) {
            $("body").html(result);
            //$("#menu_carta").css("display","none");
        }

    });
}

function redireccionarPagina() {
    window.location = "inicio.php";
  }



  function ventas(e) {
    //alert(e + "hola");
    $.ajax({
        type: "POST",
        //url: "admin.php",
        url: "grafica_ventas_merchanica.php",
        // url: "admin.php",
        data: { info_fecha_ventas: e },

        success: function (result) {
            $("body").html(result);
        }

    });
}