<?php
    session_start();
    include_once '../includes/config.php';

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notes</title>
    <style>
        body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;

        }

        .first{
            width:70%;
            min-height:100vh;
            float:left;
        }

        .first .box1{
            width:100%;
            min-height:92vh;
            overflow:hidden;
            margin-top:15px;
            background: rgba(0,0,0,0.6);
            text-align:center;
            border: 3px solid #fff;
            border-radius: 70px 0 70px;
            
        }

        .second{
            width:30%;
            height:590px;
            float:right;
        }

        .second .box2{
            width:270px;
            height:520px;
            margin-top:10px;
            margin-left:30px;
            background: rgba(0,0,0,0.6);
            padding:20px;
            border: 3px solid #fff;
            border-radius: 70px 0 70px;
        }
        .second .box2 h2{
            margin-bottom : 20px;
            text-align:center;
            color: #fff;
            text-transform: uppercase;
            letter-spacing:2px;
        }
        input{
            width:100%;
            height:25px;
            border-radius: 15px 0 15px 0;
            border: 2px solid #fff;
            margin-bottom: 20px;
            margin-top:5px;
            background: white;
            color: black;
        }
        .second .box2 label{
            text-align:left;
            color: Aquamarine;
            text-transform: uppercase;
            font-weight: bold;
            font-size:15px;
        }
        .btn{
            border: 0 solid Aquamarine;
            display: block;
            height: 30px;
            line-height: 30px;
            border-radius: 15px 0 15px 0;
            text-align: center;
            background: Aquamarine;
            color: black;
            text-transform: uppercase;
            margin-top: 25px;
            cursor: pointer;
            text-decoration:none;
            letter-spacing:5px;
            font-weight: bold;
            font-size: 16px;
            
        }
        .second .box3{
            text-align: center;
            color: white;
        }

        table{
            margin:30px 0 30px 30px;
            font-family:arial,sans-serif;
            border-collapse:collapse;
            width : 95%;

        }

        th{
            color:Aquamarine;
            padding:8px;
            text-align:left;
        }
        td{
            text-decoration: none;
            color: #fff;
            padding:8px;
            font-size:12px;
            text-align:left;
        }

        tr{
            color:white;
        }
        a{
            color:white;
            text-decoration:none;
        }
        span{
            padding: 8px;
        }
        span:hover{
            background:Aquamarine;
            border-radius: 0.3rem;
            transition:0.7s;
            color:black;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="first">
       <div class="box1">
        <p>
            <h2 style="color:white;font-size:20px">PERSONAL NOTES</h2>
        </p>
            <table>
                <tr>
                    <th>TOPIC</th>
                    <th>CREATED BY</th>
                    <th>DOWNLOAD</th>
                    <th>UPDATE</th>
                </tr>
                <?php 

                    $username=$_SESSION["username"];
                    $usertype=$_SESSION["role"];

                    $query1 = $conn->query("SELECT * FROM request WHERE username='$username'");
                    $approval = 0;
                    if ($query1 && $row1 = mysqli_fetch_array($query1)) {
                        $approval = $row1['status'];
                    }

                    if(isset($_GET['code'])){
                    $code=$_GET['code'];
                    $query=mysqli_query($conn, "SELECT * FROM notes WHERE coursecode='$code'");
                    while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><a href="../uploads/Note/<?php echo $row['note']; ?>"><?php echo $row['topic'].' : '.$row['note'];?></a></td>
                    <td><?php echo $row['created'];?></td>
                    <td><a download="<?php echo $row['note'];?>" href="../uploads/Note/<?php echo $row['note']; ?>">download</a></td>
                    <td>
                        <?php if($usertype == "admin" || $approval == 1){ 
                        $id=$row['id'];
                        ?>
                        <a href="updatenote.php?id=<?php echo $id ?>"><?php } ?>
                            <span>Update</span>
                        </a>
                    </td>
                </tr>
                <?php
                    }
                }
                    ?>
            </table>
            
       </div>
    </div>
    <div class="second">
    <div class="box2">
        <h2>Add Note</h2>
        <form action="notes.php" method="post" enctype="multipart/form-data" >
        <label>Course Code : </label><br>
        <input type="text" name="code" >
        <label>Course : </label><br>
        <input type="text" name="subject" >
        <label>Topic : </label><br>
        <input type="text" name="topic" >
        <label>Created By : </label><br>
        <input type="text" name="created" >
        <label>Note: </label><br>
        <input type="File" name="file">
        <input type="submit" name="submit" class="btn">
        </form>
    </div>

    <div class="box3">
    <?php
    if(isset($_POST["submit"])){
        $coursecode=$_POST["code"];
        $subject=$_POST["subject"];
        $topic=$_POST["topic"];
        $created=$_POST["created"];
        $pname=$_FILES["file"]["name"];
        $tname=$_FILES["file"]["tmp_name"];
        $upload_dir=__DIR__ . "/../uploads/Note";

        if($usertype == "admin" || $approval == 1){
        move_uploaded_file($tname,$upload_dir.'/'.$pname);

        $sql = "INSERT into notes(subject,topic,created,note,coursecode) VALUES('$subject','$topic','$created','$pname','$coursecode')";

        if(mysqli_query($conn,$sql)){
            echo"<script>alert('You have successfully inserted the file');</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/notes.php?code=<?php echo $coursecode ?>">
            <?php
        }
        else{
            echo"<script>alert('Something went wrong please try again later');</script>";
        }
        }
        else{
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/notes.php?code=<?php echo $coursecode ?>">
            <?php
        }
    }
    ?>
    </div>
    </div>

<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this file');
    }
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
    
</body>
</html>