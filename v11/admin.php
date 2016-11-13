<?php
            require 'connect.php';
            require 'header.php';

            nombrePages();

            ?>


            <h2>Liste des articles</h2>

			<a href="add_billet.php" class="btn-floating btn-large waves-effect waves-light red"><i class="material-icons">add</i></a>
            <div class="waves-effect waves-light btn" id="messages"></div>
            

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
                        <tr id="<?php echo $donnees['id']; ?>">
                        <th data-field="id"><?php echo htmlspecialchars($donnees['titre']); ?></th>
                        <th data-field="id"><?php echo $donnees['date_creation_fr']; ?></th>
                        <th data-field="id"><a href="edit_billet.php?billet=<?php echo $donnees['id']; ?>" class="waves-effect waves-light btn-large"><i class="material-icons">mode_edit</i></a></th>
                        <th data-field="id">
                        <a id="<?php echo $donnees['id']; ?>"  class="delete waves-effect waves-light btn-large"><i class="material-icons">delete</i></a></th>
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
        <script src="js/delete.js"></script>
    </body>
</html>
