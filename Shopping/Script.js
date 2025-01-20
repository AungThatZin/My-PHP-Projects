function myFunction() {
    var input, filter, ul, li, a, i, txtValue;
    input = document.getElementById("myInput");
    filter = input.value.toUpperCase();
    ul = document.getElementById("product-list");
    li = ul.getElementsByClassName("product");
    for (i = 0; i < li.length; i++) {
        a = li[i].getElementsByTagName("h2")[0];
        txtValue = a.textContent || a.innerText;
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
            li[i].style.display = "block";
        } else {
            li[i].style.display = "none";
        }
    }
}
document.addEventListener("DOMContentLoaded", function () {
    document.getElementById("profile-info").style.display = "none";
});
document.getElementById("account-button").addEventListener("click", function () {
    var accountMenu = document.getElementById("profile-info");
    accountMenu.style.display = accountMenu.style.display === "block" ? "none" : "block";

});


