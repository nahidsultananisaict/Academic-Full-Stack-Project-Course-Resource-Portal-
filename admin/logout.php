<?php 
session_start();
if(isset($_POST['logout'])){
    session_unset();
    echo"<script>alert('You have successfully logged out');</script>";
    ?>
    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/index.php">
    <?php
}
?>