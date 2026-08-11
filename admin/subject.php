<?php 
session_start();
?>
<?php
    include_once '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>

    <link rel="stylesheet" href="style.css">
    <style>
        .card-contain{
            width: 900px;
            display:block;
            font-family: sans-serif;
            align-items:center;
            margin-left:18%;
            margin-top:5%;

        }
        ul li{
            font-size: 1.8rem;
            cursor: pointer;
        }
        ul ul{
            border:3px solid white;
            border-radius:15px;
            background-color:black;
            float:center;
            list-style:none;
        }       
        ul li ul{
            text-align:left;
            opacity:0.6;
            display:none;
            width:210px;
            height:400px;
            position:absolute;
            margin-top:10px;
        }
        span{
            padding:1rem;
        }
        li>span:hover{
            background:blue;
            border-radius: 0.6rem;
        }
        ul li:hover > ul{
            display:block;
            opacity:1;
        }
        input{
            width:100%;
            height:25px;
            border: 2px solid #fff;
            background: white;
            color: black;
            border-radius:15px 0 15px 0;
        }
        label{
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
        .card-body .bottom-container .bot{
            width: 250px;
            height:28px;
            padding: 5px 0;
            text-decoration: none;
            background: linear-gradient(125deg, #00ff35, #0091a7 60%);
            color: #fff;
            border-radius: 5px;
            font-size: 15px;
            transition: all 0.4s;
            }
        .heading h1 {
            padding:100px 30px 10px 30px;
            font-size:30px;
            font-weight:bolder;
            color:white;
            text-align:center;
            margin-left:100px;
        }
    </style>
</head>
<body>

<!-- header starts here -->

<header id="blog-header" style="width:104%;position: fixed;top: 0;padding: 15px;">
   <!-- <figure class="logo-figure">
        <i class="fab fa-autoprefixer logo"></i>
    </figure> -->
    <h1>NOTES APP</h1>

<nav aria-label="Main Menu">
<ul role="menubar">
    <li ><span style="font-family:poppins; font-size:19px; color:aliceblue">Add Course</span>
        <ul>
            <li>
                <form action="subject.php" method="post" enctype="multipart/form-data">
                <h4 style="text-align:center; font-weight:bold; font-size:16px; margin-top:5px; color:aliceblue">ADD COURSE</h4><br>
                <label>Semester : </label><br>
                <input type="text" name="semester" placeholder="Add semester such as 1st" required ><br><br>
                <label>Course Code : </label><br>
                <input type="text" name="coursecode" placeholder="Course Code : ICT-101" required ><br><br>
                <label>Course Name : </label><br>
                <input type="text" name="course" required ><br><br>
                <label>Image : </label><br>
                <input type="file" name="image" required><br><br>                  
                <input type="submit" name="submit" class="btn">
                </form>
                <?php
                if(isset($_REQUEST['submit'])){
                    $semester=$_REQUEST['semester'];
                    $coursecode=$_REQUEST['coursecode'];
                    $course=$_REQUEST['course'];

                    $pname=rand(1000,10000)."-".$_FILES["image"]["name"];
                    $tname=$_FILES["image"]["tmp_name"];
                    $upload_dir=__DIR__ . "/../uploads/Images";
                    move_uploaded_file($tname,$upload_dir.'/'.$pname);

                    $sql = "INSERT into subject(semester,coursecode,course,picture) VALUES('$semester','$coursecode','$course','$pname')";
                    if(mysqli_query($conn,$sql)){
                        echo"<script>alert('You have successfully inserted the data');</script>";
                        ?>
                        <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/subject.php?sem=<?php echo $semester ?>">
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
    <li role="none"><span style=" margin-right:80px">
        <a href="nhome.php" class="nav-link" role="menuitem">Home</a>
    </span></li>

</ul>

</nav>
</header>
<!-- header ends here -->

<div class="heading">
    <?php 
        if(isset($_GET['sem'])){
        $sem=$_GET['sem'];
        if($sem=="1st"){echo "<h1>1st Year 1st Semester Courses</h1>";}
        else if($sem=="2nd"){echo "<h1>1st Year 2nd Semester Courses</h1>";}
        else if($sem=="3rd"){echo "<h1>2nd Year 1st Semester Courses</h1>";}
        else if($sem=="4th"){echo "<h1>2nd Year 2nd Semester Courses</h1>";}
        else if($sem=="5th"){echo "<h1>3rd Year 1st Semester Courses</h1>"; }
        else if($sem=="6th"){echo "<h1>3rd Year 2nd Semester Courses</h1>"; }
        else if($sem=="7th"){echo "<h1>4th Year 1st Semester Courses</h1>"; }
        else if($sem=="8th"){echo "<h1>4th Year 2nd Semester Courses</h1>"; }
        }
    ?>
</div>
<div class="card-contain">
    <?php
        if(isset($_GET['sem'])){
        $sem=$_GET['sem'];
        $result = $conn->query("SELECT * FROM subject WHERE semester='$sem' order by coursecode asc");
        while($row=mysqli_fetch_array($result)){ 
    ?>  
    <div class="card">
        <div class="img-style">
            <?php $image = $row['picture'];
            echo "<img src='../uploads/Images/$image'>"
            ?>
        </div>
        <div class="card-body">
            <div class="card-title">
                <?php echo $row['coursecode'] ?>
            </div>
            <div class="card-des" style="font-weight: bolder; font-size:15px">
                <?php echo $row['course'] ?>
            </div>
            <div class="bottom-container">
                <a href="item.php?code=<?php echo $row['coursecode'] ?>" class="bot">Read More</a>
            </div>
        </div>
    </div>

    <?php 
        }
    }
    ?>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</div>


</body>
</html>