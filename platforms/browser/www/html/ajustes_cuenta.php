<?php
//Se incluye la clase con las plantillas del documento
include('../../app/helpers/resident_page.php');
//Se imprime la plantilla del encabezado y se envía el titulo para la página web
admin_Page::sidebarTemplate('Ajustes | Citiger');
?>

<!-- Contenedor de la Pagina -->
<div class="page-content p-3" id="content">
    <div id="cuadroContenido">
        <button id="sidebarCollapse" type="button" class="btn bg-darken"><i class="fa fa-bars categoriasFuente tamañoIconos"></i><small class="text-uppercase font-weight-bold"></small></button>
        <!-- Desde aqui comienza el contenido -->

        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <div class="contenedorMiCuenta">
                    <div class="row mb-3">
                        <div class="col-12">
                            <h1 class="tituloPagina text-center">Mi Cuenta</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center animate__animated animate__zoomIn">
                        <div class="col-12 d-flex justify-content-center">
                            <form method="post" id="img-form">
                                <!-- Cargar Fotografia -->
                                <div class="row">
                                    <div class="col">
                                        <div class="divFotografiaAjustes">
                                            <div class="bordeDivFotografia mb-1">
                                                <div id="divFoto">
                                                </div>
                                            </div>
                                            <div id="btnAgregarFoto">
                                                <button class="btn btnCargarFoto2"><span class="fas fa-plus"></span></button>
                                            </div>
                                            <input id="archivo_usuario" type="file" class="d-none" name="archivo_usuario" accept=".gif, .jpg, .png">
                                            <button class="d-none" id="btnUpload" type="submit"></button>
                                            <h1 id="nombres" class="tituloUsuario mt-3"></h1>
                                        </div>
                                    </div>
                                    <!-- Final Cargar Fotografia -->
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- Sección para cambiar información personal -->
                    <div class="row mt-3">
                        <div class="col-12">
                            <h1 class="tituloTarjetaAjustes">Información Personal</h1>

                        </div>
                    </div>

                    <div class="row justify-content-center animate__animated animate__zoomIn">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <!-- Div especializado para cada sección -->
                            <div class="informacionPersonal">
                                <div class="row justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <!-- Titulo -->
                                            <h1 class="tituloInformacion">Nombres</h1>
                                            <!-- Información -->
                                            <h2 class="informacion" id="lblNombres"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Apellidos</h1>
                                            <h2 class="informacion" id="lblApellidos"></h2>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">DUI</h1>
                                            <h2 class="informacion" id="lblDUI"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Genéro</h1>
                                            <h2 class="informacion" id="lblGenero"></h2>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Teléfono Fijo</h1>
                                            <h2 class="informacion" id="lblTelFijo"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Teléfono Celular</h1>
                                            <h2 class="informacion" id="lblTelCelular"></h2>
                                        </form>
                                    </div>
                                </div>
                                <div class="row mt-2 justify-content-center ml-4">
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <h1 class="tituloInformacion">Fecha de Nacimiento</h1>
                                            <h2 class="informacion" id="lblFechaNac"></h2>
                                        </form>
                                    </div>
                                    <div class="col-6 divColumnasAjustes">
                                        <form>
                                            <a href="#" id="btnEditarAjustes" onclick="readDataOnModal()" data-toggle="modal" data-target="#administrarCuenta" class="btn botonesAjustes">Editar</a>
                                        </form>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <!-- Sección para administrar ajustes de la cuenta (mismo formato de arriba) -->
                    <div class="row mt-4">
                        <div class="col">
                            <h1 class="tituloTarjetaAjustes">Ajustes de la Cuenta</h1>
                        </div>
                    </div>

                    <div class="row justify-content-center animate__animated animate__zoomIn">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="informacionPersonal">
                                <div class="row">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Usuario</h1>
                                        <h2 class="informacion" id="lblUser"></h2>
                                    </div>
                                    <div class="col-6">
                                        <button id="btnAdministrarUsuarioModal" class="btn botonesAjustes">Cambiar</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Correo Electrónico</h1>
                                        <h2 class="informacion" id="lblCorreo"></h2>
                                    </div>
                                    <div class="col-6">
                                        <button data-toggle="modal" data-target="#administrarEmail" class="btn botonesAjustes">Cambiar</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Factor de Doble Autenticación</h1>
                                        <h2 class="informacion" id="lblAuth"></h2>
                                    </div>
                                    <div class="col-6">
                                        <button onclick="readFailedSessions()" id="btnModalAdministrarAuth" class="btn botonesAjustes">Cambiar</button>
                                    </div>
                                </div>
                                <div class="row mt-2">
                                    <div class="col-6">
                                        <h1 class="tituloInformacion">Contraseña</h1>
                                        <h2 class="informacion">*********</h2>
                                    </div>
                                    <div class="col-6">
                                        <button id="btnModalContraseña" class="btn botonesAjustes">Cambiar</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <div class="row mt-4">
                        <div class="col">
                            <h1 class="tituloTarjetaAjustes">Dispositivos Registrados</h1>
                        </div>
                    </div>

                    <div class="justify-content-center" id="dispositivo">
                        
                    </div>

                </div>
            </div>
        </div>
        <!-- Desde aqui finaliza el contenido -->
    </div>

