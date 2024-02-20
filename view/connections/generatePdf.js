function validateOnChange(inputElement) {
    var inputValue = inputElement.value;
    var alertId = inputElement.id + "AlertText";
    var alertElement = document.getElementById(alertId);

    // Simple validation
    if (inputValue.trim() === "") {
      alertElement.innerHTML = "Field is required.";
    } else if (inputElement.id === "paymentId" && !/^\d{12}$/.test(inputValue)) {
      alertElement.innerHTML = "Must be 12 digits.";
    } else if (inputElement.id === "mobileNumber" && !/^\d{11}$/.test(inputValue)) {
      alertElement.innerHTML = "Must be 11 digits.";
    } else {
      alertElement.innerHTML = "";
    }
  }

  function validateForm() {
    var paymentId = document.getElementById("paymentId").value;
    var mobileNumber = document.getElementById("mobileNumber").value;

    // Simple validation for Payment ID
    if (paymentId.trim() === "") {
      document.getElementById("paymentIdAlertText").innerHTML = "Payment ID is required.";
      return false;
    } else if (!/^\d{12}$/.test(paymentId)) {
      document.getElementById("paymentIdAlertText").innerHTML = "Payment ID must be 12 digits.";
      return false;
    } else {
      document.getElementById("paymentIdAlertText").innerHTML = "";
    }

    // Simple validation for Mobile Number
    if (mobileNumber.trim() === "") {
      document.getElementById("mobileNumberAlertText").innerHTML = "Mobile Number is required.";
      return false;
    } else if (!/^\d{11}$/.test(mobileNumber)) {
      document.getElementById("mobileNumberAlertText").innerHTML = "Mobile Number must be 11 digits.";
      return false;
    } else {
      document.getElementById("mobileNumberAlertText").innerHTML = "";
    }

    // Form is valid, continue with submission
    return true;
  }