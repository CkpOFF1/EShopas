<?php
include "../../Controllers/CategoryController.php";

//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if($_SERVER['REQUEST_METHOD'] == "POST"){
    CategoryController::store();
    header("Location: ./index.php");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-light">
    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-6">
                <form action="./create.php" method="POST">
                    <div class="form-group">
                        <label for="name">Name:</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Name">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter Description">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                    <a class="btn btn-success" href="./index.php">HomePage</a>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

</html>