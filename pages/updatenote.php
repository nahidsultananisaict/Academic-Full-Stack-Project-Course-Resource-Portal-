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
    <title>Update Note</title>
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
            margin:0 100px 100px 450px;   
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
    $query=mysqli_query($conn, "SELECT * FROM notes WHERE id='$id'");
    while($row=mysqli_fetch_array($query)){
    ?>
    <h2>Update Note</h2>
    <div class="first">
            <form action="updatenote.php" method="POST" enctype="multipart/form-data">                
                <h4 style="text-align:center">NOTE</h4>
                <label>Id : </label><br>
                <input type="text" name="id" value="<?php echo $id ?>" readonly><br><br>
                <label>Course Code : </label><br>
                <input type="text" name="cc" value="<?php echo $row['coursecode']; ?>"><br><br>
                <label>Course : </label><br>
                <input type="text" name="c" value="<?php echo $row['subject']; ?>"><br><br>
                <label>Topic : </label><br>
                <input type="text" name="to" value="<?php echo $row['topic']; ?>"><br><br>
                <label>Created By : </label><br>
                <input type="text" name="cb" value="<?php echo $row['created']; ?>"><br><br>
                <label>Note : </label><br>
                <input type="file" name="newnote" >
                <input type="hidden" name="oldnote" value="<?php echo $row['note']; ?>"><br><br>
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
        $topic=$_POST["to"]; 
        $created=$_POST["cb"];               
        $id=$_POST["id"];
        $newnote=$_FILES["newnote"]["name"];
        $oldnote=$_POST["oldnote"];

        if($newnote != '')
        {
            $up_note = $_FILES["newnote"]["name"];
        }
        else{
            $up_note = $oldnote;
        }

        $upload_dir=__DIR__ . "/../uploads/Note";

        if($_FILES["newnote"]["name"] != '')
        {
            if(file_exists($upload_dir.'/'.$_FILES["newnote"]["name"]))
            {
                $sql1 ="UPDATE notes SET coursecode='$coursecode',subject='$course',topic='$topic',created='$created',note='$up_note' WHERE id='$id'";
                $data=mysqli_query($conn,$sql);
                if($data)
                {
                    echo"<script>alert('File already exists');</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/notes.php?code=<?php echo $coursecode ?>">
                    <?php
                }
                else
                {
                    echo"<script>alert('Something went wrong please try again later');</script>";
                }
            }

            else
            {
                move_uploaded_file($_FILES["newnote"]["tmp_name"],$upload_dir.'/'.$_FILES["newnote"]["name"]);
                unlink($upload_dir.'/'.$oldnote);
                $sql ="UPDATE notes SET coursecode='$coursecode',subject='$course',topic='$topic',created='$created',note='$up_note' WHERE id='$id'";
                $data=mysqli_query($conn,$sql);
                if($data)
                {
                    echo"<script>alert('You have successfully updated the data');</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/notes.php?code=<?php echo $coursecode ?>">
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
            $sql ="UPDATE notes SET coursecode='$coursecode',subject='$course',topic='$topic',created='$created',note='$up_note' WHERE id='$id'";
            $data=mysqli_query($conn,$sql);

            if($data)
            {
                echo"<script>alert('You have successfully updated the data');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/notes.php?code=<?php echo $coursecode ?>">
                <?php
            }
            else{
                echo"<script>alert('Something went wrong please try again later');</script>";
            }
        }
    }
?>