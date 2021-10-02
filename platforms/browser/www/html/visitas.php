<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Visitas | Citiger');
?>
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Visitas</h1>
            </div>
        </div>
        <!-- Controles del Inicio -->
        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#verificarDui" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Nuevo</a>
                </div>
                <form class="mx-3 mb-2" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Visitante }">
                </form>

            </div>
        </div><br>

        <div class="row">
            <div class="col-12">
                <h1 class="tituloDato2 text-center">Historial de Visitas</h1>
            </div>
        </div>

        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-4 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col">Visitante</th>
                            <th scope="col">Estado de la Visita</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div><br>
        <!-- Desde aqui termina la tabla -->

    </div>

</div>
<!-- Final del contenido -->

<!-- primer modal -->
<div class="modal fade" id="modal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Seleccionar</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="modal-body textoModal px-3 pb-4 mt-2">
                <div class="row mb-4">
                    <div class="col-12">
                        <h1 class="tituloDato2 text-center">¿La persona que desea visitarlo ya está registrado en el sistema?</h1>
                    </div>
                </div>
                <!-- Menú -->
                <div class="row">
                    <!-- Opción "alquiler" de menú -->
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="#" data-toggle="modal" data-dismiss="modal" data-target="#crearVisita" class="btn botonMenu1">
                            <i class="fas fa-thumbs-up iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">Si</label>
                        </a>
                    </div>

                    <!-- Opción "espacios" de menú -->
                    <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 centrarBotones">
                        <a href="#" data-toggle="modal" data-dismiss="modal" id="btnNo" data-target="#administrarVisitante" class="btn botonMenu2">
                            <i class="fas fa-thumbs-down iconosBotonesMenu"></i>
                            <label class="textoBotonesMenu">No</label>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<div class="modal fade" id="administrarVisitante" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Visitante</h5>

                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-toggle="modal" data-target="#verificarDui" data-dismiss="modal">
                    <span class="fas fa-chevron-left" aria-hidden="true"></span>
                </button>
            </div>
            <!--Contenido del Modal-->
            <div class="textoModal modal-body px-3 pb-4 mt-2">
                <form method="post" id="Visitante-form" autocomplete="off">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert warningAlert alert-dismissible fade show" role="alert">
                                <strong>Importante.</strong> No hemos encontrado registro con este DUI, por lo tanto, puedes registrarlo. Si crees 
                                que se trata de un error, puedes regresar y colocarlo nuevamente.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">
                            <label class="tituloCajaTextoFormulario" for="txtNombre">Nombres:</label>
                            <input onchange="checkInputLetras('txtNombre')" type="text" class="form-control cajaTextoFormulario2" id="txtNombre" name="txtNombre" placeholder="">

                            <label class="tituloCajaTextoFormulario" for="txtApellido">Apellidos:</label>
                            <input onchange="checkInputLetras('txtApellido')" type="text" class="form-control cajaTextoFormulario2" id="txtApellido" name="txtApellido" placeholder="">

                            <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                            <input onchange="checkDui('txtDUI')" type="text" class="form-control cajaTextoFormulario2" id="txtDUI" name="txtDUI" placeholder="12345678-9" readonly>

                            <!-- RadioButtonGroup Género -->
                            <h1 class="tituloCajaTextoFormulario mb-2">Género</h1>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                            <div class="cbCitiger">
                                <select class="custom-select" id="cbGenero" name="cbGenero">
                                    <option selected="default">Seleccionar...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>

                            <label class="tituloCajaTextoFormulario mt-2" for="txtPlaca">Placa:</label>
                            <input type="text" class="form-control cajaTextoFormulario2" id="txtPlaca" name="txtPlaca" placeholder="P123 456" maxlength="8">
                        </div>
                    </div>
                    <div class="row justify-content-center mt-3">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnAgregar" name="btnAgregar" type="submit" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                        </div>
                    </div>
                </form>

                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para crear la visita -->
