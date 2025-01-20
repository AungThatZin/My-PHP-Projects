let sideMenu = document.getElementById('sideMenu');
let tableContainer = document.getElementById('tableContainer');


document.getElementById('menuToggle').addEventListener('click', () => {
    sideMenu.classList.toggle('active');
    tableContainer.classList.toggle('shifted');
});
document.getElementById('menuToggle').addEventListener('click', function() {
    this.classList.toggle('active');
});
document.addEventListener('DOMContentLoaded', function () {
    // Attach event listeners to all delete buttons
    document.querySelectorAll('.delete-btn').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault(); // Prevent the default link behavior

            const deleteUrl = button.getAttribute('href'); // Get the URL for deletion

            swal({
                title: "Are you sure?",
                text: "You will not be able to recover this product!",
                type: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes, delete it!",
                cancelButtonText: "No, cancel!",
                closeOnConfirm: false, // Keep the alert open until deletion completes
            },
            function (isConfirm) {
                if (isConfirm) {
                    fetch(deleteUrl, {
                        method: 'GET', 
                    })
                    .then(response => response.json()) 
                    .then(data => {
                        if (data.success) {
                            swal("Deleted!", "The product has been deleted.", "success");
                            button.closest('tr').remove();
                        } else {
                            swal("Failed!", data.message || "Unable to delete the product.", "error");
                        }
                    })
                    .catch(error => {
                        swal("Error!", "An error occurred while deleting the product.", "error");
                        console.error('Error:', error);
                    });
                } else {
                    swal("Cancelled", "Your product is safe :)", "error");
                }
            });
        });
    });
});
