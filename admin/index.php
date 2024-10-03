<?php
session_start();

// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if the password is correct
    $password = trim($_POST['password']);
    $passwordFile = 'password.txt';

    // Read the stored password from the file
    $storedPassword = file_get_contents($passwordFile);

    if (password_verify($password, $storedPassword)) {
        $_SESSION['authenticated'] = true;
    } else {
        $error = 'Invalid password';
    }
}

// Check if the user is authenticated
if (isset($_SESSION['authenticated']) && $_SESSION['authenticated'] === true) {
    // Display the admin page with a list of URLs
    $urls = [
        'https://flash.cardcodegenerator.com/admin/dashboard.php',
        'https://flash.cardcodegenerator.com/admin/add_new.php',
        'https://flash.cardcodegenerator.com/admin/upload_image.php',
        'https://flash.cardcodegenerator.com/admin/delete_images.php'
        // Add more URLs as needed
    ];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Page</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    </head>
    <body class="container mt-5">
        <h1 class="mb-4">Welcome to the Admin Page</h1>
        <ul class="list-group">
            <?php foreach ($urls as $url): ?>
                <li class="list-group-item"><a href="<?php echo $url; ?>"><?php echo $url; ?></a></li>
            <?php endforeach; ?>
        </ul>
        <p class="mt-4"><a href="logout.php" class="btn btn-danger">Logout</a></p>
    </body>
    </html>
    <?php
    exit;
}

// If not authenticated, show the login form
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
</head>
<body class="container mt-5">
    <div class="col-md-6 offset-md-3">
        <?php if (isset($error)): ?>
            <div class="alert alert-danger"><?php echo $error; ?></div>
        <?php endif; ?>
        <form method="post" action="index.php">
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" name="password" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Login</button>
        </form>
    </div>
</body>
</html>
