<?php
// Inicia la session del usuario
session_start();
 

$_SESSION = array();
 
// Cierra la session del usuario 
session_destroy();

 
// Te redirecciona a el login
header("location: login.php");
exit;
?>