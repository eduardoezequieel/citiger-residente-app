<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Denuncias | Citiger');
?>
<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>

        <!-- Desde aqui comienza el contenido -->
        <div class="row justify-content-center mb-3">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="tituloPagina text-center">Denuncias</h1>
            </div>
        </div>
        <!-- Controles del Inicio -->
        <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
            <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnInsertDialog" data-toggle="modal" data-target="#administrarDenuncia" class="btn botonesListado"><span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Nuevo</a>
                </div>

                <form class="mx-3 mb-2" method="post" id="search-form">
                    <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                    <input type="text" class="form-control buscador" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Fecha }">
                </form>

                <form method="post" id="filtrarEstadoDenuncia-form" class="mx-3">
                    <h1 class="tituloCajaTextoFormulario">Estado Denuncia:</h1>
                    <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                    cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                    deseado en el combobox  -->
                    <div class="cbCitigerBusqueda">
                        <select class="custom-select" id="cbEstadoDenuncia">
                            <option selected="">Seleccionar...</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                    <input type="number" name="idEstadoDenuncia" id="idEstadoDenuncia" class="d-none">
                    <button class="d-none" id="btnFiltrarDenuncia" type="submit"></button>
                </form>

                <div class="mt-4 mx-3 mb-3">
                    <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                </div>
            </div>
        </div><br>

        <div class="row">
            <div class="col-12">
                <h1 class="tituloDato2 text-center">Historial de Denuncias</h1>
            </div>
        </div>

        <!-- Desde aqui comienza la tabla -->
        <div class="row mt-3 justify-content-center table-responsive animate__animated animate__bounceInUp tablaResponsive">
            <div class="col-12 justify-content-center align-items-center text-center">
                <table class="table table-borderless citigerTable" id="data-table">
                    <thead>
                        <!-- Columnas-->
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">Tipo</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Fecha</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody id="tbody-rows">

                    </tbody>
                </table>
            </div>
        </div>
        <!-- Desde aqui termina la tabla -->

    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para asignar denuncias -->
<div class="modal fade" id="administrarDenuncia" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Denuncias</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <div class="row mb-2">
                    <div class="col-12">
                        <h1 class="tituloDato2 text-center" id="texto">Rellene el siguiente formulario:</h1>
                    </div>
                </div>
                <form method="post" id="administrarDenuncia-form"  autocomplete="off">
                    <input type="number" name="idDenuncia" id="idDenuncia" class="d-none">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <h1 class="tituloCajaTextoFormulario" for="cdTipo">Tipo de denuncia:</h1>
                                <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                                <div class="cbCitiger">
                                    <select class="custom-select" id="cbTipo" name="cbTipo">
                                        <option selected="">Seleccionar...</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtDescripcion">Descripción:</label>
                                <textarea class="form-control cajaTextoFormulario2" placeholder="Escriba su descripcion..." id="txtDescripcion" name="txtDescripcion" rows="4" maxlength="200"></textarea>

                            </div>

                            <h1 class="tituloDato2 text-center" id="lblResp2">Respuesta:</h1>
                            <h1 class="campoDato text-center" id="lblResp"></h1>
                        </div>
                        <br>
                    </div>
                    <div class="row justify-content-center mt-2">
                        <div class="col-12 d-flex justify-content-center">
                            <button id="btnAgregar" type="submit" class="btn btnAgregarFormulario"><span class="fas fa-paper-plane mr-3 tamañoIconosBotones"></span>Enviar Denuncia</button>
                            <button id="btnActualizar" type="submit" class="btn btnAgregarFormulario"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar denuncia</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->


<!-- Modal para ver denuncias-->
<div class="modal fade" id="verDenuncias" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-md modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Denuncias</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="administrarDenunciaEnSolucion-form"  autocomplete="off">
                    <input type="number" class="d-none" id="idDenuncia2" name="idDenuncia2">
                    <div class="row">
                        <div class="col-xl-12 col-md-12 col-sm-12 col-xs-12">

                            <h1 class="tituloDato text-center">Tipo de Denuncia</h1>
                            <h1 class="campoDato text-center mb-3" id="lblTipoDenuncia">Mantenimiento</h1>

                            <h1 class="tituloDato text-center">Fecha</h1>
                            <h1 class="campoDato text-center mb-3" id="lblFecha">11/6/2021</h1>

                            <h1 class="tituloDato text-center">Descripción</h1>
                            <h1 class="campoDato text-center mb-3" id="lblDesc">11/6/2021</h1>

                            <h1 class="tituloDato text-center">Estado</h1>
                            <h1 class="campoDato text-center mb-3" id="lblEstado">Pendiente</h1>

                            <h1 class="tituloDato text-center" id="lblRespuesta2">Respuesta</h1>
                            <h1 class="campoDato text-center mb-3" id="lblRespuesta">Pendiente</h1>


                        </div>
                    </div>
                </form>
                <br>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->
<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('denuncia.js');
?>