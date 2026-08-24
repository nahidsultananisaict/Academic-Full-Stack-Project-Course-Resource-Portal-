<?php
    session_start();
    error_reporting(0);
    include_once '../includes/config.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Message</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="/noteapp/assests/css/style.css">
</head>
<style>
    body{
        width:108%;
    }
    header{
        margin:0 7px 0 7px;
        width:99%;
    }
    .main{
        width:70%;
        min-height:83vh;
        overflow:hidden;
        background-color:black;
        margin-left:180px;
        margin-top:20px;
    }
    /* ---------------------- */
    .leftdiv{
        width:30%;
        min-height:79vh;
        overflow:hidden;
        margin-left:10px;
        margin-top:10px;
        float:left;
    }
    .rightdiv{
        width:66%;
        min-height:79vh;
        overflow:hidden;
        background-color:darkslategrey;
        margin:10px;
        float:right;
    }
    /* -------------------- */
    /* leftdiv */
    .head{
        width:100%;
        height:8vh;
        color:white;
        font-weight:bolder;
        padding:5px;
    }
    .userlist{
        width:100%;
        min-height:70vh;
        overflow:hidden;
        color:white;
        font-weight:bolder;
        margin-top:6px;
        overflow-y:scroll;
        padding:5px;
    }
    .user{
        width:100%;
        height:8vh;
        border:3px solid white;
    }
    .userimage{
        float:left;
        height:100%;
        width:20%;
        padding:6px;
    }
    .username{
        float:left;
        height:100%;
        width:80%;
        padding:5px 0;
        font-size:16px;
    }
    img{
        width:30px;
        height:30px;
        border-radius:15px;
    }
    /* rightdiv */
    .receiver{
        font-size:12px;
        color:white;
        font-weight:bolder;
        text-align:center;
        background-color:brown;
        padding:10px;
    }
    .msg{
        height:73vh;
        overflow-y:scroll;
    }
    /* ====================== */
    .text{
        width:100%;
        min-height:35px;
        overflow:hidden;
        margin-bottom:5px;
        padding-left:8px;
    }
    .chatimage{
        float:right;
        width:10%;
        height:100%;
        margin-top:15px;
        padding-left:8px;
        padding-top:2px;
        font-size:15px;
        letter-spacing:0.8px;
        border-radius:5px;
    }
    .chat{
        float:left;
        width:90%;
        min-height:100%;
        overflow:hidden;
        background-color:grey;
        color:white;
        font-size:15px;
        letter-spacing:0.8px;
        border-radius:5px;
        word-wrap:break-word;
        padding:6px 10px;
        margin-top:15px;
    }
    .text1{
        width:100%;
        min-height:35px;
        overflow:hidden;
        margin-bottom:5px;
        padding-left:3px;
    }
    .chatimage1{
        float:left;
        width:8%;
        height:100%;
        margin-top:15px;
        padding-left:5px;
        padding-top:3px;
        font-size:15px;
        letter-spacing:0.8px;
        border-radius:5px;
    }
    .chat1{
        float:left;
        width:90%;
        min-height:100%;
        overflow:hidden;
        background-color:brown;
        color:white;
        font-size:15px;
        letter-spacing:0.8px;
        border-radius:5px;
        word-wrap:break-word;
        padding:6px 10px;
        margin-top:15px;
    }
    /* ======================== */
    .bottom{
        height:35px;
        width:47%; 
        position:absolute; 
        bottom:25px;
    }
    .bottom .form-control{
        height:30px;
        width:82%;
    }
    .btn{
        color:black;
        height:30px;
        width:16%;
        border-radius:5px;
        margin-left:4px;
        background-color:brown;
        cursor:pointer;
    }
