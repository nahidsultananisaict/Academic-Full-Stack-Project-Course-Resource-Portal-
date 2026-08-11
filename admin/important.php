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
    <title>Important topic</title>
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
        .main .A{
            width:100%;
            height:10vh;
            color:white;           
        }
        .main .A ul li{
            display: inline-block;
            cursor:pointer;
        }
        .main .A ul ul{
            border:3px solid white;
            border-radius:15px;
            background-color:black;
            float:left;
            list-style:none;
        }       
        .main .A ul li ul{
            text-align:left;
            opacity:0.6;
            display:none;
            width:200px;
            height:400px;
            position:relative;
        }
        .main .A ul li:hover > ul{
            display:block;
            opacity:1;
        }
        input{
            width:100%;
            height:20px;
            border: 2px solid #fff;
            background: white;
            color: black;
            border-radius:15px 0 15px 0;
        }
        .main .A label{
            text-align:left;
            color: Aquamarine ;
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
        .main .B{
            width:96%;
            min-height:78vh;
            overflow:hidden;
            padding:20px;
        }
        .B .B1 h2{
            font-size:20px;
            padding:10px;
            margin-left:80px;
            color: Aquamarine;
            letter-spacing:1px;
        }
        .B .B1 h3{
            font-size:15px;
            margin-left:200px;
            color:lavender;
        }
        table{
            margin:30px 30px 30px 30px;
            font-family:arial,sans-serif;
            border-collapse:collapse;
            width : 90%;

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
        .statusdeletei{
            text-align: center;
            color:darkred;
            font-size:18px;

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
    <div>
        <h4 class="statusdeletei">
            <?php 
                if(isset($_SESSION['statusdeletei'])){ 
                    echo $_SESSION['statusdeletei']; 
                    unset($_SESSION['statusdeletei']);
                }
            ?>
        </h4>
    </div>
    <div class="main">
        <div class="A">
        <ul>
            <li style="margin-left:35%;color:Aquamarine"><h1>Important Topics</h1></li>
            <li style="margin-left:20%"><h3><span>Add Topics</span></h3>
            <ul>
                <li>
                    <form action="important.php" method="post">
                    <h4 style="text-align:center">ADD TOPICS</h4>
                    <label>Course Code : </label><br>
                    <input type="text" name="coursecode" ><br><br>
                    <label>Course : </label><br>
                    <input type="text" name="course" ><br><br>
                    <label>Chapter : </label><br>
                    <input type="text" name="chapter" ><br><br>                    
                    <label>Topic : </label><br>
                    <input type="text" name="topic" ><br><br>                   
                    <input type="submit" name="submit" class="btn">
                    </form>
                    <?php
                    if(isset($_REQUEST['submit'])){
                        $coursecode=$_REQUEST['coursecode'];
                        $course=$_REQUEST['course'];
                        $chapter=$_REQUEST['chapter'];
                        $topic=$_REQUEST['topic'];
                        $sql = "INSERT into important(coursecode,course,chapter,topic) VALUES('$coursecode','$course','$chapter','$topic')";
                        if(mysqli_query($conn,$sql)){
                            echo"<script>alert('You have successfully inserted the data');</script>";
                            ?>
                            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/important.php?code=<?php echo $coursecode ?>">
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
    <div class="B">
        <div class="B1">
            <table>
                <tr>
                    <th>Chapter Name</th>
                    <th>Topic</th>
                    <th>Delete</th>
                    <th>Update</th>
                </tr>
                <?php
                    if(isset($_GET['code'])){
                    $code=$_GET['code'];
                    $chaps=array();
                    $result = $conn->query("SELECT distinct(chapter) FROM important WHERE coursecode='$code'");
                    while($row = $result->fetch_assoc()){
                        $chaps=$row['chapter']; ?>
                        <tr>
                            <td style="font-size:20px; color:pink"><?php echo $chaps.' '.':';?></td>
                        </tr>
                        <?php $result2=$conn->query("SELECT distinct(topic),id,coursecode,chapter,course FROM important WHERE chapter = '$chaps'");
                        $i=1;
                        while($row2 = $result2->fetch_assoc()){   ?>                        
                            <tr>
                                <td></td>
                                <td style="font-size:15px"><?php echo $i.'.  '.$row2['topic']; ?></td>
                                <td>
                                    <?php 
                                    $id=$row2['id']; 
                                    $cc = $row2['coursecode'];
                                    ?> 
                                    <a href="deleteimp.php?id=<?php echo $id ?> & cc=<?php echo $cc ?>" onclick = "return checkdelete()">
                                        <span>Delete</span>           
                                    </a>
                                </td>
                                <td>
                                <?php
                                    $c = $row2['course'];
                                    $chp = $row2['chapter'];
                                    $to = $row2['topic'];
                                ?>
                                <a href="updateimp.php?id=<?php echo $id ?> & cc=<?php echo $cc ?> & c=<?php echo $c ?> & chp=<?php echo $chp ?> & to=<?php echo $to ?>">
                                    <span>Update</span>
                                </a>   
                                </td>
                            </tr>
                            <?php
                            $i++;
                            }
                        }
                    }
                ?>
            </table>
        </div>             
            
    </div>
<script>
    function checkdelete()
    {
        return confirm('Are you sure you want to delete this topic');
    }
</script>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>