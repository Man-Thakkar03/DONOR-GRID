<?php


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Connect to database
    $conn = new mysqli("localhost", "root", "", "blood_donation");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Collect and sanitize form data
    $fullname = $_POST['fullname'] ?? '';
    $mobile = $_POST['mobile'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $blood_group = $_POST['blood_group'] ?? '';
    $birth_date = $_POST['birth_date'] ?? '';
    $gender = $_POST['gender'] ?? '';
    $weight = $_POST['weight'] ?? '';
    $show_mobile = $_POST['show_mobile'] ?? '';
    $state = $_POST['state'] ?? '';
    $city = $_POST['city'] ?? '';
    $zipcode = $_POST['zipcode'] ?? '';
    $area = $_POST['area'] ?? '';
    $landmarks = $_POST['landmarks'] ?? '';
    $sms_alert = isset($_POST['sms_alert']) ? 1 : 0;

    // Check if all required fields are filled
    if (
        $fullname && $mobile && $email && $password && $blood_group &&
        $birth_date && $gender && $weight && $show_mobile && $state &&
        $city && $zipcode && $area && $landmarks
    ) {
        $sql = "INSERT INTO donors (fullname, mobile, email, password, blood_group, birth_date, gender, weight, show_mobile, state, city, zipcode, area, landmarks, sms_alert)
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ssssssssssssssi", $fullname, $mobile, $email, $password, $blood_group, $birth_date, $gender, $weight, $show_mobile, $state, $city, $zipcode, $area, $landmarks, $sms_alert);

        if ($stmt->execute()) {
            echo "Donor registered successfully.";
        } else {
            echo "Error: " . $stmt->error;
        }

        $stmt->close();
    } else {
        echo "Please fill all required fields.";
    }

    $conn->close();
}
?>
