<?php

if(!isset($_REQUEST['id'])){
    header("Location: lista.php");
    exit();
}

require("kapcsolat.php");

if(isset($_POST['rendben'])){
    $nev = htmlspecialchars(trim(ucwords(strtolower($_POST['nev']))));
    $mobil = htmlspecialchars(trim($_POST['mobil']));
    $email = htmlspecialchars(trim(strtolower($_POST['email'])));

    if(empty($nev)){
        $hibak[] = "nem adott meg nevet";
    }elseif(strlen($nev) <3){
        $hibak[] = "Az Ön neve gyanusan rövid, ha csak nem kínai";
    }

    if(empty($mobil) && strlen($mobil) < 9){
        $hibak[] ="Helytelen mobil szám formátumot adott meg";
    }

    if(!empty($email) && !filter_var($email, FILTER_VALIDATE_EMAIL)){
        $hibak[] = "Helytelen e-mail";
    }

    if(isset($hibak)){
        $kimenet ="<ul>";

        foreach($hibak as $hiba){
            $kimenet .="<li>{$hiba}</li>";
        }

        $kimenet .="</ul>";
    }else{

    // módosítás
    $id = (int)$_POST['id'];
    $sql = "UPDATE dolgozok
            SET nev = '{$nev}', mobil = '{$mobil}', email = '{$email}'
            WHERE id = {$id}";
            mysqli_query($dbconn, $sql);
            header("Location: lista.php");
            exit();
    }
}
// űrlap előzetes kitöltése
$id=(int)$_GET['id'];
$sql = "SELECT *
    FROM dolgozok
    WHERE id = {$id}
";
$eredmeny = mysqli_query($dbconn, $sql);
$sor = mysqli_fetch_assoc($eredmeny);
// var_dump($sor);
$nev = $sor['nev'];
$mobil = $sor['mobil'];
$email = $sor['email'];
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="stilus.css">
</head>
<body>
    <div class="container">
        <h1>Dolgozó adatainak módosítása</h1>
        <form action="" method="post">
    <!--Hiba üzenetek a usernek..-->
<?php if(isset($kimenet)) print $kimenet;?>
<input type="hidden" name="id" value="<?php print $id ?>">
    <p>
        <label for="nev">Név</label>
        <input type="text" name="nev" value="<?php print $nev ?>">
    </p>
    <p>
        <label for="mobil">Mobil:</label>
        <input type="tel" name="mobil" value="<?php print $mobil ?>">
    </p>
    <p>
        <label for="email">E-mail:</label>
        <input type="email" name="email" value="<?php print $email ?>">
    </p>

    <input type="submit" value="Módosítás" name="rendben">

        </form>
        <p><a href="lista.php">Vissza a listához</a></p>
    </div>
</body>
</html>