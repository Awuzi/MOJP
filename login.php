<?php
session_start();
?>
<!DOCTYPE html>
<head xmlns="http://www.w3.org/1999/html">
    <meta charset="utf-8"/>
    <title>Password required</title>
    <link href="assets/bootstrap-4.2.1-dist/css/bootstrap.css" rel="stylesheet"/>
</head>
<body>
    <form method="post">
        <div class="card">
            <span class="card-header">Password</span>
            <div class="card-body">
                <blockquote class="blockquote mt-0">
                    <label for="password"></label>
                    <input type="password" name="mot_de_passe" id="password"/>
                    <input type="submit" value="Valider" name="connexion"/>
                </blockquote>
            </div>
        </div>
    </form>
</body>
<?php if (isset($_POST['connexion'])) {
    if ($_POST['mot_de_passe'] == "sio") {
        $_SESSION["connect"] = TRUE ;
        header("Location: index.php", TRUE, 302);
    } else {
        echo '<p>Mot de passe incorrect</p>';
    }
}
?>