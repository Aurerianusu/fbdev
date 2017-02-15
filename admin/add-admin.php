<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 14/02/2017
 * Time: 15:32
 */

require_once './dependency.php';
require_once './check-admin-formulaire.php';

$db = new db();
$fb = $db->initFb();
?>

<!doctype html>
<html>
<head>
    <!-- Page Title -->
    <title>Ajout admin | Admin</title>
    <!-- Meta Tags -->
    <meta charset="utf-8">
    <meta name="keywords" content="Concours photo Pardon-Maman" />
    <meta name="description" content="Ici le panneaux d'administration du jeu concours Pardon-maman dans cette section.">
    <meta name="format-detection" content="telephone=no">
    <meta name="author" content="Pardon-Maman">
    <meta name="robots" content="noindex,nofollow">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php require '../header.php' ?>
</head>

<body>
<!-- HEADER -->
<header>
    <?php require '../menus.php' ?>
</header>
<!-- END OF HEADER -->

<!-- CONTENT -->
<section id="section-galerie">
    <div class="container">
        <div class="row">
            <div class="col-sm-2 col-xs-2" style="display: inline-flex;">
                <img src="../public/images/settings.png" style="margin-top:10px;float:left;margin-bottom:10px;" />
                <h1 style="margin-top:25px;margin-left:15px;">Administration</h1>
            </div>
        </div>
    </div>
</section>

<form method="post" enctype="multipart/form-data">
    <section id="section-galerie">
        <div class="container">
            <div class="row">
                <div class="form-horizontal">
                    <fieldset>
                        <h2 class="title-settings">Ajouter un administrateur</h2>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="name">Nom</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="name" value="<?php echo (isset($_POST['name']))?$_POST['name']:"";?>" rows="11">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="surname">Prenom</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="surname" value="<?php echo (isset($_POST['surname']))?$_POST['surname']:"";?>" rows="11">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label" for="surname">Adresse mail*</label>
                            <div class="col-md-4">
                                <input type="text" class="form-control" name="email" value="<?php echo (isset($_POST['email']))?$_POST['email']:"";?>" rows="11">
                            </div>
                            <br>
                            <p>*Doit être l'email du compte facebook</p>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container" style="margin-bottom: 40px;">
            <div class="row">
                <div class="col-md-2 col-md-offset-5">
                    <button type="submit" name="save"  class="btn-lg btn-primary">Sauvegarder</button>
                </div>
            </div>
        </div>
    </section>
</form>
<!-- END OF FOOTER -->
<footer><?php require_once '../footer.php' ?></footer>
<!-- END OF FOOTER -->
</body>
</html>
