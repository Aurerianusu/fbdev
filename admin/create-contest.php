<?php
    session_start();
    require_once '../db.php';
    require_once '../vendor/autoload.php';
    require_once __DIR__ .'./check_formulaire.php';

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

        <form method="post" enctype="multipart/form-data">
            <section id="section-galerie">
                <div class="container">
                    <div class="row">
                        <div class="form-horizontal">
                            <fieldset>
                                <h2 class="title-settings">Nom du concours</h2>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <input type="text" class="form-control" name="title" value="<?php echo (isset($_POST['title']))?$_POST['title']:"";?>" rows="11">
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
                                        <input type="text" class="form-control" name="price" value="<?php echo (isset($_POST['price']))?$_POST['price']:"";?>" rows="11">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="textarea">Photos du prix</label>
                                    <div class="col-md-4">
                                        <input type="file" name="fileToUpload" id="fileToUpload" value="<?php echo (isset($_FILES['fileToUpload']))?$_FILES['fileToUpload']:"";?>">
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
                                        <textarea class="form-control" id="textarea" name="home" rows="11"> <?php echo (isset($_POST['home']))?$_POST['home']:"";?></textarea>
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
                                        <textarea class="form-control center-block" id="textarea" name="rules" ><?php echo (isset($_POST['rules']))?$_POST['rules']:"";?></textarea>
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
                                <div class="form-group" id="datePrecise">

                                    <label class="col-md-4 control-label" for="dateBegin">Date de début</label>
                                    <div class="col-md-4">
                                       <input type="date" class="form-control" name="dateBegin" value="<?php echo (isset($_POST['dateBegin']))?$_POST['dateBegin']:"";?>" >
                                    </div>
                                </div>

                                <div class="form-group" id="datePrecise">
                                    <label class="col-md-4 control-label" for="hourBegin">Heure début</label>
                                    <div class="col-md-4">
                                        <input type="time" class="form-control" name="hourBegin"  value="<?php echo (isset($_POST['hourBegin']))?$_POST['hourBegin']:"";?>" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <input type="radio" name="date" value="now" class="btn-lg btn-primary"> Maintenant</input>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="dateEnd">Date de fin</label>
                                    <div class="col-md-4">
                                        <input type="date" class="form-control" name="dateEnd" value="<?php echo (isset($_POST['dateEnd']))?$_POST['dateEnd']:"";?>">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-4 control-label" for="hourEnd">Heure de fin </label>
                                    <div class="col-md-4">
                                        <input type="time" class="form-control" name="hourEnd" value="<?php echo (isset($_POST['hourEnd']))?$_POST['hourEnd']:"";?>">
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
                            <button type="submit" name="save"  class="btn-lg btn-primary">Sauvegarder</button>
                        </div>
                    </div>
                </div>
            </section>
        </form>
		<!-- END OF FOOTER -->
		<footer><?php require_once '../footer.php' ?></footer>
		<!-- END OF FOOTER -->
	</body>
</html>