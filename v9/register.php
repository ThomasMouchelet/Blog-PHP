<?php require 'header.php'; 



if(isset($_SESSION['type']) AND $_SESSION['type']=='admin') {
  echo '<script language="Javascript">
		<!--
		document.location.replace("admin.php");
		// -->
		</script>';
}

?>
            <div class="row">
                <h1>Register</h1>
            </div>

			<div class="row">
			    <div class="col s12 m8 l6 ">
			        <form action="register_post.php" method="post">
			            <p>
			            <label for="login">Login</label> : <input type="text" name="login" id="login" /><br />
			            <label for="password">Password</label> :  <input type="password" class="validate" name="password" id="password" /><br />
			            <input class="waves-effect waves-light btn" type="submit" value="Envoyer" />
			        	</p>
			        </form>
			    </div>
			</div>
			<p>Déja membre ? <a href="login.php">connexion</a></p>

			</div><!-- row -->
        </div><!-- container -->
    </body>
</html>