</div>
<!-- Final del contenido -->

<!-- Modal para Administrar informacion personal -->
<div class="modal fade" id="administrarCuenta" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Editar información</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                <form method="post" id="admin-form"  autocomplete="off">

                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <label class="tituloCajaTextoFormulario mt-2" for="txtNombres">Nombres:</label>
                            <input onchange="checkInputLetras('txtNombres')" type="text" class="form-control cajaTextoModal" id="txtNombres" name="txtNombres" placeholder="" maxlength="30">

                            <label class="tituloCajaTextoFormulario " for="txtApellidos">Apellidos:</label>
                            <input onchange="checkInputLetras('txtApellidos')" type="text" class="form-control cajaTextoModal" id="txtApellidos" name="txtApellidos" placeholder="" maxlength="30" >

                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                        cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                        deseado en el combobox  -->
                            <label class="tituloCajaTextoFormulario mb-2">Género:</label>
                            <!-- Combobox, si se desea usar, copiar todo el div que incluye la clase
                                cbCitiger, para cambiarle el tamaño, crear un id en cbCitiger y usar el width
                                deseado en el combobox  -->
                            <div class="cbCitiger w-20 col-md-12" id="cbCitiger">
                                <select class="custom-select" id="cbGenero" name="cbGenero">
                                    <option selected="">Seleccionar...</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12">
                            <div class="form-group">

                                <label class="tituloCajaTextoFormulario mt-2" for="txtFechaNacimiento">Fecha de Nacimiento:</label>
                                <input type="date" class="form-control cajaTextoModal" id="txtFechaNacimiento" name="txtFechaNacimiento" placeholder="">

                                <label class="tituloCajaTextoFormulario " for="txtTelefonoFijo">Teléfono Fijo:</label>
                                <input onchange="checkTelefono('txtTelefonoFijo')" type="text" class="form-control cajaTextoModal" id="txtTelefonoFijo" name="txtTelefonoFijo" placeholder="" maxlength="9">

                                <label class="tituloCajaTextoFormulario" for="txtTelefonomovil">Teléfono Movil:</label>
                                <input onchange="checkTelefono('txtTelefonomovil')" type="text" class="form-control cajaTextoModal" id="txtTelefonomovil" name="txtTelefonomovil" placeholder="" maxlength="9">

                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col col-xl-6 col-md-6 col-sm-12 col-xs-12 align-items-center">
                            <label class="tituloCajaTextoFormulario" for="txtDUI">DUI:</label>
                            <input input onchange="checkDUI('txtDUI')" type="text" class="form-control cajaTextoModal" id="txtDUI" name="txtDUI" placeholder="" maxlength="10">
                        </div>

                    </div>

                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnActualizar" type="submit" name="btnActualizar" href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-edit mr-3 tamañoIconosBotones"></span>Actualizar</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Cambiar Contraseña -->
