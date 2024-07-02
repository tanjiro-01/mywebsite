<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate inputs (you should add more validation as needed)
    $item_name = $_POST['item'] ?? '';
    $price = $_POST['price'] ?? 0;

    // Validate inputs
    if (empty($item_name) || !is_numeric($price) || $price <= 0) {
        echo "Invalid input data.";
        exit;
    }

    // Connect to database
    $servername = "localhost";
    $username = "root";
    $password = ""; // Replace with your MySQL password if set
    $dbname = "cart_db"; // Replace with your database name

    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare SQL statement to insert data into cart_items table
    $stmt = $conn->prepare("INSERT INTO cart_items (item_name, price) VALUES (?, ?)");
    $stmt->bind_param("sd", $item_name, $price);

    // Execute the statement
    if ($stmt->execute()) {
        echo "Item added to cart successfully.";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Error: Invalid request.";
}
?>
