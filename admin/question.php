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
    <title>Question</title>
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
            height:600px;
            float:right;
        }

        .second .box2{
            width:250px;
            height:475px;
            margin: 15px auto 0;
            background: rgba(0,0,0,0.6);
            padding:20px 35px 40px 35px;
            border: 3px solid #fff;
            border-radius: 70px 0 70px;
        }
        .second .box2 h2{
            margin-bottom : 30px;
            text-align:center;
            color: #fff;
            text-transform: uppercase;
            letter-spacing:2px;
        }
        input{
            width:100%;
            height:30px;
            border-radius: 15px 0 15px 0;
            border: 2px solid #fff;
            margin-bottom: 25px;
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
            margin:30px 20px 30px 30px;
            font-family:arial,sans-serif;
            border-collapse:collapse;
            width : 95%;

        }

        th{
            color:Aquamarine;
            text-align:left;
            padding:8px;
        }
        td{
            text-decoration: none;
            color: #fff;
            text-align:left;
            padding:8px;
            font-size:12px;
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
        <p >
            <h2 style="color:white;font-size:20px;letter-spacing:1px">PREVIOUS YEAR QUESTIONS </h2>
        </p>
            <table>
                <tr>
                    <th>SESSION</th>
                    <th>QUESTION</th>
                    <th>DOWNLOAD</th>
                    <th>DELETE</th>
                    <th>UPDATE</th>
                </tr>
                <?php
                    if(isset($_GET['code'])){
                    $code=$_GET['code'];
                    $query=mysqli_query($conn, "SELECT * FROM question WHERE coursecode='$code' ORDER BY sesion asc");
                    while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $row['sesion'];  ?></td>
                    <td><a href="../uploads/Question/<?php echo $row['questions']; ?>"><?php echo $row['questions'];?></a></td>
                    <td><a download="<?php echo $row['questions'];?>" href="../uploads/Question/<?php echo $row['questions']; ?>">download</a></td>
                    <td>
                        <?php  
                        $id=$row['id'];  
                        $cc = $row['coursecode'];
                        ?>
                        <a href="deletequestion.php?id=<?php echo $id ?> & cc=<?php echo $cc ?>" onclick = "return checkdelete()">
                        <span>Delete</span>
                        </a>
                    </td>
                    <td>
                        <a href="updatequestion.php?id=<?php echo $id ?>">
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
        <h2>Add Question</h2>
        <form action="question.php" method="post" enctype="multipart/form-data" >
        <label>Course Code : </label><br>
        <input type="text" name="code">
        <label>Course : </label><br>
        <input type="text" name="subject">
        <label >Session : </label><br>
        <input type="text" name="sesion" >
        <label>Question : </label><br>
        <input type="File" name="file">
        <input type="submit" name="submit" class="btn">
        </form>
    </div>

    <div class="box3">
    <?php
    if(isset($_POST["submit"])){
        $coursecode=$_POST["code"];
        $subject=$_POST["subject"];
        $sesion=$_POST["sesion"];
        $pname=$_FILES["file"]["name"];
        $tname=$_FILES["file"]["tmp_name"];
        $upload_dir=__DIR__ . "/../uploads/Question";
        move_uploaded_file($tname,$upload_dir.'/'.$pname);

        $sql = "INSERT into question(coursecode,course,sesion,questions) VALUES('$coursecode','$subject','$sesion','$pname')";

        if(mysqli_query($conn,$sql)){
            echo"<script>alert('You have successfully inserted the file');</script>";
            ?>
            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/question.php?code=<?php echo $coursecode ?>">
            <?php
        }
        else{
            echo"<script>alert('Something went wrong please try again later');</script>";
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