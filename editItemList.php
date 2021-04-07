<?php include 'connection.php';

$itemName = $_POST['itemName'];
$itemDescription = $_POST['itemDescription'];
$itemPrice = $_POST['itemPrice'];
$itemStatus = $_POST['itemStatus'];
$itemUpdateDate = $_POST['itemUpdateDate'];

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = " UPDATE `product` SET 
`Short_description` = '$itemDescription',
`Price` = '$itemPrice',
`Status`='$itemStatus',
`Updated_At`= '$itemUpdateDate' WHERE 
`Name` = '$itemName' ";

if (mysqli_query($conn, $sql)) {
    header('Location: AdminDashboard.php');
} else {
    echo "Error: ".$sql. "<br>".mysqli_error($conn);
}
mysqli_close($conn);
?>