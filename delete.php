<?php
require("config.php");


    try {
        //Création d'une instance PDO
        $pdo = new PDO ("mysql:host=$dbhost;dbname=$dbname", $user, $pass);
        //Configuration de PDO en cas d'exception
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        //S'il y a une erreur de connexion
        die("Erreur de connexion : " . $e->getMessage());
    }

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $stmt = $pdo->prepare('DELETE from produits where id = ?');
    $produits = $stmt->execute([$id]);

}


?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formulaire : supp</title>
</head>
<body>

</body>
</html>
