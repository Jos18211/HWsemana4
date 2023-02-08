<?php
class ActorModel{
    public $enlace;
    public function __construct()
    {
        $this->enlace=new MySqlConnect();
    }
    /*Listar */
    public function all(){

    }
    /*Obtener */
    public function get($id){
        
    }
    /*Obtener los actores de una pelicula */
    public function getGenreMovie($idMovie){
        try {
            //Consulta SQL
            $vSQL="SELECT g.id, g.title FROM genre g, movie_genre mg where g.id=mg.genre_id and mg.movie_id=$idMovie;";
            //Establecer conexión
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado=$this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;

        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*Crear */
    public function create($objeto){
        
    }
    /*Actualizar */
    public function update($objeto){
        
    }
}