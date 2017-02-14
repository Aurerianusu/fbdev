<?php
session_start();

require_once './vendor/autoload.php';
require_once './db.php';

$db = new db();
$contest = $db->getActiveContest();
$db->initFb();

if (isset($_SESSION['email'])) {

    $participate = $db->checkIfParticipate($_SESSION['email']);
}

$allTattoo = $db->getTatooActiveContestLimit($contest['contest_id']);
var_dump($allTattoo);
?>
<!doctype html>
<html>
<head>
    <!-- Page Title -->
    <title>Concours photo Facebook</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="Concours photo Pardon-Maman"/>
    <meta name="description"
          content="Participez au concours photo Pardon-maman et tentez de remporter un tattouage gratuit">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="Pardon-Maman">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require './header.php'; ?>
</head>

<body>
<!-- HEADER -->
<header>
    <?php require './menus.php' ?>
</header>
<!-- END OF HEADER -->

<!-- CONTENT -->
<!-- BLOC 1 -->
<section id="section-accueil">
    <div class="container">
        <h1 style="font-size: 31px;">
            <?php echo $contest['contest_prize']; ?>
        </h1>
        <div class="row">
            <div class="col-sm-4 col-xs-12">
                <img src="<?php echo $contest['contest_image']; ?>" alt="" class="img-thumbnail img-responsive">
            </div>

            <div class="col-sm-8 col-xs-12 text-left" id="description">
                <p><?php echo $contest['contest_home']; ?></p>
                <p><?php echo $contest['contest_rules']; ?></p>
                <p><?php include './login.php'; ?></p>
            </div>
        </div>
    </div>
</section>
<!-- END OF CONTENT -->

<!-- BLOC 2 -->
<section id="section-tatouages">
    <div class="container">
        <p>Tatouages populaires</p>
        <div class="row">
            <?php
            foreach ($allTattoo as $tattoo) {
                ?>
                <div class="col-sm-3 col-xs-6">
                    <img class="popular" src="<?php echo $tattoo['link']?>"/>
                    <div>
                        <a href="like.php?id=<?php echo $tattoo['facebook_photos_id'];?>">like</a>
                    </div>
                </div>
                <?php
            }
            ?>

        </div>

        <div class="row">
            <div class="col-sm-12 col-xs-12 text-center">
                <a href="galerie.php" class="btn btn-lg btn-primary send_button">
                    <span class="glyphicon glyphicon-th"></span>
                    Voir tous les tatouages...
                </a>
            </div>
        </div>

    </div>
</section>
<!-- END OF CONTENT -->

<!-- FOOTER -->
<footer class="footer">
    <?php require './footer.php' ?>
</footer>
<!-- END OF FOOTER -->

</body>

</html>