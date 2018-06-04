<?php
	ob_start();
	session_start();
	require_once 'db.php';
	
	// it will never let you open index(login) page if session is set
	if ( isset($_SESSION['user'])!="" ) {
		header("Location: order.php");
		exit;
	}
	
	$gabimi = false;
	$emailgabim=$passgabim="";
	if( isset($_POST['btn-login']) ) {	
		
		// prevent sql injections/ clear user invalid inputs
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		// prevent sql injections / clear user invalid inputs
		
		if(empty($email)){
			$gabimi = true;
			$emailgabim = "Shkruani email adresen tuaj.";
		} else if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$gabimi = true;
			$emailgabim = "Shenoni nje email adrese valide.";
		}
		
		if(empty($pass)){
			$gabimi = true;
			$passgabim = "Shenoni fjalkalimin tuaj.";
		}
		
		// if there's no error, continue to login
		if (!$gabimi) {
			
			$password = hash('sha256', $pass); // password hashing using SHA256
            $sql = "SELECT id,username, useremail, userpass FROM user WHERE useremail='$email'";
			$res = $conn->query($sql);
			$row=mysqli_fetch_array($res);
			$count = mysqli_num_rows($res); // if username/userpass correct it returns must be 1 row
			$cook = "porosia";
			$vlera = date("Y/m/d");
			setcookie($cook, $vlera,  time() - (86400 * 30), "/");
			
			if( $count == 1 && $row['userpass']==$password ) {
				$_SESSION['user'] = $row['id'];
				//$_SESSION['kategoria'] = $row['kategoria'];
				
                      header("Location: order.php");

			
				
			} else {
				$gabMSG = "Kredentcialet gabim, Provoni perseri...";
			}
				
		}
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Porosit Online</title>
<link rel="stylesheet" href="css/bootstrap.min.css" type="text/css"  />
<link rel="stylesheet" href="css/style.css" type="text/css" />
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Raleway">
<style>
body,h1,h5 {font-family: "Raleway", sans-serif}
body, html {height: 100%}
.bgimg {
    background-image: url('images/res.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
	body {
	
	 background-image: url('images/res.jpg');
    min-height: 100%;
    background-position: center;
    background-size: cover;
}
@media (min-width: 1200px){
.container {
    width: 100%  !important;
}}

</style>
</head>
<body>

<div class="container wid">
<div class="bgimg w3-display-container w3-text-white">
  <div class="w3-display-middle w3-jumbo">
    <p class="w3-large">Porosit Onilne</p>
  </div>
  <div class="w3-display-topleft w3-container w3-xlarge">
 <br></br>
     <a href="index.php" >
  <img src="images/logooo.jpg"  style="width:110px;border-radius: 80%;">
</a><br></br>

   
  
  </div>
  
</div>
	<div id="login-form" class="wid">
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12 wid" style="background: white" >
        
        	<div class="form-group">
            	<h2 class="">Kyçu</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($gabMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-danger">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $gabMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Your Email" value="melosdauti7@gmail.com" maxlength="40" />
                </div>
                <span class="text-danger"><?php echo $emailgabim; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Your Password" value="kosova" maxlength="15"  />
                </div>
                <span class="text-danger"><?php echo $passgabim; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary" style="background-color: #000;border-color: #DE2D37" name="btn-login">Kyçu</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
          
        
        </div>
   
    </form>
    </div>	

</div>
<div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge" style="color: white">E Hënë - E Shtunë 10-23 | E Djelë 14-02</p>
    <p class="w3-large" style="color: white">Rruga UÇK Prishtinë, Kosovë</p>
   
  </div>
</body>
</html>
<?php ob_end_flush(); ?>