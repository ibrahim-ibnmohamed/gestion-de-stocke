<?php
include 'connexion.php';
include_once "function.php"; // Ajout du point-virgule et correction du nom du fichier

if (
    !empty($_POST['id_article'])
    && !empty($_POST['id_client'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])
) {
    $article = getArticle($_POST['id_article']); // Correction de la fonction getArticle

    if (!empty($article) && is_array($article)) {
        if ($_POST['quantite'] > $article['quantite']) {
            $_SESSION['message']['text'] = "Article n'est plus disponible.";
            $_SESSION['message']['type'] = 'danger';
        } else {
            $sql = "INSERT INTO vente(id_article, id_client, quantite, prix) 
                    VALUES (?, ?, ?, ?)";
            $req = $connexion->prepare($sql);
            $req->execute(array(
                $_POST['id_article'],
                $_POST['id_client'],
                $_POST['quantite'],
                $_POST['prix']
            ));

            if ($req->rowCount() != 0) {

                $sql = "UPDATE article SET quantite = quantite - ? WHERE id = ? "; // Correction de la requête SQL
                $req = $connexion->prepare($sql);
                $req->execute(array(
                    $_POST['quantite'], // Correction de la variable utilisée ici
                    $_POST['id_article']
                ));

                if ($req->rowCount() != 0) {
                    $_SESSION['message']['text'] = "Vente effectuée avec succès.";
                    $_SESSION['message']['type'] = 'success';
                } else {
                    $_SESSION['message']['text'] = "Erreur : opération impossible.";
                    $_SESSION['message']['type'] = 'danger';
                }
            } else {
                $_SESSION['message']['text'] = "Erreur : une erreur est survenue.";
                $_SESSION['message']['type'] = 'danger';
            }
        }
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée.";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../vue/vente.php');
