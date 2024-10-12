<?php

class Peliculas{
    //FUNCION DE CONEXION EN EL SERVIDOR LOCAL
    private $con;
    private $dbhost="localhost";
    private $dbuser="root";
    private $dbpass="";
    private $dbname="bd_proyecto";
    function __construct(){
        $this->connect_db();
    }
    public function connect_db(){
        $this->con = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        if(mysqli_connect_error()){
            die("Conexión a la base de datos falló " . mysqli_connect_error() . mysqli_connect_errno());
        }
    }




        //FUNCION CREATE PARA PELICULAS CON FOTO
        public function create_Pelicula($Genero,$Titulo,$Productora,$Actores, $Descripcion, $Fecha_Estreno, $Image1, $Image2, $URL_Trailer, $URL_Pelicula){
        $FechaGuardada = date('Y-m-d');
        $sql = "INSERT INTO `Peliculas` (Genero, Titulo, Productora, Actores, Descripcion, Fecha_Estreno, Imagen, Portada, URL_Trailer, URL_Film, FechaGuardada) 
        VALUES ('$Genero', '$Titulo', '$Productora', '$Actores', '$Descripcion', '$Fecha_Estreno', '$Image1', '$Image2', '$URL_Trailer', '$URL_Pelicula', '$FechaGuardada')";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
        return false;
    }
    }	

    //FUNCION READ O SELECT	PARA PELICULAS	
    public function read_Peliculas(){
        $sql = "SELECT * FROM Peliculas";
        $res = mysqli_query($this->con, $sql);
        if ($res && mysqli_affected_rows($this->con) > 0) {
            return $res;
        }
        else{
            return false;
        }
    }
    public function BuscarPelicula($IDPelicula){
            $sql = "SELECT * FROM Peliculas where IDPelicula='$IDPelicula'";
            $res = mysqli_query($this->con, $sql);
            $return = mysqli_fetch_object($res );
            return $return ;
    }
    


        //FUNCION UPDATE O ACTUALIZAR SIN FOTO PARA PELICULAS
        public function updateSF_Pelicula($Titulo,$Productora,$Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film, $Fecha_Estreno,$IDPelicula){
        $sql = "UPDATE Peliculas SET Titulo='$Titulo', Productora='$Productora', Actores='$Actores', Descripcion = '$Descripcion', Genero= '$Genero', URL_Trailer = '$URL_Trailer', URL_Film='$URL_Film', Fecha_Estreno='$Fecha_Estreno' WHERE IDPelicula=$IDPelicula";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    //FUNCION UPDATE O ACTUALIZAR CON  FOTO CHCA PARA PELICULAS
    public function updateCFChica_Pelicula($Titulo,$Productora,$Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film,$Fecha_Estreno,$Image,$IDPelicula){
        $sql = "UPDATE Peliculas SET Titulo='$Titulo', Productora='$Productora', Actores = '$Actores', Descripcion='$Descripcion', Genero = '$Genero', URL_Trailer = '$URL_Trailer', URL_Film='$URL_Film', Fecha_Estreno='$Fecha_Estreno', Imagen ='$Image' WHERE IDPelicula=$IDPelicula";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    //FUNCION UPDATE O ACTUALIZAR CON  FOTO CHCA PARA PELICULAS
    public function updateCFGrande_Pelicula($Titulo,$Productora,$Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film,$Fecha_Estreno,$Image,$IDPelicula){
        $sql = "UPDATE Peliculas SET Titulo='$Titulo', Productora='$Productora', Actores = '$Actores', Descripcion='$Descripcion', Genero = '$Genero', URL_Trailer = '$URL_Trailer', URL_Film='$URL_Film', Fecha_Estreno='$Fecha_Estreno', Portada ='$Image' WHERE IDPelicula=$IDPelicula";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }

    //FUNCION UPDATE O ACTUALIZAR CON DOS FOTOS PARA PELICULAS
    public function updateCFDoble_Pelicula($Titulo,$Productora,$Actores, $Descripcion, $Genero, $URL_Trailer, $URL_Film,$Fecha_Estreno,$Image1, $Image2, $IDPelicula){
        $sql = "UPDATE Peliculas SET Titulo='$Titulo', Productora='$Productora', Actores = '$Actores', Descripcion='$Descripcion', Genero = '$Genero', URL_Trailer = '$URL_Trailer', URL_Film='$URL_Film', Fecha_Estreno='$Fecha_Estreno', Imagen ='$Image1', Portada='$Image2' WHERE IDPelicula=$IDPelicula";
        $res = mysqli_query($this->con, $sql);
        if($res){
            return true;
        }else{
            return false;
        }
    }
    
    //FUNCION DELETE O ELIMINAR PARA PELICULAS
    public function delete_Pelicula($IDPelicula){
        $sql = "DELETE FROM Peliculas WHERE IDPelicula=$IDPelicula";
        $res = mysqli_query($this->con, $sql);
        if($res){
        return true;
        }else{
        return false;
        }
    }
    //********************************************************************** */
    
    
}

?>
    