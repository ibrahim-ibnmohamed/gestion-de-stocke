<?php
include 'header.php';

if (!empty($_GET['id'])) {
    $client = getClient($_GET['id']);
}
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <form action="<?= !empty($_GET['id']) ? "../model/modifClient.php" : "../model/ajoutClient.php" ?>" method="post">
                <label for="nom"> Nom : </label>
                <input value="<?= !empty($_GET['id']) ? $client['nom'] : "" ?>" type="text" name="nom" id="nom" placeholder=" Veuillez saisire le nom de Client">
                <input value="<?= !empty($_GET['id']) ? $client['id'] : "" ?>" type="hidden" name="id" id="id">

                <label for="prenom"> Prenom de Client : </label>
                <input value="<?= !empty($_GET['id']) ? $client['prenom'] : "" ?>" type="text" name="prenom" id="prenom" placeholder=" Veuillez saisire le prenom de Client">

                <label for="telephon"> N° de Téléphone : </label>
                <input value="<?= !empty($_GET['id']) ? $client['telephone'] : "" ?>" type="text" name="telephone" id="telephone" placeholder=" Veuillez saisire le numéro de Client">

                <label for="adresse"> Adresse: </label>
                <input value="<?= !empty($_GET['id']) ? $client['adresse'] : "" ?>" type="text" name="adresse" id="adresse" placeholder=" Veuillez saisire l'adresse de Client">



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
                    <th>Nom de Client</th>
                    <th>Prenom de Client </th>
                    <th>n° de Téléphone</th>
                    <th>Adresse </th>
                    <th>Action</th>

                </tr>
                <?php
                $clients = getClient();
                if (!empty($clients) && is_array($clients)) {
                    foreach ($clients as $key => $value) {
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