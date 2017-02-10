<?php
define('__ROOT__', dirname(dirname(__FILE__)));
require_once __DIR__.'/vendor/autoload.php';
require (__ROOT__.'/fbdev/db.php');
session_start();?>
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
				<div class="row">
					<div class="col-sm-2 col-xs-2" style="display: inline-flex;">
						<img src="public/images/settings.png" style="margin-top:10px;float:left;margin-bottom:10px;" />
						<h1 style="margin-top:25px;margin-left:15px;">Administration</h1>
					</div>
			    </div>
			</div>
		</section>

        <form method="post" action="#" enctype="multipart/form-data">
            <section id="section-galerie">
                <div class="container">
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <h2 class="title-settings">Titre</h2>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <input type="text" class="form-control" name="title" rows="11">
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
                                <h2 class="title-settings">Prix</h2>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Nom du prix</label>
                                    <div class="col-md-4">
                                        <input type="text" class="form-control" name="price" rows="11">
                                        <input type="file" name="fileToUpload" id="fileToUpload">
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
                                <h2 class="title-settings">ACCUEIL</h2>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Présentation</label>
                                    <div class="col-md-4">
                                        <textarea class="form-control" id="textarea" name="home" rows="11">ici le texte d'accueil</textarea>
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
                                <h2 class="title-settings">Règles</h2>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <textarea class="form-control center-block" id="textarea" name="rules">ici le texte d'accueil</textarea>
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
                                <h2 class="title-settings">Date</h2>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="dateBegin">Date de début</label>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" name="dateBegin" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="hourBegin">Heure début</label>
                                    <div class="col-md-4">
                                        <input type="time" class="form-control" name="hourBegin" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="dateEnd">Date de fin</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="dateEnd" >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="hourEnd">Heure de fin </label>
                                    <div class="col-md-4">
                                        <input type="time" class="form-control" name="hourEnd" >
                                    </div>
                                </div>
                            </fieldset>
                        </div>
                    </div>
            </section>

            <section>
                <div class="container" style="margin-bottom: 40px;">
                    <div class="row">
                        <div class="col-md-2 col-md-offset-5">
                            <button type="submit" name="save" class="btn-lg btn-primary">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
        <?php
            if(isset($_POST['save'])){
                $db = new db();



                $dateBegin = $db->dateWithHour($_POST['dateBegin'],$_POST['hourBegin']);
                $dateEnd = $db->dateWithHour($_POST['dateEnd'],$_POST['hourEnd']);

                var_dump($dateBegin);
                var_dump($db->isDateIsToday($dateBegin));die;
                $creation = $db->createContest($_POST['title'],$_POST['rules'],$_POST['home'],$dateBegin,$dateEnd,$_POST['price'],$_FILES['fileToUpload']['name']);
                if ($creation){
                    $db->uploadPrice($_FILES['fileToUpload']);
                }else{
                    var_dump('faaaallllseeee');
                }
            }
        ?>
		<!-- END OF FOOTER -->
		<footer><?php require 'footer.php' ?></footer>
		<!-- END OF FOOTER -->
	</body>
</html>