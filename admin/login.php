<?PHP
    session_start();

    if (isset($_SERVER['login']) && !empty($_SESSION['loigin']) ) {
        header( 'Location: ' . $_SERVER['HTTP_REFERER'] );
    }

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Login</title>
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
        <article>
            <?PHP
            if(isset($_POST['submit']) && !empty($_POST['submit'])){
                $pw = md5($_POST['pw']);
                $nick = $_POST['nick'];
                
                $login = array();
                $login[] = "b8c311d250851d59be8eb3658c79e049";
                $login[] = "tigercrow";
                
                if($pw === $login[0] && $nick === $login[1]){
                    $_SESSION['login'] = 1;
                    header("location: eland.php");
                }else{
                    echo("<p style='color: red;'>Login feherhaft!</p>");
                }
                
            }
            ?>
            <section id="formular">
                <form action="<?PHP $_SERVER['PHP_SELF']; ?>" method="post" accept-charset="UTF-8" autocomplete="off">
                    <p>
                        <label for="nick">Nick:</label>
                        <input type="text" id="nick" name="nick" value="" autofocus required autocomplete="off">
                    </p>
                    <p>
                        <label for="pw">Passwort:</label>
                        <input type="password" id="pw" name="pw" value="" required>
                    </p>
                    <p>
                        <input type="submit" value="Login" name="submit">
                    </p>
                </form>
            </section>
        </article>
    </main>
</body>
</html>