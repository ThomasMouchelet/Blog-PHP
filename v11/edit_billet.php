<?php
require 'connect.php';
require 'header.php';


    // Récupération du billet
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
    $req->execute(array($_GET['billet']));
    $donnees = $req->fetch();

?>

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