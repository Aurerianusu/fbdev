<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 06/02/2017
 * Time: 14:16
 */
define('__ROOT__', dirname(dirname(__FILE__)));
require_once(__ROOT__.'/fbdev/bddConnect.php');

var_dump($_POST);
?>
<!doctype html>
<html>
<head>
    <?php session_start(); ?>
    <!-- Page Title -->
    <title>Confirmation</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="Concours photo Pardon-Maman" />
    <meta name="description" content="Participez au concours photo Pardon-maman et tentez de remporter un tattouage gratuit">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="Pardon-Maman">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require 'header.php';?>
</head>

<body>
<!-- HEADER -->
<header>
    <?php require './menus.php' ?>
</header>
<!-- END OF HEADER -->

<!-- CONTENT -->
<!-- BLOC 1 -->
<?php

    // Our database object
    $db = new Db();

    // Quote and escape form submitted values
    $lastName = $db->quote($_POST['lastName']);
    $firstName = $db->quote($_POST['firstName']);
    $email = $db->quote($_POST['email']);
    $birthday = $db->quote($_POST['birthday']);

    // Insert the values into the database
    $result = $db->query("INSERT INTO 'participant' ('participant_name','participant_surname','participant_email','birthdate_participant') VALUES (" . $lastName . ",". $firstName . "," . $email . "," . $birthday . ")");


?>
<section id="section-accueil">
    <div class="container">
        <h1 style="font-size: 31px;">Confirmer votre participation</h1>
        <div class="row">
            <div class="col-sm-6 col-xs-6 text-center">
                Vous<br>
                <img src="<?php echo $_POST['profilPic'];?>" alt="" class="img-thumbnail img-responsive">
            </div>
            <div class="col-sm-6 col-xs-6 text-center">
                Votre tatouage<br>
                <img src="<?php echo $_POST['monImage'];?>" alt="" class="img-thumbnail img-responsive">
            </div>
        </div>
        <div class="row">
            <form method="post" action="index.php">
                <div class="col-sm-12 col-xs-12 text-center">
                    <input type="submit" class="btn btn-lg btn-success" id="valid">
                </div>
            </form>
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
