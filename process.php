<?php
require_once "config.php";
if(isset($_GET["mauHang"])){
	$mauHang = $_GET["mauHang"];
}
if ($mauHang == "HOUSING-211563-0010"){
	$sql = "SELECT * FROM past WHERE product = 'housing2115630010'";
}
else if ($mauHang == "HUB-04742-1850"){
	$sql = "SELECT * FROM past WHERE product = 'hub1850'";
}
else if ($mauHang == "CORE-079612-0610"){
	$sql = "SELECT * FROM past WHERE product = 'core0610'";
}
$result = mysqli_query($link, $sql);
//$row = mysqli_fetch_assoc($result);
$index = 0;
if ($result){
	while($row = mysqli_fetch_array($result)){
		
		$data[$index][0] = $row['year'];
		$data[$index][1] = $row['detail'];
		$data[$index][2] = $row['type'];
		$index++;
	}
}

$selectedYear = isset($_GET['year']) ? $_GET['year'] : '';


for ($k = 0; $k < count($data); $k++){
			if($data[$k][0] == $selectedYear){
				$imageSource[] =$data[$k];
			}		
}

echo json_encode($imageSource);

// for ($l = 0; $l <= count($q); $l++){
// 	$m = $q[$l];
// 	$imageSource[] = $data[$m][1];
// }

?>