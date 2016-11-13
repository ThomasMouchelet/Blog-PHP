</div><!-- container -->

	<footer class="page-footer">
          <div class="container">
            <div class="row">
              <div class="col l6 s12">
                <h5 class="white-text">Footer Content</h5>
                <p class="grey-text text-lighten-4">You can use rows and columns here to organize your footer content.</p>
              </div>
              <div class="col l4 offset-l2 s12">
                <h5 class="white-text">Links</h5>
                <ul>
                <?php 

                if(isset($_SESSION['type']) AND $_SESSION['type']=='admin') {?>
                  <li><a href="admin.php" class="grey-text text-lighten-3" href="#!">Admin</a>
                <?php }else{ ?>
                  <li><a href="login.php" class="grey-text text-lighten-3" href="#!">Connexion</a></li>
                  <li><a href="register.php" class="grey-text text-lighten-3" href="#!">Enregistrement</a></li>
                  <?php } ?>
                </ul>
              </div>
            </div>
          </div>
          <div class="footer-copyright">
            <div class="container">
            © 2014 Copyright Text
            <a class="grey-text text-lighten-4 right" href="#!">Mentions légales</a>
            </div>
          </div>
        </footer>
        <script src="materialize/js/materialize.min.js"></script>
</body>
</html>