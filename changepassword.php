<?php
session_start();

$user = $_SESSION['username'];

if ($user) {

    if (isset($_POST['submit'])) {

        $oldpassword = $_POST['oldpassword'];
        $newpassword = $_POST['newpassword'];
        $repeatnewpassword = $_POST['repeatnewpassword'];

        if (empty($oldpassword) || empty($newpassword) || empty($repeatnewpassword)) {
            // die("All fields are required.");
            echo "<script type='text/javascript'>
            alert('Password must be between 6 and 25 characters');
            window.history.back();
          </script>";
            exit();
        }

        // Validate the length of the new password
        if (strlen($newpassword) < 6 || strlen($newpassword) > 25) {
            echo "<script type='text/javascript'>
            alert('New password must be between 6 and 25 characters.');
            window.history.back();
            </script>";
            exit();
            }

        // Connect to the database
        $connect = mysqli_connect("localhost", "root", "", "phplogin");
        if (!$connect) {
            die("Could not connect:" . mysqli_connect_error());
        }

        // Prepare and execute the query to get the current password
        $stmt = mysqli_prepare($connect, "SELECT password FROM users WHERE username= ?");
        mysqli_stmt_bind_param($stmt, 's', $user);
        mysqli_stmt_execute($stmt);
        $result = mysqli_stmt_get_result($stmt);

        if ($row = mysqli_fetch_assoc($result)) {
            $oldpassworddb = $row['password'];

            // Verify old password
            if (password_verify($oldpassword, $oldpassworddb)) {
                // Check if new passwords match
                
                if ($newpassword === $repeatnewpassword) {
                    // Hash new password and update in the database
                    $newpassword_hash = password_hash($newpassword, PASSWORD_BCRYPT);
                    $stmt_update = mysqli_prepare($connect, "UPDATE users SET password= ? WHERE username= ?");
                    mysqli_stmt_bind_param($stmt_update, 'ss', $newpassword_hash, $user);
                    mysqli_stmt_execute($stmt_update);

                    session_destroy();
                    echo "Password has been changed! <a href='index.php'>Return</a> to the main page";
                } else {
                    // echo "New passwords do not match";
                    echo "<script type='text/javascript'>
                    alert('New passwords do not match');
                    window.history.back();
                  </script>";
                    exit();
                }
            } else {
                // echo "Old password do not match";
                echo "<script type='text/javascript'>
                alert('Old password do not match');
                window.history.back();
              </script>";
                exit();
            }
        } else {
            // echo "User not found";
            echo "<script type='text/javascript'>
            alert('User not found');
            window.history.back();
          </script>";
            exit();
        }

        // Close the connection
        mysqli_close($connect);
    } else {
        // Display the form if not submitted
        echo "<!DOCTYPE html>
            <html lang='en'>
            <head>
                <meta charset='UTF-8'>
                <meta name='viewport' content='width=device-width, initial-scale=1.0'>
                <title>Change Password</title>
                <link rel='stylesheet' href='template/css/changepassword_style.css'>
                
            </head>
            <body>
            <div class='container'>
            <h2>Change Password</h2>
            <form action='changepassword.php' method='POST'>
                <label for='oldpassword'>Old Password</label> <br>
                <input type='password' name='oldpassword'> <br>
                <label for='newpassword'>New Password</label> <br>
                <input type='password' name='newpassword'> <br>
                <label for='repeatnewpassword'>Repeat New Password</label> <br>
                <input type='password' name='repeatnewpassword'> <br>
                <input type='submit' name='submit' value='Change Password'> <br>
            </form>
            <div class='card-footer text-center'>
            <p>Go back to me member page! <a href='member.php'>click here</a></p>
            </div>
            </div>
            </body>
            </html>";
    }
} else {
    die("You must be logged in to change your password.");
}
