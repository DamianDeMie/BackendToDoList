<?php
//Starts the database connection.
require __DIR__ . '\connectToDB.php';
//Prepares the statement to delete the task, it then binds the parameters using PDO compliance and then redirects back to the list page.

$stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = :task_id");
$stmt->bindParam(':task_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$conn = null;

header('Location: ' . $_SERVER['HTTP_REFERER']);
