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
    $anlass = $_POST['anlass'];
    if(strlen($anlass) <= 4){
        $fehler[] += 1;
    }else{
        // prüfen ob eintrag schon vorhanden
        $sql = "select aid from anlass where lower(aname) = lower('$anlass') limit 1";
        $eintrag = $db->query($sql);
        if($eintrag->num_rows){
            $fehler[] += 3;
        }else{
            $sql = "insert into anlass (aname) values ('$anlass')";
        
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
    $aid = $_POST['aid'];
    if(!empty($aid)){
        $sql = "delete from anlass where aid = '$aid'";
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
<title>Eingabe Anlass</title>

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
            <h1>Vorhandene Anlässe</h1>
            <?PHP
                
                if(in_array("4",$fehler)){
                    echo("<p class='fehler'>Anlass konnte nicht gelöscht werden!</p>\n");
                }
                
                if(in_array("2",$erfolg)){
                    echo("<p class='erfolg'>Anlass wurde gelöscht.</p>\n");
                }

            $sql = "select * from anlass";
            $eintrag = $db->query($sql);
            if($eintrag->num_rows){
                while($zeile = $eintrag->fetch_assoc()){
                    echo('<form method="post" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" accept-charset="UTF-8">'."\n");
                    
                    echo("<span class='breite'>".$zeile['aname']."</span>\n");
                    echo('<input type="hidden" name="aid" value="'.$zeile['aid'].'">'."\n");
                    echo('<input type="submit" name="kill" value="Löschen">'."\n");
                    echo("</form>\n");
                }
            }else{
                echo("<p>Leider noch kein Anlass vorhanden.</p>\n");
            }

            
            ?>
            </section>
        </article>
      <article class="rechts">
            <section>
                <h1>Eingabe Anlass</h1>
                <?PHP
                
                if(in_array("1",$fehler)){
                    echo("<p class='fehler'>Der Anlass ist zu kurz!</p>\n");
                }
                
                if(in_array("2",$fehler)){
                    echo("<p class='fehler'>Anlass konnte nicht in die DB geschriben werden!</p>\n");
                }
                
                if(in_array("3",$fehler)){
                    echo("<p class='fehler'>Diesen Eintrag gibt es schon!</p>\n");
                }
                
                if(in_array("1",$erfolg)){
                    echo("<p class='erfolg'>Anlass wurde hinzugefügt.</p>\n");
                }
                
                ?>
              <form method="post" action="<?PHP $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" accept-charset="UTF-8">

                  <p>
                      <label for="anlass">Anlass:</label>
                      <input type="text" name="anlass" id="anlass" value="">
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