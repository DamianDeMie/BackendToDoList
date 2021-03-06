<?php
//Starts the database connection.
require __DIR__ . '\connectToDB.php';

//Prepares and executes the statement getting the ID of the list you are currently in.
$stmt = $conn->prepare("SELECT * FROM lists WHERE list_id=:list_id");
$stmt->bindParam(':list_id', $_GET['list_id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch();

$conn = null;
//Checks if there is anything in the POST for the property task_name, if so executes the createTask function.
if (isset($_POST['task_name'])) {
    echo createTask();
}
function createTask()
{
    //Starts the database connection.
    require __DIR__ . '\connectToDB.php';
    //Prepares the statement to create the tasks, it then binds the parameters using PDO compliance and then redirects back to the list page.
    $stmt = $conn->prepare("INSERT INTO tasks (task_name, list_id, task_time, task_status) VALUES (:task_name, :list_id, :task_time, :task_status)");
    $stmt->bindParam(':task_name', $_POST['task_name'], PDO::PARAM_STR);
    $stmt->bindParam(':list_id', $_POST['list_id'], PDO::PARAM_INT);
    $stmt->bindParam(':task_time', $_POST['task_time'], PDO::PARAM_STR);
    $stmt->bindParam(':task_status', $_POST['task_status'], PDO::PARAM_STR);
    $stmt->execute();
    $conn = null;

    header("location:showList.php?id=" .  $_POST['list_id']);
};
include __DIR__ . '\header.php';
?>

<body>
    <div class="container">
        <h1>Taak toevoegen aan lijst "<?php echo $result['list_name'] ?>"</h1>
        <form action="createTask" method="POST">
            <input type="hidden" id="list_id" name="list_id" value="<?php echo $result['list_id'] ?>">
            <div class="form-group">
                <label for="task_name">Taak beschrijving: </label>
                <input type="text" class="form-control" name="task_name" placeholder="Voer hier uw taakbeschrijving in" required>
                <small id="tasknameHelp" class="form-text text-muted">Een voorbeeld is: "Boodschappen doen"</small>
            </div>
            <div class="form-group">
                <label for="task_time">Tijd benodigd (in minuten):</label>
                <input type="number" class="form-control" name="task_time" max="1440" required>
            </div>
            <div class="form-group">
                <label for="task_status">Status van de taak</label>
                <select class="form-control" name="task_status" id="task_status" required>
                    <option>Nog niet begonnen</option>
                    <option>Bezig</option>
                    <option>Afgemaakt</option>
                </select>
            </div>
            <button type="submit" class="btn btn-primary">Taak toevoegen aan lijst</button>
        </form>
    </div>
</body>

</html>