<?php
//include database
class Category
{
    public $id;
    public $name;
    public $description;
    public $items;

    public function __construct($id = 0, $name = "", $description = "",$items = 0)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
        $this->items = $items;
    }

    public static function all()
    {
        $categories = [];
        $db = new mysqli("localhost", "root", "", "Shopas");
        $result = $db->query("SELECT * from categories");
        while ($row = $result->fetch_assoc()) {
            $categories[] = new Category($row['id'], $row['name'], $row['description']);
        }
        $db->close();
        return $categories;
    }

    public static function find($id)
    {
        $category = new Category();
        $db = new mysqli("localhost", "root", "", "Shopas");
        // $sql = "SELECT * from authors where id = ?";
        $sql = " SELECT a.id, a.name, a.description, count(a.id) as 'items'
        FROM `categories` a
        join items b 
        on a.id = b.category_id
        WHERE a.id = ?
        group by a.id;";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        while ($row = $result->fetch_assoc()) {
            $category = new Category($row['id'], $row['name'], $row['description'], $row['items']);
        }
        $db->close();

        return $category;
    }

    public function save()
    {
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "INSERT INTO `categories`(`name`, `description`) VALUES (?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ss", $this->name, $this->description);
        $stmt->execute();
        $db->close();
    }

    public function update()
    {
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "UPDATE `categories` SET `name`= ?,`description`= ? WHERE id = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("ssi", $this->name, $this->description, $this->id);
        $stmt->execute();
        $db->close();
    }


    public static function destroy($id)
    {
        $db = new mysqli("localhost", "root", "", "Shopas");
        $sql = "DELETE FROM `categories` WHERE `id` = ?";
        $stmt = $db->prepare($sql);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $db->close();
    }
}