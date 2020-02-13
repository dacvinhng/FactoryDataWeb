<?php 
session_start();
require_once "config.php";
header("Content-type: text/html; charset=utf-8");

if(empty($_SESSION["loggedin"])){
  header("location: index.php");
  exit;
}

if(isset($_GET["language"])){
	$language = $_GET["language"];
}
else {
	$language = "";
}

// Check connection
if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 
if(isset($_REQUEST['ID'])){
    $position=$_REQUEST['ID'];
	$sql = "SELECT * FROM housing2115630010 WHERE position = '$position'";
	$result = mysqli_query($link, $sql);
	//$row = mysqli_fetch_assoc($result);
	$index = 0;
	if ($result){
		while($row = mysqli_fetch_array($result)){
			
			$data[$index][0] = $row['ID'];
			$data[$index][1] = $row['content1'];
			$data[$index][2] = $row['content2'];
			$data[$index][3] = $row['image'];
			$data[$index][4] = $row['imagef'];
			$data[$index][5] = $row['standard'];
			
			$index++;
		}
	}
	
	
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mẫu Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ background: #cfedf9; min-width: 1024px; min-height: 768px;}
        .wrapper{ width: 350px; padding: 20px; }
	
		.corner {
	  position: absolute;
	  right: 5%;
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

	#title {
	  position: absolute;
	  left: 3%;
		top: 1%;
	  /* width: 46%;
		height: 46%; */
	  font-style: bold;
		font-size: 2vw;
		font-family: Arial;
	}

	#copyright {
	  position: absolute;
	  bottom: 0.3%;
		right: 1%;
	  /* width: 46%;
		height: 46%; */
	  font-style: bold;
		font-size: 0.8vw;
		font-family: Arial;
	}

	#backBtn {
	  position: absolute;
	  right: 1%;
		top: 1.5%;
	  max-width: 6%;
		max-height: 6%;
	}

	#homeBtn {
	position: absolute;
	left: 0%;
	top: 0%;
	max-width: 4%;
	max-height: 4%;
	}
	
	/* Container needed to position the button. Adjust the width as needed */
	.viewer1 {
	  position: absolute;
	  left: 3%;
		top: 6%;
	  width: 46%;
		height: 43%;
	  background: #dee5e5;
		/* border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce; */
	}

	.viewer1 #showimage0 {
		position: absolute;
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 85%;
	  height: 80%;
	}

	/* Make the image responsive */
	.viewer1 #showimage0 #image0 {
		position: absolute;
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  max-width: 100%;
	  max-height: 100%;
	}

	.viewer1 #line0{
	  position: absolute;
		top: 5%;
	  left: 3%;
		font-weight: bold;
		font-family: Arial;
		font-size: 1.2vw;
	}

	.viewer1 #btn0 {
	  position: absolute;
	  top: 85%;
	  left: 12%;
		transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  max-width: 15%;
	  max-height: 13%;
	}

	.viewer1 #btn1 {
	  position: absolute;
	  top: 88%;
	  left: 50.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #f20ae2;
	  font-size: 20px;
		font-style: bold;
		padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn2 {
	  position: absolute;
	  top: 26%;
	  left: 72.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn3 {
	  position: absolute;
	  top: 34%;
	  left: 28%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn4 {
	  position: absolute;
	  top: 88%;
	  left: 39%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn5 {
	  position: absolute;
	  top: 12%;
	  left: 50.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn6 {
	  position: absolute;
	  top: 49.5%;
	  left: 53.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	/* .viewer1 #btn6-2 {
	  position: absolute;
	  top: 37%;
	  left: 40%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	} */

	.viewer1 #btn7 {
	  position: absolute;
	  top: 88%;
	  left: 62%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn8 {
	  position: absolute;
	  top: 49.5%;
	  left: 43.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn9 {
	  position: absolute;
	  top: 49.5%;
	  left: 33.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn1:focus {
	  
	}
	
	.viewer2 {
	  position: absolute;
	  /* left: 52%; */
		right: 3%;
		top: 6%;
	  width: 46%;
	  height: 43%;
	  background: #fafafa;
		/* border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce; */
	}
	
	.viewer2 #childviewer1 {
	  position: absolute;
	  width: 50%;
	  height: 100%;
	} 

	.viewer2 #childviewer1 #image1{
	  position: absolute;
		top: 52.5%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 70%;
	  height: 60%;
		border-radius: 3%;
	}

	.viewer2 #childviewer1 #line1{
	  position: absolute;
		top: 3%;
	  left: 15%;
		
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}

	.viewer2 #childviewer1 #line2{
	  position: absolute;
		bottom: 1%;
	  left: 22%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}

	.viewer2 #childviewer1 #linest1{
	  position: absolute;
		top: 13%;
	  left: 22%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}
	
	.viewer2 #childviewer2 {
	  position: absolute;
	  left: 50%;
	  width: 50%; 
	  height: 100%;
	}

	.viewer3 #childviewer3 #line3{
	  position: absolute;
		top: 3%;
	  left: 15%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}

	.viewer3 #childviewer3 #line4{
	  position: absolute;
		bottom: 1%;
	  left: 22%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}

	.viewer2 #childviewer2 #image2{
	  position: absolute;
		top: 52%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 55%; 
	  height: 65%;
	}

	.viewer3 {
	  position: absolute;
	  left: 3%;
		bottom: 4%;
	  width: 46%;
		height: 43%;
	  background: #f7f7f7;
		/* border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce; */
	}
	
	.viewer3 #childviewer3 {
	  position: absolute;
	  width: 50%;
	  height: 100%;
	}

	.viewer3 #childviewer3 #linest2{
	  position: absolute;
		top: 13%;
	  left: 22%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	} 

	.viewer3 #childviewer3 #image3{
	  position: absolute;
		top: 52.5%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 70%;
	  height: 60%;
		border-radius: 3%;
	}
	
	.viewer3 #childviewer4 {
	  position: absolute;
	  left: 50%;
	  width: 50%; 
	  height: 100%;
	}

	.viewer3 #childviewer4 #image4{
	  position: absolute;
		top: 52%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 55%; 
	  height: 65%;
		border-radius: 3%;
	}

	.viewer4 {
	  position: absolute;
	  right: 3%;
		bottom: 4%;
	  width: 46%;
	  height: 43%;
	  background: #fafafa;
		/* border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce; */
	}
	
	.viewer4 #childviewer5 {
	  position: absolute;
	  width: 50%;
	  height: 100%;
	}

	.viewer4 #childviewer5 #linest3{
	  position: absolute;
		top: 13%;
	  left: 22%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	} 

	.viewer4 #childviewer5 #line5{
	  position: absolute;
		top: 3%;
	  left: 15%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}

	.viewer4 #childviewer5 #line6{
	  position: absolute;
		bottom: 1%;
	  left: 22%;
		font-weight: bold;
		font-family: Times;
		font-size: 1vw;
	}

	.viewer4 #childviewer5 #image5{
	  position: absolute;
		top: 52.5%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 70%;
	  height: 60%;
		border-radius: 3%;
	}
	
	.viewer4 #childviewer6 {
	  position: absolute;
	  left: 50%;
	  width: 50%; 
	  height: 100%;
	}

	.viewer4 #childviewer6 #image6{
	  position: absolute;
		top: 52%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 55%; 
	  height: 65%;
		border-radius: 3%;
	}
	
	@media screen and (max-height: 900px){
  	#jpflag{
		position: absolute;
		top: 3%;
		right: 10%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		width: auto;
		height: auto;
		}

		.viewer1 #btn2 {
	  position: absolute;
	  top: 26%;
	  left: 76%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
		}

	.viewer1 #btn3 {
	  position: absolute;
	  top: 34%;
	  left: 25%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
		}
	}
	
	@media screen and (max-height: 768px){
  	#jpflag{
		position: absolute;
		top: 3%;
		right: 12%;
		transform: translate(-50%, -50%);
		-ms-transform: translate(-50%, -50%);
		width: auto;
		height: auto;
		}

		.viewer1 #btn2 {
	  position: absolute;
	  top: 26%;
	  left: 82.5%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
		}

	.viewer1 #btn3 {
	  position: absolute;
	  top: 34%;
	  left: 18%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 1vw 2vw;
		border-style: none;
	  cursor: pointer;
		}
	}
	
	/* body { margin: 50; }
			canvas { width: 50%; height: 50% } */
    </style>
