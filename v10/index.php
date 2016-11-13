<?php require 'header.php'; ?>
            <div class="row">
                <h1>Mon super blog !</h1>
                <p>Derniers billets du blog :</p>
 
                <?php
                require 'connect.php';

                nombrePages();

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
<?php require 'footer.php'; ?>