<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['imageDataInput'])) {
    // Get the base64-encoded image data from the POST request
    $base64ImageData = $_POST['imageDataInput'];

    // Remove the data URI prefix (e.g., "data:image/png;base64,")
    $base64ImageData = preg_replace('/^data:image\/(png|jpeg|jpg);base64,/', '', $base64ImageData);

    // Decode base64-encoded image data
    $imageData = base64_decode($base64ImageData);

    // Create a temporary file to store the image data
    $tempFilename = tempnam(sys_get_temp_dir(), 'uploaded_image_');
    file_put_contents($tempFilename, $imageData);

    // Create a cURL file object for file upload
    $file = curl_file_create($tempFilename, mime_content_type($tempFilename), basename($tempFilename));

    // Send the image file to the Flask API using cURL
    $apiEndpoint = 'https://0def-34-32-203-156.ngrok-free.app'.'/api/detect_landmarks';  // Replace with your actual Flask API endpoint
    $postData = ['image' => $file];

    $ch = curl_init($apiEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']); // Set Content-Type header

    $response = curl_exec($ch);

    $response = curl_exec($ch);

if ($response === false) {
    echo "Error: " . curl_error($ch);
} else {
    // Print the response for debugging
    echo "API Response: " . $response;
    
    // Check if Flask API returned a valid response
    $decodedResponse = json_decode($response, true);
    if ($decodedResponse && isset($decodedResponse['distance'])) {
        // Display the Flask API response (measurement)
        echo "Distance: " . $decodedResponse['distance'];
    } else {
        echo "Error: Invalid response from Flask API";
    }
}

    // Close cURL resource and remove the temporary file
    curl_close($ch);
    unlink($tempFilename);
    exit;
}
?>
