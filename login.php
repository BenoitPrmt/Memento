<?php
include 'connection.php';

session_start();

$pageTitle = "Connexion";

if (count($_POST) > 0) {
    $token = $_POST['token'];
    if (!$token || $token !== $_SESSION['token']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    } else {
        if (!strlen($_POST["login"]) > 0 || filter_var($_POST['login']) === false) {
            echo "Votre email est invalide";
            exit;
        } else if (strlen($_POST["password"]) < 8) {
            echo "Votre mot de passe doit faire au moins 8 caractères";
            exit;
        }

        $query = 'SELECT id, username, email, password FROM users WHERE email=:email';
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
                'id' => $userData['id'],
                'username' => $userData['username']
            ];
            header('location: index.php');
            exit;
        } else {
            echo "Identifiants incorrects";
        }
    }
} else {
    if (isset($_SESSION['user'])) {
        header('location: index.php');
        exit;
    }
}
?>

<?php include 'layout/header.php' ?>

<section class="center">
    <h1>Connexion</h1>
</section>

<section class="container form-section">
    <form action="login.php" method="post">
        <input type="email" name="login" placeholder="Email">
        <input type="password" name="password" placeholder="Password">

        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">

        <button type="submit" class="button">Login</button>
    </form>
</section>

<?php include 'layout/footer.php' ?>