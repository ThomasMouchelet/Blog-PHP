<?php require 'header.php'; 


if(isset($_SESSION['type']) AND $_SESSION['type']=='admin') {
  echo '<script language="Javascript">
		<!--
		document.location.replace("admin.php");
		// -->
		</script>';
}
if (isset($_GET['msg']) AND !empty($_GET['msg']))
{
?>
	<p style="background: #57AF58;color: #FFF;padding: 10px;" class="z-depth-3"><?php echo $_GET['msg']; ?></p>
<?php
}
?>

            <div class="row">
                <h1>Connexion</h1>
            </div>

			<div class="row">
			    <div class="col s12 m8 l6 ">
			        <form action="login_post.php" method="post">
			            <p>
			            <label for="login">Login</label> : <input type="text" name="login" id="login" /><br />
			            <label for="password" >Password</label> :  <input name="password" id="password" type="password" class="validate"/><br />
			            <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
			        	</p>
			        </form>
			    </div>
			</div>
			<p>Pas de compte ? <a href="register.php">créer un compte</a></p>

			</div><!-- row -->
        </div><!-- container -->
    </body>
</html>