<?php
// Include the Repository class
include 'Repository.php';

// Create an instance of Repository
$repository = new Repository();
$conn = $repository->getConnection();

// Fetch data from the database
$sql = "SELECT * FROM product_data";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Table with Side Menu</title>

    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="CSS/product.css">
    <link rel="stylesheet" type="text/css" href="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.css">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

</head>
<body>

    <?php include 'sideMenu.php' ?>
    <button id="menuToggle">
        <i class="fas fa-bars" id="menuIcon"></i>
    </button>
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto" style="padding-left: 300px;">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Dropdown
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Action</a>
                        <a class="dropdown-item" href="#">Another action</a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="#">Something else here</a>
                    </div>
                </li>
                <li class="nav-item">
                    <a class="nav-link disabled" href="#">Disabled</a>
                </li>
            </ul>
            <form class="form-inline my-2 my-lg-0">
                <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </nav>
    <div class="table-container" id="tableContainer">
        <table>
            <thead>
                <tr>
                    <th colspan="2">Product Details <i class="fas fa-box"></i></th>
                    <th colspan="2">Supplier Info <i class="fas fa-industry"></i></th>
                    <th colspan="3">Pricing <i class="fas fa-dollar-sign"></i></th>
                    <th>Media <i class="fas fa-image"></i></th>
                    <th colspan="4">Additional Info <i class="fas fa-info-circle"></i></th>
                </tr>
                <tr>
                    <th>Product Name <i class="fas fa-tag"></i></th>
                    <th>Product ID <i class="fas fa-barcode"></i></th>
                    <th>Supplier Name <i class="fas fa-user"></i></th>
                    <th>Contact <i class="fas fa-phone"></i></th>
                    <th>Price <i class="fas fa-tags"></i></th>
                    <th>Quantity <i class="fas fa-boxes"></i></th>
                    <th>Discount <i class="fas fa-percentage"></i></th>
                    <th>Image <i class="fas fa-camera"></i></th>
                    <th>Description <i class="fas fa-file-alt"></i></th>
                    <th>Date Added <i class="fas fa-calendar"></i></th>
                    <th>Link <i class="fas fa-link"></i></th>
                    <th>Actions <i class="fas fa-tools"></i></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>
                            <td>{$row['Product_Name']}</td>
                            <td>{$row['Product_ID']}</td>
                            <td>{$row['Supplier_Name']}</td>
                            <td>{$row['Contact']}</td>
                            <td>\${$row['Price']}</td>
                            <td>{$row['Quantity']}</td>
                            <td>{$row['Discount']}</td>
                            <td><img src='{$row['Image']}' alt='Image' style='max-width: 160px; height: auto;'></td>
                            <td>{$row['Description']}</td>
                            <td>{$row['Date']}</td>
                            <td><a href='{$row['Link']}'>Details</a></td>
                             <td>
                    <button 
                        class='btn btn-warning btn-sm edit-btn' 
                        data-toggle='modal' 
                        data-target='#editModal'
                        data-id='{$row['Product_ID']}'
                        data-name='{$row['Product_Name']}'
                        data-supplier='{$row['Supplier_Name']}'
                        data-contact='{$row['Contact']}'
                        data-price='{$row['Price']}'
                        data-quantity='{$row['Quantity']}'
                        data-discount='{$row['Discount']}'
                        data-description='{$row['Description']}'
                        data-date='{$row['Date']}'
                        data-link='{$row['Link']}'
                        data-image='{$row['Image']}'>
                        <i class='fas fa-edit'></i>
                    </button>
   <a href='/Product_Management/Product_Delete.php?id=123' class='btn btn-danger btn-sm delete-btn'>
    <i class='fas fa-trash-alt'></i>
</a>


                        </td>
                        </tr>";
                        }
                    } else {
                        echo "<tr><td colspan='11'>No data found</td></tr>";
                    }
                    ?>
            </tbody>
        </table>
    </div>




    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Edit Product</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="editForm" method="POST" action="Product_Edit.php" enctype="multipart/form-data">
                        <div>
                            <div class="form-group half-width">
                                <label for="productID">Product ID</label>
                                <input type="text" class="form-control" id="productID" name="productID" readonly>
                            </div>
                            <div class="form-group half-width">
                                <label for="productName">Product Name</label>
                                <input type="text" class="form-control" id="productName" name="productName" required>
                            </div>
                        </div>
                        <!-- Side-by-side inputs -->
                        <div>
                            <div class="form-group half-width">
                                <label for="supplierName">Supplier Name</label>
                                <input type="text" class="form-control" id="supplierName" name="supplierName" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="contact">Contact</label>
                                <input type="text" class="form-control" id="contact" name="contact" required>
                            </div>
                        </div>
                        <!-- Side-by-side inputs -->
                        <div>
                            <div class="form-group half-width">
                                <label for="price">Price</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="quantity">Quantity</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" required>
                            </div>
                        </div>
                        <!-- Side-by-side inputs -->
                        <div>
                            <div class="form-group half-width">
                                <label for="discount">Discount</label>
                                <input type="number" class="form-control" id="discount" name="discount" required>
                            </div>
                            <div class="form-group half-width">
                                <label for="date">Date Added</label>
                                <input type="date" class="form-control" id="date" name="date" required>
                            </div>
                        </div>
                        <div>
                            <div class="form-group half-width">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" required></textarea>
                            </div>
                            <div class="form-group half-width">
                                <label for="link">Link</label>
                                <input type="url" class="form-control" id="link" name="link" required>
                            </div>
                        </div>
                        <!-- Image Section -->
                        <div class="form-group image-section">
                            <label for="image">Image</label>
                            <img id="productImage" style="max-width: 100px; display: block; margin-bottom: 10px;" />
                            <input type="file" class="form-control" id="image" name="image">
                        </div>
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
     $(document).ready(function () {
    // Edit button functionality
    $('.edit-btn').on('click', function () {
        const productID = $(this).data('id');
        const productName = $(this).data('name');
        const supplierName = $(this).data('supplier');
        const contact = $(this).data('contact');
        const price = $(this).data('price');
        const quantity = $(this).data('quantity');
        const discount = $(this).data('discount');
        const description = $(this).data('description');
        const date = $(this).data('date');
        const link = $(this).data('link');
        const image = $(this).data('image');

        $('#productID').val(productID);
        $('#productName').val(productName);
        $('#supplierName').val(supplierName);
        $('#contact').val(contact);
        $('#price').val(price);
        $('#quantity').val(quantity);
        $('#discount').val(discount);
        $('#description').val(description);
        $('#date').val(date);
        $('#link').val(link);
        $('#productImage').attr('src', image);
    });

    // Form submission with AJAX
    $('#editForm').on('submit', function (e) {
        e.preventDefault();
        const formData = new FormData(this);

        $.ajax({
            url: $(this).attr('action'),
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function (response) {
                alert('Product updated successfully!');
                location.reload();
            },
            error: function () {
                alert('Failed to update product. Please try again.');
            }
        });
    });
});


    </script>



<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<script src="https://common.olemiss.edu/_js/sweet-alert/sweet-alert.min.js"></script>
<script src="script/product.js"></script>


</body>

</html>