<?php
include 'connexion.php';

if (
    !empty($_POST['libelle_categorie'])

) {
    $sql = " INSERT INTO categorie_article(libelle_categorie) 
    VALUES (?)";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['libelle_categorie']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Categorie ajouté avec succès.";
        $_SESSION['message']['type'] = 'success';
    } else {
        $_SESSION['message']['text'] = "Erreur : L'ajout de categorie a échoué.";
        $_SESSION['message']['type'] = 'danger';

        die();
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée.";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../vue/categorie.php');
