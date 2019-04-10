<?php
session_start();
?>
    <!DOCTYPE html>
    <head xmlns="http://www.w3.org/1999/html">
        <meta charset="utf-8"/>
        <title>Password required</title>
        <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.css" rel="stylesheet"/>
        <link rel="stylesheet" href="css/login.css">
    </head>
    <body>
    <form method="post">
        <div class="card">
          <span class="card-header ch-login">
            <span class="left-login">MOJP</span>
            <span class="right-login">Password</span>
          </span>
          <div class="card-body text-center card-login">
              <blockquote class="blockquote mt-0 in-login">
                  <small><i>
                    <label for="password"><h2>Entrez le mot de passe de validation</h2></label>
                  </i></small>
                  <br>
                  <input type="password" name="mot_de_passe" id="password" autofocus/>
                  <input type="submit" value="Valider" name="connexion"/>
              </blockquote>
          </div>
      </div>
  </form>

  <?php if (isset($_POST['connexion'])) {
      if ($_POST['mot_de_passe'] == "sio") {

          $_SESSION["connect"] = TRUE;
          header("Location: index.php", TRUE, 302);

      } else { ?>

        <center>
          <div class="alert alert-danger text-center alert-login" role="alert">
            Mot de passe incorrect
          </div>
        </center>

      <?php }
  }
  ?>

  <img src="images/minion.png" class="minion-right-login">
  <img src="images/minion.png" class="minion-down-login">

  <div style="position: absolute; bottom: 0;">
    <?php include_once 'footer.php'; ?>
  </div>
    </body>
