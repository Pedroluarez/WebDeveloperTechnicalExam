<?php include 'connection.php';  

$itemName = $_POST['itemName']; 
$itemDescription = $_POST['itemDescription']; 
$itemPrice = $_POST['itemPrice'];
$itemStatus = $_POST['itemStatus']; 
$itemAddDate = $_POST['itemAddDate']; 
$itemUpdate = $_POST['itemUpdate'];
$itemDelete = $_POST['itemDelete'];    

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = "INSERT INTO `product`(`Name`, `Short_description`, `Price`, `Status`, `Created_At`, `Updated_At`, `Deleted_At`) VALUES 
('$itemName','$itemDescription','$itemPrice','$itemStatus','$itemAddDate','$itemUpdate','$itemDelete')";

if (mysqli_query($conn, $sql)) {  
  header('Location: index.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 