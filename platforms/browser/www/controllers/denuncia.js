const API_DENUNCIA = '../../app/api/residente/denuncia.php?action=';
const ENDPOINT_ESTADO = '../../app/api/residente/denuncia.php?action=readComplaintStatus';
const ENDPOINT_TIPO = '../../app/api/residente/denuncia.php?action=readComplaintType';

document.addEventListener('DOMContentLoaded', function () {

    fillSelect(ENDPOINT_ESTADO, 'cbEstadoDenuncia', null);
    fillSelect(ENDPOINT_TIPO, 'cbTipo', null);
    readRows(API_DENUNCIA);

})

function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
            <tr class="animate__animated animate__fadeIn">
                <th scope="row">
                    <div class="row paddingTh">
                        <div class="col-12">
                            <img src="../../resources/img/usericon.png" alt="#"
                                class="rounded-circle fit-images" width="30px" height="30px">
                        </div>
                    </div>
                </th>
                <td>${row.tipodenuncia}</td>
                <td>${row.estadodenuncia}</td>
                <td>${row.fecha}</td>
                <!-- Boton-->
                
        `;

        if (row.estadodenuncia == "Pendiente") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#administrarDenuncia" class="btn btnTabla mx-2"><i class="fas fa-edit"></i></a>
                </div>
            </div>
        </th>
        </tr>
        `
        } 
        else if (row.estadodenuncia == "Rechazada") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#verDenuncias" class="btn btnTabla mx-2"><i class="fas fa-ban"></i></a>
                </div>
            </div>
        </th> 
        </tr>
        `
        } 
        else if (row.estadodenuncia == "Solucionada") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#verDenuncias" class="btn btnTabla mx-2"><i class="fas fa-info-circle"></i></a>
                </div>
            </div>
        </th> 
        </tr>
        `
        }
        else if (row.estadodenuncia == "En proceso") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#verDenuncias" class="btn btnTabla mx-2"><i class="fas fa-briefcase"></i></a>
                </div>
            </div>
        </th> 
        </tr>
        `
        }  
        else if (row.estadodenuncia == "Revisión") {
            content += `
            <th scope="row">
            <div class="row paddingBotones">
                <div class="col-12">
                    <a href="#" onclick="readDataOnModal(${row.iddenuncia}) "data-toggle="modal" data-target="#verDenuncias" class="btn btnTabla mx-2"><i class="fas fa-question"></i></a>
                </div>
            </div>
        </th> 
        </tr>
        `
        }  
        
    });
    // Se agregan las filas al cuerpo de la tabla mediante su id para mostrar los registros.
    document.getElementById('tbody-rows').innerHTML = content;

    $('#data-table').DataTable({
        retrieve: true,
        searching: false,
        language:
        {
            "decimal": "",
            "emptyTable": "No hay información disponible en la tabla.",
            "info": "Mostrando _START_ de _END_ de _TOTAL_ registros.",
            "infoEmpty": "Mostrando 0 de 0 de 0 registros",
            "infoFiltered": "(filtered from _MAX_ total entries)",
            "infoPostFix": "",
            "thousands": ",",
            "lengthMenu": "Mostrar _MENU_ registros",
            "loadingRecords": "Loading...",
            "processing": "Processing...",
            "search": "Search:",
            "zeroRecords": "No matching records found",
            "paginate": {
                "first": "AAA",
                "last": "Ultimo",
                "next": "Siguiente",
                "previous": "Anterior"
            },
            "aria": {
                "sortAscending": ": activate to sort column ascending",
                "sortDescending": ": activate to sort column descending"
            }
        }
    });
}

document.getElementById('btnReiniciar').addEventListener('click', function () {
    readRows(API_DENUNCIA);
    fillSelect(ENDPOINT_ESTADO, 'cbEstadoDenuncia', null);

});

//ocultar los demas botones de acción en el formulario al presionar Agregar.
document.getElementById('btnInsertDialog').addEventListener('click', function () {
    document.getElementById('lblResp').className = "d-none";
    document.getElementById('lblResp2').className = "d-none";
    document.getElementById('texto').className = "tituloDato2 text-center";
    fillSelect(ENDPOINT_TIPO, 'cbTipo', null);


    document.getElementById('btnAgregar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('btnActualizar').className = "d-none";

    // Se reinician los campos del formulario
    document.getElementById('idDenuncia').value = '';
    document.getElementById('txtDescripcion').value = '';






});

//Agregar y actualizar información
document.getElementById('administrarDenuncia-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    event.preventDefault();

    //Se evalua si el usuario esta haciendo una inserción o una actualización
    if (document.getElementById('btnAgregar').className != 'd-none') {
        saveRow(API_DENUNCIA, 'createRow', 'administrarDenuncia-form', 'administrarDenuncia');
    } else {
        saveRow(API_DENUNCIA, 'updateRow', 'administrarDenuncia-form', 'administrarDenuncia');

    }
});


//Busqueda por estado denuncia
document.getElementById('cbEstadoDenuncia').addEventListener('change', function () {
    //Guardando el valor del select en un input
    document.getElementById('idEstadoDenuncia').value = document.getElementById('cbEstadoDenuncia').value;
    //Presionando el boton invisible
    document.getElementById('btnFiltrarDenuncia').click();
})

//Una vez presionado el boton invisible, se hace un fetch con la información del form.
document.getElementById('filtrarEstadoDenuncia-form').addEventListener('submit', function (event) {
    //Se evita recargar la pagina
    event.preventDefault();

    fetch(API_DENUNCIA + 'readAllByState', {
        method: 'post',
        body: new FormData(document.getElementById('filtrarEstadoDenuncia-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    data = response.dataset;
                    //sweetAlert(1, response.message, null);
                } else {
                    sweetAlert(4, response.exception, null);
                }
                // Se envían los datos a la función del controlador para que llene la tabla en la vista.
                fillTable(data);
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});


//---------------------------BUSQUEDAS EN LA TABLA---------------------------

//Busqueda común

/*En el evento submit del formulario llamamos una funcion que ya tiene especificado un fetch para
las busquedas.*/
document.getElementById('search-form').addEventListener('submit', function (event) {
    //Evitamos recargar la pagina
    event.preventDefault();
    //Llamamos la funcion
    searchRows(API_DENUNCIA, 'search-form');
})


//Carga de datos del registro seleccionado
function readDataOnModal(id) {
    // Se define un objeto con los datos del registro seleccionado.
    const data = new FormData();
    data.append('idDenuncia', id);
    console.log(id);

    //Se ocultan los botones del formulario.
    document.getElementById('texto').className = "d-none";
    document.getElementById('btnAgregar').className = "d-none";
    document.getElementById('btnActualizar').className = "btn btnAgregarFormulario mr-2";
    document.getElementById('lblResp').className = "campoDato text-center";
    document.getElementById('lblResp2').className = "tituloDato2 text-center";
    document.getElementById('lblRespuesta').className = "campoDato text-center";
    document.getElementById('lblRespuesta2').className = "tituloDato text-center";





    fetch(API_DENUNCIA + 'readOne2', {
        method: 'post',
        body: data
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Se inicializan los campos del formulario con los datos del registro seleccionado.
                    document.getElementById('idDenuncia').value = response.dataset.iddenuncia;
                    document.getElementById('idDenuncia2').value = response.dataset.iddenuncia;
                    fillSelect(ENDPOINT_TIPO, 'cbTipo', response.dataset.idtipodenuncia);
                    document.getElementById('txtDescripcion').value = response.dataset.descripcion;
                    if (response.dataset.idestadodenuncia == 1) {
                        document.getElementById('lblResp2').className = "d-none";

                    } else if (response.dataset.idestadodenuncia == 2) {
                        document.getElementById('btnActualizar').className = "d-none";

                    } else if (response.dataset.idestadodenuncia == 3) {
                        document.getElementById('btnActualizar').className = "d-none";
                        document.getElementById('lblResp2').className = "d-none";
                        document.getElementById('lblRespuesta2').className = "d-none";
                        document.getElementById('lblRespuesta').className = "d-none";

                        



                    } else if (response.dataset.idestadodenuncia == 4) {
                        document.getElementById('btnActualizar').className = "d-none";
                        document.getElementById('lblResp2').className = "d-none";
                        document.getElementById('lblRespuesta2').className = "d-none";
                        document.getElementById('lblRespuesta').className = "d-none";




                    } else if (response.dataset.idestadodenuncia == 5) {
                        document.getElementById('btnActualizar').className = "d-none";
                        document.getElementById('lblResp2').className = "d-none";
                        document.getElementById('lblRespuesta2').className = "d-none";
                        document.getElementById('lblRespuesta').className = "d-none";




                    }


                    document.getElementById('lblResp').textContent = (response.dataset.respuesta);
                    document.getElementById('lblRespuesta').textContent = (response.dataset.respuesta);

                    document.getElementById('lblTipoDenuncia').textContent = (response.dataset.tipodenuncia);
                    document.getElementById('lblFecha').textContent = (response.dataset.fecha);
                    document.getElementById('lblEstado').textContent = (response.dataset.estadodenuncia);
                    document.getElementById('lblDesc').textContent = (response.dataset.descripcion);







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
}