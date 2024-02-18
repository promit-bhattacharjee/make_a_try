<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Camera Capture</title>
</head>

<body>
    <div>
        <div id="previewFrame" style="display: block;">
            <video id="video" width="400px" height="400px" autoplay style="display: none;"></video>
            <canvas id="canvas" width="400px" height="400px"></canvas>
            <!-- Hidden input to store image data -->
            <form action="faceAction.php" method="post" enctype="multipart/form-data">
                <input type="hidden" id="imageDataInput" name="imageDataInput">
                <button id="captureBtn" type="button">Capture Photo</button>
                <button id="retakeBtn" style="display: none;" type="button">Retake Photo</button>
                <button id="saveBtn" type="submit" style="display: none;">Save Image</button>
            </form>
        </div>

        <div id="resultFrame" style="display: none;">
            <img id="resultPhoto" width="400px" height="400px" alt="Captured Photo">
        </div>
    </div>

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

                    // Hide the preview frame
                    previewFrame.style.display = 'block';

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
