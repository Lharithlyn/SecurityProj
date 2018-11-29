<?php
echo $_COOKIE["your cookie name"];
if(isset($_POST['CreditCard']) && !empty($_POST['CreditCard'])){
$cookie_value=$_POST['CreditCard'];
setcookie('CreditCardNumber',$cookie_value, $httponly = TRUE);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
	<meta content="IE=edge" http-equiv="X-UA-Compatible">
    <meta content="width=840, initial-scale=1.0" name="viewport">
    
    <title>CSE 4471 - Information Security Project</title>
	<link href="../bootstrap/css/bootstrap.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap-theme.min.css" rel="stylesheet">
	<link href="../bootstrap/css/bootstrap.icon-large.min.css" rel="stylesheet">
    <link href="../theme.css" rel="stylesheet">

    
     <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
     <script type="text/javascript" src="jquery-3.3.1.min.js"></script>
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <style type="text/css"></style>  
</head>

<body>
     <div class="container-narrow">
        <div class="title">
            <h4><strong><a href="../index.html">Information Security Project</a></strong>
            <p style="font-size:14px">View Course Grades</p>
            <p style="font-size:12px">Autumn 2018</p>
        </h4>    
    </div> 

		<!-- SITE NAVIGATION -->
		<div class="navbar navbar-default" role="navigation">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
			<div class="navbar-collapse collapse">
				<ul id="site-nav" class="nav navbar-nav">
					<li><a href="SecureSite.html">Home</a></li>
					<li><a href="">Class Forum</a></li> 
					<li class="active"><a href="">Buy Class Textbook</a></li><!--Link Webpage Here-->
					<li><a href="">View Grades</a></li> 
				</ul>
			</div>
		</div>
		<!-- END SITE NAVIGATION -->

		<div class="content">
			<h3>BUY CLASS TEXTBOOK</h3>   
			<hr>

			<div>
				<h4>Personal Information</h4>
				<p>First Name: <input type="text" name="FirstName" ></p>
				<p>Last Name: <input type="text" name="LastName"><br></p>
				<p>Email: <input type="text" name="Email"><br></p>
			</div>
			
			<hr>
			<h4>Payment Information</h4>
			
			<div>
                <form id="getCC" name="getCC" method="post" action="makeCookie.php">
				Credit Card Number: <input type="text" name="CreditCard" id = "CreditCard"> Expiration Date: <input type = "text" name ="ExpirationDate" value = ""><br>
				CVV: <input type  = "text" name = "CreditCardCode" id = "CreditCardCode"><br>
				Billing / Shipping Address: <br>
				Street Address: <input type="text" name="StreetAddress"> Zip Code: <input type = "text" name ="ZipCode" value = ""><br>
				City: <input type="text" name="City"> State: <input type = "text" name ="State" value = ""><br>
				<input type="submit" name="submit" value ="submit"/>
				</form>
			
			</div>
			
		</div>
	</div>
	

</body>
</html>
