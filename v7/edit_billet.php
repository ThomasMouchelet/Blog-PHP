<?php
session_start();

    require 'connect.php';

    // Récupération du billet
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
    $req->execute(array($_GET['billet']));
    $donnees = $req->fetch();

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
		<nav>
          <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Retour site</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              <li>
                <div class="chip">
                    <img src="images/thomas.jpg" alt="Contact Person">
                    <?php echo $_SESSION['pseudo']; ?>
                </div>
              </li>
            </ul>
          </div>
        </nav>
        <div class="container">
        	<h2>Editer "<?php echo $donnees['titre']; ?>"</h2>
            <a href="admin.php" class="waves-effect waves-light btn-large">retour</a>

                    <div class="news">
                        <h5>
                            <?php echo htmlspecialchars($donnees['titre']); ?>
                            <em>le <?php echo $donnees['date_creation_fr']; ?></em>
                        </h5>
                        
                        <p>
                        <?php
                        echo nl2br(htmlspecialchars($donnees['contenu']));
                        ?>
                        </p>
                    </div>

                 

					<div class="row">
		                <div class="col s12 m8 l6 ">
		                    <form action="edit_billet_post.php?billet=<?php echo $_GET['billet']; ?>" method="post">
		                        <p>
		                        <label for="titre">Titre</label> : <input placeholder="<?php echo htmlspecialchars($donnees['titre']); ?>" type="text" name="titre" id="titre"/><br />
		                        <label for="contenu">Contenu</label> :  <input placeholder="<?php echo htmlspecialchars($donnees['contenu']); ?>" type="text" name="contenu" id="contenu" /><br />
		                        <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
		                        </p>
		                    </form>
		                </div>
		            </div>






                    <?php
                    $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête
                    ?>


                  
                    

                    
                </div><!-- row -->
        </div><!-- container -->
    </body>
</html>