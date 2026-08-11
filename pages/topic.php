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
    <title>Topic</title>
    <style>
        body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;

        }
        .first{
            width:100.5%;
            height:10vh;
            color:white; 
            background-color:black;      
            padding: 0px 5px 25px 5px;   
            align-items:center;
            
        }
        .second{
            width:98%;
            min-height:100vh;
            overflow:hidden;
            margin:50px auto 0;            
            border:3px solid white;
            border-radius:70px 0 70px 0;
            background-color: rgba(0,0,0,0.6);
        }
        .first ul{
            padding: 0 5px 25px 10px; 
        }
        .first ul li{
            display: inline-block;
            width:230px;
            height:20px;
        }
        .first ul ul{
            border:3px solid white;
            border-radius:15px;
            background-color:black;
            float:left;
            list-style:none;
        }       
        .first ul li ul{
            text-align:left;
            opacity:0.6;
            display:none;
            position:relative;
            width:200px;
        }
        .first ul li:hover > ul{
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
        .first label{
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
        table{
            margin-top:50px;
            margin-left:20px;
            font-family:arial,sans-serif;
            width : 90%;
            border-collapse:collapse;
        }
        th{
            margin-top:10px;
            margin-bottom:10px;
            text-align:left;
        }
        td{
            text-decoration: none;
            text-align:left;
            padding:10px;
            font-size:12px;
        }
        tr{
            border-radius:5px;
        }
        .s1{
            margin-left:20px;
            color:white;
        }
        .tr1{
            margin-top:8px;           
            color:lavender;
            padding:10px;
            width:100%;
        }
        .tr2 td{

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
    <div class="first" style="margin-top:-15px; margin-left:-10px;position: fixed;top: 0;padding-bottom: 40px;">
    <ul>
    <?php 
        if(isset($_GET['code'])){
        $code=$_GET['code'];
        $result = $conn->query("SELECT course FROM subject WHERE coursecode='$code'");
        while($row=mysqli_fetch_array($result)){ 
            $subject=$row['course'];
    ?>
        <li style=" margin-left:5%; color:Aquamarine; width:350px; text-transform:UPPERCASE">
        <?php   echo "<h3>$code".' : '."$subject</h3>"; }}?></li>
        <li style=" margin-left:40%; cursor:pointer"><span style="font-size:20px; font-weight:bold">Add Topics</span>

<!-- invisible -->
<?php 
        $username=$_SESSION["username"];
        $query = $conn->query("SELECT * FROM request WHERE username='$username'");
        while($row1=mysqli_fetch_array($query)){
            $approval=$row1['status'];
            if($approval == 1){

            
        ?>
<!-- invisible -->

                <ul style="float:left; width:250px; height: 480px">
                    <li>
                        <form action="topic.php" method="post" enctype="multipart/form-data">
                        <h4 style="text-align:center">ADD TOPICS</h4>
                        <label>Course Code : </label><br>
                        <input type="text" name="coursecode" ><br><br>
                        <label>Subject : </label><br>
                        <input type="text" name="subject" ><br><br>
                        <label>Chapter Name/No : </label><br>
                        <input type="text" name="chaptername" ><br><br>
                        <label>Topic Name : </label><br>
                        <input type="text" name="topic"><br><br>
                        <label>Website Link : </label><br>
                        <input type="text" name="website" placeholder="Enter a website link"><br><br>
                        <label>Youtube video : </label><br>
                        <input type="text" name="video" placeholder="Enter a video link"><br><br>
                        <input type="submit" name="submit" class="btn">
                        </form>

                        <?php
                        if(isset($_POST["submit"])){
                            $coursecode=$_POST["coursecode"];
                            $subject=$_POST["subject"];
                            $chapter=$_POST["chaptername"];
                            $topic=$_POST["topic"];
                            $website=$_POST["website"]; 
                            $video=$_POST["video"];                           

                            $sql ="INSERT into topic(coursecode,course,chaptername,topic,tutorial,website) VALUES('$coursecode','$subject','$chapter','$topic','$video','$website')";

                            if(mysqli_query($conn,$sql)){
                                echo"<script>alert('You have successfully inserted the data');</script>";
                                ?>
                                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/topic.php?code=<?php echo $coursecode ?>">
                                <?php
                            }
                            else{
                                echo"<script>alert('Something went wrong please try again later');</script>";
                            }
                        }
                        ?>

                    </li>
                </ul>
        <?php
            }
        }
        ?>
        </li>
    </ul>
</div>
<div class="second" style="margin-top:150px;">

    <div class="s1">
        <table>
            <tr style="color:Aquamarine">
                <th>    </th>
                <th>TOPIC</th>
                <th>TUTORIAL</th>
                <th>WEBSITE</th>
                <th>UPDATE</th>
            </tr>
            <?php
                if(isset($_GET['code'])){
                $code=$_GET['code'];
                $chapter=array();
                $result = $conn->query("SELECT distinct(chaptername) FROM topic WHERE coursecode='$code'");
                while($row = $result->fetch_assoc()){
                    $chapter=$row['chaptername']; 
            ?>
            <tr class="tr1">
                <td><h2><?php echo $chapter.':'; ?></h2></td>
                <td></td>
                <td></td>
                <td></td>
            </tr>
            <?php 
                $result2=$conn->query("SELECT distinct(topic),tutorial,website,id,coursecode,course,chaptername FROM topic WHERE chaptername = '$chapter'");
                while($row2 = $result2->fetch_assoc()){                           
            ?>
            <tr class="tr2">
                <td></td>
                <td><?php echo $row2['topic']; ?></td>
                <td>
                    <?php 
                        $vid = $row2['tutorial'];
                    ?>
                    <a href="<?php echo $vid; ?>"><?php echo $vid; ?></a>
                </td>
                <td>
                    <?php
                        $web = $row2['website'];
                    ?>
                    <a href="<?php echo $web; ?>"><?php echo $web; ?></a>
                </td>
                <td>
                    <?php
                        $c = $row2['course'];
                        $chp = $row2['chaptername'];
                        $to = $row2['topic'];

                        $username=$_SESSION["username"];
                        $query = $conn->query("SELECT * FROM request WHERE username='$username'");
                        while($row1=mysqli_fetch_array($query)){
                            $approval=$row1['status'];
                            
                    ?>
                    <?php if($approval == 1){ 
                        $id=$row2['id'];
                        $cc=$row2['coursecode'];
                    ?>
                    <a href="updatetopic.php?id=<?php echo $id ?> & cc=<?php echo $cc ?> & c=<?php echo $c ?> & chp=<?php echo $chp ?> & to=<?php echo $to ?> & vid=<?php echo $vid ?> & web=<?php echo $web ?>"> <?php } }?>
                    <span style="cursor:pointer">Update</span>
                    </a> 
                </td>
            </tr>  
            <?php
                    }
                }
            }
            ?>            
        </table>
    </div>
</div>


<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>