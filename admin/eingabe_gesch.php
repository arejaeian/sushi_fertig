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
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Eingabe Hauptseite</title>
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
            
            insertdatetime_formats: ["%H:%M:%S", "%d.%m.%Y", "%I:%M:%S %p", "%D"],
            
            font_formats: 'Cambria=cambria;Arial Black=arial black,avant garde;Times New Roman=times new roman,times;Verdana=verdana;',
            fontsize_formats: '8pt 10pt 11pt 12pt 14pt 16pt 18pt 24pt 36pt',
            height: 400,

            plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak  searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking save table contextmenu directionality emoticons paste textcolor imagetools',

            toolbar: 'print undo redo | forecolor backcolor | bold italic underline alignleft aligncenter alignright blockquote numlist bullist | link image media | table emoticons visualchars',

            menubar: true,
            statusbar: true,     
            style_formats: [
              {title: 'Bild Links', selector: 'img', styles: {
                'float' : 'left',
                'margin': '0 10px 0 10px'
              }},
              {title: 'Bild Rechts', selector: 'img', styles: {
                'float' : 'right',
                'margin': '0 10px 0 10px'
              }}
            ],

            // without images_upload_url set, Upload tab won't show up
            images_upload_url: 'bsave.php',
            image_caption: true,
            image_advtab: true,
            image_title: true,


            // override default upload handler to simulate successful upload
            images_upload_handler: function (blobInfo, success, failure) {
                var xhr, formData;

                xhr = new XMLHttpRequest();
                xhr.withCredentials = false;
                xhr.open('POST', 'bsave.php');

                xhr.onload = function() {
                    var json;

                    if (xhr.status != 200) {
                        failure('HTTP Error: ' + xhr.status);
                        return;
                    }

                    json = JSON.parse(xhr.responseText);

                    if (!json || typeof json.location != 'string') {
                        failure('Fehlerhafter JSON: ' + xhr.responseText);
                        return;
                    }

                    success(json.location);
                };

                formData = new FormData();
                formData.append('file', blobInfo.blob(), blobInfo.filename());

                xhr.send(formData);
            }
        });

    </script>
</head>

<body>
    <?PHP
    include("inc/menue.php");
    ?>
    <h1>Text der Hauptseite</h1>
    
    <?PHP
    $seite = "";
    
    $sql = "select * from seiten where seite = 'index' limit 1";
    $eintrag = $db->query($sql);
    if($eintrag->num_rows){
        $zeile = $eintrag->fetch_object();
        $seite = $zeile->inhalt;
    }
    $eintrag->free();
    
    if(isset($_POST['submit']) && !empty($_POST['submit'])){
        $seite = $_POST['beschreibung'];
        if(strlen($seite) > 10){
            
            // Prüfen ob schon index da
            $sql = "select seitenid from seiten where seite = 'index' limit 1";
            $eintrag = $db->query($sql);
            if($eintrag->num_rows){
                $sql = "update seiten set inhalt = '{$seite}' where seite = 'index'";
                $eintrag = $db->query($sql);
                if($db->affected_rows){
                   echo("<p style='color: green;'>Datensatz wurde geändert!</p>");
                }else{
                    echo("<p style='color: red;'>Datensatz konnte nicht geändert werden!<br>Oder Du hast nichts geändert!</p>");
                }
                
            }else{
                $sql = "insert into seiten (seite,inhalt) values ('index','{$seite}')";
                $eintrag = $db->query($sql);
                if($db->insert_id){
                    echo("<p style='color: green;'>Datensatz wurde geschrieben!</p>");
                }else{
                    echo("<p style='color: red;'>Datensatz konnte nicht geschrieben werden!</p>");
                }
            }

        }
    }
    
    
    $db->close();
    ?>
  <form method="post" action="<?PHP $_SERVER['PHP_SELF']; ?>" enctype="multipart/form-data" accept-charset="UTF-8">
      
      <p>
          <textarea id="beschreibung" name="beschreibung"><?PHP echo($seite); ?></textarea>
      </p>

      <p>
          <input type="submit" name="submit">
      </p>
      
      
  </form>
        
</body>
</html>