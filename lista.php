<?php
require("kapcsolat.php");

$kifejezes = isset($_POST['kifejezes']) ? mysqli_real_escape_string($dbconn, $_POST['kifejezes']) : "";
$sql = "SELECT * 
        FROM dolgozok
        WHERE (
            nev LIKE '%{$kifejezes}%'
            OR mobil LIKE '%{$kifejezes}%'
            OR email LIKE '%{$kifejezes}%'
        )";
$eredmeny = mysqli_query($dbconn, $sql);
//var_dump($eredmeny);
$kimenet = "<table>
                <tr>
                    <th>Név</th>
                    <th>Mobil</th>
                    <th>E-mail</th>
                    <th>Művelet</th>
                </tr>";
while ($sor = mysqli_fetch_assoc($eredmeny)) {
   $kimenet .= "<tr>
   <td>{$sor['nev']}</td>
   <td>{$sor['mobil']}</td>
   <td>{$sor['email']}</td>
   <td><a href=\"torles.php?id={$sor['id']}\">Törlés</a>
   | <a href=\"modositas.php?id={$sor['id']}\">Módosítás</a></td>
</tr>";
}
$kimenet .= "</table>";
?><!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dolgozók</title>
    <link rel="stylesheet" href="stilus.css">
</head>
<body>
    <div class="container">
<h1>Dolgozók</h1>
<form action="" method="post">
    <input type="search" name="kifejezes" id="kifejezes">
</form>
<p><a href="felvitel.php">Új dolgozó felvitele</a></p>

<!--Ide kerül a PHP kimenet-->
<?php print $kimenet;?>



    </div>
</body>
</html>