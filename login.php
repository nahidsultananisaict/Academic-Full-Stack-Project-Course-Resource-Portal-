<?php
session_start();
if(isset($_POST['submit'])){

    include_once 'includes/config.php';

    $user=$_POST['user'];
    $username = $_POST['username'];
    $password = $_POST['password'];


    if($user == 'Admin'){
        // session
        $_SESSION["admin"]=$_POST['username'];

        $userquery = "SELECT * FROM admin WHERE username='$username'";
        $query = mysqli_query($conn, $userquery);

        $count = mysqli_num_rows($query);
        if($count>0){
            $result=mysqli_fetch_assoc($query);
            $db_pass=$result['password'];
            if($password === $db_pass)
            {
                echo"<script>alert('You have successfully logged in');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/home.php">
                <?php
            }
            else
            {
                echo"<script>alert('Something went wrong please try again later');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/index.php">
                <?php
            }
        }
        else
        {
            echo"<script>alert('Something went wrong please try again later');</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/index.php">
            <?php
        }

    }
    else
    {
        // session
        $_SESSION["username"]=$_POST['username'];
        $userquery = "SELECT * FROM register WHERE username='$username'";
        $query = mysqli_query($conn, $userquery);

        $count = mysqli_num_rows($query);
        if($count>0){
            $result=mysqli_fetch_assoc($query);
            $db_pass=$result['password'];
            if($password === $db_pass)
            {

                
                echo"<script>alert('You have successfully logged in');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/nhome.php">
                <?php
            }
            else
            {
                echo"<script>alert('Something went wrong please try again later');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/index.php">
                <?php
            }
        }
        else
        {
            echo"<script>alert('Something went wrong please try again later');</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/index.php">
            <?php
        }
    }
    }
?>