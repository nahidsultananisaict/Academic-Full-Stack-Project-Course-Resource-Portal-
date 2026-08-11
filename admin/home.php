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
    <title>Admin</title>
    <link rel="stylesheet" href="/noteapp/assets/css/style.css">
    <style>
        .container{
            width:99.8%;
            height:100vh;
            padding-left:60px;
        }
        .container .container-top{
            width:100%;
            height:15%;
            background-color:black;
            color:white;
            
        }
        .container .cotainer-body{
            
            width:100%;
            height:85%;
            background-color:darkslategray;
            padding:40px;
        }
        .container .cotainer-body .div1{
            width:24.5%;
            height:100%;
            float:left;
            border:1px solid black;
        }
        .container .cotainer-body .div2{
            width:73.5%;
            height:100%;
            float:right;
            margin-right:10px;
            border:1px solid black;
            padding:5px 50px 50px 50px;
        }
        .container .cotainer-body .div2 .info{
            float:left;
            width:60%;
            height:100%;
        }
        .container .cotainer-body .div2 .image{
            float:right;
            width:40%;
            height:100%;
        }
        .container .cotainer-body .div2 .image img{
            padding:30% 10% 8% 10%;
            width:100%;
            height:100%;
        }
        .container .cotainer-body .div1 .div1a{
            width:100%;
            height:30%;
            padding-left:40px;
        }
        .container .cotainer-body .div1 .div1a h2{
            padding-top:20px;
        }
        .container .cotainer-body .div1 .div1a img{
            width:100px;
            height:100px;
        }
        .container .cotainer-body .div1 .div1b{
            width:100%;
            height:70%;
            padding-top:40px;
        }
        .container .cotainer-body .div1 .div1b h2{
            font-size: 18px;
            color:white;
            padding:10px 10px 10px 30px;
            width:100%;
        }
        span{
            padding:1rem;
        }
        .container .cotainer-body .div2 p{
            font-size : 18px;
            text-align : left;
            padding : 10px;
            color :white;
        }
        .span{
            color:#B0BF1A;
        }
        #count{
            border-radius:50%;
            position:relative;
            top:-10px;
            left:-10px;
            color:red;
            font-size:18px;
        }
        #count1{
            border-radius:50%;
            position:relative;
            top:-10px;
            left:-10px;
            color:red;
            font-size:18px;
        }
        .logout{
            color:Aquamarine;
            background-color:black;
            cursor:pointer;
            padding:5px;
            font-size:15px;
            border:none;
            width:100%;
            height:35px;
            margin-right:90px;
        }
        ul li{
            margin-right:-30px;
        }
        ul ul{
            border:3px solid white;
            border-radius:15px;
            background-color:black;
            float:center;
            list-style:none;
        }  
        ul li ul{
            opacity:0.6;
            display:none;
            position:absolute;
            text-align:left;
            width:250px;
            min-height:50px;
            overflow:hidden;
            margin-top:10px;
        }
        ul li:hover > ul{
            display:block;
            opacity:1;
        }
        
    </style>
