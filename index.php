<?php
// Initialize the session
session_start();
 
// Check if the user is already logged in, if yes then redirect him to welcome page
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    // header("location: chonmau.php");
    // exit;
    
}

// Include config file
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
	 

	header("location: index.php");
	exit;
	}
}

if(isset($_GET["language"])){
	$language = $_GET["language"];
}
else {
    $language = "";
}


// if ($language == "JP"){
//     header("location: index.php");
//     exit;
// }
 
// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Check if username is empty
    if(empty(trim($_POST["username"]))){
        $username_err = "Vui lòng nhập tên tài khoản.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Check if password is empty
    if(empty(trim($_POST["password"]))){
        $password_err = "Vui lòng nhập mật khẩu.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validate credentials
    if(empty($username_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT id, username, password FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            // Set parameters
            $param_username = $username;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Store result
                mysqli_stmt_store_result($stmt);
                
                // Check if username exists, if yes then verify password
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    // Bind result variables
                    mysqli_stmt_bind_result($stmt, $id, $username, $hashed_password);
                    if(mysqli_stmt_fetch($stmt)){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, so start a new session
                            // session_start();
                            
                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["id"] = $id;
                            $_SESSION["username"] = $username;                            
                            // $language = "JP";
                            // Redirect user to welcome page
                           
                            // if ($language == "JP"){
                            //     header("location: index.php?language=JP");
                            // }
                            // header("location: chonmau.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "Mật khẩu nhập sai";
                        }
                    }
                } else{
                    // Display an error message if username doesn't exist
                    $username_err = "Không có tài khoản này";
                }
            } else{
                echo "Đã nhập sai. Vui lòng thử lại";
            }
        }
        
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        body{ font: 14px sans-serif; }
        .wrapper{width: 430px; padding: 20px; }

    #img {
	  position: absolute;
      left: 50%;
      transform: translate(-50%, -50%);
	    height: 5%;
        width: 50%
	}

    #image {
	  position: absolute;
      right: 0%;
      bottom: 1%;
      transform: translate(-50%, -50%);
	    height: 5%;
        width: 3%;
	}

    .corner {
	  position: absolute;
	  right: 3%;
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

    /* .corner .flag .fjp{
        position: absolute;
        top: 0%;
        left: 0%;
        width: 45%;
        height: auto;
    }

    .corner .flag .fvn{
        position: absolute;
        top: 0%;
        left: 55%;
        width: 45%;
        height: auto;
        
    }

    .corner .flag  #jpflag{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        width: auto;
        height: auto;
    }

    .corner .flag  #vnflag{
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        -ms-transform: translate(-50%, -50%);
        width: auto;
        height: auto;
    } */

    .menu {
	  position: absolute;
	  left: 0%;
	  top: 70%;
	  width: 100%;
	  height: auto;
       
	}

    .menu .ot1 {
	  position: absolute;
	  left: 0%;
	  top: 0%;
	  width: 25%;
	  height: auto;

	 
	}

    .menu .ot1 #option1 {
	  position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
	    height: auto;
        width: auto;
	}

    .menu .ot2 {
	  position: absolute;
	  left: 25%;
	  top: 0%;
	  width: 25%;
	  height: auto;
	 
	}

    .menu .ot2 #option2 {
	  position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
	    height: auto;
        width: auto;
	}

    .menu .ot3 {
	  position: absolute;
	  left: 50%;
	  top: 0%;
	  width: 25%;
	  height: auto;
	 
	}

    .menu .ot3 #option3 {
	  position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
	    height: auto;
        width: auto;
	}

    .menu .ot4 {
	  position: absolute;
	  left: 75%;
	  top: 0%;
	  width: 25%;
	  height: auto;
	 
	}

    .menu .ot4 #option4 {
	  position: absolute;
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
	    height: auto;
        width: auto;
	}

   
    #copyright {
	  position: absolute;
	  bottom: 0.3%;
		right: 1%;
	  /* width: 46%;
		height: 46%; */
	  font-style: bold;
		font-size: 15px;
		font-family: Arial;
	}

    @media screen and (max-height: 768px){
    
        #title {
            height: auto;
            width: 65%;
        }

        .menu {
        position: absolute;
        left: 0%;
        top: 75%;
        width: 100%;
        height: auto;
        }

        #image {
        position: absolute;
        right: 0%;
        bottom: 1.5%;
        transform: translate(-50%, -50%);
        height: 5%;
        width: 3%;
	    }

        .menu .ot1 #option1 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
        height: auto;
        width: 80%;
        }


        .menu .ot2 #option2 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
            height: auto;
            width: 80%;
        }

        .menu .ot3 #option3 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
            height: auto;
            width: 80%;
        }

        .menu .ot4 #option4 {
        position: absolute;
        left: 50%;
        top: 50%;
        transform: translate(-50%, -50%);
            height: auto;
            width: 80%;
        }
    }
    
    </style>
