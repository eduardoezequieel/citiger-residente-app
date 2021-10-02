//Constantes para las api
const API_VISITA = '../../app/api/residente/visitas.php?action=';
const ENDPOINT_VISITANTE = '../../app/api/residente/visitas.php?action=readVisitante';

//Al cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);
    readRows(API_VISITA);
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
})

//Al activar el evento submit del formulario verificarDui-form
document.getElementById('verificarDui-form').addEventListener('submit',function(event){
    //Evitamos recargar la pagina
    event.preventDefault();
    //fetch para verificar la informacion
    fetch(API_VISITA + 'checkVisitor', {
        method: 'post',
        body: new FormData(document.getElementById('verificarDui-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Sucede si se encuentra el visitante
                    console.log('El visitante existe.');
                    //Cerramos el modal actual
                    closeModal('verificarDui');
                    //Mandamos la informacion al nuevo modal
                    var num = document.getElementById('txtDuiVerificar').value;
                    console.log(num);
                    getVisitorData(num);
                    //Abrimos el nuevo modal
                    openModal('crearVisita');
                } else {
                    // Se evalua la causa de que no se hayan recuperado datos
                    if (response.exception == 'No existe ningún visitante con este DUI.') {
                        // Nos notifica de que el visitante no existe, por lo tanto procedera al modal para crearlo
                        //Asignamos el dui a la caja de texto del modal que se abrira
                        document.getElementById('txtDUI').value = document.getElementById('txtDuiVerificar').value;
                        //Cerramos el modal actual
                        closeModal('verificarDui');
                        //Abrimos el nuevo modal
                        openModal('administrarVisitante');
                    } else {
                        // Se evalua si el response.exception es un mensaje de que el DUI es incorrecto o un error de la base
                        sweetAlert(2, response.exception, null);
                    }
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

//Al presionar en el boton
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    // Se reinician los campos del formulario
    document.getElementById('txtDuiVerificar').value = '';
});

//Agregar y actualizar información
document.getElementById('administrarVisita-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    fillSelect(ENDPOINT_VISITANTE, 'cbVisitante', null);
    saveRow(API_VISITA, 'createRow', 'administrarVisita-form', 'crearVisita');
    readRows(API_VISITA);
});

document.getElementById('btnNo').addEventListener('click', function () {
    // Se reinician los campos del formulario
    document.getElementById('txtApellido').value = '';
    document.getElementById('txtPlaca').value = '';
    document.getElementById('txtNombre').value = '';
    document.getElementById('txtDUI').value = '';
});

//Agregar y actualizar información
document.getElementById('Visitante-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    fetch(API_VISITA + 'createVisitante', {
        method: 'post',
        body: new FormData(document.getElementById('Visitante-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se cargan nuevamente las filas en la tabla de la vista después de agregar o modificar un registro.
                    //sweetAlert(1, response.message, closeModal(modal));
                    closeModal('administrarVisitante');
                    getVisitorData(document.getElementById('txtDUI').value);
                    openModal('crearVisita');
                    clearForm('Visitante-form');

                } else {
                    sweetAlert(2, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

//Funcion para obtener la informacion del visitante
function getVisitorData(dui){
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('txtDuiVerificar', dui);
    console.log(dui);
    fetch(API_VISITA + 'checkVisitor', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('lblVisitante2').textContent = response.dataset.nombre + ' ' + response.dataset.apellido;
                    document.getElementById('lblDui').textContent = response.dataset.dui;
                    document.getElementById('lblPlaca2').textContent = response.dataset.placa;
                    document.getElementById('idVisitante').value = response.dataset.idvisitante;
                } else {
                    console.log(response.exception);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Llenado de tabla
function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
        <tr class="animate__animated animate__fadeIn">
        <!-- Datos-->
        <td>${row.visitante}</td>
        <td>${row.estadovisita}</td>
        <td>${row.fecha}</td>
        <!-- Boton-->
        <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" data-toggle="modal" onclick="readOne(${row.iddetallevisita})" data-target="#informacionVisita" class="btn btnTabla"><i class="fas fa-info-circle"></i></a>

                </div>
            </div>
        </th>
    </tr>
        `;
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    $('#data-table').DataTable({
        retrieve: true,
        searching: false,
        language:
            {
                "decimal":        "",
                "emptyTable":     "No hay información disponible en la tabla.",
                "info":           "Mostrando _START_ de _END_ de _TOTAL_ registros.",
                "infoEmpty":      "Mostrando 0 de 0 de 0 registros",
                "infoFiltered":   "(filtered from _MAX_ total entries)",
                "infoPostFix":    "",
                "thousands":      ",",
                "lengthMenu":     "Mostrar _MENU_ registros",
                "loadingRecords": "Loading...",
                "processing":     "Processing...",
                "search":         "Search:",
                "zeroRecords":    "No matching records found",
                "paginate": {
                    "first":      "AAA",
                    "last":       "Ultimo",
                    "next":       "Siguiente",
                    "previous":   "Anterior"
                },
                "aria": {
                    "sortAscending":  ": activate to sort column ascending",
                    "sortDescending": ": activate to sort column descending"
                }
            }
    });
}

function readOne(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDetalle', id);
    console.log(id);

    fetch(API_VISITA + 'readOne', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idDetalle').value = response.dataset.iddetallevisita;
                    document.getElementById('lblVisitante').textContent = (response.dataset.visitante);
                    document.getElementById('lblPlaca').textContent = (response.dataset.placa);
                    document.getElementById('lblFecha').textContent = (response.dataset.fecha);
                    document.getElementById('lblVisita').textContent = (response.dataset.visitarecurrente);
                    document.getElementById('lblEstado').textContent = (response.dataset.estadovisita);
                    document.getElementById('lblOb').textContent = (response.dataset.observacion);



                } else {
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Busqueda
function searchRows2(API_VISITA, form) {
    fetch(API_VISITA + 'search', {
        method: 'post',
        body: new FormData(document.getElementById(form))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                    fillTable2(response.dataset);
                    sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(2, response.exception, null);
                    console.log("error");
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Busqueda
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();

    //Llamamos la funcion
    searchRows2(API_VISITA, 'search-form');
})


$(document).ready(function(){
    $("#txtDuiVerificar").mask("00000000-0");
});