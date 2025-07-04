<?php
include 'connexion.php';

if (
    !empty($_POST['nom'])
    && !empty($_POST['prenom'])
    && !empty($_POST['telephone'])
    && !empty($_POST['adresse'])

) {
    $sql = "INSERT INTO client(nom, prenom, telephone, adresse) 
    VALUES (?, ?, ?, ?)";
    $req = $connexion->prepare($sql);
    $req->execute(array(
        $_POST['nom'],
        $_POST['prenom'],
        $_POST['telephone'],
        $_POST['adresse']
    ));

    if ($req->rowCount() != 0) {
        $_SESSION['message']['text'] = "Client ajouté avec succès.";
        $_SESSION['message']['type'] = 'success';
    } else {
        $_SESSION['message']['text'] = "Erreur : L'ajout de Client a échoué.";
        $_SESSION['message']['type'] = 'danger';

        die();
    }
} else {
    $_SESSION['message']['text'] = "Une information obligatoire n'est pas renseignée.";
    $_SESSION['message']['type'] = 'danger';
}

header('Location: ../vue/client.php');
