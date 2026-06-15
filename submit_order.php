<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $product = mysqli_real_escape_string($conn, $_POST['product']);
    $quantity = intval($_POST['quantity']);
    $total = intval($_POST['total']);

    // Save customer
    $sql1 = "INSERT INTO customers (name, email, phone) 
             VALUES ('$name', '$email', '$phone')";
    mysqli_query($conn, $sql1);

    // Save order
    $sql2 = "INSERT INTO orders (customer_name, customer_email, customer_phone, product_name, quantity, total_price, status) 
             VALUES ('$name', '$email', '$phone', '$product', '$quantity', '$total', 'pending')";
    
    if (mysqli_query($conn, $sql2)) {
        echo json_encode(['success' => true, 'message' => 'Order placed successfully!']);
    } else {
        echo json_encode(['success' => false, 'message' => mysqli_error($conn)]);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid request']);
}

mysqli_close($conn);
?>