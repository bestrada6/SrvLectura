<?php


class LibroDAO {
    private $dbh;

    public function __construct(PDO $dbh) {
        $this->dbh = $dbh;
    }
    
    public function listarLibros(){
         $sql = "select idLibro,l.nombre 'libro',descripcion,fecPublicacion,foto,".
                 "u.nomUsuario,nomPersona ".
                 " from libro l inner join usuario u on l.idUsuario=u.idUsuario";
        
        $stmt = $this->dbh->prepare($sql);
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $stmt->errorInfo()[2];
        }   
    }
    
    public function librosAutor($id){
         $sql = "select idLibro,l.nombre 'libro',l.descripcion,l.fecPublicacion,l.foto,".
                 "u.nomUsuario,nomPersona " .
                 " from libro l inner join usuario u on l.idUsuario=u.idUsuario ".
                 " where l.idUsuario=?";
        
        $stmt = $this->dbh->prepare($sql);

        $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $stmt->errorInfo()[2];
        }   
    }
    
    public function obtenerLibro($id){
         $sql = "select idLibro,l.idUsuario,l.nombre 'libro',l.descripcion,l.fecPublicacion,l.foto,".
                 "u.nomUsuario,nomPersona".
                 "from libro l inner join usuario u on l.idUsuario=u.idUsuario".
                 "where l.idLibro=?";
         
         $stmt = $this->dbh->prepare($sql);
         
         $stmt->bindParam(1, $id, PDO::PARAM_INT);
        
        
        if ($stmt->execute()) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } else {
            return $stmt->errorInfo()[2];
        }   
    }
    
    public function registrarLibro($entidad){
         $sql = 'insert into libro(idUsuario,nombre,descripcion,foto)'.
                ' VALUES(?,?,?,?,?,?)';

        $stmt = $this->dbh->prepare($sql);
        
        $idUsuario= $entidad->idUsuario;
        $nombre = $entidad->nombre;
        $descripcion = $entidad->descripcion;
        $foto = $entidad->foto;

        $stmt->bindParam(1, $idUsuario,PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre);
        $stmt->bindParam(3, $descripcion);
        $stmt->bindParam(4, $foto);


        if ($stmt->execute()) {
            return [
                    "estado" => 0,
                    "mensaje" => "Contacto creado"
                ];
        } else {
            return $stmt->errorInfo()[2];
        }   
    }
    
    
    public function modificarLibro($entidad){
         $sql = "UPDATE libro".
                " SET idUsuario=?," .
                " nombre=?," .
                " descripcion=?," .
                " foto=? " .
                " WHERE idLibro=? ";

        $stmt = $this->dbh->prepare($sql);
        
        $idUsuario= $entidad->idUsuario;
        $nombre = $entidad->nombre;
        $descripcion = $entidad->descripcion;
        $foto = $entidad->foto;

        $stmt->bindParam(1, $idUsuario,PDO::PARAM_INT);
        $stmt->bindParam(2, $nombre);
        $stmt->bindParam(3, $descripcion);
        $stmt->bindParam(4, $foto);


        if ($stmt->execute()) {
            return [
                    "estado" => 0,
                    "mensaje" => "Contacto modificado"
                ];
        } else {
            return $stmt->errorInfo()[2];
        }   
    }
    
    
    
}
