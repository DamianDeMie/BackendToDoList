<?php //Starts the database connection.
require __DIR__ . '\connectToDB.php';


$stmt = $conn->prepare("SELECT * FROM tasks WHERE task_id=:task_id");
$stmt->bindParam(':task_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch();

if (isset($_POST['task_name'])) {
    echo updateTask();
}
function updateTask()
{
    include 'connectToDB.php';
    $stmt = $conn->prepare("UPDATE tasks SET task_name = :task_name, task_time = :task_time, task_status = :task_status WHERE task_id = :task_id");
    $stmt->bindParam(':task_name', $_POST['task_name'], PDO::PARAM_STR);
    $stmt->bindParam(':task_time', $_POST['task_time'], PDO::PARAM_STR);
    $stmt->bindParam(':task_status', $_POST['task_status'], PDO::PARAM_STR);
    $stmt->bindParam(':task_id', $_POST['task_id'], PDO::PARAM_INT);
    $stmt->execute();

    header("location:showList.php?id=" .  $_POST['list_id']);
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
        <h1>Taak "<?php echo $result['task_name'] ?>" aanpassen</h1>
        <form action="updateTask" method="POST">
            <div class="form-group">
                <label for="task_name">Taak beschrijving: </label>
                <input type="text" class="form-control" name="task_name" placeholder="Voer hier uw taakbeschrijving in" value="<?php echo $result['task_name'] ?>" required>
                <small id="tasknameHelp" class="form-text text-muted">Een voorbeeld is: "Boodschappen doen"</small>
            </div>
            <div class="form-group">
                <label for="task_time">Tijd benodigd (in minuten):</label>
                <input type="number" class="form-control" name="task_time" max="1440" value="<?php echo $result['task_time'] ?>" required>
            </div>
            <div class="form-group">
                <label for="task_status">Status van de taak</label>
                <select class="form-control" name="task_status" id="task_status" required>
                    <option>Nog niet begonnen</option>
                    <option>Bezig</option>
                    <option>Afgemaakt</option>
                </select>
            </div>
            <input type="hidden" name="task_id" value="<?php echo $result['task_id'] ?>">
            <input type="hidden" name="list_id" value="<?php echo $result['list_id'] ?>">
            <button type="submit" class="btn btn-primary">Taak toevoegen aan lijst</button>
        </form>
    </div>
</body>

</html>