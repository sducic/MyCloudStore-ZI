<?php
session_start();
include_once 'lib.php';
if(!isset($_SESSION["id"]))
    header("location: index.php");


if (isset($_GET['deleteID'])) {


        $service= new Service();
   
      $service-> izbrisi_fajl($_GET['deleteID']);

     //header("location: dekriptuj.php");
     

       } 

  if(isset($_POST['tekst2']))
 {
   header('Content-disposition: attachment; filename="file.txt"');
   header('Content-type: application/txt');
   echo $_POST['tekst2'];
   exit; //stop writing
 }

 $error="";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

    	 if (empty($_POST['tekst2']))    
        {
            $error .= "Tekstualno polje je prazno<br>";
        } 

        if($error == "")
        {
        	header("location: dekriptuj.php");
        }
       
 			
    }

?>

<!DOCTYPE html>
<html>
<head>
<meta name="viewport" charset="UTF-8" content="width=device-width, initial-scale=1">

<link rel="stylesheet" type="text/css" href="stil.css">

</head>
<body>
<div class="header">
  <img src="src/cloud2.png" alt="cloud" width="65" height="35" style="float:left"> 
   <a href="logedIn.php" class="home1" >Home</a>
   <a href="enkriptuj.php" class="home1" style="color:red" >Encrypt</a>
  <div class="header-right"> 
	<a href=""><?php echo $_SESSION["ime"]  ?></a> 
	 <a href="logout.php">Logout</a>   
  </div>
</div>

<div class="polje" >
  <h3>Lista sacuvanih fajlova:</h3>
<?php
  $servis=new Service();
            $fajlovi=array();
            $fajlovi=$servis->vrati_sve_fajlove();		

            echo "<ol>";	
            foreach($fajlovi as $f)
            {
            	if($f->korisnikID==$_SESSION["id"])
            	{
	                echo "<li>";
	                echo "<a href='dekriptuj.php?idf=$f->id'>$f->naziv</a>";
                  echo "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
                  echo "<a href='dekriptuj.php?deleteID=$f->id'>delete</a>";
	                echo "</li>";
            	}	
            }
            echo "</ol>";

 ?>
</div>

<div class="kont">

<h2>Decrypt</h2>

<table style="width:50%">
  <tr>
    
  </tr>
  <tr>
    <td>
    	<textarea name="tekst1" id="mytxt1" rows="10" cols="70" style="border:solid 1px #8a8a5c" readonly="readonly" method = "post" ><?php 

       if (isset($_GET['idf'])) {
        $service= new Service();

   
     $fajl= $service-> vrati_fajl($_GET['idf']);
      // echo $_GET['idf'];
      if($fajl) {
        echo $fajl->sadrzaj;
          
        }

       } 
        ?> 
      </textarea>
    </td>
  <td> 

 	</td>
    
  </tr>

    <tr>
    <td >Key: <input id="key" type="text" size="63" style="border:solid 1px #8a8a5c" >
    </td>
    <td>
      <input id="pc" name="pc"  size="1" value="_" type="hidden">
    	<input type="submit" class="dugme" value = " Decrypt " onclick="Dekriptuj()">
    </td>
    
   </tr>
  
  <tr>
  		<form action = "" method = "post" id="myform"> 
    <td>
    <textarea name="tekst2" id="mytxt2" rows="12" cols="70" style="border:solid 1px #8a8a5c" readonly="readonly" method = "post" form="myform"></textarea></td>
    <td><input type="submit" class="dugme" value = " Download " form="myform"></td>
    	</form>
  </tr>
</table>

</div>
 <script type="text/javascript" src="js\dekriptuj.js">

</script>


</body>
</html>







