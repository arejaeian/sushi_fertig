<?PHP
session_start();
include("../inc/const.php");

if(!isset($_SESSION['login'])) {
	session_destroy();
	header("location: login".PHPEND);
}

$db = new mysqli(HOST,USER,PASS,DBANK);
if ($db->connect_errno) {
    die('Sorry - gerade gibt es ein Problem: '.$db->connect_error);
}


if(isset($_POST['submit']) && !empty($_POST['submit'])){
    include("../inc/funktionen".PHPEND);
    
	$rezeptname = $_POST['rname'];
	$landID = (int)$_POST['land'];
	$anlassID = (int)$_POST['anlass'];
	$nahrungID = (int)$_POST['nahrung'];
	$sushiID = (int)$_POST['sart'];
	
	
	// kopie ab hier
	$kat1ID = (int)$_POST['kat1'];
	
	
	$menge1 = $_POST['menge1'];
	$zutat1 = $_POST['zutat1'];
	$einheit1 = $_POST['einheit1'];

	$kat2ID = (int)$_POST['kat2'];
	
	$menge2 = $_POST['menge2'];
	$zutat2 = $_POST['zutat2'];
	$einheit2 = $_POST['einheit2'];
	
	$kat3ID = (int)$_POST['kat3'];
	
	$menge3 = $_POST['menge3'];
	$zutat3 = $_POST['zutat3'];
	$einheit3 = $_POST['einheit3'];
	
	
	$beschreibung = $_POST['beschreibung'];
	$bild = $_FILES['bild']['name'];
	$temp = $_FILES['bild']['tmp_name'];
	
	$fehler[] = array();
	
	if(count($zutat1) >= 1 || count($zutat2) >= 1 || count($zutat3) >= 1){
		
		
    
		$sql = "select rid from rezepte where lower(rezeptname) = lower('$rezeptname') limit 1";
        $eintrag = $db->query($sql);
		if($eintrag->num_rows){
			// fehler (existiert schon)
			$fehler[] += 1;
		} else {
			$sql = "insert into rezepte (sid,lid,eid,aid,personen,rezeptname,beschreibung) values ($sushiID,$landID,$nahrungID,$anlassID,2,'$rezeptname','$beschreibung')";
			$db->query($sql);
			if($db->affected_rows){
                
				$rid = $db->insert_id;
				
				$sql = "insert into zutaten (rid,ehid,kid,menge,zutat) values ";
				
				for($t = 0;$t < count($zutat1);$t++){				
					if(strlen(trim($zutat1[$t])) >= 2){
                        $menge = $menge1[$t];
                        if(!isset($menge) || empty($menge)){
                            $menge = 0;
                        }
                        $menge = str_replace(",",".",$menge);
                        
						$sql .= "($rid,".$einheit1[$t].",".$kat1ID.",".$menge.",'".$zutat1[$t]."'),";
                        
					}
				}
				
				for($t = 0;$t < count($zutat2);$t++){				
					if(strlen(trim($zutat2[$t])) >= 2){
                        $menge = $menge2[$t];
                        if(!isset($menge) || empty($menge)){
                            $menge = 0;
                        }
                        $menge = str_replace(",",".",$menge);
                        
						$sql .= "($rid,".$einheit2[$t].",".$kat2ID.",".$menge.",'".$zutat2[$t]."'),";
                        
					}
				}
				
				for($t = 0;$t < count($zutat3);$t++){				
					if(strlen(trim($zutat3[$t])) >= 2){
                        $menge = $menge3[$t];
                        if(!isset($menge) || empty($menge)){
                            $menge = 0;
                        }
                        $menge = str_replace(",",".",$menge);
                        
						$sql .= "($rid,".$einheit3[$t].",".$kat3ID.",".$menge.",'".$zutat3[$t]."'),";
                        
					}
				}
				
				$sql = substr($sql,0,-1);

				$db->query($sql);
				
				if($db->affected_rows){
                    // jetzt prüfen ob bild da
                    if($bild != ""){
                        $datei = bild_hochladen($bild,$temp,"../img");
                        $datei = str_replace("../","",$datei);
                        
                        $sql = "insert into bilder (rid,pfad) values ($rid,'$datei')";
                        $db->query($sql);
                        if($db->insert_id){
                            $fehler[] += 4;
                        }else{
                            $fehler[] += 5;
                        }
                    }else{
                        $fehler[] += 3;
                    }

				}else{
					$fehler[] += 2;
				}
				
			}
			
		}
		
	} //if zutat 1
	
	
}



