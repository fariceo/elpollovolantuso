function usuario(e){

    //alert($("#usuario_sesion").val());
    $.ajax({
        type: "POST",
        url: "inicio.php",
        data: { usuario_sesion: $("#usuario").val() },

        success: function (result) {
            $("body").html(result);
        }

    });
}