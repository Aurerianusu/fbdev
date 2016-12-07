<!doctype html>
<html>
	<head>
		<!-- Page Title -->
	    <title>Concours photo Facebook</title>
	    
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
		<section id="section-accueil">
		    <div class="container">
		     <div class="row">
		     	<div class="col-sm-12 col-xs-12"><p>gagnez votre tatouage !</p></div>
		     </div>
		        <div class="row">
		            <div class="col-sm-4 col-xs-12">
		            	<img src="public/images/gift.jpg" alt="" class="img-thumbnail img-responsive">
		            </div>

		            <div class="col-sm-8 col-xs-12 text-left" id="description" >
						<p>pardon maman vous offre la possibilité de gagner un tatouage gratuit pour le vainqueur
						du concours photo</p>
						<p>pour participer envoyez une photo de votre plus beau ta tatouage</p>
						<img src="public/images/submit.png" id="send_button">
					</div>
		        </div>
		    </div>
		</section>
		<!-- END OF CONTENT -->

		<!-- BLOC 2 -->
		<section id="section-tatouages">
			<div class="container">
				<p>Tatouages populaires</p>
				<div class="row">
					<div class="col-sm-3 col-xs-6">
						<img class="popular" src="public/images/tatoo1.jpg" />
						<div
							data-href="#"
							class="fb-like"
							data-layout="box_count" 
							data-action="like"
							data-size="large"
							data-show-faces="true">
						</div>
					</div>
					
        			<div class="col-sm-3 col-xs-6">
        				<img class="popular" src="public/images/tatoo2.jpg" />
        				<div
							data-href="#"
							class="fb-like"
							data-layout="box_count" 
							data-action="like"
							data-size="large"
							data-show-faces="true">
						</div>
        			</div>

        			<div class="col-sm-3 col-xs-6">
        				<img class="popular" src="public/images/tatoo3.jpg" />
        				<div
							data-href="#"
							class="fb-like"
							data-layout="box_count" 
							data-action="like"
							data-size="large"
							data-show-faces="true">
						</div>
        			</div>

       				<div class="col-sm-3 col-xs-6">
       					<img class="popular" src="public/images/tatoo4.jpg" />
       					<div
							data-href="#"
							class="fb-like"
							data-layout="box_count" 
							data-action="like"
							data-size="large"
							data-show-faces="true">
						</div>
       				</div>
    			</div>

		        <div class="row">
		        	<div class="col-sm-12 col-xs-12 text-center">
		        		<a href="galerie.php" class="btn btn-lg btn-primary send_button">
		        			<span class="glyphicon glyphicon-th"></span> 
		        			Voir tous les tatouages...
		        		</a>
					</div>
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