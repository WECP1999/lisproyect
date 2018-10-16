/**
 * @name AdminController
 * @description Controlador de inicio de administrador
 * @augments $scope,$http,dsgx
 */
import { Project, Devices } from '../app.config.js';
export default angular.module('c.admin', []).controller(Devices.ADMIN, function ($scope, $http, dsgx, $routeParams) {
    $scope.show = false;
    $scope.nameMateria = "";
    $scope.log = "Administrador";

    $http.get(Project + '/auth/log/info')
        .then(response => {
            if (response.data.state === false)
                window.location.href = "#!/login";
            else if (response.data.type === 'd') {
                $scope.show = true;
                $scope.logout = () => {
                    dsgx.confirmar("¡Un momento!", "¿Estás seguro de que quieres cerrar sesión?", () => {
                        $http.post(Project + '/auth/log/out', {})
                            .then(response => {
                                window.location.href = "#!/login";
                            }, error => {
                                dsgx.alerta("¡Ups!", error.data.msg, "error");
                            });
                    });
                };
                $scope.paterns = {
                    nombre: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                    apellido: /^([A-ZÁÉÍÓÚ]{1}[a-zñáéíóú]+[\s]*)+$/,
                    letra: /^[a-zA-ZñÑ]/,
                    alumno: /A[0-9]{4}/,
                    maestro: /M[0-9]{4}/,
                    user: /^[\w\.\-]+$/,
                    telefono: /^[276][0-9]{3}-[0-9]{4}/,
                    direccion: /^([a-zñáéíóú]+[\s]*)+$/,
                    contra: /^(?=\w*\d)(?=\w*[A-Z])(?=\w*[a-z])\S{8,16}$/
                };
                $scope.maestroData = {
                    id: "",
                    nombre: "",
                    apellido: "",
                    user: "",
                    cont: "",
                    concontra: "",
                    est: "1"
                };
                $scope.alumnoData = {
                    id: "",
                    nombre: "",
                    apellido: "",
                    telefono: "",
                    dir: "",
                    contra: "",
                    concontra: "",
                    est: "1"
                };
                $scope.asignacionData = {
                    id: ""
                };
                $http.get(Project + '/admin/mostrar/seccion')
                    .then(r => {
                        angular.forEach(r.data, val => {
                            $("#slSeccion").append(
                                '<option value="' + val.id + '">' + val.year + ' ' + val.seccion + '</option>'
                            );
                            if ($routeParams.idA) {
                                $http.post(Project + '/admin/show/alumno', {
                                    id: $routeParams.idA
                                }).then(r => {
                                    $('#slSeccion').val(r.data.sec.toString());
                                }, err => {
                                    console.log(err)
                                });
                            }
                            if ($routeParams.idS) {
                                $http.post(Project + '/admin/show/asignacion', {
                                    id: $routeParams.idS
                                }).then(r => {
                                    $('#slSeccion').val(r.data.sec.toString());
                                }, err => {
                                    console.log(err)
                                });
                            }
                        });
                    }, err => {
                        console.error(err)
                    })
                $http.get(Project + '/admin/mostrar/material')
                    .then(r => {
                        angular.forEach(r.data, val => {
                            $("#slMateria").append(
                                '<option value="' + val.id + '">' + val.nombre + '</option>'
                            );
                            if ($routeParams.idS) {
                                $http.post(Project + '/admin/show/asignacion', {
                                    id: $routeParams.idS
                                }).then(r => {
                                    $('#slMateria').val(r.data.mat.toString());
                                }, err => {
                                    console.log(err)
                                });
                            }
                        });
                    }, err => {
                        console.error(err)
                    })
                $http.get(Project + '/admin/mostrar/maestrol')
                    .then(r => {
                        angular.forEach(r.data, val => {
                            $("#slMaestro").append(
                                '<option value="' + val.id + '">' + val.nombre + ' ' + val.apellido + '</option>'
                            );
                            if ($routeParams.idS) {
                                $http.post(Project + '/admin/show/asignacion', {
                                    id: $routeParams.idS
                                }).then(r => {
                                    $('#slMaestro').val(r.data.mae.toString());
                                }, err => {
                                    console.log(err)
                                });
                            }
                        });
                    }, err => {
                        console.error(err)
                    })
                $http.get(Project + '/admin/mostrar/especialidad')
                    .then(r => {
                        angular.forEach(r.data, val => {
                            $("#slEspecialidad").append(
                                '<option value="' + val.id + '">' + val.nombre + '</option>'
                            );
                            if ($routeParams.idA) {
                                $http.post(Project + '/admin/show/alumno', {
                                    id: $routeParams.idA
                                }).then(r => {
                                    $('#slEspecialidad').val(r.data.esp.toString());
                                }, err => {
                                    console.log(err);
                                });
                            }
                        });
                    }, err => {
                        console.error(err)
                    })
                $scope.ingresarMateria = function () {
                    try {
                        if ($scope.nameMateria.length > 0) {
                            $http.post(Project + "/admin/ingresar/materia", { nombre: $scope.nameMateria }).then(response => {
                                console.log(response);
                                dsgx.alerta("Exito", "Materia ingresada exitosamente", "success");
                                $scope.nameMateria = "";
                            }, error => {
                                console.log(error);
                            });
                        } else dsgx.alerta("¡Ups!", "No puede dejar vacio este campo", "error");
                    }
                    catch (ex) {
                        $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                    }
                }
                $scope.ingresarAsignacion = function () {
                    try {
                        $http.post(Project + "/admin/ingresar/asignacion", {
                            maestro: $("#slMaestro").val(),
                            seccion: parseInt($("#slSeccion").val()),
                            materia: parseInt($("#slMateria").val())
                        }).then(response => {
                            window.location.href = "#!/d/ver/asignacion";
                            dsgx.alerta("Exito", "Asignacion ingresada exitosamente", "success");
                        }, error => {
                            console.log(error);
                        });
                    }
                    catch (ex) {
                        $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                    }
                }
                $scope.ingresarMaestro = function () {
                    try {
                        if ($scope.paterns.maestro.test($scope.maestroData.id.toString())) {
                            if ($scope.paterns.nombre.test($scope.maestroData.nombre.toString())) {
                                if ($scope.paterns.apellido.test($scope.maestroData.apellido.toString())) {
                                    if ($scope.paterns.user.test($scope.maestroData.user.toString())) {
                                        if ($scope.paterns.contra.test($scope.maestroData.cont.toString())) {
                                            if ($scope.maestroData.cont == $scope.maestroData.concontra) {
                                                $http.post(Project + "/admin/ingresar/maestro", {
                                                    id: $scope.maestroData.id, nombre: $scope.maestroData.nombre
                                                    , apellido: $scope.maestroData.apellido, usuario: $scope.maestroData.user,
                                                    contra: $scope.maestroData.cont, estado: $scope.maestroData.est
                                                }).then(response => {
                                                    console.log(response);
                                                    dsgx.alerta("Exito", "Maestro ingresado exitosamente", "success");
                                                    window.location.href = "#!/d/ver/maestro";
                                                }, error => {
                                                    dsgx.alerta("Error", "Error al intentar ingresar el maestro", "error");
                                                });
                                            } else dsgx.alerta("¡Ups!", "Las contraseñas no coinciden", "error");
                                        } else dsgx.alerta("¡Ups!", "La contraseña debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula", "error");
                                    } else dsgx.alerta("¡Ups!", "Usuario ingresado de forma incorrecta", "error");
                                } else dsgx.alerta("¡Ups!", "Apellido ingresado de forma incorrecta", "error");
                            } else dsgx.alerta("¡Ups!", "Nombre ingresado de forma incorrecta", "error");
                        } else dsgx.alerta("¡Ups!", "Id ingresado de forma incorrecta", "error");
                    }
                    catch (ex) {
                        dsgx.alerta("!Ups!", ex, "error");
                    }
                }
                $scope.ingresarAlumno = function () {
                    try {
                        if ($scope.paterns.alumno.test($scope.alumnoData.id.toString())) {
                            if ($scope.paterns.nombre.test($scope.alumnoData.nombre.toString())) {
                                if ($scope.paterns.apellido.test($scope.alumnoData.apellido.toString())) {
                                    if ($scope.paterns.telefono.test($scope.alumnoData.telefono.toString())) {
                                        if ($scope.paterns.letra.test($scope.alumnoData.dir.toString())) {
                                            if ($scope.paterns.contra.test($scope.alumnoData.contra.toString())) {
                                                if ($scope.alumnoData.contra == $scope.alumnoData.concontra) {
                                                    $http.post(Project + "/admin/ingresar/alumno", {
                                                        id: $scope.alumnoData.id, nombre: $scope.alumnoData.nombre
                                                        , apellido: $scope.alumnoData.apellido, telefono: $scope.alumnoData.telefono,
                                                        contra: $scope.alumnoData.contra, direccion: $scope.alumnoData.dir,
                                                        seccion: parseInt($("#slSeccion").val()), especialidad: parseInt($("#slEspecialidad").val()),
                                                        estado: 1
                                                    }).then(response => {
                                                        console.log(response);
                                                        dsgx.alerta("Exito", "Alumno ingresado exitosamente", "success");
                                                        window.location.href = "#!/d/ver/alumno";
                                                    }, error => {
                                                        dsgx.alerta("Error", "error", "error");
                                                    });
                                                } else dsgx.alerta("¡Ups!", "Las contraseñas no coinciden", "error");
                                            } else dsgx.alerta("¡Ups!", "La contraseña debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula", "error");
                                        } else dsgx.alerta("¡Ups!", "Direccion ingresada de forma incorrecta", "error");
                                    } else dsgx.alerta("¡Ups!", "Telefono ingresado de forma incorrecta", "error");
                                } else dsgx.alerta("¡Ups!", "Apellido ingresado de forma incorrecta", "error");
                            } else dsgx.alerta("¡Ups!", "Nombre ingresado de forma incorrecta", "error");
                        } else dsgx.alerta("¡Ups!", "Id ingresado de forma incorrecta", "error");
                    }
                    catch (ex) {
                        $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                    }
                }
                $scope.userData = {
                    id: "",
                    nombre: ""
                }
                if ($routeParams.idA) {
                    $http.post(Project + '/admin/show/alumno', {
                        id: $routeParams.idA
                    }).then(r => {
                        $scope.alumnoData.id = r.data.id;
                        $scope.alumnoData.nombre = r.data.nombre;
                        $scope.alumnoData.apellido = r.data.apellido;
                        $scope.alumnoData.telefono = r.data.tel;
                        $scope.alumnoData.dir = r.data.dir;
                        //$('#slSeccion').val(r.data.sec.toString());
                        //console.log(r.data.sec);
                        //$('#slEspecialidad').val(r.data.esp.toString());
                        //console.log(r.data.esp);
                    }, err => {
                        console.log(err)
                    });
                }
                if ($routeParams.idA) {
                    $scope.modificarAlumno = function () {
                        try {
                            if ($scope.alumnoData.contra.length > 0) {
                                if ($scope.paterns.alumno.test($scope.alumnoData.id.toString())) {
                                    if ($scope.paterns.nombre.test($scope.alumnoData.nombre.toString())) {
                                        if ($scope.paterns.apellido.test($scope.alumnoData.apellido.toString())) {
                                            if ($scope.paterns.telefono.test($scope.alumnoData.telefono.toString())) {
                                                if ($scope.paterns.letra.test($scope.alumnoData.dir.toString())) {
                                                    if ($scope.alumnoData.contra == $scope.alumnoData.concontra) {
                                                        $http.post(Project + "/admin/modificar/alumnoc", {
                                                            id: $scope.alumnoData.id, nombre: $scope.alumnoData.nombre
                                                            , apellido: $scope.alumnoData.apellido, telefono: $scope.alumnoData.telefono, direccion: $scope.alumnoData.dir,
                                                            seccion: parseInt($("#slSeccion").val()), especialidad: parseInt($("#slEspecialidad").val()),
                                                            estado: $scope.alumnoData.est, contra: $scope.alumnoData.contra
                                                        }).then(response => {
                                                            console.log(response);
                                                            dsgx.alerta("Exito", "Alumno modificado exitosamente", "success");
                                                            window.location.href = "#!/d/ver/alumno";
                                                        }, error => {
                                                            dsgx.alerta("Error", "error", "error");
                                                        });
                                                    } else dsgx.alerta("¡Ups!", "Las contraseñas no coinciden", "error");
                                                } else dsgx.alerta("¡Ups!", "Direccion ingresada de forma incorrecta", "error");
                                            } else dsgx.alerta("¡Ups!", "Usuario ingresado de forma incorrecta", "error");
                                        } else dsgx.alerta("¡Ups!", "Apellido ingresado de forma incorrecta", "error");
                                    } else dsgx.alerta("¡Ups!", "Nombre ingresado de forma incorrecta", "error");
                                } else dsgx.alerta("¡Ups!", "Id ingresado de forma incorrecta", "error");
                            }else{
                                if ($scope.paterns.alumno.test($scope.alumnoData.id.toString())) {
                                    if ($scope.paterns.nombre.test($scope.alumnoData.nombre.toString())) {
                                        if ($scope.paterns.apellido.test($scope.alumnoData.apellido.toString())) {
                                            if ($scope.paterns.telefono.test($scope.alumnoData.telefono.toString())) {
                                                if ($scope.paterns.letra.test($scope.alumnoData.dir.toString())) {
                                                    $http.post(Project + "/admin/modificar/alumno", {
                                                        id: $scope.alumnoData.id, nombre: $scope.alumnoData.nombre
                                                        , apellido: $scope.alumnoData.apellido, telefono: $scope.alumnoData.telefono, direccion: $scope.alumnoData.dir,
                                                        seccion: parseInt($("#slSeccion").val()), especialidad: parseInt($("#slEspecialidad").val()),
                                                        estado: $scope.alumnoData.est
                                                    }).then(response => {
                                                        console.log(response);
                                                        dsgx.alerta("Exito", "Alumno modificado exitosamente", "success");
                                                        window.location.href = "#!/d/ver/alumno";
                                                    }, error => {
                                                        dsgx.alerta("Error", "error", "error");
                                                    });
                                                } else dsgx.alerta("¡Ups!", "Direccion ingresada de forma incorrecta", "error");
                                            } else dsgx.alerta("¡Ups!", "Usuario ingresado de forma incorrecta", "error");
                                        } else dsgx.alerta("¡Ups!", "Apellido ingresado de forma incorrecta", "error");
                                    } else dsgx.alerta("¡Ups!", "Nombre ingresado de forma incorrecta", "error");
                                } else dsgx.alerta("¡Ups!", "Id ingresado de forma incorrecta", "error");
                            }
                        }
                        catch (ex) {
                            $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                        }
                    }
                }
                if ($routeParams.idM) {
                    $http.post(Project + '/admin/show/maestro', {
                        id: $routeParams.idM
                    }).then(r => {

                        $scope.maestroData.id = r.data.id;
                        $scope.maestroData.nombre = r.data.nombre;
                        $scope.maestroData.apellido = r.data.apellido;
                        $scope.maestroData.user = r.data.user;
                    }, err => {
                        console.log(err)
                    });
                    $scope.modificarMaestro = function () {
                        try {
                            if ($scope.maestroData.cont.length > 0) {
                                if ($scope.paterns.maestro.test($scope.maestroData.id.toString())) {
                                    if ($scope.paterns.nombre.test($scope.maestroData.nombre.toString())) {
                                        if ($scope.paterns.apellido.test($scope.maestroData.apellido.toString())) {
                                            if ($scope.paterns.user.test($scope.maestroData.user.toString())) {
                                                if ($scope.paterns.contra.test($scope.maestroData.cont.toString())) {
                                                    if ($scope.maestroData.cont == $scope.maestroData.concontra) {
                                                        $http.post(Project + "/admin/modificar/maestro", {
                                                            id: $scope.maestroData.id, nombre: $scope.maestroData.nombre
                                                            , apellido: $scope.maestroData.apellido, usuario: $scope.maestroData.user,
                                                            contra: $scope.maestroData.cont, estado: $scope.maestroData.est
                                                        }).then(response => {
                                                            console.log(response);
                                                            dsgx.alerta("Exito", "Maestro modificada exitosamente", "success");
                                                            window.location.href = "#!/d/ver/maestro";
                                                        }, error => {
                                                            console.log(error);
                                                        });
                                                    } else dsgx.alerta("¡Ups!", "Las contraseñas no coinciden", "error");
                                                } else dsgx.alerta("¡Ups!", "La contraseña debe tener entre 8 y 16 caracteres, al menos un dígito, al menos una minúscula y al menos una mayúscula", "error");
                                            } else dsgx.alerta("¡Ups!", "Usuario ingresado de forma incorrecta", "error");
                                        } else dsgx.alerta("¡Ups!", "Apellido ingresado de forma incorrecta", "error");
                                    } else dsgx.alerta("¡Ups!", "Nombre ingresado de forma incorrecta", "error");
                                } else dsgx.alerta("¡Ups!", "Id ingresado de forma incorrecta", "error");
                            } else {
                                if ($scope.paterns.maestro.test($scope.maestroData.id.toString())) {
                                    if ($scope.paterns.nombre.test($scope.maestroData.nombre.toString())) {
                                        if ($scope.paterns.apellido.test($scope.maestroData.apellido.toString())) {
                                            if ($scope.paterns.user.test($scope.maestroData.user.toString())) {
                                                $http.post(Project + "/admin/modificar/maestroc", {
                                                    id: $scope.maestroData.id, nombre: $scope.maestroData.nombre
                                                    , apellido: $scope.maestroData.apellido, usuario: $scope.maestroData.user,
                                                    estado: $scope.maestroData.est
                                                }).then(response => {
                                                    console.log(response);
                                                    dsgx.alerta("Exito", "Maestro modificada exitosamente", "success");
                                                    window.location.href = "#!/d/ver/maestro";
                                                }, error => {
                                                    console.log(error);
                                                });
                                            } else dsgx.alerta("¡Ups!", "Usuario ingresado de forma incorrecta", "error");
                                        } else dsgx.alerta("¡Ups!", "Apellido ingresado de forma incorrecta", "error");
                                    } else dsgx.alerta("¡Ups!", "Nombre ingresado de forma incorrecta", "error");
                                } else dsgx.alerta("¡Ups!", "Id ingresado de forma incorrecta", "error");
                            }
                        }
                        catch (ex) {
                            $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                        }
                    }
                }
                if ($routeParams.idS) {
                    $http.post(Project + '/admin/show/asignacion', {
                        id: $routeParams.idS
                    }).then(r => {
                        $scope.asignacionData.id = r.data.id;
                    }, err => {
                        console.log(err)
                    });
                    $scope.modificarAsignacion = function () {
                        try {
                            $http.post(Project + "/admin/modificar/asignacion", {
                                id: $scope.asignacionData.id,
                                maestro: $("#slMaestro").val(),
                                seccion: parseInt($("#slSeccion").val()),
                                materia: parseInt($("#slMateria").val())
                            }).then(response => {
                                window.location.href = "#!/d/ver/asignacion";
                                dsgx.alerta("Exito", "Asignacion modificada exitosamente", "success");
                            }, error => {
                                console.log(error);
                            });
                        }
                        catch (ex) {
                            $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                        }
                    }
                }
                if ($routeParams.id) {
                    $http.post(Project + '/admin/show/materia', {
                        id: $routeParams.id
                    }).then(r => {
                        $scope.userData.id = r.data.id;
                        $scope.userData.nombre = r.data.user;
                    }, err => {
                        console.log(err)
                    });
                    $scope.modificarMateria = function () {
                        try {
                            if ($scope.userData.nombre.length > 0) {
                                $http.post(Project + "/admin/modificar/materia", { id: $scope.userData.id, nombre: $scope.userData.nombre }).then(response => {
                                    console.log(response);
                                    dsgx.alerta("Exito", "Materia modificada exitosamente", "success");
                                    window.location.href = "#!/d/ver/materia";
                                }, error => {
                                    console.log(error);
                                });
                            } else dsgx.alerta("¡Ups!", "No puede dejar vacio este campo", "error");
                        }
                        catch (ex) {
                            $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                        }
                    }
                }
                $scope.eliminarrMateria = function (id) {
                    dsgx.confirmar("¡Un momento!", "¿Estas seguro de queres eliminar este elemento?", ok => {
                        $http.post(Project + "/admin/eliminar/materia", {
                            id: id
                        }).then(response => {
                            dsgx.alerta("Exito", "Materia eliminada exitosamente", "success");
                            $http.post(Project + "/admin/mostrar/materia", {}).then(response => {
                                $scope.materias = response.data;
                            }, error => {
                                console.log(error);
                            });
                        }, error => {
                            console.error(error);
                        });
                    }, cancel => { }, true);
                }
                $scope.eliminarrMaestro = function (id) {
                    dsgx.confirmar("¡Un momento!", "¿Estas seguro de queres eliminar este elemento?", ok => {
                        $http.post(Project + "/admin/eliminar/maestro", {
                            id: id
                        }).then(response => {
                            dsgx.alerta("Exito", "Mestro eliminada exitosamente", "success");
                            $http.post(Project + "/admin/mostrar/maestro", {}).then(response => {
                                $scope.maestro = response.data;
                            }, error => {
                                console.log(error);
                            });
                        }, error => {
                            console.error(error);
                        });
                    }, cancel => { }, true);
                }
                $scope.eliminarAlumno = function (id) {
                    dsgx.confirmar("¡Un momento!", "¿Estas seguro de queres eliminar este elemento?", ok => {
                        $http.post(Project + "/admin/eliminar/alumno", {
                            id: id
                        }).then(response => {
                            dsgx.alerta("Exito", "Mestro eliminada exitosamente", "success");
                            $http.post(Project + "/admin/mostrar/alumno", {}).then(response => {
                                $scope.alumno = response.data;
                            }, error => {
                                console.log(error);
                            });
                        }, error => {
                            console.error(error);
                        });
                    }, cancel => { }, true);
                }
                $scope.eliminarAsignacion = function (id) {
                    dsgx.confirmar("¡Un momento!", "¿Estas seguro de queres eliminar este elemento?", ok => {
                        $http.post(Project + "/admin/eliminar/asignacion", {
                            id: id
                        }).then(response => {
                            dsgx.alerta("Exito", "Mestro eliminada exitosamente", "success");
                            $http.post(Project + "/admin/mostrar/asignacion", {}).then(response => {
                                $scope.asignacion = response.data;
                            }, error => {
                                console.log(error);
                            });
                        }, error => {
                            console.error(error);
                        });
                    }, cancel => { }, true);
                }
                $scope.materias = [];
                try {
                    $http.post(Project + "/admin/mostrar/materia", {}).then(response => {
                        $scope.materias = response.data;
                    }, error => {
                        console.log(error);
                    });
                }
                catch (ex) {
                    $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                }
                $scope.maestro = [];
                try {
                    $http.post(Project + "/admin/mostrar/maestro", {}).then(response => {
                        $scope.maestro = response.data;
                    }, error => {
                        console.log(error);
                    });
                }
                catch (ex) {
                    $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                }
                $scope.bus = "";
                $scope.banderaa = true;
                $scope.buscarAlumno = function () {
                    if ($scope.bus.length == 0) {
                        $http.post(Project + "/admin/mostrar/alumno", {}).then(response => {
                            $scope.alumno = response.data;
                        }, error => {
                            console.log(error);
                        });
                    }
                    else {
                        $http.post(Project + "/admin/mostrar/alumnob", {
                            bus: $scope.bus
                        }).then(response => {
                            $scope.alumno = response.data;
                            if ($scope.alumno.length <= 0) {
                                $scope.banderaa = false;
                            }else{
                                $scope.banderaa = true;
                            }
                        }, error => {
                            console.log(error);
                        });
                    }
                }
                $scope.alumno = [];
                try {
                    $http.post(Project + "/admin/mostrar/alumno", {}).then(response => {
                        $scope.alumno = response.data;
                        console.log(response.data);
                    }, error => {
                        console.log(error);
                    });
                }
                catch (ex) {
                    $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                }
                $scope.asignacion = [];
                try {
                    $http.post(Project + "/admin/mostrar/asignacion", {}).then(response => {
                        $scope.asignacion = response.data;
                        console.log(response.data);
                    }, error => {
                        console.log(error);
                    });
                }
                catch (ex) {
                    $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                }
            } else window.location.href = "#!/" + response.data.type + "/home";
        }, error => {
            dsgx.alerta("¡Ups!", error.data.msg, "error");
        });
});