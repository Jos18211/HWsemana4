<?php
//class Genre
class movie
{
    //Obtener en el API
    public function get($id)
    {
        //Obtener elemento
        $movie = new MovieModel();
        $generoM = new GenreModel();
        //Obtener una pelicula
        $response = $movie->get($id);
        $response = $response[0];
        //Obtener la lista de generos de la pelicula
        $rGeneros = $generoM->getGenreMovie($id);
        //Propiedad que se va a agregar al objeto
        $response->genres = $rGeneros;
        //$response[0]->genres=$rGeneros;

        //Si hay respuesta
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }




    // obtener las peliculas que pertenecen al id de genero del paramatro indicado 

    public function getbygenre($sparam)
    {

        //Obtener el listado del Modelo
        $movie = new MovieModel();

        //Si hay respuesta
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No hay registros"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );
    }

    public function create()
    {
        $inputJSON=file_get_contents('php://input');
        $object=json_decode($inputJSON);
        $movie=new MovieModel();
        $response=$movie->create($object);
        



        
        if (isset($response) && !empty($response)) {
            //Armar el json
            $json = array(
                'status' => 200,
                'results' => $response
            );
        } else {
            $json = array(
                'status' => 400,
                'results' => "No se realizo el registro"
            );
        }
        echo json_encode(
            $json,
            http_response_code($json["status"])
        );




    }
}
