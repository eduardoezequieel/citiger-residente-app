//Constante para la direccion de la API
const API_DASHBOARD = 'http://34.125.57.125/app/api/residente/dashboard.php?action=';
const API_USUARIOS = 'http://34.125.57.125/app/api/residente/index.php?action=';
//se capturan los datos de la url
var params = new URLSearchParams(location.search);

//Se ejecutan al cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    
    var id = params.get('id');
    var ip = params.get('ip');
    var correo = params.get('correo');
    contadorDenuncias(id);
    contadorVisitas(id);
    contadorAportacion(id);
    readRows(API_DASHBOARD, id);
    createSesionHistory(id, ip);
    checkIfEmailIsValidated(id);
});

function checkIfEmailIsValidated(id) {
    fetch(API_USUARIOS + `checkIfEmailIsValidated&id=${id}`, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    if (response.dataset.verificado == '0') {
                        
                        document.getElementById('alerta-verificacion').classList.remove('d-none');
                    } else if (response.dataset.verificado == '1') {
                        
                        document.getElementById('alerta-verificacion').remove();
                    }
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

//Función para completar el autotab 
function autotab(current, to, prev) {
    if (current.getAttribute &&
        current.value.length == current.getAttribute("maxlength")) {
        to.focus();
    } else {
        prev.focus();
    }
}

//Funcion que se ejecuta al hacer click en un boton
document.getElementById('btnSendEmailCode').addEventListener('click',function(){
    sendEmailCode(params.get('id'), params.get('correo'));
})

//Funcion para enviar un correo electronico con el codigo de verificacion
function sendEmailCode(id, correo){
    fetch(API_USUARIOS + `sendEmailCode&id=${id}&correo=${correo}`, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

//Función para verificar el codigo
document.getElementById('verificarCodigo-form').addEventListener('submit', function (event) {
    //Se evita que se recargue la pagina
    var uno = document.getElementById('1a').value;
    var dos = document.getElementById('2a').value;
    var tres = document.getElementById('3a').value;
    var cuatro = document.getElementById('4a').value;
    var cinco = document.getElementById('5a').value;
    var seis = document.getElementById('6a').value;
    document.getElementById('codigoAuth').value = uno + dos + tres + cuatro + cinco + seis;
    let params = new URLSearchParams(location.search);
    var id = params.get('id');
    event.preventDefault();
    fetch(API_USUARIOS + `verifyCodeEmail&id=${params.get('id')}`, {
        method: 'post',
        body: new FormData(document.getElementById('verificarCodigo-form'))
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    // Mostramos mensaje de exito
                    closeModal('verificarCorreo');
                    sweetAlert(1, response.message, `dashboard.html?id=${params.get('id')}&alias=${params.get('alias')}&foto=${params.get('foto')}&modo=${params.get('modo')}&correo=${params.get('correo')}&ip=${params.get('ip')}`);
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
});

function contadorDenuncias(id) {
    fetch(API_DASHBOARD + `contadorDenuncias&id=${id}`, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtDenuncia').textContent = response.dataset.denunciaspendientes;
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}

function contadorVisitas(id) {
    fetch(API_DASHBOARD + `contadorVisitas&id=${id}`, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtVisitas').textContent = response.dataset.visitas;
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


function contadorAportacion(id) {
    fetch(API_DASHBOARD + `contadorAportacion&id=${id}`, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                let data = [];
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    document.getElementById('txtAportaciones').textContent = response.dataset.aportaciones;
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}


function fillTable(dataset) {
    let content = '';
    // Se recorre el conjunto de registros (dataset) fila por fila a través del objeto row.
    dataset.map(function (row) {
        // Se crean y concatenan las filas de la tabla con los datos de cada registro.
        content += `
    <tr class="animate__animated animate__fadeIn">
                            <!-- Datos-->
                            <th scope="row">
                                <div class="row paddingTh">
                                    <div class="col-12 mt-1">
                                        <i class="fas fa-home lead"></i>
                                    </div>
                                </div>
                            </th>
                            <td>${row.mespago}</td>
                            <td>$ ${row.monto}</td>
                            <td>${row.fechapago}</td>
                            <td>${row.estadoaportacion}</td>
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

function createSesionHistory(id, ip){
    fetch(API_USUARIOS + `createSesionHistory&id=${id}&ip=${ip}`, {
        method: 'get'
    }).then(function (request) {
        // Se verifica si la petición es correcta, de lo contrario se muestra un mensaje indicando el problema.
        if (request.ok) {
            request.json().then(function (response) {
                // Se comprueba si la respuesta es satisfactoria, de lo contrario se muestra un mensaje con la excepción.
                if (response.status) {
                    //console.log(response.message);
                } else {
                    sweetAlert(4, response.exception, null);
                }
            });
        } else {
            console.log(request.status + ' ' + request.statusText);
        }
    }).catch(function (error) {
        console.log(error);
    });
}