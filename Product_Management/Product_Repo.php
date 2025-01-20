<?php
include 'Repository.php';

$productName = $_POST['productName'];
$productID = $_POST['productID'];
$supplierName = $_POST['supplierName'];
$contact = $_POST['contact'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$discount = $_POST['discount'];
$description = $_POST['description']; 
$dateAdded = $_POST['dateAdded'];
$link = $_POST['link'];

$imagePath = "";
if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    $imageName = $_FILES['image']['name'];
    $imageTmpName = $_FILES['image']['tmp_name'];
    $imageExt = strtolower(pathinfo($imageName, PATHINFO_EXTENSION));

    $newImageName = uniqid() . "." . $imageExt;

    $uploadDirectory = "C:/xampp/htdocs/Product_Management/image/";

    if (move_uploaded_file($imageTmpName, $uploadDirectory . $newImageName)) {
        $imagePath = "image/" . $newImageName; 
    } else {
        echo '<div class="alert alert-danger" role="alert">Error uploading image.</div>';
        exit;
    }
}

$repository = new Repository();
$conn = $repository->getConnection();

$sql = "INSERT INTO product_data (Product_Name, Product_ID, Supplier_Name, Contact, Price, Quantity, Discount, Description, Date, Link, Image) 
        VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
if (!$stmt) {
    echo '<div class="alert alert-danger" role="alert">Failed to prepare SQL query: ' . $conn->error . '</div>';
    exit;
}

$stmt->bind_param("ssssdiissss", $productName, $productID, $supplierName, $contact, $price, $quantity, $discount, $description, $dateAdded, $link, $imagePath);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Data inserted successfully!</div>';
} else {
    echo '<div class="alert alert-danger" role="alert">Failed to insert data: ' . $stmt->error . '</div>';
}

$stmt->close();
$conn->close();
?>
