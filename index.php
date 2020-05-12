<?php //Starts the database connection.
require __DIR__ . '\php\connectToDB.php';
require __DIR__ . '\php\getLists.php';

include __DIR__ . '\php\header.php';
?>

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
                        <td class="text-right">
                            <a class="btn btn-success" href='php/showlist.php?id=<?php echo $row['list_id'] ?>'>
                                <i class="far fa-folder-open"></i>
                            </a>
                            <a class="btn btn-warning" href=' php/updateList.php?id=<?php echo $row['list_id'] ?>'>
                                <i class=" far fa-edit"></i>
                            </a>
                            <a class="btn btn-danger" href=' php/deletelist.php?id=<?php echo $row['list_id'] ?>'>
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
            <a class="btn btn-primary text-white" href="php/createList.php">Nieuwe lijst aanmaken</a>
        </div>
    </div>
</body>

</html>