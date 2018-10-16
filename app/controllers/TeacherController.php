<?php
    class TeacherController extends BaseController{
        public function getAsignaciones(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            return Asignacion::orderBy('asignacion.id')
                ->join('seccion', 'seccion.id', '=', 'asignacion.id_seccion')
                ->join('materia', 'materia.id', '=', 'asignacion.id_materia')
                ->where('asignacion.id_maestro', $app->id)
                ->select('seccion.year', 'seccion.seccion', 'materia.nombre', 'asignacion.id')
                ->get();
        }
        public function getAlumnosBy(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            return Asignacion::orderBy('asignacion.id')
                ->join('seccion', 'seccion.id', '=', 'asignacion.id_seccion')
                ->join('alumnos', 'alumnos.id_seccion', '=', 'seccion.id')
                ->join('evaluacion', 'evaluacion.id_asignacion', '=', 'asignacion.id')
                ->join('especialidad', 'especialidad.id', '=', 'alumnos.id_especialidad')
                ->where('evaluacion.id', $app->id)
                ->where('alumnos.estado', 1)
                ->select(
                    'alumnos.id as id', 
                    'alumnos.nombre as nombre', 
                    'alumnos.apellido as apellido', 
                    'especialidad.nombre as especialidad'
                    )
                ->distinct()
                ->get();
        }
        public function getEvaluaciones(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            return Evaluacion::orderBy('evaluacion.id')
                ->join('asignacion', 'asignacion.id', '=', 'evaluacion.id_asignacion')
                ->join('seccion', 'seccion.id', '=', 'asignacion.id_seccion')
                ->join('materia', 'materia.id', '=', 'asignacion.id_materia')
                ->where('asignacion.id_maestro', $app->id)
                ->select(
                    'evaluacion.id as id', 
                    'evaluacion.nombre as evname', 
                    'seccion.year as year', 
                    'seccion.seccion as seccion', 
                    'materia.nombre as materia',
                    'asignacion.id as asignacion'
                    )
                ->get();
        }
        private function getAsignacion($seccion, $periodo){
            return Evaluacion::orderBy('id')
                ->where('id_asignacion', $seccion)
                ->where('periodo', $periodo)
                ->sum('porcentaje');
        }
        public function getNotas(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            return Notas::orderBy('id')
                ->where('id_evaluacion', $app->actividad)
                ->select('id_alumno')
                ->get();
        }
        public function newNota(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            $Alumnos = $app->alumnos;
            $Notas = $app->notas;

            foreach($Notas as $key => $value) {
                if($value->nota < 0 || $value->nota > 10)
                    return Response::json(array('msg' => 'Hay una nota corrupta.'), 500);
            }
            foreach($Alumnos as $key => $value){
                try{
                    $NuevaNota = new Notas();
                    $NuevaNota->nota = $Notas[$key]->nota;
                    $NuevaNota->id_evaluacion = $app->actividad;
                    $NuevaNota->id_alumno = $value->id;
                    $NuevaNota->save();
                }catch(Exception $ex){
                    return Response::json(array('msg' => 'Error al ingresar una de las notas.'), 500);
                }
            }
            return Response::json(array('msg' => 'Notas agregadas con éxito.'), 200);
        }
        public function getActividades(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            return Evaluacion::orderBy('evaluacion.id')
                ->join('asignacion', 'asignacion.id', '=', 'evaluacion.id_asignacion')
                ->where('asignacion.id_maestro', $app->id)
                ->select(
                    'evaluacion.nombre',
                    'evaluacion.descripcion', 
                    'evaluacion.porcentaje', 
                    'evaluacion.periodo', 
                    'evaluacion.id'
                    )
                ->get();
        }
        public function deleteActivity(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);

            try{
                $Eval = Evaluacion::find($app->id);
                $Eval->delete();
                return Response::json(array('msg' => "Elemento eliminado con éxito."), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => $ex->getMessage()), 500);
            }
        }
        public function newActivity(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);
            
            $Nombre = $app->nombre;
            $Descripcion = $app->descripcion;
            $Porcentaje = $app->porcentaje;
            $Periodo = $app->periodo;
            $Asignacion = $app->asignacion;

            $valAsig = intval($this->getAsignacion($Asignacion, $Periodo)) + $Porcentaje;
            $valPeri = intval($Periodo);
            if($valAsig >= 0 && $valAsig <= 100){
                try{
                    $Eval = new Evaluacion();
                    $Eval->nombre = $Nombre;
                    $Eval->descripcion = $Descripcion;
                    $Eval->porcentaje = $Porcentaje;
                    $Eval->periodo = $Periodo;
                    $Eval->id_asignacion = $Asignacion;
                    $Eval->save();
                    return Response::json(array('msg' => 'Evaluación agregada con éxito.', 'v' => $valAsig), 200);
                }catch(Exception $ex){
                    return Response::json(array('msg' => $ex->getMessage()), 500);
                }
            } else return Response::json(array('msg' => 'Porcentaje no válido.'), 500);
        }
    }
?>