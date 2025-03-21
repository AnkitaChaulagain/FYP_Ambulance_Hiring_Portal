<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Form</title>
    <link rel="stylesheet" href="Booking_form.css">
</head>

<body>

    <div class="form-container">
        <h2>Booking Form</h2>
        <form action="process_booking.php" method="POST">
            <label>Patient Name:</label>
            <input type="text" name="patient_name" required>

            <label>Gender:</label>
            <select name="gender" required>
                <option value="">Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
                <option value="Other">Other</option>
            </select>

            <label>Age:</label>
            <input type="number" name="age" required>

            <label>Reason for Booking:</label>
            <input type="text" name="reason" required>

            <label>Patient Current Condition/Symptom:</label>
            <input type="text" name="condition" required>

            <label>Doctor Preference:</label>
            <input type="text" name="doctor_preference">

            <button type="submit">Submit</button>
        </form>
    </div>

</body>
</html>