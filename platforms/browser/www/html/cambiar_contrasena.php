<?php
  header("Cache-Control: no-cache, must-revalidate"); // HTTP/1.1
  header("Expires: Sat, 1 Jul 2000 05:00:00 GMT"); // Fecha en el pasado
?>

<!doctype html>
<html lang="es">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">

    <!-- Estilos -->
    <link rel="stylesheet" href="../../resources/css/estilos.css">

    <!-- Fuentes -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Manrope&family=Quicksand&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@600&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Quicksand:wght@700&display=swap" rel="stylesheet"> 

    <title>Primer Uso | Citiger</title>
  </head>
  <body>
    <input type="text" id="txtModo" class="d-none" text="">
      <!-- Contenedor Principal -->
    <div class="flex-column" id="container2">

        <div class="row mt-3 mb-2">
            <div class="col-12">
                <h1 class="tituloDato text-center">Cambiar Contraseña</h1>
            </div>
        </div>

        <div class="row my-4">
            <div class="col-12">
                <h1 class="campoDato text-center px-4">Hemos detectado que posees una cuenta con una 
                clave génerica, por favor actualiza tu contraseña.</h1>
            </div>
        </div>

        <form id="primeruso-form" method="post" autocomplete="off">
            <div class="row justify-content-center">
                <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 d-flex justify-content-center align-items-center flex-column">
                    <div class="form-group">
                        <div class="form-group">
                            <label for="txtContrasena" class="tituloCajaTextoFormulario">Nueva Contraseña:</label>
                            <input type="password" name="txtContrasena" id="txtContrasena" class="form-control cajaTextoFormulario widthRegister" 
                            onchange="checkInput()" Required>
                        </div>
                    
                        <div class="form-group">
                            <label for="txtContrasena" class="tituloCajaTextoFormulario">Confirmar Contraseña:</label>
                            <input type="password" name="txtConfirmarContra" id="txtConfirmarContra" class="form-control cajaTextoFormulario widthRegister"  
                            onchange="checkInput()" Required>
                        </div>
                    </div>
                </div>

            <div class="row justify-content-center my-4">
                <div class="col-12 d-flex justify-content-center">
                    <button type="submit" class="btn botonesListado"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Finalizar</button>
                </div>
            </div>
        </form>
    </div>
   
    <!-- JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/08b7535157.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../../app/controllers/residente/cambiar_contrasena.js"></script>
    <script>document.getElementById('txtModo').value = 'light'</script>
    <script type="text/javascript" src="../../resources/js/sweetalert.min.js"></script>
    <script type="text/javascript" src="../../app/helpers/components.js"></script>
  </body>
</html> 