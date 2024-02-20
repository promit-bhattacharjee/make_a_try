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

    // Update ngrok URL based on the currently generated URL
    $apiEndpoint = 'https://9e38-35-229-121-37.ngrok-free.app' . '/api/detect_landmarks';
    $postData = ['image' => $file];

    $ch = curl_init($apiEndpoint);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $postData);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, ['Content-Type: multipart/form-data']); // Set Content-Type header

    $response = curl_exec($ch);

    if ($response === false) {
        echo "cURL Error: " . curl_error($ch);
    } else {
        // Print the response for debugging
        echo "API Response: " . $response;

        // Check if Flask API returned a valid response
        $decodedResponse = json_decode($response, true);
        if ($decodedResponse) {
            print_r($decodedResponse);
            // Display the Flask API response (measurement)
            // echo "Standard Width: " . $decodedResponse['standard_width'];
            // echo "Min Width: " . $decodedResponse['min_width'];
            // echo "Max Width: " . $decodedResponse['max_width'];
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




<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Capture</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
  <link rel="stylesheet" href="../connections/color.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <?php
  include("../components/navbar.php"); ?>
    <main>
    <div class="container mt-5">
        <div class="text-center">
            <div id="previewFrame" style="display: block;">
                <video id="video" width="400px" height="400px" autoplay style="display: none;"></video>
                <canvas id="canvas" width="400px" height="400px"></canvas>
                </div> 
            
            <h2 class="my-4 text-primary ">Take a Picture </h2>
                <!-- Hidden input to store image data -->
                <form action="" method="post" enctype="multipart/form-data">
                    <div class="d-flex justify-content-center m-5" id="captureFrame">
                    <input type="hidden" id="imageDataInput" name="imageDataInput">
                    <button id="captureBtn" type="button" class="btn btn-primary m-5">Capture Photo</button>
                    <button id="retakeBtn" style="display: none;" type="button" class="btn btn-secondary m-5">Retake Photo</button>
                    <button id="saveBtn" type="submit" style="display: none;" class="btn btn-success m-5">Save Image</button>
                </div>
                </form>

            <div id="resultFrame" style="display: none;">
                <img id="resultPhoto" width="400px" height="400px" alt="Captured Photo">
            </div>
        </div>
    </div>
    </main>
    <?php 
    include("../components/footer.php")
    ?>
    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', (event) => {
            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const resultFrame = document.getElementById('resultFrame');
            const resultPhoto = document.getElementById('resultPhoto');
            const previewFrame = document.getElementById('previewFrame');
            const captureBtn = document.getElementById('captureBtn');
            const saveBtn = document.getElementById('saveBtn');
            const retakeBtn = document.getElementById('retakeBtn');
            const imageDataInput = document.getElementById('imageDataInput');
            const context = canvas.getContext('2d');

            let showCircle = true;

            // Check if getUserMedia is supported
            if (navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                navigator.mediaDevices.getUserMedia({ video: true })
                    .then(function (stream) {
                        video.srcObject = stream;
                    })
                    .catch(function (error) {
                        console.error('Error accessing the camera:', error);
                    });

                // Draw the circle on the live camera feed
                function drawCircle() {
                    if (video.videoWidth > 0 && video.videoHeight > 0) {
                        canvas.width = video.videoWidth;
                        canvas.height = video.videoHeight;
                        context.drawImage(video, 0, 0, canvas.width, canvas.height);

                        if (showCircle) {
                            // Draw a circle at 20 centimeters depth (adjust according to your needs)
                            const depth = 120; // centimeters
                            const circleRadius = 10; // pixels

                            const centerX = canvas.width / 2;
                            const centerY = canvas.height / 2;
                            const pixelsPerCentimeter = canvas.width / video.videoWidth;

                            context.beginPath();
                            context.arc(centerX, centerY, depth * pixelsPerCentimeter, 0, 2 * Math.PI, false);
                            context.lineWidth = 3;
                            context.strokeStyle = 'red';
                            context.stroke();
                        }
                    }

                    requestAnimationFrame(drawCircle);
                }

                // Start drawing the circle
                drawCircle();

                captureBtn.addEventListener('click', function () {
                    // Stop drawing the circle after capturing the photo
                    showCircle = false;

                    // Capture a frame from the video stream and display it on the result photo
                    canvas.width = video.videoWidth;
                    canvas.height = video.videoHeight;
                    context.drawImage(video, 0, 0, canvas.width, canvas.height);

                    // Display the captured photo in the result frame
                    resultPhoto.src = canvas.toDataURL('image/png');
                    resultFrame.style.display = 'block';
                    captureBtn.style.display = 'none';
                    // Hide the preview frame
                    previewFrame.style.display = 'none';

                    // Show the save and retake buttons
                    saveBtn.style.display = 'block';
                    retakeBtn.style.display = 'block';

                    // Store base64-encoded image data in the hidden input
                    imageDataInput.value = canvas.toDataURL('image/jpeg');
                });

                retakeBtn.addEventListener('click', function () {
                    // Reset the flags and UI elements for retaking photo
                    showCircle = true;
                    resultFrame.style.display = 'none';
                    previewFrame.style.display = 'block';
                    saveBtn.style.display = 'none';
                    retakeBtn.style.display = 'none';

                    // Restart drawing the circle
                    showCircle = true;
                    drawCircle();
                });
            } else {
                console.error('getUserMedia is not supported on this browser');
            }
        });
    </script>
</body>

</html>
