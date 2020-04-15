<?php

include __DIR__ . '\header.php';

//Checks if there is anything in the POST for the property list_name, if so executes the createList function.
if (isset($_POST['list_name'])) {
    echo createList();
}
function createList()
{
    //Connects to the Database.
    require __DIR__ . '\connectToDB.php';
    //Prepares the statement to create the list, it then binds the parameter using PDO compliance and then redirects back to the index page.
    $stmt = $conn->prepare("INSERT INTO lists (list_name) VALUES (:list_name)");
    $stmt->bindParam(':list_name', $_POST['list_name'], PDO::PARAM_STR);
    $stmt->execute();
    $conn = null;

    header("location:../index.php");
};
?>


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