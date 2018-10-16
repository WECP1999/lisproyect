<?php
    class AdminController extends BaseController{
        public function ingresarMateria(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            $materia = $app->nombre;

            $nuevo = new Materia();

            $nuevo->nombre = $materia;

            $nuevo->save();

            return Response::json(array('msg' => 'Materia ingresada'), 200);
        }
        public function ingresarMaestro(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            $id = $app->id;
            $nombre = $app->nombre;
            $ape = $app->apellido;
            $us = $app->usuario;
            $con = $app->contra;
            $sta = $app ->estado;

            $nuevo = new Maestros();
            $nuevo->id = $id;
            $nuevo->nombre = $nombre;
            $nuevo->apellido = $ape;
            $nuevo->usuario = $us;
            $nuevo->contra = $con;                                    
            $nuevo->estado = $sta;  

            $nuevo->save();

            return Response::json(array('msg' => 'Maestro ingresada'), 200);
        }
        public function ingresarAlumno(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            $id = $app->id;
            $nombre = $app->nombre;
            $ape = $app->apellido;
            $tel = $app->telefono;
            $dir = $app->direccion;
            $sec = $app->seccion;
            $esp = $app->especialidad;
            $con = $app->contra;

            $nuevo = new Alumnos();
            $nuevo->id = $id;
            $nuevo->nombre = $nombre;
            $nuevo->apellido = $ape;
            $nuevo->telefono = $tel;
            $nuevo->direccion = $dir;
            $nuevo->id_seccion = $sec;
            $nuevo->id_especialidad = $esp;
            $nuevo->contra = $con;                                    
            $nuevo->estado = 1;  

            $nuevo->save();

            return Response::json(array('msg' => 'Aumno ingresada'), 200);
        }
        public function ingresarAsignacion(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            $ma = $app->maestro;
            $sec = $app->seccion;
            $mat = $app->materia;

            $nuevo = new Asignacion();

            $nuevo->id_materia = $mat;
            $nuevo->id_seccion = $sec;
            $nuevo->id_maestro = $ma;

            $nuevo->save();

            return Response::json(array('msg' => 'Asignacion ingresada'), 200);
        }
        public function showMateria(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $materia = Materia::find($app->id);
                
                return Response::json(array(
                    'user' => $materia->nombre,
                    'id' => $materia->id
                ), 200);
                
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 400);
            }
        }
        public function showAsignacion(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $Asignacion = Asignacion::find($app->id);
                
                return Response::json(array(
                    'sec' => $Asignacion->id_seccion,
                    'mae' => $Asignacion->id_maestro,
                    'mat' => $Asignacion->id_materia,
                    'id' => $Asignacion->id
                ), 200);
                
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 400);
            }
        }
        public function showMaestro(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $materia = Maestros::find($app->id);
                
                return Response::json(array(
                    'nombre' => $materia->nombre,
                    'apellido' => $materia->apellido,
                    'user' => $materia->usuario,
                    'contra' => $materia->contra,                                                            
                    'id' => $materia->id
                ), 200);
                
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 400);
            }
        }
        public function showAlumno(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $alumno = Alumnos::find($app->id);
                
                return Response::json(array(
                    'nombre' => $alumno->nombre,
                    'apellido' => $alumno->apellido,
                    'tel' => $alumno->telefono,
                    'dir' => $alumno->direccion,
                    'sec' => $alumno->id_seccion,                                                            
                    'esp' => $alumno->id_especialidad,                                                                                                                                            
                    'id' => $alumno->id
                ), 200);
                
            }catch(Exception $ex){
                return Response::json(array('msg' => $ex), 400);
            }
        }
        public function modificarMateria(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $Nombre = $app->nombre;
                $materia = Materia::find($app->id);
                $materia->nombre = $Nombre;
                $materia->save();
                return Response::json(array('msg' => 'Materia actualizada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 500);
            }
        }
        public function modificarAsignacion(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $ma = $app->maestro;
                $sec = $app->seccion;
                $mat = $app->materia;
                $asignacion = Asignacion::find($app->id);
                $asignacion->id_materia = $mat;
                $asignacion->id_seccion = $sec;
                $asignacion->id_maestro = $ma;
                $asignacion->save();
                return Response::json(array('msg' => 'Asignacion actualizada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Asignacion no actualizada'), 500);
            }
        }
        public function modificarMaestro(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $id = $app->id;
                $nombre = $app->nombre;
                $ape = $app->apellido;
                $us = $app->usuario;
                $con = $app->contra;
                $es = $app->estado;
                $maestro = Maestros::find($app->id);
                $maestro->id = $id;
                $maestro->nombre = $nombre;
                $maestro->apellido = $ape;
                $maestro->usuario = $us;
                $maestro->contra = $con;
                $maestro->estado = $es;                
                $maestro->save();
                return Response::json(array('msg' => 'Materia actualizada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 500);
            }
        }
        public function modificarMaestroCon(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $id = $app->id;
                $nombre = $app->nombre;
                $ape = $app->apellido;
                $us = $app->usuario;
                $es = $app->estado;
                $maestro = Maestros::find($app->id);
                $maestro->id = $id;
                $maestro->nombre = $nombre;
                $maestro->apellido = $ape;
                $maestro->usuario = $us;
                $maestro->estado = $es;                
                $maestro->save();
                return Response::json(array('msg' => 'Materia actualizada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 500);
            }
        }
        public function modificarAlumno(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $id = $app->id;
                $nombre = $app->nombre;
                $ape = $app->apellido;
                $tel = $app->telefono;
                $dir = $app->direccion;
                $sec = $app->seccion;
                $esp = $app->especialidad;
                $es = $app->estado;
                $alumno = Alumnos::find($app->id);
                $alumno->id = $id;
                $alumno->nombre = $nombre;
                $alumno->apellido = $ape;
                $alumno->telefono = $tel;
                $alumno->direccion = $dir;
                $alumno->id_seccion = $sec;
                $alumno->id_especialidad = $esp;                                  
                $alumno->estado = $es;                
                $alumno->save();
                return Response::json(array('msg' => 'Materia actualizada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 500);
            }
        }
        public function modificarAlumnoC(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
                
                $id = $app->id;
                $nombre = $app->nombre;
                $ape = $app->apellido;
                $tel = $app->telefono;
                $dir = $app->direccion;
                $sec = $app->seccion;
                $esp = $app->especialidad;
                $con = $app->contra;
                $es = $app->estado;
                $alumno = Alumnos::find($app->id);
                $alumno->id = $id;
                $alumno->nombre = $nombre;
                $alumno->apellido = $ape;
                $alumno->telefono = $tel;
                $alumno->direccion = $dir;
                $alumno->id_seccion = $sec;
                $alumno->id_especialidad = $esp;  
                $alumno->contra = $con;                                
                $alumno->estado = $es;                
                $alumno->save();
                return Response::json(array('msg' => 'Materia actualizada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no actualizada'), 500);
            }
        }
        public function mostrarMateria(){
            return Materia::all();
        }
        public function mostrarMaestro(){
            return Maestros::where('estado', '=', 1)->get();
        }
        public function mostrarAsingnacion(){
            return DB::table('asignacion')  ->join('maestros', 'maestros.id', '=', 'asignacion.id_maestro')
                                            ->join('seccion', 'seccion.id', '=', 'asignacion.id_seccion')
                                            ->join('materia', 'materia.id', '=', 'asignacion.id_materia')
                                            ->select('asignacion.id', 'maestros.nombre AS ma', 'maestros.apellido'
                                                    ,'materia.nombre', 'seccion.year', 'seccion.seccion')
                                            ->get();
        }
        public function mostrarAlumno(){
            return DB::table('alumnos') ->join('seccion', 'seccion.id', '=', 'alumnos.id_seccion')
                                        ->join('especialidad', 'especialidad.id', '=', 'alumnos.id_especialidad')
                                        ->select('alumnos.id', 'alumnos.nombre AS nom ', 'alumnos.apellido', 'alumnos.telefono'
                                                , 'alumnos.direccion', 'seccion.seccion', 'seccion.year','especialidad.nombre')
                                        ->where('alumnos.estado', '=', 1)
                                        ->get();
        }
        public function mostrarAlumnoBus(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);
            
            $bus = $app->bus;
            return DB::table('alumnos') ->join('seccion', 'seccion.id', '=', 'alumnos.id_seccion')
                                        ->join('especialidad', 'especialidad.id', '=', 'alumnos.id_especialidad')
                                        ->select('alumnos.id', 'alumnos.nombre AS nom ', 'alumnos.apellido', 'alumnos.telefono'
                                                , 'alumnos.direccion', 'seccion.seccion', 'seccion.year','especialidad.nombre')
                                        ->where('alumnos.id', 'like', '%'.$bus.'%')
                                        ->orwhere('alumnos.nombre', 'like', '%'.$bus.'%')
                                        ->orwhere('alumnos.apellido', 'like', '%'.$bus.'%')
                                        ->get();
        }
        public function llenarSec(){
            return Seccion::all();
        }
        public function llenarEspec(){
            return Especialidad::all();
        }
        public function llenarMateria(){
            return Materia::all();
        }
        public function llenarMaestro(){
            return Maestros::all();
        }
        public function eliminarMateria(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
            
                $Producto = Materia::find($app->id);
                $Producto->delete();
                return Response::json(array('msg' => 'Materia eliminada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Materia no eliminada'), 500);
            }
        }
        public function eliminarMaestro(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
            
                $Producto = Maestros::find($app->id);
                $Producto->delete();
                return Response::json(array('msg' => 'Maestro eliminada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Maestro no eliminada'), 500);
            }
        }
        public function eliminarAlumno(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
            
                $Producto = Alumnos::find($app->id);
                $Producto->delete();
                return Response::json(array('msg' => 'Alumno eliminada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Alumno no eliminada'), 500);
            }
        }
        public function eliminarAsignacion(){
            try{
                $app = file_get_contents("php://input");
                $app = json_decode($app);
            
                $Producto = Asignacion::find($app->id);
                $Producto->delete();
                return Response::json(array('msg' => 'Asignacion eliminada'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Asignacion no eliminada'), 500);
            }
        }
    }
?> 