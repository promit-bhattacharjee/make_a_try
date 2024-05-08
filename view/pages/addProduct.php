<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>adminDashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="color.css">
</head>

<body>
    <?php include("../components/adminSidebar.php") ?>
    <main>
        <div class="container-xl mt-4 style= ">
            <form action="../actions/addProductAction.php" method="post" enctype="multipart/form-data">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-xl-8 ">
                            <!-- poduct -->
                            <span id="validationMessage" class="text-danger"></span>

                            <div class="card mb-4">
                                <div class="card-header">Add Product</div>
                                <div class="card-body">
                                    <div class="row gx-3 mb-3">
                                        <div class="mb-3 col-md-6">
                                            <label class="small mb-1" for="productName">Name</label>
                                            <input class="form-control" id="productName" type="text" name="productName"
                                                required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productCategory">Category</label>
                                            <input class="form-control" id="productCategory" name="productCategory"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productPrice">Price</label>
                                            <input class="form-control" id="productPrice" name="productPrice"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productBrand">Brand</label>
                                            <input class="form-control" id="productBrand" name="productBrand"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productWidth">Width</label>
                                            <input class="form-control" id="productWidth" name="productWidth"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productHeight">Height</label>
                                            <input class="form-control" id="productHeight" name="productHeight"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productModel">Model</label>
                                            <input class="form-control" id="productModel" name="productModel"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="col-md-6">
                                            <label class="small mb-1" for="productColour">Colour</label>
                                            <input class="form-control" id="productColour" name="productColour"
                                                type="text" placeholder="" required>
                                        </div>

                                        <div class="container mt-2">
                                            <div class="input-group flex-nowrap mt-2 mb-2 ">
                                                <span class="input-group-text userAdressLabel"
                                                    id="addon-wrapping">Gender</span>
                                                <div
                                                    class="w-100 bg-white d-flex align-items-center justify-content-evenly border">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="productGender" id="exampleRadios1" value="male"
                                                            checked>
                                                        <label class="form-check-label" for="exampleRadios1">
                                                            Male
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="productGender" id="exampleRadios2" value="female">
                                                        <label class="form-check-label" for="exampleRadios2">
                                                            Female
                                                        </label>
                                                    </div>
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            name="productGender" id="exampleRadios3" value="other">
                                                        <label class="form-check-label" for="exampleRadios3">
                                                            Common
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <span id="userAdressAlertText" class=""></span>
                                        </div>

                                        <div class="col-md-12">
                                            <label class="small mb-1" for="productDescription">Description</label>
                                            <textarea class="form-control" id="productDescription"
                                                name="productDescription" required style="height:150px;"></textarea>
                                        </div>
                                        <div class="col-md-6 text-center mx-auto mt-3">
                                            <!-- Product image -->
                                            <div class="card">
                                                <div class="card-header">Upload Product Image</div>
                                                <div class="card-body">
                                                    <!-- Add this div for image preview -->
                                                    <div class="card-body text-center input-group">
                                                        <input type="file" class="form-control img-fluid"
                                                            id="productImage" name="productImage" hidden
                                                            accept="Image/*">
                                                        <img id="imagePreview" class="w-100"
                                                            style="display: none; max-height: 300px;">
                                                    </div>
                                                    <h5 class="btn btn-light container w-100" id="imageBtn">Upload Image
                                                    </h5>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Save changes button-->

                                    <button class="btn btn-primary" type="button"
                                        onclick="validateForm()">Upload</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
    <script>
        let imgInput = document.getElementById('productImage');
        let preview = document.getElementById('imagePreview');

        document.getElementById('imageBtn').addEventListener('click', () => {
            imgInput.click();
        });

        imgInput.addEventListener('change', () => {
            if (imgInput.files && imgInput.files[0]) {
                preview.src = URL.createObjectURL(imgInput.files[0]);
                preview.style.display = 'inline-block';
            }
        });
    </script>
<script>
    function validateInput(inputElement, regex) {
        const inputValue = inputElement.value.trim();
        if (!regex.test(inputValue)) {
            // If the input doesn't match the regex pattern
            inputElement.classList.add('is-invalid');
            return false;
        } else {
            // If the input is valid
            inputElement.classList.remove('is-invalid');
            return true;
        }
    }

    function validateForm() {
        const productName = document.getElementById('productName');
        const productCategory = document.getElementById('productCategory');
        const productPrice = document.getElementById('productPrice');
        const productBrand = document.getElementById('productBrand');
        const productWidth = document.getElementById('productWidth');
        const productHeight = document.getElementById('productHeight');
        const productModel = document.getElementById('productModel');
        const productColour = document.getElementById('productColour');
        const productDescription = document.getElementById('productDescription');
        const validationMessage = document.getElementById('validationMessage');
        const nameRegex = /^[a-zA-Z\s]+$/;
        const categoryRegex = /^[a-zA-Z\s]+$/;
        const priceRegex = /^\d+(\.\d{1,10})?$/;
        const brandRegex = /^[a-zA-Z\s]+$/;
        const widthRegex = /^\d+(\.\d{1,2})?$/;
        const heightRegex = /^\d+(\.\d{1,2})?$/;
        const modelRegex = /^[a-zA-Z\d\s]+$/;
        const colourRegex = /^[a-zA-Z\s]+$/;
        const descriptionRegex = /^.{10,}$/; 

        let isValid = true;

        if (!validateInput(productName, nameRegex)) {
            // alert('Invalid input for Name. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productCategory, categoryRegex)) {
            // alert('Invalid input for Category. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productPrice, priceRegex)) {
            // alert('Invalid input for Price. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productBrand, brandRegex)) {
            // alert('Invalid input for Brand. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productWidth, widthRegex)) {
            // alert('Invalid input for Width. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productHeight, heightRegex)) {
            // alert('Invalid input for Height. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productModel, modelRegex)) {
            // alert('Invalid input for Model. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productColour, colourRegex)) {
            // alert('Invalid input for Colour. Please check and try again.');
            isValid = false;
        }

        if (!validateInput(productDescription, descriptionRegex)) {
            // alert('Invalid input for Description. Please check and try again.');
            isValid = false;
        }

        if (isValid) {
            validationMessage.innerText = ''; 
            document.forms[0].submit();
        } else {
            validationMessage.innerText = 'Invalid input. Please check your input and try again.';
        }
    }
</script>

</body>

</html>