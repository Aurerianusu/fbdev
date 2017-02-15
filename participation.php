<?php
    /**
     * Created by PhpStorm.
     * User: Guigui
     * Date: 25/01/2017
     * Time: 16:37
     */

    require_once './dependency.php';

    $db = new db();

    $fb = $db->initFb();

    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    $response = $fb->get('/me?fields=id,name,first_name,last_name,email,link,picture');
    $userNode = $response->getGraphUser();

    $_SESSION['email'] = $userNode->getField('email');

    $participate = $db->checkIfParticipateAndRedirection($_SESSION['email']);

    if($participate){
        header('Location: nope.php');
    }

    $photos_request = $fb->get('/me/photos?limit=50&type=uploaded');
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

    //header('Location: mustconnect.php');
?>
<!doctype html>
<html xmlns="http://www.w3.org/1999/html">
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
        <?php require './header.php' ?>
    </head>

    <body>
        <!-- HEADER -->
        <header>
            <?php require './menus.php' ?>
        </header>
        <!-- END OF HEADER -->

    <!-- CONTENT -->
    <section id="section-galerie">
        <div class="container">
            <div id="main_area">
                <!-- Slider -->
                <h3>Choisissez parmi vos photos facebook </h3>
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

                        <div class="form-group">
                            <label class="col-md-4 control-label">Ou envoyer une photo</label>
                            <div class="col-md-4">
                                <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo (isset($_POST['price']))?$_POST['price']:"";?>">
                            </div>
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
    <footer><?php require './footer.php' ?></footer>
    <!-- END OF FOOTER -->
        <?php

        if(isset($_FILES['fileToUpload'])){
            $uploadok = $db->checkUploadFile($_FILES['fileToUpload']);
            if($uploadok){
                $db->uploadFile($uploadok,$_FILES['fileToUpload']);
            }else{
                var_dump('marche pas');die;
            }
        }
        ?>
    <script>
        function swap(image) {
            document.getElementById("bigPicture").src = image.src;
            document.getElementById("monImage").value = image.src;
        }
    </script>
        <script>
        function preview(input) {
            if (input.files && input.files[0]) {
                var freader = new FileReader();
                freader.onload = function (e) {
                    $("#bigPicture").attr('src', e.target.result);
                    $("#monImage").attr('value', e.target.result);
                };

                freader.readAsDataURL(input.files[0]);
            }
        }

        $("#fileToUpload").change(function(){
            preview(this);
        });
    </script>
    </body>
</html>
