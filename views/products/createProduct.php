<?php
include "../../Controllers/ItemController.php";

//jei atejai su post, atnaujinam irasa, ir redirectinam i index.php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ItemController::store();
    header("Location: ./productsList.php");
}

?>
<?php
if (!isset($_GET['id'])) {
    header("Location: ./productsList.php");
}
$items = ItemController::findByCategory($_GET['id']);
//print_r("$items");die;
include "../../Controllers/CategoryController.php";
//$item = ItemController::find($_GET['id']);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
</head>

<body class="bg-light">
    <div class="container mt-5 ">
        <div class="row bg-secondary bg-gradient bg-opacity-25">
            <div class="col"></div>
            <div class="col-10">
                <form action="./createProduct.php" method="POST">
                    <div class="form-group">
                        <label for="title">Title:</label>
                        <input type="text" class="form-control" name="title" placeholder="Enter Title">
                    </div>
                    <div class="form-group">
                        <label for="price">Price:</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter Price">
                    </div>
                    <div class="form-group">
                        <label for="image">Image link:</label>
                        <input type="text" class="form-control" name="image" placeholder="Enter Image Link">
                    </div>
                    <div class="form-group">
                        <label for="description">Description:</label>
                        <input type="text" class="form-control" name="description" placeholder="Enter Description">
                    </div>
                    <div>

                    <input type="hidden" name="category_id" value="<?= $_GET['id']?>">
                        <button type="submit" class="btn btn-primary">Submit</button>
                        <a class="btn btn-success" href="../../index.php">HomePage</a>
                    </div>
                </form>
            </div>
            <div class="col"></div>
        </div>
    </div>

</body>

</html>