<div class="modal fade" id="administrarContrasena" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Actualizar Contraseña</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert yellowAlert alert-dismissible fade show" role="alert">
                                <strong>Importante.</strong> Tu contraseña debe de cumplir con los siguientes requisitos: <br>
                                <br>
                                - Mínimo 8 caracteres <br>
                                - Máximo 15 <br>
                                - Al menos una letra mayúscula <br>
                                - Al menos una letra minúscula <br>
                                - Al menos un dígito <br>
                                - No espacios en blanco <br>
                                - Al menos 1 carácter especial	
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <form method="post" action="/form" autocomplete="off" id="password-form">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtNuevaContrasena">Nueva Contraseña:</label>
                                <input onChange="checkContrasena('txtNuevaContrasena')" type="password" class="form-control cajaTextoModal2" id="txtNuevaContrasena" name="txtNuevaContrasena" placeholder="" maxlength="60">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtConfirmarContrasena">Confirmar Contraseña:</label>
                                <input onChange="checkContrasena('txtConfirmarContrasena')" type="password" class="form-control cajaTextoModal2" id="txtConfirmarContrasena" name="txtConfirmarContrasena" placeholder="" maxlength="60">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group w-xl-50 w-md-50">
                                <label class="tituloCajaTextoFormulario" for="txtContrasenaActual">Contraseña Actual:</label>
                                <input onChange="checkContrasena('txtContrasenaActual')" type="password" class="form-control cajaTextoModal2" id="txtContrasenaActual" name="txtContrasenaActual" placeholder="" maxlength="60">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="custom-control custom-switch">
                                <input onchange="showHidePassword2('cbMostrarContraseña', 'txtContrasenaActual', 'txtNuevaContrasena', 'txtConfirmarContrasena')" type="checkbox" class="p-0 custom-control-input" id="cbMostrarContraseña">
                                <label class="p-0 custom-control-label" for="cbMostrarContraseña">Mostrar Contraseña</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnActualizarContrasena" type="submit" name="btnActualizar" href="#" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Cambiar Contraseña</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Cambiar Autenticación -->
<div class="modal fade" id="administrarAuth" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Factor de Doble Autenticación</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!-- Contenido del Modal -->
            <div class="modal-body textoModal px-3 pb-4">
                <div class="row">
                    <div class="col-12">
                        <div class="alert yellowAlert alert-dismissible fade show" role="alert">
                            <strong>Importante.</strong> Debes ingresar tu contraseña para poder actualizar estos ajustes.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <form method="post" action="/form" autocomplete="off" id="auth-form">
                    <div class="row my-3">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="custom-control custom-switch">
                                <input onchange="changeInputValue('switchValue')" type="checkbox" class="p-0 custom-control-input" id="cbDobleAuth">
                                <label class="p-0 custom-control-label" for="cbDobleAuth">Factor de Doble Autenticación</label>
                            </div>
                            <input type="hidden" name="switchValue" id="switchValue" value="No">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group w-xl-50 w-md-50">
                                <label class="tituloCajaTextoFormulario" for="txtContrasenaActualAuth">Contraseña Actual:</label>
                                <input onChange="checkContrasena('txtContrasenaActualAuth')" type="password" class="form-control cajaTextoModal2" id="txtContrasenaActualAuth" name="txtContrasenaActualAuth" placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="custom-control custom-switch">
                                <input onchange="showHidePassword('cbMostrarContraseña2', 'txtContrasenaActualAuth')" type="checkbox" class="p-0 custom-control-input" id="cbMostrarContraseña2">
                                <label class="p-0 custom-control-label" for="cbMostrarContraseña2">Mostrar Contraseña</label>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-4 mb-2">
                        <div class="col-12">
                            <h1 class="text-center tituloInformacion">Registro de sesiones fallidas (Últimas 5):</h1>
                        </div>
                    </div>
                    <!-- Tabla-->
                    <div class="row justify-content-center">
                        <div class="col-12 justify-content-center align-items-center text-center">
                            <table class="table table-borderless citigerTable" id="data-table2">
                                <thead>
                                    <!-- Columnas-->
                                    <tr>
                                        <th scope="col"></th>
                                        <th scope="col">Fecha</th>
                                        <th scope="col">Hora</th>
                                        <th scope="col">Acción</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody id="tbody-rows">
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button id="btnActualizarAuth" type="submit" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Actualizar</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Cambiar Email -->
<div class="modal fade" id="administrarEmail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Actualizar Correo Electrónico</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert yellowAlert alert-dismissible fade show" role="alert">
                                <strong>Importante.</strong> Asegúrate de colocar un correo electrónico valido.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <form method="post" autocomplete="off" id="email-form">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtNuevoCorreo">Nuevo Correo Electrónico:</label>
                                <input onChange="checkCorreo('txtNuevoCorreo')" type="email" maxlength="50" class="form-control cajaTextoModal2" id="txtNuevoCorreo" name="txtNuevoCorreo" placeholder="ejemplo@mail.com">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtConfirmarCorreo">Confirmar Correo:</label>
                                <input onChange="checkCorreo('txtConfirmarCorreo')" type="email" maxlength="50" class="form-control cajaTextoModal2" id="txtConfirmarCorreo" name="txtConfirmarCorreo" placeholder="ejemplo@mail.com">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group w-xl-50 w-md-50">
                                <label class="tituloCajaTextoFormulario" for="txtPassword">Contraseña Actual:</label>
                                <input onChange="checkContrasena('txtPassword')" type="password" class="form-control cajaTextoModal2" id="txtPassword" name="txtPassword" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="custom-control custom-switch">
                                <input onchange="showHidePassword('cbMostrarContraseña4', 'txtPassword')" type="checkbox" class="p-0 custom-control-input" id="cbMostrarContraseña4">
                                <label class="p-0 custom-control-label" for="cbMostrarContraseña4">Mostrar Contraseña</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button type="submit" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Actualizar Correo Electrónico</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->

