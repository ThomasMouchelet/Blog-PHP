<?php require 'header.php'; ?>
            <h2>Ajouter un article</h2>
            <a href="admin.php" class="waves-effect waves-light btn-large">retour</a>

            <div class="row">
                <div class="col s12 m8 l6 ">
                    <form action="add_billet_post.php" method="post">
                        <p>
                        <label for="titre">Titre</label> : <input type="text" name="titre" id="titre" /><br />
                        <label for="contenu">Contenu</label> :  <input type="text" name="contenu" id="contenu" /><br />
                        <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
                        </p>
                    </form>
                </div>
            </div>


        </div>
    </body>
</html>