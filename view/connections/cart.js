function incrementQuantity() {
    var quantityInput = document.querySelector('input[type="text"]');
    quantityInput.value = parseInt(quantityInput.value, 10) + 1;
  }

  function decrementQuantity() {
    var quantityInput = document.querySelector('input[type="text"]');
    var value = parseInt(quantityInput.value, 10);
    if (value > 1) {
      quantityInput.value = value - 1;
    }
  }