<?php
// session_start();

// echo "Welcome, " .$_SESSION['username']. "<br><a href='changepassword.php'>Change Password</a>".  "<br><a href='logout.php'>Click</a> here to logout <br>";

?>

<?php
session_start();

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: index.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Page</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="template/css/member_styles.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h2>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h2>
                    </div>
                    <div class="card-body">
                        <p class="lead text-center">You are now logged in to your member dashboard.</p>
                        <p class="text-center">Here are some options to manage your account:</p>
                        <div class="d-grid gap-2 col-6 mx-auto mb-3">
                            <a href="changepassword.php" class="btn btn-outline-primary">Change Password</a>
                            <a href="login_success.php" class="btn btn-outline-warning mb-2"> Go to Login Sucess </a>
                            <a href="logout.php" class="btn btn-outline-danger">Logout</a>
                        </div>
                        
                        <!-- Example of additional content -->
                        <h5 class="mt-4">Need Help?</h5>
                        <p>If you encounter any issues or need assistance, feel free to <a href="#">contact support</a>.</p>
                    </div>
                    <div class="card-footer text-center">
                        <small>&copy; 2024 Login and Registeration - All Rights Reserved.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
