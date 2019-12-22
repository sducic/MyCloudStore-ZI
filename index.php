<?php
    include_once 'lib.php';
    session_start();

   $error="";

   if($_SERVER["REQUEST_METHOD"] == "POST") {
      
  
     $service= new Service();

      // If result matched $myusername and $mypassword, table row must be 1 row
	   $korisnik= $service->vrati_korisnika_mp($_POST["ime"],  $_POST["hash"]);
        
       
      if($korisnik) {
             
            $_SESSION['id'] = $korisnik->id;
            $_SESSION["ime"] = $korisnik->ime;
         
             header("location: logedIn.php");
     
      }
    

      else {
         $error = "Uneli ste pogresan username ili lozinku";
      }
        
       
      
      
   }
 
   

?>

<html>
   
   <head>
      <title>Prijavi se</title>
      
      <style type = "text/css">
         
      </style>
      
   </head>
   
   <body bgcolor = "#FFFFFF">

        <div align="center" >

        <img src="src/sky.jpg" alt="cloud" width="300" height="200" style="float:center">
  
        </div>


	
      <div align = "center">
         <div style = "width:300px; border: solid 1px #0000FF; " align = "left">
            <div style = "background-color:#0000FF; color:#FFFFFF; padding:3px;"><b>Login</b></div>
				
            <div style = "margin:30px">
               
                <form action = "index.php" method = "post">
                  <label>Username: </label><br><input type = "text" name = "ime" class = "box"/><br /><br />
                  <label>Password: </label><br><input type = "password" id="lozinkaInput" name = "lozinkaInput" class = "box" /><br/><br />
                  <input id="hash" name="hash"  size="32" value="" type="hidden">
                  <input type = "submit" onclick ="md5()" value = " Login " ><br />
               </form>
               
               <div style = "font-size:11px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>
               <p>Nemate nalog? <a href="registracija.php"> Registruj se </a> </p>			
            </div>				
         </div>	
         
      </div>
      <script type="text/javascript" src="js\md5.js">

        </script>
     
   </body>
</html>






