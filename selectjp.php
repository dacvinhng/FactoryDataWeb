<?php
session_start();
require_once "config.php";
if(isset($_REQUEST["dangxuat"])){
	$dangxuat=$_REQUEST['dangxuat'];
	if($dangxuat == true){
	// Initialize the session
	session_start();
	 
	// Unset all of the session variables
	$_SESSION = array();
	 
	// Destroy the session.
	session_destroy();
	 

	header("location: indexjp.php");
	exit;
	}
}

if(empty($_SESSION["loggedin"])){
  header("location: indexjp.php");
  exit;
}

if(isset($_GET["mauHang"])){
	$mauHang = $_GET["mauHang"];
}
else{
  $mauHang = NULL;
}

if(isset($_GET["language"])){
	$language = $_GET["language"];
}
else {
    $language = "";
}

if ($language == "VN"){
  if(isset($mauHang)){
    header("location: chonmau.php?mauHang=$mauHang");
    exit;
  }
  else {
    header("location: chonmau.php");
    exit;
  }
}

if ($link->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

	$sql = "SELECT name FROM products";
	$result = mysqli_query($link, $sql);
	$index = 0;
	if ($result){
		while($row = mysqli_fetch_array($result)){
			$data[$index] = $row[0];	
			$index++;
		}
  }

?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0 ">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
<!-- <link rel="stylesheet" type="text/css" href="js/jquery.ml-keyboard.css">
<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
<script type="text/javascript" src="js/jquery.ml-keyboard.js"></script> -->
<style type="text/css">

#vnflag{
        position: absolute;
        top: 3%;
        right: 4%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        width: auto;
        height: auto;
}

#jpflag{
        position: absolute;
        top: 3%;
        right: 7%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        width: auto;
        height: auto;
}

.container1 {
  position: absolute;
	  left: 1%;
		top: 2%;
	  width: 20%;
		height: 98%;
}

.container1 .childcontainer1 {
  position: absolute;
	  left: 0%;
		top: 0%;  
	  width: 100%;
		height: 15%;
    font-style: bold;
		font-size: 1vw;
		font-family: Arial;
}

.container1 .childcontainer2 {
  position: absolute;
	  left: 0%;
		top: 15%;  
	  width: 100%;
		height: 85%;
    font-style: bold;
		font-size: 1.5vw;
		font-family: Arial;
}

.container1 .childcontainer2 ul {
  position: absolute;
	  margin-left:1%;
    padding-left:0%;
    margin-top:0%;	  
	  width: 100%;
}

#logout {
  position: absolute;
	  right: 1%;
		top: 1%;  
	  width: auto;
		height: auto;
    font-style: bold;
		font-size: 15px;
		font-family: Arial;
}

.container2 {
  position: absolute;
	  left: 21%;
		top: 15%;
	  width: 26%;
		height: 85%;
}

.container2 .childcontainer1 {
  position: absolute;
	  left: 0%;
		top: 5%;  
	  width: 100%;
		height: 90%;
    border-radius: 3%;
    border-style:solid;
    border-color: #000000;
}

.container2 .childcontainer1 #view3d{
  position: absolute;
  top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 98%;
		height: 98%;
    display: none;
}

.container3 {
  position: absolute;
	  left: 48%;
    right: 1%;
		top: 15%;
	  width: 51%;
		height: 85%;
}

.container3 #detailpd {
	  position: absolute;
	  top: 0%;
	  left: 0%;
	  background-color: rgba(255, 255, 255, 0);
	  color: #000000;
	  font-size: 1vw;
		font-weight: bold;
		font-family: Arial;
		border-style: none;
	  
	}

  .container3 #processpd {
	  position: absolute;
	  top: 0%;
	  left: 30%;
	  background-color: rgba(255, 255, 255, 0);
	  color: #000000;
	  font-size: 1vw;
		font-weight: bold;
    font-family: Arial;
		border-style: none;
	  
	}

.container3 .childcontainer2 {
  position: absolute;
	  left: 0%;
		top: 5%;  
	  width: 100%;
		height: 90%;
    border-radius: 3%;
    border-style:solid;
    border-color: #000000;
}