</head>
<body>

    <?php
        $username=$_SESSION["admin"];
        $array=array();
        $query=mysqli_query($conn,"SELECT * FROM admin WHERE username='$username'");
        while($row=mysqli_fetch_array($query)){
            $array['name']=$row['name'];
            $array['roll']=$row['roll'];
            $array['session']=$row['session'];
            $array['email']=$row['email'];
            $array['phone']=$row['phone'];
            $array['batch']=$row['batch'];
            $image=$row['image'];
            $id=$row['id'];

        }
    ?>


    <div class="container">
        <!-- top -->
        <div class="container-top">
            <header>
                <h1>NOTES APP</h1>

                <nav aria-label="Main Menu">
                    <ul role="menubar">

                        <li><span style="cursor:pointer">
                            <?php 
                            $query1 = $conn->query("SELECT COUNT(status) as total FROM  message WHERE status='no' and sender='student'");
                            $result1=mysqli_fetch_array($query1);
                            ?>
                            <a href="message.php?admin=<?php echo $username; ?>" style="color:aliceblue; font-family:poppins; font-size:18.5px">Message
                            <span id="count"><?PHP echo $result1['total']; ?></span></a></span>
                        </li>
                        
                        <li style="font-family:poppins; font-size:18.5px; color:aliceblue">
                        <?php
                            $seen="no";
                            $result = $conn->query("SELECT * FROM request WHERE seen='$seen'");
                            $count = mysqli_num_rows($result);
                            $c=0;
                        ?>
                        <span>Notifications<span id="count1"><?PHP echo $count; ?></span></span>
                                    <ul>
                                        <li>
                                            <table>
                                                <?php if($count>0){ 
                                                    while($row=mysqli_fetch_array($result)){ 
                                                    if($c<5){
                                                    ?>
                                                    <tr>
                                                        <td style="font-size:15px"><?php echo $row['roll'].' ('. $row['session'].') '; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td style="font-size:12px; color:pink; padding-bottom:15px"><?php echo $row['subject']; ?></td>
                                                    </tr>
                                                <?php  $c++; } } } ?>
                                            </table>
                                        </li>
                                        <li><a href="requested.php" style="color:white">See More</a></li>
                                    </ul>
                        </li>

                        <li >
                        <form action="logout.php" method="POST">
                        <h2 onclick = "return logout()" >
                        <input type="submit" name="logout" value="<?php echo $_SESSION["admin"]." Logout"; ?>" class="logout" >
                        </h2>
                        </form>
                        </li>
                    </ul>
                </nav>
            </header>
        </div>
        <!-- body -->
        <div class="cotainer-body">
            <!-- leftpart -->
            <div class="div1">
                <!-- upper portion of leftpart -->
                <div class="div1a">
                    <h2 style="padding-bottom: 10px; font-size:20px; font-weight:bolder; color:Aquamarine"><em><span style="color:Aquamarine"><?php echo 'Hello! '.$_SESSION["admin"]; ?></em></h2>
                    <img src="/noteapp/assets/images/people.png" alt="">
                </div>
                <!-- lower portion of leftpart -->
                <div class="div1b">
                    <em>
                    <a href="nhome.php"><h2><span>User Panel</span></h2></a>
                    <a href="requested.php"><h2><span>Request</span></h2></a>
                    <a href="approve.php"><h2><span>Approved Request</span></h2></a>
                    <a href="delete.php"><h2><span>Deleted Request</span></h2></a>
                    <a href="updateprofile.php?id=<?php echo $id ?>"><h2><span>Update Profile</span></h2></a>
                    <a href="member.php"><h2><span>Member</span></h2></a>
                    </em>  
                </div>
            </div>
            <!-- rightpart -->

            <div class="div2">
                <div class="info">
                    <em><h1 style="font-size:30px; font-weight:bold; color:Aquamarine; text-align:left; padding:30px 0 30px 15px">PROFILE</h1></em>
                    <p><span class="span">NAME : </span> <em><?php echo $array['name']; ?></p></em>
                    <p><span class="span">USERNAME : </span> <em><?php echo $username; ?></p></em>
                    <p><span class="span">ROLL : </span> <em><?php echo $array['roll']; ?></p></em>
                    <p><span class="span">SESSION : </span> <em><?php echo $array['session']; ?></p></em>
                    <p><span class="span">EMAIL : </span> <em><?php echo $array['email']; ?></p></em>
                    <p><span class="span">PHONE NUMBER : </span> <em><?php echo $array['phone']; ?></p></em>
                    <p><span class="span">BATCH : </span> <em><?php echo $array['batch']; ?></p></em>
                </div>
                <div class="image">
                    <?php echo "<img src='/noteapp/assets/images/$image'>" ?>
                </div>
            </div>
        </div>
    </div>


<script>
function logout()
{
    return confirm('Are you sure you want to logout?');
}
</script>
</body>
</html>