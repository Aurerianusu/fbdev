<?php
/**
 * Created by PhpStorm.
 * User: Guigui
 * Date: 06/02/2017
 * Time: 14:16
 */

    define('__ROOT__', dirname(dirname(__FILE__)));
    require_once __DIR__.'/vendor/autoload.php';
    require (__ROOT__.'/fbdev/db.php');
    session_start();

    $fb = new Facebook\Facebook([
            'app_id' => '276539519413614',
            'app_secret' => '93200c19ca13fa5eec70171dfb56a6e1',
            'default_graph_version' => 'v2.5',
            'status' => true
    ]);
    $helper = $fb->getRedirectLoginHelper();

    $fb->setDefaultAccessToken($_SESSION['facebook_access_token']);
    $response = $fb->get('/me?fields=id,name,first_name,last_name,email,gender,link,birthday,location,picture');
    $userNode = $response->getGraphUser();

    $firstName = $userNode->getFirstName();
    $lastName = $userNode->getLastName();
    $birthday = $userNode->getBirthday()->format('Y/m/d h:m:s');
    $email = $userNode->getField('email');
    $profile_pic =  $userNode->getPicture();
    $profile_pic = $profile_pic->getUrl();

    //$profile_pic = "http://graph.facebook.com/".$userNode->getId()."/picture?width=200";
?>
<!doctype html>
<html>
    <head>
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
        <section id="section-accueil">
            <div class="container">
                <h1 style="font-size: 31px;">Confirmer votre participation</h1>
                <div class="row">
                    <div class="col-sm-6 col-xs-6 text-center">
                        <ul>
                            Résumé de vos infos
                            <li><img src="<?php echo $profile_pic;?>" alt="" class="img-thumbnail img-responsive"></li>
                            <li><?php echo $lastName;?></li>
                            <li><?php echo $firstName;?></li>
                            <li><?php echo $email;?></li>
                        </ul>
                    </div>
                    <div class="col-sm-6 col-xs-6 text-center">
                        Votre tatouage<br>
                        <img src="<?php echo $_POST['monImage'];?>" alt=""  class="img-thumbnail img-responsive">
                    </div>
                </div>
                <div class="row">
                    <form method="post">
                        <div class="col-sm-12 col-xs-12 text-center">
                            <input type="hidden" name="linkTatoo" value="<?php echo $_POST['monImage'];?>">
                            <input type="submit" class="btn btn-lg btn-success" name="valid">
                        </div>
                    </form>
                </div>
            </div>
        </section>
        <?php
            if(isset($_POST['valid'])){
                $db = new db();

                $linkMonImage = $_POST['linkTatoo'];
                $participant = $db->getUser($email);
                $participantId = $participant['participant_id'];
                $contest= $db->getActiveContest();
                $contestId = $contest['contest_id'];

                if($participantId){

                    $db->uploadPicture($participantId,$contestId,$linkMonImage);
                    var_dump($linkMonImage);

                }
                else{
                    var_dump($linkMonImage);
                    $db->userInscription($lastName,$firstName,$email,$birthday);

                    $participant = $db->getUser($email);
                    $participantId = $participant['participant_id'];

                    $db->uploadPicture($participantId,$contestId,$linkMonImage);

                }
                header('Location: index.php');
            }
        ?>
        <!-- END OF CONTENT -->
        <!-- FOOTER -->
        <footer class="footer">
            <?php require './footer.php' ?>
        </footer>
    <!-- END OF FOOTER -->
    </body>
</html>
