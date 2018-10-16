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
          <li>
            <a class="cur-def" href="#!/m/ingresar/actividad"><i class="fa fa-plus"></i>&ensp; Nueva actividad</a>
          </li>
          <li class="active">
            <a class="cur-def" href="#!/m/ingresar/notas"><i class="fa fa-plus"></i>&ensp; Agregar notas <span class="sr-only">(current)</span></a>
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
        <h3><i class="fa fa-file"></i>&ensp; Notas</h3>
      </div>
      <div class="panel-body">
        <div class="form-group">
          <label for="cmActividades">Actividades</label>
          <select id="cmActividades" class="form-control"></select>
        </div>
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Alumno</th>
              <th>Especialidad</th>
              <th>Nota</th>
            </tr>
          </thead>
          <tbody>
            <tr ng-repeat="alumno in alumnos">
              <td><out val="alumno.nombre"/> <out val="alumno.apellido"/></td>
              <td><out val="alumno.especialidad"/></td>
              <td>
                <label ng-show="!isEnabled(alumno.id)">
                  <code style="color: steelblue;">Nota ingresada</code>
                </label>
                <input 
                  ng-show="isEnabled(alumno.id)" 
                  class="form-control" 
                  into="value" 
                  val="notas[$index].nota" 
                  ng-model="notas[$index].nota" 
                  type="number"/>
                <input 
                  type="hidden" 
                  ng-model="aval">
              </td>
            </tr>
          </tbody>
        </table>
        <button 
          ng-disabled="aval" 
          class="btn btn-warning" 
          ng-click="guardarNota()">
            <i class="fa fa-save"></i>&ensp; Guardar notas
        </button>
      </div>
    </div>
  </div>
</div>
@stop