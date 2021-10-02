<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Alquileres | Citiger');
?>
    <link rel="stylesheet" href="../../resources/css/estilos3.css">
    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken">
                <i class="fa fa-bars categoriasFuente tamañoIconos"></i>
                <small class="text-uppercase font-weight-bold"></small>
            </button>

            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Alquiler</h1>
                </div>
            </div>

            <!-- Controles del Inicio -->
            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="mt-4 mx-3 mb-3">
                        <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarAlquiler"
                            class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Solicitar</a>
                    </div>
                    <form class="mx-3" method="post" id="search-form">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Espacio }   &#xf002;">
                    </form>

                    <form method="post" id="filtrarEstadoAlquiler-form" class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitigerBusqueda">
                            <select class="custom-select" id="cbEstadoAlquiler">
                                <option selected="">Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> 
                        </div>
                        <input type="number" name="idEstadoAlquiler" id="idEstadoAlquiler" class="d-none">
                        <button class="d-none" id="btnFiltrarAlquiler" type="submit"></button>
                    </form>

                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                    </div>

            </div>
            <br>

            <!-- Fila de Tarjetas -->
            <div class="row justify-content-center animate__animated animate__backInUp" id="show-tarjeta">
                
                
            </div>
            <!-- Desde aqui finaliza el contenido -->
            <!-- Modal para Administrar Alquileres -->
            <div class="modal fade" id="administrarAlquiler" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content justify-content-center px-3 py-2">
                        <!-- Cabecera del Modal -->
                        <div class="modal-header">
                            <!-- Titulo -->
                            <h5 class="modal-title tituloModal"><span class="fas fa-info-circle mr-4 iconoModal"></span>Alquileres
                            </h5>
                            <!-- Boton para Cerrar -->
                            <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <!-- Contenido del Modal -->
                        <div class="textoModal px-3 pb-4">
                            <form method="post" id="alquiler-form">
                                <div class="row">
                                    <!-- Primera columna de controles -->
                                    <div class="col-xl-7 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                                        <div id="EmpleadosColumna1">
                                            <input type="number" name="idAlquiler" id="idAlquiler" class="d-none">
                                            <input type="number" name="idEspacio" id="idEspacio" class="d-none">
                                            <input type="number" name="idEstado" id="idEstado" class="d-none">

                                            <label class="tituloCajaTextoFormulario mt-2" for="cbEspacio">Espacio:</label>
                                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                            cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                            deseado en el combobox  -->
                                            <div class="cbCitiger mb-2">
                                                <select class="custom-select" id="cbEspacio" name="cbEspacio">
                                                    <option selected="">Seleccionar...</option>
                                                    <option value="1">One</option>
                                                    <option value="2">Two</option>
                                                    <option value="3">Three</option>
                                                </select>
                                            </div>

                                            <label class="tituloCajaTextoFormulario mt-2" for="txtFechaAlquiler">Fecha de
                                                Alquiler:</label>
                                            <input type="date" class="form-control cajaTextoFormulario" id="txtFecha"
                                                name="txtFecha" onchange="checkInput('txtFecha')" placeholder="AAAA-MM-DD" Required>

                                            <label class="tituloCajaTextoFormulario" for="txtEstado6" id="txtEstado61">Estado:</label>
                                            <input type="text" class="form-control cajaTextoFormularioPrecio" id="txtEstado6" disabled>
                                        </div>

                                    </div>

                                    <!-- Segunda columna de controles -->
                                    <div class="col-xl-5 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                                        <div>
                                            <!-- Controles -->
                                            <label class="tituloCajaTextoFormulario" for="txtHoraInicio">Hora inicio:</label>
                                            <input type="time" class="form-control cajaTextoFormularioHora" id="txtHoraInicio"
                                                name="txtHoraInicio" min="00:00" max="23:59" placeholder="HH:MM"
                                                onchange="checkInput('txtHoraInicio')" Required>

                                            <label class="tituloCajaTextoFormulario" for="txtHoraFin">Hora Fin:</label>
                                            <input type="time" class="form-control cajaTextoFormularioHora" id="txtHoraFin"
                                                name="txtHoraFin" min="00:00" max="23:59" placeholder="HH:MM"
                                                onchange="checkInput('txtHoraFin')" Required>
                                            <label class="tituloCajaTextoFormulario" for="txtPrecio" id="txtPrecio1">Precio:</label>
                                            <input type="number" class="form-control cajaTextoFormularioPrecio" id="txtPrecio"
                                            name="txtPrecio" placeholder="$00.00" min="0.01" step="any"
                                            onchange="checkInput('txtPrecio')" disabled>

                                        </div>
                                    </div>
                                </div>
                                <!-- Botones de Acción del Formulario -->
                                <div class="row justify-content-center mt-4">
                                    <div class="col-12 d-flex justify-content-center align-items-center text-center">
                                        <button type="submit" id="btnAgregar" class="btn btnAgregarFormulario mr-2"><span
                                                class="fas fa-plus mr-3 tamañoIconosBotones"></span>Solicitar</button>
                                        <button type="submit" id="btnActualizar" class="btn btnAgregarFormulario mr-2"><span
                                            class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                                        <a id="btnCancelar" class="btn btnAgregarFormularioResident mr-2"><span
                                            class="fas fa-times mr-3 tamañoIconosBotones"></span>Cancelar</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Fin del Modal -->
        </div>

    </div>
    <!-- Final del contenido -->

    <?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('alquileres.js');
?>