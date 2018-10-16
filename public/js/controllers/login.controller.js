/**
 * @name LoginController
 * @description Controlador de inicio de sesión
 * @augments $scope,$http,dsgx
 */
import { Project, Devices } from "../app.config.js";
export default angular.module('c.login', []).controller(Devices.LOGIN, function($scope, $http, dsgx){
    $scope.show = false;
    $scope.errors = [];
    $scope.user = {
        username: '',
        password: ''
    };
    $scope.getErrors = () => {
        return $scope.errors.length > 0;
    };
    $http.get(Project + '/auth/log/info').then(response => {
        if(response.data.state === true)
            window.location.href = "#!/" + response.data.type + "/home";
        else{
            $scope.show = true;
            $scope.login = () => {
                $scope.errors = [];
                let count = 0;
                let usr = $scope.user.username.toString();
                let psw = $scope.user.password.toString();
                if(usr.length > 0) count++;
                else $scope.errors.push("Se necesita un usuario.");
                if(psw.length > 0) count++;
                else $scope.errors.push("Se necesita una contraseña.");
                if(count == 2){
                    try{
                        usr = usr.trim();
                        if(usr.length > 0){
                            let prefix = usr.toLowerCase()[0];
                            switch(prefix){
                                case 'a': case 'd': case 'm':{
                                    $http.post(Project + '/auth/log/in', {
                                        user: $scope.user.username,
                                        pass: $scope.user.password
                                    }).then(response => {
                                        if(response.data.state === "success")
                                            window.location.href = "#!/" + prefix + "/home";
                                        else if(response.data.state === "error") 
                                            dsgx.alerta("¡Ups!", response.data.msg, "error");
                                    }, error => {
                                        console.error(error);
                                        dsgx.alerta("¡Ups!", error.data.msg, "error");
                                    });
                                    break;
                                }
                                default:
                                    $scope.errors.push("El prefijo de usuario no es correcto.");
                                    break;
                            }
                        } else $scope.errors.push("Se necesita un usuario.");
                    }catch(ex){
                        $scope.errors.push("Error al intentar rescatar los datos del formulario.");
                    }
                }
            };
        }
    }, error => {
        dsgx.alerta("¡Ups!", error.data.msg, "error");
    });
});