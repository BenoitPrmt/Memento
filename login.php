<?php
include 'connection.php';

session_start();

if (count($_POST) > 0) {
    if (!strlen($_POST["login"]) > 0 || filter_var($_POST['login']) === false) {
        echo "Votre email est invalide";
        exit;
    } else if (strlen($_POST["password"]) < 8) {
        echo "Votre mot de passe doit faire au moins 8 caractères";
        exit;
    }

    $query = 'SELECT id, email, password FROM users WHERE email=:email';
    $response = $bdd->prepare($query);
    $response->execute([
        'email' => $_POST['login']
    ]);
    $userData = $response->fetch();

    if ($userData === false) {
        echo "Identifiants incorrects";
        exit;
    }

    if (password_verify($_POST["password"], $userData['password'])) {
        $_SESSION['user'] = [
            'email' => $_POST["login"]
        ];
        header('location: index.php');
        exit;
    } else {
        echo "Identifiants incorrects";
    }
} else {
    if (isset($_SESSION['user'])) {
        header('location: index.php');
        exit;
    }
}
?>

<?php include 'layout/header.php' ?>

<section class="container">
    <form action="login.php" method="post">
        <input type="email" name="login" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <button type="submit">Login</button>
    </form>
</section>

<?php include 'layout/footer.php' ?>