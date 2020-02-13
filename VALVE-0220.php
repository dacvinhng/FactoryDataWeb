<!DOCTYPE HTML>
<html>
    <head>
        <title>Updating</title>
	<style>
        #homeBtn {
        position: absolute;
        left: 0%;
        top: 0%;
        max-width: 4%;
        max-height: 4%;
        }
    </style>
    </head>
    <body>
        <img id="homeBtn" src="images/homeBtn.png" alt="">
        <br>
        <br>
        
		<h1>Coming soon....</h1>
        
    <script type="text/javascript">
        var myhomeBtn = document.getElementById('homeBtn');
	    myhomeBtn.addEventListener('click', function(event) {
			window.location.href = "index.php";
		});
    </script>
    </body>
</html>