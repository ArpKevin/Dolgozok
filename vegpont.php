<?php
require_once 'kapcsolat.php';

if($_SERVER['REQUEST_METHOD'] === 'GET'){
    try{
        $sql = "SELECT * FROM dolgozok";
        $eredmeny = mysqli_query($dbconn, $sql);

        if(!$eredmeny){
            http_response_code(500); //belső szerver hiba
            die("Hiba a kiválasztásnál:" . mysli_error($dbconn));
        }

        $dolgozok = array();
        while ($sor = mysqli_fetch_assoc($eredmeny)) {
            $dolgozok[]= $sor;
        }

        mysqli_close($dbconn);

        header('Content-Type:application/json; charset=utf-8');
        echo json_encode($dolgozok, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);

        file_put_contents('dolgozo.json', json_encode($dolgozok, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE) );

    }catch (Exception $e)
    {
        http_response_code(500);
        echo "Hiba:" . $e->getMessage();
    }
    
}else{
    //nem megengedd kérés esetén
    http_response_code(405);
}