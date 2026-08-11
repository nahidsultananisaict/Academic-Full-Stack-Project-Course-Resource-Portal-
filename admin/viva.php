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
    <title>Viva</title>
    <style>
        body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;

        }
        .main{
            width:98%;
            min-height:100vh;
            overflow:hidden;
            margin:20px auto 0;
            background-color: rgba(0,0,0,0.6);
            border:3px solid black;
            border-radius:70px 0 70px;
            color:white;
        }
        .main .div1{
            width:100%;
            height:10vh;
            color:white;           
        }
        .main .div1 ul li{
            display: inline-block;
            cursor:pointer;
        }
        .main .div1 ul ul{
            border:3px solid white;
            border-radius:15px;
            background-color:black;
            float:left;
            list-style:none;
        }       
        .main .div1 ul li ul{
            text-align:left;
            opacity:0.6;
            display:none;
            width:250px;
            height:420px;
            position:relative;
        }
        .main .div1 ul li:hover > ul{
            display:block;
            opacity:1;
        }
        input{
            width:120%;
            height:20px;
            border: 2px solid #fff;
            background: white;
            color: black;
            border-radius:15px 0 15px 0;
        }
        .main .div1 label{
            text-align:left;
            color: Aquamarine;
        }
        .btn{
            border: 0 solid Aquamarine;
            display: block;
            height: 25px;
            line-height: 20px;           
            text-align: center;
            background: Aquamarine;
            color: black;
            margin-top: 15px;
            cursor: pointer;
            text-decoration:none;
            letter-spacing:1px;
            font-weight: bold;
            font-size: 15px;
            
        }
        .main .div2{
            width:96%;
            min-height:78vh;
            overflow:hidden;
            padding:20px;
        }
        table{
            margin-top:20px;
            margin-left:50px;
            font-family:arial,sans-serif;
            width : 90%;
            border-collapse:collapse;
        }
        td{
            text-decoration: none;
            text-align:left;
            padding:5px;
            font-size:12px;
        }
        tr{
            border-radius:5px;
        }
        Textarea{
            width:120%;
            height:30px;
            border: 2px solid #fff;
            background: white;
            color: black;
            border-radius:15px 0 15px 0;
        }
        .sec1{
            color:white;
            margin-right:100px;
        }
        .sec2{
            margin-top:8px;
            margin-right:100px;
            background-color:#8cb3d9;
            color:black;
            visibility:hidden;
            padding:8px;
            width:90%;
        }
        .sec1:hover .sec2{
            visibility:visible; 
        }
        a{
            color:white;
            text-decoration:none;
        }
        .span{
            padding: 8px;
        }
        .span:hover{
            background:Aquamarine;
            border-radius: 0.3rem;
            transition:0.7s;
            color:black;
            font-weight:bold;
        }
    </style>
</head>
<body>
    <div class="main">
        <div class="div1">
            <ul>
                <li style="margin-left:38%;color:Aquamarine"><h1>Viva Questions</h1></li>
                <li style="margin-left:17%"><h3><span class="span">Add Questions</span></h3>
                <ul>
                    <li>
                        <form action="viva.php" method="post">
                        <h4 style="text-align:center">ADD QUESTIONS</h4>
                        <label>Course Code : </label><br>
                        <input type="text" name="coursecode" ><br><br>
                        <label>Course : </label><br>
                        <input type="text" name="course" ><br><br>
                        <label>Question : </label><br>
                        <Textarea name="question" cols="20" rows="10"></Textarea><br><br>
                        
                        <label>Answer : </label><br>
                        <Textarea name="answer" cols="20" rows="10"></Textarea><br><br>
                        
                        <input type="submit" name="submit" class="btn">
                        </form>
                        <?php
                        if(isset($_REQUEST['submit'])){
                            $coursecode=$_REQUEST['coursecode'];
                            $course=$_REQUEST['course'];
                            $question=$_REQUEST['question'];
                            $answer=$_REQUEST['answer'];

                            $sql = "INSERT into viva(coursecode,course,question,answer) VALUES('$coursecode','$course','$question','$answer')";
                            
                            if(mysqli_query($conn,$sql)){
                                echo"<script>alert('You have successfully inserted the question');</script>";
                                ?>
                                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/viva.php?code=<?php echo $coursecode ?>">
                                <?php
                            }
                            else{
                                echo"<script>alert('Something went wrong please try again later');</script>";
                            }
                        }
                    ?>
                    </li>
                </ul>           
            </li>
            </ul>                     
        </div>


        <div class="div2">
        <table>
                
                <?php
                if(isset($_GET['code'])){
                    $code=$_GET['code'];
                    $query=mysqli_query($conn, "SELECT * FROM viva WHERE coursecode='$code'");
                    while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td>
                        <div class="sec1"><span style="font-size:18px; font-weight:bold; color:Aquamarine">
                            Question : </span><?php echo $row['question'];?>
                            <div class="sec2"><span style="font-size:15px; font-weight:bold; color:#804A00">
                                Answer : </span><?php echo $row['answer'];?>
                            </div>
                        </div>
                    </td>
                    <td>
                        <?php  
                            $id=$row['id']; 
                            $cc = $row['coursecode']; 
                        ?>
                        <a href="deleteviva.php?id=<?php echo $id ?> & cc=<?php echo $cc ?>" onclick = "return checkdelete()">
                            <span class="span">Delete</span>
                        </a>
                    </td>

                    <td></td>
                    <td>
                        <a href="updateviva.php?id=<?php echo $id ?>">
                            <span class="span">Update</span>
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
<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this question');
    }
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>
