<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? $pageTitle : "Accueil" ?> - Memento</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nanum+Pen+Script&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <!-- <style>
        * {
            outline: 1px solid red;
        }
    </style> -->
</head>

<body>

    <header class="container">
        <nav>
            <div class="nav-start">
                <a id="home-button" href="index.php" title="Retourner à la page d'accueil">Memento</a>
            </div>
            <div class="nav-end">
                <?php if (isset($_SESSION['user'])) { ?>
                    <a class="button" href="profil.php" title="Profil">Mon profil</a>
                    <a id="disconnect-button" class="button-secondary" href="disconnect.php" title="Se déconnecter">Se déconnecter</a>
                <?php } else { ?>
                    <a class="button" href="login.php" title="Se connecter">Se connecter</a>
                    <a id="register-button" class="button" href="register.php" title="S'inscrire">S'inscrire</a>
                <?php } ?>
            </div>
        </nav>
        <hr>
    </header>