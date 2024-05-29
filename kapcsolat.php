<?php
require 'vendor/autoload.php';
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

header("Content-Type:text/html; charset=utf-8");

define("DBHOST", $_ENV['DBHOST']);
define("DBUSER", $_ENV['DBUSER']);
define("DBPASS", $_ENV['DBPASS']);
define("DBNAME", $_ENV['DBNAME']);

$dbconn = new mysqli(DBHOST, DBUSER, DBPASS, DBNAME);

if($dbconn->connect_error){
    error_log("Adatbázis kapcsolati hiba: " . $dbconn->connect_error);
}
else{
    // echo "kapcs ok";
}

if(!$dbconn->set_charset('utf8')){
    error_log("charset err" . $dbconn->error);
    die("hiba az adatbázis charset beállításában");
}