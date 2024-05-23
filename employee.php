<?php
// Initialize cURL session
$ch = curl_init();     
$apiUrl = "https://dummy.restapiexample.com/api/v1/employees";
//$apiUrl = "http://zkeco.xmzkteco.com:4370/personnel/api/areas/";

// Set cURL options
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

// Execute the cURL request
$response = curl_exec($ch);

// Check for cURL errors
if (curl_errno($ch)) {
    echo 'cURL error: ' . curl_error($ch);
    die();
}

// Close cURL session
curl_close($ch);

// Decode the JSON response
$data = json_decode($response, true);
if ($data && isset($data['data'])) {
    $countries = $data['data'];
    // Start the HTML table
    echo '<table border="1">';
    echo '<tr>';
    
    // Output table headers
    echo '<th>Name</th>';
    echo '<th>Salery</th>';
    echo '<th>Age</th>';
    //echo '<th>Image</th>';

    echo '</tr>';
    
    // Output the data rows
    foreach ($countries as $country) {
        echo '<tr>';
        echo '<td>' . $country['employee_name'] . '</td>';
        echo '<td>' . $country['employee_salary'] . '</td>';
        echo '<td>' . $country['employee_age'] . '</td>';
        //echo '<td>' . $country['profile_image'] . '</td>';
        echo '</tr>';
    }

    // Close the HTML table
    echo '</table>';
} else {
    echo 'Failed to retrieve data from the API.';
}
?>
