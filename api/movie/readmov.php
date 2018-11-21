<?php
// se requieren headers para el rest api
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

include_once '../config/conection.php';
include_once '../movie/movieobj.php';

$database =new Database();
$db = $database->getConnection();

$movie = new Movie($db);

$stmt = $movie->read();
$num = $stmt->rowCount();
 
if($num>0){

    $movies_arr=array();
    $movies_arr["peliculas"]=array();
 
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

        extract($row);
 
        $movie_item=array(
            "idPeli" => $idPeli,
            "namePeli" => $namePeli,
            "descripPeli" => $descripPeli,
        );
 
        array_push($movies_arr["peliculas"], $movie_item);
    }

    http_response_code(200);
    echo json_encode($movies_arr);
}
else{
    http_response_code(404);
    echo json_encode(
        array("message"=>"No se encontro lista-movie")
    );
}

?>