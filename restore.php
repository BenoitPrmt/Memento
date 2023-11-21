<?php
include 'connection.php';

session_start();

if (isset($_SESSION['user'])) {
    $query = 'UPDATE post_it SET deleted_at=NULL WHERE id=:id';
    $response = $bdd->prepare($query);
    $response->execute([
        'id' => $_POST['id']
    ]);

    header('location: index.php');
    exit();
} else {
    header('location: index.php');
    exit();
}

?>