<?php
$stmt = $conn->prepare("SELECT * FROM `lists`");
$stmt->execute();
$result = $stmt->fetchAll();
$conn = null;
