<?php
include 'connexion.php';

if (
    !empty($_POST['nom_article'])
    && !empty($_POST['id_categorie'])
    && !empty($_POST['quantite'])
    && !empty($_POST['prix_unitaire'])
    && !empty($_POST['date_fabrication'])
    && !empty($_POST['date_expiration'])
    && !empty($_POST['id'])
) {
    $sql = "UPDATE article SET nom_article=?, id_categorie=?, quantite=?, prix_unitaire=?, date_fabrication=?, date_expiration=? WHERE id=?";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nom_article'],
        $_POST['id_categorie'],
        $_POST['quantite'],
        $_POST['prix_unitaire'],
        $_POST['date_fabrication'],
        $_POST['date_expiration'],
        $_POST['id']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Article modifé avec succès.";
        $_SESSION['message']['type'] = 'success';
    } else {
        $_SESSION['message']['text'] = "Erreur : modifecation de l'article a échoué.";
        $_SESSION['message']['type'] = 'warning';
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée.";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../vue/article.php');
