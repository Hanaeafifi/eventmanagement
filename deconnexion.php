<?php

session_start();
session_destroy();//supprime la session complète

header("Location: login.php");
exit;

?>