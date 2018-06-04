<?php
	//ob_start();
	session_start();
	if( isset($_SESSION['user'])!="" ){
		header("Location: home.php");
	}
	include_once 'db.php';

	$gabimi = false;
	$emri=$email=$pass="";
	$emrigabim=$emailgabim=$passgabim="";

	if ( isset($_POST['btn-signup']) ) {
		
		// clean user inputs to prevent sql injections
		$emri = trim($_POST['emri']);
		$emri = strip_tags($emri);
		$emri = htmlspecialchars($emri);
		
		$email = trim($_POST['email']);
		$email = strip_tags($email);
		$email = htmlspecialchars($email);
		
		$pass = trim($_POST['pass']);
		$pass = strip_tags($pass);
		$pass = htmlspecialchars($pass);
		
		// basic emri validation
		if (empty($emri)) {
			$gabimi = true;
			$emrigabim = "Shkruani emrin e plote.";
		} else if (strlen($emri) < 3) {
			$gabimi = true;
			$emrigabim = "emri must have atleat 3 characters.Emri duhet te kete se paku 3 karaktere";
		} else if (!preg_match("/^[a-zA-Z ]+$/",$emri)) {
			$gabimi = true;
			$emrigabim = "Emri duhet te permbaje shkronja dhe hapsire";
		}
		
		//basic email validation
		if ( !filter_var($email,FILTER_VALIDATE_EMAIL) ) {
			$gabimi = true;
			$emailgabim = "Shenoni nje email adrese valide.";
		} else {
			// check email exist or not
			$query = "SELECT * FROM user WHERE useremail='$email'";
			$result = $conn->query($query);

			if($result->num_rows != 0){
				$gabimi = true;
				$emailgabim = "Kjo email ekziston ne databaze.";
			}
		}
		// password validation
		if (empty($pass)){
			$gabimi = true;
			$passgabim = "Ju lutem shkruani fjalkalimin.";
		} else if(strlen($pass) < 3) {
			$gabimi = true;
			$passgabim = "Fjalekalimi duhet te kete se paku 6 karaktere.";
		}
		
		// password encrypt using SHA256();
		$password = hash('sha256', $pass);
		
		// if there's no gabimi, continue to signup
		if( !$gabimi ) {		

			$query = "INSERT INTO user (username,useremail,userpass) VALUES ('$emri','$email','$password')";
			$res = $conn->query($query);
				
			if ($res) {
				$gabTipi = "sukses";	
				$gabMSG = "Regjistrimi u be me sukses, ju mund te kyçeni tani";
				unset($emri);
				unset($email);
				unset($pass);
			} else {
				$gabTipi = "rrezik";
				$gabMSG = "Diçka shkoi keq, provoni perseri me vone...";
				printf(mysqli_error($conn));
			}	
				
		}
		
		
	}
?>
<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Porosit Onilne</title>
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

<div class="container">
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
	<div id="login-form" >
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" autocomplete="off">
    
    	<div class="col-md-12" style="background: white">
        
        	<div class="form-group">
            	<h2 class="">Regjistrimi</h2>
            </div>
        
        	<div class="form-group">
            	<hr />
            </div>
            
            <?php
			if ( isset($gabMSG) ) {
				
				?>
				<div class="form-group">
            	<div class="alert alert-<?php echo ($gabTipi=="sukses") ? "sukses" : $gabTipi; ?>">
				<span class="glyphicon glyphicon-info-sign"></span> <?php echo $gabMSG; ?>
                </div>
            	</div>
                <?php
			}
			?>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
            	<input type="text" name="emri" class="form-control" placeholder="Shkruaj Emrin" maxlength="50" value="<?php  (isset($emri)) ? '$emri' : ""?>" />
                </div>
                <span class="text-danger"><?php echo $emrigabim; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-envelope"></span></span>
            	<input type="email" name="email" class="form-control" placeholder="Shkruaj Email" maxlength="40" value="<?php (isset($email)) ? '$email' : ""?>" />
                </div>
                <span class="text-danger"><?php echo $emailgabim; ?></span>
            </div>
            
            <div class="form-group">
            	<div class="input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
            	<input type="password" name="pass" class="form-control" placeholder="Shkruaj Password-in" maxlength="15" />
                </div>
                <span class="text-danger"><?php echo $passgabim; ?></span>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<button type="submit" class="btn btn-block btn-primary"  style="background-color: #000" name="btn-signup">Regjistrohu</button>
            </div>
            
            <div class="form-group">
            	<hr />
            </div>
            
            <div class="form-group">
            	<a href="signin.php">Kycu ketu...</a>
            </div>
        
        </div>
   
    </form>
    </div>	

</div>
<div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge" style="color: white">E Hënë - E Premte 10-23 | E Djelë 14-02</p>
    <p class="w3-large" style="color: white">Rruga UÇK Prishtinë, Kosovë</p>
   
  </div>
</body>
</html>