<!-- Modal para Cambiar Usuarios -->
<div class="modal fade" id="administrarUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content justify-content-center px-3 py-2">
            <!-- Cabecera del Modal -->
            <div class="modal-header">
                <!-- Titulo -->
                <h5 class="modal-title tituloModal" id="exampleModalLabel"><span class="fas fa-info-circle mr-4 iconoModal"></span>Actualizar Usuario</h5>
                <!-- Boton para Cerrar -->
                <button type="button" class="close closeModalButton lead" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <br>
            <!-- Contenido del Modal -->
            <div class="textoModal px-3 pb-4 mt-2">
                    <div class="row">
                        <div class="col-12">
                            <div class="alert yellowAlert alert-dismissible fade show" role="alert">
                                <strong>Importante.</strong> Asegúrate de colocar un usuario con carácteres alfanúmericos.
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        </div>
                    </div>
                <form method="post" autocomplete="off" id="username-form">
                    <div class="row">
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtNuevoUsuario">Nuevo Usuario:</label>
                                <input onChange="checkAlfanumerico('txtNuevoUsuario')" type="text" maxlength="25" class="form-control cajaTextoModal2" id="txtNuevoUsuario" name="txtNuevoUsuario" placeholder="usuario123">
                            </div>
                        </div>
                        <div class="col-xl-6 col-md-6 col-sm-12 col-xs-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group">
                                <label class="tituloCajaTextoFormulario" for="txtConfirmarUsuario">Confirmar Nuevo Usuario:</label>
                                <input onChange="checkAlfanumerico('txtConfirmarUsuario')" type="text" maxlength="25" class="form-control cajaTextoModal2" id="txtConfirmarUsuario" name="txtConfirmarUsuario" placeholder="usuario123">
                            </div>
                        </div>
                        
                    </div>
                    <div class="row">
                        <div class="col-12 d-flex flex-column justify-content-center align-items-center">
                            <div class="form-group w-xl-50 w-md-50">
                                <label class="tituloCajaTextoFormulario" for="txtPassword2">Contraseña Actual:</label>
                                <input onChange="checkContrasena('txtPassword2')" type="password" class="form-control cajaTextoModal2" id="txtPassword2" name="txtPassword2" placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12 d-flex justify-content-center align-items-center">
                            <div class="custom-control custom-switch">
                                <input onchange="showHidePassword('cbMostrarContraseña5', 'txtPassword2')" type="checkbox" class="p-0 custom-control-input" id="cbMostrarContraseña5">
                                <label class="p-0 custom-control-label" for="cbMostrarContraseña5">Mostrar Contraseña</label>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Botones de Acción del Formulario -->
                    <div class="row justify-content-center mt-4">
                        <div class="col-12 d-flex justify-content-center align-items-center text-center">
                            <button type="submit" class="btn btnAgregarFormulario mr-2"><span class="fas fa-check mr-3 tamañoIconosBotones"></span>Actualizar Correo Electrónico</button>
                        </div>
                    </div>
                </form>
                <!-- Fin del Contenido del Modal -->
            </div>
        </div>
    </div>
</div>
<!-- Fin del Modal -->


<?php
//Se imprimen los JS necesarios
admin_Page::footerTemplate('ajustes_cuenta.js');
?>
