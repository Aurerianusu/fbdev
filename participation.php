<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 25/01/2017
 * Time: 16:37
 */

session_start();
require_once __DIR__.'/vendor/autoload.php';
    $fb = new Facebook\Facebook([
        'app_id' => '276539519413614',
        'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
        'default_graph_version' => 'v2.5',
        'status' => true
    ]);

    $helper = $fb->getRedirectLoginHelper();

    $accessToken = $_SESSION['facebook_access_token'];

    $fb->setDefaultAccessToken($accessToken);
    $response = $fb->get('/me?fields=id,name,first_name,last_name,gender,link,birthday,location,picture');
    $userNode = $response->getGraphUser();

    $profile_pic = "http://graph.facebook.com/" . $userNode->getId() . "/picture?width=200";

    echo 'Name: ' . $userNode->getName() . '<br>';
    echo 'User ID ' . $userNode->getId() . '<br>';
    echo 'Email ' . $userNode->getField('email') . '<br>';
    echo 'Genre ' . $userNode->getGender() . '<br>';
    echo 'Anniversaire ' . $userNode->getBirthday()->format('m/d/Y') . '<br>';
    echo 'Lien du profil  <a href =' . $userNode->getLink() . '>PROFIL FB</a><br>';
    echo "<img src=\"" . $profile_pic . "\" />";

    $photos_request = $fb->get('/me/photos?limit=100&type=uploaded');
    $photos = $photos_request->getGraphEdge();

    $all_photos = array();
    if ($fb->next($photos)) {
        $photos_array = $photos->asArray();
        $all_photos = array_merge($photos_array, $all_photos);
        while ($photos = $fb->next($photos)) {
            $photos_array = $photos->asArray();
            $all_photos = array_merge($photos_array, $all_photos);
        }
    } else {
        $photos_array = $photos->asArray();
        $all_photos = array_merge($photos_array, $all_photos);
    }
?>
<!doctype html>
<html>
    <head>
        <!-- Page Title -->
        <title>Participation | Concours photo Facebook</title>
        <!-- Meta Tags -->
        <meta charset="utf-8">
        <meta name="keywords" content="Concours photo Pardon-Maman" />
        <meta name="description" content="Sélectionnez une photo de votre tatouage pour pouvoir participer !">
        <meta name="format-detection" content="telephone=no">
        <meta name="author" content="Pardon-Maman">
        <meta name="robots" content="noindex,nofollow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <?php require 'header.php' ?>
    </head>

    <body>
        <!-- HEADER -->
        <header>
            <?php require 'menus.php' ?>
        </header>
        <!-- END OF HEADER -->

    <!-- CONTENT -->
    <section id="section-galerie">
        <div class="container">
            <div id="main_area">
                <!-- Slider -->
                <h1>Galerie Photos </h1>
                <div class="row">
                    <div class="col-sm-6" id="slider-thumbs">
                        <!-- Bottom switcher of slider -->
                        <ul class="hide-bullets">
                            <?php
                                foreach ($all_photos as $key) {
                                    $photo_request = $fb->get('/'.$key['id'].'?fields=images');
                                    $photo = $photo_request->getGraphNode()->asArray();
                                    echo'<li class="col-sm-3 col-xs-2>';
                                    echo'<a class="thumbnail" id="carousel-selector-0">';
                                    echo '<img src="'.$photo['images'][1]['source'].'" width=100 class=popular><br>';
                                    echo'</a>';
                                    echo '</li>';
                                }
                            ?>
                        </ul>

                        <div class="col-sm-12 col-xs-12 text-center">
                            <a href="galerie.php" class="btn btn-lg btn-primary send_button">
                                <span class="glyphicon glyphicon-th"></span>
                                Voir plus de tatouages...
                            </a>
                        </div>

                    </div>
                    <div class="col-sm-6">
                        <div class="col-xs-12" id="slider">
                            <!-- Top part of the slider -->
                            <div class="row">
                                <div class="col-sm-12" id="carousel-bounding-box">
                                    <div class="carousel slide" id="myCarousel">
                                        <!-- Carousel items -->
                                        <div class="carousel-inner">
                                            <div class="active item" data-slide-number="0">
                                                <img src="http://placehold.it/235x240&text=zero">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <!-- END OF FOOTER -->
    <footer><?php require 'footer.php' ?></footer>
    <!-- END OF FOOTER -->

    </body>
</html>
