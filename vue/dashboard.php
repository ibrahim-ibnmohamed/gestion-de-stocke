<?php
include 'header.php';
?>
<div class="home-content">
    <div class="overview-boxes">
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Commande</div>
                <div class="number"><?php echo getAllcommand()['nb'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bx-cart-alt cart"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Vente</div>
                <div class="number"><?php echo getAllvente()['nb'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bxs-cart-add cart two"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">Article</div>
                <div class="number"><?php echo getAllarticle()['nb'] ?></div>
                <div class="indicator">
                    <i class="bx bx-up-arrow-alt"></i>
                    <span class="text">Depuis hier</span>
                </div>
            </div>
            <i class="bx bx-cart cart three"></i>
        </div>
        <div class="box">
            <div class="right-side">
                <div class="box-topic">CA</div>
                <div class="number"><?php echo number_format(getCA()['prix'], 0, ',', ' ') ?></div>
                <div class="indicator">
                    <i class="bx bx-down-arrow-alt down"></i>
                    <span class="text">Aujourd'hui</span>
                </div>
            </div>
            <i class="bx bxs-cart-download cart four"></i>
        </div>
    </div>

    <div class="sales-boxes">
        <div class="recent-sales box">
            <div class="title">Vente recentes</div>
            <?php
            $ventes = getLastVente();
            ?>
            <div class="sales-details">
                <ul class="details">
                    <li class="topic">Date</li>

                    <?php
                    foreach ($ventes as $kay => $value) {
                    ?>

                        <li><a href="#"><?php echo date('d/m/y h:i:s', strtotime($value['date_vente']))  ?></a></li>
                    <?php

                    }
                    ?>

                </ul>
                <ul class="details">
                    <li class="topic">Client</li>
                    <?php
                    foreach ($ventes as $kay => $value) {
                    ?>

                        <li><a href="#"><?php echo $value['nom'] . " " . $value['prenom']  ?></a></li>
                    <?php

                    }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">Articles</li>
                    <?php
                    foreach ($ventes as $kay => $value) {
                    ?>

                        <li><a href="#"><?php echo $value['nom_article']  ?></a></li>
                    <?php

                    }
                    ?>
                </ul>
                <ul class="details">
                    <li class="topic">Prix</li>
                    <?php
                    foreach ($ventes as $kay => $value) {
                    ?>

                        <li><a href="#"><?php echo number_format($value['prix'], 0, ',', " ") . "€" ?></a></li>
                    <?php

                    }
                    ?>
                </ul>
            </div>
            <div class="button">
                <a href="#">Voir Tout</a>
            </div>
        </div>
        <div class="top-sales box">
            <div class="title">Articles le plus vendu</div>

            <?php
            $articles = getMostVente();
            foreach ($articles as $key => $value) {
            ?>
                <li>
                    <a href="#">
                        <!--<img src="images/sunglasses.jpg" alt="">-->
                        <span class="product"><?php echo isset($value['nom_article']) ? $value['nom_article'] : 'Nom non disponible'; ?></span>
                    </a>
                    <span class="price"><?php echo isset($value['prix']) ? number_format($value['prix'], 0, ',', " ") . "€" : 'Prix non disponible'; ?></span>
                </li>
            <?php
            }
            ?>
            </ul>
        </div>
    </div>
</div>
</section>
<?php
include 'footer.php'
?>