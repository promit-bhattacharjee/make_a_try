<?php 
session_start();
$_SESSION['admin_id']=rand(1,5);
$_SESSION['admin_link']=rand(1,5);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Spinner and Modal Example</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <!-- Spinner -->
    <div class="d-flex flex-column justify-content-center align-items-center" style="height: 100vh; display: flex;">
        <!-- Spinner -->
        <div class="spinner-grow" id="spinnerContainer" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
        
        <!-- Text -->
        <div class="display-4 text-danger mt-3">Are You Admin?</div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script>
        setTimeout(function () {
            document.getElementById('spinnerContainer').style.display = 'none';
            window.alert('Hey Admin Welcome Back')
            window.location.href = 'view/pages/productsList.php';

        }, 2000);
    </script>
</body>

</html>