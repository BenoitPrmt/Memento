<?php 
include 'connection.php';

if (count($_POST) > 0) {

    $query = 'INSERT INTO post_it (id, title, content, date) VALUES (NULL, :title, :content, :date)';
    $response = $bdd->prepare($query);
    $response->execute([
        'title' => $_POST['title'],
        'content' => $_POST['content'],
        'date' => $_POST['date']
    ]);

    header('location: index.php');
    exit();

}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ajouter un post-it</title>
</head>
<body>
    <form action="new.php" method="post">
        <input type="text" id="title" name="title"><br>
        <textarea type="text" id="content" name="content"></textarea><br>
        <input type="date" id="date" name="date"><br>
        <button type="submit">Enregistrer</button>
    </form>
</body>
</html>