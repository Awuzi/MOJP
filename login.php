<?php
session_start();
if (isset($_GET["logout"])) {
    session_destroy();
}
?>
<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">
    <meta charset="utf-8" />
    <title>Password required</title>
    <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.css" rel="stylesheet" />
</head>
<body>
<form method="post">
    <div class="card">
        <div class="card-header">
            Password
        </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
                <p><input type="password" name="mot_de_passe" />
                    <input type="submit" value="Valider" name="connexion" />
            </blockquote>
        </div>
    </div>
</form>
<?php if (isset($_POST['connexion'])) {
    if ($_POST['mot_de_passe'] == "sio") {
        $_SESSION["connect"] = "true";
        header("Location: index.php", true, 302);
        echo "Bon mot de passe !";
    } else {
        echo '<p>Mot de passe incorrect</p>';
    }
}
    ?>
</body>
</html>