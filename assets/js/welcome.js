// ==================  Log Out Functions ===============

// Use jQuery to handle the click event on the logout link
$(document).ready(function () {
  $("#logoutLink").click(function (e) {
    e.preventDefault(); // Prevent the default behavior of the anchor tag

    // Send an AJAX request to a PHP script that logs the user out
    $.ajax({
      type: "POST",
      url: "logout.php", // Replace with the actual path to your PHP script
      success: function (data) {
        // Redirect the user to the login page or handle the response as needed
        window.location.href = "index.php"; // Replace with the actual path to your login page
      },
    });
  });
});

// =========================================================
