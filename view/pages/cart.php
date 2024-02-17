<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order Summary</title>
  <!-- Add Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-giJF6kkoqNQ00vy+HMDP7azOuL0xtbfIcaT9wjKHr8RbDVddVHyTfAAsrekwKmP1" crossorigin="anonymous">
</head>
<body>
  <!-- Add order summary section -->
  <div class="container mt-5">
    <div class="row">
      <div class="col-md-8 offset-md-2">
        <div class="card">
          <div class="card-header">
            <h5 class="mb-0">Order Summary</h5>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th>Product</th>
                    <th>Remove</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Sub-total</th>
                  </tr>
                </thead>
                <tbody>
                  <tr>
                    <td>RB3016 CLUBMASTER</td>
                    <td><button type="button" class="btn btn-link text-danger p-0">Remove</button></td>
                    <td>3000 TK</td>
                    <td>1</td>
                    <td>3000 TK</td>
                  </tr>
                </tbody>
                <tfoot>
                  <tr>
                    <th colspan="4" class="text-right">Total</th>
                    <th>3000 TK</th>
                  </tr>
                  <tr>
                    <th colspan="4" class="text-right">Tax and shipping cost</th>
                    <th>Will be calculated later</th>
                  </tr>
                </tfoot>
              </table>
            </div>
            <div class="text-right">
              <button type="button" class="btn btn-primary">Check-out</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!-- Add Bootstrap JavaScript -->
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-eMNCOe7tC1doHpGoJtKh7z7lGz7fuP4F8nfdFvFx6PDO8DIHyCA5szJp9g3Ef5e" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-B4gt1jrGC7Jh4AgTPSdUtOBvfO8sh+Wy6jO8CBwx9e7ZlKaXJ/jjoCktHsoNyPfD" crossorigin="anonymous"></script>
</body>
</html>
