<link rel="stylesheet" href="productimg.css">

<?php
include "../../Controllers/ItemController.php";

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    ItemController::destroy($_POST['id']);
    header("Location: ./productsList.php");
}


?>
<?php
if (!isset($_GET['id'])) {
    header("Location: ../../index.php");
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
    <title>Products</title>
</head>

<body style="background-color: silver;">
    <header>
        <img src="../../images/<?= $_GET['id'] ?>head.jpeg" style="height: 350px; width: 100%;" alt="">
    </header>
    <div class="container">
        <h1>Products are shown below</h1>
        <a class="btn btn-success" href="./createProduct.php?id=<?= $_GET['id'] ?>">List a product</a>
        <a class="btn btn-success" href="../../index.php">HomePage</a>

        <?php foreach ($items as $key => $item) { ?>
            <div class="card" style=" width: 18rem;">
                <img src="<?= $item->image ?>" style="width 18rem;" alt="...">
                <div class="card-body">
                    <h5 class="card-title">
                        <?= $item->title ?>
                    </h5>
                    <p class="card-text">
                        <?= $item->description ?>
                    </p>
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item">
                        <?= $item->price . "Eur" ?>
                    </li>
                    <li class="list-group-item">
                        <?= $item->id ?>
                    </li>
                    <li class="list-group-item">Vestibulum at eros</li>
                </ul>
                <div class="card-body">
                    <div class="d-inline-block">
                        <a class="btn btn-primary" href="./show.php?id=<?= $item->id ?>">show</a>
                    </div>
                    <a href="" class="card-link">
                        <div class="d-inline-block">
                            <a class="btn btn-success" href="./edit.php?id=<?= $item->id ?>">edit</a>

                        </div>
                        <div class="d-inline-block">
                            <form action="./productsList.php" method="post">
                                <input type="hidden" name="id" value="<?= $item->id ?>">
                                <button class="btn btn-danger" type="submit">delete</button>
                            </form>
                        </div>
                </div>
            <?php } ?>
            </div>

</body>

</html>