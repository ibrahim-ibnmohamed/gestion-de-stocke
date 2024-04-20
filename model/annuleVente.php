<?php
include 'connexion.php';

if (!empty($_GET['id_vente']) && !empty($_GET['id_article']) && !empty($_GET['quantite'])) {
    try {
        // Update vente table
        $sql = "UPDATE vente SET etat=? WHERE id=?";
        $req = $connexion->prepare($sql);
        $req->execute([0, $_GET['id_vente']]);

        // Check if the update was successful
        if ($req->rowCount() != 0) {
            // Update article table
            $sql = "UPDATE article SET quantite = quantite + ? WHERE id = ?";
            $req = $connexion->prepare($sql);
            $req->execute([$_GET['quantite'], $_GET['id_article']]);
        }
    } catch (PDOException $e) {
        // Handle any database errors
        echo "Error: " . $e->getMessage();
    }
}

// Redirect back to vente.php after processing
header('Location: ../vue/vente.php');
