<?php //Starts the database connection.
require __DIR__ . '\connectToDB.php';


$stmt = $conn->prepare("SELECT `list_id`, `list_name` FROM `lists` WHERE `list_id` = :list_id");
$stmt->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch();

$stmt2 = $conn->prepare("SELECT * FROM tasks WHERE list_id = :list_id");
$stmt2->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt2->execute();

$result2 = $stmt2->fetchAll();
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
    <script src="https://kit.fontawesome.com/ac7f503449.js" crossorigin="anonymous"></script>
    <title>To-Do List</title>
</head>

<body>
    <div class="container">
        <h1><?php echo $result['list_name'] ?></h1>
        <table class="table">
            <div class="btn-group" role="group" aria-label="Basic example">
                <button type="button" onclick="filterTasks('Alles')" class="btn btn-secondary">Alle taken</button>
                <button type="button" onclick="filterTasks('Nog niet begonnen')" class="btn btn-secondary">Nog niet begonnen</button>
                <button type="button" onclick="filterTasks('Bezig')" class="btn btn-secondary">Bezig</button>
                <button type="button" onclick="filterTasks('Afgemaakt')" class="btn btn-secondary">Afgemaakt</button>

            </div>
            <thead>
                <tr>
                    <th scope="col">Taken</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result2 as $row) {
                ?>
                    <tr class="tasksTable <?php echo $row['task_status'] ?>">
                        <td><?php echo $row['task_name'] ?></td>
                        <td class="text-right">
                            <a class="btn btn-warning" href='updateTask.php?id=<?php echo $row['task_id'] ?>'>
                                <i class=" far fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" href='deleteTask.php?id=<?php echo $row['task_id'] ?>'>
                                <i class="fas fa-trash-alt"></i>
                            </a>
                        </td>
                    </tr>
                <?php } ?>
                <tr>
                </tr>
            </tbody>
        </table>
        <div class="col-12 text-center">
            <a class="btn btn-primary text-white" href="createTask.php?list_id=<?php echo $result['list_id'] ?>">Nieuwe taak aanmaken</a>
        </div>
    </div>
</body>

</html>