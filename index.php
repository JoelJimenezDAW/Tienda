<?php
require_once "config.php";
require_once "functions.php";
// SE GUARDA EL USUARIO Y CONTRASEÑA EN LAS COOKIES
if(!isset($_COOKIE["userCookie"]) && (!isset($_COOKIE["userToken"]))){
   header("location: login.php");
    exit;
    echo $_COOKIE["userCookie"];die();
}
    $user_id = $_COOKIE["userCookie"];
    $token = $_COOKIE["userToken"];
    


?>
<!-- PAGINA PRINCIPAL DEL USUARIO -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>
    <link rel="stylesheet" href="css/bootstrap431/css/bootstrap.min.css"> 
    <link rel="stylesheet" type="text/css" href="css/fontawesome/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="style.css">
</head>


<header >
    

</header>
<body>
    <div class="header_left">
       <h1><b><?php echo htmlspecialchars($user_id); ?></b></h1>   
   </div>
   <div class="header_right">
    <h1><b><?php echo htmlspecialchars($user_id); ?></b></h1>
    </div>
    <p id="salirsession">
        <button id="btn-salirsession"><a style="text-decoration:none" href="logout.php" class="btn btn-danger">Salir de la session</a></button>
    </p>



</body>
</html>