<?php

require "config.php";
session_start();



//Vérification du formulaire

if($_SERVER ['REQUEST_METHOD'] === 'POST') {
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prix = isset($_POST['prix']) ? trim($_POST['prix']) : "";
    $stock = isset($_POST['stock']) ? trim($_POST['stock']) : "";

    //vérifie que le champ n'est pas vide

    if ($nom !== '' && $prix !== '' && $stock !== '' && $id !== null) {
        //Stockage de la session

        $_SESSION['message'] = "Vous avez ajouté un produit " . $nom;

        $stmt = $pdo->prepare('INSERT INTO produits (id, nom, prix, stock) values(NULL,?,?,?)');
         $stmt->execute([$nom, $prix, $stock]);

// Stockage des informations nom, email, message dans la session pour les récupérer plus tard
        $_SESSION['nom'] = $nom;
        $_SESSION['prix'] = $prix;
        $_SESSION['stock'] = $stock;
        //redirection vers la meme page

        header('Location: index.php');
        exit();
    } else {

        //Message d'erreur
        $_SESSION['message-nom'] = "Veuillez indiquer votre produit! " . $nom;

    }

}

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>formulaire : ajout</title>
</head>
<body>
<?php

if (isset($_SESSION['message'])) {
    echo "<p>" . htmlspecialchars($_SESSION['message']) . "</p>";
    unset($_SESSION['message']);
}
?>

<form action="add.php" method="post">
    <label for="nom"> Nom</label>
    <input type="text" id="nom" name="nom" required> <br>
    <label for="prix"> Prix</label>
    <input type="text" id="prix" name="prix" required><br>
    <label for="stock"> Stock</label>
    <input type="text" id="stock" name="stock" required> <br>
    <button type="submit">Ajouter</button>

</form>
</body>
</html>

