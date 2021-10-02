//constante para guardar la ruta de la api
const API_ESPACIO = '../../app/api/residente/espacios.php?action=';
const ENDPOINT_ESTADO = '../../app/api/residente/espacios.php?action=readSpaceStatus';


//Evento que se ejecuta al cargar la pag
document.addEventListener('DOMContentLoaded', function () {
    //Llenando combobox de estado espacio
    fillSelect(ENDPOINT_ESTADO, 'cbEstadoEspacio',null);
    //Verificar si hay espacios registrados en la base
    fetch(API_ESPACIO + 'readAll').then(request => {
        //Se verifica si la petición fue correcta
        if (request.ok) {   
            request.json().then(response => {
                //Se verifica si la respuesta fue no fue satisfactoria de lo contrario no muestra nada
                if (response.status) {
                    readRows(API_ESPACIO);
                } else {
                    sweetAlert(4,response.exception, null);
                }
            })
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error=>console.log(error));
})


//Llenado de tabla de espacios
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        if (row.imagenprincipal) {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-4 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/dashboard_img/espacios_fotos/${row.imagenprincipal}" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Información -->
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Capacidad: <span class="letraDestacadaTarjeta">${row.capacidad}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" onclick="readDataOnModal(${row.idespacio}) " data-toggle="modal" data-target="#administrarEspacio" class="btn btnTabla"><span class="fas fa-eye"></span></a>
                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `; 
        } else {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="../../resources/img/no-image.png" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Información -->
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Capacidad: <span class="letraDestacadaTarjeta">${row.capacidad}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                    <a href="#" onclick="readDataOnModal(${row.idespacio}) " data-toggle="modal" data-target="#administrarEspacio" class="btn btnTabla"><span class="fas fa-eye"></span></a>
                                </div>
                            </div>

                        <!-- Fin de Tarjeta -->
                        </div>
                    </div>
            `; 
        }
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('show-tarjeta').innerHTML = content;
}

//Llenado de tabla de imagenes
function fillTableImage(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <a href="../../resources/img/dashboard_img/espacios_fotos/${row.imagen}" data-lightbox="mygallery" data-image-alt="Image 1">
                <img src="../../resources/img/dashboard_img/espacios_fotos/${row.imagen}" alt="Thumbnail 1" width="200px" height="110px" class="imagenEspacio mr-4">
            </a>
        `; 
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('gallery').innerHTML = content;
}

//Carga de datos del registro seleccionado del espacio
function readDataOnModal(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idEspacio', id);
    //Se ocultan los botones del formulario.
    document.getElementById('btnInsertDialogImagen').className = 'btn btnAgregarFormulario mr-2';

    fetch(API_ESPACIO + 'readOne', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idEspacio').value = response.dataset.idespacio;
                    document.getElementById('idEspacio3').value = response.dataset.idespacio;
                    document.getElementById('txtNombre').value = response.dataset.nombre;
                    document.getElementById('txtDescripcion').value = response.dataset.descripcion;
                    document.getElementById('txtCapacidad').value = response.dataset.capacidad;
                    document.getElementById('txtEsta').value = response.dataset.estadoespacio;
                    if (response.dataset.imagenprincipal) {
                        previewSavePicture('divFotografia1', response.dataset.imagenprincipal,5);
                    } else {
                        previewSavePicture('divFotografia1', 'default.png', 5);
                    }
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}

//Buscando registros
document.getElementById('search-form').addEventListener('submit',function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_ESPACIO, 'search-form');
})


//Busqueda por estado de espacio

/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form*/
document.getElementById('cbEstadoEspacio').addEventListener('change', function (event) {
     //Se evita recargar la pagina
     event.preventDefault();
    //Guardando el valor del select en un input
    document.getElementById('idEstadoEspacio').value = document.getElementById('cbEstadoEspacio').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarEspacio').click();   
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoEspacio-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Se realiza el filtro
    filter(API_ESPACIO,'filterSpaceStatus','filtrarEstadoEspacio-form');
})

//Método para resetear busqueda
document.getElementById('btnReiniciar').addEventListener('click', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    readRows(API_ESPACIO);
    document.getElementById('search').value='';
    fillSelect(ENDPOINT_ESTADO, 'cbEstadoEspacio',null);
});

document.getElementById('btnInsertDialogImagen').addEventListener('click', function (event) {
    //Evento para evitar que recargue la pag
    event.preventDefault();
    //Método para cerrar el modal que está en uso
    closeModal('administrarEspacio');
    //Obteniendo las imagenes extras del espacio
    readRowsImage(API_ESPACIO,'espacio-form');
})

//Carga de datos del registro seleccionado
function readDataOnModalImage(id){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idImagenEspacio', id);
    closeModal('administrarImagenes');
    document.getElementById('btnAgregarImagen').className = 'd-none';
    document.getElementById('btnActualizarImagen').className = 'btn btnAgregarFormulario mr-2';

    fetch(API_ESPACIO + 'readOneImage', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('idImagenEspacio').value = response.dataset.idimagenesespacio;
                    document.getElementById('idImagenEspacio1').value = response.dataset.idimagenesespacio;
                    previewSavePicture('divFotografia', response.dataset.imagen,5);
                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}