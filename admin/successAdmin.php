<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 11/02/2017
 * Time: 20:01
 */
session_start();
?>
<!doctype html>
<html>
<head>
    <!-- Page Title -->
    <title>Création réussi | Concours photo Facebook</title>

    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="Concours photo Pardon-Maman" />
    <meta name="description" content="Participez au concours photo Pardon-maman et tentez de remporter un tattouage gratuit">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="Pardon-Maman">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="refresh" content="5 ; url=admin.php">
    <?php require '../header.php';?>
</head>

<body>
<!-- HEADER -->
<header>
    <?php require '../menus.php' ?>
</header>
<!-- END OF HEADER -->

<!-- CONTENT -->
<section id="section-accueil">
    <div class="container">
        <p>Votre concours a été créé !</p>
        <br><br>
        <p>Vous allez être redirigé dans quelques instant</p>
        <p> Si vous n'etes pas automatiquelent redirigé, veuillez cliquer <a href="create-contest.php">ici</a></p>
    </div>

</section>
<!-- END OF CONTENT -->
<!-- FOOTER -->
<footer class="footer">
    <?php require '../footer.php' ?>
</footer>
<!-- END OF FOOTER -->
</body>
</html>
