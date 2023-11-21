<?php
include 'connection.php';

session_start();

$pageTitle = "Mon profil";

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit;
}

$query = 'SELECT UNIX_TIMESTAMP(created_at) AS join_at FROM users WHERE id=:id';
$response = $bdd->prepare($query);
$response->execute([
    'id' => $_SESSION['user']['id']
]);
$userData = $response->fetch();

$query = 'SELECT count(title) AS total FROM post_it WHERE user_id=:user_id AND deleted_at IS NULL';
$response = $bdd->prepare($query);
$response->execute([
    'user_id' => $_SESSION['user']['id']
]);
$postCount = $response->fetch();

?>

<?php include 'layout/header.php' ?>

<section class="container center">
    <h1>
        <?= $_SESSION['user']['username'] ?>
    </h1>
    <p>Vous avez
        <?= $postCount['total'] ?> post-it
    </p>
    <p>Compte créé le
        <?= date('d/m/Y à H:i:s', $userData['join_at']) ?>
    </p>
</section>

<?php include 'layout/footer.php' ?>