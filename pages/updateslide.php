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
    <title>Update Slide</title>
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
    <?php
    $id = $_GET['id'];
    $query=mysqli_query($conn, "SELECT * FROM slide WHERE id='$id'");
    while($row=mysqli_fetch_array($query)){
    ?>
    <h2>Update Slide</h2>
    <div class="first">
            <form action="updateslide.php" method="POST" enctype="multipart/form-data">                
                <h4 style="text-align:center">QUESTIONS</h4>
                <label>Id : </label><br>
                <input type="text" name="id" value="<?php echo $id ?>" readonly><br><br>
                <label>Course Code : </label><br>
                <input type="text" name="cc" value="<?php echo $row['coursecode']; ?>"><br><br>
                <label>Course : </label><br>
                <input type="text" name="c" value="<?php echo $row['course']; ?>"><br><br>
                <label>Lecture : </label><br>
                <input type="text" name="lec" value="<?php echo $row['lecture']; ?>"><br><br>
                <label>Topic : </label><br>
                <input type="text" name="top" value="<?php echo $row['topic']; ?>"><br><br>
                <label>Slide : </label><br>
                <input type="file" name="newslide" >
                <input type="hidden" name="oldslide" value="<?php echo $row['slide']; ?>"><br><br>
                <input type="submit" name="update" value="Update" class="btn">
            </form>
    </div>
    <?php 
    }
    ?>
</body>
</html>
<?php
    if(isset($_POST["update"]))
    {
        $coursecode=$_POST["cc"];
        $course=$_POST["c"];
        $lecture=$_POST["lec"];   
        $topic=$_POST["top"];       
        $id=$_POST["id"];
        $newslide=$_FILES["newslide"]["name"];
        $oldslide=$_POST["oldslide"];

        if($newslide != '')
        {
            $up_slide = $_FILES["newslide"]["name"];
        }
        else{
            $up_slide = $oldslide;
        }

        $upload_dir=__DIR__ . "/../uploads/Slide";

        if($_FILES["newslide"]["name"] != '')
        {
            if(file_exists($upload_dir.'/'.$_FILES["newslide"]["name"]))
            {
                $sql1 ="UPDATE slide SET coursecode='$coursecode',course='$course',lecture='$lecture',topic='$topic',slide='$up_slide' WHERE id='$id'";
                $data=mysqli_query($conn,$sql1);
                if($data)
                {
                    echo"<script>alert('Slide already exists');</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/resources.php?code=<?php echo $coursecode ?>">
                    <?php
                }
                else
                {
                    echo"<script>alert('Something went wrong please try again later');</script>";
                }
            }

            else
            {
                move_uploaded_file($_FILES["newslide"]["tmp_name"],$upload_dir.'/'.$_FILES["newslide"]["name"]);
                unlink($upload_dir.'/'.$oldslide);
                $sql ="UPDATE slide SET coursecode='$coursecode',course='$course',lecture='$lecture',topic='$topic',slide='$up_slide' WHERE id='$id'";
                $data=mysqli_query($conn,$sql);
                if($data)
                {
                    echo"<script>alert('You have successfully updated the data');</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/resources.php?code=<?php echo $coursecode ?>">
                    <?php  
                } 
                else
                {
                    echo"<script>alert('Something went wrong please try again later');</script>";
                }    
            }
        }
        else
        {
            $sql ="UPDATE slide SET coursecode='$coursecode',course='$course',lecture='$lecture',topic='$topic',slide='$up_slide' WHERE id='$id'";
            $data=mysqli_query($conn,$sql);

            if($data)
            {
                echo"<script>alert('You have successfully updated the data');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/resources.php?code=<?php echo $coursecode ?>">
                <?php
            }
            else{
                echo"<script>alert('Something went wrong please try again later');</script>";
            }
        }
    }
?>