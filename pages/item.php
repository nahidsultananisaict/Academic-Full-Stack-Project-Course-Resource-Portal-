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
    <title>Item
    </title>

    <link rel="stylesheet" href="/noteapp/assests/css/style.css">
    <style>
        .heading h1 {
            margin-top:70px;
            padding:20px;
            padding-left: 30%;
            font-size:20px;
            font-weight:bolder;
            color:white;
            text-align:center;
        }
        .heading h2 {
            font-size:20px;
            padding-left:30%;
            font-weight:bolder;
            color:white;
            text-align:center;
        }
        .topic-container{

        width: 900px;  /*div size in width */
        margin:auto;
        display:block;
        margin-top:4%;
        font-family: sans-serif;
        margin-left:24%;
        }
        
        .cards{

        float: left;
        margin: 24px;
        display: flex;
        align-items: center;
        flex-direction: column;
        width: 250px;
        height: 260px;
        overflow: hidden;
        background: #fff;
        border-radius: 5px;
        box-shadow: 0 0 3px rgb(15, 15, 15);
        transition: all 0.4s;
        }
        .cards:hover{

        transform: translateY(-6px);
        }

        .img-styling{

        display: block;
        width: 100%;
        height: 260px;
        overflow: hidden;
        }
        .img-styling img{

            width:100%;
        }
        .img-styles{

        display: block;
        width: 100%;
        height: 165px; 
        overflow: hidden;
        }
        .img-styles img{

            width:100%;
        }

        .card-bodies{

        display: flex;
        align-items: center;
        flex-direction: column;
        }
        .card-bodies .card-title{
        padding: 10px; 
        font-size: 20px;
        font-weight: bolder;
        color: rgb(27, 136, 32);
        }
        .card-bodies .bottom-container{

        display: flex;
        align-items: center;
        text-align: center;
        }
        .card-bodies .bottom-container .bottom{

        width: 100%;
        padding: 5px 0;
        text-decoration: none;
        background: linear-gradient(125deg, #00ff35, #0091a7 60%);
        color: #fff;
        border-radius: 5px;
        font-size: 15px;
        transition: all 0.4s;
        }

        .card-bodies .bottom-container .bottom:hover{

        padding-left: 15px;
        }
        span{
            padding: 1.5rem;
        }
        li>span:hover{
            background:blue;
            border-radius: 0.6rem;
        }


    </style>
</head>
<body>
    <header id="blog-header" style="width:104%;position: fixed;top: 0;padding: 15px;">
   <!-- <figure class="logo-figure">
        <i class="fab fa-autoprefixer logo"></i>
    </figure> -->
    <h1>NOTES APP</h1>

<nav aria-label="Main Menu">
<ul role="menubar">

    <li role="none"><span>
        <a href="nhome.php" class="nav-link" role="menuitem">Home</a>
    </span></li>

    <li role="none" style="margin-right:35px;"><span>
        <a href="profile.php" class="nav-link" role="menuitem">Profile</a>
    </span></li>
</ul>

</nav>
</header>
<!-- header ends here -->
<div class="heading">


    <?php 
        if(isset($_GET['code'])){
        $code=$_GET['code'];
        echo "<h1> $code</h1>";
        $result = $conn->query("SELECT course FROM subject WHERE coursecode='$code'");
        while($row=mysqli_fetch_array($result)){ 
            $subject=$row['course'];
            echo "<h2> $subject</h2>";
        }
    }
    ?>


</div>
    <?php 
        if(isset($_GET['code'])){
        $code=$_GET['code'];
    ?>

<div class="topic-container">
    <div class="cards">
        <div class="img-styling">
        <img src="/noteapp/assests/images/topic2.jpg" alt="">
        </div>
        <div class="card-bodies" style="height:100px">
            <div class="card-title">
                Topics
            </div>
            <div class="bottom-container" style="height: 60px; width:180%">
                <a href="topic.php?code=<?php echo $code ?>" class="bottom">See More</a>
            </div>
        </div>
    </div>

    <div class="cards">
        <div class="img-styling">
        <img src="/noteapp/assests/images/question1.jpg" alt="">
        </div>
        <div class="card-bodies" style="height:100px">
            <div class="card-title">
                Previous Year Question
            </div>
            <div class="bottom-container" style="height: 60px; width:65%">
                <a href="question.php?code=<?php echo $code ?>" class="bottom">See More</a>
            </div>
        </div>
    </div>

    <div class="cards">
        <div class="img-styles">
        <img src="/noteapp/assests/images/important1.jpg" alt="">
        </div>
        <div class="card-bodies" style="height:90px">
            <div class="card-title">
                Important Topics
            </div>
            <div class="bottom-container" style="height: 50px; width:90%">
                <a href="important.php?code=<?php echo $code ?>" class="bottom">See More</a>
            </div>
        </div>
    </div>
</div>

<div class="topic-container">
    <div class="cards">
        <div class="img-styling">
        <img src="/noteapp/assests/images/resources.jpg" alt="">
        </div>
        <div class="card-bodies" style="height:100px">
            <div class="card-title">
                Resources
            </div>
            <div class="bottom-container" style="height: 60px; width:120%">
                <a href="resources.php?code=<?php echo $code ?>" class="bottom">See More</a>
            </div>
        </div>
    </div>

    <div class="cards">
        <div class="img-styling">
        <img src="/noteapp/assests/images/note1.jpg" alt="">
        </div>
        <div class="card-bodies" style="height:100px">
            <div class="card-title">
                Personal Notes
            </div>
            <div class="bottom-container" style="height: 60px; width:90%">
                <a href="notes.php?code=<?php echo $code ?>" class="bottom">See More</a>
            </div>
        </div>
    </div>
    <div class="cards">
        <div class="img-styles">
        <img src="/noteapp/assests/images/viva1.png" alt="">
        </div>
        <div class="card-bodies" style="height:90px">
            <div class="card-title">
                Viva Topics
            </div>
            <div class="bottom-container" style="height: 50px; width:120%">
                <a href="viva.php?code=<?php echo $code ?>" class="bottom">See More</a>
            </div>
        </div>
    </div>
</div>
<?php
        }
?>
</body>
</html>