</head>
<body>
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
<center>
    <br>
    <br>
    <!-- <p id="welcome" align="center">Welcome to MARUEI VIETNAM PRECISION</p> -->
    <!-- <div class="corner">
    <p id="language">Languages</p>
    <img id="vnflag" src="images/vnflag.png" onclick="changeVN()" alt="">
    <img id="jpflag" src="images/jpflag.png" onclick="changeJP()" alt="">
    </div> -->
    <!-- <img id="img" src="images/logoMVP.png" > -->
    <br>
    <br>
    <br>
    <br>
    <br>
    <img id="title" src="images/title.png" alt="">
    
    <div class="wrapper">
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>" align="left">
                <?php
                if (empty($_SESSION["loggedin"])){
                echo '<label>Username</label>
                <input type="text" name="username" class="form-control" value="'. $username . '">';
                }
                ?>
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>" align="left">
            <?php
                if (empty($_SESSION["loggedin"])){
                echo '<label>Password</label>
                <input type="password" name="password" class="form-control">';
            }
            ?>
                <span class="help-block"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
            <?php
            if (empty($_SESSION["loggedin"])){
                
                echo '<input type="submit" class="btn btn-primary" value="Login">';
            }
            if (isset($_SESSION["loggedin"])){
                echo '<br>
                <br>
                <br>
                <br>
                ';
                if ($language == "JP"){
                    echo '<p><b>ログイン成功</b></p>';
                }
                else {
                    echo '<p><b>Đăng nhập thành công</b></p>';
                }
                
                echo '<br>
                <br>
                <p></p>
                ';
                echo '<input type="button" onclick="location.href=\'chonmau.php?dangxuat=true\';" class="btn btn-primary" value="Logout">';
            }
            ?>
            </div>
            
        </form>
    </div>
    
</center>
    <img id="image" src="images/logo.png" width="10%" height="10%" >
    <p id="copyright">Copyright © QI-Tech MVP 2019</p> 
<div class="menu">
    <?php
    if (isset($_SESSION["loggedin"])){
       
            echo '<div class="ot1"><img id="option1" src="images/option1.png" onclick="ngoaiQuan()"></div>';
            echo '<div class="ot2"><img id="option2" src="images/option2.png" onclick="nhaMay()"></div>';
            echo '<div class="ot3"><img id="option3" src="images/option3.png" onclick="ktsanXuat()"></div>';
            echo '<div class="ot4"><img id="option4" src="images/option4.png" onclick="sanXuat()"></div>';
        
    }
    ?>
</div>	
</body>
<script>
    function ngoaiQuan(){
        <?php
        if ($language == "JP"){
           echo 'window.location.href = "chonmau.php?language=JP"';
        }
        else {
           echo 'window.location.href = "chonmau.php";';
        }
        ?>
    }

    function nhaMay(){
        <?php
        if ($language == "JP"){
            echo 'window.location.href = "factory.php?language=JP";';
        }
        else {
            echo 'window.location.href = "factory.php";';
        }
        ?>
    }

    function sanXuat(){
        <?php
        if ($language == "JP"){
            echo 'window.location.href = "produce.php?language=JP";';
        }
        else {
            echo 'window.location.href = "produce.php";';
        }
        ?>
    }

    function ktsanXuat(){
        <?php
        if ($language == "JP"){
            echo 'window.location.href = "manu.php?language=JP";';
        }
        else {
            echo 'window.location.href = "manu.php";';
        }
        ?>
    }

    function changeVN(){
        // window.location.href = "index.php";
    }

    function changeJP(){
        window.location.href = "indexjp.php";
    }

</script>
</html>