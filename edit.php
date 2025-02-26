<?php

require "config.php";
session_start();

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $query = "SELECT * FROM produits WHERE id = :id";
    $stmt = $pdo->prepare($query);
    $stmt->execute(['id' => $id]);
    $produits = $stmt->fetch(PDO::FETCH_ASSOC);

    // Vérifier si des résultats ont été trouvés
    if (!$produits) {
        // Si aucun produit n'est trouvé, rediriger ou afficher un message d'erreur
        $_SESSION['message'] = "Produit non trouvé!";
        header('Location: index.php'); // Rediriger vers la page d'accueil ou une page d'erreur
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'] ?? null;
    $nom = isset($_POST['nom']) ? trim($_POST['nom']) : "";
    $prix = isset($_POST['prix']) ? trim($_POST['prix']) : "";
    $stock = isset($_POST['stock']) ? trim($_POST['stock']) : "";

    // Vérifie que tous les champs sont remplis
    if ($nom !== '' && $prix !== '' && $stock !== '') {
        try {
            // Mise à jour du produit dans la base de données
            $stmt = $pdo->prepare('UPDATE produits SET nom = ?, prix = ?, stock = ? WHERE id = ?');
            $stmt->execute([$nom, $prix, $stock, $id]);

            // Message de succès
            $_SESSION['message'] = "Le produit a été mis à jour avec succès.";
            header('Location: index.php');
            exit();
        } catch (PDOException $e) {
            // Gestion des erreurs
            $_SESSION['message'] = "Erreur lors de la mise à jour : " . $e->getMessage();
        }
    } else {
        // Message d'erreur si un champ est vide
        $_SESSION['message'] = "Veuillez remplir tous les champs.";
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
    <title>Document</title>
    <style>
    body {
    font-family: Arial, sans-serif;
    background-color: #111; /* Noir */
    color: #fff;
    margin: 0;
    padding: 0;
    }

    h1 {
    text-align: center;
    color: #FFD700; /* Jaune */
    }

    form {
    background-color: #6A0DAD; /* Violet */
    width: 40%;
    margin: 50px auto;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.3);
    }

    label {
    font-size: 18px;
    margin-bottom: 10px;
    display: block;
    color: #FFD700; /* Jaune */
    }

    input {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    border: 1px solid #fff;
    border-radius: 4px;
    background-color: #333;
    color: #fff;
    }

    input:focus {
    outline: none;
    border-color: #FFD700; /* Jaune */
    }

    button {
    width: 100%;
    padding: 12px;
    background-color: #FFD700; /* Jaune */
    color: #111;
    font-size: 16px;
    border: none;
    border-radius: 4px;
    cursor: pointer;
    font-weight: bold;
    }

    button:hover {
    background-color: #FFBF00; /* Jaune plus foncé */
    }

    p {
    text-align: center;
    color: #fff;
    font-size: 16px;
    }

    </style>
</head>
<body>
<form action="edit.php" method="post">
    <!-- Champ caché pour l'ID -->
    <input type="hidden" name="id" value="<?= htmlspecialchars($produits['id']) ?? '' ?>">

    <label for="nom">Nom</label>
    <input type="text" id="nom" name="nom" value="<?= htmlspecialchars($produits['nom'] ?? '') ?>"><br>

    <label for="prix">Prix</label>
    <input type="text" id="prix" name="prix" value="<?= htmlspecialchars($produits['prix'] ?? '') ?>"><br>

    <label for="stock">Stock</label>
    <input type="text" id="stock" name="stock" value="<?= htmlspecialchars($produits['stock'] ?? '') ?>"><br>

    <button type="submit">Modifier</button>
</form>

</body>
</html>
