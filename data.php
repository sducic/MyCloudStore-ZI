<?php

class Korisnik
{
    var $id;
    var $ime;
    var $lozinka;
  
    public function __construct($id, $im,  $lo)
    {
        $this->id=$id;
        $this->ime=$im;
        $this->lozinka=$lo;
       
    }
}

class Fajl
{
	var $idf;
	var $naziv;
	var $sadrzaj;
	var $korisnikID;



	 public function __construct($id, $n,$s,$idk)
    {
        $this->id=$id;
        $this->naziv=$n;
        $this->sadrzaj=$s;
        $this->korisnikID=$idk;
       
       
    }
}

?>
