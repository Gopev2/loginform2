<?php
session_start();
if (!isset($_SESSION["user"])) {
   header("Location: login.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css.css">
    <title>User Dashboard</title>
</head>
<body>
    <div class="input-box">
        <h1 class="welcomedash">Welcome to Dashboard</h1>
        <a href="logout.php" class="Registerbtn">Logout</a>
    </div>
</body>
</html>