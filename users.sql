CREATE TABLE `uzivatele` (
    `id` int(10) unsigned NOT NULL auto_increment,
    `jmeno` varchar(255) NOT NULL COLLATE utf8_czech_ci,   
    `heslo` varchar(255) NOT NULL,
    `email` varchar(255) NOT NULL COLLATE utf8_czech_ci,
    `prava` int(10) unsigned NOT NULL DEFAULT '1', 
    `aktivni` int(10) unsigned NOT NULL DEFAULT '1',
    PRIMARY KEY  (`id`),
    UNIQUE (`jmeno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci AUTO_INCREMENT=0 ;