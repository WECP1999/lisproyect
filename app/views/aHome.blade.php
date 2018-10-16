@extends('master')
@section('content')
<nav class="navbar navbar-default">
    <div class="container-fluid">
      <!-- Brand and toggle get grouped for better mobile display -->
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
          <span class="sr-only">Menu de usuario</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="#"><out val="log"/></a>
      </div>
  
      <!-- Collect the nav links, forms, and other content for toggling -->
      <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
          <li class="active"><a style="cursor: pointer;" href="#!/d/home">Inicio <span class="sr-only">(current)</span></a></li>
          <li><a class="text-danger cur-def" ng-click="logout()"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
        </ul>
    </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>
<div class="container">
    <div class="row">
      <table class="table table-striped table-bordered" style="background-color: white;">
        <thead>
          <tr>
            <th scope="col">Nota</th>
            <th scope="col">Porcentaje</th>
            <th scope="col">Evaluacion</th>
            <th scope="col">Materia</th>
            <th scope="col">Periodo</th> 
            <th scope="col">Alumno</th>                                                    
          </tr>
        </thead>
        <tbody class="mostrar">
           <tr ng-repeat="m in notas">            
            <td>
              <out val="m.nota"/>
            </td>
            <td>
                <out val="m.porcentaje"/>
            </td>
            <td>
                <out val="m.evaluacion"/>
            </td>
            <td>
                <out val="m.materias"/>
            </td>
            <td>
                <out val="m.periodo"/>
            </td>
            <td>
                <out val="m.alumno"/> <out val="m.apellido"/>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
</div>
@stop
