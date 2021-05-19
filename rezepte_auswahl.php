<?PHP
    session_start();

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
    
    <?PHP
    $db = @new mysqli(HOST,USER,PASS,DBANK);
	if ($db->connect_errno) {
		die('Sorry - gerade gibt es ein Problem: '.$db->connect_error);
	}
	
	if(isset($_GET['sushi'])){
		$sushi = $_GET['sushi'];
		$sql = "SELECT r.rid,rezeptname,a.aname,l.land,s.art,b.pfad from rezepte r,anlass a,laender l, sushiarten s,bilder b where r.aid = a.aid and r.lid = l.lid and r.sid = s.sid and r.rid = b.rid and s.sid = $sushi";
	}
	
	if(isset($_GET['ern'])){
		$ern = $_GET['ern'];
		$sql = "SELECT r.rid,rezeptname,a.aname,l.land,s.art,b.pfad from rezepte r,anlass a,laender l, sushiarten s,bilder b, erneahrung e where r.aid = a.aid and r.lid = l.lid and r.sid = s.sid and r.rid = b.rid and r.eid=e.eid and e.eid = $ern";
	}
	
	if(isset($_GET['an'])){
		$an = $_GET['an'];
		$sql = "SELECT r.rid,rezeptname,a.aname,l.land,s.art,b.pfad from rezepte r,anlass a,laender l, sushiarten s,bilder b, erneahrung e where r.aid = a.aid and r.lid = l.lid and r.sid = s.sid and r.rid = b.rid and r.eid=e.eid and a.aid = $an";
	}
	
	if(isset($_GET['land'])){
		$land = $_GET['land'];
		$sql = "SELECT r.rid,rezeptname,a.aname,l.land,s.art,b.pfad from rezepte r,anlass a,laender l, sushiarten s,bilder b, erneahrung e where r.aid = a.aid and r.lid = l.lid and r.sid = s.sid and r.rid = b.rid and r.eid=e.eid and l.lid = $land";
	}
	
	
	if(!isset($sushi) && !isset($ern) && !isset($an) && !isset($land)){
		$sql = "SELECT r.rid,rezeptname,a.aname,l.land,s.art,b.pfad from rezepte r,anlass a,laender l, sushiarten s,bilder b where r.aid = a.aid and r.lid = l.lid and r.sid = s.sid and r.rid = b.rid";
	}

	
	$eintrag = $db->query($sql);
            
	if($eintrag->num_rows){
		while($zeile = $eintrag->fetch_assoc()){
            //Bild prüfen ob leer
            $bild = $zeile['pfad'];
            if(empty($bild)){
                $bild = "img/kein_bild.jpg";
            }
            
			echo('<span class="rahmen">
            <a href="rezept.php?id='.$zeile['rid'].'" class="link" gloss="'.$zeile['art'].'">
                <img src="'.$bild.'" alt="Bild" style="width: 100px;">
            
                <h1>'.$zeile['rezeptname'].'</h1>
                <span style="color: rgb(100,100,100); font-size:10pt;">'.$zeile['land'].', '.$zeile['aname'].'</span>
          </a>
        </span>'."\n");
            
		}
		
	}else{
		echo("<p>&nbsp;</p>\n<p align='center' style='color: red;'>Es wurde kein Rezept gefunden</p>\n");
	}
	
	
	?>

    </section>
  </article>
</main>
<?PHP
    include("inc/fuss".PHPEND);

    $eintrag->free();
    $db->close();
    
    unset($db,$eintrag,$zeile);
?>
</body>
</html>