</head>
<body>
		<?php
		if ($language == "JP"){ 
		echo '<p id="title" >外観限度見本</p>';
		}
		else{
		echo '<p id="title" >BẢNG MẪU GIỚI HẠN NGOẠI QUAN</p>';
		}
		?>
		<div class="corner">
            <div class="lang">
                <p id="language">Languages</p>
            </div>
            <div class="flag">
                    <img id="jpflag" src="images/jpflag2.png" onclick="changeJP()" alt="">
                    <img id="vnflag" src="images/vnflag.png" onclick="changeVN()" alt="">
            </div>
    </div>
		<img id="backBtn" src="images/backBtn.png" alt="">
		<img id="homeBtn" src="images/homeBtn.png" alt="">
		<div class="viewer1" name="viewer1">
			<div id="showimage0">
				<img id="image0" src="images/housing211563.png" alt="housing">
			</div>
			<p id="line0" >HOUSING 211563-0010</p>
			<?php
			if ($language == "JP"){ 
				echo '<input type="image" id="btn0" src="images/realBtnjp.png" onclick="changeImage()" />';
				echo '<input type="image" id="btn1" src="images/1.png" onclick="location.href=\'?ID=1&language=JP\';" value="1" />';
				echo '<input type="image" id="btn2" src="images/2.png" onclick="location.href=\'?ID=2&language=JP\';" value="2" />';
				echo '<input type="image" id="btn3" src="images/3.png" onclick="location.href=\'?ID=3&language=JP\';" value="3" />';
				echo '<input type="image" id="btn4" src="images/4.png" onclick="location.href=\'?ID=4&language=JP\';" value="4" />';
				echo '<input type="image" id="btn5" src="images/5.png" onclick="location.href=\'?ID=5&language=JP\';" value="5" />';
				echo '<input type="image" id="btn6" src="images/6.png" onclick="location.href=\'?ID=6&language=JP\';" value="6" />';
				
				echo '<input type="image" id="btn7" src="images/7.png" onclick="location.href=\'?ID=7&language=JP\';" value="7" />';
				echo '<input type="image" id="btn8" src="images/8.png" onclick="location.href=\'?ID=8&language=JP\';" value="8" />';
				echo '<input type="image" id="btn9" src="images/9.png" onclick="location.href=\'?ID=9&language=JP\';" value="9" />';
			}
			else {
				echo '<input type="image" id="btn0" src="images/realBtn.png" onclick="changeImage()" />';
				echo '<input type="image" id="btn1" src="images/1.png" onclick="location.href=\'?ID=1\';" value="1" />';
				echo	'<input type="image" id="btn2" src="images/2.png" onclick="location.href=\'?ID=2\';" value="2" />';
				echo '<input type="image" id="btn3" src="images/3.png" onclick="location.href=\'?ID=3\';" value="3" />';
				echo '<input type="image" id="btn4" src="images/4.png" onclick="location.href=\'?ID=4\';" value="4" />';
				echo '<input type="image" id="btn5" src="images/5.png" onclick="location.href=\'?ID=5\';" value="5" />';
				echo '<input type="image" id="btn6" src="images/6.png" onclick="location.href=\'?ID=6\';" value="6" />';
				
				echo '<input type="image" id="btn7" src="images/7.png" onclick="location.href=\'?ID=7\';" value="7" />';
				echo '<input type="image" id="btn8" src="images/8.png" onclick="location.href=\'?ID=8\';" value="8" />';
				echo '<input type="image" id="btn9" src="images/9.png" onclick="location.href=\'?ID=9\';" value="9" />';
			}
			?>
		</div>

		<div class="viewer2" name="viewer2" >
		
			<div id="childviewer1">
				<?php if(isset($data[0][1])){
					echo '<p id="line1">'. $data[0][1] .'</p>';
				}
				if(isset($data[0][5])){
					echo '<p id="linest1">'. $data[0][5] .'</p>';
				}
			 if(isset($data[0][3])){	
			echo	'<div id="showimage1">'.
					'<img id="image1" src="'.$data[0][3]. '" >'.
				'</div>';
			}
				 if(isset($data[0][2])){
					echo '<p id="line2">'. $data[0][2] .'</p>';	  
				}?>
			</div>
			
			<div id="childviewer2">
				<?php if(isset($data[0][4])){	
					echo '<img id="image2" src="'. $data[0][4]. '">';
				}?>
			</div>
			
		</div>
		<div class="viewer3" name="viewer3" >
		
			<div id="childviewer3">
			
				<?php if(isset($data[1][1])){
						echo '<p id="line3">'. $data[1][1] .'</p>';
					}
					if(isset($data[0][5])){
						echo '<p id="linest2">'. $data[1][5] .'</p>';
					}
				if(isset($data[1][3])){	
				echo	'<div id="showimage2">'.
						'<img id="image3" src="'.$data[1][3]. '" >'.
					'</div>';
				}
				if(isset($data[1][2])){
						echo '<p id="line4">'. $data[1][2] .'</p>';	  
				}?>
			</div>
			
			<div id="childviewer4">
				<?php if(isset($data[1][4])){	
					echo '<img id="image4" src="'. $data[1][4]. '">';
				}?>
			</div>
			
		</div>

		<div class="viewer4" name="viewer4" >
		
			<div id="childviewer5">
			
				<?php if(isset($data[2][1])){
						echo '<p id="line5">'. $data[2][1] .'</p>';
					}
					if(isset($data[2][5])){
						echo '<p id="linest3">'. $data[2][5] .'</p>';
					}
				if(isset($data[2][3])){	
				echo	'<div id="showimage3">'.
						'<img id="image5" src="'.$data[2][3]. '" >'.
					'</div>';
				}
				if(isset($data[2][2])){
						echo '<p id="line6">'. $data[2][2] .'</p>';	  
				}?>
			</div>
			
			<div id="childviewer6">
				<?php if(isset($data[2][4])){	
					echo '<img id="image6" src="'. $data[2][4]. '">';
				}?>
			</div>
			
		</div>
		<p id="copyright">Copyright © QI-Tech MVP 2019</p>
		
  <script>
	
		var mybackBtn = document.getElementById('backBtn');
		mybackBtn.addEventListener('click', function(event) {
			<?php
			if ($language == "JP"){ 
			echo 'window.location.href = "chonmau.php?language=JP&mauHang=HOUSING-211563-0010";';
			}
			else{
			echo 'window.location.href = "chonmau.php?mauHang=HOUSING-211563-0010";';
			}
			?>
		});

		var myhomeBtn = document.getElementById('homeBtn');
	    myhomeBtn.addEventListener('click', function(event) {
			<?php
			if ($language == "JP"){ 
			echo 'window.location.href = "indexjp.php";';
			}
			else{
			echo 'window.location.href = "index.php";';
			}
			?>
	    });
		
		var myBtn0 = document.getElementById('btn0');
		var image2 = document.getElementById("image2");
		var image4 = document.getElementById("image4");
		var image6 = document.getElementById("image6");
		var number = 1;
		function changeImage() {
			
			if (number == 1){
				if(image2 && image2.style) {
				document.getElementById("image2").style.width="100px";
				document.getElementById("image2").style.height="125px";
				}
				if(image4 && image4.style) {
				document.getElementById("image4").style.width="100px";
				document.getElementById("image4").style.height="125px";
				}
				if(image6 && image6.style) {
				document.getElementById("image6").style.width="100px";
				document.getElementById("image6").style.height="125px";
				}
				<?php
				if ($language == "JP"){
					echo 'myBtn0.src="images/fitBtnjp.png";';
				}
				else{
					echo 'myBtn0.src="images/fitBtn.png";';
				}
				?>
				number = 2;
			}
			else if (number == 2){
				if(image2 && image2.style) {
				document.getElementById("image2").style.width="55%";
				document.getElementById("image2").style.height="65%";
				}
				if(image4 && image4.style) {
				document.getElementById("image4").style.width="55%";
				document.getElementById("image4").style.height="65%";
				}
				if(image6 && image6.style) {
				document.getElementById("image6").style.width="55%";
				document.getElementById("image6").style.height="65%";
				}
				<?php
				if ($language == "JP"){
					echo 'myBtn0.src="images/realBtnjp.png";';
				}
				else{
					echo 'myBtn0.src="images/realBtn.png";';
				}
				?>
				number = 1;
			}
		}

	
		
		<?php	
		if(isset($_REQUEST['ID'])){
			if($_REQUEST['ID']==1){
				echo 'document.getElementById("btn1").src= "images/1click.png"';
			}
			if($_REQUEST['ID']==2){
				echo 'document.getElementById("btn2").src= "images/2click.png"';
			}
			if($_REQUEST['ID']==3){
				echo 'document.getElementById("btn3").src= "images/3click.png"';
			}
			if($_REQUEST['ID']==4){
				echo 'document.getElementById("btn4").src= "images/4click.png"';
			}
			if($_REQUEST['ID']==5){
				echo 'document.getElementById("btn5").src= "images/5click.png"';
			}
			if($_REQUEST['ID']==6){
				echo 'document.getElementById("btn6").src= "images/6click.png"';
				// echo 'document.getElementById("btn6-2").src= "images/6click.png"';
			}
			if($_REQUEST['ID']==7){
				echo 'document.getElementById("btn7").src= "images/7click.png"';
			}
			if($_REQUEST['ID']==8){
				echo 'document.getElementById("btn8").src= "images/8click.png"';
			}
			if($_REQUEST['ID']==9){
				echo 'document.getElementById("btn9").src= "images/9click.png"';
			}
		}
		?>

		function changeVN(){
			window.location.href = "housing211563.php";
		}

		function changeJP(){
			
			window.location.href = "housing211563.php?language=JP";
		}
		
  </script>

</body>
</html>
