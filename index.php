<?php

include 'connection.php';

session_start();

$query = 'SELECT id, title, content, date, color, created_at FROM post_it ORDER BY created_at DESC';
$response = $bdd->query($query);
$datas = $response->fetchAll();

$response->closeCursor();

?>

<?php include 'layout/header.php' ?>

<main>
    <section class="center">
        <h1>Memento</h1>

        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button" href="new.php" title="Ajouter un post-it">Nouveau post-it</a>
        <?php } ?>
    </section>

    <section class="container">
        <div class="postit-list">

            <?php foreach ($datas as $data) { ?>
                <article class="postit" style="background-color: <?= $data['color'] ?>;">
                    <div class="postit-header">
                        <h2>
                            <?= $data['title'] ?>
                        </h2>
                        <a href="delete.php?id=<?= $data['id'] ?>" title="Supprimer le post-it"><img width="30" height="30"
                                src="https://img.icons8.com/sf-black-filled/64/cancel.png" alt="remove" /></a>
                    </div>
                    <p>
                        <?= $data['content'] ?>
                    </p>
                    <p>
                        <?= $data['date'] ?>
                    </p>
                </article>
            <?php } ?>

        </div>
    </section>

</main>

<?php include 'layout/footer.php' ?>