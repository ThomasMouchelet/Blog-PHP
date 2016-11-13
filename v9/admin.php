<?php
                require 'connect.php';
                require 'header.php';

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


                <h2>Liste des articles</h2>

				<a href="add_billet.php" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
                

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
		                    <th data-field="id"><a href="edit_billet.php?billet=<?php echo $donnees['id']; ?>" class="waves-effect waves-light btn-large"><i class="material-icons">mode_edit</i></a></th>
		                    <th data-field="id">
                            <a href="delete_billet.php?billet=<?php echo $donnees['id']; ?>" class="waves-effect waves-light btn-large"><i class="material-icons">delete</i></a></th>
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
        <script src="materialize/js/materialize.js"></script>
    </body>
</html>
