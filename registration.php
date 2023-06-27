<?php 
include "create.php";


session_start();
if(isset($_SESSION["user"])){
    header("location: index.php");
}


if(isset($_POST["submit"])){
    $name = $_POST["name"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $re_password = $_POST["re-password"];

    $passwordHash= password_hash($password, PASSWORD_DEFAULT);
    $errors = array();

    if(empty($name) OR empty($email) OR empty($password) OR empty($re_password) ){
      array_push($errors, "all field must filled <br>");
    }
    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
      array_push($errors, "ENTER VALID EMAIL <br>");
    }
    if(strlen($password)<2){
      array_push($errors, "password greater than 2 <br>");
    }
    if($password!==$re_password){
      array_push($errors, "password is not same <br>");
    }
    $sql = "SELECT * FROM customer WHERE email = '$email'";
    $result = mysqli_query($connection, $sql);
    $countRows = mysqli_num_rows($result);
    if($countRows>0){
      array_push($errors, "Email already exist <br>");
    }

    if (count($errors)>0) {
      foreach ($errors as $error){
         echo $error;
      }
    }


    else{
      $sql = "INSERT INTO customer(id, username, email, password) VALUES (NULL,'$name','$email','$passwordHash')";

    $result = mysqli_query($connection, $sql);
    if ($result) {
      header("Location: login.php?msg=New record created successfully");
   } else {
      echo "Failed: " . mysqli_error($connection);
   }
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
                 
                 <input type = "text" class= "form-control" name= "name" placeholder="full name">
          </div>

          <div class= "form-group">    
                
               <input type = "email" class= "form-control" name= "email" placeholder="Email">
               
          </div> 
          <div class= "form-group">    
            
               <input type = "password" class= "form-control" name= "password" placeholder="Password">
          </div> 
          <div class= "form-group">    
                
               <input type = "password" class= "form-control" name= "re-password" placeholder="Confrim Password">
         </div>

        <br>

        <input type ="submit" class= "btn" name ="submit" value = "Login">
        <p>Already Have an Account  <a href = login.php>Login </a> </p>

        </form> 
      </div>
      
    </div>
        
   
   
   
</body>

</html>
