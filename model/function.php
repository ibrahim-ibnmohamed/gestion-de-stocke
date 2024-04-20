<?php
include 'connexion.php'; // Corrected the inclusion of the connection file

function getArticle($id = null, $searchDATA = array())
{
    if (!empty($id)) {
        $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite, a.prix_unitaire, a.date_fabrication, a.date_expiration, a.id_categorie, images
                FROM article AS a
                INNER JOIN categorie_article AS c ON c.id = a.id_categorie
                WHERE a.id = ?";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute(array($id));
        return $req->fetch();
    } elseif (!empty($searchDATA)) {
        $search = "";
        $params = array();
        extract($searchDATA);
        if (!empty($nom_article)) {
            $search .= " AND a.nom_article LIKE ?";
            $params[] = "%$nom_article%";
        }

        if (!empty($id_categorie)) {
            $search .= " AND a.id_categorie = ?";
            $params[] = $id_categorie;
        }

        if (!empty($quantite)) {
            $search .= " AND a.quantite LIKE ?";
            $params[] = $quantite;
        }

        if (!empty($prix_unitaire)) {
            $search .= " AND a.prix_unitaire LIKE ?";
            $params[] = $prix_unitaire;
        }

        if (!empty($date_fabrication)) {
            $search .= " AND DATE(a.date_fabrication) = ?";
            $params[] = $date_fabrication;
        }

        if (!empty($date_expiration)) {
            $search .= " AND DATE(a.date_expiration) = ?";
            $params[] = $date_expiration;
        }

        $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite, a.prix_unitaire, a.date_fabrication, a.date_expiration, a.id_categorie, images
                FROM article AS a
                INNER JOIN categorie_article AS c ON c.id = a.id_categorie 
                WHERE 1=1 $search";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute($params);
        return $req->fetchAll();
    } else {
        $sql = "SELECT a.id, a.nom_article, c.libelle_categorie, a.quantite, a.prix_unitaire, a.date_fabrication, a.date_expiration, a.id_categorie, images
                FROM article AS a
                INNER JOIN categorie_article AS c ON c.id = a.id_categorie";

        $req = $GLOBALS['connexion']->prepare($sql);
        $req->execute();
        return $req->fetchAll();
    }
}



function getClient($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM client WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(array($id)); // Corrected method name

        return $req->fetch();
    } else {
        // Corrected function name
        $sql = "SELECT * FROM client";
        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(); // Corrected method name
        return $req->fetchAll();
    }
}

function getVente($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article,nom,prenom,v.quantite,prix, date_vente, v.id, prix_unitaire, adresse,telephone 
        FROM client as c ,vente as v,article as a WHERE v.id_article=a.id and v.id_client=c.id and v.id=? AND etat=?";

        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(array($id, 1)); // Corrected method name

        return $req->fetch();
    } else {
        // Corrected function name
        $sql = "SELECT nom_article,nom,prenom,v.quantite,prix,date_vente, v.id, a.id AS id_article
         FROM client as c ,vente as v,article as a WHERE v.id_article=a.id and v.id_client=c.id AND etat=?";
        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(array(1)); // Corrected method name
        return $req->fetchAll();
    }
}

function getFournisseur($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM fournisseur WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(array($id)); // Corrected method name

        return $req->fetch();
    } else {
        // Corrected function name
        $sql = "SELECT * FROM fournisseur";
        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(); // Corrected method name
        return $req->fetchAll();
    }
}

function getCommande($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT nom_article,nom,prenom,co.quantite,prix, date_commande, co.id, prix_unitaire, adresse,telephone 
        FROM fournisseur as f,commande as co,article as a WHERE co.id_article=a.id and co.id_fournisseur=f.id and co.id=? ";

        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(array($id)); // Corrected method name

        return $req->fetch();
    } else {
        // Corrected function name
        $sql = "SELECT nom_article,nom,prenom,co.quantite,prix,date_commande, co.id, a.id AS id_article
         FROM fournisseur as f,commande as co,article as a WHERE co.id_article=a.id and co.id_fournisseur=f.id";
        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(); // Corrected method name
        return $req->fetchAll();
    }
}
function getAllcommand()
{
    $sql = "SELECT COUNT(*) AS nb FROM commande"; // corrected the SQL syntax
    $req = $GLOBALS['connexion']->prepare($sql); // corrected the variable name and used the correct method name
    $req->execute(); // corrected method name

    return $req->fetch();
}

function getAllvente()
{
    $sql = "SELECT COUNT(*) AS nb FROM vente WHERE etat=?"; // corrected the SQL syntax
    $req = $GLOBALS['connexion']->prepare($sql); // corrected the variable name and used the correct method name
    $req->execute(array(1)); // corrected method name

    return $req->fetch();
}

function getAllarticle()
{
    $sql = "SELECT COUNT(*) AS nb FROM article"; // corrected the SQL syntax
    $req = $GLOBALS['connexion']->prepare($sql); // corrected the variable name and used the correct method name
    $req->execute(); // corrected method name

    return $req->fetch();
}
function getCA()
{
    $sql = "SELECT SUM(prix) AS prix FROM vente"; // corrected the SQL syntax
    $req = $GLOBALS['connexion']->prepare($sql); // corrected the variable name and used the correct method name
    $req->execute(); // corrected method name

    return $req->fetch();
}

function getLastVente()
{
    $sql = "SELECT nom_article, nom, prenom, v.quantite, prix, date_vente, v.id, prix_unitaire, adresse, telephone 
            FROM client AS c, vente AS v, article AS a 
            WHERE v.id_article = a.id AND v.id_client = c.id AND etat = ?
            ORDER BY date_vente DESC LIMIT 10";

    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array(1)); // En supposant que etat = 1 pour la condition

    return $req->fetchAll();
}
function getMostVente()

{
    $sql = "SELECT nom_article, SUM(prix) AS prix
    FROM client AS c, vente AS v, article AS a 
    WHERE v.id_article = a.id AND v.id_client = c.id AND etat = ?
    GROUP BY a.id
    ORDER BY SUM(prix) DESC LIMIT 10";


    $req = $GLOBALS['connexion']->prepare($sql);
    $req->execute(array(1)); // En supposant que etat = 1 pour la condition

    return $req->fetchAll();
}
function getCategorie($id = null)
{
    if (!empty($id)) {
        $sql = "SELECT * FROM categorie_article WHERE id=?";

        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(array($id)); // Corrected method name

        return $req->fetch();
    } else {
        // Corrected function name
        $sql = "SELECT * FROM categorie_article";
        $req = $GLOBALS['connexion']->prepare($sql); // Corrected the variable name and used the correct method name
        $req->execute(); // Corrected method name
        return $req->fetchAll();
    }
}