.container3 .childcontainer2 #imagepd {
  position: absolute;
		top: 50%;
	  left: 50%;
	  transform: translate(-50%, -50%);
	  -ms-transform: translate(-50%, -50%);
	  width: 85%;
	  height: 85%;
   
}

#copyright {
	  position: absolute;
	  bottom: 0%;
		right: 1%;
	  /* width: 46%;
		height: 46%; */
	  font-style: bold;
		font-size: 15px;
		font-family: Arial;
	}

/*the container must be positioned relative:*/
.container1 .childcontainer1 .autocomplete {
  position: relative;
  /* display: inline-block; */
  
}

input {
  border: 1px solid transparent;
  background-color: #f1f1f1;
  padding: 10px;
  font-size: 16px;
}

input[type=text] {
  background-color: #f1f1f1;
  width: 100%;
}

input[type=submit] {
  background-color: DodgerBlue;
  color: #fff;
  cursor: pointer;
}

.autocomplete-items {
  position: absolute;
  border: 1px solid #d4d4d4;
  border-bottom: none;
  border-top: none;
  z-index: 99;
  /*position the autocomplete items to be the same width as the container:*/
  top: 100%;
  left: 0;
  right: 0;
}

.autocomplete-items div {
  padding: 10px;
  cursor: pointer;
  background-color: #fff; 
  border-bottom: 1px solid #d4d4d4; 
}

/*when hovering an item:*/
.autocomplete-items div:hover {
  background-color: #e9e9e9; 
}

/*when navigating through the items using the arrow keys:*/
.autocomplete-active {
  background-color: DodgerBlue !important; 
  color: #ffffff; 
}

@media screen and (max-height: 480px){
  .container1 .childcontainer2 {
    position: absolute;
	  left: 0%;
		top: 20%;  
	  width: 100%;
		height: 80%;
    font-style: bold;
		font-size: 1.5vw;
		font-family: Arial;
  }

  .container1 .childcontainer2 ul {
  position: absolute;
	  margin-left:0%;
    padding-left:0px;
    margin-top:10%;	  
	  width: 100%;
}
}

@media screen and (max-height: 320px){
  .container1 .childcontainer2 {
    position: absolute;
	  left: 0%;
		top: 30%;  
	  width: 100%;
		height: 70%;
    font-style: bold;
		font-size: 1.5vw;
		font-family: Arial;
  }

  .container1 .childcontainer2 ul {
  position: absolute;
	  margin-left:0%;
    padding-left:0px;
    margin-top:0%;	  
	  width: 100%;
  }
}

</style>
</head>     

<body>
<img id="vnflag" src="images/vnflag.png" onclick="changeVN()" alt="">
<img id="jpflag" src="images/jpflag.png" onclick="changeJP()" alt="">
<div class="container1">
  <div class="childcontainer1">
  <h4 style="font-size:1vw;">製品選定</h4>
    <form autocomplete="off" action="/qi/chitiet.php">
      <div class="autocomplete" >
      <?php 
      if ($mauHang == "HOUSING-211563-0010"){
       echo  '<input type="text" id="myInput" name="mauHang" placeholder="品名入力" value="HOUSING-211563-0010">';
      }
      else if ($mauHang == "HUB-1850"){
      echo  '<input type="text" id="myInput" name="mauHang" placeholder="品名入力" value="HUB-1850">';
      }
      else {
        echo  '<input type="text" id="myInput" name="mauHang" placeholder="品名入力">';
      }
      ?>
      </div>
      <!-- <input type="submit" id="submit"> -->
    </form>
  </div>
  <div class="childcontainer2">
    <ul>
    <li><a href="#"  id="ngoaiquan" name="ngoaiquan" onclick="ngoaiQuan()" style="font-size:1vw;">外観限度見本</a></li>
    <!-- <li><a href="#" id="congdoan" name="congdoan" style="font-size:1vw;">Khái Quát Công Đoạn</a></li> -->
    <li><a href="#" id="quakhu" name="quakhu" style="font-size:1vw;">過去トラ</a></li>
    </ul>
  </div>
