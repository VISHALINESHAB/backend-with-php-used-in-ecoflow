<?php
// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "donate";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $first_name = $_POST["first_name"];
    $last_name = $_POST["last_name"];
    $gender = $_POST["gender"];
    $address = $_POST["address"];
    $phone = $_POST["phone"];
    $zip_code = $_POST["code"];
    $dob = $_POST["dob"];
    $bank_name = $_POST["bank"];
    $branch_name = $_POST["branch"];
    $email = $_POST["email"];
    $card_name = $_POST["card_name"];
    $card_number = $_POST["card_number"];
    $expiry_month = $_POST["expiry_month"];
    $expiry_year = $_POST["expiry_year"];

    // Prepare SQL statement
    $sql = "INSERT INTO donate (first_name, last_name, gender, address, phone, zip_code, dob, bank_name, branch_name, email, card_name, card_number, expiry_month, expiry_year) VALUES ('$first_name', '$last_name', '$gender', '$address', '$phone', '$zip_code', '$dob', '$bank_name', '$branch_name', '$email', '$card_name', '$card_number', '$expiry_month', '$expiry_year')";

    // Execute SQL statement
    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

// Close connection
$conn->close();
?>
