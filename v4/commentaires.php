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

    <?php
    require 'connect.php';

    // Récupération du billet
    $req = $bdd->prepare('SELECT id, titre, contenu, DATE_FORMAT(date_creation, \'%d/%m/%Y à %Hh%imin%ss\') AS date_creation_fr FROM billets WHERE id = ?');
    $req->execute(array($_GET['billet']));
    $donnees = $req->fetch();
    ?>
        <div class="container">
            <div class="row">
                <h1>Mon super blog !</h1>
                 <nav>
                    <div class="nav-wrapper">
                      <div class="col s12">
                        <a href="index.php" class="breadcrumb">Accueil</a>
                        <a href="#!" class="breadcrumb"><?php echo $donnees['titre']; ?></a>
                      </div>
                    </div>
                  </nav>

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

                    $req = $bdd->prepare('SELECT COUNT(id) AS nb_commentaires FROM commentaires WHERE id_billet = ?');//On compte le nombre de commentaires
                    $req->execute(array($_GET['billet']));//On exécute
                    $donnees = $req->fetch();//On parcoure le tableau

                    $nb_commentaires=$donnees['nb_commentaires'];//On injecte le nombre de commentaires dans une variable
                    $per_pages= 4;//Nombre de billets par page
                    $nb_pages=ceil($nb_commentaires/$per_pages);//ceil() permet d'arrondir à la virgule supérieur

                    if (isset($_GET['page']) && $_GET['page']>0 && $_GET['page']<=$nb_pages) {//Si la variable $_GET['page'] est définie
                        $current_page=$_GET['page'];
                    }else{
                        $current_page=1;//sinon par défaut elle est égale à 1
                    }


                    // Récupération des commentaires
                    $req = $bdd->prepare('SELECT auteur, commentaire, DATE_FORMAT(date_commentaire, \'%d/%m/%Y à %Hh%imin%ss\') AS date_commentaire_fr FROM commentaires WHERE id_billet = ? ORDER BY date_commentaire DESC LIMIT '.(($current_page-1)*$per_pages).','.$per_pages.'');
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
                    ?>
                    <ul class="pagination">
                    <?php
                     for ($i=1; $i <= $nb_pages; $i++) { 
                        if ($i==$current_page) {
                            echo '<li class="active"><a href="commentaires.php?billet='.$_GET['billet'].'&'.'page='.$i.'">'.$i.'</a></li>';

                        }else{
                            echo '<li class="waves-effect"><a href="commentaires.php?billet='.$_GET['billet'].'&'.'page='.$i.'">'.$i.'</a></li>';
                        }   
                    }
                    ?>
                    </ul>
                    <?php
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