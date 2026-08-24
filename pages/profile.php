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
    <title>profile</title>

    <link rel="stylesheet" href="/noteapp/assests/css/style.css">
    <style>
        .php-con{
            margin: 20px auto;
        }
        .status{
            text-align: center;
            color:white;

        }
        body{
            width:108%;
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;
        } 
        header{
            width:100.5%;
        }
        .main{
            width:80%;
            height:485px;
            margin-top:180px;
            margin-left:130px;
            background: rgba(0,0,0,0.6);
            text-align:center;
            border: 3px solid #fff;
            border-radius: 70px 0 70px;
            
        }
        .main .first{
            font-size:15px;
            width:100%;
            height:30px;
            color:Aquamarine;
            font-weight:100%;
            padding:25px;
        }
        .main .second{
            width:100%;
            height:455px;
        }
        .main .second .image{
            width:21%;
            height:370px;
            float:left;
            margin-top:20px;
            margin-left:30px;
            background-color:darkslategray;
            border:5px solid black;
            border-radius:70px 0 70px;
        }
        .main .second .image img{
            height:100px;
            width:100px;
            margin-top:70px;
            
        }
        .main .second .image a{
            font-size:18px;
            color:white;
            
        }
        .main .second .body{
            width:45%;
            height:370px;
            padding:30px;
            margin-top:20px;
            margin-left:30px;
            float:left;
            background-color:darkslategray;
            border:5px solid black;
            border-radius:70px 70px 70px 70px;
        }
        .main .second .body p{
            font-size : 18px;
            text-align : left;
            padding : 10px;
            color :white;
        }
        .main .second .image2{
            width:21%;
            height:370px;
            float:right;
            color:white;
            font-size:18px;
            background-color:darkslategray;
            border:5px solid black;
            border-radius:70px 0 70px;
            margin-top:20px;
            margin-right:30px;

        }
        .status{
            margin-top:10px;
            text-align: center;
            color:white;
            font-size:18px;
        }
        .image2 h3{
            margin-top:70px;
        }
        img{
           width:190px; 
           height:150px;
           margin-top:25px;
        }
        span{
            color:#B0BF1A;
            font-size:16px;
            font-weight:bold;
        }
    </style>
</head>
<body>

<!-- header starts here -->

<header id="blog-header" style="position: fixed;top: 0;padding: 15px;">
   <!-- <figure class="logo-figure">
        <i class="fab fa-autoprefixer logo"></i>
    </figure> -->
    <h1>NOTES APP</h1>
    <nav aria-label="Main Menu">
<ul role="menubar">

    <li role="none">
        <a href="messages.php" class="nav-link" role="menuitem">Message</a>
    </li>
</ul>

</nav>
</header>
<body>
<?php
    $username=$_SESSION["username"];
    $array=array();
    $query=mysqli_query($conn,"SELECT * FROM profile WHERE Username='$username'");
    while($row=mysqli_fetch_array($query)){
        $array['Name']=$row['Name'];
        $array['Roll']=$row['Roll'];
        $array['Session']=$row['Session'];
        $array['Email']=$row['Email'];
        $array['PhoneNumber']=$row['PhoneNumber'];
        $array['Batch']=$row['Batch'];
        $image=$row['Image'];
        $id=$row['Id'];

    }
?>
    <div class="main">
        <div class="first">
              <em>  <p><h2>PROFILE</h2></p> </em>
        </div>

        <div class="second">
            <div class="image">
                <em>
                <img src="/noteapp/assests/images/people.png" alt=""><br><br><br>
                <a href="nhome.php?username=<?php echo $username ?>">Home</a><br><br><br>
                <a href="updatestudentprofile.php?id=<?php echo $id ?>">Update</a><br><br><br>
                <a href="messages.php">Message</a><br><br><br>
                </em>
            </div>


            <div class="body">
                
               <p><span>NAME : </span> <em><?php echo $array['Name']; ?></p></em>
               <p><span>USERNAME : </span> <em><?php echo $username; ?></p></em>
               <p><span>ROLL : </span> <em><?php echo $array['Roll']; ?></p></em>
               <p><span>SESSION : </span> <em><?php echo $array['Session']; ?></p></em>
               <p><span>EMAIL : </span> <em><?php echo $array['Email']; ?></p></em>
               <p><span>PHONE NUMBER : </span> <em><?php echo $array['PhoneNumber']; ?></p></em>
               <p><span>DATE OF BIRTH : </span> <em><?php echo $array['Batch']; ?></p></em>
               
            </div>
            <div class="image2">
                <em><p> <h3>User Image </h3>
                <?php echo "<img src='../uploads/Images/$image'>" ?>
                </p></em>
            </div>
        </div>
    </div>
</body>
</html>