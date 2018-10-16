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
<div class="row">
    <div class="col-md-4"><!--Empty--></div>
    <div class="col-md-4">
        <div class="panel">
            <div class="panel-heading">
                <h3>Ingresar alumno</h3>
            </div>
            <div class="panel-body">
                <div class="form-group">
                    <label for="txtUsuario">Ingresar id</label>
                    <input type="text" id="txtId" ng-model="alumnoData.id" placeholder="Ejemplo: A####" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar nombre</label>
                    <input type="text" id="txtName" ng-model="alumnoData.nombre" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar apellido</label>
                    <input type="text" id="txtLastName" ng-model="alumnoData.apellido" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar el telefono</label>
                    <input type="text" id="txtTel" ng-model="alumnoData.telefono" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar direccion</label>
                    <input type="text" id="txtDireccion" ng-model="alumnoData.dir" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar contraseña</label>
                    <input type="password" id="txtContra" ng-model="alumnoData.contra" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Confirmar contraseña</label>
                    <input type="password" id="txtConContra" ng-model="alumnoData.concontra" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar especialidad</label>
                    <select id="slEspecialidad" required class="form-control">                    
                    </select>
                </div>
                <div class="form-group">
                    <label for="txtUsuario">Ingresar seccion</label>
                    <select id="slSeccion" required class="form-control">
                    </select>
                </div>
                <div class="col-md-8"></div>
                <div class="d-flex align-content-xl-end flex-wrap">
                    <button class="btn btn-info" ng-click="ingresarAlumno()">INGRESAR</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4"><!--Empty--></div>
</div>
@stop
