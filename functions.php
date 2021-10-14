<?php

require_once "config.php";

//---------Comprobar usuario----------------------------------
function comprobarToken($user_id, $token_id){
    try {
        $conn = conectar();
        $token = $conn->prepare("select id from users where token = '$token_id' ");
        $token->execute();
        $exist = $token->fetch();
        if($exist['id']!= $user_id){     	 
             //borramos las cookies();
            setcookie("userCookie","", time() - 3600, "/");
            setcookie("userToken", "", time() - 3600, "/"); 
// Te redirecciona a el login 
            header("location: usuarios/login.php"); 
        }
    } catch (Exception $ex) {
        //echo $ex->getMessage();
    }
}