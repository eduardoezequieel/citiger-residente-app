<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/denuncias.php');

//Verificando si existe alguna acción
if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $denuncia = new Denuncias;
    //Array para respuesta de la API
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idresidente'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
                //Caso para leer todos los registros de la tabla
            case 'readComplaintStatus':
                if ($result['dataset'] = $denuncia->readStates()) {
                    $result['status'] = '1';
                    $result['message'] = 'Se han encontrado estados de denuncias.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se han encontrado estados de denuncias.';
                    }
                }
                break;

            case 'readComplaintType':
                if ($result['dataset'] = $denuncia->readTipoDenuncia()) {
                    $result['status'] = '1';
                    $result['message'] = 'Se han encontrado tipos de denuncias.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No se han encontrado tipos de denuncias.';
                    }
                }
                break;
                //Caso para realizar busquedas
            case 'search':
                $_POST = $denuncia->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $denuncia->searchRowsRes($_POST['search'])) {
                        $result['status'] = 1;
                        $row = count($result['dataset']);
                        if ($row > 0) {
                            $result['message'] = 'Se han encontrado ' . $row . ' coincidencias';
                        } else {
                            $result['message'] = 'Se ha encontrado una coincidencia';
                        }
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No hay coincidencias';
                        }
                    }
                } else {
                    $result['exception'] = 'Campo vacio';
                }
                break;
            case 'readOne2':
                $_POST = $denuncia->validateForm($_POST);
                if ($denuncia->setIdDenuncia($_POST['idDenuncia'])) {
                    if ($result['dataset'] = $denuncia->readOne2()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Denuncia inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Id incorrecto';
                }
                break;

            case 'readAll':
                if ($result['dataset'] = $denuncia->readAll()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos una denuncia.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen denuncias registradas.';
                    }
                }
                break;

            case 'createRow':
                $_POST = $denuncia->validateForm($_POST);
                $denuncia->setIdEstadoDenuncia(1);
                if (isset($_POST['cbTipo'])) {
                    if ($denuncia->setIdTipoDenuncia($_POST['cbTipo'])) {
                        if ($denuncia->setDescripcion($_POST['txtDescripcion'])) {
                            if ($denuncia->createRow()) {
                                $result['status'] = 1;
                                $result['message'] = 'Denuncia realizada correctamente.';
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Fecha invalida.';
                        }
                    } else {
                        $result['exception'] = 'Residente invalido.';
                    }
                } else {
                    $result['exception'] = 'Residente invalido.';
                }

                break;

            case 'updateRow':
                $_POST = $denuncia->validateForm($_POST);
                if ($denuncia->setIdDenuncia($_POST['idDenuncia'])) {
                    if ($denuncia->readOne2()) {
                        if (isset($_POST['cbTipo'])) {
                            if ($denuncia->setIdTipoDenuncia($_POST['cbTipo'])) {
                                if ($denuncia->setDescripcion($_POST['txtDescripcion'])) {
                                    if ($denuncia->updateRow()) {
                                        $result['status'] = 1;
                                        $result['message'] = 'Denuncia actualizada correctamente.';
                                    } else {
                                        $result['exception'] = Database::getException();
                                    }
                                } else {
                                    $result['exception'] = 'Descripcion invalida.';
                                }
                            } else {
                                $result['exception'] = 'Tipo invalido.';
                            }
                        } else {
                            $result['exception'] = 'Tipo invalido.';
                        }
                    } else {
                        $result['exception'] = 'Denuncia invalida.';
                    }
                } else {
                    $result['exception'] = 'Denuncia invalida.';
                }
                break;



            case 'readAllByState':
                $_POST = $denuncia->validateForm($_POST);
                if ($denuncia->setIdEstadoDenuncia($_POST['idEstadoDenuncia'])) {
                    if ($result['dataset'] = $denuncia->readAllByState()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado al menos una denuncia.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existen denuncias.';
                        }
                    }
                } else {
                    $result['exception'] = 'Id incorrecto';
                }
                break;

                //Caso de default del switch
            default:
                $result['exception'] = 'La acción no está disponible dentro de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        //Si la sesion no esta iniciada, entonces:
        print(json_encode('Acceso denegado. Por favor iniciar sesión'));
    }
} else {
    print(json_encode('Recurso no disponible'));
}
