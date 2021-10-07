//se capturan los datos de la url
var params = new URLSearchParams(location.search);
//constante para la ruta de la api
const API_ALQUILERES = `http://34.125.88.216/app/api/residente/alquileres.php?id=${params.get('id')}&action=`;
const ENDPOINT_ESTADO_ALQUILER = `http://34.125.88.216/app/api/residente/alquileres.php?id=${params.get('id')}&action=readRentalStatus`;
const ENDPOINT_ESPACIO_ALQUILERES = `http://34.125.88.216/app/api/residente/alquileres.php?id=${params.get('id')}&action=readSpace`;

//Evento al terminar de cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    //Llenando los combobox necesarios
    fillSelect(ENDPOINT_ESTADO_ALQUILER,'cbEstadoAlquiler',null);
    // Se declara e inicializa un objeto para obtener la fecha y hora actual.
    let today = new Date();
    // Se declara e inicializa una variable para guardar el día en formato de 2 dígitos.
    let day = ('0' + today.getDate()).slice(-2);
    // Se declara e inicializa una variable para guardar el mes en formato de 2 dígitos.
    var month = ('0' + (today.getMonth() + 1)).slice(-2);
    // Se declara e inicializa una variable para guardar el año con la mayoría de edad.
    let year = today.getFullYear();
    // Se declara e inicializa una variable para establecer el formato de la fecha.
    let date = `${year}-${month}-${day}`;
    // Se asigna la fecha como valor máximo en el campo del formulario.
    document.getElementById('txtFecha').setAttribute('min', date);
    readEspacios(API_ALQUILERES);
    readRows(API_ALQUILERES);    
       

})

