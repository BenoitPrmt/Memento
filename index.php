<?php

include 'connection.php';

session_start();

if (isset($_SESSION['user'])) {
    $query = 'SELECT p.id, p.user_id, p.title, p.content, UNIX_TIMESTAMP(p.date) AS date, p.color, p.created_at FROM post_it AS p INNER JOIN users AS u ON u.id = p.user_id WHERE u.email=:email ORDER BY created_at DESC';
    $response = $bdd->prepare($query);
    $response->execute([
        'email' => $_SESSION['user']['email']
    ]);
    $datas = $response->fetchAll();

    $response->closeCursor();
}

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

            <?php if (isset($_SESSION['user'])) { ?>
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
                            <?= nl2br($data['content']) ?>
                        </p>
                        <p>
                            <?= date('d/m/Y', $data['date']) ?>
                        </p>
                    </article>
                <?php } ?>
            <?php } else { ?>
                <h2>Connectez-vous pour voir vos post-it ou en ajouter.</h2>
            <?php } ?>

        </div>
    </section>

</main>

<?php include 'layout/footer.php' ?>