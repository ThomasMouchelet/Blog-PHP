<?php
require 'connect.php';
require 'header.php';
while ($donnees = $req->fetch())
{
?>
    <tr>
    <th data-field="id"><?php echo htmlspecialchars($donnees['titre']); ?></th>
    <th data-field="id"><?php echo $donnees['date_creation_fr']; ?></th>
    <th data-field="id"><a href="edit_billet.php?billet=<?php echo $donnees['id']; ?>" class="waves-effect waves-light btn-large"><i class="material-icons">mode_edit</i></a></th>
    <th data-field="id">
    <a id="<?php echo $donnees['id']; ?>"  class="delete waves-effect waves-light btn-large"><i class="material-icons">delete</i></a></th>
</tr>   
<?php
} // Fin de la boucle des billets
?>