</div>
<div class="container2">
  <p id="namepd" style="font-size:1vw; font-weight:bold ;font-family:Arial">製品</p>
  <div class="childcontainer1">
  <?php
  if ($mauHang == "HOUSING-211563-0010"){
       echo  '<iframe id="view3d" src="3dhousing211563.html" scrolling="no" style="display:block;"></iframe>';
      }
      else if ($mauHang == "HUB-1850"){
      echo  '<iframe id="view3d" src="3dhub1850.html" scrolling="no" style="display:block;"></iframe>';
      }
      else {
        echo  '<iframe id="view3d" src="" scrolling="no" style="overflow:hidden;"></iframe>';
      }
  ?>
  <!-- <iframe id="view3d" src="" scrolling="no" style="overflow:hidden;"></iframe> -->
  </div>
  
</div>
</div>
<div class="container3" name="container3">
  <!-- <p id="detailpd" style="font-size:1vw;"><b>THÔNG TIN CHI TIẾT</b></p> -->
  <button type="button" id="detailpd" onclick="detailPD()">製品概要</button>
  <button type="button" id="processpd" onclick="processPD()">工程概要</button>
  <div class="childcontainer2">
  <?php
  if ($mauHang == "HOUSING-211563-0010"){
       echo  '<img id="imagepd" src="images/housing2115630010detailsjp.png" alt="housing">';
      }
      else if ($mauHang == "HUB-1850"){
      echo  '<img id="imagepd" src="images/hub1850details.png" alt="housing">';
      }
      else {
        echo  '<img id="imagepd" src="images/trans.png" alt="housing">';
      }
  ?>
  <!-- <img id="imagepd" src="images/trans.png" alt="housing"> -->
  </div>
  <p id="copyright" style="font-size:0.8vw;">Copyright © QI-Tech MVP 2019</p>
</div>
<p><a href="selectjp.php?dangxuat=true" id="logout" name="logout">Log out</a></p>



<script>
var condi = 0;
var imagePD = document.getElementById("imagepd");
var getInput = document.getElementById("myInput");


