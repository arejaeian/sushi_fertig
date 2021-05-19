<?PHP
session_start();
include("../inc/const.php");

if(!isset($_SESSION['login'])){
//    header("location: login".PHPEND);
}

$db = new mysqli(HOST,USER,PASS,DBANK);
if ($db->connect_errno) {
    die('Sorry - gerade gibt es ein Problem: '.$db->connect_error);
}

$fehler[] = array();
$erfolg[] = array();

if(isset($_POST['submit']) && !empty($_POST['submit'])){
    $art = $_POST['art'];
    $info = nl2br($_POST['info']);

    if(strlen($art) <= 3){
        $fehler[] += 1;
    }else{
        // prüfen ob eintrag schon vorhanden
        $sql = "select sid from sushiarten where lower(art) = lower('$art') limit 1";
        $eintrag = $db->query($sql);
        if($eintrag->num_rows){
            $fehler[] += 3;
        }else{
            $sql = "insert into sushiarten (art,info) values ('$art','$info')";

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
    $sid = $_POST['sid'];
    if(!empty($sid)){
        $sql = "delete from sushiarten where sid = '$sid'";
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
<title>Eingabe Sushi Arten</title>

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
            <h1>Vorhandene Sushi Arten</h1>
            <?PHP

                if(in_array("4",$fehler)){
                    echo("<p class='fehler'>Sushi Art konnte nicht gelöscht werden!</p>\n");
                }

                if(in_array("2",$erfolg)){
                    echo("<p class='erfolg'>Sushi Art wurde gelöscht.</p>\n");
                }

            $sql = "select * from sushiarten";
            $eintrag = $db->query($sql);
            if($eintrag->num_rows){
                while($zeile = $eintrag->fetch_assoc()){
                    echo('<form method="post" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" accept-charset="UTF-8">'."\n");

                    echo("<span class='breite'>".$zeile['art']."</span>\n");
                    echo('<input type="hidden" name="sid" value="'.$zeile['sid'].'">'."\n");
                    echo('<input type="submit" name="kill" value="Löschen">'."\n");
                    echo("</form>\n");
                }
            }else{
                echo("<p>Leider noch keine Sushi Art vorhanden.</p>\n");
            }


            ?>
            </section>
        </article>
      <article class="rechts">
            <section>
                <h1>Eingabe Sushi Art</h1>
                <?PHP

                if(in_array("1",$fehler)){
                    echo("<p class='fehler'>Die Sushi Art ist zu kurz!</p>\n");
                }

                if(in_array("2",$fehler)){
                    echo("<p class='fehler'>Die Sushi Art konnte nicht in die DB geschrieben werden!</p>\n");
                }

                if(in_array("3",$fehler)){
                    echo("<p class='fehler'>Diesen Eintrag gibt es schon!</p>\n");
                }

                if(in_array("1",$erfolg)){
                    echo("<p class='erfolg'>Sushi Art wurde hinzugefügt.</p>\n");
                }

                ?>
              <form method="post" action="<?PHP $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" accept-charset="UTF-8">

                  <p>
                      <label for="art">Sushi Art:</label>
                      <input type="text" name="art" id="art" value="">
                  </p>
                  <p>
                      <label for="info">Info:</label>
                      <textarea name="info" id="info"></textarea>
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
