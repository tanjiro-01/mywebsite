<?php
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

// Query to fetch all items from cart_items table
$sql = "SELECT item_name, price FROM cart_items";
$result = $conn->query($sql);

// Initialize an empty array to store fetched items
$items = [];

// Check if there are rows returned
if ($result->num_rows > 0) {
    // Loop through each row and fetch item details
    while ($row = $result->fetch_assoc()) {
        $items[] = [
            'item_name' => $row['item_name'],
            'price' => $row['price']
        ];
    }
}

// Close connection
$conn->close();

// Encode items array as JSON for easier handling in JavaScript (optional)
echo json_encode($items);
?>
