<?php

require_once 'http/Response.php';
require_once 'http/status_messages.php';

class LibroController {
    
    private $Data;
    
    public function __construct(LibroRepository $data) {
        $this->Data=$data;
    }
    
    public function listarLibrosAction($request){
        $response = new Response();
        $result= $this->Data->listarLibros();
        
        if (is_array($result)) {
                $response->setBody(['items'=>$result]);
                $response->setStatus(200);
            } else if (is_string($result)) {
                $response->setBody(['message' => $result]);
                $response->setStatus(200);
            }
                
        return $response; 
    }
    
    public function librosAutorAction($request){
        $response = new Response();
        
        $id=$request->url_parameter; 

        $result= $this->Data->librosAutor($id);
        
        if (is_array($result)) {
            $response->setBody($result);
            $response->setStatus(200);
        } else if (is_string($result)) {
            $response->setBody(['message' => $result]);
            $response->setStatus(200);
        }
                
        return $response; 
    }
    
    public function obtenerLibroAction($request){
        
        $response = new Response();
        
        $id=$request->url_parameter; 

        $result= $this->Data->obtenerLibro($id);
        
        if (is_array($result)) {
            $response->setBody($result);
            $response->setStatus(200);
        } else if (is_string($result)) {
            $response->setBody(['message' => $result]);
            $response->setStatus(200);
        }
                
        return $response; 
    }
    
    public function registrarLibroAction($request){
        
        $response = new Response();
        
        $entidad=$request->url_post;
        
        $result= $this->Data->registrarLibro($entidad);
        
        if (is_array($result)) {
            $response->setBody($result);
            $response->setStatus(200);
        } else if (is_string($result)) {
            $response->setBody(['message' => $result]);
            $response->setStatus(200);
        }
                
        return $response; 
    }
    
    public function modificarLibroAction($request){
        
        $response = new Response();
        
        $entidad=$request->url_post;
        
        $result= $this->Data->modificarLibro($entidad);
        
        if (is_array($result)) {
            $response->setBody($result);
            $response->setStatus(200);
        } else if (is_string($result)) {
            $response->setBody(['message' => $result]);
            $response->setStatus(200);
        }
                
        return $response; 
    }
    
}
