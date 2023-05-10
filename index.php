<?php
$base_url = 'http://52.59.33.40/web/api';
$register_endpoint = $base_url . '/register';
$read_endpoint = $base_url . '/code';

// Set up Curl
$ch = curl_init();

// Set the register endpoint
curl_setopt($ch, CURLOPT_URL, $register_endpoint);

// Set the HTTP method to POST
curl_setopt($ch, CURLOPT_POST, true);

// Set the headers
$token = '2XNVmuH2YVhYvVGgh4YkV9m6ph4c8CxMMX6UzeeDh7LJTmgdLk4Fz38QLwFt3sSY6BHkCeK8B3Jhgt23Q4dX6A3pmFRMGnJejwDg';
$headers = array(
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json'
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Set the request body
$data = array(
    'firstname' => 'Manasse',
    'surname' => 'Gitau'
);
$body = json_encode($data);
curl_setopt($ch, CURLOPT_POSTFIELDS, $body);

// Execute the request to register the user
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close the Curl session
curl_close($ch);

// Decode the response
$response_data = json_decode($response, true);

// Retrieve the unique string assigned to the user
$user_code = $response_data['assignedcode'];

// Set the read endpoint to include the user ID
$read_endpoint .= '/?code=' . $user_code;


// Set up a new Curl session for the GET request
$ch = curl_init();

// Set the read endpoint
curl_setopt($ch, CURLOPT_URL, $read_endpoint);

// Set the HTTP method to GET
curl_setopt($ch, CURLOPT_HTTPGET, true);

// Set the headers
$headers = array(
    'Authorization: Bearer ' . $token,
    'Content-Type: application/json',
    'code:'.$user_code
);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

// Execute the GET request to retrieve the user data
$response = curl_exec($ch);

// Check for errors
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Close the Curl session
curl_close($ch);

// Print the user data
echo $response;
