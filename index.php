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
        <style>
            body {
                font-family: Arial, sans-serif;
                background-color: #F5F5DC; /* Beige */
                color: #333;
                margin: 0;
                padding: 0;
            }

            table {
                width: 80%;
                margin: 20px auto;
                border-collapse: collapse;
                background-color: #ffffff; /* Blanc pour les cellules */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            }

            th, td {
                padding: 10px;
                text-align: left;
                border: 1px solid #ddd;
            }

            th {
                background-color: #B22222; /* Rouge */
                color: white;
            }

            tr:nth-child(even) {
                background-color: #f2f2f2;
            }

            a {
                color: #00CED1; /* Bleu cyan */
                text-decoration: none;
            }

            a:hover {
                text-decoration: underline;
            }

            button {
                display: block;
                margin: 20px auto;
                padding: 10px 20px;
                background-color: #B22222; /* Rouge */
                color: white;
                border: none;
                font-size: 16px;
                cursor: pointer;
                border-radius: 5px;
            }

            button a {
                color: white;
                text-decoration: none;
            }

            button:hover {
                background-color: #8B0000; /* Rouge foncé */
            }

            p {
                text-align: center;
                font-size: 18px;
                color: #B22222; /* Rouge */
            }
            </style>
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
                    <td> <a href="edit.php?id=<?= $p['id'] ?>">Modifier</a></td>
                    <td> <a href="delete.php?id=<?= $p['id'] ?>">Supprimer</a></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
            <button><a href="add.php?id=<?= $p['id'] ?>">Ajouter un nouveau produit</a></button>
    <?php else: ?>
        <p>Aucun Produit</p>
    <?php endif; ?>
    </body>
    </html>
