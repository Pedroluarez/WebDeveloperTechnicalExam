<?php include 'connection.php';  

$join = "INSERT INTO `todeliver` SELECT `guest`.`Name`, `guest`.`Email`, `guest`.`Contact_Number`, `guest`.`Address`, `guest`.`City`, `cart`.`Name`, `cart`.`Price`
FROM `guest`
INNER JOIN `cart` ON  `cart`.`guestName` = `guest`.`Name` ";
 

if (mysqli_query($conn,$sql)) {  
  header('Location: index.php'); 
} else {
  echo "Error: " . $sql . "<br>" . mysqli_error($conn); 
} 
mysqli_close($conn);
?> 