<?php
if (!isset($_GET['id'])) {
    header("Location: ./index.php");
}

include "../../Controllers/CategoryController.php";
$category = CategoryController::find($_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Document</title>
    <link rel="stylesheet" href="productimg.css">
</head>

<body>
    <div class="row">
        <div class="col"></div>
        <div class="col-6">


            <div class="card" style="width: 100%;">
                <img src="../../images/<?= $_GET['id']?>.jpeg" style="height: 300px; width: 400px;"  alt="...">
                <div class="card-body">
                    <h5 class="card-title"><?=$category->name . "  (" . $category->description .")"?></h5>
                    <p class="card-text">Browse products of <?=$category->name . " parts"?></p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">Total products for this brand: <?=$category->items?></li>
                </ul>
                <div class="card-body">
                    <a href="../products/productsList.php?id=<?= $_GET['id'] ?>" class="card-link">Browse products</a>
                    <a href="./index.php" class="card-link">Show all categories</a>
                </div>
            </div>
        </div>
        <div class="col"></div>
    </div>
</body>

</html>