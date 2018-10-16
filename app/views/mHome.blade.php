@extends('master')
@section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><out val="log"/></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a style="cursor: pointer;" href="#!/m/home"><i class="fa fa-home"></i>&ensp; Inicio <span class="sr-only">(current)</span></a></li>
          <li>
            <a class="cur-def" href="#!/m/ingresar/actividad"><i class="fa fa-plus"></i>&ensp; Nueva actividad</a>
          </li>
          <li>
            <a class="cur-def" href="#!/m/ingresar/notas"><i class="fa fa-plus"></i>&ensp; Agregar notas</a>
          </li>
          <li><a class="cur-def" ng-click="logout()"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
        </ul>
      </div>
    </div>
</nav>
<div class="container">
  <div class="row">
      <div class="alert alert-info">
          <b>¡Bienvenido!</b>
          <p>¡Hola maestro! bienvenido a tu espacio en donde podrás manipular sobre tus procesos educativos de 
            una forma más fácil.
          </p>
      </div>
      <div class="thumbnail" ng-repeat="acts in myAct">
          <div class="caption">
            <h4><out val="acts.nombre"/> <small><out val="acts.porcentaje"/>%, periodo <out val="acts.periodo"/></small></h4>
            <p><out val="acts.descripcion"/></p>
            <p>
              <button ng-click="eliminarActividad(acts.id)" class="btn btn-danger" role="button"><i class="fa fa-trash"></i>&ensp; Eliminar actividad</button>
            </p>
      </div>
  </div>
</div>
@stop