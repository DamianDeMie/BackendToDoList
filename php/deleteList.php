<?php
include 'connectToDB.php';

$stmt = $conn->prepare("DELETE FROM lists WHERE list_id = :list_id");
$stmt->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt2 = $conn->prepare("DELETE FROM tasks WHERE list_id = :list_id");
$stmt2->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);

$stmt->execute();
$stmt2->execute();
header("location:../index.php");
