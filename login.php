<?php session_start();
require_once "inc/connect-db.php"; ?>
<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">
    <meta charset="utf-8"/>
    <title>Password required</title>
    <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.css" rel="stylesheet"/>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>
<form method="POST">
    <div class="card">
          <span class="card-header ch-login">
            <span class="left-login">MOJP</span>
            <span class="right-login">Password</span>
          </span>
        <div class="card-body text-center card-login">
            <blockquote class="blockquote mt-0 in-login">
                <label for="password" class="h2 font-italic">Entrez le mot de passe de validation</label>
                <br>
                <input type="password" name="mot_de_passe" id="password" required autofocus/>
                <input type="submit" value="Valider" name="connexion"/>
            </blockquote>
        </div>
    </div>
</form>
<?php if (isset($_POST['connexion'])) {
    if ($_POST['mot_de_passe'] == $db['InterfacePass']) {
        $_SESSION["connect"] = TRUE;
        header("Location: index.php", TRUE, 302);
    } else { ?>
        <div class="alert alert-danger text-center alert-login m-auto" role="alert">
            Mot de passe incorrect
        </div>
    <?php }
} ?>
<img src="images/minion.png" class="minion-right-login">
<img src="images/minion.png" class="minion-down-login">
<div style="position: absolute; bottom: 0;">
    <?php include_once 'footer.php'; ?>
</div>
</body>
