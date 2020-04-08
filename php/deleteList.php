<?php
//Starts the database connection.
require __DIR__ . '\connectToDB.php';
//Prepares the statement to delete the list, it also deletes the tasks that are linked to the list. After that it then binds the parameters using PDO compliance and then redirects back to the index page.

$stmt = $conn->prepare("DELETE FROM lists WHERE list_id = :list_id");
$stmt->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt2 = $conn->prepare("DELETE FROM tasks WHERE list_id = :list_id");
$stmt2->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);

$stmt->execute();
$stmt2->execute();

header('Location: ' . $_SERVER['HTTP_REFERER']);
