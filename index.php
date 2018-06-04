<!DOCTYPE html>
<html>
<title>Porosit Online</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
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


table {
    border-collapse: collapse;
    width: 100%;
    margin-bottom: 3%;
}

th, td {
    padding: 8px;
    text-align: left;
    border-bottom: 1px solid #ddd;
}

tr:hover {background-color:#f5f5f5;}
.inputushqimi{
border:transparent;
}
</style>
<body>


<div class="bgimg w3-display-container w3-text-white">
<br></br>
<br></br>
<a onclick="document.getElementById('apliko').style.display='block'">
  <img src="images/apply_blue.png" alt="Apply" style="width:160px;border-radius: 80%; float: right;">
</a><br></br>
  <div class="w3-display-middle w3-jumbo">
    <p class="w3-large"></p>
  </div>
  <div class="w3-display-topleft w3-container w3-xlarge">
    <br></br>
     <a  >
  <img src="images/logooo.jpg"  style="width:110px;border-radius: 80%;">
</a><br></br>
    
<a  onclick="document.getElementById('menu').style.display='block'">
  <img src="images/menu.png" alt="Paris" style="width:110px;border-radius: 80%;">
</a><br></br>
<a  href="signup.php" >
  <img src="images/register.png" alt="Paris" style="width:160px;margin-left: -13%;">
</a>
</div>
<?php

class example {
    public $var;
    function __construct($param) {
        $this->var = $param;

        
    }
}
$example = new example("MIRËSEVINI!");
?>

  <div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge" style="color: white"><?php echo $example->var?> <br>E Hënë - E Shtunë 10-23 | E Dielë 14-02</p>
    <p class="w3-large" style="color: white">Rruga UÇK Prishtinë, Kosovë</p>
   
  </div>
</div>

<!-- Menu Modal -->
<div id="menu" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black w3-display-container">
      <span onclick="document.getElementById('menu').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1 style="width: 100%;float: left;">Starters</h1>
      
    </div>
    <div class="w3-container" >
      <div style="width: 100%;float: left;">
      <h5>Tomato Soup <b>$2.50</b></h5>
      <h5>Chicken Salad <b>$3.50</b></h5>
      <h5>Bread and Butter <b>$1.00</b></h5>
    </div>
   
    </div>
    <div class="w3-container w3-black" >
      <h1 style="width: 100%;float: left;">Main Courses</h1>
    </div>
    <div class="w3-container" >
     
     <div style="width: 100%;float: left;">
      <h5>Tomato Soup <b>$2.50</b></h5>
      <h5>Chicken Salad <b>$3.50</b></h5>
      <h5>Bread and Butter <b>$1.00</b></h5>
    </div>
    </div>
   
  </div>

</div>
<?php
   if(isset($_FILES['fileToUpload'])){
      $errors= array();
      $file_name = $_FILES['fileToUpload']['name'];
      $file_size = $_FILES['fileToUpload']['size'];
      $file_tmp = $_FILES['fileToUpload']['tmp_name'];
      $file_type = $_FILES['fileToUpload']['type'];
      $file_ext=strtolower(end(explode('.',$_FILES['fileToUpload']['name'])));
      
      $expensions= array("pdf", "txt", "docx", "jpeg","jpg","png");
      
      if(in_array($file_ext,$expensions)=== false){
         $errors[]="extension not allowed, please choose a JPEG or PNG file.";
      }
      
      if($file_size > 2097152) {
         $errors[]='File size must be excately 2 MB';
      }
      
      if(empty($errors)==true) {
         move_uploaded_file($file_tmp,"uploads/".$file_name);
         echo "Success";
      }else{
         print_r($errors);
      }
   }
?> 


<div id="apliko" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black w3-display-container">
      <span onclick="document.getElementById('apliko').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Apliko</h1>
    </div>
    <div class="w3-container">
    <form action="" method="post" enctype="multipart/form-data">
    Upload CV file-in:
    <input type="file" name="fileToUpload" id="fileToUpload">
    <input type="submit" value="Upload Image" name="submit">
    <br></br>
    <ul>
            <li>Sent file: <?php echo (isset($_FILES['fileToUpload'])) ? $_FILES['fileToUpload']['name'] : ""  ?>
            <li>File size: <?php echo (isset($_FILES['fileToUpload'])) ? $_FILES['fileToUpload']['size'] : ""  ?>
            <li>File type: <?php echo (isset($_FILES['fileToUpload'])) ? $_FILES['fileToUpload']['type'] : ""  ?>
    </ul>

    </form>
    </div>
  </div>
</div>

</body>
</html>

