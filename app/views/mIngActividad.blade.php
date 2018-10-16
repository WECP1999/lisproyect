@extends('master')
@section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <div class="navbar-header">
        <a class="navbar-brand" href="#"><out val="log"/></a>
      </div>
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li><a style="cursor: pointer;" href="#!/m/home"><i class="fa fa-home"></i>&ensp; Inicio</a></li>
          <li class="active">
            <a class="cur-def" href="#!/m/ingresar/actividad"><i class="fa fa-plus"></i>&ensp; Nueva actividad <span class="sr-only">(current)</span></a>
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
    <div class="panel panel-default">
      <div class="panel-heading">
        <h3><i class="fa fa-clipboard"></i>&ensp; Nueva actividad</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="txtNombre">Nombre de la actividad</label>
          <input type="text" id="txtNombre" ng-model="activity.nombre" class="form-control">
        </div>
        <div class="form-group">
            <label for="txtDescripcion">Descripción de la actividad</label>
            <textarea id="txtDescripcion" ng-model="activity.descripcion" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="txtPorcentaje">Porcentaje</label>
            <input type="number" id="txtPorcentaje" ng-model="activity.porcentaje" class="form-control">
        </div>
        <div class="form-group">
            <label for="cmPeriodo">Periodo</label>
            <select id="cmPeriodo" ng-model="activity.periodo" class="form-control">
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
            </select>
        </div>
        <div class="form-group">
            <label for="cmAsignacion">Asignar a...</label>
            <select id="cmAsignacion" class="form-control">
              <option value="0" selected disabled>SELECCIONAR</option>
            </select>
        </div>
        <button class="btn btn-info" ng-click="agregarActividad()"><i class="fa fa-plus"></i>&ensp; Agregar actividad</button>
      </div>
    </div>
  </div>
</div>
@stop