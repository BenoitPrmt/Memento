<?php
include 'connection.php';

session_start();

$pageTitle = "Inscription";

if (count($_POST) > 0) {
    $token = $_POST['token'];
    if (!$token || $token !== $_SESSION['token']) {
        header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
        exit;
    } else {
        foreach ($_POST as $data) {
            if (strlen($data) === 0) {
                echo "Veuillez renseigner tous les champs";
                exit;
            }
        }

        if (filter_var($_POST['email'] === false)) {
            echo "Votre email est invalide";
            exit;
        } else if (strlen($_POST["password"]) < 8) {
            echo "Votre mot de passe doit faire au moins 8 caractères";
            exit;
        }

        if ($_POST['password'] !== $_POST['password_conf']) {
            echo "Votre mot de passe est différent";
            exit;
        }

        $query = 'INSERT INTO users (id, username, email, password) VALUES (NULL, :username, :email, :password)';
        $response = $bdd->prepare($query);
        $response->execute([
            'username' => $_POST['username'],
            'email' => $_POST['email'],
            'password' => password_hash($_POST['password'], PASSWORD_DEFAULT),
        ]);

        header('location: index.php');
        exit;
    }
}

?>

<?php include 'layout/header.php' ?>

<section class="center">
    <h1>Inscription</h1>
</section>

<section class="container form-section">
    <form action="register.php" method="post" enctype="multipart/form-data">
        <input type="text" name="username" placeholder="Username">
        <input type="email" name="email" placeholder="Email">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_conf" placeholder="Password confirmation">

        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">

        <button type="submit" class="button">Register</button>
    </form>
</section>

<?php include 'layout/footer.php' ?>