<?php
require_once "config.php";

$selectedYear = isset($_GET['year']) ? $_GET['year'] : NULL;
$selectedTitle = isset($_GET['title']) ? $_GET['title'] : NULL;


if (isset($selectedYear) && !isset($selectedTitle)){
    $sql = "SELECT * FROM manufacture WHERE year = $selectedYear";
}
else if (isset($selectedTitle)){
    $sql = "SELECT * FROM manufacture WHERE year = $selectedYear AND title = '$selectedTitle'";
}


$result = mysqli_query($link, $sql);
$data = array();
$dataFiltered = array();
if (isset($selectedYear) && !isset($selectedTitle)){
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



?>