<?php
include 'Repository.php';

// Retrieve form data from the modal
$productName = $_POST['productName'];
$productID = $_POST['productID'];
$supplierName = $_POST['supplierName'];
$contact = $_POST['contact'];
$price = $_POST['price'];
$quantity = $_POST['quantity'];
$discount = $_POST['discount'];
$description = $_POST['description'];
$dateAdded = $_POST['date'];
$link = $_POST['link'];




$imagePath = ""; // Initialize an empty image path
$repository = new Repository();
$conn = $repository->getConnection();

if (isset($_FILES['image']) && $_FILES['image']['error'] == 0) {
    // Handle image upload
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

    // Update query including image
    $sql = "UPDATE product_data 
            SET Product_Name = ?, Supplier_Name = ?, Contact = ?, Price = ?, Quantity = ?, Discount = ?, Description = ?, Date = ?, Link = ?, Image = ?
            WHERE Product_ID = ?";
} else {
    // Update query excluding image
    $sql = "UPDATE product_data 
            SET Product_Name = ?, Supplier_Name = ?, Contact = ?, Price = ?, Quantity = ?, Discount = ?, Description = ?, Date = ?, Link = ?
            WHERE Product_ID = ?";
}

// Prepare the SQL statement
$stmt = $conn->prepare($sql);

if (!$stmt) {
    echo '<div class="alert alert-danger" role="alert">Failed to prepare SQL query: ' . $conn->error . '</div>';
    exit;
}

// Bind parameters
if ($imagePath) {
    $stmt->bind_param(
        "sssdiisssss",
        $productName,
        $supplierName,
        $contact,
        $price,
        $quantity,
        $discount,
        $description,
        $dateAdded,
        $link,
        $imagePath,
        $productID
    );
} else {
    $stmt->bind_param(
        "sssdiissss",
        $productName,
        $supplierName,
        $contact,
        $price,
        $quantity,
        $discount,
        $description,
        $dateAdded,
        $link,
        $productID
    );
}

error_log("Product_ID: " . $productID);
error_log("SQL Query: " . $sql);

if ($stmt->execute()) {
    echo '<div class="alert alert-success" role="alert">Product updated successfully!</div>';
    
} else {
    echo '<div class="alert alert-danger" role="alert">Failed to update product: ' . $stmt->error . '</div>';
}


$stmt->close();
$conn->close();
?>