//Llenado de tabla de alquiler
function fillTable(dataset){
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        if (row.imagenprincipal) {
            // Se crean y concatenan las filas de la tabla con los datos de cada registro.
            content += `
                    <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-2 d-flex margenTarjetas justify-content-center align-items-center text-center">
                        <!-- Inicio de Tarjeta -->
                        <div class="tarjeta3">
                        <!-- Fila para Imagen -->
                            <div class="row">
                                <div class="col-12">
                                    <img src="http://34.125.88.216/resources/img/dashboard_img/espacios_fotos/${row.imagenprincipal}" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Hora de inicio: <span class="letraDestacadaTarjeta">${row.horainicio}</span></h1>
                                    <h1 class="letraTarjeta">Fecha: <span class="letraDestacadaTarjeta">${row.fecha}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#verAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-eye"></i></a>
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
                                    <img src="http://34.125.88.216/resources/img/no-image.png" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
                                </div>
                            </div>
                            <!-- Fila para Información -->
                            <div class="row mt-2">
                                <div class="col-12 text-left">
                                    <h1 class="letraTarjetaTitulo">${row.nombre}</h1>
                                    <h1 class="letraTarjeta">Hora de inicio: <span class="letraDestacadaTarjeta">${row.horainicio}</span></h1>
                                </div>
                            </div>
                            <!-- Fila para Boton -->
                            <div class="row">
                                <div class="col-12">
                                <a href="#" onclick="readDataOnModal(${row.idalquiler}) " data-target="#verAlquiler" data-toggle="modal" class="btn btnTabla"><i class="fas fa-eye"></i></a>
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


//Método para resetear botones
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    clearForm('alquiler-form');
    //Ocultando y mostrando botones
    document.getElementById('btnAgregar').className = 'btn btnAgregarFormulario mr-2';
    document.getElementById('btnActualizar').className = 'd-none';
    document.getElementById('btnCancelar').className = 'd-none';
    document.getElementById('idEspacio').value = 0;
})

/*Agregando o actualizando un nuevo registro a la tabla
  Se verifica si se muestra el botón agregar se hace un createRow, de lo contrario un updateRow*/
  document.getElementById('alquiler-form').addEventListener('submit', function (event) {
    //Evento para evitar que recargué la pagina
     event.preventDefault();
    //Verificando la acción que se va a realizar
    if(document.getElementById('btnAgregar').className != 'd-none') {
        //Agregando el registro
        saveRow(API_ALQUILERES, 'createRow','alquiler-form','agregarAlquiler');
    } else {
        //Actualizando
        saveRow(API_ALQUILERES, 'updateRow','alquiler-form','agregarAlquiler');
    } 
})

//Buscando registros
document.getElementById('search-form').addEventListener('submit',function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_ALQUILERES, 'search-form');
})

/*Cada vez que cambie el valor del select, se enviara a un input invisible y de igual forma se 
presionara un boton invisible para poder activar el evento submit del form*/
document.getElementById('cbEstadoAlquiler').addEventListener('change', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
   //Guardando el valor del select en un input
   document.getElementById('idEstadoAlquiler').value = document.getElementById('cbEstadoAlquiler').value;
   //Presionando el boton invisible
   document.getElementById('btnFiltrarAlquiler').click();   
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoAlquiler-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();
    //Se realiza el filtro
    filter(API_ALQUILERES,'filterRentalStatus','filtrarEstadoAlquiler-form');
 })

//Método para resetear busqueda
document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_ALQUILERES);
    document.getElementById('search').value='';
    fillSelect(ENDPOINT_ESTADO_ALQUILER,'cbEstadoAlquiler',null);
});

document.getElementById('btnCancelar').addEventListener('click', function (event) {
    //Evento para evitar que recargué la pagina
    event.preventDefault();

    swal({
        title: 'Advertencia',
        text: '¿Desea eliminar el registro?',
        icon: 'warning',
        buttons: ['No', 'Sí'],
        closeOnClickOutside: false,
        closeOnEsc: false
    }).then(function (value) {
        // Se verifica si fue cliqueado el botón Sí para hacer la petición de borrado, de lo contrario no se hace nada.
        if (value) {
            fetch(API_ALQUILERES + 'delete', {
                method: 'post',
                body: new FormData(document.getElementById('alquiler-form'))
            }).then(function (request) {
                // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
                if (request.ok) {
                    request.json().then(function (response) {
                        // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                        if (response.status) {
                            // Se cargan nuevamente las filas en la tabla de la vista después de borrar un registro.
                            readRows(API_ALQUILERES);
                            sweetAlert(1, response.message, closeModal('administrarAlquiler'));
                            clearForm('alquiler-form');
                        } else {
                            sweetAlert(2, response.exception, null);
                            console.log(response.status + ' ' + response.statusText);
                        }
                    });
                } else {
                    console.log(request.status + ' ' + request.statusText);
                }
            }).catch(function (error) {
                console.log(error);
            });
        }
    });
})


//Llenado de cartas
function fillTable2(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <div class="animate__animated animate__bounceIn col-xl-4 col-md-4 col-sm-12 col-xs-12 mt-4 d-flex margenTarjetas justify-content-center align-items-center text-center">
                            <!-- Inicio de Tarjeta -->
                            <div class="tarjeta">
                                <!-- Fila para Imagen -->
                                <div class="row">
                                    <div class="col-12">
                                        <img src="http://34.125.88.216/resources/img/dashboard_img/espacios_fotos/${row.imagenprincipal}" alt="#" class="img-fluid fit-images fotoEspacio imagenTarjeta">
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
                                        <button data-toggle="modal" onclick="readOneEspacio(${row.idespacio}) " data-target="#agregarAlquiler" data-dismiss="modal" class="btn botonesTarjeta"><span class="fas fa-plus mr-2"></span>Agregar</button>
                                    </div>
                                </div>
                                <!-- Fin de Tarjeta -->
                            </div>


                        </div>

                    
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('espacios').innerHTML = content;
}

//Carga de datos del registro seleccionado
function readOneEspacio(id) {
    // Se configuran los botones dependiendo de la accion seleccionada
    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";
    document.getElementById('btnCancelar').className = "d-none";
   


    const data = new FormData();
    data.append('idEspacio', id);
    //Se ocultan los botones del formulario.


    fetch(API_ALQUILERES + 'readOneEspacio', {
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
                    document.getElementById('lblEspacio2').textContent = (response.dataset.nombre);


                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}



//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idAlquiler2', id);
    //Se ocultan los botones del formulario.
    fetch(API_ALQUILERES + 'readOne', {
        method: 'post',
        body: data
    }).then(request => {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(response => {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('lblFecha').textContent = (response.dataset.fecha);
                    document.getElementById('lblInicio').textContent = (response.dataset.horainicio);
                    document.getElementById('lblFin').textContent = (response.dataset.horafin);
                    document.getElementById('lblEstado').textContent = (response.dataset.estadoalquiler);

                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(error => console.log(error));
}