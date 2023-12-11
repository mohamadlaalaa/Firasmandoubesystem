<?php
include("../connection.php");
session_start();

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $user_name_lower = strtolower($user_name);

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM `users` WHERE username = ? AND isAdmin = 1 LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, 's', $user_name_lower);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($result) {
            if (mysqli_num_rows($result) > 0) {
                $user_data = mysqli_fetch_assoc($result);

                // Use MySQL's PASSWORD() function to check hashed passwords
                $query = "SELECT * FROM `users` WHERE username = ? AND password = PASSWORD(?) LIMIT 1";
                $stmt = mysqli_prepare($con, $query);
                mysqli_stmt_bind_param($stmt, 'ss', $user_name_lower, $password);
                mysqli_stmt_execute($stmt);
                $result = mysqli_stmt_get_result($stmt);

                if ($result && mysqli_num_rows($result) > 0) {
                    // Password is correct
                    $_SESSION['user_id'] = $user_data['user_id'];
                    header("Location: ../test/dashboard-home.html");
                    die;
                } else {
                    // Incorrect password
                    echo '<script>alert("Invalid username or password!");window.location.replace("index.php");</script>';
                    
                }
            } else {
                // User is not an admin
                echo '<script>alert("You do not have admin privileges!");window.location.replace("index.php");</script>';
                
            }
        } else {
            // Use a more generic error message to avoid leaking information
            echo '<script>alert("Invalid username or password!");window.location.replace("index.php");</script>';
            
        }
    } else {
        // Use a more generic error message to avoid leaking information
        echo '<script>alert("Invalid username or password!");window.location.replace("index.php");</script>';
        
    }
}
?>