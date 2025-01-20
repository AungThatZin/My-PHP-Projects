<?php
include 'Repository.php'; 

if (isset($_GET['id'])) {
    $productId = intval($_GET['id']); 

    $repository = new Repository();
    $conn = $repository->getConnection();

    
    $sql = "DELETE FROM product_data WHERE Product_ID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $productId);

    if ($stmt->execute()) {
        
        echo json_encode(['success' => true]);
    } else {

        echo json_encode(['success' => false, 'message' => 'Failed to delete the product.']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request.']);
}
?>
