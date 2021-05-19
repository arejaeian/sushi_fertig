<?PHP
session_start();
include("../inc/const.php");

if(!isset($_SESSION['login'])){
    header("location: login".PHPEND);
}

$db = new mysqli(HOST,USER,PASS,DBANK);
if ($db->connect_errno) {
    die('Sorry - gerade gibt es ein Problem: '.$db->connect_error);
}

$fehler[] = "";
$erfolg[] = "";

if(isset($_POST['submit']) && !empty($_POST['submit'])){
    $elang = $_POST['elang'];
    $ekurz = $_POST['ekurz'];
    
    if(strlen($elang) <= 3){
        $fehler[] += 1;
    }else{
        // prüfen ob eintrag schon vorhanden
        $sql = "select ehid from einheiten where lower(einheit_lang) = lower('$elang') limit 1";
        $eintrag = $db->query($sql);
        if($eintrag->num_rows){
            $fehler[] += 3;
        }else{
            $sql = "insert into einheiten (einheit_lang,einheit_kurz) values ('$elang','$ekurz')";
        
            $db->query($sql);
            if(!$db->insert_id){
                $fehler[] += 2;
            }else{
                $erfolg[] += 1;
            }
        }
    }
}


if(isset($_POST['kill']) && !empty($_POST['kill'])){
    $ehid = $_POST['ehid'];
    if(!empty($ehid)){
        $sql = "delete from einheiten where ehid = '$ehid'";
        $db->query($sql);
        if($db->affected_rows){
            $erfolg[] += 2;
        }else{
            $fehler[] += 4;
        }
    }
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eingabe Einheiten</title>

<style type="text/css">
    @import url("css/standart.css");
    @import url("css/menue.css");
</style>
</head>

<body>
    <?PHP
    include("inc/menue.php");
    ?>
    <main>
      <article class="links">
            <section>
            <h1>Vorhandene Einheiten</h1>
            <?PHP
                
                if(in_array("4",$fehler)){
                    echo("<p class='fehler'>Einheit konnte nicht gelöscht werden!</p>\n");
                }
                
                if(in_array("2",$erfolg)){
                    echo("<p class='erfolg'>Einheit wurde gelöscht.</p>\n");
                }

            $sql = "select * from einheiten";
            $eintrag = $db->query($sql);
            if($eintrag->num_rows){
                while($zeile = $eintrag->fetch_assoc()){
                    echo('<form method="post" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" accept-charset="UTF-8">'."\n");
                    
                    echo("<span class='breite'>".$zeile['einheit_lang']."</span>\n");
                    echo('<input type="hidden" name="ehid" value="'.$zeile['ehid'].'">'."\n");
                    echo('<input type="submit" name="kill" value="Löschen">'."\n");
                    echo("</form>\n");
                }
            }else{
                echo("<p>Leider noch keine Einheit vorhanden.</p>\n");
            }

            
            ?>
            </section>
        </article>
      <article class="rechts">
            <section>
                <h1>Eingabe Einheiten</h1>
                <?PHP
                
                if(in_array("1",$fehler)){
                    echo("<p class='fehler'>Die Einheit ist zu kurz!</p>\n");
                }
                
                if(in_array("2",$fehler)){
                    echo("<p class='fehler'>Die Einheit konnte nicht in die DB geschrieben werden!</p>\n");
                }
                
                if(in_array("3",$fehler)){
                    echo("<p class='fehler'>Diesen Eintrag gibt es schon!</p>\n");
                }
                
                if(in_array("1",$erfolg)){
                    echo("<p class='erfolg'>Einheit wurde hinzugefügt.</p>\n");
                }
                
                ?>
              <form method="post" action="<?PHP $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" accept-charset="UTF-8">

                  <p>
                      <label for="ekurz">Einheit Kurz:</label>
                      <input type="text" name="ekurz" id="ekurz" value="">
                  </p>
                  
                  <p>
                      <label for="elang">Einheit Lang:</label>
                      <input type="text" name="elang" id="elang" value="">
                  </p>

                  <p>
                      <input type="submit" name="submit">
                  </p>
              </form>
            </section>
        </article>
    </main>
    <?PHP
    $eintrag->free();
    $db->close();
    unset($eintrag,$sql,$db,$fehler,$erfolg);
    ?> 
</body>
</html>