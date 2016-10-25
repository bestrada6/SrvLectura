<?php

class LibroRepository {
    private $objDAO;
    
    public function __construct(LibroDAO $objdao) {
        $this->objDAO=$objdao;
    }
    
    public function listarLibros(){
        return $this->objDAO->listarLibros();
    }
    
    public function librosAutor($id){
        return $this->objDAO->librosAutor($id);
    }
    
    public function obtenerLibro($id){
        return $this->objDAO->obtenerLibro($id);
    }
    
    public function registrarLibro($entidad){
        return $this->objDAO->registrarLibro($entidad);
    }
    
    public function modificarLibro($entidad){
        return $this->modificarLibro->modificarLibro($entidad);
    }
}
