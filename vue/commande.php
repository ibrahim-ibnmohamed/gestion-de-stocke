<?php
include 'header.php';

if (!empty($_GET['id'])) {
    $article = getCommande($_GET['id']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifCommande.php" : "../model/ajoutCommande.php" ?>" method="post">

                <input value="<?= !empty($_GET['id']) ? $article['id'] : "" ?>" type="hidden" name="id" id="id">
                <label for="id_article"> Articles</label>
                <select name="id_article" id="id_article" placeholder=" Veuillez saisire le nom d'article">
                    <?php
                    $articles = getArticle(); // Correction ici, utilisez $articles au lieu de $article
                    if (!empty($articles) && is_array($articles)) {
                        foreach ($articles as $key => $value) {
                    ?>
                            <option data-prix="<?= $value['prix_unitaire'] ?>" value="<?= $value['id'] ?>"><?= $value['nom_article'] . " _ " . $value['quantite'] . " Disponible" ?></option>
                    <?php
                        }
                    }
                    ?>

                </select>

                <label for="id_fournisseur"> Fournisseur</label>
                <select name="id_fournisseur" id="id_fournisseur" placeholder=" Veuillez saisire le nom de fournisseur">
                    <?php
                    $fournisseurs = getFournisseur(); // Correction ici, utilisez $articles au lieu de $article
                    if (!empty($fournisseurs) && is_array($fournisseurs)) {
                        foreach ($fournisseurs as $key => $value) {
                    ?>
                            <option value="<?= $value['id'] ?>"><?= $value['nom'] . " _ " . $value['prenom'] ?></option>
                    <?php
                        }
                    }
                    ?>

                </select>

                <label for="quantite">Quantité</label>
                <input onkeyup="setPrix()" value="<?= !empty($_GET['id']) ? $article['quantite'] : "" ?>" type="number" name="quantite" id="quantite" placeholder=" Veuillez saisire la quntité">

                <label for="prix">Prix Unitaire</label>
                <input value="<?= !empty($_GET['id']) ? $article['prix'] : "" ?>" type="number" name="prix" id="prix" placeholder=" Veuillez saisire la Prix">



                <button type="submit"> Valider </button>
                <?php
                if (!empty($_SESSION['message']['text'])) {
                ?>
                    <div class="alert <?= $_SESSION['message']['type'] ?>">
                        <?= $_SESSION['message']['text'] ?>
                    </div>
                <?php
                    unset($_SESSION['message']);
                }
                ?>
            </form>
        </div>
        <div class="box">
            <table class="mtable">
                <tr>
                    <th>Nom de l'Article</th>
                    <th>nom du Fournisseur</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Date</th>


                </tr>
                <?php
                $commande = getCommande();
                if (!empty($commande) && is_array($commande)) {
                    foreach ($commande as $key => $value) {
                ?>
                        <tr>
                            <td> <?= $value['nom_article'] ?> </td>
                            <td> <?= $value['nom'] . " " . $value['prenom'] ?> </td>
                            <td> <?= $value['quantite'] ?> </td>
                            <td> <?= $value['prix'] ?> </td>
                            <td> <?= date('d/m/y h:i:s', strtotime($value['date_commande']))  ?></td>
                            <td> <a href="recuCommande.php?id=<?= $value['id'] ?>"><i class='bx bx-receipt'></i></a>
                                <a onclick="annuleCommande(<?= $value['id'] ?>,<?= $value['id_article'] ?>,<?= $value['quantite'] ?>)" style="color:red;"><i class='bx bx-x'></i></a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>

        </div>
    </div>
</div>
</section>
<?php
include 'footer.php'
?>
<script>
    function annuleCommande(id_commande, id_article, quantite) {
        if (confirm("Voulez-vous vraiment annuler cette commande ?")) {
            window.location.href = " ../model/annuleCommande.php?id_commande=" + id_commande + "&id_article=" + id_article + "&quantite=" + quantite
        }
    }

    function setPrix() {
        var article = document.querySelector('#id_article');
        var quantite = document.querySelector('#quantite');
        var prix = document.querySelector('#prix');

        // Récupérer le prix unitaire de l'article sélectionné
        var prixUnitaire = article.options[article.selectedIndex].getAttribute('data-prix');

        // Calculer le prix total en multipliant la quantité par le prix unitaire
        prix.value = Number(quantite.value) * Number(prixUnitaire);
    }
</script>