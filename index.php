<?php
include 'connection.php';
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <!-- data table -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.css">
    <!-- sweetalert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>  
    <!-- ajax -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-ajaxy/1.6.1/scripts/jquery.ajaxy.min.js"></script>
    <title>Home</title>
  </head>
  <body>
    <div class="container mt-5">
        <div class="row">
          <div class="col col-lg-6">
            <h1>Welcome guest!</h1>
          </div> 
          <div class="col col-lg-6 text-end">
          <a type="button" class="btn btn-success" href="#" data-bs-toggle="modal" data-bs-target="#cartContent">
          <strong><i class="fas fa-dolly-flatbed"></i> Check Cart</strong></a>
          </div>
        </div>
    </div>
    </div>
    <!-- Modal -->
  <div class="modal fade" id="cartContent" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel"><i class="fas fa-shopping-cart"></i> Cart</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body">  
        <table id="checkCartTable" class="table table-striped table-light">
          <thead>
            <tr> 
              <td>Name</td>
              <td>Price</td>
              <td>Cancel</td>
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT `guestName`, `Name`, `Price` FROM `cart`";
              $result = $conn -> query($sql);

              if($result-> num_rows > 0) { 
                while ($row = $result -> fetch_assoc()) {
                  echo "<tr> 
                  <td>".$row["Name"]."</td>
                  <td>".$row["Price"]."</td> 
                  <td>"."<button type='button' class='btn btn-danger btnRemoveToCart'
                  data-bs-toggle='modal' data-bs-target='#removeFromCartContent'><i class='fas fa-times'></i></button>"."</td>
                  </tr>";
                }
                  echo "</table>";
                } else {
                  $cartRow = 0;
                }
            ?>  
            </tbody>
        </table>
      </div>
      <input type="text" id="cartCheckoutModalCheckcer" value="<?php echo $cartRow ?>" hidden>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-window-close"></i> Close</button>
        <button type="button" id="btnConfirmCheckout" class="btn btn-success"><i class="fas fa-money-bill-wave-alt"></i> Checkout</button>
      </div>
    </div>
  </div>
</div>
<!-- Start of the Modal -->
        <!-- Modal -->
        <div class="modal fade" id="removeFromCartContent" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Are you sure?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body text-center">
      <input type="text" id="rowRemoveName" name="rowRemoveName" hidden> 
        <p>Do you want to remove this to your cart?
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-success  btnRemoveToCartConfirm"><i class="fas fa-check"></i> Yes</button>
      </div>
    </div>
  </div>
</div> <!-- end of modal -->

    <div class="container">
        <table id="gadgetsTable" class="table table-striped table-light"> 
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scopr="col">Buy</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $sql = "SELECT `Name`, `Short_description`, `Price`, `Status` FROM `product` WHERE `Status` = 'Active' ";
              $result = $conn -> query($sql);

              if($result-> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                  echo "<tr>
                  <td>".$row["Name"]."</td>
                  <td>".$row["Short_description"]."</td>
                  <td>".$row["Price"]."</td>
                  <td>"."<p class='text-success text-center'>".$row["Status"]."</p>"."</td>
                  <td>"."<button type='button' class='btn btn-primary btnAddToCart' data-bs-toggle='modal' data-bs-target='#addToCartContent'><i class='fas fa-shopping-cart'></i></button>"."</td>
                  </tr>";
                }
                  echo "</table>";
                } else {
                  echo "0 result"; 
                }
            ?>  
            </tbody>
        </table> 
        <!-- Start of the Modal -->
        <!-- Modal -->
  <div class="modal fade" id="addToCartContent" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Are you sure?</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body text-center">
      <input type="text" id="rowTargetName" name="rowTargetName" hidden>
      <input type="text" id="rowTargetPrice" name="rowTargetPrice" hidden>
        <p>Do you want to add this to your cart?</p> 
        <p>if yes enter your name</p>
        <input type="text" id="tbGuestName" class="form-control w-50 mx-auto text-center" placeholder="Enter your name.." required>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-success btnAddToCartConfirm"><i class="fas fa-check"></i> Yes</button>
      </div>
    </div>
  </div>
</div> <!-- end of modal -->
    </div> 
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> 
    <!-- custom files -->
    <script src="assets/js/index.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>