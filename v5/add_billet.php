<?php
session_start();
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
	
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        <link href="style.css" rel="stylesheet" />
    </head>
        
    <body>
        <div class="container">
            <div class="row">
				<h2>Ajouter un article</h2>
            </div>

            <div class="row">
                <div class="col s12 m8 l6 ">
                    <form action="add_billet_post.php" method="post">
                        <p>
                        <label for="titre">Titre</label> : <input type="text" name="titre" id="titre" /><br />
                        <label for="contenu">Contenu</label> :  <input type="text" name="contenu" id="contenu" /><br />
                        <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
                        </p>
                    </form>
                </div>
            </div>


        </div>
    </body>
</html>