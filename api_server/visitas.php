<?php
require_once('../../helpers/database.php');
require_once('../../helpers/validator.php');
require_once('../../models/visitas.php');
require_once('../../models/visitantes.php');


//Verificando si existe alguna acción
if (isset($_GET['action'])) {
    //Se crea una sesion o se reanuda la actual
    session_start();
    //Instanciando clases
    $visita = new Visitas;
    //Instanciando clases
    $visitante = new Visitantes;
    //Array para respuesta de la API
    $result = array('status' => 0, 'error' => 0, 'message' => null, 'exception' => null);
    //Verificando si hay una sesion iniciada
    if (isset($_SESSION['idresidente'])) {
        //Se compara la acción a realizar cuando la sesion está iniciada
        switch ($_GET['action']) {
                //Caso para leer todos los registros de la tabla
            case 'readAll':
                if ($result['dataset'] = $visita->readVisitas()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos una visita.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen visitas registradas.';
                    }
                }
                break;
                //Caso para cargar un registro en especifico
            case 'readOne':
                $_POST = $visita->validateForm($_POST);
                if ($visita->setIdVisita($_POST['idDetalle'])) {
                    if ($result['dataset'] = $visita->readOne2()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'Visita inexistente';
                        }
                    }
                } else {
                    $result['exception'] = 'Visita seleccionada incorrecta';
                }
                break;

            case 'createRow':
                $_POST = $visita->validateForm($_POST);
                $visita->setIdEstadoVisita(1);
                    if ($visita->setIdResidente($_SESSION['idresidente'])) {
                        if ($visita->setFecha($_POST['txtFecha'])) {
                            if (isset($_POST['cbVisitaR'])) {
                                if ($visita->setVisitaR($_POST['cbVisitaR'])) {
                                    if ($visita->setObservacion($_POST['txtObservacion'])) {
                                        if ($visita->createRow()) {
                                            if ($visita->setIdVisitante($_POST['idVisitante'])) {
                                                if ($data = $visita->getLastId()) {
                                                    if ($visita->setIdVisita($data['idvisita'])) {
                                                        if ($visita->insertDetalleVisita()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Visita registrada correctamente.';
                                                        } else {

                                                            $result['exception'] = 'Visitante invalido.';
                                                        }
                                                    } else {
                                                        $result['exception'] = 'Visita invalida.';
                                                    }
                                                } else {
                                                    $result['exception'] = 'No id.';
                                                }
                                            } else {
                                                $result['exception'] = 'Visitante invalido.';
                                            }
                                        } else {
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Observación invalida.';
                                    }
                                } else {
                                    $result['exception'] = 'Visita Recurrente invalida.';
                                }
                            } else {
                                $result['exception'] = 'Por favor seleccione si es una visita recurrente o no.';
                            }
                        } else {
                            $result['exception'] = 'Fecha invalida.';
                        }
                    } else {
                        $result['exception'] = 'Residente invalido.';
                    }
              

                break;
                //Caso para ingresar visitante 
            case 'createVisitante':
                $_POST = $visita->validateForm($_POST);
                if ($visita->setNombre($_POST['txtNombre'])) {
                    if ($visita->setApellido($_POST['txtApellido'])) {
                        if ($visita->setDui($_POST['txtDUI'])) {
                            if ($visita->setPlaca($_POST['txtPlaca'])) {
                                if (isset($_POST['cbGenero'])) {
                                    if ($visita->setGenero($_POST['cbGenero'])) {
                                        if ($visita->createVistante()) {
                                            $result['status'] = 1;
                                            $result['message'] = 'Visitante registrado correctamente.';
                                        } else {
                                            $result['error'] = 1;
                                            $result['exception'] = Database::getException();
                                        }
                                    } else {
                                        $result['exception'] = 'Genero invalido.';
                                    }
                                } else {
                                    $result['exception'] = 'Genero invalido.';
                                }
                            } else {
                                $result['exception'] = 'Placa invalida.';
                            }
                        } else {
                            $result['exception'] = 'DUI invalido.';
                        }
                    } else {
                        $result['exception'] = 'Apellido invalido.';
                    }
                } else {
                    $result['exception'] = 'Nombre invalido.';
                }
                break;
            case 'readVisitante':
                if ($result['dataset'] = $visita->readVisitante()) {
                    $result['status'] = 1;
                    $result['message'] = 'Se ha encontrado al menos un visitante.';
                } else {
                    if (Database::getException()) {
                        $result['exception'] = Database::getException();
                    } else {
                        $result['exception'] = 'No existen residentes registrados.';
                    }
                }
                break;
            case 'search':
                $_POST = $visita->validateForm($_POST);
                if ($_POST['search'] != '') {
                    if ($result['dataset'] = $visita->searchRows($_POST['search'])) {
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
                //Caso para verificar el dui de un visitante (Si existe o no)
                case 'checkVisitor':
                    $_POST = $visitante->validateForm($_POST);
                    if ($visitante->setDui($_POST['txtDuiVerificar'])) {
                        if ($result['dataset'] = $visitante->checkVisitor()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha encontrado al visitante.';
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No existe ningún visitante con este DUI.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Dui incorrecto.';
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
