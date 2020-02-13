<?php 
require_once "config.php";
header("Content-type: text/html; charset=utf-8");

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
			/* print_r($row[0]);
			print_r($row[1]);
			print_r($row[2]);
			print_r($row[3]);
			print_r($row[4]); */
			
			$data[$index][0] = $row['ID'];
			$data[$index][1] = $row['content1'];
			$data[$index][2] = $row['content2'];
			$data[$index][3] = $row['image'];
			$data[$index][4] = $row['imagef'];
			
			$index++;
		}
	}
	
	
}	
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Mẫu Hàng</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif;  background: #cfedf9; min-width: 1024px; min-height: 768px;}
        .wrapper{ width: 350px; padding: 20px; }
	/* Container needed to position the button. Adjust the width as needed */
	.viewer1 {
	  position: absolute;
	  left: 2%;
		top: 2%;
	  width: 46%;
		height: 46%;
	  background: #dee5e5;
		border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce;
	}

	.viewer1 #showimage0 {
		position: absolute;
		top: 5%;
	  left: 5%;
	  width: 85%;
	  height: 85%;
	}

	/* Make the image responsive */
	.viewer1 #showimage0 #image0 {
		position: absolute;
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: auto;
	  height: auto;
	}

	.viewer1 #line0{
	  position: absolute;
		top: 5%;
	  left: 3%;
		font-weight: bold;
		font-family: Impact;
		font-size: 25px;
	}

	.viewer1 #btn0 {
	  position: absolute;
	  top: 90%;
	  left: 10%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: #333333;
	  color: #ffffff;
	  font-size: 20px;
		font-style: bold;
		padding: 16px 20px;
		border-style: solid;
	  cursor: pointer;
	}

	.viewer1 #btn1 {
	  position: absolute;
	  top: 96%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #f20ae2;
	  font-size: 20px;
		font-style: bold;
		padding: 12px 64px;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn2 {
	  position: absolute;
	  top: 19%;
	  left: 78%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  background-color: rgba(255, 255, 255, 0);
	  color: #0be0a8;
	  font-size: 20px;
		font-style: bold;
	  padding: 12px 64px;
		border-style: none;
	  cursor: pointer;
	}

	.viewer1 #btn1:focus {
	  
	}
	
	.viewer2 {
	  position: absolute;
	  left: 52%;
		right: 2%;
		top: 2%;
	  width: 46%;
	  height: 46%;
	  background: #fafafa;
		border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce;
	}
	
	.viewer2 #childviewer1 {
	  position: absolute;
	  width: 50%;
	  height: 100%;
	} 

	.viewer2 #childviewer1 #image1{
	  position: absolute;
		top: 45%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 70%;
	  height: 60%;
		border-radius: 3%;
	}

	.viewer2 #childviewer1 #line1{
	  position: absolute;
		top: 5%;
	  left: 25%;
		
		font-weight: bold;
		font-family: Times;
		font-size: 20px;
	}

	.viewer2 #childviewer1 #line2{
	  position: absolute;
		bottom: 1%;
	  left: 13%;
		font-weight: bold;
		font-family: Times;
		font-size: 20px;
	}
	
	.viewer2 #childviewer2 {
	  position: absolute;
	  left: 50%;
	  width: 50%; 
	  height: 100%;
	}

	.viewer3 #childviewer3 #line3{
	  position: absolute;
		top: 5%;
	  left: 15%;
		font-weight: bold;
		font-family: Times;
		font-size: 20px;
	}

	.viewer3 #childviewer3 #line4{
	  position: absolute;
		bottom: 1%;
	  left: 13%;
		font-weight: bold;
		font-family: Times;
		font-size: 20px;
	}

	.viewer2 #childviewer2 #image2{
	  position: absolute;
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 80%; 
	  height: 90%;
	}

	.viewer3 {
	  position: absolute;
	  left: 2%;
		bottom: 2%;
	  width: 46%;
		height: 46%;
	  background: #f7f7f7;
		border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce;
	}
	
	.viewer3 #childviewer3 {
	  position: absolute;
	  width: 50%;
	  height: 100%;
	} 

	.viewer3 #childviewer3 #image3{
	  position: absolute;
		top: 45%;
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
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 80%; 
	  height: 90%;
		border-radius: 3%;
	}

	.viewer4 {
	  position: absolute;
	  left: 52%;
		bottom: 2%;
	  width: 46%;
	  height: 46%;
	  background: #fafafa;
		border-radius: 3%;
		border-style: solid;
		border-color: #c4c8ce;
	}
	
	.viewer4 #childviewer5 {
	  position: absolute;
	  width: 50%;
	  height: 100%;
	} 

	.viewer4 #childviewer5 #line5{
	  position: absolute;
		top: 5%;
	  left: 15%;
		font-weight: bold;
		font-family: Times;
		font-size: 20px;
	}

	.viewer4 #childviewer5 #line6{
	  position: absolute;
		bottom: 1%;
	  left: 13%;
		font-weight: bold;
		font-family: Times;
		font-size: 20px;
	}

	.viewer4 #childviewer5 #image5{
	  position: absolute;
		top: 45%;
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
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 80%; 
	  height: 90%;
		border-radius: 3%;
	}
	
	
	
	/* body { margin: 50; }
			canvas { width: 50%; height: 50% } */
    </style>
