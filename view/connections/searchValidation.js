document.getElementById("formClearBtn").addEventListener("click", function () {
    clearForm();
});

function clearForm() {
    document.getElementById("searchForm").reset();
}
document.getElementById('filterSearch').addEventListener('change', function (){
    if(this.checked)
        {
            document.getElementById('filterSearchContainer').classList.remove('d-none');
            document.getElementById('filterSearchContainer').classList.add('d-block');
            document.getElementById('productBrand').addEventListener('input', function () {
                validateBrand();
            });
        
            document.getElementById('minPrice').addEventListener('input', function () {
                validatePrice();
            });
        
            document.getElementById('maxPrice').addEventListener('input', function () {
                validatePrice();
            });
        
            document.getElementById('productColour').addEventListener('input', function () {
                validateColour();
            });
        
            document.getElementById('productModel').addEventListener('input', function () {
                validateModel();
            });
            document.getElementById('genderCheckbox1').addEventListener('change', function () {
                validateGender();
            });
        
            document.getElementById('genderCheckbox2').addEventListener('change', function () {
                validateGender();
            });
        
            document.getElementById('categoryCheckbox1').addEventListener('change', function () {
                validateCategory();
            });
        
            document.getElementById('categoryCheckbox2').addEventListener('change', function () {
                validateCategory();
            });
            function validateCategory() {
                var categoryCheckbox1 = document.getElementById('categoryCheckbox1');
                var categoryCheckbox2 = document.getElementById('categoryCheckbox2');
                var isValid = categoryCheckbox1.checked || categoryCheckbox2.checked;
        
                if (!isValid) {
                    document.getElementById('categoryAlertText').innerText = 'Please select at least one category.';
                } else {
                    document.getElementById('categoryAlertText').innerText = '';
                }
            }
        
            function validateBrand() {
                var input = document.getElementById('productBrand');
                var regex = /^[A-Za-z]+$/;
                var isValid = regex.test(input.value);
        
                if (!isValid) {
                    document.getElementById('brandAlertText').innerText = 'Only alphabetic characters are allowed.';
                } else {
                    document.getElementById('brandAlertText').innerText = '';
                }
            }
        
            function validateColour() {
                var input = document.getElementById('productColour');
                var regex = /^[A-Za-z]+$/;
                var isValid = regex.test(input.value);
        
                if (!isValid) {
                    document.getElementById('colourAlertText').innerText = 'Only alphabetic characters are allowed.';
                } else {
                    document.getElementById('colourAlertText').innerText = '';
                }
            }
        
            function validateModel() {
                var input = document.getElementById('productModel');
                var regex = /^[A-Za-z]+[0-9]*$/; // Allow alphanumeric characters
                var isValid = regex.test(input.value);
        
                if (!isValid) {
                    document.getElementById('modelAlertText').innerText = 'Only alphanumeric characters are allowed.';
                } else {
                    document.getElementById('modelAlertText').innerText = '';
                }
            }
        
            function validatePrice() {
                var minPrice = document.getElementById('minPrice').value;
                var maxPrice = document.getElementById('maxPrice').value;
        
                if (isNaN(minPrice) || isNaN(maxPrice) || minPrice < 0 || maxPrice <= 0 || minPrice >= maxPrice || maxPrice == minPrice) {
                    document.getElementById('priceAlertText').innerText = 'Invalid price range.';
                } else {
                    document.getElementById('priceAlertText').innerText = '';
                }
            }
            function validateGender() {
                var genderCheckbox1 = document.getElementById('genderCheckbox1');
                var genderCheckbox2 = document.getElementById('genderCheckbox2');
                var isValid = genderCheckbox1.checked || genderCheckbox2.checked;
        
                if (!isValid) {
                    document.getElementById('genderAlertText').innerText = 'Please select at least one gender.';
                } else {
                    document.getElementById('genderAlertText').innerText = '';
                }
            }
        }
    else{
        document.getElementById('filterSearchContainer').classList.remove('d-block');
        document.getElementById('filterSearchContainer').classList.add('d-none');


    }
} );
