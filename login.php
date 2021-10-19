<?php

// Include config file
require_once "config.php";

// Define variables and initialize with empty values
$username = $password = "";
$username_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Verifica si el usuario esta vacio 
    if(empty(trim($_POST["username"]))){
        $username_err = "Debe escribir su email.";
    } else{
        $username = trim($_POST["username"]);
    }
    
    // Verifica si la constraseña esta vacia
    if(empty(trim($_POST["password"]))){
        $password_err = "Es necesario un password.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    // Validar usuario y contraseña 
    if(empty($username_err) && empty($password_err)){
        
        $sql = "SELECT id, username, password,token FROM users WHERE username = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "s", $param_username);
            
            
            $param_username = $username;
            
           
            if(mysqli_stmt_execute($stmt)){
                
                mysqli_stmt_store_result($stmt);
                
              
                if(mysqli_stmt_num_rows($stmt) == 1){                    
                    
                    mysqli_stmt_bind_result($stmt, $id, $username, $db_password,$usertoken);
                    if(mysqli_stmt_fetch($stmt)){
                        //echo $id. $username. $db_password;
                        if($password == base64_decode($db_password)){
                            $caducidad = $year = 60 * 60 * 24 * 365 + time();
                            setcookie('userCookie', $id, $caducidad,'/' );
                            setcookie('userToken', $usertoken, $caducidad,'/' );

                            //Te redirecciona a la pagina del usuario 
                            header("location: ../index.php");
                        }else{
                            //Mostrara un mensaje si la contraseña no es valida
                            $password_err = "El password no es válido.";
                        }
                    }
                } else{
                    // Mostrara un mensaje de que el usuario no existe 
                    $username_err = "No existe este usuario.";
                }
            } else{
                echo "Ha habido un error, inténtelo más tarde.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous"> 
    <link rel="stylesheet" type="text/css" href="form.css">
</head>
<body>

    <!-- LOGIN DE USUARIO -->
    <div class="wrapper">
        <h2>Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                <label class="form-label">Email</label>
                <input type="email" name="username" class="form-control" value="<?php echo $username; ?>">
                <span class="help-block"><?php echo $username_err; ?></span>
            </div>    
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label class="form-label">Contraseña</label>
                <input type="password" name="password" class="form-control">
                <span class="help-block"><?php echo $password_err; ?></span>
            </div> <br>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Loguearse</button>
            </div>
            <!-- SI NO TIENES CUENTA TE REDERIGIRA A REGISTRO -->
            <p>No tienes una cuenta? <a href="register.php">Registrarse</a>.</p>
        </form>
    </div> 

</body>
</html>