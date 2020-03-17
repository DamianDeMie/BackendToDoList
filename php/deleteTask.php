<?php
include 'connectToDB.php';

$stmt = $conn->prepare("DELETE FROM tasks WHERE task_id = :task_id");
$stmt->bindParam(':task_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();
