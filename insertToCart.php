<?php include 'connection.php';  

$itemName = $_POST['itemName']; 
$itemPrice = $_POST['itemPrice']; 
$guestName = $_POST['guestName'];  

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = "INSERT INTO `cart`(`guestName`,`Name`, `Price`) VALUES  
 ('$guestName', '$itemName','$itemPrice')";

if (mysqli_query($conn, $sql)) {  
  header('Location: index.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 