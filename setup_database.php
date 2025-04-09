<?php
require_once 'config/database.php';

function executeSQLFromFile($filename, $conn) {
    // Read the entire file
    $sql = file_get_contents($filename);
    
    if ($sql === false) {
        die("Error reading SQL file");
    }

    // Execute multiple queries
    if ($conn->multi_query($sql)) {
        do {
            // Store first result set
            if ($result = $conn->store_result()) {
                $result->free();
            }
        } while ($conn->more_results() && $conn->next_result());
    }

    if ($conn->errno) {
        die("SQL error: " . $conn->error);
    }
}

// Create connection
$conn = getDBConnection();

try {
    // Execute the schema file
    executeSQLFromFile('db_schema.sql', $conn);
    
    echo "<div class='p-4 bg-green-100 text-green-800 rounded'>Database setup completed successfully!</div>";
} catch (Exception $e) {
    echo "<div class='p-4 bg-red-100 text-red-800 rounded'>Error setting up database: " . $e->getMessage() . "</div>";
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-6 rounded-lg shadow">
        <h1 class="text-2xl font-bold mb-4">Database Setup</h1>
        <p class="mb-4">Click the button below to initialize the database:</p>
        <form method="post">
            <button type="submit" 
                class="w-full bg-blue-500 text-white py-2 px-4 rounded hover:bg-blue-600">
                Initialize Database
            </button>
        </form>
    </div>
</body>
</html>
