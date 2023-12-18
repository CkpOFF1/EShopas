<link rel="stylesheet" href="./productimg.css">
<?php
include "../../Controllers/CategoryController.php";

if($_SERVER['REQUEST_METHOD'] == "POST"){
    CategoryController::destroy($_POST['id']);
    header("Location: ./index.php");
}

$categories = CategoryController::getAll();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Home Page</title>
</head>

<body style="background-image: url('https://blog.spoongraphics.co.uk/wp-content/uploads/2019/03/final-lg.jpg');>
    <div class="container">
        <h1>Categories are shown below</h1>
        <a class="btn btn-success" href="./create.php">Create new category</a>
        <table style="background-color:rgba(0, 0, 0, 0); width: 100%;">
            <tr style="color: red;">
                <th>No.</th>
                <th>Id</th>
                <th>Name</th>
                <th>Description</th>
                <th>Controls</th>
            </tr>
            <?php foreach ($categories as $key => $category) { ?>
                <tr style="color: aqua;">
                    <td> <?= $key + 1 ?> </td>
                    <td> <?= $category->id ?> </td>
                    <td> <?= $category->name ?> </td>
                    <td> <?= $category->description ?> </td>
                    <td>
                        <div class="d-inline-block">
                            <a class="btn btn-primary" href="./show.php?id=<?= $category->id ?>">show</a>
                        </div>
                        <div class="d-inline-block">
                            <form action="./edit.php" method="get">
                                <input type="hidden" name="id" value="<?= $category->id ?>">
                                <button class="btn btn-success" type="submit">edit</button>
                            </form>
                        </div>
                        <div class="d-inline-block">
                            <form action="./index.php" method="post">
                                <input type="hidden" name="id" value="<?= $category->id ?>">
                                <button class="btn btn-danger" type="submit">delete</button>
                            </form>
                        </div>
                    </td>
                </tr>
            <?php } ?>

        </table>
    </div>
</body>

</html>