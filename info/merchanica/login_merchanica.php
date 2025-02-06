<?php //include("conexion_merchanica.php"); 
session_start(); ?>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>

<script src="funciones_merchanica.js"></script>


<script>


    $(document).ready(function () {

    });


</script>
<?php
include("conexion_merchanica.php");

?>


<?php
if (!empty($_SESSION["usuario"])) {
    //header("Location: inicio.php");
   // exit; // Siempre detén la ejecución después de una redirección
}
?>


<?php
if (!isset($_POST['registrar_usuario']) || $_POST['registrar_usuario'] == "") {



    ?>
    <h3 style="width:100%;background:#619eff;text-align:center">Iniciar Sesion</h3>
    <div>
 
    <form id="loginForm">
        <label for="email">Correo Electrónico:</label>
        <input type="email" id="email" name="email" placeholder="Email" required><br><br>
        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" placeholder="Contraseña" required><br><br>
        <button type="button" onclick="iniciarSesion()">Ingresar</button>
    <button onclick="registrar_usuario(2)">Registrarse</button>
    
    </form>
    <div id="message"></div>

    </div>
    <?php
}
?>







<?php


///formulario de registro de usuario
if (isset($_POST['registrar_usuario'])) {
    ?>


    <div style="text-align:center">
        <h3 style="width:100%;background:#619eff;">Registrar usuario</h3>


        <input type="text" id="usuario" placeholder="Usuario" /><br><br>
        <input type="text" id="email" placeholder="email" /><br><br>
        <input type="text" id="telefono" placeholder="Telefono" /><br><br>
        <input type="text" id="empresa" placeholder="Empresa" /><br><br>
        <input type="password" id="password" placeholder="Contraseña" /><br><br>
        <input type="password" id="r_password" placeholder="Repetir contraseña" /><br>
        <br>

        <button onclick="validar_formulario_registro(1)">Registrarse</button>



    </div>

    <?php
}


?>


<div id="contenedor"></div>