?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eingabe Rezepte</title>
    
<style type="text/css">
    @import url("css/standart.css");
    @import url("css/menue.css");
</style>
    <script src="js/tinymce/tinymce.min.js"></script>
    <script>
        tinymce.init({
            selector: '#beschreibung',
            schema: 'html5',
            entity_encoding : "raw",

            language_url: 'js/tinymce/langs/de.js',
            language: 'de',
            height: 500,
            
            plugins: 'advlist lists charmap print preview hr anchor pagebreak  searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality paste textcolor',
            
            toolbar: 'print undo redo | forecolor backcolor | bold italic underline alignleft aligncenter alignright blockquote numlist bullist | link | table'
            
        });
    </script>
    
</head>

<body>
    <?PHP
    include("inc/menue".PHPEND);
    ?>
    <h1>Rezepteingabe</h1>
   

  <form method="post" action="<?PHP $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" accept-charset="UTF-8" id="formularrez">
      
      <h3>
          Eingabe für 2 Personen
      </h3>
      <p>
      <?PHP
	  
	  	if(isset($fehler) && in_array(1,$fehler))
			echo("<h2 style='color:red;'>Rezept ist schon vorhanden.</h2>");
		
		
		if(isset($fehler) && in_array(2,$fehler))
			echo("<h2 style='color:red;'>Es konnten keine Zutaten geschrieben werden.</h2>");
			
		if(isset($fehler) && in_array(3,$fehler))
				echo("<h2 style='color:green;'>Rezeptdaten wurden eingetragen.</h2>");
          
          if(isset($fehler) && in_array(4,$fehler))
				echo("<h2 style='color:green;'>Rezept wurden mit Bild eingetragen.</h2>");
          
          if(isset($fehler) && in_array(5,$fehler))
				echo("<h2 style='color:red;'>Bild konnte nicht eingetragen werden!</h2>");
          
	  
	  ?>
      
          <label for="rname">Rezeptname:</label>
          <input type="text" name="rname" id="rname" value="" required>
      </p>

      <p>
          <label for="sart">Sushi Art:</label>
          <select name="sart" id="sart">
          <?PHP
		  	$sql ="select * from sushiarten";
			$result = $db->query($sql);
			while($zeile = $result->fetch_assoc()){
				echo("<option value='".$zeile['sid']."'>".$zeile['art']."</option>\n");
			}
		  
		  ?>
  
          </select>
      </p>
      <p>
          <label for="nahrung">Ernährung:</label>
          <select name="nahrung" id="nahrung">
           <?PHP
		  	$sql ="select * from erneahrung";
			$result = $db->query($sql);
			while($zeile = $result->fetch_assoc()){
				echo("<option value='".$zeile['eid']."'>".$zeile['rart']."</option>\n");
			}
		  
		  ?>
          </select>
      </p>
      <p>
          <label for="anlass">Anlass:</label>
          <select name="anlass" id="anlass">
           <?PHP
		  	$sql ="select * from anlass";
			$result = $db->query($sql);
			while($zeile = $result->fetch_assoc()){
				echo("<option value='".$zeile['aid']."'>".$zeile['aname']."</option>\n");
			}
		  
		  ?>
          </select>
      </p>
      <p>
          <label for="land">Land:</label>
          <select name="land" id="land">
          <?PHP
		  	$sql ="select * from laender";
			$result = $db->query($sql);
			while($zeile = $result->fetch_assoc()){
				echo("<option value='".$zeile['lid']."'>".$zeile['land']."</option>\n");
			}
		  
		  ?>
          </select>
      </p>
      
      
      <div class="rahmen">
          <p>
              <label for="kat1">Kategorie 1:</label>
              <select name="kat1" id="kat1">
                  <?PHP
					$sql ="select * from kategorie";
					$result = $db->query($sql);
					while($zeile = $result->fetch_assoc()){
						echo("<option value='".$zeile['kid']."'>".$zeile['kname']."</option>\n");
					}
				  
				  ?>
              </select>
          </p>
          <p>
              <span class="abstand">Menge:</span><span class="abstand">Einheiten:</span><span class="abstand">Zutat:</span><br>
              
              <?PHP
			  $sql = "select * from einheiten";
			  
			  for($t=0;$t<=5;$t++){
			  ?>
              <input type="text" name="menge1[]" value="" class="abstand" style="width: 40px;">

              <select name="einheit1[]" class="abstand">
                  
              	<?PHP
				$result = $db->query($sql);
				while($zeile = $result->fetch_assoc()){
					echo("<option value='".$zeile['ehid']."'>".$zeile['einheit_lang']."</option>\n");
				}
				
				
				?>
                 
              </select>
              
              <input type="text" name="zutat1[]" value="" class="abstand"><br>
              <?PHP
			  }
			  ?>

          </p>
      </div>
      <p>&nbsp;</p>
       <div class="rahmen">
          <p>
              <label for="kat2">Kategorie 2:</label>
              <select name="kat2" id="kat2">
                  <?PHP
					$sql ="select * from kategorie";
					$result = $db->query($sql);
					while($zeile = $result->fetch_assoc()){
						echo("<option value='".$zeile['kid']."'>".$zeile['kname']."</option>\n");
					}
				  
				  ?>
              </select>
          </p>
          <p>
              <span class="abstand">Menge:</span><span class="abstand">Einheiten:</span><span class="abstand">Zutat:</span><br>
              
              <?PHP
			  $sql = "select * from einheiten";
			  
			  for($t=0;$t<=5;$t++){
			  ?>
              <input type="text" name="menge2[]" value="" class="abstand" style="width: 40px;">

              <select name="einheit2[]" class="abstand">
                  
              	<?PHP
				$result = $db->query($sql);
				while($zeile = $result->fetch_assoc()){
					echo("<option value='".$zeile['ehid']."'>".$zeile['einheit_lang']."</option>\n");
				}
				
				
				?>
                 
              </select>
              
              <input type="text" name="zutat2[]" value="" class="abstand"><br>
              <?PHP
			  }
			  ?>

          </p>
      </div>
      
      <p>&nbsp;</p>
       <div class="rahmen">
          <p>
              <label for="kat3">Kategorie 3:</label>
              <select name="kat3" id="kat3">
                  <?PHP
					$sql ="select * from kategorie";
					$result = $db->query($sql);
					while($zeile = $result->fetch_assoc()){
						echo("<option value='".$zeile['kid']."'>".$zeile['kname']."</option>\n");
					}
				  
				  ?>
              </select>
          </p>
          <p>
              <span class="abstand">Menge:</span><span class="abstand">Einheiten:</span><span class="abstand">Zutat:</span><br>
              
              <?PHP
			  $sql = "select * from einheiten";
			  
			  for($t=0;$t<=5;$t++){
			  ?>
              <input type="text" name="menge3[]" value="" class="abstand" style="width: 40px;">

              <select name="einheit3[]" class="abstand">
                  
              	<?PHP
				$result = $db->query($sql);
				while($zeile = $result->fetch_assoc()){
					echo("<option value='".$zeile['ehid']."'>".$zeile['einheit_lang']."</option>\n");
				}
				
				
				?>
                 
              </select>
              
              <input type="text" name="zutat3[]" value="" class="abstand"><br>
              <?PHP
			  }
			  ?>

          </p>
      </div>



      <p>
          <label for="beschreibung">Beschreibung:</label>
          <textarea name="beschreibung" id="beschreibung"></textarea>
      </p>
      <p>
          <label for="bild">Rezeptbild:</label>
          <input type="file" name="bild" id="bild" value="" accept="image/jpeg,image/png">
      </p>

      <p>
          <input type="submit" name="submit">
      </p>
      
      
  </form>
    <?PHP
    $result->free();
    $db->close();
    unset($eintrag,$sql,$db,$fehler);
    ?> 
</body>
</html>