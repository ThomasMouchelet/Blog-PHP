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
                <h1>Mon super blog !</h1>
                <p>Derniers billets du blog :</p>
 
                <?php
                require 'connect.php';

                $req = $bdd->query('SELECT COUNT(id) AS nb_billets FROM billets');//On compte le nombre de billets
                $req->execute(array());//On exécute
                $donnees = $req->fetch();//On parcoure le tableau

                $nb_billets=$donnees['nb_billets'];//On injecte le nombre de billets dans une variable
                $per_pages= 4;//Nombre de billets par page
                $nb_pages=ceil($nb_billets/$per_pages);//ceil() permet d'arrondir à la virgule supérieur

                if (isset($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nb_pages) {//Si la variable $_GET['page'] est définie
                    $current_page=$_GET['page'];
                }else{
                    $current_page=1;//sinon par défaut elle est égale à 1
                }

                // On récupère les 5 derniers billets
                $req = $bdd->query('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets ORDER BY date_creation DESC LIMIT '.(($current_page-1)*$per_pages).','.$per_pages.'');

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
                ?>
                <ul class="pagination">
                <?php
                 for ($i=1; $i <= $nb_pages; $i++) { 
                    if ($i==$current_page) {
                        echo '<li class="active"><a href="index.php?page='.$i.'">'.$i.'</a></li>';

                    }else{
                        echo '<li class="waves-effect"><a href="index.php?page='.$i.'">'.$i.'</a></li>';
                    }   
                }
                ?>
                </ul>
                <?php
                $req->closeCursor();            
                ?>
    

            </div><!-- row -->
        </div><!-- container -->
</body>
</html>