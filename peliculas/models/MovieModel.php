<?php
class MovieModel
{
    public $enlace;
    public function __construct()
    {
        $this->enlace = new MySqlConnect();
    }
    /*Listar */
    public function all()
    {
    }
    /*Obtener */
    public function get($id)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT * FROM movie where id=$id;";
            //Establecer conexión
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);


            $generoM = new GenreModel();
            $response = $vResultado[0];
            //Obtener la lista de generos de la pelicula
            $rGeneros = $generoM->getGenreMovie($id);
            //Propiedad que se va a agregar al objeto
            $response->genres = $rGeneros;
            //$response[0]->genres=$rGeneros;


            $actorM = new ActorModel();
            $response = $vResultado[0];
            //Obtener la lista de generos de la pelicula
            $rActores = $actorM->getGenreMovie($id);
            //Propiedad que se va a agregar al objeto
            $response->genres = $rGeneros;

            //Retornar el resultado


            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    public function getbyGenre($id)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT m.title FROM movie m , movie_genre mg  where m.id=mg.movie_id and mg.genre_id=$id;";
            //Establecer conexión
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }

    public function getbyActorMovie($id)
    {
        try {
            //Consulta SQL
            $vSQL = "SELECT g.id , g.fname, g.lname FROM actor g ,  movie_cast mg ,   where g.id  and mg.genre_id=$id;";
            //Establecer conexión
            $this->enlace->connect();
            //Ejecutar la consulta
            $vResultado = $this->enlace->executeSQL($vSQL);
            //Retornar el resultado
            return $vResultado;
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }


    /*Crear */
    public function create($objeto)
    {
        try {
            $this->enlace->connect();

            //tiene un idintificador auto incrementable 
            $sql = "insert into movie (title,year,time,lang)" .
                "values('$objeto->title','$objeto->year','$objeto->time','$objeto->lang');";
            //ejecutar la consulta  
            $idMovie = $this->enlace->executeSQL_DML_last($sql);
            //cierre de conexion 

            // gestionar generos 
            //crear los elementos a insertar
            foreach ($objeto->genres as $genre) {
                $dataGenre[] = array($idMovie, $genre);
            }
            //$dataGenre=[[1,7],[6,10]];

            //insetar los datos de genero
            foreach ($dataGenre as $row) {
                $this->enlace->connect();
                $values = implode(',', $row);
                $sql = "insert into movie_genre(movie_id,genre_id) VALUES($values);";
                $resultado = $this->enlace->executeSQL_DML($sql);
            }

            //--Actores 
            foreach ($objeto->actors as $actor) {
                $dataActors[] = array($idMovie, $actor[0], "$actor[1]");
            }
            //$dataACTORS=[[1,7,"role 1"],[6,10,"role 2"]];

            //insetar los datos 
            foreach ($dataActors as $row) {
                $this->enlace->connect();

                $sql = "insert into movie_cast(movie_id,genre_id,role) VALUES($row[0],$row[1],'$row[2]');";
                $resultado = $this->enlace->executeSQL_DML($sql);
            }




            //retorna pelicula
            return $this->get($idMovie);
        } catch (Exception $e) {
            die($e->getMessage());
        }
    }
    /*Actualizar */
    public function update($objeto)
    {
    }
}
