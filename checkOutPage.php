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
    <title>Check-Out Page</title>
  </head>
  <!-- Start of the Header -->
    <div class="container mt-5">
        <div class="row">
          <div class="col col-lg-6">
            <h1>Check-Out Page</h1>
          </div> 
          <div class="col col-lg-6 text-end">
          <a type="button" class="btn btn-success" href="index.php">
          <strong><i class="fas fa-home"></i> Back to Item list</strong></a>
          </div>
        </div>
    </div> 
    <div class="container">
    <!-- End of the Header -->

    <!-- Start of the table --> 
    <table id="checkOutTable" class="table table-striped table-light">
          <thead>
            <tr> 
              <td>Name</td>
              <td>Price</td> 
            </tr>
          </thead>
          <tbody>
            <?php
              $sql = "SELECT `Name`, `Price` FROM `cart`";
              $result = $conn -> query($sql);

              if($result-> num_rows > 0) { 
                while ($row = $result -> fetch_assoc()) {
                  echo "<tr> 
                  <td>".$row["Name"]."</td>
                  <td>".$row["Price"]."</td> 
                  </tr>";
                }
                  echo "</table>";
                } else {
                  $cartRow = 0;
                }
            ?>  
            </tbody>
    </table>  
    <!-- End of the table -->
    <!-- Start of the information content -->
    <!-- php query to compute the sum of the price -->
    <?php
        $query = "SELECT SUM(Price) AS Price FROM `cart`";
        $result = mysqli_query($conn, $query);
        
        while($row = mysqli_fetch_assoc($result)){
            $output = "Total amount to pay is:"."
            ".$row['Price'];
        } 
    ?> 
    <div class="container">
        <h4 class="text-center"><?php echo $output ?></h4>
    </div>
    <div class="container mt-5"> 
        <div class="row">
          <div class="col-lg-6">
            <h4 class="mt-3 ms-3">Please fill out all the fields</h4>
          </div>
          <div class="col-lg-6">
            <h5 class="mt-3 ms-3 text-danger">Please note that the payment method is Cash on Delivery only</h5>
          </div>
        </div>
        <div class="container was-validated">
            <label for="tbName" class="mt-3 ms-5
                form-label">Name</label>
                    <input type="text" id="tbName" class=" mt-1 ms-5 w-50 form-control" required>
                <label for="tbEmail" class="mt-3 ms-5 form-label">Email</label>
                    <input type="email" id="tbEmail" class="  mt-1 ms-5 w-50 form-control" required>
                <label for="tbContactNumber" class="mt-3 ms-5 form-label">Contact Number</label>
                    <input type="number" id="tbContactNumber" class=" mt-1 ms-5 w-50 form-control" required>
                <label for="tbAddress" class="mt-3 ms-5 form-label">Address</label>
                    <input type="text" id="tbAddress" class=" mt-1 ms-5 w-50 form-control" required>
                <label for="tbCity" class="mt-3 ms-5 form-label">City</label>
                    <input type="text" id="tbCity" class="ms-5 w-50 form-control" required>
                <label for="tbStateProvince" class="mt-3 ms-5 form-label">State/Province</label>
                    <input type="text" id="tbStateProvince" class=" mt-1 ms-5 w-50 form-control" required>
                <label for="tbCode" class="mt-3 ms-5 form-label">Postal Code/Zip Code</label>
                    <input type="number" id="tbCode" class=" mt-1 ms-5 w-50 form-control" required>
                    <input type="text" id="tbCreated" class=" mt-1 ms-5 w-50 form-control" hidden>
                <button type="button" id="submitCheckOutConfirm" class="btn btn-success mt-4 ms-5 w-50 submitCheckOutConfirm">Submit Checkout</button>
        </div> 
    </div> 
    <p class="mb-5"></p>
    <!-- End of the information content -->
  <body>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> 
    <!-- custom files -->
    <script src="assets/js/checkOutPage.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>