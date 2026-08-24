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
            margin: 15px 25% 15px 25%;
            cursor: pointer;
            text-decoration:none;
            letter-spacing:1px;
            font-weight: bold;
            font-size: 15px;
            width:50%;
        }
        Textarea{
            width:80%;
            height:30px;
            margin-left:40px;
            border: 2px solid #fff;
            background: white;
            color: black;
            border-radius:15px 0 15px 0;
        }
    </style>
</head>
<body>
    <?php
    $id = $_GET['id'];
    $query=mysqli_query($conn, "SELECT * FROM viva WHERE id='$id'");
    while($row=mysqli_fetch_array($query)){
    ?>
    <h2>Update Viva Question</h2>
    <div class="first">
            <form action="updateviva.php" method="POST" enctype="multipart/form-data">                
                <h4 style="text-align:center">QUESTIONS</h4>
                <label>Id : </label><br>
                <input type="text" name="id" value="<?php echo $id ?>" readonly><br><br>
                <label>Course Code : </label><br>
                <input type="text" name="cc" value="<?php echo $row['coursecode']; ?>"><br><br>
                <label>Course : </label><br>
                <input type="text" name="c" value="<?php echo $row['course']; ?>"><br><br>
                <label>Question : </label><br>
                <Textarea name="question" cols="20" rows="10"><?php echo $row['question']; ?></Textarea><br><br>
                
                <label>Answer : </label><br>
                <Textarea name="answer" cols="20" rows="10"><?php echo $row['answer']; ?></Textarea><br><br>
                        
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
        $id=$_POST["id"];
        $question=$_POST["question"];
        $answer=$_POST["answer"];

        $sql ="UPDATE viva SET coursecode='$coursecode',course='$course',question='$question',answer='$answer' WHERE id='$id'";
        $data=mysqli_query($conn,$sql);
        if($data)
        {
            echo"<script>alert('You have successfully updated the data');</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/viva.php?code=<?php echo $coursecode ?>">
            <?php
        }
        else
        {
            echo"<script>alert('Something went wrong please try again later');</script>";
        }
           
    }
?>