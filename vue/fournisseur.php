<?php
include 'header.php';

if (!empty($_GET['id'])) {
    $fournisseur = getFournisseur($_GET['id']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifFournisseur.php" : "../model/ajoutFournisseur.php" ?>" method="post">

                <label for="nom"> Nom : </label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder=" Veuillez saisire le nom de fournisseur">
                <input value="<?= !empty($_GET['id']) ? $fournisseur['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="prenom"> Prenom de fournisseur : </label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder=" Veuillez saisire le prenom de fournisseur">

                <label for="telephon"> N° de Téléphone : </label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder=" Veuillez saisire le numéro de fournisseur">

                <label for="adresse"> Adresse: </label>
                <input value="<?= !empty($_GET['id']) ? $fournisseur['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder=" Veuillez saisire l'adresse de fournisseur">



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
                    <th>Nom de fournisseur</th>
                    <th>Prenom de fournisseur </th>
                    <th>n° de Téléphone</th>
                    <th>Adresse </th>
                    <th>Action</th>

                </tr>
                <?php
                $fournisseurs = getFournisseur();
                if (!empty($fournisseurs) && is_array($fournisseurs)) {
                    foreach ($fournisseurs as $key => $value) {
                ?>
                        <tr>
                            <td> <?= $value['nom'] ?> </td>
                            <td> <?= $value['prenom'] ?> </td>
                            <td> <?= $value['telephone'] ?> </td>
                            <td> <?= $value['adresse'] ?> </td>
                            <td> <a href="?id= <?= $value['id'] ?> "><i class='bx bx-edit-alt'></i></a></td>
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