<?php include 'connection.php';  

$itemName = $_POST['itemName'];    

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = "DELETE FROM `cart` WHERE `Name` = '$itemName' ";

if (mysqli_query($conn, $sql)) {  
  header('Location: index.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 