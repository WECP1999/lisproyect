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
        <li class="dropdown">
          <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Materia<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a style="cursor: pointer;" href="#!/d/ingresar/materia" >Ingresar</a></li>
            <li><a href="#!/d/ver/materia">Ver</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Maestro<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a style="cursor: pointer;" href="#!/d/ingresar/maestro" >Ingresar</a></li>
            <li><a href="#!/d/ver/maestro">Ver</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Alumnos<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a style="cursor: pointer;" href="#!/d/ingresar/alumno" >Ingresar</a></li>
            <li><a href="#!/d/ver/alumno">Ver</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a class="dropdown-toggle" style="cursor: pointer;" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Asignacion<span class="caret"></span></a>
          <ul class="dropdown-menu">
            <li><a style="cursor: pointer;" href="#!/d/ingresar/asignacion" >Ingresar</a></li>
            <li><a href="#!/d/ver/asignacion">Ver</a></li>
          </ul>
        </li>
        <li><a class="text-danger cur-def" ng-click="logout()"><i class="fa fa-sign-out"></i> Cerrar sesión</a></li>
      </ul>
  </div><!-- /.navbar-collapse -->
</div><!-- /.container-fluid -->
</nav>

<div class="container">
    <div class="row">
        <div class="col-md-12">
        <div class="form-group">
            <label for="txtUsuario">Buscador</label>
            <input type="text" id="txtId" ng-model="bus" class="form-control" ng-keyup="buscarAlumno()"/>  
        </div>
      </div>
      <table class="table table-striped table-bordered" style="background-color: white;">
        <thead>
          <tr>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Apellido</th>
            <th scope="col">Telefono</th> 
            <th scope="col">Seccion</th>
            <th scope="col">Especialidad</th>            
            <th scope="col"></th>                                                  
          </tr>
        </thead>
        <tbody ng-show="banderaa == false">
          <tr>
            <td colspan="8">
              No hay datos 
            </td>
          </tr>
        </tbody>

        </tbody>
        <tbody class="mostrar" ng-show="alumno != null">
          <tr ng-repeat="m in alumno">
            <td>
              <out val="m.id"/>
            </td>
            <td>
                <out val="m.nom"/>
            </td>
            <td>
                <out val="m.apellido"/>
            </td>
            <td>
                <out val="m.telefono"/>
            </td>
            <td>
              <out val="m.year"/> <out val="m.seccion"/>
            </td>
            <td>
              <out val="m.nombre"/>
            </td>
            <td>
                <a class="btn btn-success" into="href" val="m.id" cat="#!/d/modificar/alumno/%s">MODIFICAR</a>
                <button class="btn btn-error" ng-click="eliminarAlumno(m.id)">ELIMINAR</button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
@stop
