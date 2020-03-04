<?php //Starts the database connection.
include __DIR__ . '\php\connectToDB.php';

$sql = "SELECT * FROM `lists`";
$query = $conn->prepare($sql);
$query->execute();
$result = $query->fetchAll();
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
        <h1>To-Do List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Lijst</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($result as $row) {
                ?>

                    <tr>
                        <td><?php echo $row['list_name'] ?></td>
                        <td class="text-right"><a class="btn btn-success" href="">Lijst openen</td>
                    </tr>
                <?php } ?>
                <tr>
                </tr>
            </tbody>
        </table>
        <div class="col-12 text-center">
            <a class="btn btn-primary text-white" href="php\createList.php">Nieuwe lijst aanmaken</a>
        </div>
    </div>
</body>

</html>