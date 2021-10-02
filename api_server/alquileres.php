<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/alquileres.php');

    //Se verifica si existe la acción
    if (isset($_GET['action'])) {
        //Se reanuda la sesión 
        session_start();
        //Se instancia la clase
        $alquiler = new Alquileres;
        //Se crea el array para la respuesta
        $result = array('status'=>0,'error'=>0, 'message'=>null,'exception'=> null);
        //Se verifica si hay una sesión iniciada
        if (isset($_SESSION['idresidente'])) {
            //Se evalua que acción se va a ejecutar
            switch ($_GET['action']) {
                //Caso para leer todos los datos de la tabla
                case 'readAll':
                    if ($result['dataset'] = $alquiler->readAllResident()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se encontró al menos un registro';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha encontrado ningún alquiler registrado.';
                        }
                    }
                    break;
                //Caso para llenar combobox de estado del alquiler
                case 'readRentalStatus':
                    if ($result['dataset'] = $alquiler->readRentalStatus()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        }
                    }
                    break;
                //Caso para llenar combobx de espacios
                case 'readSpace':
                    if ($result['dataset'] = $alquiler->readSpace()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        }
                    }
                    break;
                //Caso para leer un dato en especifico
                case 'readOne':
                    $_POST = $alquiler->validateForm($_POST);
                    if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                        if ($result['dataset'] = $alquiler->readOne()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha encontrado ningún alquiler registrado.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el registro.';
                    }
                    break;
                //Caso para realizar busquedas
                case 'search':
                    $_POST = $alquiler->validateForm($_POST);
                    if($_POST['search'] != ''){
                        if($result['dataset'] = $alquiler->searchRowsResident($_POST['search'])){
                            $result['status'] = 1;
                            $row = count($result['dataset']);
                            if($row > 0){
                                $result['message'] = 'Se han encontrado '.$row .' coincidencias';
                            } else{
                                $result['message'] = 'Se ha encontrado una coincidencia.';
                            }
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Campo vacio';
                    }
                    break;
                //Caso para cargar un registro en especifico
                case 'filterRentalStatus':
                    $_POST = $alquiler -> validateForm($_POST);
                    if ($alquiler->setIdEstadoAlquiler($_POST['idEstadoAlquiler'])) {
                        if($result['dataset'] = $alquiler->filterRentalStatusResident()){
                            $result['status'] = 1;
                            $row = count($result['dataset']);
                            if($row > 0){
                                $result['message'] = 'Se han encontrado '.$row .' coincidencias.';
                            } else{
                                $result['message'] = 'Se ha encontrado una coincidencia.';
                            }
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias.';
                            }
                        }
                    }else{
                        $result['exception'] = 'Hubo un problema al seleccionar el estado del alquiler.';
                    }
                    break;
                //Caso para agregar un registro
                case 'createRow':
                    $_POST = $alquiler->validateForm($_POST);
                    if (isset($_POST['cbEspacio'])) {
                        if ($alquiler->setIdEspacio($_POST['cbEspacio'])) {
                            if ($alquiler->setFecha($_POST['txtFecha'])) {
                                if ($_POST['txtHoraInicio'] != $_POST['txtHoraFin'] && 
                                    $_POST['txtHoraInicio'] < $_POST['txtHoraFin']) {
                                    if ($alquiler->setHoraInicio($_POST['txtHoraInicio'])) {
                                        if ($alquiler->setHoraFin($_POST['txtHoraFin'])) {
                                            $alquiler->setPrecio(00.00);
                                            $alquiler->setIdEstadoAlquiler(1);
                                            $alquiler->setIdUsuario(1);
                                            if ($alquiler->requestRow()) {
                                                $result['status'] = 1;
                                                $result['message'] = 'Se ha solicitado el alquiler correctamente.';
                                            } else {
                                                if (Database::getException()) {
                                                    $result['exception'] = Database::getException();
                                                } else {
                                                    $result['exception'] = 'No se ha agregado el alquiler correctamente.';
                                                }
                                            }
                                        } else {    
                                            $result['exception'] = 'La hora de fin ingresada no es válida.';
                                        }  
                                    } else {    
                                        $result['exception'] = 'La hora de inicio ingresada no es válida.';
                                    }
                                } else {
                                    $result['exception'] = 'La hora de inicio no puede ser igual o menor a la hora de fin.';
                                }
                            } else {
                                $result['exception'] = 'La fecha ingresada no es válida.';
                            }
                        } else {    
                            $result['exception'] = 'El espacio seleccionado no es válido.';
                        }
                    } else {
                        $result['exception'] =  'Seleccione un espacio.';
                    }
                    break;
                //Caso para actualizar un registro
                case 'updateRow':
                    $_POST = $alquiler->validateForm($_POST);
                    if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                        if ($alquiler->readOne()) {
                            if (isset($_POST['cbEspacio'])) {
                                if ($alquiler->setIdEspacio($_POST['cbEspacio'])) {
                                    if ($alquiler->setFecha($_POST['txtFecha'])) {
                                        if ($_POST['txtHoraInicio'] != $_POST['txtHoraFin'] &&
                                            $_POST['txtHoraInicio'] < $_POST['txtHoraFin']) {
                                            if ($alquiler->setHoraInicio($_POST['txtHoraInicio'])) {
                                                if ($alquiler->setHoraFin($_POST['txtHoraFin'])) {
                                                    $alquiler->setPrecio(00.00);
                                                        $alquiler->setIdEstadoAlquiler(1);
                                                        $alquiler->setIdUsuario(1);
                                                        if ($alquiler->updateRequestRow()) {
                                                            $result['status'] = 1;
                                                            $result['message'] = 'Se ha actualizado el alquiler correctamente.';
                                                        } else {
                                                            if (Database::getException()) {
                                                                $result['exception'] = Database::getException();
                                                            } else {
                                                                $result['exception'] = 'No se ha actualizado el alquiler correctamente.';
                                                            }
                                                        }
                                                } else {    
                                                    $result['exception'] = 'La hora de fin ingresada no es válida.';
                                                }  
                                            } else {    
                                                $result['exception'] = 'La hora de inicio ingresada no es válida.';
                                            }
                                        } else {
                                            $result['exception'] = 'La hora de inicio no puede ser igual o mayor a la hora de fin.';
                                        }
                                    } else {
                                        $result['exception'] = 'La fecha ingresada no es válida.';
                                    }
                                } else {    
                                    $result['exception'] = 'El espacio seleccionado no es válido.';
                                }
                            } else {
                                $result['exception'] =  'Seleccione un espacio.';
                            }
                        } else {
                            $result['exception'] = 'No se encontró el resgitro de este alquiler.';
                        }
                    } else {
                        $result['exception'] = 'Hubo un problema al seleccionar el alquiler.';
                    }
                    break;
                    //Caso para eliminar el registro de la base
                    case 'delete':
                        $_POST = $alquiler->validateForm($_POST);
                        if ($alquiler->setIdAlquiler($_POST['idAlquiler'])) {
                            if ($alquiler->setIdEspacio($_POST['idEspacio'])) {
                                if ($alquiler->deleteRow()) {
                                    $result['status'] = 1;
                                    if ($alquiler->checkSpaceStatus()) {
                                        $result['message'] = 'Se ha cancelado el alquiler correctamente';
                                    } else {
                                        $alquiler->setIdEstadoEspacio(1);
                                        $alquiler->changeSpaceStatus();
                                        $result['message'] = 'Se ha cancelado el alquiler correctamente.';
                                    }
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'No se ha cancelado el alquiler correctamente.';
                                    }
                                }
                            } else {
                                $result['exception'] = 'Hubo problemas al seleccionar el espacio.';
                            }
                        } else {
                            $result['exception'] = 'Problemas al seleccionar el alquiler.';
                        }
                        break;
                default:
                    $result['exception'] = 'La acción solicitada no está disponible dentro de la sesión';
            } 
        } else {
            $result['exception'] = 'La acción solicitada no está disponible fuera de la sesión';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Recurso no disponible'));
    }
?>