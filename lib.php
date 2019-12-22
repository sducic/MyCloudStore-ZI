<?php
include_once 'data.php';
include_once 'IService.php';

class Service implements IService
{
    const db_host = "localhost";
    const db_korisnicko_ime = "root";
    const db_lozinka = "";
    const db_ime_baze = "baza123";

   function vrati_sve_korisnike()  
    {
    
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze); 
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("SELECT id, ime, lozinka FROM korisnik");

            $rezultat = $naredba->execute();
            $naredba->bind_result($id, $ime, $lozinka);

            if ($rezultat) 
            {
                $niz = array();
                while ($naredba->fetch()) 
                {
                    $niz[$id] = new Korisnik($id, $ime, $lozinka);
                }
                $naredba->close();
                $konekcija->close();
                return $niz;
            }
            else if ($konekcija->errno) {
                print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
            } 
            else 
            {
                print ("Nepoznata greška pri izvrsenju upita");
            }
        }
    }

    function vrati_fajl($id)
    {
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze);
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("SELECT * FROM fajlovi WHERE id=?"); ///OOOOOOOOO
            $naredba->bind_param("i", $id);
            $rezultat = $naredba->execute();
            $naredba->bind_result($id, $naziv, $sadrzaj, $korisnikID);
            $korisnik = NULL;
            if ($rezultat) 
            {
                if ($naredba->fetch()) 
                {
                    $fajl = new Fajl($id, $naziv, $sadrzaj, $korisnikID);
                }
                $naredba->close();
                $konekcija->close();
                return $fajl;
            } else if ($konekcija->errno) {
                print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
            } else {
                print ("Nepoznata greška pri izvrsenju upita");
            }
        }
    }
    

    function vrati_korisnika_mp($m, $p)
    {
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze);
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("SELECT * FROM korisnik WHERE ime=? AND lozinka=?");
            $naredba->bind_param('ss', $m, $p);
            $rezultat = $naredba->execute();
            $naredba->bind_result($id, $ime, $lozinka);
            $korisnik = NULL;
            if ($rezultat) 
            {
                if ($naredba->fetch()) 
                {
                    $korisnik = new Korisnik($id, $ime, $lozinka);
                }
                $naredba->close();
                $konekcija->close();
                return $korisnik;
            } else if ($konekcija->errno) {
                print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
            } else {
                print ("Nepoznata greška pri izvrsenju upita");
            }
        }
    }

    
    function dodaj_korisnika(Korisnik $korisnik)
    {
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze);
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("INSERT INTO korisnik (ime, lozinka) VALUES ("
                    . "?, ?)");
            // "i" označava celobrojni tip podataka. 
            // "s" označava string tip podataka.
            // "d" označava realni tip podataka.
            // PARAMETRI SE NAVODE PO REDOSLEDU U KOM SE OČEKUJU U PRIPREMLJENOM UPITU!
            $naredba->bind_param('ss', $korisnik->ime, $korisnik->lozinka);
            $rezultat = $naredba->execute();
            $naredba->close();
            $konekcija->close();
            if (!$rezultat) {
                if ($konekcija->errno) {
                    print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
                } else {
                    print ("Nepoznata greška pri izvrsenju upita");
                }
            }
        }
    }


     function dodaj_fajl(Fajl $fajl)
    {
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze);
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("INSERT INTO fajlovi (naziv, sadrzaj, korisnikID) VALUES ("
                    . "?, ?,?)");
            // "i" označava celobrojni tip podataka. 
            // "s" označava string tip podataka.
            // "d" označava realni tip podataka.
            // PARAMETRI SE NAVODE PO REDOSLEDU U KOM SE OČEKUJU U PRIPREMLJENOM UPITU!
            $naredba->bind_param('ssi', $fajl->naziv, $fajl->sadrzaj,$fajl->korisnikID);
            $rezultat = $naredba->execute();
            $naredba->close();
            $konekcija->close();
            if (!$rezultat) {
                if ($konekcija->errno) {
                    print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
                } else {
                    print ("Nepoznata greška pri izvrsenju upita");
                }
            }
        }
    }


     function vrati_sve_fajlove()  
    {
    
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze); 
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("SELECT id, naziv, sadrzaj, korisnikID FROM fajlovi");

            $rezultat = $naredba->execute();
            $naredba->bind_result($id, $naziv, $sadrzaj,$korisnikID);

            if ($rezultat) 
            {
                $niz = array();
                while ($naredba->fetch()) 
                {
                    $niz[$id] = new Fajl($id, $naziv, $sadrzaj,$korisnikID);
                }
                $naredba->close();
                $konekcija->close();
                return $niz;
            }
            else if ($konekcija->errno) {
                print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
            } 
            else 
            {
                print ("Nepoznata greška pri izvrsenju upita");
            }
        }
    }

  

  function izbrisi_fajl($id)
    {
        $konekcija = new mysqli(self::db_host, self::db_korisnicko_ime, self::db_lozinka, self::db_ime_baze);
        $konekcija->set_charset('utf8');
        if ($konekcija->connect_errno) 
        {
            print ("Greška pri povezivanju sa bazom podataka ($konekcija->connect_errno): $konekcija->connect_error");
        } 
        else 
        {
            $naredba = $konekcija->prepare("DELETE FROM fajlovi WHERE id=?");
            $naredba->bind_param("i", $id);        
            $rezultat = $naredba->execute();
            $naredba->close();
            $konekcija->close();
            if (!$rezultat) {
                if ($konekcija->errno) {
                    // U slučaju greške pri izvršenju upita odštampati odgovarajucu poruku
                    print ("Greška pri izvrsenju upita ($konekcija->errno): $konekcija->error");
                } else {
                    // U slučaju greške pri izvršenju upita odštampati odgovarajucu poruku
                    print ("Nepoznata greška pri izvrsenju upita");
                }
            }
        }
     }




     
}
?>