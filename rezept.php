<?PHP
    session_start();

    // Seite ohne get nicht aufrufbar
    if(!isset($_GET['id']) && empty($_GET['id']) || $_GET['id'] == ""){
        die("<p style='color:red;'>Diese Seite ist nicht aufrufbar!!</p>");
    }
	
	include("inc/const.php");
    include("inc/kopf".PHPEND);
?>
    
<title>Sushi Welt 寿司ワールド</title>
<style type="text/css">
    @import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400&display=swap');
    @import url("css/standart.css");
    @import url("css/hmenue.css");
    @import url("css/slideshow.css");
    @import url("css/rezepte.css");
</style>

</head>

<body id="top">
<?PHP  
    include("inc/header".PHPEND);
    include("inc/menue".PHPEND);
?>
<main>
  <article>
    <section class="section">
        <div class="flexed">
            <?PHP
            $db = @new mysqli(HOST,USER,PASS,DBANK);
            if ($db->connect_errno) {
                die('Sorry - gerade gibt es ein Problem: '.$db->connect_error);
            }


            if(isset($_GET['id']) && !empty($_GET['id'])){
                $rid = $_GET['id'];
            
                $sql = "select pfad from bilder where rid = $rid limit 1";
                $bilder = $db->query($sql);
                if($bilder->num_rows){
                    $zeile = $bilder->fetch_assoc();
                    echo('<div class="flexitem"><img src="'.$zeile['pfad'].'" alt="Bild"></div>');
                }else{
                    echo('<div class="flexitem"><img src="img/kein_bild.jpg" alt="Kein Bild"></div>');
                }
                
                $sql = "select s.* from sushiarten s,rezepte r where r.rid = $rid and r.sid = s.sid limit 1";
                
                $sushiart = $db->query($sql);
                $zeile = $sushiart->fetch_assoc();
                
                echo('<div class="flexitem" id="sart">
            <h1>'.$zeile['art'].'</h1><p><br>'.$zeile['info'].'</p>
          </div>'."\n");
		
			
			$sql = "select personen, rezeptname, beschreibung from rezepte where rid = $rid";
			$rezepte = $db->query($sql);
			
			$rezept_zeile = $rezepte->fetch_assoc();
			
			echo('<p class="rezeptname">'.$rezept_zeile['rezeptname'].'</p>'."\n");
			
			
			echo('<div class="flexitem"><h1 style="float:left; margin-right: 50px;">Zutaten</h1> für <span class="button nichtauswaehlbar" onClick="berechne();">-</span><span class="pzahl"><div id="wert">'.$rezept_zeile['personen'].'</div></span><span class="button nichtauswaehlbar" onClick="berechne(\'hoch\');">+</span> Personen
            <section class="rezept">'."\n");
                
			
			$sql = "select z.ehid, z.kid, z.menge, z.zutat, e.einheit_kurz, e.einheit_lang from zutaten z , einheiten e WHERE z.rid = $rid and z.ehid = e.ehid";
			
			$zutaten = $db->query($sql);
			
			$vergleich = "";
			
			while($zutatenliste = $zutaten->fetch_assoc()){
				$sql = "select kname from kategorie where kid = ".$zutatenliste['kid'];
				$kat = $db->query($sql);
				
				$katname = $kat->fetch_assoc();
				$gelesen = $katname['kname'];
				

				if($vergleich != $gelesen){
                    
					echo('<h3>'.$katname['kname'].'</h3>');
					$vergleich = $gelesen;
                    echo('<hr class="hr_abstand">'."\n");
				}
				
                
                
                $menge = (string)$zutatenliste['menge'];
                $menge = str_replace(".",",",$menge);
                
                $einheit = $zutatenliste['einheit_kurz'];
                $einheitlang = $zutatenliste['einheit_lang'];
                
                if(empty($einheit))
                    $einheit = $einheitlang;
                
                if($menge == "0")
                    $menge = "";
                
                if($einheit == "---")
                    $einheit = "";
                
                echo('<span class="menge" name="menge">'.$menge.' </span><span class="einheit"> '.$einheit.'</span><span class="zutat">'.$zutatenliste['zutat'].'</span>'."\n");
                
                echo('<hr class="hr_abstand">'."\n");
				
			}
            
            echo('<p class="druck"><a href="javascript: this.print();" title="Rezept Drucken"><img src="img/drucker.png" alt="drucker"></a></p>
            </section>
        </div>
        <div class="flexitem">
            
            <h1>Zubereitung</h1><br>'."\n");
            
            
            // Beschreibung ausgeben
            
            echo($rezept_zeile['beschreibung']."\n");

		}

		?>
        
            
          </div>

        </div>

    </section>
  </article>
</main>
<script>
    grundwert = Array();
    anzahl = document.getElementsByName('menge');
    for(t=0;t<anzahl.length;t++){
        wert = anzahl[t].innerHTML.replace(",",".");
        grundwert[t] = parseFloat(wert / 2);
    }

    
    // optimierte Funktion
    function berechne(wie = "runter"){
        personen = document.getElementById('wert').innerHTML;
        if(wie == "runter"){
            personen--;
            if(personen <= 1)
                personen = 1;
        }else{
            personen++;
            if(personen >= 10)
                personen = 10;
        }
        
        document.getElementById('wert').innerHTML = personen;
        
        array = document.getElementsByName('menge');
        for(t=0;t < array.length;t++){
            menge = grundwert[t] * personen;
            menge = menge.toString();
            if(menge != 0){
                document.getElementsByName('menge')[t].innerHTML = menge.replace(".",",");
            }
        }
    }

</script>
<?PHP
    include("inc/fuss".PHPEND);

    $bilder->free();
    $zutaten->free();
    $rezepte->free();
    $sushiart->free();
    $db->close();
    
    unset($db,$rezepte,$zutatenliste,$zutaten,$zeile,$bilder);
?>
</body>
</html>
