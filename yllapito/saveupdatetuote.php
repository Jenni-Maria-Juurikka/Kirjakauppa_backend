<?php 

$id = filter_input(INPUT_POST, "id", FILTER_SANITIZE_NUMBER_INT);
$name = filter_input(INPUT_POST, "name", FILTER_SANITIZE_STRING);
$author = filter_input(INPUT_POST, "author", FILTER_SANITIZE_STRING);
$price = filter_input(INPUT_POST, "price", FILTER_SANITIZE_STRING);
$image = filter_input(INPUT_POST, "image", FILTER_SANITIZE_STRING);
$category_id = filter_input(INPUT_POST, "category_id", FILTER_SANITIZE_NUMBER_INT);

$host = "localhost";
$database = "kirjakauppa";
$user = "root";

try {
    $db = new PDO("mysql:host=$host;dbname=$database;chartset=utf8", $user, '');
    $db->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
    $update = $db->prepare("UPDATE tuote SET name = :name, author = :author, 
        price = :price, image = :image, category_id = :category_id WHERE id = :id");

    $update->bindValue(":id", $id, PDO::PARAM_INT);
    $update->bindValue(":name", $name, PDO::PARAM_STR);
    $update->bindValue(":author", $author, PDO::PARAM_STR);
    $update->bindValue(":price", $price, PDO::PARAM_STR);
    $update->bindValue(":image", $image, PDO::PARAM_STR);
    $update->bindValue(":category_id", $category_id, PDO::PARAM_INT);

    $update->execute();

    header("Location: http://localhost/kirjakauppa/index.php");

} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    }

?>