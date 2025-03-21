<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $patient_name = $_POST['patient_name'];
    $gender = $_POST['gender'];
    $age = $_POST['age'];
    $reason = $_POST['reason'];
    $condition = $_POST['condition'];
    $doctor_preference = $_POST['doctor_preference'];

    // Database Connection
    $conn = new mysqli("localhost", "root", "", "ambulance_booking");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO bookings (patient_name, gender, age, reason, condition, doctor_preference) 
            VALUES ('$patient_name', '$gender', '$age', '$reason', '$condition', '$doctor_preference')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Booking Successful!'); window.location.href='booking_form.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }

    $conn->close();
}
?>
