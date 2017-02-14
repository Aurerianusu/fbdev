<?php
session_start();
require_once './db.php';
require_once './vendor/autoload.php';

$db = new db();

$allTattoo = $db->getTatooActiveContestWithUser();
if (isset($_SESSION['email'])) {
    $userTattoo = $db->getUserTattoo($_SESSION['email']);
}

?>
<!doctype html>
<html>
	<head>
		<!-- Page Title -->
	    <title>Galerie | Concours photo Facebook</title>
	    <!-- Meta Tags -->
	    <meta charset="utf-8">
	    <meta name="keywords" content="Concours photo Pardon-Maman" />
	    <meta name="description" content="Voici la galerie photo du concours Pardon-maman. Tentez de remporter un tattouage gratuit !">
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
                                    if($userTattoo){
                                        echo '<li class="col-sm-3 col-xs-6">';
                                        echo '<a class="thumbnail" id="carousel-selector-0" style="border: 5px solid chartreuse;">';
                                        echo '<img src='.$userTattoo['link'].'>';
                                        echo '</a>';
                                        echo ' <p class="title-photo">'.(isset($userTattoo['participant_surname']))?$userTattoo['participant_surname']:'YAPADENOM MDRRRRR'.'</p>';
                                        echo '</li>';

                                        $firstSlide = '<div class="active item" data-slide-number="0">';
                                        $firstSlide .= '<img src='.$userTattoo['link'].'>';
                                        $firstSlide .= '</div>';
                                    }
                                    foreach ($allTattoo as $tattoo){
                                        echo '<li class="col-sm-3 col-xs-2">';
                                        echo '<a class="thumbnail"><img src='.$tattoo['link'].'></a>';
                                        echo '<p class="title-photo">'.$tattoo['participant_surname'].'</p>';
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
                                                <?php
                                                    $i = 1;
                                                    if(isset($firstSlide)){

                                                        echo $firstSlide;

                                                        foreach ($allTattoo as $tattoo){

                                                            echo '<div class="item" data-slide-number='.$i.'>';
                                                            echo '<img src='.$tattoo['link'].'>';
                                                            echo '</div>';

                                                            $i++;
                                                        }
                                                    }else{
                                                        foreach ($allTattoo as $tattoo){

                                                            if ($tattoo === reset($allTattoo)){

                                                                echo '<div class="active item" data-slide-number="0">';
                                                                echo '<img src='.$tattoo['link'].'>';
                                                                echo '</div>';
                                                            }
                                                            echo '<div class="item" data-slide-number='.$i.'>';
                                                            echo '<img src='.$tattoo['link'].'>';
                                                            echo '</div>';

                                                            $i++;
                                                        }
                                                    }
                                                ?>
			                                </div>
			                                <!-- Carousel nav -->
			                                <a class="left carousel-control" href="#myCarousel" role="button" data-slide="prev">
			                                    <span class="glyphicon glyphicon-chevron-left"></span>
			                                </a>
			                                <a class="right carousel-control" href="#myCarousel" role="button" data-slide="next">
			                                    <span class="glyphicon glyphicon-chevron-right"></span>
			                                </a>
			                            </div>
			                        </div>
			                    </div>
			                </div>
			            </div>
			            <!--/Slider-->
			        </div>

			    </div>
			</div>
		</section>


		<!-- END OF FOOTER -->
		<footer><?php require 'footer.php' ?></footer>
		<!-- END OF FOOTER -->

	</body>

</html>