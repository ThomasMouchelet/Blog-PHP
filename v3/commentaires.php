<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link href="style.css" rel="stylesheet" />
    </head>
        
    <body>

        <div class="container">
            <div class="row">
                <h1>Mon super blog !</h1>
                <p><a href="index.php">Retour à la liste des billets</a></p>
     
                    <?php
                    require 'connect.php';

                    // Récupération du billet
                    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
                    $req->execute(array($_GET['billet']));
                    $donnees = $req->fetch();
                    ?>


                    <div class="news">
                        <h3>
                            <?php echo htmlspecialchars($donnees['titre']); ?>
                            <em>le <?php echo $donnees['date_creation_fr']; ?></em>
                        </h3>
                        
                        <p>
                        <?php
                        echo nl2br(htmlspecialchars($donnees['contenu']));
                        ?>
                        </p>
                    </div>

                    <h2>Commentaires</h2>

                    <?php
                    $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête

                    // Récupération des commentaires
                    $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
                    $req->execute(array($_GET['billet']));

                    while ($donnees = $req->fetch())
                    {
                    ?>
                    <div class="col l12 ">
                        <div class="card-panel grey lighten-5 z-depth-1">
                            <div class="row valign-wrapper">
                                <div class="col s4">
                                  <?php echo htmlspecialchars($donnees['auteur']); ?></strong> le <?php echo $donnees['date_commentaire_fr']; ?>
                                </div>
                                <div class="col s8">
                                  <span class="black-text">
                                    <?php echo nl2br(htmlspecialchars($donnees['commentaire'])); ?>
                                  </span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php
                    } // Fin de la boucle des commentaires
                    $req->closeCursor();
                    ?>

                    <div class="row">
                        <div class="col s12 m8 l6 ">
                            <form action="commentaires_post.php?billet=<?php echo $_GET['billet'];?>" method="post">
                                <p>
                                <label for="auteur">Pseudo</label> : <input type="text" name="auteur" id="auteur" /><br />
                                <label for="commentaire">Message</label> :  <input type="text" name="commentaire" id="commentaire" /><br />

                                <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
                            </p>
                            </form>
                        </div>
                    </div>
                </div><!-- row -->
        </div><!-- container -->
    </body>
</html>