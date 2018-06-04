<?php
  ob_start();
  session_start();
  require_once 'db.php';
  // if session is not set this will redirect to login page
  if( !isset($_SESSION['user']) ) {
    header("Location: signin.php");
    exit;
  }
  // select loggedin users detail
  $sql = "SELECT * FROM user WHERE id=".$_SESSION['user'];
  $perdoruesi = $_SESSION['user'];
  $res4 = $conn->query($sql);
  $userRow=mysqli_fetch_array($res4);
?>



<?php
//session_start();
//include_once 'dbMySql.php';
//$con = new DB_con();

//$conn = mysqli_connect(DB_SERVER,DB_USER,DB_PASS) or die('localhost connection problem'.mysqli_error());
		//$res1=mysqli_query($conn, "SELECT Emri,Cmimi,Sasia FROM porosia where Idperdoruesi='$perdoruesi'");
    //return $res1;
$sql1 = "SELECT emri , cmimi , sasia FROM porosia where id ='$perdoruesi'";
$sql2 = "SELECT Sum(cmimi) as Totali1 FROM porosia where id='$perdoruesi'";
//$table = "porosia";
$res1=$conn->query($sql1);
//$table1 = "porosia";
$res2=$conn->query($sql2);


// data insert code starts here.
if(isset($_POST['btn-save']))
{
  $perdoruesi=$_SESSION['user'];
  //echo $perdoruesi;
  $ushqimi = $_POST['ushqimi'];
  $cmimi = $_POST['cmimi'];
  //$sasia = $_POST['sasia'];
  //echo $cmimi;
  $sql = "INSERT into porosia(id,emri,cmimi) VALUES('$perdoruesi','$ushqimi','$cmimi')";
  $res = $conn->query($sql);
  //echo $res;
 
}
// data insert code ends here.
if(isset($_POST['ruaj']))
{
  $perdoruesi=$_SESSION['user'];
  //echo $perdoruesi;
  $emri = $_POST['Emri'];
  $mbiemri = $_POST['Mbiemri'];
  $qyteti = $_POST['Qyteti'];
  $tel = $_POST['Tel'];
  $adresa = $_POST['Adresa'];
  $sql3 = "INSERT into vendi(id, emri, mbiemri, qyteti, tel, adresa) VALUES('$perdoruesi', '$emri', '$mbiemri', '$qyteti', '$tel', '$adresa')";
  $res3=$conn->query($sql3);
  //echo $res;
 
}
// data insert code ends here.

?>
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
  <div class="w3-display-middle w3-jumbo">
    <p class="w3-large"></p>
  </div>
    <div class="w3-display-topright w3-container w3-xlarge">
      <br></br>
  <a  href="out.php"  style="float: right;">
  <img src="images/ckycu.png" alt="Paris" style="width:110px;border-radius: 80%;"">
</a></div>
  <div class="w3-display-topleft w3-container w3-xlarge">
 

  



   <!---<br></br>
     <a  >
  <img src="images/logooo.jpg"  style="width:110px;border-radius: 80%;">
</a>--><br></br>
    
 <a  onclick="document.getElementById('menu').style.display='block'">
  <img src="images/menu.png" alt="Paris" style="width:110px;border-radius: 80%;">
</a><br></br>
<a  onclick="document.getElementById('contact').style.display='block'" >
  <img src="images/ku.png" alt="Paris" style="width:110px;border-radius: 80%;"">
</a>
<br></br>
<a  onclick="document.getElementById('porosia').style.display='block'" >
  <img src="images/porosia1.png" alt="Paris" style="width:110px;border-radius: 80%;"">
