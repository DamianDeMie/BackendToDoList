<?php
include 'connectToDB.php';

$stmt = $conn->prepare("DELETE FROM lists WHERE list_id = :list_id");
$stmt->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);

$stmt->execute();
header("location:../index.php");
