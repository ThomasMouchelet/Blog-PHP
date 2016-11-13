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

                ?>

				<a href="add_billet.php" class="waves-effect waves-light btn-large">Ajouter</a>


                <table>
			        <thead>
			          <tr>
			              <th data-field="id">Titre</th>
			              <th data-field="name">Date</th>
			          </tr>
			        </thead>

			        <tbody>
					    <?php
		                while ($donnees = $req->fetch())
		                {
		                ?>
		               	<tr>
			              	<th data-field="id"><?php echo htmlspecialchars($donnees['titre']); ?></th>
		                    <th data-field="id"><?php echo $donnees['date_creation_fr']; ?></th>
		                    <th data-field="id"><a class="waves-effect waves-light btn-large">Modifier</a></th>
		                    <th data-field="id"><a class="waves-effect waves-light btn-large">Supprimer</a></th>
		                </tr>   
		                <?php
		                } // Fin de la boucle des billets
		                ?>
			        </tbody>
			    </table>
                <ul class="pagination">
                <?php
                 for ($i=1; $i <= $nb_pages; $i++) { 
                    if ($i==$current_page) {
                        echo '<li class="active"><a href="admin.php?page='.$i.'">'.$i.'</a></li>';

                    }else{
                        echo '<li class="waves-effect"><a href="admin.php?page='.$i.'">'.$i.'</a></li>';
                    }   
                }
                ?>
                </ul>
                <?php
                $req->closeCursor();            
                ?>
        </div>
    </body>
</html>
