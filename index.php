<?php

require "config.php";

//insertion avec requête préparée

//$stmt = $pdo->prepare('insert into produits (id, nom, prix, stock) values(?,?,?,?);)');
//$produits = $stmt->execute($produits);


//Edition et suppression
//edit.php et delete.php

//<a href"edit.php"

$query = "SELECT * FROM `produits`";

//Execution de la requete
$stmt = $pdo->query($query);

//Recuperation des données (tableau associatif
$produits = $stmt->fetchAll(PDO::FETCH_ASSOC);

//print_r($auteurs);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<?php if (!empty($produits)):  ?>
    <table>
        <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>stock</th>
        </tr>
        </thead>
        <tbody>
        <!-- PHP -->
        <?php foreach ($produits as $p): ?>
            <tr>
                <td><?= htmlspecialchars($p['id']) ?></td>
                <td><?= htmlspecialchars($p['nom']) ?></td>
                <td><?= htmlspecialchars($p['prix']) ?></td>
                <td><?= htmlspecialchars($p['stock']) ?></td>
                <td> <a href="add.php?id=<?= $p['id'] ?>">Ajouter</a></td>
                <td> <a href="edit.php?id=<?= $p['id'] ?>">Modifier</a></td>
                <td> <a href="delete.php?id=<?= $p['id'] ?>">Supprimer</a></td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p>Aucun Produit</p>
<?php endif; ?>
</body>
</html>
