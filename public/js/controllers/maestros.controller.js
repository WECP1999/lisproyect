/**
 * @name MasterController
 * @description Controlador de maestros
 * @augments $scope,$http,dsgx
 */
import { Project, Devices } from "../app.config.js";
export default angular.module("c.master", []).controller(Devices.MASTER, function($scope, $http, dsgx){
    $scope.show = false;
    $scope.info = {};
    $http.get(Project + '/auth/log/info')
    .then(s => {
        if(s.data.type === "m"){
            $scope.show = true;
            $scope.info = s.data;
            $scope.log = "Maestros";
            $scope.log = $scope.info.user;
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
            $scope.eliminarActividad = function(id){
                dsgx.confirmar("¡Un momento!", "¿Seguro que deseas eliminar esta actividad?", () => {
                    $http.post(Project + '/master/eliminar/evaluacionBy', {
                        id: id
                    }).then(s => {
                        if(s.data.msg) dsgx.alerta("¡Bien!", s.data.msg, "success");
                        else dsgx.alerta("¡Bien!", "Objeto eliminado con éxito.", "success");
                        $http.post(Project + '/master/mostrar/evaluacionBy', {
                            id: $scope.info.user
                        })
                        .then(s => {
                            $scope.myAct = s.data;
                        }, err => {
                            dsgx.alerta("¡Mal!", "Error al obtener el recurso -evalBy-", "error");
                        });
                    }, err => {
                        if(err.data.msg) dsgx.alerta("¡Mal!", err.data.msg, "error");
                        else dsgx.alerta("¡Mal!", "Recurso no procesado.", "error");
                    });
                });
            }
            $scope.myAct = [];
            $http.post(Project + '/master/mostrar/evaluacionBy', {
                id: $scope.info.user
            })
            .then(s => {
                $scope.myAct = s.data;
            }, err => {
                dsgx.alerta("¡Mal!", "Error al obtener el recurso -evalBy-", "error");
            });
            $scope.activity = {
                nombre: "",
                descripcion: "",
                porcentaje: 1,
                periodo: "1",
                asignacion: null
            };
            $http.post(Project + '/master/mostrar/asignacion',{
                id: $scope.info.user
            })
            .then(s => {
                angular.forEach(s.data, (e, k) => {
                    $("#cmAsignacion").append(
                        '<option value="' + e.id + '">' + 
                        e.nombre + ': ' + e.year.toString() + e.seccion + '</option>'
                    );
                });
            }, err => {
                if(err.data) dsgx.alerta("¡Ups!", err.data, "error");
                else dsgx.alerta("¡Ups!", "Ocurrió un error al obtener el recurso.", "error");
            });
            $scope.agregarActividad = function(){
                if($("#cmAsignacion").val() > "0"){
                    if($scope.activity.porcentaje >= 1 && $scope.activity.porcentaje <= 100){
                        $scope.activity.asignacion = $("#cmAsignacion").val();
                        let n = $scope.activity.nombre.toString();
                        let d = $scope.activity.descripcion.toString();
                        if(n !== undefined && n.length > 0){
                            n = n.trim();
                            if(n.length > 0){
                                if(d !== undefined && d.length > 0){
                                    d = d.trim();
                                    if(d.length > 0){
                                        $http.post(Project + '/master/ingresar/activity', $scope.activity)
                                        .then(s => {
                                            if(s.data.msg) dsgx.alerta("¡Bien!", s.data.msg, "success");
                                            else dsgx.alerta("¡Bien!", "Operación realizada con éxito.", "success");
                                            $scope.activity.nombre = "";
                                            $scope.activity.descripcion = "";
                                            $scope.activity.porcentaje = 100 - s.data.v;
                                        }, err => {
                                            if(err.data.msg) dsgx.alerta("¡Ups!", err.data.msg, "error");
                                            else dsgx.alerta("¡Ups!", "Ocurrió un error al guardar la actividad.", "error");
                                        });
                                    } else dsgx.alerta("¡Alto!", "Descripción inválido.", "warning");
                                } else dsgx.alerta("¡Alto!", "Descripción inválido.", "warning");
                            } else dsgx.alerta("¡Alto!", "Nombre inválido.", "warning");
                        } else dsgx.alerta("¡Alto!", "Nombre inválido.", "warning");
                    } else dsgx.alerta("¡Alto!", "Porcentaje incorrecto", "warning");
                } else dsgx.alerta("¡Alto!", "Asignación incorrecta.", "warning");
            };
            $scope.generarArrayNota = function(arr){
                let nArr = [];
                angular.forEach(arr, (e, k) => {
                    nArr.push({
                        id: e.id,
                        nota: 0
                    });
                });
                return nArr;
            }
            $scope.idAsig = null;
            $scope.alumnos = [];
            $scope.notas = [];
            $scope.guardados = [];
            $http.post(Project + '/master/mostrar/evaluacion',{
                id: $scope.info.user
            })
            .then(s => {
                angular.forEach(s.data, (e, k) => {
                    if(!k) $scope.idAsig = e.id;
                    $("#cmActividades").append(
                        '<option value="' + e.id + '">' + 
                        e.evname + ': ' + e.year.toString() + e.seccion + ' - ' + e.materia + '</option>'
                    );
                });
                if($scope.idAsig !== null){
                    $scope.AlumnoService($scope.idAsig);
                    $scope.NotaService();
                }
            }, err => {
                if(err.data.msg) dsgx.alerta("¡Ups!", err.data.error, "error");
                else dsgx.alerta("¡Ups!", "Ocurrió un error al obtener el recurso.", "error");
            });
            $scope.NotaService = function(){
                $http.post(Project + '/master/mostrar/notaBy', {
                    actividad: $scope.idAsig
                })
                .then(s => {
                    $scope.guardados = s.data;
                }, err => {
                    if(err.data.msg) dsgx.alerta("¡Ups!", err.data.msg, "error");
                    else dsgx.alerta("¡Ups!", "Ocurrió un error al obtener el recurso -notaBy-", "error");
                });
            }
            $scope.AlumnoService = function(id){
                $http.post(Project + '/master/mostrar/alumnosBy', {
                    id: id
                })
                .then(s => {
                    $scope.alumnos = s.data;
                    $scope.notas = $scope.generarArrayNota($scope.alumnos);
                }, err => {
                    if(err.data.msg) dsgx.alerta("¡Ups!", err.data.error, "error");
                    else dsgx.alerta("¡Ups!", "Ocurrió un error al obtener el recurso.", "error");
                });
            }
            $("#cmActividades").on('change', e => {
                $scope.idAsig = $(e.target).val();
                $scope.AlumnoService($scope.idAsig);
                $scope.NotaService();
            });
            $scope.aval = false;
            $scope.isEnabled = function(id){
                let enabled = true;
                angular.forEach($scope.guardados, (e, k) => {
                    if(e.id_alumno.indexOf(id) !== -1) enabled = false;
                });
                $scope.aval = !enabled;
                return enabled;
            }
            $scope.guardarNota = () => {
                if($scope.alumnos.length > 0){
                    dsgx.confirmar("¡Espera un momento!", "¿Estás seguro de que quiere guardar estas notas? Después no podrás hacer modificaciones sobre ellas.", 
                    s => {
                        let n1 = Math.round(Math.random() * 10);
                        let n2 = Math.round(Math.random() * 10);
                        let x = prompt("La suma de " + n1 + ' y ' + n2 + ' es...');
                        if(parseInt(n1 + n2) == x){
                            $http.post(Project + '/master/ingresar/nota', {
                                alumnos: $scope.alumnos,
                                notas: $scope.notas,
                                actividad: $("#cmActividades").val()
                            })
                            .then(s => {
                                if(s.data.msg) dsgx.alerta("¡Bien!", s.data.msg, "success");
                                else dsgx.alerta("¡Bien!", "Proceso realizado con éxito.", "success");
                                $scope.NotaService();
                            }, err => {
                                if(err.data.msg) dsgx.alerta("¡Ups!", err.data.msg, "error");
                                else dsgx.alerta("¡Ups!", "Ocurrió un error al insertar las notas.", "error");
                            });
                        } else dsgx.alerta("¡Cuidado!", "Notas no procesadas.", "info");
                    }, e => {}, true);
                } else dsgx.alerta("¡Nope!", "No hay alumnos a los cuales ingresar nota.", "info");
            }
        } else window.location.href = "#!/login";
    }, err => {
        dsgx.alerta("¡Ups!", "Ocurrió un error al generar el servicio de inicio de sesión.", "error");
    });
});