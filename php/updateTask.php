<?php //Starts the database connection.
include __DIR__ . '\header.php';

//Prepares and executes the statement getting the ID of the task you are currently in.

$stmt = $conn->prepare("SELECT * FROM tasks WHERE task_id=:task_id");
$stmt->bindParam(':task_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch();
$conn = null;
//Checks if there is anything in the POST for the property task_name, if so executes the updateTask function.

if (isset($_POST['task_name'])) {
    echo updateTask();
}
function updateTask()
{
    //Starts the database connection.
    include 'connectToDB.php';
    //Prepares the statement to update the task, it then binds the parameters using PDO compliance and then redirects back to the list page
    $stmt = $conn->prepare("UPDATE tasks SET task_name = :task_name, task_time = :task_time, task_status = :task_status WHERE task_id = :task_id");
    $stmt->bindParam(':task_name', $_POST['task_name'], PDO::PARAM_STR);
    $stmt->bindParam(':task_time', $_POST['task_time'], PDO::PARAM_STR);
    $stmt->bindParam(':task_status', $_POST['task_status'], PDO::PARAM_STR);
    $stmt->bindParam(':task_id', $_POST['task_id'], PDO::PARAM_INT);
    $stmt->execute();

    header("location:showList.php?id=" .  $_POST['list_id']);
};
?>

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