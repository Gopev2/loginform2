<?php
session_start();
if (isset($_SESSION["user"])) {
   header("Location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <div class="container">
        <?php
        if (isset($_POST["login"])) {
           $email = $_POST["email"];
           $password = $_POST["password"];
            require_once "database.php";
            $sql = "SELECT * FROM users WHERE email = '$email'";
            $result = mysqli_query($conn, $sql);
            $user = mysqli_fetch_array($result, MYSQLI_ASSOC);
            if ($user) {
                if (password_verify($password, $user["password"])) {
                    session_start();
                    $_SESSION["user"] = "yes";
                    header("Location: index.php");
                    die();
                }else{
                    echo "<div class='alert alert-danger'>Password does not match</div>";
                }
            }else{
                echo "<div class='alert alert-danger'>Email does not match</div>";
            }
        }
        ?>
        <div class="wrapper">
        <h1>Login</h1>
      <form action="login.php" method="post">
        <div class="input-box">
            <input type="email" placeholder="Enter Email:" name="email" class="form-control">
            <i class='bx bxs-user'></i>
        </div>
        <div class="input-box">
            <input type="password" placeholder="Enter Password:" name="password" class="form-control">
            <i class='bx bxs-lock-alt' ></i>
        </div>
        <div class="btn">
            <input type="submit" value="Login" name="login" class="btn">
        </div>
        <div class="registerhere"><p>Not registered yet <a href="registration.php" class="registerbutton">Register Here</a></p></div>
    </div>
      </form>
    </div>
</body>
</html>