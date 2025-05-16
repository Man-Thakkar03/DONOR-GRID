<?php
$conn = new mysqli("localhost", "root", "", "blood_donation");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = $_POST['name'] ?? '';
$phone = $_POST['phone'] ?? '';
$email = $_POST['email'] ?? '';

if (empty($name) || empty($phone) || empty($email)) {
    echo "Please fill in all fields.";
    exit;
}

// Update the table name here
$stmt = $conn->prepare("INSERT INTO contact_messages (name, phone, email) VALUES (?, ?, ?)");

if (!$stmt) {
    echo "Prepare failed: " . $conn->error;
    exit;
}

$stmt->bind_param("sss", $name, $phone, $email);

if ($stmt->execute()) {
    echo "Submitted successfully!";
} else {
    echo "Error: " . $stmt->error;
}

$conn->close();
?>