<div class="modal fade" id="crearVisita" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Visita</h5>

                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-toggle="modal" data-target="#verificarDui" data-dismiss="modal">
                    <span class="fas fa-chevron-left" aria-hidden="true"></span>
                </button>
            </div>
            <!--Contenido del Modal-->
            <div class="textoModal modal-body px-3 pb-4 mt-2">
                <form method="post" id="administrarVisita-form"  autocomplete="off">
                    <input type="number" name="idVisita" id="idVisita" class="d-none">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">

                            <label class="tituloCajaTextoFormulario mt-2" for="txtFecha">Fecha:</label>
                            <input type="date" class="form-control cajaTextoModal" id="txtFecha" name="txtFecha"  placeholder="AAAA-MM-DD" Required>

                            <h1 class="tituloCajaTextoFormulario mb-2">Visita Recurrente</h1>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                            deseado en el combobox  -->
                            <div class="cbCitiger w-100">
                                <select class="custom-select" id="cbVisitaR" name="cbVisitaR">
                                    <option selected="default">Seleccionar...</option>
                                    <option value="Si">Si</option>
                                    <option value="No">No</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 mt-2">
                            <label class="tituloCajaTextoFormulario" for="txtObservacion">Observación:</label>
                            <textarea onchange="checkAlfanumerico('txtObservacion')" id="txtObservacion" name="txtObservacion" rows="4" class="form-control cajaTextoModal" maxlength="200"></textarea>

                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 mt-2 d-flex justify-content-center">
                            <div class="form-group">
                                <input class="d-none" type="number" id="idVisitante" name="idVisitante">
                                <h1 class="tituloDato2 text-center">Visitante:</h1>                                
                                <h1 class="campoDato text-center" id="lblVisitante2">Eduardo Rivera</h1>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 mt-2 d-flex justify-content-center">
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">DUI:</h1>                                
                                <h1 class="campoDato text-center" id="lblDui">12345678-9</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12 mt-2 d-flex justify-content-center">
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Placa:</h1>                                
                                <h1 class="campoDato text-center" id="lblPlaca2">P123-456</h1>
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnAgregar2" class="btn btnAgregarFormulario mr-2"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para ver información de una visita -->
<div class="modal fade" id="informacionVisita" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Información de la Visita</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal modal-body px-3 pb-4 mt-2">
                <div class="row justify-content-center">
                    <form method="post" id="formDetalle">
                        <input type="number" name="idDetalle" id="idDetalle" class="d-none">

                    </form>
                    <div class="d-flex justify-content-center col-xl-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="flex-column">
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Visitante:</h1>
                                <h1 class="campoDato text-center" id="lblVisitante"></h1>
                            </div>
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Placa:</h1>
                                <h1 class="campoDato text-center" id="lblPlaca"></h1>
                            </div>
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Fecha:</h1>
                                <h1 class="campoDato text-center" id="lblFecha"></h1>
                            </div>
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Visita recurrente:</h1>
                                <h1 class="campoDato text-center" id="lblVisita"></h1>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center col-xl-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="flex-column">
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Estado:</h1>
                                <h1 class="campoDato text-center" id="lblEstado"></h1>
                            </div>
                            <div class="form-group">
                                <h1 class="tituloDato2 text-center">Observación:</h1>
                                <h1 class="campoDato text-center" id="lblOb"></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para verificar DUI para poder crear una visita -->
<div class="modal fade" id="verificarDui" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Verificar DUI</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal modal-body px-3 pb-4 mt-2">
                <div class="row">
                    <div class="col-12">
                        <h1 class="tituloDato2  ">Ingrese el DUI del visitante para verificar la información.</h1>
                    </div>
                </div>
                <form method="post" id="verificarDui-form"  autocomplete="off">
                    <div class="row mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtDuiVerificar">DUI:</label>
                                <input type="text" onchange="checkDui('txtDuiVerificar')" class="form-control cajaTextoFormulario" id="txtDuiVerificar" name="txtDuiVerificar" placeholder="12345678-9" Required maxlength="10">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex justify-content-center">
                            <button type="submit" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Verificar</button>
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
admin_Page::footerTemplate('visitas.js');
?>