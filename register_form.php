<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="template/css/register_styles.css">
</head>

<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card mt-5">
                    <div class="card-header text-center">
                        <h3>Register</h3>
                    </div>
                    <div class="card-body">
                        <form action="register.php" method="POST">
                            <div class="form-group mb-3">
                                <label for="fullname">Full Name:</label>
                                <input type="text" name="fullname" class="form-control" value="<?php echo $fullname; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="username">Choose a username:</label>
                                <input type="text" name="username" class="form-control" value="<?php echo $username; ?>" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="password">Choose a password:</label>
                                <input type="password" name="password" class="form-control" required>
                            </div>
                            <div class="form-group mb-3">
                                <label for="repeatpassword">Repeat your password:</label>
                                <input type="password" name="repeatpassword" class="form-control" required>
                            </div>
                            <div class="d-grid gap-2">
                                <input type="submit" name="submit" value="Register" class="btn btn-primary">
                                <div class="card-footer text-center">
                                    <p>Already have an account? <a href="index.php">Login</a></p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>