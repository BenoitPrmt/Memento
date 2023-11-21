<?php
include 'connection.php';

session_start();

if (isset($_SESSION['user'])) {
    $query = 'DELETE FROM post_it WHERE user_id=:user_id AND deleted_at IS NOT NULL';
    $response = $bdd->prepare($query);
    $response->execute([
        'user_id' => $_POST['id']
    ]);
    
    header('location: index.php');
    exit();
} else {
    header('location: index.php');
    exit();
}

?>