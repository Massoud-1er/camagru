#!/usr/bin/php
<?php

$msg = "une de vos photos a été commenté, allez vite vous connecter pour le voir, connard";
$msg = wordwrap($msg, 35, "\r\n");
$header = "From: mmovahhe  <mmovahhe@e3r11p15.42.fr>"."\n";
$header.= "Reply-to: \"mass\" <monsieurmassoud@gmail.fr>"."\n";
$header.= "MIME-Version: 1.0"."\n";
$sub = "fricouille";

mail("jdesclercs@gmail.com", $sub, $msg, $header);


?>