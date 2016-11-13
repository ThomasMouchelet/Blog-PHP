<?php 
require 'header.php'; 
require 'connect.php';

// Récupération du billet
$req = $bdd->prepare('SELECT login, password, type, avatar FROM users WHERE id = ?');
$req->execute(array($_SESSION['id']));
$donnees = $req->fetch();

if (isset($_GET['msg']) AND !empty($_GET['msg']))
    {
      $msg=$_GET['msg'];
    }

?>
<div class="row">
    
    <?php 
    if (isset($msg) AND !empty($msg))
    {
    ?>
        <p style="background: red;color: #FFF;padding: 10px;" class="z-depth-3"><?php echo $msg ?></p>
    <?php
    }
    ?>
    <h2>Mon profile</h2>
    <a href="admin.php" class="waves-effect waves-light btn-large">Retour</a>
</div>
<div class="row">
    <div class="col s10 m8 l4 ">
        <img src="images/avatars/<?php echo $donnees['avatar'] ?>" alt="" class="circle responsive-img">
    </div>
    <div class="col s10 m8 l8 ">
        <form action="profil_post.php" method="post" autocomplete="off" enctype="multipart/form-data">
            <p>
            <div class="file-field input-field">
              <div class="btn">
                <span>AVATAR</span>
                <input type="file" name="avatar">
              </div>
            </div><br /><br /><br />
            <label for="login">login</label> : <input placeholder="<?php echo htmlspecialchars($_SESSION['login']); ?>"  type="text" name="login" id="login"/><br />
            <label for="password">password</label> :  <input type="password" name="password" id="password" /><br />
            <label for="password2">confirm password</label> :  <input type="password" name="password2" id="password2" /><br />
			<label>Status</label>
			<select disabled class="browser-default" name="type">
				<option value="" disabled selected><?php echo $donnees['type'] ?></option>
				<option value="1">Option 1</option>
				<option value="2">Option 2</option>
				<option value="3">Option 3</option>
			</select>
			<br>
           
            <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
            </p>
        </form>
    </div>
</div>