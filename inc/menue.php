<div id="hmenue" class="stik">
    <?PHP
    $db2 = new mysqli(HOST,USER,PASS,DBANK);
	if ($db2->connect_errno) {
		die('Sorry - gerade gibt es ein Problem: '.$db2->connect_error);
	}
    ?>
  <nav>
      <input type="checkbox" id="responsive-nav">
    <label for="responsive-nav" class="responsive-nav-label"><span>&#9776;</span>Navigation</label>
    <ul>
      <li><a href="index.php">Hauptseite</a></li>
      <li><a href="javascript:;">Sushi Arten</a>
        <ul>
            <?PHP
            $sql = "select * from sushiarten";
            $eintrag = $db2->query($sql);
            while($zeile = $eintrag->fetch_assoc()){
                echo("<li><a href='rezepte_auswahl.php?sushi=".$zeile['sid']."'>".$zeile['art']."</a></li>");
            }
            ?>
        </ul>
      </li>
      <li><a href="javascript:;">Ernährung</a>
        <ul>
            <?PHP
            $sql = "select * from erneahrung";
            $eintrag = $db2->query($sql);
            while($zeile = $eintrag->fetch_assoc()){
                echo("<li><a href='rezepte_auswahl.php?ern=".$zeile['eid']."'>".$zeile['rart']."</a></li>");
            }
            ?>
        </ul>
      </li>
      <li><a href="javascript:;">Anlass</a>
        <ul>
            <?PHP
            $sql = "select * from anlass";
            $eintrag = $db2->query($sql);
            while($zeile = $eintrag->fetch_assoc()){
                echo("<li><a href='rezepte_auswahl.php?an=".$zeile['aid']."'>".$zeile['aname']."</a></li>");
            }
            ?>
        </ul>
      </li>
      <li><a href="javascript:;">Land</a>
        <ul>
            <?PHP
            $sql = "select * from laender";
            $eintrag = $db2->query($sql);
            while($zeile = $eintrag->fetch_assoc()){
                if($zeile['land'] == "Alle"){
                    echo("<li><a href='rezepte_auswahl.php'>".$zeile['land']."</a></li>");
                }else{
                    echo("<li><a href='rezepte_auswahl.php?land=".$zeile['lid']."'>".$zeile['land']."</a></li>");
                }
                
            }
            ?>
        </ul>
      </li>
        <li><a href="kontakt.php">Kontakt</a></li>
    </ul>
  </nav>
</div>
<?PHP
    $eintrag->free();
    $db2->close();
    
    unset($db2,$eintrag,$zeile);
?>