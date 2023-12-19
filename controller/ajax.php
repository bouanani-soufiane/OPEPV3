<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get the JSON-encoded data from the request body
    $postData = file_get_contents('php://input');

    // Decode the JSON data into a PHP associative array
    $data = json_decode($postData, true);

    // Check if decoding was successful
    if ($data !== null) {
        // Access the array of data
        $dataArray = $data['data'];

        // Handle the data as needed
        // For example, you can loop through the array
        foreach ($dataArray as $value) {
            echo $value . "\n";
        }
    } else {
        // Handle JSON decoding error
        echo 'Error decoding JSON data';
    }
} else {
    // Handle invalid request method
    echo 'Invalid request method';
}
?>
