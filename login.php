<?php

session_start();
if(isset($_SESSION["user"])){
    header("location: index.php");
}


include "create.php";
if(isset($_POST['submit'])){
    $email = $_POST["email"];
    $password = $_POST['password'];

    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($connection,$sql);

    $user = mysqli_fetch_array($result, MYSQLI_ASSOC);

    if($user){
        if(password_verify($password,$user['password'])){
            session_start();
            $_SESSION["user"] = "yes";
            header("Location: dashbord.php");
            die();
        }
        else{
            echo "password doesnot match";
        }
       } 
    else{
        echo "EMAil does not exist";
    }
        
    

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   

   <title>login</title>

   <link rel="stylesheet" href = "register.css">
   <link rel="stylesheet" href = "boxicons/css/boxicons.css">
</head>

<body>

<div class= "container" >
      <div class="form"> <form method = "post" value=>
            
         
         <div class= "form-group">    
                
               <input type = "email" class= "form-control" name= "email" placeholder="Email">
               
         </div> 
         <div class= "form-group">    
            
               <input type = "password" class= "form-control" name= "password" placeholder="Password">
         </div> 
        <br>

        <input type ="submit" class= "btn" name ="submit" value = "Login">
        <p>Not Registered Yet <a href = registration.php>Register </a> </p>

        </form> 
      </div>
      
    </div>
        
   
   
   
</body>

</html>