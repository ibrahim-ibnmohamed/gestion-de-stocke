<?php
session_start(); // Démarre la session

include 'connexion.php'; // Inclut le fichier de connexion à la base de données

if (!empty($_POST['libelle_categorie']) && !empty($_POST['id'])) {
    try {
        // Préparation de la requête SQL
        $sql = "UPDATE categorie_article SET libelle_categorie=? WHERE id=?";
        $req = $connexion->prepare($sql);

        // Exécution de la requête avec les données fournies
        $req->execute(array(
            $_POST['libelle_categorie'],
            $_POST['id']
        ));

        // Vérifie si la mise à jour a affecté des lignes
        if ($req->rowCount() > 0) {
            $_SESSION['message'] = array(
                'text' => "La catégorie a été modifiée avec succès.",
                'type' => 'success'
            );
        } else {
            $_SESSION['message'] = array(
                'text' => "Aucune modification effectuée pour cette catégorie.",
                'type' => 'warning'
            );
        }
    } catch (PDOException $e) {
        // Gestion des erreurs SQL
        $_SESSION['message'] = array(
            'text' => "Erreur lors de la modification de la catégorie : " . $e->getMessage(),
            'type' => 'danger'
        );
    }
} else {
    $_SESSION['message'] = array(
        'text' => "Veuillez remplir tous les champs obligatoires.",
        'type' => 'danger'
    );
}

// Redirection vers la page de catégorie
header('Location: ../vue/categorie.php');
exit(); // Termine l'exécution du script
