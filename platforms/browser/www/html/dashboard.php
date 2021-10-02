<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Dashboard | Citiger');
?>
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <div class="row mt-4 d-none" id="alerta-verificacion">
            <div class="col-12">
                <div class="animate__animated animate__fadeInDown alert yellowAlert alert-dismissible fade show" role="alert">
                    <strong>Importante.</strong> Debes de verificar tu correo electrónico para poder cambiar ajustes de tu cuenta. <a href="#" onclick="sendEmailCode()" class="alert-link" data-toggle="modal" data-target="#verificarCorreo">Haz clic aquí para poder verificarlo.</a><br>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>

        <div class="row mb-4">
            <?php
            Admin_Page::welcomeMessage();
            ?>
        </div>
        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center">
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <!-- Inicio de Tarjeta -->
                <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                    <!-- Boton de opciones -->
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard1" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-v"></span></button>
                                <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="denuncias.php">Denuncias</a>
                                    <a class="dropdown-item" href="#">Generar Reporte</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Icono -->
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <i class="fas fa-exclamation-triangle icono1"></i>
                        </div>
                    </div>
                    <!-- Labels -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                            <h1 class="tituloTarjetaDashboard">Denuncias Realizadas</h1>
                            <h1 class="contadorTarjetaDashboard mt-1" id="txtDenuncia">0</h1>
                        </div>
                    </div>
                    <!-- Final de Tarjeta -->
                </div>
            </div>

            <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard2" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-v"></span></button>
                                <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="visitas.php">Visitas</a>
                                    <a class="dropdown-item" href="#">Generar Reporte</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <i class="fas fa-car-side icono2"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                            <h1 class="tituloTarjetaDashboard">Visitas<br>Vigentes</h1>
                            <h1 class="contadorTarjetaDashboard mt-1" id="txtVisitas">0</h1>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Inicio de Tarjeta (Se repite el mismo formato) -->
            <div class="col-xl-4 col-md-4 col-sm-12 col-xs-12 margenTarjetas">
                <div class="tarjetaDashboard animate__animated animate__fadeInDown">
                    <div class="row">
                        <div class="col-12">
                            <div class="dropdown">
                                <button class="btn btnTarjetaDashboard3" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="fas fa-ellipsis-v"></span></button>
                                <div class="dropdown-menu animate__animated animate__bounceIn mt-5" aria-labelledby="dropdownMenuButton">
                                    <a class="dropdown-item" href="#">Aportaciones</a>
                                    <a class="dropdown-item" href="#">Generar Reporte</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <i class="fas fa-money-bill-wave icono3"></i>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center text-center">
                            <h1 class="tituloTarjetaDashboard">Aportaciones Pendientes</h1>
                            <h1 class="contadorTarjetaDashboard mt-1" id="txtAportaciones">0</h1>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Tabla de Actividad Reciente -->
        <div class="row my-4">
            <div class="col-12">
                <h1 class="tituloDashboard">Aportaciones del año</h1>
            </div>
        </div>
        <!-- Desde aqui comienza la tabla -->
        <div class="row justify-content-center table-responsive animate__animated animate__fadeInUp tablaResponsive" id="tablaCasasPendientes">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table2">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Concepto</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Fecha Limite</th>
                            <th scope="col">Estado</th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">
                        
                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->
        <!-- Desde aqui finaliza el contenido -->

        <!-- Fin del Modal -->

    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para verificar el correo electrónico -->
    <div class="modal fade" id="verificarCorreo" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="modal-content justify-content-center px-3 py-2">
                <!-- Cabecera del Modal -->
                <div class="modal-header">
                    <!-- Titulo -->
                    <h5 class="modal-title tituloModal" id="exampleModalLabel"><span
                            class="fas fa-info-circle mr-4 iconoModal"></span>Verificar Correo Electrónico</h5>
                    <!-- Boton para Cerrar -->
                    <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <!-- Contenido del Modal -->
                <div class="textoModal modal-body px-3 pb-4">
                    <div class="row mb-4">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <i class="fas fa-car-side icono5"></i>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <h1 class="tituloDato2">Ingrese el código de verificación enviado a su correo.</h1>
                        </div>
                    </div>
                    <form id="verificarCodigo-form" autocomplete="off">
                        <div class="row mt-2">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="d-flex justify-content-center align-items-center mb-2">
                                    <!-- Input Correo -->
                                    <div class="form-group mb-4" style="width: 300px;">
                                        <h1 class="tituloCajasLogin">Código de Verificación:</h1>
                                        <div class="d-flex justify-content-center align-items-center">
                                            <input type="text" id="1a" name="1a"
                                                onKeyup="autotab(this, document.getElementById('2a'),document.getElementById('1a'))"
                                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                Required maxlength="1" class="form-control cajaCodigo" Required>
                                            <input type="text" id="2a" name="2a"
                                                onKeyup="autotab(this, document.getElementById('3a'),document.getElementById('1a'))"
                                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                Required maxlength="1" class="form-control cajaCodigo" Required>
                                            <input type="text" id="3a" name="3a"
                                                onKeyup="autotab(this, document.getElementById('4a'),document.getElementById('2a'))"
                                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                Required maxlength="1" class="form-control cajaCodigo" Required>
                                            <input type="text" id="4a" name="4a"
                                                onKeyup="autotab(this, document.getElementById('5a'),document.getElementById('3a'))"
                                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                Required maxlength="1" class="form-control cajaCodigo" Required>
                                            <input type="text" id="5a" name="5a"
                                                onKeyup="autotab(this, document.getElementById('6a'),document.getElementById('4a'))"
                                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                Required maxlength="1" class="form-control cajaCodigo" Required>
                                            <input type="text" id="6a" name="6a"
                                                onKeyup="autotab(this, document.getElementById('6a'),document.getElementById('5a'))"
                                                onKeypress="if (event.keyCode < 45 || event.keyCode > 57) event.returnValue = false;"
                                                Required maxlength="1" class="form-control cajaCodigo" Required>
                                            <input type="number" class="d-none" id="codigoAuth" name="codigoAuth">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 d-flex justify-content-center">
                                <button type="submit" class="btn btnAgregarFormulario mr-2"><span
                                        class="fas fa-check mr-3 tamañoIconosBotones"></span>Verificar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Fin del Modal -->

<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('dashboard.js');
?>