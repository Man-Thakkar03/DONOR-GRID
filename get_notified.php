<?php
$conn = new mysqli("localhost", "root", "", "blood_donation");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$email = $_POST['email'];

$stmt = $conn->prepare("INSERT INTO notifications (email) VALUES (?)");
$stmt->bind_param("s", $email);

if ($stmt->execute()) {
    echo "Subscribed successfully!";
} else {
    echo "This email is already subscribed or invalid.";
}
$conn->close();
?>