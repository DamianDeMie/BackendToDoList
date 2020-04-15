<?php
//Starts the database connection.

include __DIR__ . '\header.php';

//Prepares and executes the statement getting the ID of the list you are currently in.
$stmt = $conn->prepare("SELECT * FROM lists WHERE list_id=:list_id");
$stmt->bindParam(':list_id', $_GET['id'], PDO::PARAM_INT);
$stmt->execute();

$result = $stmt->fetch();
$conn = null;

//Checks if there is anything in the POST for the property list_name, if so executes the updateList function.

if (isset($_POST['list_name'])) {
    echo updateList();
}
function updateList()
{
    //Starts the database connection.

    include 'connectToDB.php';
    //Prepares the statement to update the list, it then binds the parameters using PDO compliance and then redirects back to the index page.

    $stmt = $conn->prepare("UPDATE lists SET list_name = :list_name WHERE list_id=:list_id");
    $stmt->bindParam(':list_name', $_POST['list_name'], PDO::PARAM_STR);
    $stmt->bindParam(':list_id', $_POST['list_id'], PDO::PARAM_INT);
    $stmt->execute();
    $conn = null;
    header("location:../index.php");
};
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <div class="container">
        <h1>Lijstnaam aanpassenn</h1>
        <form action="updateList" method="POST">
            <div class="form-group">
                <label for="list_name">Lijstnaam</label>
                <input type="text" class="form-control" name="list_name" value="<?php echo $result['list_name'] ?>" placeholder="<?php echo $result['list_name'] ?>" required>
                <input type="hidden" name="list_id" value="<?php echo $result['list_id'] ?>">
            </div>
            <button type=" submit" class="btn btn-primary">Naam aanpassen</button>
        </form>
    </div>
</body>

</html>