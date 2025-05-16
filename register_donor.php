<?php
$conn = new mysqli("localhost", "root", "", "blood_donation");
if ($conn->connect_error) die("Connection failed: " . $conn->connect_error);

$name = $_POST['name'];
$email = $_POST['email'];
$phone = $_POST['phone'];
$blood = $_POST['blood_group'];
$address = $_POST['address'];
$landmark = $_POST['landmark'];

$stmt = $conn->prepare("INSERT INTO donors (full_name, email, phone, blood_group, address, landmark)
                        VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $name, $email, $phone, $blood, $address, $landmark);

if ($stmt->execute()) {
    echo "Donor registered successfully!";
} else {
    echo "Error: " . $stmt->error;
}
$conn->close();
?>