<?php
header("Content-Type:text/html; charset=utf-8");

define("DBHOST", "localhost");
define("DBUSER", "root");
define("DBPASS", "");
define("DBNAME", "dolgozok");

$dbconn = @mysqli_connect(DBHOST, DBUSER, DBPASS, DBNAME) or die("hiba az adatbázis csatlakozásakor");

// Check connection
if (!$dbconn) {
    die("Connection failed: " . mysqli_connect_error());
  }
  echo "Connected successfully";

  mysqli_query($dbconn, "SET NAMES utf8");

  ?>