<?php
include 'connection.php';

session_start();

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    exit;
}

$query = 'SELECT id, username, email, password, UNIX_TIMESTAMP(created_at) AS join_at FROM users WHERE email=:email';
$response = $bdd->prepare($query);
$response->execute([
    'email' => $_SESSION['user']['email']
]);
$userData = $response->fetch();

$query = 'SELECT count(title) AS total FROM post_it WHERE user_id=:user_id';
$response = $bdd->prepare($query);
$response->execute([
    'user_id' => $userData['id']
]);
$postCount = $response->fetch();

?>

<?php include 'layout/header.php' ?>

<section class="container center">
    <h1><?= $userData['username'] ?></h1>
    <p>Vous avez <?= $postCount['total'] ?> post-it</p>
    <p>Compte créé le <?= date('d/m/Y à H:i:s', $userData['join_at']) ?></p>
</section>

<?php include 'layout/footer.php' ?>