</head>
<body>
	
	       
		<div class="viewer1" name="viewer1">
			<div id="showimage0">
				<img id="image0" src="images/housing211563.png" alt="housing">
			</div>
			<p id="line0">HOUSING 211563-0010</p>
			<input type="button" id="btn0" value="Tỉ lệ thực" />
			<input type="image" id="btn1" src="images/1.png" onclick="location.href='?ID=1';" value="1" />
			<input type="image" id="btn2" src="images/2.png" onclick="location.href='?ID=2';" value="2" />
		</div>

		<div class="viewer2" name="viewer2" >
		
			<div id="childviewer1">
				<?php if(isset($data[0][1])){
					echo '<p id="line1">'. $data[0][1] .'</p>';
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
		
  <script>
	
		
		var myBtn0 = document.getElementById('btn0');
		var image2 = document.getElementById("image2");
		var image4 = document.getElementById("image4");
		var image6 = document.getElementById("image6");
		myBtn0.addEventListener('click', function(event) {
			if(image2 && image2.style) {
			document.getElementById("image2").style.width="70px";
			document.getElementById("image2").style.height="90px";
			}
			if(image4 && image4.style) {
			document.getElementById("image4").style.width="80px";
			document.getElementById("image4").style.height="100px";
			}
			if(image6 && image6.style) {
			document.getElementById("image6").style.width="100px";
			document.getElementById("image6").style.height="125px";
			}
			
		});

		<?php	
		if($_REQUEST['ID']==1){
			echo 'document.getElementById("btn1").src= "images/1click.png"';
		}
		if($_REQUEST['ID']==2){
			echo 'document.getElementById("btn2").src= "images/2click.png"';
		}
		?>

		/* document.getElementById("btn1").addEventListener("click", function1);
		function function1() { */
			
			/* document.getElementById("content1").innerHTML = "";
			document.getElementById("content2").innerHTML = "dsfsdfsdfsdsd"; */
			/* } */

		
         





		 /* var scene = new THREE.Scene();
          var camera = new THREE.PerspectiveCamera(75,window.innerWidth/window.innerHeight);
          var renderer = new THREE.WebGLRenderer({antialias: true});
          renderer.setSize(window.innerWidth,window.innerHeight);
          $('body').append(renderer.domElement);
          var geometry = new THREE.BoxGeometry(1,1,1);
          var material = new THREE.MeshBasicMaterial({color: 0xff0000});
          var cube = new THREE.Mesh(geometry,material);
          scene.add(cube);
          cube.position.z = -5;
          cube.rotation.x = 10;
          cube.rotation.y = 5;
          renderer.render(scene,camera);
          var animate = function(){
            cube.rotation.x += 0.01;
            renderer.render(scene,camera);
            requestAnimationFrame(animate);
          }
          animate(); */
  </script>

</body>
</html>
