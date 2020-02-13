<?php
require_once "config.php";
if(isset($_GET["mauHang"])){
	$mauHang = $_GET["mauHang"];
}

$selectedYear = isset($_GET['year']) ? $_GET['year'] : NULL;
$selectedProduct = isset($_GET['product']) ? $_GET['product'] : NULL;
$selectedTitle = isset($_GET['title']) ? $_GET['title'] : NULL;

if (isset($selectedYear) && !isset($selectedProduct)){
    $sql = "SELECT * FROM produce WHERE year = $selectedYear";
}
else if (isset($selectedProduct) && !isset($selectedTitle)){
    $sql = "SELECT * FROM produce WHERE year = $selectedYear AND product = '$selectedProduct'";
}
else if (isset($selectedTitle)){
    $sql = "SELECT * FROM produce WHERE year = $selectedYear AND product = '$selectedProduct' AND title = '$selectedTitle'";
}

$result = mysqli_query($link, $sql);
$data = array();
$dataFiltered = array();
if (isset($selectedYear) && !isset($selectedProduct)){
    $index = 0;
    if ($result){
        while($row = mysqli_fetch_array($result)){
            
            $data[$index][0] = $row['product'];
            $index++;
        }
    }
    foreach($data as $value){
		if(!in_array($value, $dataFiltered)){
			$dataFiltered[]=$value;
		}
    }
}
else if (isset($selectedProduct) && !isset($selectedTitle)){
    $index = 0;
    if ($result){
        while($row = mysqli_fetch_array($result)){         
            $data[$index][0] = $row['title'];
            $index++;
        }
    }
    foreach($data as $value){
		if(!in_array($value, $dataFiltered)){
			$dataFiltered[]=$value;
		}
    }
}
else if (isset($selectedTitle)){
    $index = 0;
    if ($result){
        while($row = mysqli_fetch_array($result)){
            $data[$index][0] = $row['detail'];
            $index++;
        }
    }
    foreach($data as $value){
		if(!in_array($value, $dataFiltered)){
			$dataFiltered[]=$value;
		}
    }
}
echo json_encode($dataFiltered);

// for ($l = 0; $l <= count($q); $l++){
// 	$m = $q[$l];
// 	$imageSource[] = $data[$m][1];
// }

?>