<?php //Starts the database connection.
include __DIR__ . '\header.php';

//Prepares and executes the statement getting the ID of the list you are currently in.
$stmt = $conn->prepare("SELECT `list_id`, `list_name` FROM `lists` WHERE `list_id` = :list_id");
$stmt->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch();

//Prepares and executes the statement fetching all the tasks that are linked to the above List ID.
$stmt2 = $conn->prepare("SELECT * FROM tasks WHERE list_id = :list_id");
$stmt2->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt2->execute();

$result2 = $stmt2->fetchAll();
$conn = null;
?>

<!DOCTYPE html>
<html lang="en">

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
                    <th scope="col">Status</th>
                    <th scope="col">Duur in minuten</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php //Puts all the tasks in a table with a foreach loop.
                foreach ($result2 as $row) {
                ?>
                    <tr class="tasksTable <?php echo $row['task_status'] ?>">
                        <td><?php echo $row['task_name'] ?></td>
                        <td><?php echo $row['task_status'] ?></td>
                        <td><?php echo $row['task_time'] ?></td>
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

<script>
    function filterTasks(taskStatus) {
        //These two constants gets the elements from the page and makes them available to be used.
        const taskRows = document.getElementsByClassName('tasksTable');
        const statusRow = document.getElementsByClassName(taskStatus);

        //Gets all the tasks through a loop, and checks if they're matched or not. If they aren't matched they show all if you select the 'ALles' option, otherwise it hides that particular category.
        for (var unmatchedTasks = 0; unmatchedTasks < taskRows.length; unmatchedTasks++) {
            if (taskStatus == 'Alles') {
                taskRows[unmatchedTasks].style.display = 'table-row';
            } else {
                taskRows[unmatchedTasks].style.display = 'none';
            }
        }

        //Shows the tasks that are matched to the criteria of your filter.
        for (var matchedTasks = 0; matchedTasks < statusRow.length; matchedTasks++) {
            statusRow[matchedTasks].style.display = 'table-row'
        }
    }
</script>

</html>