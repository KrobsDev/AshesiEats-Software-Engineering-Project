<?php
session_start();
$Name="";
$Email="";
$errors=array();

$db = mysqli_connect('localhost','root','','sep');

if(isset($_POST['submit'])){
    $Name = $_POST['Name'];
    $email = $_POST['Email'];
    $password_1 = $_POST['password_1'];
    $password_2 = $_POST['password_2'];

    if (empty($Name)) {
        array_push($errors, "Fill Username");
    }
    if (empty($email)) {
        array_push($errors, "Fill email");
    }
    if (empty($password_1)) {
        array_push($errors, "Fill password");
    }
    if ($password_1 != $password_2) {
        array_push($errors,"Password do not match"); 
    }
    else {
        $password=md5($password_1);
        $sql="INSERT INTO signup (Name,Email,password) VALUES ('$Name','$email','$password')";

        mysqli_query($db,$sql);
        header('location:index.php');
        
        
    }
}

if(isset($_POST['Login'])){
    $Name = $_POST['Name'];
    $password = $_POST['password'];

    if (empty($Name)) {
        array_push($errors, "Username Required");
    }
    if (empty($password)) {
        array_push($errors, "Password Required");
    }
    
    if (count($errors)==0) { 
        $password=md5($password);
        $query="SELECT * FROM signup WHERE Name='$Name' AND password='$password'";
        
        $results1= mysqli_query($db,$query);

        
        if ($row=mysqli_fetch_array($results1)) {
            header('location:home.php');
        }
        else{
            array_push($errors,"Wrong Username or Password");
        }
    
    }
}

?>
