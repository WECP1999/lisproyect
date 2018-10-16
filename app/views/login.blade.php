@extends('master')

@section('content')
    <div class="row">
        <div class="col-md-4"><!--Empty--></div>
        <div class="col-md-4">
            <br><br>
            <div class="panel">
                <div class="panel-heading">
                    <h3>Iniciar sesión</h3>
                    <hr>
                </div>
                <div class="panel-body">
                    <div class="alert alert-danger" ng-if="getErrors()">
                        <li ng-repeat="error in errors">
                            <out val="error"/>
                        </li>
                    </div>
                    <div class="form-group">
                        <label for="txtUsuario">Usuario</label>
                        <input type="text" id="txtUsuario" ng-model="user.username" class="form-control">
                    </div>
                    <br>
                    <div class="form-group">
                            <label for="txtPass">Contraseña</label>
                            <input type="password" id="txtPass" ng-model="user.password" class="form-control">
                    </div>
                    <br><br>
                    <div class="col-md-8"></div>
                    <div class="d-flex align-content-xl-end flex-wrap">
                        <button class="btn btn-info" ng-click="login()">Iniciar sesión</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4"><!--Empty--></div>
    </div>
@stop