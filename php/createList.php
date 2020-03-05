<?php
if (isset($_POST['list_name'])) {
    echo createList();
}
function createList()
{
    include 'connectToDB.php';

    $stmt = $conn->prepare("INSERT INTO lists (list_name) VALUES (:list_name)");
    $stmt->bindParam(':list_name', $_POST['list_name'], PDO::PARAM_STR);
    $stmt->execute();

    header("location:../index.php");
};
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <title>To-Do List</title>
</head>

<body>
    <div class="container">
        <h1>Nieuwe lijst aanmaken</h1>
        <form action="createList" method="POST">
            <div class="form-group">
                <label for="list_name">Lijstnaam</label>
                <input type="text" class="form-control" name="list_name" placeholder="Voer hier uw lijstnaam in" required>
            </div>
            <button type="submit" class="btn btn-primary">Lijst aanmaken</button>
        </form>
    </div>
</body>

</html>