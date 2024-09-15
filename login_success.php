<?php
session_start();// Ensure the session is started before accessing $_SESSION
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Successful</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="alert alert-success text-center" role="alert">
                <h4 class="alert-heading">Login Successful!</h4>
                <p>Welcome back, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
                <hr>
                <a href="member.php" class="btn btn-primary">Go to Member Page</a>
                <br><br>
                <a href="logout.php" class="btn btn-secondary">Logout</a>
            </div>
        </div>
    </div>

    <!-- Additional content starts here -->
    <div class="row justify-content-center mt-4">
        <div class="col-md-6 text-center">
            <h5>Your Dashboard</h5>
            <p>Here are some quick links to get started:</p>
            <a href="profile.php" class="btn btn-info mb-2">Edit Profile</a>
            <a href="settings.php" class="btn btn-warning mb-2">Account Settings</a>
        </div>
    </div>

    <div class="row justify-content-center mt-4">
        <div class="col-md-6 text-center">
            <h5>Your Recent Activities</h5>
            <ul class="list-group">
                <li class="list-group-item">Logged in from IP: <?php echo $_SERVER['REMOTE_ADDR']; ?></li>
            </ul>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
