<?php
include 'connection.php';

session_start();

$query = 'DELETE FROM post_it WHERE id=:id';
$response = $bdd->prepare($query);
$response->execute([
    'id' => $_GET['id']
]);

header('location: index.php');
exit();

?>