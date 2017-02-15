<?php

    require_once './dependency.php';

    $db = new db();

    $activeContest = $db->getActiveContest();

    if(isset($activeContest)){
        $dateEnd = $activeContest['contest_end_date'];


        $dateEnd = date("d-m-Y", strtotime($dateEnd));
    }
?>
<!doctype html>
<html>
	<head>
		<!-- Page Title -->
	    <title>Règles | Concours photo Facebook</title>
	    <!-- Meta Tags -->
	    <meta charset="utf-8">
	    <meta name="keywords" content="Concours photo Pardon-Maman" />
	    <meta name="description" content="Les règles du jeu concours Pardon-maman sont décrites dans cette section.">
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
			<h1>Règles du jeu</h1>
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="margin-top:10px;">Comment Participer ?</p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">1. Aime la page Facebook Pardon-maman</p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">2. Envoie depuis l'accueil une photo de ton plus beau tatouage</p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">3. Partage ta photo afin d'avoir un maximum de like</p>
					</div>
			    </div>
			</div>
		</section>

		<section id="section-galerie" class="section-background">
			<div class="container">
				<div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="margin-top:10px;">Informations complémentaires</p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">Le concours se termine le <?php echo $dateEnd; ?></p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">La photo doit être authentique et représente votre tatouage</p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">Aucune triche sur les likes n'est toléré</p>
					</div>
			    </div>
			    <div class="row">
					<div class="col-sm-12 col-xs-12">
						<p style="font-size:20px;">Pardon Maman se réserve le droit de disqualifier les photos qui ne respectent pas les règles</p>
					</div>
			    </div>
			</div>
		</section>


		<!-- END OF FOOTER -->
		<footer><?php require 'footer.php' ?></footer>
		<!-- END OF FOOTER -->

	</body>

</html>