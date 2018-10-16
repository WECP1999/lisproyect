<?php
    class AlumnoController extends BaseController{ 
        public function mostrarNotas(){

            $app = file_get_contents("php://input");
            $app = json_decode($app);

            return DB::table('nota') 
            ->join('evaluacion', 'evaluacion.id', '=', 'nota.id_evaluacion')
            ->join('alumnos', 'alumnos.id', '=', 'nota.id_alumno')
            ->join('asignacion','asignacion.id','=','evaluacion.id_asignacion')
            ->join('materia','materia.id','=','asignacion.id_materia')
            ->select('nota.nota', 'evaluacion.porcentaje','evaluacion.nombre AS evaluacion','alumnos.nombre AS alumno', 'alumnos.apellido','evaluacion.periodo','alumnos.id','materia.nombre AS materias')
            ->where('nota.id_alumno', '=', $app->id)
            ->get();
        }
    }
?>