</style>
<body>
        
    <header id="blog-header">
        <h1>NOTES APP</h1>
        <h2 style="font-weight:bolder; font-size: 20px; color:Aquamarine; letter-spacing:1px">CHAT BOX</h2>

    <nav aria-label="Main Menu">
    <ul role="menubar">
        <?php 
            $admin=$_SESSION["admin"]; 
        ?>
        <li ><a href="home.php?username=<?php echo $admin; ?>"><span  style="font-family:poppins; font-size:18.5px; color:aliceblue; margin-right:10px">Home</span></a></li>
    </ul>
    </nav>
    </header>

    <div class="main">
        <div class="leftdiv">
            <!-- =============================================== -->
            <div class="head">
                <h1>CHAT</h1>
            </div>
            <div class="userlist">
            <?php 
            $query = $conn->query("SELECT * FROM  profile");
            while($result=mysqli_fetch_array($query)){
                $username=$result['Username'];
                $image=$result['Image'];
            ?>
            <div class="user">
                <div class="userimage">
                    <?php echo "<img src='../uploads/Images/$image'>"; ?>
                </div>
                <div class="username">
                    <?php 
                    $c=0;
                    $status="no";
                    $sender="student";
                    $sql4 ="SELECT * FROM message WHERE status='$status' and sender='$sender' and username='$username'";
                    $data4=mysqli_query($conn,$sql4);
                    while($row4=mysqli_fetch_assoc($data4)){$c++;}
                    ?>
                    <form action="message.php" method="post">
                    <input type="submit" name="user" style="background-color:black; color:white; width:90%; height:100%; text-align:left; padding:5px" value="<?php echo $username; ?>"> 
                    <span style="color:red;"><?php echo $c; ?></span>
                    </form>
                </div>
            </div>  
            <br>         
            <?php }  ?>
            </div>
            <!-- =============================================== -->
        </div>
        <?php 
            if(isset($_POST['user'])){ 
                $user=$_POST['user'];
                $admin=$_SESSION["admin"];
                $sql1 ="SELECT * FROM message order by id asc";
                $data1=mysqli_query($conn,$sql1);
            ?>
            <!-- ==================================================================== 

                <script>
                    $(document).ready(function(){
                        setInterval(function(){
                            $("#autorefresh").load(window.location.href = "#autorefresh");
                        }, 3);
                        });
                </script>
            -->


        <div class="rightdiv" id="autorefresh">
            <!-- heading part -->
            <div class="receiver">
                <h1><?php echo $user; ?></h1>
            </div>

            <!-- msg show part -->
            <div class="msg">
                <!-- msg fecth -->
                <?php
                    while($row1=mysqli_fetch_assoc($data1)){
                        if(($row1['sender'] == "admin") && ($row1['username'] == $admin) && ($row1['receiver'] == $user)){
                            $msg=$row1['message'];
                ?>
                <!-- msg fetch -->
                <div class="text">
                    <?php
                    $q = $conn->query("SELECT * FROM admin WHERE username='$admin'");
                    while($r=mysqli_fetch_array($q)){
                        $i=$r['image'];
                    }
                    ?>
                    <div class="chatimage">
                        <?php echo "<img src='../uploads/Images/$i'>"; ?>
                    </div>
                    <div class="chat">
                        <p style="padding:3px"><?php echo $msg; ?></p>
                    </div>
                </div>
                <?php 
                }
                if(($row1['sender'] == "student") && ($row1['username'] == $user) && ($row1['receiver'] == "admin")){
                    $msg=$row1['message'];
                ?>
                <div class="text1">
                    <?php
                    $q1 = $conn->query("SELECT * FROM profile WHERE Username='$user'");
                    while($r1=mysqli_fetch_array($q1)){
                        $i1=$r1['Image'];
                    }
                    ?>
                    <div class="chatimage1">
                        <?php echo "<img src='../uploads/Images/$i1'>"; ?>
                    </div>
                    <div class="chat1">
                        <p style="padding:3px"><?php echo $msg; ?></p>
                    </div>
                </div>
        
            
            <?php 
                $query5 = $conn->query("UPDATE message set status='yes' WHERE sender='student' and username='$user'");
            } } 
            ?>
            </div>    
            <!-- bottom part -->
            <div class="bottom">
                <form action="message.php" method="post">
                    <input type="hidden" name="use" value="<?php echo $user; ?>">
                    <input type="text" name="msg" class="form-control" required placeholder="  Write Message....." >
                    <button type="submit" name="submit" class="btn">Send</button>
                </form>
            </div>
        </div>
        <?php } 
            else
            { ?>
            <h1 style="color:white; font-size:25px; font-weight:bolder; text-align:center; margin:200px 100px 0 350px; letter-spacing:1px"><?php echo "WELCOME TO CHAT"; ?></h1>
            <h2 style="color:white; text-align:center; margin:20px 100px 0 350px">Choose a user to start...</h2>
        <?php      
            }
        ?> 
        <!-- ======================================================================== -->
    </div>




<!-- okkkkkkkkkkkkkkkkkkkkkkkkkkkkkkkayyyyyyyyyyyyyyyyyyyyyyyyyy -->



<?php
            if((isset($_POST['submit']))){
                $user=$_POST["use"];
                $admin=$_SESSION["admin"];
                $msg=$_POST['msg'];
                $status="no";
                $sender="admin";
                $receiver=$user;
                $sql ="INSERT into message(username,message,status,sender,receiver) VALUES('$admin','$msg','$status','$sender','$receiver')";
                $data=mysqli_query($conn,$sql);
            }
        ?>

<!-- ============================================================== -->




<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>       