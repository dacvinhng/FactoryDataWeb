<?php
require_once "config.php";

$selectedYear = isset($_GET['year']) ? $_GET['year'] : NULL;
$selectedMachine = isset($_GET['machine']) ? $_GET['machine'] : NULL;


if (isset($selectedYear) && !isset($selectedMachine)){
    $sql = "SELECT * FROM factech WHERE year = $selectedYear";
}
else if (isset($selectedMachine)){
    $sql = "SELECT * FROM factech WHERE year = $selectedYear AND machine = '$selectedMachine'";
}


$result = mysqli_query($link, $sql);
$data = array();
$dataFiltered = array();
if (isset($selectedYear) && !isset($selectedMachine)){
    $index = 0;
    if ($result){
        while($row = mysqli_fetch_array($result)){
            
            $data[$index][0] = $row['machine'];
            $index++;
        }
    }
    foreach($data as $value){
		if(!in_array($value, $dataFiltered)){
			$dataFiltered[]=$value;
		}
    }
}
else if (isset($selectedMachine)){
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