
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, 
    initial-scale=1.0">
    <title>Document</title>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css.css">
</head>
<body>
    <?php
        if (isset($_POST["submit"])) {
           $username = $_POST["username"];
           $email = $_POST["email"];
           $password = $_POST["password"];
           $passwordRepeat = $_POST["repeat_password"];
           
           $passwordHash = password_hash($password, PASSWORD_DEFAULT);

           $errors = array();
           
           if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            array_push($errors, "Email is not valid");
           }
           if (strlen($password)<8) {
            array_push($errors,"Password must be at least 8 charactes long");
           }
           if ($password!==$passwordRepeat) {
            array_push($errors,"Password does not match");
           }
           require_once "database.php";
           $sql = "SELECT * FROM users WHERE email = '$email'";
           $result = mysqli_query($conn, $sql);
           $rowCount = mysqli_num_rows($result);
           if ($rowCount>0) {
            array_push($errors,"Email already exists!");
           }
           if (count($errors)>0) {
            foreach ($errors as  $error) {
                echo "<div class='alert alert-danger'>$error</div>";
            }
           }else{
            
            $sql = "INSERT INTO users (username, email, password) VALUES ( ?, ?, ? )";
            $stmt = mysqli_stmt_init($conn);
            $prepareStmt = mysqli_stmt_prepare($stmt,$sql);
            if ($prepareStmt) {
                mysqli_stmt_bind_param($stmt,"sss",$username, $email, $passwordHash);
                mysqli_stmt_execute($stmt);
                echo "<div class='alert alert-success'>You are registered successfully.</div>";
            }else{
                die("Something went wrong");
            }
           }
        }
        ?>

    <div class="wrapper" id="form">

        <form action="registration.php" method="POST">

            <h1>Register</h1>

            <div class="input-box" method="POST">
                <input type="email" name="email" placeholder="Email" 
                required>
                <i class='bx bxs-envelope'></i>
            </div>

            <div class="input-box" method="POST">
                <input type="text" name="username" placeholder="Username" required>
                <i class='bx bxs-user'></i>
            </div>

            <div class="input-box" method="POST">
                <input type="password" name="password" placeholder="Password" 
                required>
                <i class='bx bxs-lock' ></i>
            </div>

            <div class="input-box" method="POST">
                <input type="password" name="repeat_password" placeholder="Repeat password" 
                required>
                <i class='bx bxs-lock-open' ></i>
            </div>

            <div class="remember-forgot">
                <label>
                    <input type="checkbox"> Remember me
                </label>
                <a href="#">Forgot password?</a>
            </div>

            <button type="submit" class="btn" name="submit" value="Register">
                Register
            </button>

            <div class="register-link">
                <p>
                    Already registered ?
                    <a href="login.php" class="Registerbtn">Login Here</a>
                </p>
            </div>
        </form>

    </div>
</body>
</html>