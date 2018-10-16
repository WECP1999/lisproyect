/**
 * @name Routes
 * @description Configuración del route con el route de laravel
 * @augments $routeProvider
 */
import { Project, Devices, Views } from './app.config.js';
export default angular.module('routes', ['ngRoute']).config($routeProvider => {
    $routeProvider
    .when('/login', {
        templateUrl: Project + Views.LOGIN,
        controller: Devices.LOGIN
    })
    .when('/d/home', {
        templateUrl: Project + Views.ADMIN.HOME,
        controller: Devices.ADMIN
    })
    .when('/d/ingresar/materia', {
        templateUrl: Project + Views.ADMIN.INSERT.MATERIA,
        controller: Devices.ADMIN
    })
    .when('/d/ver/materia', {
        templateUrl: Project + Views.ADMIN.SELECT.MATERIA,
        controller: Devices.ADMIN
    })
    .when('/d/modificar/materia/:id', {
        templateUrl: Project + Views.ADMIN.UPDATE.MATERIA,
        controller: Devices.ADMIN
    })
    .when('/d/ingresar/maestro', {
        templateUrl: Project + Views.ADMIN.INSERT.MAESTRO,
        controller: Devices.ADMIN
    })
    .when('/d/ver/maestro', {
        templateUrl: Project + Views.ADMIN.SELECT.MAESTRO,
        controller: Devices.ADMIN
    })
    .when('/d/modificar/maestro/:idM', {
        templateUrl: Project + Views.ADMIN.UPDATE.MAESTRO,
        controller: Devices.ADMIN
    })
    .when('/d/ingresar/alumno', {
        templateUrl: Project + Views.ADMIN.INSERT.ALUMNO,
        controller: Devices.ADMIN
    })
    .when('/d/ver/alumno', {
        templateUrl: Project + Views.ADMIN.SELECT.ALUMNO,
        controller: Devices.ADMIN
    })
    .when('/d/modificar/alumno/:idA', {
        templateUrl: Project + Views.ADMIN.UPDATE.ALUMNO,
        controller: Devices.ADMIN
    })
    .when('/m/home', {
        templateUrl: Project + Views.MASTER.HOME,
        controller: Devices.MASTER
    })
    .when('/m/ingresar/actividad', {
        templateUrl: Project + Views.MASTER.INSERT.ACTIVIDAD,
        controller: Devices.MASTER
    })
    .when('/m/ingresar/notas', {
        templateUrl: Project + Views.MASTER.INSERT.NOTAS,
        controller: Devices.MASTER
    })
    .when('/d/ingresar/asignacion', {
        templateUrl: Project + Views.ADMIN.INSERT.ASIGNACION,
        controller: Devices.ADMIN
    })
    .when('/d/ver/asignacion', {
        templateUrl: Project + Views.ADMIN.SELECT.ASIGNACION,
        controller: Devices.ADMIN
    })
    .when('/d/modificar/asignacion/:idS', {
        templateUrl: Project + Views.ADMIN.UPDATE.ASIGNACION,
        controller: Devices.ADMIN
    })
    .when('/a/home', {
        templateUrl: Project + Views.ALUMNO.HOME,
        controller: Devices.ALUMNO
    })
    .otherwise({
        redirectTo: '/'
    });
});