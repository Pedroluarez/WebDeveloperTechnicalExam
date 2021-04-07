<?php include 'connection.php'; 

$itemName = $_POST['itemName'];
$itemStatus = $_POST['itemStatus'];
$itemDeleteDate = $_POST['itemDeleteDate']; 

// echo $employeeID,$employeeTime,$employeeStatus;
// Querry to add the data to our database
$sql = " UPDATE `product` SET 
`Status`='$itemStatus',
`Deleted_At`= '$itemDeleteDate' WHERE
`Name`= '$itemName'";

if (mysqli_query($conn, $sql)) {
    header('Location: AdminDashboard.php');
} else {
    echo "Error: ".$sql. "<br>".mysqli_error($conn);
}
mysqli_close($conn);
?>