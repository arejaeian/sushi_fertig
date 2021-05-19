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
      <h1>Kontakt</h1>
        <?PHP
        //spam tester
        $xml = simplexml_load_file("https://www.stopforumspam.com/api?ip=".urlencode($_SERVER['REMOTE_ADDR']));
        if($xml->appears != "yes"){
        ?>
        <div class="rahmen form">
            <p>
                Hier kannst Du mir eine Nachricht zukommen lassen.<br>Die <strong><span style="color: rgba(249,128,128,1.00);">Rot markierten Felder</span></strong> musst Du leider ausfüllen damit ich Dir auch Antworten kann.<br><br><strong>Es werden keine Daten von Dir gespeichert!</strong>
            </p>
            <form action="" method="post" accept-charset="UTF-8" autocomplete="off">
                <p>
                    <span class="breite"><label for="vname">Vorname:</label>
                    <input type="text" id="vname" name="vname" value="" autofocus></span>
                    <span class="breite"><label for="nname">Nachname:</label>
                    <input type="text" id="nname" name="nname" value=""></span>
                </p>
                <p>
                    <span class="breite"><label for="mail">eMail:</label>
                    <input type="email" id="mail" name="mail" value="" required></span>
                </p>
                <br clear="all">
                <p>
                    <span class="breite"><label for="nachricht">Nachricht:</label>
                    <textarea id="nachricht" name="nachricht" required></textarea></span>
                </p>
                <br clear="all">
                <p>
                    <input type="submit" name="submit">
                </p>
            </form>
        </div>
        <?PHP
        }else{
        ?>
        <p>Leider konnte das Formular nicht angezeigt werden!</p>
        <?PHP
        }
        ?>
    </section>
  </article>
</main>
<?PHP
    include("inc/fuss".PHPEND);
?>
</body>
</html>
