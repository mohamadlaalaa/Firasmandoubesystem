<?php
session_start();
include("connection.php");
include("functions.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    // Something was posted
    $user_name = $_POST['username'];
    $password = $_POST['password'];
    $user_name_lower = strtolower($user_name);

    if (!empty($user_name) && !empty($password) && !is_numeric($user_name)) {

        // Use prepared statements to prevent SQL injection
        $query = "SELECT * FROM `users` WHERE username = ? LIMIT 1";
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
                    header("Location: welcome.php");
                    die;
                } else {
                    // Incorrect password
                    echo '<script>alert("Invalid username or password!")</script>';
                }
            }
        } else {
            // Use a more generic error message to avoid leaking information
            echo '<script>alert("Invalid username or password!")</script>';
        }
    } else {
        // Use a more generic error message to avoid leaking information
        echo '<script>alert("Invalid username or password!")</script>';
    }
}
?>





<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!--=============== REMIXICONS ===============-->
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/3.5.0/remixicon.css"
      crossorigin=""
    />

    <!--=============== CSS ===============-->
    <style>
      /*=============== GOOGLE FONTS ===============*/
      @import url("https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap");

      /*=============== VARIABLES CSS ===============*/
      :root {
        /*========== Colors ==========*/
        /*Color mode HSL(hue, saturation, lightness)*/
        --white-color: hsl(0, 0%, 100%);
        --black-color: hsl(0, 0%, 0%);

        /*========== Font and typography ==========*/
        /*.5rem = 8px | 1rem = 16px ...*/
        --body-font: "Poppins", sans-serif;
        --h1-font-size: 2rem;
        --normal-font-size: 1rem;
        --small-font-size: 0.813rem;
      }

      /*=============== BASE ===============*/
      * {
        box-sizing: border-box;
        padding: 0;
        margin: 0;
      }
      body{
        background-color:#186F65;
      }
      body,
      input,
      button {
        font-family: var(--body-font);
        font-size: var(--normal-font-size);
      }

      a {
        text-decoration: none;
      }

      img {
        display: block;
        max-width: 100%;
        height: auto;
      }

      /*=============== LOGIN ===============*/
      .login {
        position: relative;
        height: 100vh;
        display: grid;
        align-items: center;
      }

      .login__bg {
        position: absolute;
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: center;
      }

      .login__form {
        position: relative;
        margin-inline: 1.5rem;
        background-color: hsla(0, 0%, 100%, 0.01);
        border: 2px solid hsla(0, 0%, 100%, 0.7);
        padding: 2.5rem 1rem;
        color: var(--white-color);
        border-radius: 1rem;
        backdrop-filter: blur(16px);
      }

      .login__title {
        text-align: center;
        font-size: var(--h1-font-size);
        margin-bottom: 1.25rem;
      }

      .login__inputs,
      .login__box {
        display: grid;
      }

      .login__inputs {
        row-gap: 1.25rem;
        margin-bottom: 1rem;
      }

      .login__box {
        grid-template-columns: 1fr max-content;
        column-gap: 0.75rem;
        align-items: center;
        border: 2px solid hsla(0, 0%, 100%, 0.7);
        padding-inline: 1.25rem;
        border-radius: 4rem;
      }

      .login__input,
      .login__button {
        border: none;
        outline: none;
      }

      .login__input {
        width: 100%;
        background: none;
        color: var(--white-color);
        padding-block: 1rem;
      }

      .login__input::placeholder {
        color: var(--white-color);
      }

      .login__box i {
        font-size: 1.25rem;
      }

      .login__check,
      .login__check-box {
        display: flex;
        justify-content: space-between;
        align-items: center;
      }

      .login__check {
        margin-bottom: 1rem;
        font-size: var(--small-font-size);
      }

      .login__check-box {
        column-gap: 0.5rem;
      }

      .login__check-input {
        width: 1rem;
        height: 1rem;
        accent-color: var(--white-color);
      }

      .login__forgot {
        color: var(--white-color);
      }

      .login__forgot:hover {
        text-decoration: underline;
      }

      .login__button {
        width: 100%;
        padding: 1rem;
        margin-bottom: 1rem;
        background-color: var(--white-color);
        border-radius: 4rem;
        color: var(--black-color);
        font-weight: 500;
        cursor: pointer;
      }

      .login__register {
        font-size: var(--small-font-size);
        text-align: center;
      }

      .login__register a {
        color: var(--white-color);
        font-weight: 500;
      }

      .login__register a:hover {
        text-decoration: underline;
      }

      /*=============== BREAKPOINTS ===============*/
      /* For medium devices */
      @media screen and (min-width: 576px) {
        .login {
          justify-content: center;
        }
        .login__form {
          width: 420px;
          padding-inline: 2.5rem;
        }
        .login__title {
          margin-bottom: 2rem;
        }
      }
    </style>

    <title>Firas Laalaa</title>
  </head>
  <body>
    <div class="login">
      <!-- <img src="assets/images/login-bg.png" alt="image" class="login__bg" /> -->

      <form method="post" class="login__form">
        <h1 class="login__title">Login</h1>

        <div class="login__inputs">
          <div class="login__box">
            <input
              type="text"
              placeholder="Username"
              required
              class="login__input"
              name="username"
            />
            <i class="ri-mail-fill"></i>
          </div>

          <div class="login__box">
            <input
              type="password"
              placeholder="Password"
              required
              name="password"
              class="login__input"
            />
            <i class="ri-lock-2-fill"></i>
          </div>
        </div>
        <button type="submit" class="login__button">Login</button>
      </form>
    </div>
  </body>
</html>
