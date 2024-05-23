<?php
// Initialize cURL session
$ch = curl_init();
$apiUrl = "https://countriesnow.space/api/v0.1/countries";

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

// echo "<pre>";
// print_r($data);
// echo "</pre>";

if ($data && isset($data['data'])) {
    $countries = $data['data'];
    // Start the HTML table
    echo '<table border="1">';
    echo '<tr>';
    
    // Output table headers
    echo '<th>Country</th>';
    echo '<th>Cities</th>';

    echo '</tr>';
    
    // Output the data rows
    foreach ($countries as $country) {
        echo '<tr>';
        echo '<td>' . $country['country'] . '</td>';
        
        echo '<td>';
        if (isset($country['cities']) && is_array($country['cities'])) {
            echo '<ul>';
            foreach ($country['cities'] as $city) {
                echo '<li>' . $city . '</li>';
            }
            echo '</ul>';
        }
        echo '</td>';
        
        echo '</tr>';
    }

    // Close the HTML table
    echo '</table>';
} else {
    echo 'Failed to retrieve data from the API.';
}
?>
