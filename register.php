<?php

// Initialize variables to avoid undefined variable warnings
$submit = null;
$fullname = '';
$username = '';
$password = '';
$repeatpassword = '';
$date = date("Y-m-d");


// Include database connection file
include("connect.php");
include("register_form.php");

if (isset($_POST['submit'])) {
    $submit  = $_POST['submit'];
    // Form Data
    $fullname = strip_tags(trim($_POST['fullname']));
    $username = strtolower(strip_tags(trim($_POST['username'])));
    $password = strip_tags($_POST['password']);
    $repeatpassword = strip_tags($_POST['repeatpassword']);
    $date = date("Y-m-d");


    if ($submit) {
        // Check if username already exists
        $namecheck = mysqli_query($connect, "SELECT username FROM users WHERE username ='$username' ");
        $count = mysqli_num_rows($namecheck);

        if ($count != 0) {
            // die("Username already taken!");
            echo "<script type='text/javascript'>
            alert('Username already taken!');
            window.history.back();
          </script>";
            exit();
        }

        // check for existance of all form fields
        if ($fullname && $username && $password && $repeatpassword) {

            if ($password == $repeatpassword) {

                // check characters limit for fullname and username
                if (strlen($fullname) > 25 || strlen($username) > 25) {
                    // echo "Max limit for fullname/username are 25 characters";
                    echo "<script type='text/javascript'>
                    alert('Max limit for fullname/username are 25 characters');
                    window.history.back();
                  </script>";
                    exit();
                } else {

                    // check password length
                    // we can check only one i.e password or repeat password because both are same and equal.
                    if (strlen($password) > 25 || strlen($password) < 6) {
                        // echo "Password must be between 6 and 25 characters";
                        echo "<script type='text/javascript'>
                        alert('Password must be between 6 and 25 characters');
                        window.history.back();
                      </script>";
                        exit();
                    } else {
                        // Register the user
                        // Encrypt password using password_hash() for security
                        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

                        // Insert user data into database
                        $queryreg = mysqli_query($connect, "INSERT INTO users (name, username, password, date) VALUES ('$fullname', '$username', '$hashedPassword', '$date')");

                        // die("You have been registered! <a href='index.php'> Return to login page");

                        // Redirect to success page
                        header("Location: register_success.php");
                        exit();
                    }
                }
            } else {
                // echo "Password do not match!";
                echo "<script type='text/javascript'>
                alert('Passwords do not match!');
                window.history.back();
                </script>";
                exit();
            }
        } else {
            // echo "Please fill in <b>all</b> fields!";
            echo "<script type='text/javascript'>
            alert('Please fill in all fields!');
            window.history.back();
            </script>";
            exit();
        }
    }
}
