<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 12/02/2017
 * Time: 22:44
 */

session_start();
require_once '../db.php';
require_once '../vendor/autoload.php';
require_once __DIR__ .'./check_formulaire.php';
$db = new db();
$allContest = $db->getAllContest();

$allTattooWithInfo = $db->getAllTattooWithInfo();
?>


<!doctype html>
<html>
<head>
    <!-- Page Title -->
    <title>Admin | Concours photo Facebook</title>
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

<section id="section-galerie">
    <div class="container">
        <div class="row">
            <div class="form-horizontal">
                <fieldset>
                    <h2 class="title-settings">Tous les tatouages</h2>
                    <div class="tabcontest">
                        <div class="col-md-8 col-md-offset-0">
                            <form method="post" action="./tattooDelete.php">
                                <table border="1">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Mail</th>
                                        <th>Photo</th>
                                        <th>Concours</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                    foreach ($allTattooWithInfo as $tattooWithInfo){

                                        echo'<tr>';
                                        echo'<td>'.$tattooWithInfo['participant_surname'].'</td>';
                                        echo'<td>'.$tattooWithInfo['participant_name'].'</td>';
                                        echo'<td>'.$tattooWithInfo['participant_email'].'</td>';
                                        echo'<td>'.$tattooWithInfo['contest_name'].'</td>';
                                        echo'<td><img src='.$tattooWithInfo['link'].'></td>';
                                        echo'<td><input type="submit" name="delete"   onclick="return checkDelete()" style="background-color: #d34836;"value="Supprimer"></td>';
                                        echo'<td><input type="hidden" name="tattooId" value='.$tattooWithInfo['facebook_photos_id'].'></td>';
                                        echo'</tr>';
                                    }
                                    ?>
                                </table>
                            </form>

                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</section>
<script language="JavaScript" type="text/javascript">
    function checkDelete(){
        return confirm('Voulez vraiment supprimer cette photo ?');
    }
</script>
<!-- END OF FOOTER -->
<footer><?php require_once '../footer.php' ?></footer>
<!-- END OF FOOTER -->
</body>
</html>
