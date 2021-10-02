<?php
    require_once('../../helpers/database.php');
    require_once('../../helpers/validator.php');
    require_once('../../models/espacios.php');

    //Se verifica si existe una acción
    if (isset($_GET['action'])) {
        //Se crea una sesion o se reanuda la sesion 
        session_start();
        //Se instancia la clase
        $espacio = new Espacios;
        //Se crea el array para guardar la respuesta
        $result = array('status'=>0,'error'=>0, 'message'=>null,'exception'=> null,'contador'=>0);
        //Se verifica si hay una sesion iniciada
        if (isset($_SESSION['idresidente'])) {
            //Se evalua cual acción es la que se va a ejecutar
            switch ($_GET['action']) {
                //Caso para leer todos los datos de la tabla
                case 'readAll':
                    if ($result['dataset'] = $espacio->readAll()) {
                        $result['status'] = 1;
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha encontrado ningún espacio registrado.';
                        }
                    }
                    break;
                //Caso para leer un dato de la tabla
                case 'readOne':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio'])) {
                        if ($result['dataset'] = $espacio->readOne()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha encontrado ningún espacio registrado.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el registro.';
                    }
                    break;
                //Caso para registrar un nuevo espacio
                case 'createRow':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setNombre(strtoupper($_POST['txtNombre']))) {
                        if ($espacio->setDescripcion($_POST['txtDescripcion'])) {
                            if ($espacio->setCapacidad($_POST['txtCapacidad'])) {
                                if (is_uploaded_file($_FILES['archivo_espacio1']['tmp_name'])) {
                                    if ($espacio->setFoto($_FILES['archivo_espacio1'])) {
                                        $espacio->setIdEstadoEspacio(1);
                                        if ($espacio->createRow()) {
                                            $result['status'] = 1;
                                            if ($espacio->saveFile($_FILES['archivo_espacio1'], $espacio->getRuta(), $espacio->getFoto())) {
                                                $result['message'] = 'Se ha creado el espacio correctamente.';
                                                $espacio->registerAction('Agregar','El usuario agregó un registro en la tabla de espacios.');
                                            } else {
                                                $result['message'] = 'Espacio agregado pero no se guardó la imagen';
                                            }
                                            
                                        } else {
                                            if (Database::getException()) {
                                                $result['exception'] = Database::getException();
                                            } else {
                                                $result['exception'] = 'No se ha agregado el espacio correctamente';
                                            }
                                        }
                                    } else {
                                        $result['exception'] = $espacio->getImageError();
                                    }
                                } else {
                                    $espacio->setIdEstadoEspacio(1);
                                    if ($espacio->createRow()) {
                                        $result['status'] = 1;
                                        if ($espacio->saveFile($_FILES['archivo_espacio1'], $espacio->getRuta(), $espacio->getFoto())) {
                                            $result['message'] = 'Se ha creado el espacio correctamente.';
                                                $espacio->registerAction('Agregar','El usuario agregó un registro en la tabla de espacios.');
                                        } else {
                                            $result['message'] = 'Espacio agregado pero no se guardó la imagen';
                                        }
                                        
                                    } else {
                                        if (Database::getException()) {
                                            $result['exception'] = Database::getException();
                                        } else {
                                            $result['exception'] = 'No se ha agregado el espacio correctamente';
                                        }
                                    }
                                }
                                
                            } else {
                                $result['exception'] = 'La cantidad ingresada no es válida.';
                            }
                        } else {
                            $result['exception'] = 'La descripción ingresada no es válida.';
                        }
                    } else {
                        $result['exception'] = 'El nombre ingresado no es válido.';
                    }
                    break;
                //Caso para actualizar el registro de la base
                case 'updateRow':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio'])) {
                        if ($data = $espacio->readOne()) {
                            if ($espacio->setNombre(strtoupper($_POST['txtNombre']))) {
                                if ($espacio->setDescripcion($_POST['txtDescripcion'])) {
                                    if ($espacio->setCapacidad($_POST['txtCapacidad'])) {
                                        if ($espacio->setIdEstadoEspacio($_POST['idEstadoEspacio1'])) {
                                            if (is_uploaded_file($_FILES['archivo_espacio1']['tmp_name'])) {
                                                if ($espacio->setFoto($_FILES['archivo_espacio1'])) {
                                                    if ($espacio->updateRow($data['imagenprincipal'])) {
                                                        $result['status'] = 1;
                                                        if ($espacio->saveFile($_FILES['archivo_espacio1'], $espacio->getRuta(), $espacio->getFoto())) {
                                                            $result['message'] = 'Se ha actualizado el espacio correctamente.';
                                                        $espacio->registerAction('Actualizar','El usuario actualizó un registro en la tabla de espacios.');
                                                        } else {
                                                            $result['message'] = 'Usuario modificado pero no se guardó la imagen';
                                                        }
                                                    } else {
                                                        if (Database::getException()) {
                                                            $result['exception'] = Database::getException();
                                                        } else {
                                                            $result['exception'] = 'No se ha actualizado el espacio correctamente';
                                                        }
                                                    }
                                                } else {
                                                    $result['exception'] = $espacio->getImageError();
                                                }
                                            } else {
                                                if ($espacio->updateRow($data['imagenprincipal'])) {
                                                    $result['status'] = 1;
                                                    $result['message'] = 'Se ha actualizado el espacio correctamente.';
                                                    $espacio->registerAction('Actualizar','El usuario actualizó un registro en la tabla de espacios.');
                                                } else {
                                                    if (Database::getException()) {
                                                        $result['exception'] = Database::getException();
                                                    } else {
                                                        $result['exception'] = 'No se ha actualizado el espacio correctamente';
                                                    }
                                                }
                                            }
                                            
                                        } else {
                                            $result['exception'] = 'El estado ingresado no es válido.';
                                        }
                                    } else {
                                        $result['exception'] = 'La cantidad ingresada no es válida.';
                                    }
                                } else {
                                    $result['exception'] = 'La descripción ingresada no es válida.';
                                }
                            } else {
                                $result['exception'] = 'El nombre ingresado no es válido.';
                            }
                        } else {
                            $result['exception'] = 'Hubo problemas al leer el registro.';
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el espacio.';
                    }
                    break;
                //Caso para eliminar el registro de la base
                case 'delete':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio'])) {
                        if ($espacio->deleteRow()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha eliminado el espacio correctamente';
                            $espacio->registerAction('Eliminar','El usuario eliminó un registro en la tabla de espacios');
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha eliminado el espacio correctamente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Problemas al seleccionar el espacio';
                    }
                    break;
                //Caso para suspender un registro
                case 'suspendRow':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio'])) {
                        $espacio->setIdEstadoEspacio(3);
                        if ($espacio->changeStatus()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha suspendido el espacio correctamente';
                            $espacio->registerAction('Suspender','El usuario suspendió un registro en la tabla de espacios');
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha suspendido el espacio correctamente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Problemas al seleccionar el espacio';
                    }
                    break;
                //Caso para activar un registro
                case 'activateRow':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio'])) {
                        $espacio->setIdEstadoEspacio(1);
                        if ($espacio->changeStatus()) {
                            $result['status'] = 1;
                            $result['message'] = 'Se ha activado el espacio correctamente';
                            $espacio->registerAction('Activar','El usuario activó un registro en la tabla de espacios');
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha activado el espacio correctamente';
                            }
                        }
                    } else {
                        $result['exception'] = 'Problemas al seleccionar el espacio';
                    }
                    break;
                //Caso para realizar busquedas
                case 'search':
                    $_POST = $espacio->validateForm($_POST);
                    if($_POST['search'] != ''){
                        if($result['dataset'] = $espacio->searchRows($_POST['search'])){
                            $result['status'] = 1;
                            $row = count($result['dataset']);
                            if($row > 0){
                                $result['message'] = 'Se han encontrado '.$row .' coincidencias';
                            } else{
                                $result['message'] = 'Se ha encontrado una coincidencia';
                            }
                        } else{
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
                //Caso para llenar combobox de estado espacio
                case 'readSpaceStatus':
                    if ($result['dataset'] = $espacio->readSpaceStatus()) {
                        $result['status'] = 1;
                        $result['message'] = 'Se ha encontrado al menos un estado.';
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No existen estados registrados.';
                        }
                    }
                    break;
                //Caso para cargar un registro en especifico
                case 'filterSpaceStatus':
                    $_POST = $espacio -> validateForm($_POST);
                    if ($espacio->setIdEstadoEspacio($_POST['idEstadoEspacio'])) {
                        if($result['dataset'] = $espacio->filterSpaceStatus()){
                            $result['status'] = 1;
                            $row = count($result['dataset']);
                            if($row > 0){
                                $result['message'] = 'Se han encontrado '.$row .' coincidencias';
                            } else{
                                $result['message'] = 'Se ha encontrado una coincidencia';
                            }
                        } else{
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No hay coincidencias';
                            }
                        }
                    }else{
                        $result['exception'] = 'Error id select';
                    }
                    break;
                //Caso para guardar foto
                case 'savePhoto':
                    $_POST = $espacio -> validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio1'])) {
                        if (is_uploaded_file($_FILES['archivo_espacio']['tmp_name'])) {
                            if ($espacio->setFoto($_FILES['archivo_espacio'])) {
                                if ($espacio->savePhoto()) {
                                    $result['status'] = 1;
                                    if ($espacio->saveFile($_FILES['archivo_espacio'], $espacio->getRuta(), $espacio->getFoto())) {
                                        $result['message'] = 'Imagen registrada correctamente';
                                        $espacio->registerAction('Registrar','El usuario registró una imagen en la tabla de imagenes_espacio');
                                    } else {
                                        $result['message'] = 'Imagen registrada pero no se guardó la imagen';
                                        $espacio->registerAction('Registrar','El usuario registró una imagen en la tabla de imagenes_espacio');
                                    }
                                } else {
                                    if (Database::getException()) {
                                        $result['exception'] = Database::getException();
                                    } else {
                                        $result['exception'] = 'No se ha agregado la imagen correctamente.';
                                    }
                                }
                            } else {
                                $result['exception'] = $espacio->getImageError();
                            }
                        } else {
                            $result['exception'] =  'Selecciona una imagen para el espacio.';
                        }
                    } else {
                        $result['exception'] = 'Hubo un problema al seleccionar el espacio.';
                    }
                    break;
                //Caso para leer el ultimo registro
                case 'readLast':
                    if ($result['dataset'] = $espacio->readLast()) {
                        $result['status'] = 1;
                        $result['id'] = $espacio->getIdEspacio();
                    } else {
                        if (Database::getException()) {
                            $result['exception'] = Database::getException();
                        } else {
                            $result['exception'] = 'No se ha encontrado ningún espacio registrado.';
                        }
                    }
                    break;
                //Case para leer las imagenes 
                case 'readImageSpace':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdEspacio($_POST['idEspacio3'])) {
                        if ($result['dataset'] = $espacio->readImageSpace()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha encontrado ninguna imagen registrada.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el registro.';
                    }
                    break;
                //Caso para eliminar imagenes
                case 'deleteImage':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdImagenEspacio($_POST['idImagenEspacio'])) {
                        if ($data = $espacio->readOneImage()) {
                            if ($espacio->deleteImage()) {
                                if ($espacio->deleteFile($espacio->getRuta(), $data['imagen'])) {
                                    $result['status'] = 1;
                                    $result['message'] = 'Imagen eliminada correctamente.';
                                    $espacio->registerAction('Eliminar','El usuario eliminó un registro en la tabla de imagenes.');
    
                                } else {
                                    $result['exception'] = 'Se borró el registro pero no la imagen.';
                                }
                            } else {
                                $result['exception'] = Database::getException();
                            }
                        } else {
                            $result['exception'] = 'Imagen no existente.';
                        }
                    } else {
                        $result['exception'] = 'Imagen seleccionado incorrecto.';
                    }
                    break;
                //Caso para actualizar foto
                case 'updatePhoto':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdImagenEspacio($_POST['idImagenEspacio1'])) {
                        if ($espacio->setFoto($_FILES['archivo_espacio'])) {
                            if ($data = $espacio->readOneImage()) {
                                if ($espacio->updateFoto($data['imagen'])) {
                                    $result['status'] = 1;
                                    if ($espacio->saveFile($_FILES['archivo_espacio'], $espacio->getRuta(), $espacio->getFoto())) {
                                        $result['message'] = 'Foto modificada correctamente';
                                    } else {
                                        $result['exception'] = 'Foto no actualiza';
                                    }
                                } else {
                                    $result['exception'] = Database::getException();
                                }
                            } else {
                                $result['exception'] = $espacio->getImageError();
                            }
                        }else{
                            $result['exception'] = 'Imagen inválida';
                        }
                    } else {
                        $result['exception'] = 'id inválido';
                    }
                    
                    break;
                //Caso pra leer un registro de la tabla imagenes
                case 'readOneImage':
                    $_POST = $espacio->validateForm($_POST);
                    if ($espacio->setIdImagenEspacio($_POST['idImagenEspacio'])) {
                        if ($result['dataset'] = $espacio->readOneImage()) {
                            $result['status'] = 1;
                        } else {
                            if (Database::getException()) {
                                $result['exception'] = Database::getException();
                            } else {
                                $result['exception'] = 'No se ha encontrado ninguna imagen registrada.';
                            }
                        }
                    } else {
                        $result['exception'] = 'Hubo problemas al seleccionar el registro.';
                    }
                    break;
                //Caso por defecto
                default:
                    $result['exception'] = 'La acción solicitada no está disponible dentro de la sesión.';
            }
        } else {
            $result['exception'] = 'La acción solicitada no está disponible fuera de la sesión.';
        }
        // Se indica el tipo de contenido a mostrar y su respectivo conjunto de caracteres.
        header('content-type: application/json; charset=utf-8');
        // Se imprime el resultado en formato JSON y se retorna al controlador.
        print(json_encode($result));
    } else {
        print(json_encode('Recurso no disponible'));
    }
?>