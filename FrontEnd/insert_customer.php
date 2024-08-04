<?php
include 'config.php';

// Get form data
$name = $_POST['name'];
$email = $_POST['email'];
$password = password_hash($_POST['password'], PASSWORD_DEFAULT);
$phone_number = $_POST['phone_number'];
$gender = $_POST['gender'];
$birthday = $_POST['birthday'];

// Insert data into Customers table
$sql = "INSERT INTO Customers (name, email, password, phone_number, gender, birthday) VALUES ('$name', '$email', '$password', '$phone_number', '$gender', '$birthday')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Registration Successful');
            window.location.href = 'First_page.php';
          </script>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
