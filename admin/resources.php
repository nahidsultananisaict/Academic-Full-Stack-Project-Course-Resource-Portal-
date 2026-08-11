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
    <title>Resources</title>
    <style>
        body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;

        }
        .main{
            width:99%;
            min-height:100vh;
            overflow:hidden;
            margin:30px 20px 30px 5px;
            background-color: rgba(0,0,0,0.6);
            border:3px solid black;
            border-radius:70px 0 70px;
        }
        .main .first{
            width:100%;
            height:10vh;
            color:white;

            
        }
        .main .first ul li{
            display: inline-block;
            width:200px;
            height:20px;
            cursor:pointer;
        }
        .main .first ul ul{
            border:3px solid white;
            border-radius:15px;
            background-color:black;
            float:left;
            list-style:none;
        }       
        .main .first ul li ul{
            text-align:left;
            opacity:0.6;
            display:none;
            width:250px;
            height:440px;
            position:relative;
        }
        .main .first ul li:hover > ul{
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
        .main .first label{
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
        .main .second{
            width:100%;
            min-height:78vh;
            overflow:hidden;
            padding:25px 5px 50px 5px;
            color:white;
        }
        .main .second .sec1{
            float:left;            
            width:54%;
            min-height:100vh;
            overflow:hidden;
            border:3px solid white;
            border-radius:15px;
        }
        .main .second .sec2{
            float:right;
            width:43.5%;
            min-height:100vh;
            overflow:hidden;
            border:3px solid white;
            border-radius:15px;
            margin-right:10px;
            
        }
        .main .second .sec2 table{
            margin:10px 5px 10px 5px;
            font-family:arial,sans-serif;
            width : 98%;
            border-collapse:collapse;
        }
        .main .second .sec1 table{
            margin:10px 5px 10px 5px;
            font-family:arial,sans-serif;
            width : 98%;
            border-collapse:collapse;
        }

        th{
            color:white;
            text-align:left;
            padding:8px;
        }
        td{
            text-decoration: none;
            text-align:left;
            padding:8px;
            font-size:12px;
        }
        tr{
            border-radius:5px;
        }
        tr:nth-child(even){
            background-color: #8cb3d9;
            color:black;
        }
        tr:nth-child(even) a{
            color:black;
            text-decoration:none;
        }
        tr:nth-child(odd){
            color:white;
        }
        tr:nth-child(odd) a{
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
    <div class="main">
        <div class="first">
            <ul>
                <li style=" margin-left:17%"><span>Add Slides</span>
                <ul>
                    <li>
                        <form action="resources.php" method="post" enctype="multipart/form-data">
                        <h4 style="text-align:center">ADD SLIDES</h4>
                        <label>Course Code : </label><br>
                        <input type="text" name="coursecode" ><br><br>
                        <label>Course : </label><br>
                        <input type="text" name="subject" ><br><br>
                        <label>Lecture : </label><br>
                        <input type="text" name="lecture" ><br><br>
                        <label>Topic : </label><br>
                        <input type="text" name="topic" ><br><br>
                        <label>Slide: </label><br>
                        <input type="File" name="slide"><br><br>
                        <input type="submit" name="add" class="btn">
                        </form>

                    <?php
                        if(isset($_REQUEST['add'])){
                            $coursecode=$_REQUEST["coursecode"];
                            $subject=$_REQUEST["subject"];
                            $lecture=$_REQUEST["lecture"];
                            $topic=$_REQUEST["topic"];
                            
                            echo $coursecode;
                            echo $subject;
                            echo $lecture;
                            echo $topic;
                            $pname=rand(1000,10000)."-".$_FILES["slide"]["name"];
                            $tname=$_FILES["slide"]["tmp_name"];
                            $upload_dir=__DIR__ . "/../uploads/Slide";
                            move_uploaded_file($tname,$upload_dir.'/'.$pname);

                            $sql = "INSERT into slide(coursecode,course,lecture,topic,slide) VALUES('$coursecode','$subject','$lecture','$topic','$pname')";

                            if(mysqli_query($conn,$sql)){
                                echo"<script>alert('You have successfully inserted the slide');</script>";
                                ?>
                                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/resources.php?code=<?php echo $coursecode ?>">
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
                <li style=" margin-left:8%; color:Aquamarine"><h2>RESOURCES</h2></li>
                <li style=" margin-left:12%"><span>Add Books</span>
                <ul style="float:left; width:250px; height: 320px">
                    <li>
                        <form action="resources.php" method="post" enctype="multipart/form-data">
                        <h4 style="text-align:center">ADD BOOKS</h4>
                        <label>Course Code : </label><br>
                        <input type="text" name="coursecode2" ><br><br>
                        <label>Course : </label><br>
                        <input type="text" name="subject2" ><br><br>
                        <label>Book: </label><br>
                        <input type="File" name="slide2"><br><br>
                        <input type="submit" name="submit" class="btn">
                        </form>

                        <?php
                        if(isset($_REQUEST["submit"])){
                            $coursecode=$_REQUEST["coursecode2"];
                            $subject=$_REQUEST["subject2"];                           
                            $pname=rand(1000,10000)."-".$_FILES["slide2"]["name"];
                            $tname=$_FILES["slide2"]["tmp_name"];
                            $upload_dir=__DIR__ . "/../uploads/Book";
                            move_uploaded_file($tname,$upload_dir.'/'.$pname);

                            $sql = "INSERT into book(coursecode,course,book) VALUES('$coursecode','$subject','$pname')";

                            if(mysqli_query($conn,$sql)){
                                echo"<script>alert('You have successfully inserted the book');</script>";
                                ?>
                                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/resources.php?code=<?php echo $coursecode ?>">
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
        <div class="second">
            <div class="sec1">
                <h2 style="text-align:center;color:Aquamarine">Slides</h2>
                <table>
                <tr>
                    <th>Lecture</th>
                    <th>Topic</th>
                    <th>Slide</th>
                    <th>Download</th>
                    <th>Delete</th>
                    <th>Update</th>
               </tr>
               <?php
                    if(isset($_GET['code'])){
                        $code=$_GET['code'];
                    $query=mysqli_query($conn, "SELECT * FROM slide WHERE coursecode='$code' ORDER BY lecture asc");
                    while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><?php echo $row['lecture'];?></td>
                    <td><?php echo $row['topic'];?></td>
                    <td><a href="../uploads/Slide/<?php echo $row['slide']; ?>"><?php echo $row['slide'];?></a></td>
                    <td><a download="<?php echo $row['slide'];?>" href="../uploads/Slide/<?php echo $row['slide']; ?>">download</a></td>
                    <td>
                        <?php  
                        $id=$row['id']; 
                        $cc = $row['coursecode'];
                        ?> 
                        <a href="deleteresourse.php?id=<?php echo $id ?> & cc=<?php echo $cc ?>" onclick = "return checkdelete()">
                            <span>Delete</span>
                        </a>
                    </td>
                    <td>
                        <a href="updateslide.php?id=<?php echo $id ?>">
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
            <div class="sec2">
                <h2 style="text-align:center;color:Aquamarine">Books</h2>
                <table>
                <tr>
                    <th>Book</th>
                    <th>Download</th>
                    <th>Delete</th>
                    <th>Update</th>
               </tr>
               <?php
                    if(isset($_GET['code'])){
                        $code=$_GET['code'];
                    $query=mysqli_query($conn, "SELECT * FROM book WHERE coursecode='$code'");
                    while($row=mysqli_fetch_array($query)){
                ?>
                <tr>
                    <td><a href="../uploads/Book/<?php echo $row['book']; ?>"><?php echo $row['book'];?></a></td>
                    <td><a download="<?php echo $row['book'];?>" href="../uploads/Book/<?php echo $row['book']; ?>">download</a></td>
                    <td>
                        <?php  
                        $id=$row['id']; 
                        $cc = $row['coursecode'];
                        ?> 
                        <a href="deleteressources2.php?id=<?php echo $id ?> & cc=<?php echo $cc ?>" onclick = "return checkdelete()">
                            <span>Delete</span>
                        </a>
                    </td>
                    <td>
                        <a href="updatebook.php?id=<?php echo $id ?>">
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