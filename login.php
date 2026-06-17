<?php
session_start();
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = $_POST['password'];

    $result = mysqli_query($conn,
        "SELECT * FROM users WHERE email='$email'");

    if(mysqli_num_rows($result) == 1){

        $user = mysqli_fetch_assoc($result);

        if(password_verify($password, $user['password'])){

            $_SESSION['user_id'] = $user['id'];
            $_SESSION['fullname'] = $user['fullname'];

            header("Location: index.html");
            exit();
        }
    }

    $error = "Invalid email or password";
}
?>

<form method="POST">
    <h2>Login</h2>

    <?php if(isset($error)) echo "<p>$error</p>"; ?>

    <input type="email" name="email"
           placeholder="Email" required>

    <input type="password" name="password"
           placeholder="Password" required>

    <button type="submit">Login</button>
</form>