<?php
include 'connection.php';

session_start();

if (isset($_SESSION['user'])) {
    if (count($_POST) > 0) {

        $queryUser = 'SELECT id FROM users WHERE email=:email';
        $responseUser = $bdd->prepare($queryUser);
        $responseUser->execute([
            ':email'=> $_SESSION['user']['email']
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
    }
} else {
    header('location: index.php');
    exit();
}

?>

<?php include 'layout/header.php' ?>

<section class="container">
    <form action="new.php" method="post">
        <input type="text" id="title" name="title"><br>
        <textarea type="text" id="content" name="content"></textarea><br>
        <input type="date" id="date" name="date"><br>
        <input type="color" id="color" name="color" value="#ffff99">
        <button type="submit">Enregistrer</button>
    </form>
</section>

<?php include 'layout/footer.php' ?>