<?php
session_start();
require_once "config.php";
if(isset($_REQUEST["dangxuat"])){
	$dangxuat=$_REQUEST['dangxuat'];
	if($dangxuat == true){
	session_start();
	 
	$_SESSION = array();

	session_destroy();
	 

	header("location: index.php");
	exit;
	}
}

if(isset($_GET["mauHang"])){
	$mauHang = $_GET["mauHang"];
}
else {
	$mauHang = "";
}

if(isset($_GET["language"])){
	$language = $_GET["language"];
}
else {
    $language = "";
}

if ($language == "JP"){
    header("location: pastjp.php");
    exit;
}

if(empty($_SESSION["loggedin"])){
  header("location: index.php");
  exit;
}

if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
if ($mauHang == "HOUSING-211563-0010"){
	$sql = "SELECT * FROM past WHERE product = 'housing2115630010'";
}
else if ($mauHang == "HUB-1850"){
	$sql = "SELECT * FROM past WHERE product = 'hub1850'";
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
$comboArray = array();
foreach($data as $value){
		if(!in_array($value[0], $comboArray)){
			$comboArray[]=$value[0];
		}
}
$claim = array();
$complaint = array();
foreach($data as $value){
		if($value[2] == "claim"){
			$claim[]=$value[2];
		}
		else if($value[2] == "complaint"){
			$complaint[]=$value[2];
		}
}


?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0 ">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">

#vnflag{
        position: absolute;
        top: 3%;
        right: 6%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        width: auto;
        height: auto;
}

#jpflag{
        position: absolute;
        top: 3%;
        right: 9%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        width: auto;
        height: auto;
}

#title{
position: absolute;
top: 3%;
left: 50%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
font-style: bold;
font-size: 2vw;
font-family: Arial;
}


#year{
position: absolute;
top: 10%;
left: 27%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
font-weight: bold;
font-family: Arial;
font-size: 1vw;
}

#select{
position: absolute;
top: 10%;
left: 30%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;

}

#number{
position: absolute;
top: 10%;
left: 36%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
font-weight: bold;
font-family: Arial;
font-size: 1vw;

}

#image1{
position: absolute;
top: 10%;
left: 33%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
}

#image2{
position: absolute;
top: 10%;
left: 41%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
}

#number2{
position: absolute;
top: 10%;
left: 45.5%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
font-weight: bold;
font-family: Arial;
font-size: 1vw;

}


#back{
position: absolute;
top: 10%;
right: 26%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
padding: 0.5vw 1vw;
}

#next{
position: absolute;
top: 10%;
right: 22%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
padding: 0.5vw 1vw;
}

#main{
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
max-width: 75%;
max-height: 75%;
}

#backBtn {
position: absolute;
right: 1%;
top: 1%;
max-width: 6%;
max-height: 6%;
}

#copyright {
position: absolute;
bottom: 0%;
right: 1%;
font-style: bold;
font-family: Arial;
}
</style>
</head>     

<body>
<p id="title">過去トラ</p>
<img id="vnflag" src="images/vnflag.png" onclick="changeVN()" alt="">
<img id="jpflag" src="images/jpflag.png" onclick="changeJP()" alt="">
<img id="backBtn" src="images/backBtn.png" alt="">
<p id="year">年</p>
<select id="select" onChange="myChange(this)">
	<?php
	for ($i = 0; $i <= count($comboArray); $i++){
  echo '<option value="'. $comboArray[$i] .'">'. $comboArray[$i] .'</option>';
	}
	?>
</select>
<img id="image1" src="images/red.png" alt="">
<img id="image2" src="images/yellow.png" alt="">
<p id="number">CLAIM </p>
<p id="number2">COMPLAINT </p>
<input type="image" id="next" src="images/forwardBtn.png" onclick="forward()"/>
<input type="image" id="back" src="images/previousBtn.png" onclick="previous()"/>
<img id="main" src="<?php echo $data[0][1]; ?>" alt="">
<p id="copyright" style="font-size:0.8vw;">Copyright © QI-Tech MVP 2019</p>
<script>
	
	var imageE = document.getElementById("main");
	var imageSource;
	var sel = document.getElementById("select");
	var textYear = sel.options[sel.selectedIndex].text;
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
							imageSource = JSON.parse(this.responseText);
							imageE.src= imageSource[0][1];
							// var claim;
							// var complaint;
							var k = 0;
							var h = 0;
										imageSource.sort();
										for ( var i = 0; i < imageSource.length; i++ ) {
												if ( imageSource[i][2] == "claim" ) {
														h++;
												}
												else if ( imageSource[i][2] == "complaint" ) {
														k++;
												}
										}
										
							document.getElementById("number").innerHTML="CLAIM: " + h;
							document.getElementById("number2").innerHTML="COMPLAINT: " + k;
						}
        };
        xmlhttp.open("GET", "process.php?year=" + textYear + "&mauHang=" + "<?php echo $mauHang; ?>", true);
        xmlhttp.send();

	var change = 0;

	var mybackBtn = document.getElementById('backBtn');
	mybackBtn.addEventListener('click', function(event) {
	<?php	
		if ($mauHang == "HUB-1850"){
		echo 'window.location.href = "selectjp.php?mauHang=HUB-1850";'; 
	}
	else if ($mauHang == "HOUSING-211563-0010"){
		echo 'window.location.href = "selectjp.php?mauHang=HOUSING-211563-0010";'; 
	}
	else {
		echo 'window.location.href = "selectjp.php";'; 
	}
	?>

	});

	function myChange(sel) {		
  	var textYear = sel.options[sel.selectedIndex].text;
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
							imageSource = JSON.parse(this.responseText);
							imageE.src= imageSource[0][1];
							var k = 0;
							var h = 0;
										imageSource.sort();
										for ( var i = 0; i < imageSource.length; i++ ) {
												if ( imageSource[i][2] == "claim" ) {
														h++;
												}
												else if ( imageSource[i][2] == "complaint" ) {
														k++;
												}
										}
										
							document.getElementById("number").innerHTML=": CLAIM " + h;
							document.getElementById("number2").innerHTML=": COMPLAINT " + k;
            }
        };
        xmlhttp.open("GET", "process.php?year=" + textYear + "&mauHang=" + "<?php echo $mauHang; ?>", true);
        xmlhttp.send();
	}

	function forward(){
		if (imageSource.length > 1 && change < imageSource.length-1){
				change++;
				if (imageSource[change][1]){
				imageE.src = imageSource[change][1];
				}
		}
	}

	function previous(){
		if (imageSource.length > 1 && change >0){
			change--;
			if (imageSource[change][1]){
			imageE.src = imageSource[change][1];
			}
		}
	}

function changeVN(){
    window.location.href = "past.php?mauHang=<?php echo $mauHang;?>";
}

function changeJP(){

    // window.location.href = "past.php?mauHang=<?php echo $mauHang;?>";
}

</script>
</body>
</html>