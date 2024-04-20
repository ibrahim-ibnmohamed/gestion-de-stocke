<?php
include 'header.php';

if (!empty($_GET['id'])) {
    $vente = getVente($_GET['id']);
}
?>
<div class="home-content">

    <button class="hidden-print" id="btnPrint"> <i class='bx bx-printer'></i> Imprimer</button>
    <div class="page">
        <div class="cote-a-cote">
            <h2>IBN Stock</h2>
            <div>
                <p>Reçu N° : <?= $vente['id'] ?> </p>
                <p>Date de <?= date('d/m/y h:i:s', strtotime($vente['date_vente']))  ?> </p>
            </div>

        </div>
        <div class="cote-a-cote" style="width: 44%">
            <p>Nom : </p>
            <p><?= $vente['nom'] . " " . $vente['prenom'] ?></p>
        </div>
        <div class="cote-a-cote" style="width: 31%">
            <p>Téléphone: </p>
            <p><?= $vente['telephone']  ?></p>
        </div>
        <div class="cote-a-cote" style="width: 60%">
            <p>Adresse: </p>
            <p><?= $vente['adresse']  ?></p>
        </div>
        <br>
        <table class="mtable">
            <tr>
                <th>Designation</th>
                <th>Quantité</th>
                <th>Prix Unitaire (€)</th>
                <th>Total (€)</th>
            </tr>


            <tr>
                <td> <?= $vente['nom_article'] ?> </td>
                <td> <?= $vente['quantite'] ?> </td>
                <td> <?= $vente['prix_unitaire'] ?> </td>
                <td> <?= $vente['prix'] ?> </td>
            </tr>

        </table>

    </div>
</div>
</div>
</section>
<?php
include 'footer.php'
?>
<script>
    var btnPrint = document.querySelector('#btnPrint');
    btnPrint.addEventListener("click", () => {
        window.print();
    });

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