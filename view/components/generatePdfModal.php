<button type="button" class="btn primaryBgClr text-white py-2 ml-5" data-bs-toggle="modal" data-bs-target="#exampleModal">
  Payment
</button>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
        <button type="button" class="btn-close" id="btnClose" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="d-flex justify-content-center">
          <form id="paymentForm" class="border-1 border border-white" method="post" action="../pages/cart.php" onsubmit="return validateForm()">
            <!-- Payment ID -->
            <div class="container">
              <label for="paymentId">Payment ID</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <input type="text" id="paymentId" class="form-control" aria-label="Payment ID" aria-describedby="addon-wrapping" name="paymentId" oninput="validateOnChange(this)">
              </div>
              <span id="paymentIdAlertText" class="userAlertText" style="color: red;"></span>
            </div>
            <!-- Mobile Number -->
            <div class="container">
              <label for="mobileNumber">Mobile Number</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <input type="text" id="mobileNumber" class="form-control" aria-label="Mobile Number" aria-describedby="addon-wrapping" name="mobileNumber" oninput="validateOnChange(this)">
              </div>
              <span id="mobileNumberAlertText" class="userAlertText" style="color: red;"></span>
            </div>

            <div class="container d-flex justify-content-between">
              <button type="submit" value="set" name="formsubmited" class="btn btn-success mt-2">Join</button>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</div>

