<?php
// Header
require 'header.php';
// Connecxion base de données
require 'connect.php';
?>
        <a href="index.php">retour page d'accueil</a>
        <?php
        

        $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
        $req->execute(array($_GET['billet']));
        $donnees = $req->fetch();
        

        
        echo '<h2>' . $donnees['titre'] . '</h2>';
        echo $donnees['contenu'];

        $req->closeCursor(); // Important : on libère le curseur pour la prochaine requête
        ?>

        <h3>Commentaires: </h3>
        <?php
        //Récupération des commentaires
        $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire');
        $req->execute(array($_GET['billet']));

        while($donnees = $req->fetch())
        {
            echo '<h4>' . $donnees['auteur'] . ' ' . $donnees['date_commentaire_fr'] . '</h4>';
            echo '<p>' . $donnees['commentaire'] .'</p>';
        }

        $req->closeCursor();// Important : on libère le curseur pour la prochaine requête

        ?>

        <form action="commentaire_post.php?billet=<?php echo $_GET['billet'];?>" method="post">
            <p>
            <label for="auteur">Pseudo</label> : <input type="text" name="auteur"  /><br />
            <label for="commentaire">Message</label> :  <input type="text" name="commentaire"  /><br />

            <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
        </p>
        </form>
    
        

    </body>
</html>