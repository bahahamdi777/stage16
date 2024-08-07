<?php
//  recevoir le noutilisateur sent by login1.php

if (!isset($_GET['noUtilisateur'])) {
    echo "Utilisateur non authentifié.";
    exit();
}

$noUtilisateur = intval($_GET['noUtilisateur']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Client Page</title>
    <style>
        body { 
            background-color: rgb(91, 139, 139);
        }
        /* .container {
            margin-top: 50px;
        } */
    </style>
</head>

<body>

    <?php include "navbar2.php"; ?>

    <div class="container">
        <h1>Bienvenue, Client!</h1>
        <h3>Voici vos commandes:</h3>

        <div id="error" style="color: red;"></div>

        <table class="table">
            <thead>
                <tr>
                    <th>Code</th>
                    <th>Status</th>
                    <th>Nom Complet</th>
                    <th>Gouvernerat</th>
                    <th>Delegation</th>
                    <th>Localité</th>
                    <th>Adresse Complémentaire</th>
                    <th>Téléphone</th>
                    <th>Téléphone 2</th>
                    <th>Désignation</th>
                    <th>Nombre d'Articles</th>
                    <th>Prix</th>
                    <th>Commentaire</th>
                    <th>Action</th>






                </tr>
            </thead>
            <tbody id="commande-table-body"></tbody>
        </table>
    </div>

    <script>
        async function fetchData() {
            const noUtilisateur = <?= json_encode($noUtilisateur); ?>; 
            try {
                const response = await fetch(`clientHistorique.php?noUtilisateur=${noUtilisateur}`);
                const data = await response.json();

                if (data.error) {
                    document.getElementById('error').innerText = data.error;
                    return;
                }

                let commandeTableContent = '';
                data.commandes.forEach(commande => {
                    commandeTableContent += `
                        <tr>
                            <td>${commande.code}</td>
                            <td>${commande.status}</td>
                            <td>${commande.nom_complet}</td>

                             <td>${commande.gouvernerat}</td>
                            <td>${commande.delegation}</td>
                            <td>${commande.localite}</td>
                            <td>${commande.adresse_complementaire}</td>
                            <td>${commande.telephone}</td>
                            <td>${commande.telephone2 || ''}</td>
                            <td>${commande.designation}</td>
                            <td>${commande.nombre_article}</td>
                            <td>${commande.prix}</td>
                            <td>${commande.commentaire || ''}</td>







                            <td>
                                <a href="editComUser.php?code=${commande.code}" class="btn btn-danger">Modifier</a>
                                <button type="button" class="btn btn-success mt-2 mb-2" onclick="deleteCommande(${commande.code})">Supprimer</button>
                             </td>




                            </td>
                        </tr>
                    `;
                });
                document.getElementById('commande-table-body').innerHTML = commandeTableContent;

            } catch (error) {
                document.getElementById('error').innerText = 'Erreur lors de la récupération des données de commande.';
            }
        }

        window.onload = fetchData;
    </script>
</body>
</html>
