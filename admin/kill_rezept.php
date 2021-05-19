<?PHP
session_start();
include("../inc/const.php");

if(!isset($_SESSION['login'])){
    session_destroy();
    header("location: login".PHPEND);
}

$db = new mysqli(HOST,USER,PASS,DBANK);

if ($db->connect_errno) {
    die('Sorry - gerade gibt es ein Problem: '.$db->connect_error);
}

$fehler[] = array();
$erfolg[] = array();


if(isset($_POST['kill']) && !empty($_POST['kill'])){
    $rid = (int)$_POST['rid'];
    if(!empty($rid)){
        // Bilder auslesen und löschen
        $sql = "select * from bilder where rid = $rid";
        $eintrag = $db->query($sql);
        while($zeile = $eintrag->fetch_assoc()){
            @unlink("../".$zeile['pfad']);
        }
        
        $sql = "delete from bilder where rid = $rid";
        $db->query($sql);
        
        $sql = "delete from zutaten where rid = $rid";
        $db->query($sql);
        
        $sql = "delete from rezepte where rid = $rid";
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
<title>Rezept Löschen</title>

<style type="text/css">
    @import url("css/standart.css");
    @import url("css/menue.css");
</style>
</head>

<body>
    <?PHP
    include("inc/menue".PHPEND);
    ?>
    <main>
      <article class="links" style="width: 600px;">
            <section>
            <h1>Vorhandene Rezepte</h1>
            <?PHP
                
                if(in_array("4",$fehler)){
                    echo("<p class='fehler'>Rezept konnte nicht gelöscht werden!</p>\n");
                }
                
                if(in_array("2",$erfolg)){
                    echo("<p class='erfolg'>Rezept wurde gelöscht.</p>\n");
                }

            $sql = "select * from rezepte";
            $eintrag = $db->query($sql);
            if($eintrag->num_rows){
                while($zeile = $eintrag->fetch_assoc()){
                    echo('<form method="post" action="'.$_SERVER['PHP_SELF'].'" enctype="multipart/form-data" accept-charset="UTF-8">'."\n");
                    
                    echo("<span class='breite' style='width: 500px;'>".$zeile['rezeptname']."</span>\n");
                    echo('<input type="hidden" name="rid" value="'.$zeile['rid'].'">'."\n");
                    echo('<input type="submit" name="kill" value="Löschen">'."\n");
                    echo("</form>\n");
                }
            }else{
                echo("<p>Leider noch kein Rezept vorhanden.</p>\n");
            }

            
            ?>
            </section>
        </article>
    </main>
    <?PHP
    $db->close();
    unset($sql,$db,$fehler,$erfolg);
    ?> 
</body>
</html>