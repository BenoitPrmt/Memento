<?php
include 'connection.php';

session_start();

var_dump($_POST);

if (isset($_SESSION['user'])) {
    if (count($_POST) > 0) {

        $query = 'INSERT INTO post_it (id, title, content, date, color) VALUES (NULL, :title, :content, :date, :color)';
        $response = $bdd->prepare($query);
        $response->execute([
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