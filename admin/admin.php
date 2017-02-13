<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 12/02/2017
 * Time: 22:13
 */

session_start();
require_once '../db.php';
require_once '../vendor/autoload.php';
require_once __DIR__ .'./check_formulaire.php';
$db = new db();
$allContest = $db->getAllContest();

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
                    <h2 class="title-settings">Concours</h2>
                    <div>
                        <div class="col-md-4 col-md-offset-4">
                           <a href="create-contest.php">Créer un concour</a>
                        </div>
                    </div>
                    <div class="tabcontest">
                        <div class="col-md-12 col-md-offset-0">
                            <form method="post" action="scriptDelete.php">
                                <table border="1">
                                    <tr>
                                        <th>Nom</th>
                                        <th>Date début</th>
                                        <th>Date fin</th>
                                        <th>Prix</th>
                                        <th>Image prix</th>
                                        <th>Active</th>
                                        <th></th>
                                    </tr>
                                    <?php
                                        foreach ($allContest as $contest){

                                            if($contest['is_active'] == 1){
                                                $contest['is_active'] = 'oui';
                                            }else{
                                                $contest['is_active'] = 'non';
                                            }

                                            echo'<tr>';
                                            echo'<td>'.$contest['contest_name'].'</td>';
                                            echo'<td>'.$contest['contest_begin_date'].'</td>';
                                            echo'<td>'.$contest['contest_end_date'].'</td>';
                                            echo'<td>'.$contest['contest_prize'].'</td>';
                                            echo'<td><img src=../'.$contest['contest_image'].' style="width: 150px"></td>';
                                            echo'<td>'.$contest['is_active'].'</td>';
                                            echo'<td><input type="submit" name="delete" style="background-color: #d34836;"value="Supprimer"></td>';
                                            echo'<td><input type="hidden" name="contestId" value='.$contest['contest_id'].'></td>';
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
<section id="section-galerie">
    <div class="container">
        <div class="row">
            <div class="form-horizontal">
                <fieldset>
                    <h2 class="title-settings">Photos des participants</h2>
                    <div class="form-group">
                        <div class="col-md-4">
                            <a href="all-tattoo.php">Tous les tatouages</a>
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
</section>
<!-- END OF FOOTER -->
<footer><?php require_once '../footer.php' ?></footer>
<!-- END OF FOOTER -->
</body>
</html>