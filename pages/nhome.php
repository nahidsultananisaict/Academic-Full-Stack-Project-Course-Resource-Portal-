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
    <title>Home</title>

    <link rel="stylesheet" href="/noteapp/assets/css/style.css">
    <style>
        .php-con{
            margin-top: 30px auto;
        }
        .status{
            text-align: center;
            color:white;
        }
        .state{
            text-align: center;
            color:white;
        }
        ul li{
            font-size: 1.8rem;
            cursor: pointer;
            margin-right:10px;
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
            width:200px;
            height:200px;
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
        .card .card-bodies .bottom-container .bottom:hover{
            padding-left: 15px;
        }
        .logout{
            color:Aquamarine;
            background-color:black;
            cursor:pointer;
            padding:5px;
            font-size:15px;
            border:none;
            width:100%;
            height:40px;
            margin-right:20px;
            margin-left:-20px;
        }
        .logout:hover{
            background-color:blue;
            border-radius:10px;
        }
        #count{
            border-radius:50%;
            position:relative;
            top:-10px;
            left:-10px;
            color:red;
            font-size:18px;
        }
    </style>
</head>
<body>

<!--header starts here -->

<header id="blog-header" style="width:104%;position: fixed;top: 0;padding: 5px;">
   <!-- <figure class="logo-figure">
        <i class="fab fa-autoprefixer logo"></i>
    </figure> -->
    <h1>NOTES APP</h1>

<nav aria-label="Main Menu">
<ul role="menubar">
    <li ><span  style="font-family:poppins; font-size:18.5px; color:aliceblue">Add Semester</span>

    <!-- invisible -->
    <?php 
    $username=$_SESSION["username"];

    // Check if the user is admin
    // $checkAdmin = $conn->query("SELECT * FROM admin WHERE username='$username'");
    // $isAdmin = ($checkAdmin && $checkAdmin->num_rows > 0);

    $query = $conn->query("SELECT * FROM request WHERE username='$username'");
    while($row1=mysqli_fetch_array($query)){
        $approval=$row1['status'];
        if($approval == 1){

           
    ?>
    <!-- invisible -->
                    <ul>
                        <li>
                            <form action="nhome.php" method="post">
                            <h4 style="text-align:center; font-weight:bold; font-size:16px; margin-top:5px; color:aliceblue">ADD SEMESTER</h4><br>
                            <label>Semester : </label><br>
                            <input type="text" name="semester" placeholder="Add semester such as 1st" ><br><br>                  
                            <input type="submit" name="submit" class="btn">
                            </form>
                            <?php
                            if(isset($_POST['submit'])){
                                $semester=$_POST['semester'];

                                $sql = "INSERT into main(semester) VALUES('$semester')";
                                if(mysqli_query($conn,$sql)){
                                    echo"<script>alert('You have successfully inserted the data');</script>";
                                    ?>
                                    <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/nhome.php?username=<?php echo $_SESSION["username"]; ?>">
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
    <li role="none"><span>
        
        <a href="request2.php?username=<?php echo $_SESSION["username"]; ?>" class="nav-link" role="menuitem">Request</a>
    </span></li>

    <li role="none"><span>
        <a href="profile.php?username=<?php echo $_SESSION["username"]; ?>" class="nav-link" role="menuitem">Profile</a>
    </span></li>

    <li role="none"><span>
        <?php 
        $admin=$_SESSION["admin"];
        $query = $conn->query("SELECT COUNT(status) as total FROM  message WHERE status='no' and username='$admin' and sender='admin'");
        $result=mysqli_fetch_array($query);
        ?>
        <a href="messages.php?username=<?php echo $_SESSION["username"]; ?>" class="nav-link" role="menuitem">Message
        <span id="count"><?PHP echo $result['total']; ?></span>
    </a></span></li>

    <li style="margin-right:25px;">
        <form action="logout.php" method="POST">
        <h2 onclick = "return logout()" >
        <input type="submit" class="logout" name="logout" value="<?php echo $_SESSION["username"]." Logout"; ?>" >
        </h2>
        </form>
    </li>
</ul>

</nav>
</header>
<!-- header ends here -->

<div class="php-con">
<h1 class="status">
<?php 
    if(isset($_SESSION['status'])){ 
        echo $_SESSION['status']; 
        unset($_SESSION['status']);
    }
?>
</h1>
 
</div>
<div class="card-containers" style="margin:150px 50px 100px 50px;">
    <?php
        $result = $conn->query("SELECT * FROM main order by semester asc");
        while($row=mysqli_fetch_array($result)){ 
    ?>     
    <div class="card">
        <div class="img-style">
        <img src="/noteapp/assets/images/images.jpg" alt="">
        </div>
        <div class="card-body">
            <div class="card-title">
                <?php echo $row['semester'].' Semester'; ?>
            </div>
            <div class="card-des">
            All resources releated to <?php echo $row['semester'] ?> semester subjects...
            </div>
            <div class="bottom-container">
                <a href="subject.php?sem=<?php echo $row['semester'] ?>" class="bottom">Click Here</a>
            </div>
        </div>
    </div>

    <?php 
        }
    ?>
</div>

<script>
function logout()
{
    return confirm('Are you sure you want to logout?');
}
</script>
<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html> 