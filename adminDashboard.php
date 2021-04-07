<?php include 'connection.php';
session_start();
if(!isset($_SESSION["username"])) {
  header("location: adminPortal.php");
}
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
  <!-- start of navbar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
  <div class="container-fluid">
    <a class="navbar-brand"><h4>Welcome admin <?php echo $_SESSION["username"]?></h4></a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="adminDashboard.php">Home</a>
        </li>  
      </ul>
      <ul class="navbar-nav ms-auto"> 
        <li clas="nav-item">
        <a href="logout.php" class="btn btn-danger">Logout</a> 
        </li>
      </ul>
    </div>
  </div>
</nav>   
<!-- end of navbar -->
<!-- start of showing the items --> 
<div class="container-fluid mt-5">
  <div class="row">
    <div class="col-lg-6">
      <h2>Item List</h2>
    </div>
    <div class="col-lg-6 text-end">
      <button class="btn btn-success" data-bs-toggle='modal' data-bs-target='#modalAdd'><i class='fas fa-plus'></i></button>
    </div>
    <!-- Start of the Modal Add -->
        <!-- Modal -->
        <div class="modal fade" id="modalAdd" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="ModalLabel">Add a new item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body card was-validated">
      <label for="itemListName">Name</label> 
        <input type="text" class="form-control" id="itemAddName" required> 
        <label for="itemListDescription">Description</label> 
        <textarea class="form-control" id="itemAddDescription" required></textarea>
        <label for="itemListPrice">Price</label> 
        <input type="text" class="form-control" id="itemAddPrice" required> 
        <label for="itemListStatus">Status</label> 
        <select class="form-select" id="itemAddStatus" required>
        <option value="" selected disable>Select Status</option> 
        <option value="Active">Active</option>
        <option value="In-Active">In-Active</option> 
        </select>
        <input type="text" class="form-control" id="tbAddDate" hidden> 
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-success btnAddToCartConfirm"><i class="fas fa-check"></i> Add</button>
      </div>
    </div>
  </div>
</div> <!-- end of modal -->  
  </div> 
<table id="gadgetsItemTable" class="table table-striped table-light"> 
            <thead>
                <tr>
                <th scope="col">Name</th>
                <th scope="col">Description</th>
                <th scope="col">Price</th>
                <th scope="col">Status</th>
                <th scopr="col">Created</th>
                <th scopr="col">Updated</th>
                <th scopr="col">Delete</th>
                <th scopr="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
              $sql = "SELECT `Name`, `Short_description`, `Price`, `Status`, `Created_At`, `Updated_At`, `Deleted_At` FROM `product`";
              $result = $conn -> query($sql);

              if($result-> num_rows > 0) {
                while ($row = $result -> fetch_assoc()) {
                  echo "<tr>
                  <td>".$row["Name"]."</td>
                  <td>".$row["Short_description"]."</td>
                  <td>".$row["Price"]."</td>
                  <td>".$row["Status"]."</td>
                  <td>".$row["Created_At"]."</td>
                  <td>".$row["Updated_At"]."</td>
                  <td>".$row["Deleted_At"]."</td>
                  <td>"."
                  <button type='button' class='btn btn-primary btnEdit' data-bs-toggle='modal' data-bs-target='#modalEdit'><i class='fas fa-edit'></i></button> 
                  <button type='button' class='btn btn-danger btnSoftDelete' data-bs-toggle='modal' data-bs-target='#modalSoftDelete'><i class='fas fa-trash'></i></button>"."</td> 
                  </tr>";
                }
                  echo "</table>";
                } else {
                  echo "0 result"; 
                }
            ?>  
            </tbody>
        </table> 
        <!-- Start of the Modal Add -->
        <!-- Modal -->
        <div class="modal fade" id="modalEdit" tabindex="-1" aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditLabel">Add a new item</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
      <div class="modal-body card was-validated"> 
      <label for="itemListName">Name</label> 
        <input type="text" class="form-control" id="itemListName" disabled> 
        <label for="itemListDescription">Description</label> 
        <textarea class="form-control" id="itemListDescription" required></textarea>
        <label for="itemListPrice">Price</label> 
        <input type="text" class="form-control" id="itemListPrice" required> 
        <label for="itemListStatus" required>Status</label> 
        <select class="form-select" id="itemListStatus">
        <option selected disabled>Select</option>
        <option value="Active">Active</option>
        <option value="In-Active">In-Active</option> 
        </select>
        <input type="text" class="form-control" id="tbUpdateDate" hidden> 
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-success btnEditToCartConfirm"><i class="fas fa-check"></i> Add</button>
      </div>
    </div>
  </div>
  </div>
</div> <!-- end of modal --> 
<!-- Modal Delete -->
<div class="modal fade" id="modalSoftDelete" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body card text-center"> 
      <strong class="mb-3">Are you sure you want to delete??</strong> 
      <input type="text" class="form-control" id="itemListName" hidden>
      <input type="text" class="form-control" id="tbDeleteDate" hidden>  
      <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="fas fa-times"></i> Close</button>
        <button type="button" class="btn btn-success btnDeleteToCartConfirm"><i class="fas fa-check"></i> Delete</button>
      </div>
    </div>
  </div>
</div>
<!-- end of showing the items -->
<p class="mt-5"></p>
    <!-- Optional JavaScript; choose one of the two! -->
    <!-- Jquery -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.js"></script> 
    <!-- custom files -->
    <script src="assets/js/adminDashbaordFIle.js"></script>
    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    -->
  </body>
</html>