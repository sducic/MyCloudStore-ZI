<?php


interface IService 
{

     public function dodaj_korisnika(Korisnik $korisnik);
   	 public function vrati_sve_korisnike();
   	 public function vrati_korisnika_mp($m, $p);
  	 public function dodaj_fajl(Fajl $fajl);
     public function vrati_sve_fajlove(); 
     public function vrati_fajl($id);
     public function izbrisi_fajl($id);
}

?>