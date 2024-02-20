<!-- <!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Search</title> -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link src="../connections/productSearch.css">
    <!-- Add any other stylesheets or custom styles here -->

<!-- </head>

<body>

     -->
    <form method="post" action="../actions/productSearchAction.php " id="searchForm">
        <div class="container mt-5">
            <div class="d-flex flex-sm-row border border-dark w-100 justify-content-between align-items-center rounded input-group"
                id="searchContainer">
                <!-- Search Input -->
                <input type="text" class="form-control border-0" id="productName" name="productName"
                    aria-label="Text input with segmented dropdown button">
                <!-- Clear Button -->
                <button type="button" onclick="" class="btn btn-outline-dark ms-1 me-3 rounded" id="formClearBtn"> <i class="fa-solid fa-xmark"></i></button>
                <!-- Search Buttons Dropdown -->
                <div class="border border-dark d-flex m-2 rounded">
                    <button type="submit"
                        class="d-flex btn btn-outline-dark border-0 justify-content-center align-items-center me-0  ">
                        <span class="me-2">Search</span>
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                    <button type="button" class="btn btn-outline-dark border-0 dropdown-toggle dropdown-toggle-split"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        <span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end rounded">
                        <li class="me-5">
                            <div class="form-check d-flex justify-content-center align-items-center">
                                <input class="form-check-input m-2 p-2" type="checkbox" value="" id="filterSearch">
                                <span class="">Filter Search</span>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
    
            <!-- filter Search -->
            <!-- Category  -->
            <div class="row d-flex justify-content-around d-none" id="filterSearchContainer">
                <div class="m-2 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                    <div class="input-group flex-nowrap rounded border">
                        <span class="input-group-text border-0 userAdressLabel bg-white fw-bold"
                            id="addon-wrapping">Category</span>
                        <div class="w-100 bg-white d-flex align-items-center justify-content-evenly border ">
                            <!-- Category Options -->
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categoryCheckbox"
                                    id="categoryCheckbox1" value="fashion" checked>
                                <label class="form-check-label" for="categoryCheckbox1">
                                    Fashion
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="categoryCheckbox"
                                    id="categoryCheckbox2" value="optical">
                                <label class="form-check-label" for="categoryCheckbox2">
                                    Optical
                                </label>
                            </div>
                        </div>
                    </div>
                    <span id="categoryAlertText" class="text-danger"></span>
                </div>
                <!-- Brand Input -->
                <div class="m-2 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                    <div class="input-group ">
                        <span class="input-group-text bg-white bg-white  fw-bold" id="basic-addon1">Brand</span>
                        <input type="text" class="form-control" name="productBrand" id="productBrand" aria-label="Brand"
                            aria-describedby="basic-addon1">
                    </div>
                    <span id="brandAlertText" class="text-danger"></span>
                </div>
                <!-- Model Input -->
                <div class="m-2 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                    <div class="input-group ">
                        <span class="input-group-text bg-white bg-white  fw-bold" id="basic-addon1">Model</span>
                        <input type="text" class="form-control" name="productModel" id="productModel" aria-label="Model"
                            aria-describedby="basic-addon1">
                    </div>
                    <span id="modelAlertText" class="text-danger"></span>
                </div>
                <!-- Colour Input -->
                <div class="m-2 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white fw-bold" id="basic-addon1">Colour</span>
                        <input type="text" class="form-control" name="productColour" id="productColour" aria-label="Colour"
                            aria-describedby="basic-addon1">
                    </div>
                    <span id="colourAlertText" class="text-danger"></span>
                </div>
                <!-- Gender Input -->
                <div class="m-2 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5">
                    <div class="input-group flex-nowrap rounded border">
                        <span class="input-group-text border-0 userAdressLabel bg-white fw-bold"
                            id="addon-wrapping">Gender</span>
                        <div class="w-100 bg-white d-flex align-items-center justify-content-evenly border ">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="productGender" id="genderCheckbox1"
                                    value="male" checked>
                                <label class="form-check-label" for="genderCheckbox1">
                                    Male
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="productGender" id="genderCheckbox2"
                                    value="female">
                                <label class="form-check-label" for="genderCheckbox2">
                                    Female
                                </label>
                            </div>
                        </div>
                    </div>
                    <span id="genderAlertText" class="text-danger"></span>
                </div>
    
                <!-- Price Inputs -->
                <div class="m-2 mt-0 col-12 col-sm-12 col-md-5 col-lg-5 col-xl-5 col-xxl-5 row">
                    <!-- Min Price Input -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 d-flex m-0 p-0 mt-2">
                        <span class="input-group-text bg-white fw-bold" id="basic-addon1">Min-Price</span>
                        <input type="number" class="form-control" name="minPrice" id="minPrice" placeholder="0"
                            aria-label="Min-Price" aria-describedby="basic-addon1">
                    </div>
                    <!-- Max Price Input -->
                    <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 col-xxl-6 d-flex m-0 p-0 mt-2">
                        <span class="input-group-text bg-white fw-bold" id="basic-addon1">Max-Price</span>
                        <input type="number" class="form-control" name="maxPrice" id="maxPrice" placeholder="9999999"
                            aria-label="Max-Price" aria-describedby="basic-addon1">
                    </div>
                    <span id="priceAlertText" class="text-danger"></span>
                </div>
            </div>
        </div>
    
</form>

<script src="../connections/searchValidation.js"> </script>
     <!-- Bootstrap JS and FontAwesome JS
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        crossorigin="anonymous"></script>


</body>




</html> -->