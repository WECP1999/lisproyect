
<?php
	Route::get('/', function()
	{
		return View::make('home');
	});
	Route::get('/login', function(){
		return View::make('login');
	});
	Route::get('dIngMateria', function(){
		return View::make('dIngMateria');
	});
	Route::get('dVerMateria', function(){
		return View::make('dVerMateria');
	});
	Route::get('dModificarMateria', function(){
		return View::make('dModificarMateria');
	});
	Route::get('dIngMaestro', function(){
		return View::make('dIngMaestro');
	});
	Route::get('dVerMaestro', function(){
		return View::make('dVerMaestro');
	});
	Route::get('dModificarMaestro', function(){
		return View::make('dModificarMaestro');
	});
	Route::get('dIngAlumno', function(){
		return View::make('dIngAlumno');
	});
	Route::get('dVerAlumno', function(){
		return View::make('dVerAlumno');
	});
	Route::get('dModificarAlumno', function(){
		return View::make('dModificarAlumno');
	});
	Route::get('dHome', function(){
		return View::make('dHome');
	});
	Route::get('mIngActividad', function(){
		return View::make('mIngActividad');
	});
	Route::get('mIngNotas', function(){
		return View::make('mIngNotas');
	});
	Route::get('dIngAsignacion', function(){
		return View::make('dIngAsignacion');
	});
	Route::get('dVerAsignacion', function(){
		return View::make('dVerAsignacion');
	});
	Route::get('dModificarAsignacion', function(){
		return View::make('dModificarAsignacion');
	});
	Route::get('mHome', function(){
		return View::make('mHome');
	});
	Route::post('/admin/ingresar/materia', 'AdminController@ingresarMateria');
	Route::post('/admin/ingresar/maestro', 'AdminController@ingresarMaestro');
	Route::post('/admin/ingresar/alumno', 'AdminController@ingresarAlumno');
	Route::post('/admin/ingresar/asignacion', 'AdminController@ingresarAsignacion');
	Route::post('/admin/modificar/materia', 'AdminController@modificarMateria');
	Route::post('/admin/modificar/maestro', 'AdminController@modificarMaestro');
	Route::post('/admin/modificar/maestroc', 'AdminController@modificarMaestroCon');
	Route::post('/admin/modificar/alumno', 'AdminController@modificarAlumno');
	Route::post('/admin/modificar/alumnoc', 'AdminController@modificarAlumnoC');
	Route::post('/admin/modificar/asignacion', 'AdminController@modificarAsignacion');
	Route::post('/admin/mostrar/materia', 'AdminController@mostrarMateria');
	Route::post('/admin/mostrar/maestro', 'AdminController@mostrarMaestro');
	Route::post('/admin/mostrar/alumno', 'AdminController@mostrarAlumno');
	Route::post('/admin/mostrar/alumnob', 'AdminController@mostrarAlumnoBus');
	Route::post('/admin/mostrar/asignacion', 'AdminController@mostrarAsingnacion');
	Route::post('/admin/show/materia', 'AdminController@showMateria');
	Route::post('/admin/show/maestro', 'AdminController@showMaestro');
	Route::post('/admin/show/alumno', 'AdminController@showAlumno');
	Route::post('/admin/show/asignacion', 'AdminController@showAsignacion');
	Route::post('/admin/eliminar/materia', 'AdminController@eliminarMateria');
	Route::post('/admin/eliminar/maestro', 'AdminController@eliminarMaestro');
	Route::post('/admin/eliminar/alumno', 'AdminController@eliminarAlumno');
	Route::post('/admin/eliminar/asignacion', 'AdminController@eliminarAsignacion');
	Route::post('/auth/log/in', 'AuthController@LogIn');
	Route::get('/auth/log/info', 'AuthController@LogInfo');
	Route::post('/auth/log/out', 'AuthController@LogOut');
	Route::post('/master/ingresar/activity', 'TeacherController@newActivity');

	Route::post('/master/mostrar/evaluacionBy', 'TeacherController@getActividades');
	Route::post('/master/eliminar/evaluacionBy', 'TeacherController@deleteActivity');
	Route::post('/master/mostrar/asignacion', 'TeacherController@getAsignaciones');
	Route::post('/master/mostrar/evaluacion', 'TeacherController@getEvaluaciones');
	Route::post('/master/mostrar/alumnosBy', 'TeacherController@getAlumnosBy');
	Route::post('/master/ingresar/nota', 'TeacherController@newNota');
	Route::post('/master/mostrar/notaBy', 'TeacherController@getNotas');

    Route::get('/admin/mostrar/seccion', 'AdminController@llenarSec');
	Route::get('/admin/mostrar/especialidad', 'AdminController@llenarEspec');
	Route::get('/admin/mostrar/material', 'AdminController@llenarMateria');
	Route::get('/admin/mostrar/maestrol', 'AdminController@llenarMaestro');
	/*alumnos*/
	Route::get('aHome', function(){
		return View::make('aHome');
	});
	Route::post('/alumno/mostrar/nota', 'AlumnoController@mostrarNotas');
?>
