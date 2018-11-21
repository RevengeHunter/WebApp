<?php
include("conection.php");

class classMovie extends conection{
    public function mostrarMovie(){
        $recuperarCon=$this->getConnection()->prepare("select * from tblmovie");
        $recuperarCon->execute();

        $ListaMovies=[];
        $Indice=0;

        try{
            while($RCon = $recuperarCon->fetch(PDO::FETCH_ASSOC)){
                $ListaMovies[$Indice]=[
                    "idPeli"=>$RCon['idPeli'],
                    "namePeli"=>$RCon['namePeli'],
                    "descripPeli"=>$RCon['descripPeli']
                ];
                $Indice++;
            }
    
            header("Access-Control-Allow-Origin:*");
            header("Content-type: application/json");
            http_response_query(200);
            echo json_encode($ListaMovies);
        }
        catch(Exception $e){
            http_response_query(404);
        }
        
    }
}
?>