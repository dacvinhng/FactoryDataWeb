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


if(empty($_SESSION["loggedin"])){
  header("location: index.php");
  exit;
}

if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
	$sql = "SELECT * FROM produce";


$result = mysqli_query($link, $sql);
//$row = mysqli_fetch_assoc($result);
$index = 0;
if ($result){
	while($row = mysqli_fetch_array($result)){
		
		$data[$index][0] = $row['year'];
		$data[$index][1] = $row['product'];
        $data[$index][2] = $row['title'];
        $data[$index][4] = $row['detail'];
		$index++;
	}
}
$yearArray = array();
foreach($data as $value){
		if(!in_array($value[0], $yearArray)){
			$yearArray[]=$value[0];
		}
}

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<style type="text/css">

.corner {
	  position: absolute;
	  right: 7%;
	  top: 0.5%;
	  width: 7%;
	  height: 7%;
	 
	}

    .corner .lang{
        position: absolute;
        top: 0%;
        left: 0%;
        width: auto;
        height: 18%;
        
    }

    .corner .lang #language{
        position: absolute;
        top: 0%;
        left: 0%;
        width: auto;
        height: auto;
        font-size: 0.5vw;
        
    }

    .corner .flag{
        position: absolute;
        top: 18%;
        left: 0%;
        width: auto;
        height: 82%;
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

#select1{
position: absolute;
top: 10%;
left: 30%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
}

#product{
position: absolute;
top: 10%;
left: 35%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
font-weight: bold;
font-family: Arial;
font-size: 1vw;
}

#select2{
position: absolute;
top: 10%;
left: 41%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
}

#titleofpd{
position: absolute;
top: 10%;
left: 46%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
font-weight: bold;
font-family: Arial;
font-size: 1vw;
}

#select3{
position: absolute;
top: 10%;
left: 54.5%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
width: auto;
height: auto;
}

#machine{
position: absolute;
top: 10%;
left: 35%;
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

#backBtn {
position: absolute;
right: 1%;
top: 1%;
max-width: 6%;
max-height: 6%;
}

.container {
position: absolute;
left: 25.5%;
top: 15%;
width: 50%;
height: 80%;
border-radius: 3%;
border-style:solid;
border-color: #000000;
}

.container #main{
position: absolute;
top: 50%;
left: 50%;
transform: translate(-50%, -50%);
-ms-transform: translate(-50%, -50%);
max-width: 100%;
max-height: 100%;
}

#copyright {
position: absolute;
bottom: 0%;
right: 1%;
font-style: bold;
font-family: Arial;
}

@media screen and (max-height: 900px){
    #year{
    position: absolute;
    top: 10%;
    left: 26.5%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    font-weight: bold;
    font-family: Arial;
    font-size: 1vw;
    }

    #select1{
    position: absolute;
    top: 10%;
    left: 30%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    }

    #product{
    position: absolute;
    top: 10%;
    left: 35%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    font-weight: bold;
    font-family: Arial;
    font-size: 1vw;
    }

    #select2{
    position: absolute;
    top: 10%;
    left: 41%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    }

    #titleofpd{
    position: absolute;
    top: 10%;
    left: 47%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    font-weight: bold;
    font-family: Arial;
    font-size: 1vw;
    }

    #select3{
    position: absolute;
    top: 10%;
    left: 57.5%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    }

}

@media screen and (max-height: 768px){
    #year{
    position: absolute;
    top: 10%;
    left: 26.5%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    font-weight: bold;
    font-family: Arial;
    font-size: 0.8vw;
    }

    #select1{
    position: absolute;
    top: 10%;
    left: 30.5%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    }

    #product{
    position: absolute;
    top: 10%;
    left: 36%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    font-weight: bold;
    font-family: Arial;
    font-size: 0.8vw;
    }

    #select2{
    position: absolute;
    top: 10%;
    left: 43.5%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    }

    #titleofpd{
    position: absolute;
    top: 13%;
    left: 27%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    font-weight: bold;
    font-family: Arial;
    font-size: 0.8vw;
    }

    #select3{
    position: absolute;
    top: 13%;
    left: 40.5%;
    transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    }

    #back{
    position: absolute;
    top: 10%;
    right: 25%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    padding: 0.5vw 1vw;
    }

    #next{
    position: absolute;
    top: 10%;
    right: 21%;
    transform: translate(-50%, -50%);
    -ms-transform: translate(-50%, -50%);
    width: auto;
    height: auto;
    padding: 0.5vw 1vw;
    }
}
</style>
</head>     

<body>
<?php
	if ($language == "JP"){
	 echo '<p id="title">設備故障</p>';
	}
	else {
		echo '<p id="title">ĐỀ ÁN CẢI THIỆN</p>';
	}
