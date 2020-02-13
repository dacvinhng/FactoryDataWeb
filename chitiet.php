<?php 
require_once "config.php";

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

    $name=$_REQUEST['mauHang'];

    if(isset($_GET["language"])){
	    $language = $_GET["language"];
    }
    else {
        $language = "";
    } 

	$sql = "SELECT * FROM products WHERE name='$name'";
	$result = mysqli_query($link, $sql);
    $row = mysqli_fetch_assoc($result);
    
    if($language == "JP"){
        $goLink = "location: " . $row['link']. "?language=JP";
    }
    else {
	$goLink = "location: " . $row['link'];
    }
	header($goLink);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mẫu Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
       
    </style>
</head>
<body>
	
	       
		
        <script>
		
        </script>

</body>
</html>
