<?php
session_start();
error_reporting(0);
include_once '../includes/config.php';
    
    
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Topic</title>
    <style>
         body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;

        }
        h2{
            text-align:center;
            color:pink;
            letter-spacing:1px;
        }
        .first{
            width:40%;
            min-height:80vh;
            overflow:hidden;
            color:white; 
            background-color:black;
            align-items:center; 
            margin:0 100px 100px 350px;   
            border-radius:30px;        
        }
        form{
            margin:5% 12% 5% 8%;
            align:center;
            border:3px solid white;
            border-radius:15px;
            width:80%;
            padding:10px 5px;
        }
        label{
            text-align:left;
            color: Aquamarine;
            margin-left:10%;
        }
        input{
            width:80%;
            height:20px;
            border: 2px solid #fff;
            background: white;
            color: black;
            border-radius:15px 0 15px 0;
            margin:0 10% 0 10%;
        }
        .btn{
            
            border: 0 solid Aquamarine;
            display: block;
            height: 25px;
            line-height: 20px;           
            text-align: center;
            background: Aquamarine;
            color: black;
            margin: 15px 25% 0 25%;
            cursor: pointer;
            text-decoration:none;
            letter-spacing:1px;
            font-weight: bold;
            font-size: 15px;
            width:50%;
        }
    </style>
</head>
<body>
    <h2>Update Important Topic</h2>
    <div class="first">
            <form action="updateimp.php" method="GET" enctype="multipart/form-data">
                <h4 style="text-align:center">TOPICS</h4>
                <label>Id : </label><br>
                <input type="text" name="id" value="<?php echo $_GET['id'];?>" readonly><br><br>
                <label>Course Code : </label><br>
                <input type="text" name="cc" value="<?php echo $_GET['cc'];?>"><br><br>
                <label>Course : </label><br>
                <input type="text" name="sub" value="<?php echo $_GET['c'];?>"><br><br>
                <label>Chapter Name : </label><br>
                <input type="text" name="chn" value="<?php echo $_GET['chp'];?>"><br><br>
                <label>Topic Name : </label><br>
                <input type="text" name="top" value="<?php echo $_GET['to'];?>"><br><br>
                <input type="submit" name="submit" class="btn">
            </form>
    </div>
</body>
</html>
<?php
    if(isset($_GET["submit"])){
        $coursecode=$_GET["cc"];
        $subject=$_GET["sub"];
        $chapter=$_GET["chn"];
        $topic=$_GET["top"];                 
        $id=$_GET["id"];
        $sql ="UPDATE important SET coursecode='$coursecode',course='$subject',chapter='$chapter',topic='$topic' WHERE id='$id'";

        if(mysqli_query($conn,$sql)){
            echo"<script>alert('You have successfully updated the data');</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/important.php?code=<?php echo $coursecode ?>">
            <?php
        }
        else{
            echo"<script>alert('Something went wrong please try again later');</script>";
        }
    }
?>