?>
<img id="backBtn" src="images/backBtn.png" alt="">
<div class="corner">
    <div class="lang">
        <p id="language">Languages</p>
    </div>
    <div class="flag">
        <!-- <div class="fjp"> -->
            <img id="jpflag" src="images/jpflag.png" onclick="changeJP()" alt="">
        <!-- </div> -->
        <!-- <div class="fvn"> -->
            <img id="vnflag" src="images/vnflag.png" onclick="changeVN()" alt="">
        <!-- </div> -->
    </div>
</div>
<?php
	if ($language == "JP"){
	 echo '<p id="year">年</p>';
	}
	else {
		echo '<p id="year">NĂM</p>';
	}
?>
<select id="select1" onClick="yearChange(this)">
    <?php
	for ($i = 0; $i <= count($yearArray); $i++){
        echo '<option value="'. $yearArray[$i] .'">'. $yearArray[$i] .'</option>';
	}
	?>
</select>
<?php
	if ($language == "JP"){
	 echo '<p id="product">号機</p>';
	}
	else {
		echo '<p id="product">SẢN PHẨM</p>';
	}
?>

<select id="select2" onClick="productChange(this)">
    
</select>

<?php
	if ($language == "JP"){
	 echo '<p id="titleofpd">号機</p>';
	}
	else {
		echo '<p id="titleofpd">TIÊU ĐỀ</p>';
	}
?>

<select id="select3" onClick="titleChange(this)" align="left">
    <option value=""></option>
</select>

<input type="image" id="next" src="images/forwardBtn.png" onclick="forward()"/>
<input type="image" id="back" src="images/previousBtn.png" onclick="previous()"/>
<div class="container" name="container">
    <img id="main" src="images/trans.png" alt="">
</div>
<p id="copyright" style="font-size:0.8vw;">Copyright © QI-Tech MVP 2019</p>
<script>
	
	var imageE = document.getElementById("main");
    var imageSource;
    var change = 0;

	var mybackBtn = document.getElementById('backBtn');
	mybackBtn.addEventListener('click', function(event) {
	<?php
	if ($language == "JP"){	
		
			echo 'window.location.href = "indexjp.php";'; 
		
	}
	else {
		
			echo 'window.location.href = "index.php";'; 
		
	}
	?>
	});

	function yearChange(sel) {		
  	var textYear = sel.options[sel.selectedIndex].text;
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
							dataSource = JSON.parse(this.responseText);
                            var select = document.getElementById('select2');
                            while (select.firstChild) {
                                select.removeChild(select.firstChild);
                            }
                            var opt = null;
                            
                            // for (index = 0; index < c.length; index++) {
                            //     if(b.indexOf(c[index]) === -1 ){
                            //         b.push(c[index]);
                            //     }
                            // }
                            // alert(b);
                            for(i = 0; i<dataSource.length; i++) {
                                opt = document.createElement('option');
                                opt.value = dataSource[i];
                                opt.innerHTML = dataSource[i];
                                select.appendChild(opt);
                            }										
            }
        };
        xmlhttp.open("GET", "faprocess.php?year=" + textYear, true);
        xmlhttp.send();
    }
    
    function productChange(sel) {
        var select1 = document.getElementById('select1');
        var dataSource;
        var textYear = select1.options[select1.selectedIndex].text;
        var textProduct = sel.options[sel.selectedIndex].text;
      
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
							dataSource = JSON.parse(this.responseText);
                            var select = document.getElementById('select3');
                            while (select.firstChild) {
                                select.removeChild(select.firstChild);
                            }


                            var opt = null;

                            for(i = 0; i<dataSource.length; i++) {
                                opt = document.createElement('option');
                                opt.value = dataSource[i][0];
                                opt.innerHTML = dataSource[i][0];
                                select.appendChild(opt);
                            }
														
            }
        };
        xmlhttp.open("GET", "faprocess.php?year=" + textYear + "&product=" + textProduct, true);
        xmlhttp.send();
    }
    
    function titleChange(sel) {
        var select1 = document.getElementById('select1');
        var select2 = document.getElementById('select2');
        var textYear = select1.options[select1.selectedIndex].text;
        var textProduct = select2.options[select2.selectedIndex].text;
        var textTitle = sel.options[sel.selectedIndex].text;
        
		var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                            dataSource = JSON.parse(this.responseText);
                            imageE.src = dataSource[0];											
            }
        };
        xmlhttp.open("GET", "faprocess.php?year=" + textYear + "&product=" + textProduct + "&title=" + textTitle, true);
        xmlhttp.send();
	}

	function forward(){
		if (dataSource.length > 1 && change < dataSource.length-1){
				change++;
				if (dataSource[change]){
				imageE.src = dataSource[change];
				}
		}
	}

	function previous(){
		if (dataSource.length > 1 && change >0){
			change--;
			if (dataSource[change]){
			imageE.src = dataSource[change];
			}
		}
	}

function changeVN(){
	window.location.href = "fatech.php";
}

function changeJP(){
	
	window.location.href = "fatech.php?language=JP";
}

</script>
</body>
</html>