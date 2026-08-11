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
    <title>Update Profile</title>
    <style>
         body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;

        }
        h2{
            text-align:center;
            color:Aquamarine;
            letter-spacing:1px;
        }
        
        form{
            margin:-1% 12% 0 18%;
            align:center;
            border:10px solid darkslategray;
            border-radius:15px;
            width:60%;
            padding:10px 5px;
            background:black;
            border-radius:70px 0 70px;
        }
        form h4{
            color:white;
        }
        form .input{
            width:90%;
            min-height:50vh;
            overflow:hidden;
            color:white; 
            align-items:center;
            margin-top:40px; 
            margin-left:30px;
            border-radius:30px;
        }
        .input .input1{
            float:left;
            width:48%;
            min-height:70vh;
            overflow:hidden;
        }
        .input .input2{

            float:right;
            width:48%;
            min-height:70vh;
            overflow:hidden;
        }
        label{
            margin-left:5%;
            margin-bottom:4px;
            display:block;
            font-size: 15px;
            cursor:pointer;
            padding:1px;
            text-align:left;
            color: Aquamarine;
            font-weight: bold;
        }
        input{
            width:90%;
            background:transparent;
            padding:3px;
            border:2px solid white;
            outline:none;
            height:25px;
            margin-left:5%;
            margin-right:10%;
            margin-bottom:20px;
            border-radius:5px;
            color:white;
        }
        .btn{
            
            border: 0 solid Aquamarine;
            display: block;
            height: 30px;
            line-height: 20px;           
            text-align: center;
            background: Aquamarine;
            color: black;
            margin: 30px 25% 0 30%;
            cursor: pointer;
            text-decoration:none;
            letter-spacing:1px;
            font-weight: bold;
            font-size: 15px;
            width:40%;
        }
    </style>
</head>
<body>
    <?php
    $id = $_GET['id'];
    $query=mysqli_query($conn, "SELECT * FROM admin WHERE id='$id'");
    while($row=mysqli_fetch_array($query)){
    ?>
    <em><h2>UPDATE PROFILE</h2></em>
    <div class="first">
            <form action="updateprofile.php" method="POST" enctype="multipart/form-data">                
                <h4 style="text-align:center">PROFILE</h4>
                <div class="input">
                    <div class="input1">
                    <label>ID : </label>
                    <input type="text" name="id" value="<?php echo $id ?>" readonly>
                    <label >NAME : </label>
                    <input type="text" name="name" value="<?php echo $row['name']; ?>">
                    <label >USERNAME : </label>
                    <input type="text" name="username" value="<?php echo $row['username']; ?>" readonly>
                    <label >ROLL : </label>
                    <input type="text" name="roll" value="<?php echo $row['roll']; ?>">
                    <label >SESSION : </label>
                    <input type="text" name="session" value="<?php echo $row['session']; ?>">
                    </div>

                    <div class="input2">
                    <label >BATCH : </label>
                    <input type="text" name="batch" value="<?php echo $row['batch']; ?>">
                    <label >EMAIL: </label>
                    <input type="text" name="email" value="<?php echo $row['email']; ?>">
                    <label >PHONE NUMBER : </label>
                    <input type="text" name="phone" value="<?php echo $row['phone']; ?>">
                    <label >PICTURE : </label>
                    <input type="file" name="newimage" >
                    <input type="hidden" name="oldimage"  value="<?php echo $row['image']; ?>">
                    <input type="submit" name="update" value="Update" class="btn">
                    </div>
                </div>    
            </form>
    </div>
    <?php 
    }
    ?>

<?php
    if(isset($_POST["update"]))
    {       
        $id=$_POST['id'];
        $name=$_POST["name"];
        $username=$_POST["username"];
        $roll=$_POST["roll"];
        $sesion=$_POST["session"];
        $batch=$_POST["batch"];
        $email=$_POST["email"];
        $phone=$_POST["phone"];

        $oldimage=$_POST["oldimage"];
        $newimage=$_FILES["newimage"]["name"];
        $upload_dir=__DIR__ . "/../assets/images";
        

        if($newimage != '')
        {
            $up_image = $_FILES["newimage"]["name"];
        }
        else{
            $up_image = $oldimage;
        }


        if($_FILES["newimage"]["name"] != '')
        {
            if(file_exists($upload_dir.'/'.$_FILES["newimage"]["name"]))
            {
                $sql1 = "UPDATE admin SET name='$name',username='$username',roll='$roll',session='$sesion',email='$email',phone='$phone',image='$up_image',batch='$batch' WHERE id='$id'";
                $data=mysqli_query($conn,$sql1);
                if($data)
                {
                    echo"<script>alert('Image already exists');</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/home.php?username=<?php echo $username ?>">
                    <?php
                }
                else
                {
                    echo"<script>alert('Something went wrong please try again later');</script>";
                }
            }

            else
            {
                move_uploaded_file($_FILES["newimage"]["tmp_name"],$upload_dir.'/'.$_FILES["newimage"]["name"]);
                unlink($upload_dir.'/'.$oldimage);
                $sql = "UPDATE admin SET name='$name',username='$username',roll='$roll',session='$sesion',email='$email',phone='$phone',image='$up_image',batch='$batch' WHERE id='$id'";
                $data=mysqli_query($conn,$sql);
                if($data)
                {
                    echo"<script>alert('You have successfully updated the data');</script>";
                    ?>
                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/home.php?username=<?php echo $username ?>">
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
            $sql1 = "UPDATE admin SET name='$name',username='$username',roll='$roll',session='$sesion',email='$email',phone='$phone',image='$up_image',batch='$batch' WHERE id='$id'";
            $data=mysqli_query($conn,$sql1);

            if($data)
            {
                echo"<script>alert('You have successfully updated the data');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/home.php?username=<?php echo $username ?>">
                <?php
            }
            else{
                echo"<script>alert('Something went wrong please try again later');</script>";
            }
        }
    }
?>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>

</body>
</html>
