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
                <p>Derniers billets du blog :</p>
 
                <?php
                require 'connect.php';

                // On récupère les 5 derniers billets
                $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');

                while ($donnees = $req->fetch())
                {
                ?>
                <div class="news">
                    <h3>
                        <?php echo htmlspecialchars($donnees['titre']); ?>
                        <em>le <?php echo $donnees['date_creation_fr']; ?></em>
                    </h3>
                    
                    <p>
                    <?php
                    // On affiche le contenu du billet
                    echo nl2br(htmlspecialchars($donnees['contenu']));
                    ?>
                    <br />
                    <em><a href="commentaires.php?billet=<?php echo $donnees['id']; ?>">Commentaires</a></em>
                    </p>
                </div>
                <?php
                } // Fin de la boucle des billets
                $req->closeCursor();

                // $req2 = $bdd->query('SELECT COUNT(*) AS nb_billets FROM billets');
                // $donnees = $req2->fetch();
                // $req2->closeCursor();
                // print_r($donnees['nb_billets']);

                

                
                ?>

                <!-- <a href="index.php?page=2">2</a> -->
    

            </div><!-- row -->
        </div><!-- container -->
</body>
</html>