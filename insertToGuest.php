<?php include 'connection.php';  

$guestName = $_POST['Name']; 
$guestEmail = $_POST['Email']; 
$guestContact = $_POST['Contact']; 
$guestAddress = $_POST['Address'];
$guestCity = $_POST['City']; 
$guestState_Province = $_POST['State_Province'];
$guestPZ_Code = $_POST['PZ_Code'];    
$guestCreated_At = $_POST['Created_At']; 
$guestUpdated_At = $_POST['Updated_At'];  

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = "INSERT INTO `guest`(`Name`, `Email`, `Contact_Number`, `Address`, `City`, `State_Province`, `Postal_Zip_Code`, `Created_At`, `Updated_At`) VALUES 
('$guestName','$guestEmail','$guestContact','$guestAddress','$guestCity','$guestState_Province','$guestPZ_Code','$guestCreated_At','$guestUpdated_At')";  

// $join = "INSERT INTO `todeliver`(Name, Email,Contact, Address, City, ItemName, Price)
// select a.name,a.email,a.contact,a.Address,a.city,b.name,b.price from guest a
// left join cart b on a.name = b.guestName;";


if (mysqli_query($conn, $sql)) {  
  header('Location: index.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 