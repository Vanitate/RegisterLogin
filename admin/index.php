<?php
require_once dirname(__FILE__)."/../config.php";

function unauth_header() { # pouze presmerovani
    header("Location: ../login.php?code=401", 401);
    die();
}

function check_user() { # kontrola uzivatele
    if ( isset($_SESSION['jmeno']) && isset($_SESSION['heslo']) && isset($_SESSION['prava']) ) {
        $select = mysql_query("SELECT `id` FROM `uzivatele` WHERE `jmeno`='{$_SESSION['jmeno']}' AND `heslo`='{$_SESSION['heslo']}'") or die (mysql_error());
        $udaje = mysql_fetch_assoc($select);
        if (mysql_num_rows($select)!=1) { unauth_header(); }
    } else {
        unauth_header();
    }
} 

check_user();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs"> 
<head>

 <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
 <link type="text/css" rel="stylesheet" href="style.css">
 <title>Administrace</title>

</head>
<body>

 <div>
	<script>
  (function() {
    var cx = '007671059957589478493:wi1m22rbbim';
    var gcse = document.createElement('script');
    gcse.type = 'text/javascript';
    gcse.async = true;
    gcse.src = (document.location.protocol == 'https:' ? 'https:' : 'http:') +
        '//www.google.com/cse/cse.js?cx=' + cx;
    var s = document.getElementsByTagName('script')[0];
    s.parentNode.insertBefore(gcse, s);
  })();
</script>
<gcse:search></gcse:search>
</div>
 <h5>Nyní jste v administraci, přihlášen jako <b><?php echo $_SESSION['jmeno'] ?></b>.</h5>
 




 <p><a href="../login.php?logout">Odhlásit</a></p>

</body>
</html>