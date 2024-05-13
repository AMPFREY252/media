<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $dob = $_POST['dob'];
    $email = $_POST['email'];
    $location = $_POST['location'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validate form data
    if (empty($firstname) || empty($lastname) || empty($dob) || empty($email) || empty($location) || empty($password) || empty($confirm_password)) {
        echo "Please fill out all fields.";
    } elseif ($password !== $confirm_password) {
        echo "Error: Passwords do not match.";
    } else {
        // Hash the password
        $password_hash = password_hash($password, PASSWORD_BCRYPT);

        // Database connection details (replace with your actual values)
        $db_host = 'localhost';
        $db_name = 'users';
        $db_user = 'root';
        $db_password = '';

        try {
            // Create a PDO connection
            $conn = new PDO("mysql:host=$db_host;dbname=$db_name", $db_user, $db_password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            // Prepare and execute the INSERT query
            $sql = "INSERT INTO user (firstname, lastname, dob, email, location, password) VALUES (:firstname, :lastname, :dob, :email, :location, :password)";
            $stmt = $conn->prepare($sql);
            $stmt->bindParam(':firstname', $firstname);
            $stmt->bindParam(':lastname', $lastname);
            $stmt->bindParam(':dob', $dob);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':location', $location);
            $stmt->bindParam(':password', $password_hash);
            $stmt->execute();

            echo "Registration successful! You can now log in.";
            // Optionally, you can redirect the user to another page after successful registration
              header("Location: dashboard.html");
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }

        // Close the connection
        $conn = null;
    }
} else {
    // If the form is not submitted, redirect to the signup page
    header("Location: project.html");
}
