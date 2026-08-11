<?php
    session_start();
    error_reporting(0);
    include_once '../includes/config.php';
    
    $ID=$_GET['id'];
    $cc=$_GET['cc'];

    $query="DELETE FROM viva WHERE id='$ID'";

    $data=mysqli_query($conn,$query);

    if($data){
        echo"<script>alert('You have successfully deleted the question');</script>";
        ?>
        <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/viva.php?code=<?php echo $cc ?>">
        <?php
    }
    else{
        echo"<script>alert('Something went wrong please try again later');</script>";
    }
?>