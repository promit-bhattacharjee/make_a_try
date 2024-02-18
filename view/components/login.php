
<button type="button" class="btn primaryBgClr text-white py-2 ml-5" data-bs-toggle="modal"
  data-bs-target="#exampleModal">
  Login
</button>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Login</h5>
        <button type="button" class="btn-close" id="btnClose" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <section class="d-flex justify-content-center">
          <form action="..\actions\loginAction.php" class="border-1 botder border-white" method="post">
            <!-- email -->
            <div class="container">
              <label for="userEmail">Email</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <input type="text" id="userLogEmail" class="form-control" aria-label="Username"
                  aria-describedby="addon-wrapping" name="userEmail">
              </div>
              <span id="userLogEmailAlertText" class="userAlertText"></span>
            </div>
            <!-- password -->
            <div class="container">
              <label for="userPassword">Password</label>
              <div class="input-group flex-nowrap mt-2 mb-2">
                <input type="text" id="userLogPassword" class="form-control" aria-label="Username"
                  aria-describedby="addon-wrapping" name="userPassword">
              </div>
              <span id="userLogPasswordAlertText" class="userAlertText"></span>
            </div>


            <div class="container d-flex justify-content-between">
              <button type="submit" value="set" name="formsubmited" class="btn btn-success mt-2"> Join
              </button>
            </div>
          </form>
        </section>
      </div>
    </div>
  </div>
</div>
