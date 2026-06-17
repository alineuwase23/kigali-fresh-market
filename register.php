<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $fullname = mysqli_real_escape_string($conn, $_POST['fullname']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    $check = mysqli_query($conn,
        "SELECT id FROM users WHERE email='$email'");

    if(mysqli_num_rows($check) > 0){
        die("Email already exists");
    }

    $sql = "INSERT INTO users(fullname,email,password)
            VALUES('$fullname','$email','$password')";

    if(mysqli_query($conn,$sql)){
        header("Location: login.php");
        exit();
    }

    echo "Registration failed";
}
?>

<form method="POST">
    <h2>Create Account</h2>

    <input type="text" name="fullname"
           placeholder="Full Name" required>

    <input type="email" name="email"
           placeholder="Email" required>

    <input type="password" name="password"
           placeholder="Password" required>

    <button type="submit">Register</button>
</form>