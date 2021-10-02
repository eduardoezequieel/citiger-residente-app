<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
Admin_Page::sidebarTemplate('Espacios | Citiger');
?>    

    <!-- Contenedor de la Pagina -->
    <div class="page-content p-3" id="content">
        <div id="cuadroContenido">
            <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        
            <!-- Desde aqui comienza el contenido -->
            <div class="row justify-content-center mb-3 animate__animated animate__bounceIn">
                <div class="col-12 d-flex justify-content-center align-items-center">
                    <h1 class="tituloPagina">Espacio</h1>
                </div>
            </div>

            <!-- Controles del Inicio -->
            <div class="row justify-content-center mt-3 px-5 animate__animated animate__bounceIn">
                <div class="col-xl-12 d-flex justify-content-center col-md-12 col-sm-12 col-xs-12 centrarBotones">
                    <div class="mt-4 mx-3 mb-3">
                    </div>
                        <a href="#" data-toggle="modal" data-target="#administrarImagen" id="adminImagen"class="btn botonesListado d-none">
                            <span class="fas fa-plus mr-3 tamañoIconosBotones"></span>Agregar</a>
                    <form class="mx-3 mb-2" method="post" id="search-form">
                        <h1 class="tituloCajaTextoFormulario">Busqueda:</h1>
                        <input type="text" class="form-control buscador searchInput" id="search" name="search" aria-describedby="emailHelp" placeholder="{ Nombre }">
                    </form>   

                    <form method="post" id="filtrarEstadoEspacio-form" class="mx-3">
                        <h1 class="tituloCajaTextoFormulario">Estado:</h1>
                        <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                        <div class="cbCitigerBusqueda">
                            <select class="custom-select" id="cbEstadoEspacio">
                                <option selected="">Seleccionar...</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select> 
                        </div>
                        <input type="number" name="idEstadoEspacio" id="idEstadoEspacio" class="d-none">
                        <button class="d-none" id="btnFiltrarEspacio" type="submit"></button>
                    </form>

                    <div class="mt-4 mx-3 mb-3">
                        <a href="#" id="btnReiniciar" data-toggle="#" data-target="#" class="btn botonesListado"><span class="fas fa-undo mr-3 tamañoIconosBotones"></span>Reiniciar</a>
                    </div>
                </div>
                
            </div><br>

            <!-- Fila de Tarjetas -->
            <div class="row justify-content-center animate__animated animate__backInUp" id="show-tarjeta">
                
                
            </div>
            <!-- Desde aqui finaliza el contenido -->
            
        </div>

        
        <!-- Modal para ver la información de los espacios -->
        <div class="modal fade" id="administrarEspacio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header p-3">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Espacios</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-5 pb-5"> 
                        <form method="post" id="espacio-form" autocomplete="off">
                            <div class="row justify-content-center">
                                <!-- Primera columna de controles -->
                                <div class="d-flex flex-column justify-content-center align-items-center col-xl-6 col-md-12 col-sm-12 col-xs-12  centrarColumnas">
                                    <div class="form-group">
                                        <input type="number" name="idEspacio" id="idEspacio" class="d-none">
                                        <input type="number" name="idEspacio3" id="idEspacio3" class="d-none">
                                        <label class="tituloCajaTextoFormulario" for="txtNombre">Nombre:</label>
                                        <input type="text" class="form-control cajaTextoFormulario" id="txtNombre" name="txtNombre"
                                            placeholder="Escriba nombre del espacio..." onchange="checkInput('txtNombre')" Required>

                                        <label class="tituloCajaTextoFormulario" for="txtDescripcion">Descripción:</label>
                                        <textarea class="form-control cajaTextoFormulario" placeholder="Escriba la descripción del espacio..."
                                        id="txtDescripcion" name="txtDescripcion" rows="3" onchange="checkInput('txtDescripcion')" Required></textarea>

                                        <label class="tituloCajaTextoFormulario" for="txtCapacidad">Capacidad:</label>
                                        <input type="number" class="form-control cajaTextoFormulario" id="txtCapacidad" name="txtCapacidad" 
                                        placeholder="Escriba la capacidad..." min="1" step="any" onchange="checkInput('txtCapacidad')" Required>

                                        <label class="tituloCajaTextoFormulario" for="txtDescripcion">Estado:</label>
                                        <input type="text" class="form-control cajaTextoFormulario" id="txtEsta" name="txtEsta"
                                            placeholder="Escriba nombre del espacio..." onchange="checkInput('txtEsta')" Required>
                                    </div>
                                </div>
                                <!-- Segunda columna de controles -->
                                <div class="d-flex flex-column justify-content-center align-items-center col-xl-6 col-md-12 col-sm-12 col-xs-12 centrarColumnas">
                                        <!-- Cargar Fotografia -->
                                        <div class="form-group d-flex flex-column justify-content-center align-items-center">
                                            <div class="bordeDivFotografiaEspacio mb-1">
                                                <div class="divFotografia" id="divFotografia1">
                                                    <!--<img src="../../resources/img/67641302_948622395468919_4792483860753416192_n.jpg" alt="#" class="fit-images rounded-circle" width="150px">-->
                                                </div>
                                            </div>
                                            
                                            <button id="btnInsertDialogImagen" data-toggle="modal" data-target="#administrarImagenes" class="btn botonesListado mx-2 mb-3 mt-3"><span class="fas fa-camera mr-3 tamañoIconosBotones"></span>Fotografias</button>
                                        </div>
                                        <!-- Final Cargar Fotografia -->
                                        
                                        <!-- Cargar Fotografia -->
                                        <input id="archivo_espacio1" type="file" class="d-none" name="archivo_espacio1" accept=".gif, .jpg, .png">
                                        <input type="number" name="idEstadoEspacio1" id="idEstadoEspacio1" class="d-none">
                                </div>
                            </div>

                        </form>
                    <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->

    </div>
    <!-- Final del contenido -->
     <!-- Modal para ver las imagenes del espacio -->
     <div class="modal fade" id="administrarImagenes" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
                <div class="modal-content justify-content-center px-3 py-2">
                    <!-- Cabecera del Modal -->
                    <div class="modal-header">
                        <!-- Titulo -->
                        <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Imágenes de espacios</h5>
                        <!-- Boton para Cerrar -->
                        <button type="button" class="close closeModalButton lead" data-dismiss="modal" data-toggle="modal" data-target="#administrarEspacio">
                            <span class="fas fa-chevron-left"></span>
                        </button>
                    </div>
                    <br>
                    <!-- Contenido del Modal -->
                    <div class="textoModal px-3 pb-4 mt-2"> 
                        <div class="row">
                            <div class="col-12 d-flex">
                                <div class="gallery" id="gallery">
                                    
                                </div>
                            </div>

                        </div>
                        <!-- Fin del Contenido del Modal -->
                    </div>
                </div>
            </div>
        </div>
        <!-- Fin del Modal -->
<?php
//Se imprimen los JS necesarios
Admin_Page::footerTemplate('espacios.js');
?>   