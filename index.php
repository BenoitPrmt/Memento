<?php

include 'connection.php';

$query = 'SELECT id, title, content, date, created_at FROM post_it ORDER BY created_at DESC';
$response = $bdd->query($query);
$datas = $response->fetchAll();

$response->closeCursor();


?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Memento</title>
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

    <header>
        <nav class="container">
            <div class="nav-start">
                <a id="home-button" href="index.php" title="Retourner à la page d'accueil">Memento</a>
            </div>
            <div class="nav-end">
                <a class="button" href="login.php" title="Se connecter">Se connecter</a>
                <a id="register-button" class="button" href="register.php" title="S'inscrire">S'inscrire</a>
            </div>
        </nav>
        <hr>
    </header>


    <main>
        <section class="center">
            <h1>Memento</h1>
            <a class="button" href="new.php" title="Ajouter un post-it">Nouveau post-it</a>
            <!-- <button>Ajouter une note</button> -->
        </section>


        <section class="container">
            <div class="postit-list">
                
                <?php foreach ($datas as $data) { ?>
                    <article class="postit">
                        <div class="postit-header">
                            <h2><?= $data['title'] ?></h2>
                            <a href="delete.php?id=<?=$data['id']?>" title="Supprimer le post-it"><img width="30" height="30" src="https://img.icons8.com/sf-black-filled/64/cancel.png" alt="remove"/></a>
                        </div>
                        <p><?= $data['content'] ?></p>
                        <p><?= $data['date'] ?></p>
                    </article>
                <?php } ?>

            </div>
        </section>

    </main>

</body>

</html>