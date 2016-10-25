<?php


class Request {
    
    public $url_controller;
    public $url_action;
    public $url_parameter;
    public $url_post;
    public $verb;
    
    public function __construct() {
        $this->verb=$_SERVER['REQUEST_METHOD'];
        
        if(!isset($_GET['controller'])){
            return false;
        }else{
            $this->url_controller= explode('/', $_GET['controller']);
        }

        if(!isset($_GET['action'])){
            return false;
        }else{
            $this->url_action= explode('/', $_GET['action']);
        }
        
        if($this->verb=='GET'){
            if(isset($_GET['parameter'])){
                $this->url_parameter= explode('/', $_GET['parameter']);
            }
        }
        
        if($this->verb=='POST'){

                $cuerpo = file_get_contents('php://input');
                $arrayJson = json_decode($cuerpo);
                echo print_r($arrayJson);
                $this->url_post=$arrayJson;
                

        }

        return true;
        
    }
    
    
}

//
//{
//  "idCliente":1,
//    "nombre":"nick",
//   "contrasena":"12345",
//   "correo":"carlos@mail.com"
//}
