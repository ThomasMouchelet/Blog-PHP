<?php 
if(!isset($_SESSION)) {
  session_start();
}
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Mon blog</title>
  
        <link rel="stylesheet" href="materialize/css/materialize.min.css">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
       
       <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
          
    </head>
        
    <body>
      <?php if(isset($_SESSION['type']) AND $_SESSION['type']=='admin'){ ?>
         <nav>
              <div class="nav-wrapper">
                <?php 
                $path = $_SERVER['PHP_SELF']; 
                $file = basename ($path); 

                if ( $file == "index.php" ) { ?><!-- Si nous fichier index.php -->
                  <a href="admin.php" class="brand-logo">Retour admin</a>
                <?php }else{ ?>
                  <a href="index.php" class="brand-logo">Retour site</a>
                <?php } ?> 
                
                <ul id="nav-mobile" class="right hide-on-med-and-down">
                  <li>
                    <a href="profil.php">
                      <div class="chip">
                          <?php echo $_SESSION['login']; ?>
                          <img src="images/avatars/<?php echo $_SESSION['avatar']; ?>" alt="Contact Person">
                      </div>
                    </a>
                  </li>
                  <li><a href="disconnect.php">Déconnexion</a></li>

                </ul>
              </div>
            </nav>
        <div class="container">
      <?php }else{ ?>
        <nav>
          <div class="nav-wrapper">
            <a href="index.php" class="brand-logo">Index</a>
            <ul id="nav-mobile" class="right hide-on-med-and-down">
              
            </ul>
          </div>
        </nav>
          <div class="container">
      <?php } ?>
