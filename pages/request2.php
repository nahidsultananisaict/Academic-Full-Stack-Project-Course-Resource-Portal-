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
    <title>About</title>
    <link rel="stylesheet" href="/noteapp/assets/css/style.css">
    <style>
        body{
            width:108%;
        }
        header{
            margin:0px;
            width:100.5%;
        }
        .contact{
            width:100%;
            min-height:70vh;
            display:grid;
            grid-template-columns:repeat(2, 2fr);
            align-items:center;
            grid-gap:6rem;
        }
        .contact .contact-form1{
            width:100%;
            height:100%;
            float:left;
            padding-left:50px;
            padding-top:50px;
        }
        .contact .contact-form2{
            float:right;
            width:100%;
            height:100%;
            padding-right:50px;
            padding-top:60px;
        }
        h1{
            padding-top:20px;
            color:#fff;
        }
        span{
            color:#f9004d;
        }
        input,textarea{
            width:100%;
            padding:17px;
            border:none;
            outline:none;
            background:#191919;
            color:#fff;
            font-size:1.2rem;
            margin-bottom:0.7rem;
            border-radius:10px;
        }
        textarea{
            resize:none;
            height:200px;
        }
        .btn{
            display:inline-block;
            background:#f9004d;
            font-size:15px;
            letter-spacing:1px;
            text-transform:uppercase;
            font-weight: 600;
            border:3px solid transparent;
            border-radius: 10px;
            width:150px;
            height:30px;
            transition: ease .20s;
            cursor:pointer;
            padding:4px;
            margin-left:180px;
            margin-top:10px;
            border-radius:20px 0 20px;
        }
        .btn:hover{
            border:2px solid #f9004d;
            background:black;
            transform:scale(1.1);
        }
    </style>
</head>
<body>
<header id="blog-header" style="position: fixed;top: 0;padding: 15px;">
   <!-- <figure class="logo-figure">
        <i class="fab fa-autoprefixer logo"></i>
    </figure> -->
    <h1>NOTES APP</h1>

<nav aria-label="Main Menu">
<ul role="menubar">
    <li role="none"><span>
        <a href="nhome.php" class="nav-link" role="menuitem">Home</a>
    </span></li>

    <li role="none"><span>
        <a href="profile.php" class="nav-link" role="menuitem">Profile</a>
    </span></li>
</ul>

</nav>
</header>
<!-- header ends here -->
<!-- access database -->
<?php
    $username=$_GET['username'];
    $query = $conn->query("SELECT * FROM profile WHERE Username='$username'");
    while($row=mysqli_fetch_array($query)){
        $req=$row['request'];
        if($req == 0){


?>
<!-- end -->

<h1 style="font-size:40px; text-align:center; padding-top:100px">Request For<span> Permission</span></h1>

<div class="contact">
        <div class="contact-form1">
        <form action="request2.php" method="GET">
            <input type="text" name="roll" value="<?php echo $row['Roll']; ?>" readonly>
            <input type="text" name="name" value="<?php echo $row['Name']; ?>" readonly>
            <input type="text" name="batch" value="<?php echo $row['Batch']; ?>" readonly>
            <input type="text" name="session" value="<?php echo $row['Session']; ?>" readonly>
            <input type="text" name="username" value="<?php echo $row['Username']; ?>" readonly>
            <input type="email" name="email" value="<?php echo $row['Email']; ?>" readonly>
        </div>
        <div class="contact-form2">
            <input type="text" name="sub" placeholder="Enter Your Subject" required>
            <textarea name="reason" id="" cols="30" rows="10" placeholder="Enter Your Reason" required></textarea>
            <input type="submit" name="submit" value="Request" class="btn">
        </div>
    </form>
</div>


<!--  -->
<?php
    }
    else{ ?>
        <h2 style="font-size:20px; border:10px solid pink; text-align:center; margin-top:15%; margin-left:25%; margin-right:30%; height:100px; padding:30px; background-color:green; font-weight:bolder; color:yellow"><?php echo "You have already sent a request !!!";?></h2>
        <?php
    }
}
?>
<?php 
        if(isset($_GET["submit"])){
            $roll=$_GET["roll"];
            $name=$_GET["name"];
            $batch=$_GET["batch"];
            $session=$_GET["session"];
            $username=$_GET["username"]; 
            $email=$_GET["email"];                  
            $subject=$_GET["sub"];
            $reason=$_GET["reason"];
            $status=0;
            $request=1;
            $seen="no";
            $sql1="UPDATE profile SET request='$request' WHERE Username='$username'";
            $data=mysqli_query($conn,$sql1);
            $sql ="INSERT into request(roll,name,batch,session,username,email,subject,reason,status,seen) VALUES('$roll','$name','$batch','$session','$username','$email','$subject','$reason','$status','$seen')" ;
    
            if(mysqli_query($conn,$sql)){
                echo"<script>alert('You have successfully submitted your request');</script>";
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/nhome.php?username=<?php echo $username ?>">
                <?php
            }
            else{
                echo"<script>alert('Something went wrong please try again later');</script>";
            }
        }
?>
<!--  -->
</body>
</html>

