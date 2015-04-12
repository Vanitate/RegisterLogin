<?php
require_once dirname(__FILE__)."/config.php";

if (isset($_POST['submit'])) {

    $select = mysql_query("SELECT `jmeno` FROM `uzivatele` WHERE `jmeno`='".addslashes($_POST['jmeno'])."'");

    if (!eregi("^[_a-z0-9\.\-]*$", $_POST['jmeno']) || !eregi("^[_a-z0-9\.\-]*$", $_POST['heslo'])) { # kontrola jmena a hesla regularnim vyrazem
        $message = "Neplatné znaky v některém z polí jména nebo hesla.";
    } else if (!eregi("^[_a-zA-Z0-9\.\-]+@[_a-zA-Z0-9\.\-]+\.[a-zA-Z]{2,4}$", $_POST['email'])) { # kontrola mailu regularnim vyrazem
        $message = "Zadejte platný e-mail.";
    } else if ($_POST['heslo'] != $_POST['heslo2']) { # potvrzeni hesla
        $message = "Hesla se neshodují";
    } else if (mysql_num_rows($select)>0) { # zkontrolujeme, zda-li v databazi uz nemame stejneho uzivatele
        $message = "Zvolte jiné uživatelské jméno.";
    } else { # ulozime udaje - prava i aktivni nastavime na 1
        $_POST['heslo'] = md5($_POST['heslo']); # poznamka : md5 opravdu NENI zpetne desifrovatelna
        mysql_query("INSERT INTO `uzivatele` VALUES('', '{$_POST['jmeno']}', '{$_POST['heslo']}', '{$_POST['email']}', 1, 1)");
        header("Location: ./register.php?ok");
    }

}
isset($_GET['ok']) ? # pouze titulek
    $title = "Registrace proběhla úspěšně." :
    $title = "Registrace uživatele";
###############################################################################################HTML#######################################################
?>
<!DOCTYPE html> 
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="cs" lang="cs"> 
<head>
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" media="screen" href="form_style.css" >
  <title><?php echo $title ?></title>
</head>
<body>

<ul>
  <li>Jméno a heslo se smí skládat pouze z alfanumerických znaků, pomlčky, podtržítka a tečky.</li> 
  <li>Nepoužívejte diakritiku.</li>
  <li>U všech polí je maximální délka 30 znaků.</li>
</ul>

<form action="#" method="post" class="contact_form">
  <fieldset>
    <legend><b><?php echo isset($message) ? $message : $title ?></b></legend>
    <ul>
      <li>
        <label>Jméno(Nick):</label>
        <input class="text" name="jmeno" size="20" maxlenght="30" tabindex="1" type="text" value="<?php echo isset($_POST['jmeno']) ? $_POST['jmeno'] : '' ?>"  required/>
      </li>
      <li>
        <label>Email:</label>
        <input class="text" name="email" size="20" maxlenght="30" tabindex="2" type="text" value="<?php echo isset($_POST['email']) ? $_POST['email'] : '' ?>" required/>
        <span class="form_hint">formát: "něco@něco.doména"</span>
      </li>
      <li>
        <label>Heslo:</label>
        <input class="text" name="heslo" size="20" maxlenght="30" tabindex="3" type="password" required/>
      </li>
      <li>
        <label>Heslo znovu:</label>
        <input class="text" name="heslo2" size="20" maxlenght="30" tabindex="4" type="password" required/>
      </li>
      <li>
        <input style="height:50px" class="btn-style" name="submit" type="submit" tabindex="5" value=" registrovat &raquo; " />
      </li> 
    </ul>
    
  </fieldset> 
</form>

<p><a class="btn-style" href="./login.php">Přihlásit</a></p>
  
</body>
</html>