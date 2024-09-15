<?php
session_start();

// Include the database connection file
include 'connect.php';

if (isset($_POST['username']) && isset($_POST['password'])) {
    $username = strtolower(strip_tags(trim($_POST['username'])));
    $password = strip_tags(trim($_POST['password']));

    if ($username && $password) {

        try {

            // Prepare the query to avoid SQL injection
            $stmt = mysqli_prepare($connect, "SELECT * From users WHERE username= ?");
            mysqli_stmt_bind_param($stmt, 's', $username);
            mysqli_stmt_execute($stmt);

            $result = mysqli_stmt_get_result($stmt);
            $numrows = mysqli_num_rows($result);

            if ($numrows != 0) {
                // Fetch the result as an associative array
                // code to login
                $row = mysqli_fetch_assoc($result);
                $dbusername = $row["username"];
                $dbpassword = $row["password"]; // The hashed password from the database

                // Use password_verify() to check the hashed password
                if ($username == $dbusername && password_verify($password, $dbpassword)) {
                    // echo "Login Successfull by User : ", htmlspecialchars($username) . "!<br>";
                    // echo "<a href='member.php'>Click</a> here to go to Member Page";
                    $_SESSION['username'] = $username;

                    // Redirect to the success page after successful login
                    header("Location: login_success.php");
                    exit(); // Ensure no further code is executed

                } else {
                    // die("Incorrect Username or Password");
                    echo "<script type='text/javascript'>
                    alert('Incorrect Username or Password');
                    window.history.back();
                  </script>";
                    exit();
                }
            } else {
                // die("User does not exist!");
                echo "<script type='text/javascript'>
                alert('User does not exist!');
                window.history.back();
              </script>";
                exit();
            }
        } catch (mysqli_sql_exception $e) {
            die("Could not connect:" . $e->getMessage());
        }
    } else {
        // die("Please enter Username and Password");
        echo "<script type='text/javascript'>
        alert('Please enter Username and Password');
        window.history.back();
        </script>";
        exit();
    }
} else {
    // Redirect or show error if form wasn't submitted
    // echo "Please submit the form.";
    echo "<script type='text/javascript'>
    alert('Please submit the form.');
    window.history.back();
    </script>";
    exit();
}

// Close connection
if (isset($connect) && $connect) {
    mysqli_close($connect);
}
