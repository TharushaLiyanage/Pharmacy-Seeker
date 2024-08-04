<?php
session_start();
if (!isset($_SESSION['user']) || $_SESSION['user']['type'] != 'admin') {
    header('Location: login.php');
    exit();
}

include 'config.php';

$user = $_SESSION['user'];
$user_id = $user['id'];

$query = "SELECT * FROM Admins WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user_details = $result->fetch_assoc();

// Fetching total users and active pharmacies
$total_users_query = "SELECT COUNT(*) as total FROM (SELECT id FROM Customers UNION ALL SELECT id FROM Pharmacies) as users";
$total_pharmacies_query = "SELECT COUNT(*) as active FROM Pharmacies";

$total_users_result = $conn->query($total_users_query);
$total_pharmacies_result = $conn->query($total_pharmacies_query);

$total_users = $total_users_result->fetch_assoc()['total'];
$active_pharmacies = $total_pharmacies_result->fetch_assoc()['active'];

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Pharma Sonic</title>
    <link rel="stylesheet" href="GrandCss.css">
    <link rel="stylesheet" href="MainCss.css">
    <style>
        /* Add your custom styles here */
        body {
            display: flex;
            min-height: 100vh;
            background: url(bg.jpg) no-repeat;
            background-size: cover;
            background-position: center;
        }
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            z-index: 99;
        }
        .logo-image {
            padding-top: 10px;
            display: flex;
        }
        .img-fluid {
            width: 200px;
            height: 80px;
            position: relative;
            padding-left: 5px;
            margin-top: 5px;
        }
        .navigation {
            padding: 20px 100px;
        }
        .navigation a {
            position: relative;
            font-size: 1.1em;
            color: white;
            text-decoration: none;
            margin-left: 40px;
        }
        .navigation a::after {
            content: '';
            position: absolute;
            width: 100%;
            height: 3px;
            background: #fff;
            border-radius: 5px;
            left: 0;
            bottom: -6px;
            transform: scaleX(0);
            transition: transform .5s;
        }
        .navigation a:hover::after {
            transform-origin: left;
            transform: scaleX(1);
        }
        .navigation .btnloggin-popup {
            width: 130px;
            height: 50px;
            border: 2px solid #fff;
            background: transparent;
            border-radius: 6px;
            cursor: pointer;
            font-size: 1.1em;
            color: #fff;
            font-weight: 500;
            margin-left: 40px;
            transition: .5s;
        }
        .navigation .btnloggin-popup:hover {
            background: white;
            color: blue;
        }
        .full-page {
            width: 100%;
            padding-top: 100px;
        }
        #one {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
            padding: 2rem;
        }
        .dashboard-section {
            background-color: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(20px);
            border-radius: 20px;
            padding: 2rem;
            margin: 1rem;
            color: white;
            width: calc(50% - 2rem);
            max-width: 500px;
        }
        .dashboard-section h2 {
            margin-top: 0;
            margin-bottom: 1rem;
        }
        .action-button {
            background-color: transparent;
            border: 2px solid #fff;
            color: white;
            padding: 10px 20px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            font-size: 16px;
            margin-top: 1rem;
            margin-right: 0.5rem;
            cursor: pointer;
            border-radius: 6px;
            transition: .5s;
        }
        .action-button:hover {
            background: white;
            color: blue;
        }
    </style>
</head>
<body>
    <header>
        <div class="logo-image">
            <a href="First_page.php">
                <img src="Logoimg.png" class="img-fluid" alt="Pharma Sonic Logo">
            </a>
        </div>
        <nav class="navigation">
            <a href="admin_dashboard.php">Dashboard</a>
            <a href="manage_users.php">Users</a>
            <a href="manage_pharmacies.php">Pharmacies</a>
            <a href="manage_inventory.php">Inventory</a>
            <button class="btnloggin-popup" onclick="location.href='logout.php'">Logout</button>
        </nav>
    </header>

    <div class="full-page">
        <section id="one">
            <div class="dashboard-section">
                <h2>Quick Stats</h2>
                <p>Total Users: <?php echo $total_users; ?></p>
                <p>Active Pharmacies: <?php echo $active_pharmacies; ?></p>
            </div>

            <div class="dashboard-section">
                <h2>Customer Management</h2>
                <button class="action-button" onclick="location.href='manage_users.php'">View All Customers</button>
                <button class="action-button" onclick="location.href='add_user.php'">Add New Customer</button>
            </div>

            <div class="dashboard-section">
                <h2>Pharmacy Management</h2>
                <button class="action-button" onclick="location.href='manage_pharmacies.php'">View All Pharmacies</button>
                <button class="action-button" onclick="location.href='add_pharmacy.php'">Add New Pharmacy</button>
            </div>

            <div class="dashboard-section">
                <h2>Inventory Management</h2>
                <button class="action-button" onclick="location.href='manage_inventory.php'">View Inventory</button>
                <button class="action-button" onclick="location.href='add_inventory.php'">Update Stock</button>
            </div>
        </section>
    </div>
</body>
</html>
