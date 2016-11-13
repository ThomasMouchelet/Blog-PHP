<?php
// Header
require 'header.php';
// Connecxion base de données
require 'connect.php';
?>
        <p>Derniers billets du blog :</p>

        <?php
        

        // Récupèrer les 5 derniers billets

        $tableau = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT 0, 5');


        while ($donnees = $tableau->fetch()) 
        {

            echo '<h2>' . $donnees['titre'] . ' ' . $donnees['date_creation_fr'] . '</h2>';
            echo '<p>' . $donnees['contenu'] . '</p>';
            echo "<a href='commentaires.php?billet=".$donnees['id']."'>commentaires</a>";

        }

        ?>

        
    </body>
</html>