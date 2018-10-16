<?php
    class AuthController extends BaseController{
        public function LogIn(){
            $app = file_get_contents("php://input");
            $app = json_decode($app);
            
            try{
                $Username = $app->user;
                $Password = $app->pass;
    
                $Prefix = strtolower($Username[0]);
                switch($Prefix){
                    case 'a':
                        try{
                            $d = Alumnos::orderBy('id');
                        }catch(Exception $ex){
                            return Response::json(array('msg' => $ex->getMessage()), 500);
                        }
                        break;
                    case 'd':
                        try{
                            $d = Administrador::orderBy('id');
                        }catch(Exception $ex){
                            return Response::json(array('msg' => $ex->getMessage()), 500);
                        }
                        break;
                    case 'm':
                        try{
                            $d = Maestros::orderBy('id');
                        }catch(Exception $ex){
                            return Response::json(array('msg' => $ex->getMessage()), 500);
                        }
                        break;
                    default: 
                        return Response::json(array('msg' => 'El prefijo ingresado es incorrecto.'), 500);
                        break;
                }
                if($d !== null){
                    try{
                        $d = $d->where('id', $Username)->where('contra', $Password)->first();
                        if($d){
                            Session::put("loggin", true);
                            Session::put("user", $Username);
                            Session::put("type", $Prefix);
                            return Response::json(array('msg' => 'Usuario encontrado.', 'state' => 'success'), 200);
                        } else return Response::json(array('msg' => 'Usuario no encontrado.', 'state' => 'error'), 200);
                    }catch(Exception $ex){
                        return Response::json(array('msg' => $ex->getMessage()), 500);
                    }
                } else return Response::json(array('msg' => 'Objeto no instanciado.'), 500);
            }catch(Exception $ex){
                return Response::json(array('msg' => 'Error al obtener los valores.'), 500);
            }
        }
        public function LogInfo(){
            try{
                if(Session::has('loggin')){
                    if(Session::get('loggin')){
                        return Response::json(array(
                            'user'      => Session::get('user'),
                            'loggin'    => Session::get('loggin'),
                            'type'      => Session::get('type'),
                            'state'     => true
                        ), 200);
                    } else return Response::json(array('msg' => 'No hay sesión iniciada aún.', 'state' => false), 200);
                } else return Response::json(array('msg' => 'No hay sesión iniciada aún.', 'state' => false), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => $ex->getMessage()), 500);
            }
        }
        public function LogOut(){
            try{
                Session::flush();
                return Response::json(array('msg' => 'Sesión finalizada.'), 200);
            }catch(Exception $ex){
                return Response::json(array('msg' => $ex->getMessage()), 500);
            }
        }
    }
?>