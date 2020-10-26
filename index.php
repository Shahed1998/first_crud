<?php
    session_start();
    unset($_SESSION['name']);
    session_destroy();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>18444c8a</title>
</head>
<body>
    <h1>Welcome to Autos Database</h1>
    <a href="login.php">Please log in</a><br>
    <p>
        Attempt to go to <a href="view.php">View.php</a> without logging in.
    </p>
    <p>
        Attempt to go to <a href="add.php">Add.php</a> without logging in.
    </p>

</body>
</html>
