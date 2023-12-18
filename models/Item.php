<?php
//include database
class Item
{
    public $id;
    public $title;
    public $price;

    public $description;
    public $image;
    public $category_id;

    public $quantity;
    

    public function __construct($id = 0, $title = "", $price = "" ,$description = "",$image = "", $category_id = "", $quantity =0)
    {
        $this->id = $id;
        $this->title = $title;
        $this->price = $price;
        $this->description = $description;
        $this->image = $image;
        $this->category_id = $category_id;
        $this->quantity = $quantity;
    }

    public static function all()
    {
        $items = [];
        $db = new mysqli("localhost", "root", "", "Shopas");
        $result = $db->query("SELECT * from items");
        while ($row = $result->fetch_assoc()) {
            $items[] = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['image'], $row['category_id']);
        }
        $db->close();
        return $items;
    }

    public static function find($id)
    {
        $item = new Item();
        $db = new mysqli("localhost", "root", "", "Shopas");
        // $sql = "SELECT * from authors where id = ?";
        $sql = " SELECT a.id, a.title, a.price, a.description,a.image,a.category_id, count(a.id) as 'quantity'
        FROM `items` a
        join quantity b 
        on a.id = b.item_id
        WHERE a.id = ?
        group by a.id;";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $item = new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['image'],$row['category_id'], $row['quantity']);
        }
        $db->close();

        return $item;
    }   public static function findByCategory($categoryId)
    {
        $items = [];
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "SELECT * from items where category_id = ?";
       
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $categoryId);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $items[]= new Item($row['id'], $row['title'], $row['price'], $row['description'], $row['image'],$row['category_id'], $row['quantity']);
        }
        $db->close();
//print_R($items);die;
        return $items;
    }

    public function save()
    {
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "INSERT INTO `items`(`title`, `price`, `description`,`image`,`category_id`) VALUES (?, ?, ?, ?,?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sissi", $this->title, $this->price, $this->description, $this->image, $this->category_id);
        $stmt->execute();
        $db->close();
    }

    public function update()
    {
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "UPDATE `items` SET `title`= ?,`price`= ?,`image`=?,`description`=?,`category_id`=? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("sissii", $this->title, $this->price, $this->description, $this->image,$this->category_id, $this->id);
        $stmt->execute();
        $db->close();
    }


    public static function destroy($id)
    {
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "DELETE FROM `items` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }





}