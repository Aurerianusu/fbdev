<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 25/01/2017
 * Time: 16:37
 */

    session_start();
    define('__ROOT__', dirname(dirname(__FILE__)));
    require (__ROOT__.'/fbdev/db.php');
    require_once __DIR__.'/vendor/autoload.php';

    $db = new db();
    $fb = $db->initFb();
    //$helper = $fb->getRedirectLoginHelper();

    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    $response = $fb->get('/me?fields=id,name,first_name,last_name,email,gender,link,birthday,location,picture');
    $userNode = $response->getGraphUser();

    $_SESSION['email'] = $userNode->getField('email');

    $db->checkIfParticipateAndRedirection($_SESSION['email']);

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
                <form method="post" action="confirmation.php">
                    <div class="row">
                        <div class="col-sm-6" id="slider-thumbs">
                            <!-- Bottom switcher of slider -->
                            <ul class="hide-bullets">
                                <?php
                                    foreach ($all_photos as $key) {
                                        $photo_request = $fb->get('/'.$key['id'].'?fields=images');
                                        $photo = $photo_request->getGraphNode()->asArray();
                                        echo'<li class="col-sm-3 col-xs-2>';
                                        echo'<a class="thumbnail" >';
                                        echo '<img  onclick="swap(this)" src="'.$photo['images'][1]['source'].'" class=popular id=popular>';
                                        echo'</a>';
                                        echo '</li>';
                                    }
                                ?>
                            </ul>
                        </div>
                        <div class="col-sm-6 ">
                            <div class="col-xs-12" id="slider">
                                <div class="carousel-inner ">
                                    <img id="bigPicture" class="popular">
                                </div>
                            </div>

                            <input type="hidden" name="monImage"  id="monImage"  value="" >

                            <div class="col-sm-12 col-xs-12 text-center">
                                <input type="submit" class="btn btn-lg btn-primary send_button">
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- END OF FOOTER -->
    <footer><?php require 'footer.php' ?></footer>
    <!-- END OF FOOTER -->

    <script>
        function swap(image) {
            document.getElementById("bigPicture").src = image.src;
            document.getElementById("monImage").value = image.src;
        }
    </script>
    </body>
</html>
