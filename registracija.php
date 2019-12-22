<?php
    include_once 'lib.php';
     session_start();
     

    $error="";
    if($_SERVER["REQUEST_METHOD"] == "POST")
    {
         if (empty($_POST["hash"]))    // ime
        {
              $error .= "Lozinka nije hesirana<br>";
         } 

        if (empty($_POST["ime"]))    // ime
        {
            $error .= "Niste uneli username<br>";
        } 

        
        if (empty($_POST["lozinka"]))    // LOZINKA
        {
            $error .= "Niste uneli lozinku<br>";
        }

        if (empty($_POST["lozinka"]==$_POST["lozinka2"]))    // LOZINKA
        {
            $error .= "Lozinke se ne poklapaju<br>";
        }

         $duzina=strlen($_POST["lozinka"]);

         if($duzina<4)
         {
            $error .= "Lozinka mora biti minimum 4 karaktera<br>";
         }


        if($error == "")
        {
            $servis=new Service();
            $korisnici=array();
            $korisnici=$servis->vrati_sve_korisnike();			//proverava da li postoji vec u bazi
            foreach($korisnici as $k)
            {
                if($k->ime == $_POST["ime"])
                    $error .= "Username vec postoji!<br>";
            }
        }
        if($error == "")
        {
        	  $servis=new Service();
           // $confirmcode=md5( rand(0,1000) );
            $korisnik= new Korisnik(0, $_POST["ime"], $_POST["hash"]);//id,ime,lozinka
            $servis->dodaj_korisnika($korisnik);
               
             
        }
        if($error == "")
        {
          header("location: reloadLog.php");     
             
        }

    }
    

?>





<html>
   
   <head>
      <title>Registracija</title>
      
      <style type = "text/css">
         
      </style>
      
   </head>

   
   <body bgcolor = "#FFFFFF">
   
      <div align = "center">
         <div style = "width:300px; border: solid 1px #0000FF; margin-top:100px; " align = "left">
            <div style = "background-color:#0000FF; color:#FFFFFF; padding:3px;  "><b>Registracija</b></div>
            
            <div style = "margin:30px">
               
                <form action = "registracija.php" method = "post">

                  <label>Unesite Username: </label> <input type = "text" name = "ime" class = "box"/><br><br>
                  <label>Unesite Lozinku: </label><br/> <input type = "password" id="lozinkaInput" name = "lozinka" class = "box" /><br>
                  <label>Ponovite Lozinku: </label><br/> <input type = "password" id="lozinkaInput2" name = "lozinka2" class = "box" /><br><br>
                 
                  <input type="checkbox" onclick="prikazLozinke()">Prikazi lozinku<br><br>
                 
                   <input id="hash" name="hash"  size="32" value="" type="hidden">
                  <input type = "submit" onclick ="md5()" value = "Registruj se" /><br>
               </form>
               
               <div style = "font-size:14px; color:#cc0000; margin-top:10px"><?php echo $error; ?></div>     

               <p>Vec imate nalog? <a href="index.php">Prijavi se </a> </p>         
            </div>            
         </div>
        	
      </div>


    <script>
           function prikazLozinke() {
                var x = document.getElementById("lozinkaInput");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }

                 var x = document.getElementById("lozinkaInput2");
                if (x.type === "password") {
                    x.type = "text";
                } else {
                    x.type = "password";
                }
            }
          </script>
        <script type="text/javascript" src="js\md5.js">

        </script>

   </body>
</html>