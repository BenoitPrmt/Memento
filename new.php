<?php 
include 'connection.php';

session_start();

if (count($_POST) > 0) {

    $query = 'INSERT INTO post_it (id, title, content, date, color) VALUES (NULL, :title, :content, :date, :color)';
    $response = $bdd->prepare($query);
    $response->execute([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'date' => $_POST['date'],
        'color' => "#FFFF99"
    ]);

    header('location: index.php');
    exit();

}

?>

<?php include 'header.php'?>

    <form action="new.php" method="post">
        <input type="text" id="title" name="title"><br>
        <textarea type="text" id="content" name="content"></textarea><br>
        <input type="date" id="date" name="date"><br>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>