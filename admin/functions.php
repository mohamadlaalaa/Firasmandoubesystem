<?php

function check_login($con){
    // Ensure session is started
    

    if(isset($_SESSION['user_id'])) {
        $id = $_SESSION['user_id'];

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM `users` WHERE user_id = ?  AND isAdmin = 1 LIMIT 1";
        $stmt = mysqli_prepare($con, $query);
        mysqli_stmt_bind_param($stmt, "i", $id);
        mysqli_stmt_execute($stmt);
        
        $result = mysqli_stmt_get_result($stmt);

        if($result && mysqli_num_rows($result) > 0) {
            $user_data = mysqli_fetch_assoc($result);
            return $user_data;
        }
    }

    // Redirect to login
    header("Location: index.php");
    exit;
}
?>
