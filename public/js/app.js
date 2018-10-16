/**
 * @author AulaDigital
 * @description Código general del sitio.
 *              El nombre de las vistas tiene que ser el mismo que el 
 *              de los controladores de angular.
 */
import Route from './app.routes.js';
import LoginController from './controllers/login.controller.js';
import AdminController from './controllers/admin.controller.js';
import MaestroController from './controllers/maestros.controller.js';
import AlumnoController from './controllers/alumno.controller.js';
var app = angular.module('audigital', [
    Route.name,
    LoginController.name,
    AdminController.name,
    MaestroController.name,
    AlumnoController.name
]);
/**
 * @name DsgxService
 * @description Sección de servicios variados
 */
app.factory('dsgx', function(){
    return {
        simple: function(mensaje){
            swal({
                text: mensaje
            });
        },
        alerta: function(titulo, mensaje, tipo){
            tipo = tipo || undefined;
            if(!tipo) swal(titulo, mensaje);
            else swal(titulo, mensaje, tipo);
        },
        confirmar: function(titulo, mensaje, fs, fe, darn){
            darn = darn || undefined;
            if(!darn) darn = false;
            swal({
                title: titulo,
                text: mensaje,
                icon: "warning",
                buttons: {
                    cancel: {
                        text: "Cancelar",
                        value: false,
                        visible: true
                    }, 
                    confirm: {
                        text: "OK",
                        value: true,
                        visible: true
                    }
                },
                dangerMode: darn
            }).then((d) => {
                if(d) fs();
                else{
                    try{
                        fe();
                    }catch(ex){}
                }
            });
        }
    };
});
/**
 * @name OutDirective
 * @description Two-Way por medio de etiquetas HTML <out val="variableAngular"/>
 * @augments -
 */
app.directive('out', function(){
    return {
        restrict: 'E',
        scope: {
            val: '='
        },
        template: '{{val}}'
    };
});
/**
 * @name IntoDirective
 * @description Cuando se necesita pasar un valor del $scope a una etiqueta html común
 * @augments -
 */
app.directive('into', function(){
    return {
        restrict: 'A',
        scope: {
            val: '=',
            cat: '@'
        },
        link: function(scope, element, attrs){
            if(scope.cat){
                let s = scope.cat.search("%s");
                if(s !== -1){
                    s = scope.cat;
                    s = s.replace("%s", scope.val);
                    element.attr(attrs.into, s);
                } else element.attr(attrs.into, scope.val);
            } else element.attr(attrs.into, scope.val);
        }
    };
})