<?php
// Simple password protection
$password = "kigali2026";
if (!isset($_GET['pass']) || $_GET['pass'] !== $password) {
    die("
    <html>
    <head><title>Admin Login</title>
    <style>
        body { font-family: Arial; background: #1B5E20; display: flex; justify-content: center; align-items: center; height: 100vh; margin: 0; }
        .box { background: white; padding: 40px; border-radius: 15px; text-align: center; width: 300px; }
        h2 { color: #2E7D32; }
        input { width: 100%; padding: 12px; margin: 10px 0; border: 2px solid #ddd; border-radius: 8px; font-size: 15px; box-sizing: border-box; }
        button { width: 100%; padding: 12px; background: #2E7D32; color: white; border: none; border-radius: 8px; font-size: 15px; cursor: pointer; }
    </style>
    </head>
    <body>
    <div class='box'>
        <h2>🔒 Admin Login</h2>
        <form method='GET'>
            <input type='password' name='pass' placeholder='Enter password'>
            <button type='submit'>Login</button>
        </form>
    </div>
    </body>
    </html>
    ");
}

include 'db.php';

// Update order status
if (isset($_GET['status']) && isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $status = mysqli_real_escape_string($conn, $_GET['status']);
    mysqli_query($conn, "UPDATE orders SET status='$status' WHERE id=$id");
    header("Location: admin.php?pass=$password");
    exit();
}

// Get all orders
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");
$customers = mysqli_query($conn, "SELECT COUNT(*) as total FROM customers");
$customer_count = mysqli_fetch_assoc($customers)['total'];
$order_count = mysqli_num_rows($orders);
$orders = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");

// Get total revenue
$revenue_query = mysqli_query($conn, "SELECT SUM(total_price) as total FROM orders");
$revenue = mysqli_fetch_assoc($revenue_query)['total'] ?? 0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Kigali Fresh Market</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; font-family: Arial, sans-serif; }
        body { background: #f5f5f5; }
        
        .header {
            background: linear-gradient(135deg, #1B5E20, #2E7D32);
            color: white;
            padding: 20px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .header h1 { font-size: 22px; }
        .header a { color: white; text-decoration: none; background: rgba(255,255,255,0.2); padding: 8px 15px; border-radius: 20px; font-size: 13px; }

        .stats {
            display: flex;
            gap: 20px;
            padding: 25px 30px;
            flex-wrap: wrap;
        }
        .stat-card {
            background: white;
            border-radius: 12px;
            padding: 20px 25px;
            flex: 1;
            min-width: 150px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.08);
            border-left: 4px solid #2E7D32;
        }
        .stat-card h3 { font-size: 13px; color: #888; margin-bottom: 8px; text-transform: uppercase; }
        .stat-card .number { font-size: 32px; font-weight: bold; color: #2E7D32; }

        .orders-section { padding: 0 30px 30px; }
        .orders-section h2 { font-size: 18px; color: #333; margin-bottom: 15px; }

        table { width: 100%; background: white; border-radius: 12px; box-shadow: 0 2px 10px rgba(0,0,0,0.08); border-collapse: collapse; overflow: hidden; }
        th { background: #2E7D32; color: white; padding: 12px 15px; text-align: left; font-size: 13px; }
        td { padding: 12px 15px; border-bottom: 1px solid #f0f0f0; font-size: 13px; color: #444; }
        tr:hover td { background: #f9f9f9; }
        tr:last-child td { border-bottom: none; }

        .status {
            padding: 4px 12px;
            border-radius: 20px;
            font-size: 12px;
            font-weight: bold;
        }
        .status.pending { background: #FFF3E0; color: #FF9800; }
        .status.confirmed { background: #E8F5E9; color: #2E7D32; }
        .status.delivered { background: #E3F2FD; color: #1976D2; }
        .status.cancelled { background: #FFEBEE; color: #e53935; }

        .action-btn {
            padding: 4px 10px;
            border-radius: 15px;
            font-size: 11px;
            text-decoration: none;
            margin: 2px;
            display: inline-block;
            font-weight: bold;
        }
        .btn-confirm { background: #E8F5E9; color: #2E7D32; }
        .btn-deliver { background: #E3F2FD; color: #1976D2; }
        .btn-cancel { background: #FFEBEE; color: #e53935; }

        .no-orders { text-align: center; padding: 40px; color: #888; }
    </style>
</head>
<body>

<div class="header">
    <h1>🛒 Kigali Fresh Market — Admin Dashboard</h1>
    <a href="index.html">← View Website</a>
</div>

<div class="stats">
    <div class="stat-card">
        <h3>Total Orders</h3>
        <div class="number"><?= $order_count ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Customers</h3>
        <div class="number"><?= $customer_count ?></div>
    </div>
    <div class="stat-card">
        <h3>Total Revenue</h3>
        <div class="number">RWF <?= number_format($revenue) ?></div>
    </div>
</div>

<div class="orders-section">
    <h2>📋 All Orders</h2>
    <table>
        <tr>
            <th>#</th>
            <th>Customer</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Product</th>
            <th>Qty</th>
            <th>Total</th>
            <th>Status</th>
            <th>Date</th>
            <th>Actions</th>
        </tr>
        <?php
        $result = mysqli_query($conn, "SELECT * FROM orders ORDER BY created_at DESC");
        if (mysqli_num_rows($result) == 0) {
            echo "<tr><td colspan='10' class='no-orders'>No orders yet</td></tr>";
        }
        while ($row = mysqli_fetch_assoc($result)) {
            $status_class = $row['status'];
            echo "<tr>
                <td><strong>#{$row['id']}</strong></td>
                <td>{$row['customer_name']}</td>
                <td>{$row['customer_email']}</td>
                <td>{$row['customer_phone']}</td>
                <td>{$row['product_name']}</td>
                <td>{$row['quantity']}</td>
                <td><strong>RWF " . number_format($row['total_price']) . "</strong></td>
                <td><span class='status {$status_class}'>{$row['status']}</span></td>
                <td>" . date('d M Y H:i', strtotime($row['created_at'])) . "</td>
                <td>
                    <a href='?pass=$password&id={$row['id']}&status=confirmed' class='action-btn btn-confirm'>✅ Confirm</a>
                    <a href='?pass=$password&id={$row['id']}&status=delivered' class='action-btn btn-deliver'>🚚 Delivered</a>
                    <a href='?pass=$password&id={$row['id']}&status=cancelled' class='action-btn btn-cancel'>❌ Cancel</a>
                </td>
            </tr>";
        }
        ?>
    </table>
</div>

</body>
</html>