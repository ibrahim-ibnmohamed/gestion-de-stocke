<?php
include 'connexion.php';
include_once "function.php"; // Ajout du point-virgule et correction du nom du fichier

if (
    !empty($_POST['id_article'])
    && !empty($_POST['id_fournisseur'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix'])
) {

    $sql = "INSERT INTO commande(id_article, id_fournisseur, quantite, prix, date_commande) 
                    VALUES (?, ?, ?, ?, NOW())"; // Ajout de la date actuelle avec NOW()
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['id_article'],
        $_POST['id_fournisseur'],
        $_POST['quantite'],
        $_POST['prix']
    ));

    if ($req->rowCount() != 0) {

        $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ? "; // Correction de la requête SQL
        $req = $connexion->prepare($sql);
        $req->execute(array(
            $_POST['quantite'], // Correction de la variable utilisée ici
            $_POST['id_article']
        ));

        if ($req->rowCount() != 0) {
            $_SESSION['message']['text'] = "Commande effectuée avec succès.";
            $_SESSION['message']['type'] = 'success';
        } else {
            $_SESSION['message']['text'] = "Erreur : opération impossible.";
            $_SESSION['message']['type'] = 'danger';
        }
    } else {
        $_SESSION['message']['text'] = "Erreur : une erreur est survenue.";
        $_SESSION['message']['type'] = 'danger';
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée.";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../vue/commande.php');