function autocomplete(inp, arr) {
  /*the autocomplete function takes two arguments,
  the text field element and an array of possible autocompleted values:*/
  var currentFocus;
  /*execute a function when someone writes in the text field:*/
  inp.addEventListener("input", function(e) {
      var a, b, i, val = this.value;
      /*close any already open lists of autocompleted values*/
      closeAllLists();
      if (!val) { return false;}
      currentFocus = -1;
      /*create a DIV element that will contain the items (values):*/
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      /*append the DIV element as a child of the autocomplete container:*/
      this.parentNode.appendChild(a);
      /*for each item in the array...*/
      for (i = 0; i < arr.length; i++) {
        /*check if the item starts with the same letters as the text field value:*/
        if (arr[i].substr(0, val.length).toUpperCase() == val.toUpperCase()) {
          /*create a DIV element for each matching element:*/
          b = document.createElement("DIV");
          /*make the matching letters bold:*/
          b.innerHTML = "<strong>" + arr[i].substr(0, val.length) + "</strong>";
          b.innerHTML += arr[i].substr(val.length);
          /*insert a input field that will hold the current array item's value:*/
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          /*execute a function when someone clicks on the item value (DIV element):*/
          b.addEventListener("click", function(e) {
              /*insert the value for the autocomplete text field:*/
              inp.value = this.getElementsByTagName("input")[0].value;
              /*close the list of autocompleted values,
              (or any other open lists of autocompleted values:*/
              closeAllLists();
          });
          a.appendChild(b);
        }
      }
  });
  
  inp.addEventListener("click", function(e) {
      getInput.value="";
      a = document.createElement("DIV");
      a.setAttribute("id", this.id + "autocomplete-list");
      a.setAttribute("class", "autocomplete-items");
      this.parentNode.appendChild(a);
      for (i = 0; i < arr.length; i++) {
          b = document.createElement("DIV");
          b.innerHTML = arr[i];
          b.innerHTML += "<input type='hidden' value='" + arr[i] + "'>";
          b.addEventListener("click", function(e) {
          inp.value = this.getElementsByTagName("input")[0].value;
          closeAllLists();
          });
          a.appendChild(b);
      }
  });

  /*execute a function presses a key on the keyboard:*/
  inp.addEventListener("keydown", function(e) {
      var x = document.getElementById(this.id + "autocomplete-list");
      if (x) x = x.getElementsByTagName("div");
      if (e.keyCode == 40) {
        /*If the arrow DOWN key is pressed,
        increase the currentFocus variable:*/
        currentFocus++;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 38) { //up
        /*If the arrow UP key is pressed,
        decrease the currentFocus variable:*/
        currentFocus--;
        /*and and make the current item more visible:*/
        addActive(x);
      } else if (e.keyCode == 13) {
        /*If the ENTER key is pressed, prevent the form from being submitted,*/
        e.preventDefault();
        if (currentFocus > -1) {
          /*and simulate a click on the "active" item:*/
          if (x) x[currentFocus].click();
        }
      }
  });
  function addActive(x) {
    /*a function to classify an item as "active":*/
    if (!x) return false;
    /*start by removing the "active" class on all items:*/
    removeActive(x);
    if (currentFocus >= x.length) currentFocus = 0;
    if (currentFocus < 0) currentFocus = (x.length - 1);
    /*add class "autocomplete-active":*/
    x[currentFocus].classList.add("autocomplete-active");
  }
  function removeActive(x) {
    /*a function to remove the "active" class from all autocomplete items:*/
    for (var i = 0; i < x.length; i++) {
      x[i].classList.remove("autocomplete-active");
    }
  }
  function closeAllLists(elmnt) {
    /*close all autocomplete lists in the document,
    except the one passed as an argument:*/
    var x = document.getElementsByClassName("autocomplete-items");
    for (var i = 0; i < x.length; i++) {
      if (elmnt != x[i] && elmnt != inp) {
        x[i].parentNode.removeChild(x[i]);
      }
    }
  }
  /*execute a function when someone clicks in the document:*/
  document.addEventListener("click", function (e) {
      closeAllLists(e.target);
     
      var view3D = document.getElementById("view3d");
      var imagePD = document.getElementById("imagepd");
      var getInput = document.getElementById("myInput");
      var namePD = document.getElementById("namepd");
      var ngoaiquan = getInput.value;
      if (getInput.value!="") {
      <?php $_SESSION["loggedin"] = true; ?>
      document.getElementById("ngoaiquan").href="/qi/chitiet.php?mauHang="+ ngoaiquan +"&language=JP";
      document.getElementById("quakhu").href="/qi/pastjp.php?mauHang="+ngoaiquan;
      
      }
      if (getInput.value == 'HOUSING-211563-0010'){
        view3D.style.display="block";
        view3D.src="3dhousing211563.html";
        if (condi==0){
          document.getElementById("processpd").style.fontWeight="normal";
          imagePD.src="images/housing2115630010detailsjp.png";
        }
        else{
          imagePD.src="images/housing2115630010process.png";
        }
        namePD.innerHTML= getInput.value;
        namePD.style.fontWeight = 'bold';
      }
      else if (getInput.value == 'HUB-1850'){
        view3D.style.display="block";
        view3D.src="3dhub1850.html";
        if (condi==0){
          document.getElementById("processpd").style.fontWeight="normal";
          imagePD.src="images/hub1850details.png";
        }
        else{
          imagePD.src="images/hub1850process.png";
        }
        namePD.innerHTML= getInput.value;
        namePD.style.fontWeight = 'bold';
      }
  });
}



function ngoaiQuan(){
  if(getInput.value==""){
    alert("製品を選定ください");
  }
}

function detailPD(){
  condi = 0;
  document.getElementById("processpd").style.fontWeight="normal";
  document.getElementById("detailpd").style.fontWeight="bold";
  document.getElementById("detailpd").style.background="#cccccc";
  document.getElementById("processpd").style.background="none";
}

function processPD(){
  condi = 1;
  document.getElementById("processpd").style.fontWeight="bold";
  document.getElementById("detailpd").style.fontWeight="normal";
  document.getElementById("detailpd").style.background="none";
  document.getElementById("processpd").style.background="#cccccc";
}

function changeVN(){
  window.location.href = "chonmau.php?mauHang="+getInput.value;
}

function changeJP(){
  // window.location.href = "chonmau.php?language=JP";
}

var product = <?php echo json_encode($data); ?>;
autocomplete(document.getElementById("myInput"), product);


</script>

</body>
</html>
