<?php
include "../../models/Item.php";
class ItemController{

    public static function getAll() {
        $items = Item::all();
        return $items;
    }
    public static function findByCategory($categoryId) {
        $items = Item::findByCategory($categoryId);
      //  print_r($items);die;
        return $items;
    }

public static function find($id){
    $item = Item::find($id);
    return $item;
}

public static function store() {
    $item = new Item();
    $item->title = $_POST['title'];
    $item->price = $_POST['price'];
    $item->description = $_POST['description'];
    $item->image = $_POST['image'];
    $item->category_id = $_POST['category_id'];
    $item->save();
}
public static function update($id) {
    $item = Item::find($id);
    $item->title = $_POST['title'];
    $item->price = $_POST['price'];
    $item->description = $_POST['description'];
    $item->image = $_POST['image'];
    $item->category_id = $_POST['category_id'];

    $item->update();
}

public static function destroy($id) {
    Item::destroy($id);
}
// Replace 'your_database_name', 'your_username', 'your_password', and 'categories' with your actual database credentials and table name respectively
function showIds() {
    $pdo = new PDO('mysql:host=localhost;dbname=Shopas', 'root', '');

    // Fetch IDs from the 'categories' table
    $stmt = $pdo->query("SELECT id FROM categories");
    $ids = $stmt->fetchAll(PDO::FETCH_COLUMN);

    // Display the list of IDs
    echo '<ul>';
    foreach ($ids as $id) {
        echo '<li>' . htmlspecialchars($id) . '</li>';
    }
    echo '</ul>';
}

}

?>