<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/dashboard.php');

if (isset($_GET['action'])) {
    //Reanudando la sesion
    session_start();

    //Objeto para instanciar la clase
    $dashboard = new Dashboard();

    //Arreglo para guardar respuestas de la API
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);

    //Acciones a ejecutar permitidas con la sesion iniciada
    if (isset($_GET['id'])) {
        switch ($_GET['action']) {
            case 'readAll':
                $_SESSION['idresidente'] = $_GET['id'];
                if ($result['dataset'] = $dashboard->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se han encontrado registros en la bitacora.';
                } else {
                    if (Database::getException()) {
                        $result['error'] = 1;
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen registros en la bitacora.';
                    }
                }
                session_destroy();
                break;
            case 'contadorDenuncias':
                $_SESSION['idresidente'] = $_GET['id'];
                if ($result['dataset'] = $dashboard->contadorDenuncias2()) {
                    $result['status'] = 1;
                    $result['message'] = 'Denuncias encontradas';
                } else {
                    $result['exception'] = Database::getException();
                }
                session_destroy();
                break;
            case 'contadorVisitas':
                $_SESSION['idresidente'] = $_GET['id'];
                if ($result['dataset'] = $dashboard->contadorVisitas()) {
                    $result['status'] = 1;
                    $result['message'] = 'Visitas encontradas';
                } else {
                    $result['exception'] = Database::getException();
                }
                session_destroy();
                break;
            case 'contadorAportacion':
                $_SESSION['idresidente'] = $_GET['id'];
                if ($result['dataset'] = $dashboard->contadorAportaciones()) {
                    $result['status'] = 1;
                    $result['message'] = 'Visitas encontradas';
                } else {
                    $result['exception'] = Database::getException();
                }
                session_destroy();
                break;
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    }
    //Si la sesion no esta iniciada, entonces:
    else {
        print(json_encode('Acceso denegado. Por favor iniciar sesión'));
    }
} else {
    print(json_encode('El recurso no esta disponible'));
}
