<?php
include 'connection.php';

session_start();

$pageTitle = "Corbeille";

if (isset($_SESSION['user'])) {

    $query = 'SELECT p.id, p.user_id, p.title, p.content, UNIX_TIMESTAMP(p.date) AS date, p.color, p.created_at FROM post_it AS p INNER JOIN users AS u ON u.id = p.user_id WHERE u.id=:id AND p.deleted_at IS NOT NULL ORDER BY deleted_at DESC';
    $response = $bdd->prepare($query);
    $response->execute([
        'id' => $_SESSION['user']['id']
    ]);
    $datas = $response->fetchAll();

} else {
    header('location: index.php');
    exit();
}

?>

<?php include 'layout/header.php' ?>

<section class="center">
    <h1>Corbeille</h1>

    <?php if (count($datas) > 0) { ?>
        <?php if (isset($_SESSION['user'])) { ?>
            <a class="button" href="" onclick="event.preventDefault(); document.getElementById('trash_clean').submit();"
                title="Vider la corbeille">Vider la corbeille</a>
        <?php } ?>

        <form id="trash_clean" action="clear_trash.php" method="post" hidden>
            <input type="hidden" name="id" value="<?= $datas[0]['user_id'] ?>">
        </form>
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

                        <a href=""
                            onclick="event.preventDefault(); document.getElementById('restore_<?= $data['id'] ?>').submit();"
                            title="Supprimer le post-it"><img width="30" height="30"
                            src="https://img.icons8.com/external-sbts2018-solid-sbts2018/58/external-restore-basic-ui-elements-2.3-sbts2018-solid-sbts2018.png"
                            alt="restore" /></a>
                    </div>

                    <form id="restore_<?= $data['id'] ?>" action="restore.php" method="post" hidden>
                            <input type="hidden" name="id" value="<?= $data['id'] ?>">
                        </form>

                    <p>
                        <?= nl2br($data['content']) ?>
                    </p>
                    <p>
                        <?= date('d/m/Y', $data['date']) ?>
                    </p>
                </article>
            <?php } ?>
        <?php } else { ?>
            <h2>Connectez-vous pour voir votre corbeille.</h2>
        <?php } ?>
    </div>
</section>

<?php include 'layout/footer.php' ?>