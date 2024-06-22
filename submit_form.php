<?php
// Database connection details
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "volunteer_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $birthday = $_POST['birthday'];
    $gender = $_POST['gender'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $volunteering = $_POST['Volunteering'];

    // Insert data into database
    $sql = "INSERT INTO volunteers (first_name, last_name, birthday, gender, email, phone, volunteering)
            VALUES ('$first_name', '$last_name', '$birthday', '$gender', '$email', '$phone', '$volunteering')";

    if ($conn->query($sql) === TRUE) {
        echo "Form submitted successfully!";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }

    // Close connection
    $conn->close();
}
?>
