<?php
session_start();
if(isset($_POST['submit'])){
include_once 'includes/config.php';
$name =  $_POST['name'];
$username = $_POST['username'];
$email =  $_POST['email'];
$password = $_POST['password'];
$cpassword = $_POST['cpassword'];
$request=0;


$emailquery = "SELECT * FROM register WHERE email='$email' ";
$query = mysqli_query($conn, $emailquery);

$emailcount = mysqli_num_rows($query);
if($emailcount>0){
    $_SESSION['stat'] = "Email already exists!";
    header("Location: /noteapp/reg.php");
}
else{

    if($password === $cpassword){

$stmt = $conn->prepare("insert into register(name, username, email, password, cpassword) 
                        values(?,?,?,?,?)");
$stmt->bind_param("sssss",$name,$username,$email,$password,$cpassword );
$stmt->execute();

$s = $conn->prepare("insert into Profile(Name, Username, Email, request) 
                        values(?,?,?,?)");
$s->bind_param("ssss",$name,$username,$email,$request);
$s->execute();


$_SESSION['state'] = "Registration completed successfully";
header("Location: /noteapp/index.php");
$s ->close();
$stmt ->close();
$conn->close();
    }
    else{
        $_SESSION['sta'] = "Passwords are not matching!";
        header("Location: /noteapp/reg.php");
    }
}
} 
?>