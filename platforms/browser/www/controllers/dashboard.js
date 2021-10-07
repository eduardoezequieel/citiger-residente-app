//se capturan los datos de la url
var params = new URLSearchParams(location.search);
//Constante para la direccion de la API
const API_DASHBOARD = `http://34.125.88.216/app/api/residente/dashboard.php?id=${params.get('id')}&action=`;
const API_USUARIOS = `http://34.125.88.216/app/api/residente/index.php?id=${params.get('id')}&action=`;
//Se ejecutan al cargar la pagina
document.addEventListener('DOMContentLoaded', function () {
    contadorDenuncias();
    contadorVisitas();
    contadorAportacion();
    readRows(API_DASHBOARD);
    createSesionHistory();
    checkIfEmailIsValidated();
});

function checkIfEmailIsValidated() {
    fetch(API_USUARIOS + 'checkIfEmailIsValidated', {
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
                    console.log('a');
                    sweetAlert(1, response.exception, null);
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
    sendEmailCode(params.get('correo'));
})

//Funcion para enviar un correo electronico con el codigo de verificacion
function sendEmailCode(correo){
    fetch(API_USUARIOS + `sendEmailCode&correo=${correo}`, {
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
    fetch(API_USUARIOS + 'verifyCodeEmail', {
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

function contadorDenuncias() {
    fetch(API_DASHBOARD + 'contadorDenuncias', {
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

function contadorVisitas() {
    fetch(API_DASHBOARD + 'contadorVisitas', {
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


function contadorAportacion() {
    fetch(API_DASHBOARD + 'contadorAportacion', {
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

//Función para crear el historial de sesiones
function createSesionHistory(){
    fetch(API_USUARIOS + `createSesionHistory&ip=${params.get('ip')}&region=${params.get('region')}&sistema=${params.get('sistema')}`, {
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

//Función para abrir enlace a las visitas
function showVisitas(){
    //Redireccionando a las visitas
    window.location.href = `../html/visitas.html?id=${params.get('id')}&alias=${params.get('alias')}&foto=${params.get('foto')}&modo=${params.get('modo')}&correo=${params.get('correo')}&ip=${params.get('ip')}`;
}

//Función para abrir enlace a las denuncias
function showDenuncias(){
    //Redireccionando a las visitas
    window.location.href = `../html/denuncias.html?id=${params.get('id')}&alias=${params.get('alias')}&foto=${params.get('foto')}&modo=${params.get('modo')}&correo=${params.get('correo')}&ip=${params.get('ip')}`;
}