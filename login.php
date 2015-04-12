<?php 
require_once dirname(__FILE__)."/config.php";

if (isset($_POST['submit'])) {

    $select = mysql_query("SELECT `jmeno`,`heslo`,`prava` FROM `uzivatele` WHERE `jmeno`='".addslashes($_POST['jmeno'])."' AND `heslo`='".md5(trim($_POST['heslo']))."'") or die (mysql_error());
    $udaje = mysql_fetch_assoc($select);

    if (mysql_num_rows($select)==1) { # pokud je zadano platne jmeno a heslo
        session_regenerate_id(); # osetreni session stealing
        $_SESSION['jmeno'] = $_POST['jmeno']; # nastavime sessiony
        $_SESSION['heslo'] = md5($_POST['heslo']);
        $_SESSION['prava'] = $udaje['prava'];
        header("Location: ./admin/index.php");
    } else { # pokud je neco spatne, zasleme chybovy kod
        header("Location: ./login.php?code=401", 401);
    } 
    
}

if (isset($_GET['logout'])) { # odhlasime se
    unset($_SESSION['jmeno']);
    unset($_SESSION['heslo']);
    unset($_SESSION['prava']);
    session_destroy();
}

isset($_GET['code']) && $_GET['code']=="401" ? # pouze titulek
   $title = "Neautorizovaný přístup (Chyba 401)" :
   $title = "Přihlášení";
?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs"> 
<head>
  <link rel="stylesheet" media="screen" href="form_style.css" >
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <title><?php echo $title ?></title>
 
</head>
<body>

<form action="#" method="post" class="contact_form">
  <fieldset>
  <legend><b><?php echo $title ?></b></legend>
    <ul>
      <li>
        <label>Jméno:</label>
        <input class="text" name="jmeno" size="20" tabindex="1" type="text" required/>
      </li>
      <li>
        <label>Heslo:</label>
        <input class="text" name="heslo" size="20" tabindex="2" type="password" required/>
      </li>
      <li>
        <input style="height:50px" class="btn-style" name="submit" type="submit" tabindex="3" value=" přihlásit &raquo; " />
      </li>
    </ul>
  </fieldset> 
</form>
  
<?php if (isset($_GET['logout'])) { ?> 
  
  <p>Byli jste odhlášeni ze systému.</p>
  
<?php } ?>
  
<p><a class="btn-style" href="./register.php">Zaregistrovat</a></p>
  
</body>
</html>