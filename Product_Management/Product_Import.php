<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Insert Form</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
<link rel="stylesheet" href="CSS/product_import.css">
</head>
<body>

    <!-- Side Menu -->
    <div class="side-menu" id="sideMenu">
        <div class="menu-header">Menu</div>
        <ul>
            <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
            <li><a href="product.php"><i class="fas fa-box"></i> Products</a></li>
            <li><a href="Product_Import.php"><i class="fas fa-industry"></i> Products Import</a></li>
            <li><a href="#"><i class="fas fa-info-circle"></i> About</a></li>
            <li><a href="#"><i class="fas fa-phone"></i> Contact</a></li>
        </ul>
    </div>


    <!-- Product Insert Form -->
    <div class="form-container" id="form-container">
        <h2>Product Insert Form</h2>
        <form action="Product_Repo.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="form-group">
                    <label for="productName"><i class="fas fa-tag"></i> Product Name</label>
                    <input type="text" id="productName" name="productName" required>
                </div>
                <div class="form-group">
                    <label for="productID"><i class="fas fa-barcode"></i> Product ID</label>
                    <input type="text" id="productID" name="productID" required>
                </div>
                <div class="form-group">
                    <label for="supplierName"><i class="fas fa-user"></i> Supplier Name</label>
                    <input type="text" id="supplierName" name="supplierName" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="contact"><i class="fas fa-phone"></i> Contact</label>
                    <input type="text" id="contact" name="contact" required>
                </div>
                <div class="form-group">
                    <label for="price"><i class="fas fa-tags"></i> Price</label>
                    <input type="number" id="price" name="price" required>
                </div>
                <div class="form-group">
                    <label for="quantity"><i class="fas fa-boxes"></i> Quantity</label>
                    <input type="number" id="quantity" name="quantity" required>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="discount"><i class="fas fa-percentage"></i> Discount</label>
                    <input type="number" id="discount" name="discount">
                </div>
                <div class="form-group">
    <label for="image"><i class="fas fa-camera"></i> Image</label>
    <input type="file" id="image" name="image" accept="image/*" onchange="previewImage(event)">
    <div id="previewContainer">
        <img id="imagePreview" src="#" alt="Image Preview" style="display: none;">
    </div>
</div>

                <div class="form-group">
                    <label for="description"><i class="fas fa-file-alt"></i> Description</label>
                    <textarea id="description" name="description" rows="4"></textarea>
                </div>
            </div>

            <div class="row">
                <div class="form-group">
                    <label for="dateAdded"><i class="fas fa-calendar"></i> Date Added</label>
                    <input type="date" id="dateAdded" name="dateAdded" required>
                </div>
                <div class="form-group">
                    <label for="link"><i class="fas fa-link"></i> Link</label>
                    <input type="url" id="link" name="link">
                </div>
            </div>

            <div class="form-group">
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>

    <script>
        const sideMenu = document.getElementById('sideMenu');
        const menuToggle = document.getElementById('menuToggle');
        const tableContainer = document.getElementById('form-container');

        // Ensures side menu stays fixed
        window.addEventListener('load', () => {
            sideMenu.style.position = 'fixed';
        });

        // Toggle menu visibility
        menuToggle.addEventListener('click', () => {
            sideMenu.classList.toggle('active');
            tableContainer.classList.toggle('shifted');
        });

    function previewImage(event) {
        const file = event.target.files[0];
        const preview = document.getElementById('imagePreview');
        const previewContainer = document.getElementById('previewContainer');

        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.style.display = 'block';
            };
            reader.readAsDataURL(file);
        } else {
            preview.src = '#';
            preview.style.display = 'none';
        }
    }

    </script>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
