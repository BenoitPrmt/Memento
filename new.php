<?php
include 'connection.php';

session_start();

if (isset($_SESSION['user'])) {
    if (count($_POST) > 0) {
        $token = $_POST['token'];
        if (!$token || $token !== $_SESSION['token']) {
            // return 405 http status code
            header($_SERVER['SERVER_PROTOCOL'] . ' 405 Method Not Allowed');
            exit;
        } else {

            if (strlen($_POST['title']) !== 0 || strlen($_POST['content']) !== 0 || strlen($_POST['date']) !== 0) {
                $queryUser = 'SELECT id FROM users WHERE email=:email';
                $responseUser = $bdd->prepare($queryUser);
                $responseUser->execute([
                    ':email' => $_SESSION['user']['email']
                ]);
                $userData = $responseUser->fetch();

                $query = 'INSERT INTO post_it (id, user_id, title, content, date, color) VALUES (NULL, :user_id, :title, :content, :date, :color)';
                $response = $bdd->prepare($query);
                $response->execute([
                    'user_id' => $userData['id'],
                    'title' => $_POST['title'],
                    'content' => $_POST['content'],
                    'date' => $_POST['date'],
                    'color' => $_POST['color']
                ]);

                header('location: index.php');
                exit();
            } else {
                echo '<p class="error-text">Veuillez renseigner tous les champs</p>';
            }
        }
    }
} else {
    header('location: index.php');
    exit();
}

?>

<?php include 'layout/header.php' ?>

<section class="container form-section">
    <form action="new.php" method="post">
        <label for="title">Titre</label>
        <input type="text" id="title" name="title" placeholder="Titre du post-it"><br>

        <label for="content">Contenu</label>
        <textarea type="text" id="content" name="content" rows="10" placeholder="Contenu du post-it"></textarea><br>

        <label for="date">Date de la tâche</label>
        <input type="date" id="date" name="date"><br>

        <label for="color">Couleur du post-it</label>
        <input type="color" id="color" name="color" value="#ffff99"><br>

        <input type="hidden" name="token" value="<?php echo $_SESSION['token'] ?? '' ?>">

        <button type="submit" class="button">Enregistrer</button>
    </form>
</section>

<?php include 'layout/footer.php' ?>