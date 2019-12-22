<?php
session_start();
include_once 'lib.php';
if(!isset($_SESSION["id"]))
    header("location: index.php");

$error="";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {

       if (empty($_POST['tekst2']))    
        {
            $error .= "Tekstualno polje je prazno<br>";
        } 

        if (empty($_POST['nazivFajla']))    
        {
            $error .= "Niste uneli naziv fajla<br>";
        } 

       if($error == "")
        {
           $servis=new Service();
           
            $fajl= new Fajl(0, $_POST['nazivFajla'], $_POST['tekst2'],$_SESSION["id"]);
            $servis->dodaj_fajl($fajl);
             

            header("location: enkriptuj.php");
        }

       // echo $error;
       
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
   <a href="dekriptuj.php" class="home1" style="color:red" >Decrypt</a>
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
            foreach($fajlovi as $k)
            {
            	if($k->korisnikID==$_SESSION["id"])
            	{
	                echo "<li>";
	                echo "<label>$k->naziv</label>";
	                echo "</li>";
            	}	
            }
            echo "</ol>";
 ?>
</div>

<div class="kont">

<h2>Encrypt</h2>


<table style="width:50%">
  <tr>
    
  </tr>
  <tr>
    <td>
    	<textarea name="tekst1" id="mytxt1" rows="10" cols="70" style="border:solid 1px #8a8a5c" method = "post" ></textarea>
    </td>
    <td> 
 	<input type="file" id="myFile"  >
 	</td>
    
  </tr>

    <tr>
    <td >Key: <input id="key" type="text" size="63" style="border:solid 1px #8a8a5c" ></td>
    <td>
		<input id="pc" name="pc"  size="1" value="_" type="hidden">
    	<input type="submit" class="dugme" value = " Encrypt " onclick="Enkriptuj()"></td>
    
   </tr>
  
  <tr>
  		<form action = "enkriptuj.php" method = "post" id="myform" onsubmit="return validateMyForm();"> 
    <td>
    <textarea name="tekst2" id="mytxt2" rows="12" cols="70" style="border:solid 1px #8a8a5c" readonly="readonly" method = "post" form="myform"></textarea></td>
    <td>
      <label>Unesite naziv fajla:</label><br>
      <input type="text" id="nazivFajla" name="nazivFajla" size="13" maxlength="15">
      <input type="submit" class="dugme2" value = " Upload na Servis " form="myform">
      <br>
      
    </td>
    	</form>
  </tr>
</table>

</div>
 <script type="text/javascript" src="js\enkriptuj.js">
</script>
<script >

	document.getElementById("myFile").addEventListener("change", myFunction);
	function myFunction()
	{
		//alert('Selected file: ' + this.value);
		var file = document.getElementById("myFile").files[0];
		var reader = new FileReader();
		reader.onload = function (e)
				 {
		    var textArea = document.getElementById("mytxt1");
		    textArea.value = e.target.result;
				};
		reader.readAsText(file);
	};



</script>

<script>
  function validateMyForm(){

    //event.preventDefault();

    sadrzaj = document.getElementById("mytxt1").value.toLowerCase().replace(/\s/g, ""); 
  
     console.log(sadrzaj);

    if(sadrzaj.length < 1)
        { 
          alert("Niste ucitali sadrzaj!"); 
          return false;
         }   

    else{
    var key;
    key = document.getElementById("key").value;

    if(key.length < 2)
        { 
          if(key.length < 1)
          {
            alert("Niste uneli kljuc!"); 
            return false;
          }
          alert("Kljuc mora biti najmanje duzine 2!"); 
          return false;
         }
         else{

            sadrzaj2=document.getElementById("nazivFajla").value;
           if(sadrzaj2==0)
             {
             alert("Niste uneli naziv fajla!");
                return false;
             }
              return true;
         } 



       }


      
     }


      /* sadrzaj=document.getElementById("nazivFajla").value;
       if(sadrzaj==0)
          alert("Niste uneli naziv fajla!");
      }*/
  </script>

</body>
</html>







