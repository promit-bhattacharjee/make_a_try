let btn=document.getElementById("submitBtn")
const emailRegex = /^[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{2,}$/;
const passwordRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{4,20}$/;
const mobileRegex = /^\d{11,15}$/;
const addressRegex = /^[a-zA-Z0-9\s\.,\-/#()']+$/;
const nameRegex = /^[a-zA-Z]{3,20}$/;
document.getElementById('userName').addEventListener("input",()=>{
    let inputField = document.getElementById('userName')
    let alertArea = document.getElementById('userNameAlertText');
    if (nameRegex.test(inputField.value)) {
        inputField.classList="form-control is-valid"
        alertArea.innerText="Not Valid"
        alertArea.classList="d-none"  
    } else{
        alertArea.innerText="Not Valid"
        alertArea.classList="invalid-feedback d-block"
        inputField.classList="form-control is-invalid"
    }
})
    // Email
    document.getElementById('userEmail').addEventListener("input",()=>{
        let inputField = document.getElementById('userEmail')
        let alertArea = document.getElementById('userEmailAlertText');
        if (emailRegex.test(inputField.value)) {
            inputField.classList="form-control is-valid"
            alertArea.innerText="Not Valid"
            alertArea.classList="d-none"  
        } else{
            alertArea.innerText="Not Valid"
            alertArea.classList="invalid-feedback d-block"
            inputField.classList="form-control is-invalid"
        }
    })
   // password
   document.getElementById('userPassword').addEventListener("input",()=>{
    let inputField = document.getElementById('userPassword')
    let alertArea = document.getElementById('userPasswordAlertText');
    if (passwordRegex.test(inputField.value)) {
        inputField.classList="form-control is-valid"
        alertArea.innerText="Not Valid"
        alertArea.classList="d-none"  
    } else{
        alertArea.innerText="Not Valid"
        alertArea.classList="invalid-feedback d-block"
        inputField.classList="form-control is-invalid"
    }
})
   //Confirm password
   document.getElementById('userConfirmPassword').addEventListener("input",()=>{
    let inputField = document.getElementById('userConfirmPassword')
    let alertArea = document.getElementById('userConfirmPasswordAlertText');
    if (passwordRegex.test(inputField.value)) {
        inputField.classList="form-control is-valid"
        alertArea.innerText="Not Valid"
        alertArea.classList="d-none"  
    } else{
        alertArea.innerText="Not Valid"
        alertArea.classList="invalid-feedback d-block"
        inputField.classList="form-control is-invalid"
    }
})
   //mobile
   document.getElementById('userMobile').addEventListener("input",()=>{
    let inputField = document.getElementById('userMobile')
    let alertArea = document.getElementById('userMobileAlertText');
    if (mobileRegex.test(inputField.value)) {
        inputField.classList="form-control is-valid"
        alertArea.innerText="Not Valid"
        alertArea.classList="d-none"  
    } else{
        alertArea.innerText="Not Valid"
        alertArea.classList="invalid-feedback d-block"
        inputField.classList="form-control is-invalid"
    }
})
   //Adress
   document.getElementById('userAdress').addEventListener("input",()=>{
    let inputField = document.getElementById('userAdress')
    let alertArea = document.getElementById('userAdressAlertText');
    if (addressRegex.test(inputField.value)) {
        inputField.classList="form-control is-valid"
        alertArea.innerText="Not Valid"
        alertArea.classList="d-none"  
    } else{
        alertArea.innerText="Not Valid"
        alertArea.classList="invalid-feedback d-block"
        inputField.classList="form-control is-invalid"
    }
})
// ==================================Login===============================
document.getElementById('userLogEmail').addEventListener("input", () => {
    let inputField = document.getElementById('userLogEmail');
    let alertArea = document.getElementById('userLogEmailAlertText');
    if (emailRegex.test(inputField.value)) {
      inputField.classList = "form-control is-valid";
      alertArea.innerText = "Valid Email";
      alertArea.classList = "valid-feedback d-block";
    } else {
      alertArea.innerText = "Invalid Email";
      alertArea.classList = "invalid-feedback d-block";
      inputField.classList = "form-control is-invalid";
    }
  });
  document.getElementById('userLogPassword').addEventListener("input", () => {
    let inputField = document.getElementById('userLogPassword');
    let alertArea = document.getElementById('userLogPasswordAlertText');
    if (passwordRegex.test(inputField.value)) {
      inputField.classList = "form-control is-valid";
      alertArea.innerText = "Valid Password";
      alertArea.classList = "valid-feedback d-block";
    } else {
      alertArea.innerText = "Invalid Password";
      alertArea.classList = "invalid-feedback d-block";
      inputField.classList = "form-control is-invalid";
    }
  });
  


// =========================================================
// imageRealTimePriview

let imgInput = document.getElementById('userImage');
document.getElementById('imageBtn').addEventListener('click', () => {
    imgInput.click();
});
let preview = document.getElementById('imagePreview');
imgInput.addEventListener('change', () => {
    if (imgInput.files && imgInput.files[0]) {
        preview.src = URL.createObjectURL(imgInput.files[0]);
        preview.style.display = 'inline-block';
    }
});
// ==============================================
{
    document.getElementById('funAlert').addEventListener('click', () => {
        if (confirm("Confirm Logout!")) {
            location.href = 'Logout.php';
        } else {
            window.close;
        }
    })

}