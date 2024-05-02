<?php 
include_once "inputs/database.php";

$showalert = false; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $confirm_pass = $_POST['confirm_pass'];

    $exites=false;
    $exitesSql = " select * from user where username = '$username'";
    $result = mysqli_query($conn, $exitesSql);
    $numExitesROws = mysqli_num_rows($result);
    if ($numExitesROws > 0) {
        echo "<script>alert('username is already exits'); window.location.href='login.php'; </script>";
    }
    else{
        
    if($password == $confirm_pass) {
    $hash = password_hash($password, PASSWORD_DEFAULT);
       $sql = "INSERT INTO `user` (`username`, `password`, `date`) 
       VALUES ('$username', '$hash', current_timestamp());";
       $result = mysqli_query($conn, $sql);

       if ($result) {
        $showalert = true;
       }
    }
    else{
        echo "<script>alert('dose not match your password'); window.location.href='singup.php'; </script>";
    }
    }
}
 ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <?php require "inputs/nav.php" ?>

    <?php 
    if ($showalert) {    
    echo'
    <div class="alert alert-success alert-dismissible fade show" role="alert">
  <strong>Singup successfully!</strong> You should login now.
  <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>';
    }
?>
    
    <div class="container" style="display:flex; flex-direction:column; text-align:center; justify-content:center; align-items:center;">
        <h1 class="text-center my-3">singup to our website</h1>
        <form method="POST">
            <div class="mb-3 col-md-12">
                <label for="username" class="form-label">Username</label>
                <input type="name" class="form-control" id="username" name="username" aria-describedby="emailHelp">
            </div>
            <div class="mb-3 col-md-12">
                <label for="password" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="password">
            </div>
            <div class="mb-3 col-md-12">
                <label for="confirm_pass" class="form-label">Confirm Password</label>
                <input type="password" class="form-control" name="confirm_pass" id="confirm_pass">
            </div>
           
            <button type="submit" class="btn btn-primary col-md-12">SingUp</button>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>
</body>

</html>