</a>


  </div>
  <div class="w3-display-bottomleft w3-container">
    <p class="w3-xlarge" style="color: white">E Hënë - E Premte 10-23 | E Dielë 14-02</p>
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

   

   <form method="post">
 
     <h5 style="width: 70%;float: left;"><input type="text" name="ushqimi" placeholder="Margarita" Value="Margarita" class="inputushqimi"/>
        <b><input type="text" name="cmimi" placeholder="$2.50" Value="2.50" class="inputushqimi"/></b></h5>
   
  
      <button type="submit" name="btn-save" style="float: right;margin-top: 1.5%;"><strong>Add</strong></button>
   
    </form>

 <form method="post">
 
     <h5 style="width: 70%;float: left;"><input type="text" name="ushqimi" placeholder="Chicken Salad" Value="Chicken Salad" class="inputushqimi"/>
        <b><input type="text" name="cmimi" placeholder="$3.50" Value="3.50" class="inputushqimi"/></b></h5>


          <button type="submit" name="btn-save" style="float: right;margin-top: 1.5%;"><strong>Add</strong></button>

   
    </form>

     <form method="post">
 
   <h5 style="width: 70%;float: left;"><input type="text" name="ushqimi" placeholder="Lasagna" Value="Lasagna" class="inputushqimi"/>
        <b><input type="text" name="cmimi" placeholder="$4.50" Value="4.50" class="inputushqimi"/></b>  </h5>

   
   <button type="submit" name="btn-save" style="float: right;margin-top: 1.5%;"><strong>Add</strong></button>
    </form>




    </div>
    
    </div>
    <div class="w3-container w3-black" >
      
        <h1 style="width: 100%;float: left;">Main Courses</h1>
    </div>
    <div class="w3-container" >
    <form method="post">
 
     <h5 style="width: 70%;float: left;"><input type="text" name="ushqimi" placeholder="Tomato Soup" Value="Tomato Soup" class="inputushqimi"/>
        <b><input type="text" name="cmimi" placeholder="$2.50" value="2.50" class="inputushqimi"/></b></h5>
   
  
      <button type="submit" name="btn-save" style="float: right;margin-top: 1.5%;"><strong>Add</strong></button>
   
    </form>

 <form method="post">
 
     <h5 style="width: 70%;float: left;"><input type="text" name="ushqimi" placeholder="Chicken Salad" Value="Chicken Salad" class="inputushqimi"/>
        <b><input type="text" name="cmimi" placeholder="$3.50" Value="3.50" class="inputushqimi"/></b></h5>


          <button type="submit" name="btn-save" style="float: right;margin-top: 1.5%;"><strong>Add</strong></button>

   
    </form>

     <form method="post">
 
   <h5 style="width: 70%;float: left;"><input type="text" name="ushqimi" placeholder="Bread and Butter" Value="Bread and Butter" class="inputushqimi"/>
        <b><input type="text" name="cmimi" placeholder="$4.50" Value="4.50" class="inputushqimi"/></b>  </h5>

   
   <button type="submit" name="btn-save" style="float: right;margin-top: 1.5%;"><strong>Add</strong></button>
    </form>
    </div>
   
  </div>

</div>


<script>
function showGuess(str) {
    if (str.length == 0) { 
        document.getElementById("guess").innerHTML = "";
        return;
    } else {
        var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                document.getElementById("guess").innerHTML = this.responseText;
            }
        };
        xmlhttp.open("GET", "getguess.php?q=" + str, true);
        xmlhttp.send();
    }
}
</script>



<!-- Contact Modal -->
<div id="contact" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black">
      <span onclick="document.getElementById('contact').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Të dhënat e përdoruesit</h1>
    </div>
    <div class="w3-container">
  
      <form method="post">
        <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Emri" required name="Emri" style="width: 49%;float: left;height: 30px;"></p>
         <p ><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Mbiemri" required name="Mbiemri" style="width: 49%;float: right;height: 30px;"></p>
         <br></br>
         <p><input class="w3-input w3-padding-16 w3-border" "type="text" onkeyup="showGuess(this.value)" placeholder="Qyteti" required name="Qyteti" style="width: 49%;float: left;height: 30px;"></p>
         <p><span id="guess"></span></p><br></br>
         <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Numri Telefonit" required name="Tel" style="width: 49%;float: left;height: 30px;"></p>
         <br></br>
       
         <p><input class="w3-input w3-padding-16 w3-border" type="text" placeholder="Adresa" required name="Adresa"  style="width: 100%;float: left;height: 30px;"></p>

        <br><br>
        <p><button class="w3-button" type="submit" name="ruaj" style="background: black;color: white">Ruaj Shënimet</button></p>
      </form>
    </div>
  </div>
</div>
<div id="porosia" class="w3-modal">
  <div class="w3-modal-content w3-animate-zoom">
    <div class="w3-container w3-black">
      <span onclick="document.getElementById('porosia').style.display='none'" class="w3-button w3-display-topright w3-large">x</span>
      <h1>Fatura</h1>
    </div>
    <div class="w3-container">
      <table align="center">
    
   
    <tr>
    <th>Ushqimi</th>
    <th>Cmimi</th>
    <th>Sasia</th>
   
    </tr>
    <?php
  while($row=mysqli_fetch_row($res1))
  {
      ?>
            <tr>
            <td><?php echo $row[0]; ?></td>
            <td><?php echo $row[1]; ?></td>
            <td><?php echo $row[2]; ?></td>
            
            </tr>
            <?php
  }
  ?>
    </table>
  <?php
  while($row=mysqli_fetch_row($res2))
  {
      ?>
           
            <p style="color: black"><b>Totali: $<?php echo $row[0]; ?></b></p>
           
            <?php
  }
  ?>
    </div>
  </div>
</div>
</body>
</html>

