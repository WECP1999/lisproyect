import {Project, Devices} from "../app.config.js";
export default angular.module('c.alumno', []).controller(Devices.ALUMNO, function ($scope, $http, dsgx, $routeParams) {

    $scope.show = false;
    $scope.log = "Alumno";
    $http.get(Project + '/auth/log/info')
    .then(response => {
        if (response.data.state === false)
            window.location.href = "#!/login";
        else if (response.data.type === 'a') {
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
            
            $scope.notas = [];
            $scope.info = response.data;
            console.log($scope.info.user);
             try {
            
            $http.post(Project + "/alumno/mostrar/nota", {
                  id: $scope.info.user
            }).then(response => {
                        $scope.notas = response.data;
                        console.log(response.data);
                    }, error => {
                        console.log(error);
                    });
             }
                catch (ex) {
                    console.log(ex);
            }
        }
    });
});