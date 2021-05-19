<?PHP
    session_start();

    include("inc/const.php");
    include("inc/kopf".PHPEND);

?>
<title>Sushi Welt 寿司ワールド</title>
<style type="text/css">
@import url("css/standart.css");
@import url("css/hmenue.css");
@import url("css/slideshow.css");
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
        
        $sql = "select * from seiten where seite = 'index' limit 1";
        $eintrag = $db->query($sql);
        if($eintrag->num_rows){
            $zeile = $eintrag->fetch_assoc();
            echo(str_replace("../","",$zeile['inhalt']));
        }
        
        $eintrag->free();
        $db->close();
        unset($db,$eintrag,$zeile);
        ?>
        
    </section>
  </article>
</main>
<?PHP
    include("inc/fuss".PHPEND);
?>
</body>
</html>
