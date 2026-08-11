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
    <link rel="stylesheet" href="/noteapp/assets/css/style.css">
    <style>
        body{
            width:108%;
        }
        header{
            margin:0px;
            width:100.5%;
        }
        .chatbox{
            height:82vh;
            width:45%;
            background-color:black;
            opacity:.9;
            color:white;
            margin-top:100px;
            margin-left:350px;
            padding:10px;
        }
        .head{
            height:50px; 
            width:100%; 
            background-color:brown; 
            text-align:center; 
            color:white; 
            padding:13px;
        }
        .msg{
            height:66vh;
            overflow-y:scroll;
        }
        .text1{
            width:100%;
            min-height:35px;
            overflow:hidden;
            margin-bottom:5px;
        }
        .image1{
            float:right;
            width:10%;
            height:100%;
            margin-top:15px;

        }
        .image1 img{
           width:30px; 
           height:30px;
           border-radius:15px;
           margin-left:8px;
           margin-top:3px;
        }
        .image2{
            float:left;
            width:7.5%;
            height:100%;
            margin-top:15px;
        }
        .image2 img{
           width:30px; 
           height:30px;
           border-radius:15px;
           margin-right:8px;
           margin-top:3px;
        }
        
        .chat1{
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
        .chat2{
        float:left;
        width:90%;
        min-height:100%;
        overflow:hidden;
        background-color:darkslategrey;
        color:white;
        font-size:15px;
        letter-spacing:0.8px;
        border-radius:5px;
        word-wrap:break-word;
        padding:6px 10px;
        margin-top:15px;
        }
        .bottom{
            height:35px;
            width:44%; 
            padding-top:5px;
            position:absolute; 
            bottom:22px;
        }
        .form-control{
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
</head>

<body>


    <?php
        $admin=$_SESSION["admin"];
        $username=$_SESSION["username"];

        if(isset($_POST['submit'])){
            $msg=$_POST['msg'];
            $status="no";
            $sender="student";
            $receiver=$admin;
            $sql ="INSERT into message(username,message,status,sender,receiver) VALUES('$username','$msg','$status','$sender','$receiver')";
            $data=mysqli_query($conn,$sql);
            if($data){
                ?>
                <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/pages/messages.php?username=<?php echo $_SESSION["username"]; ?>">
                <?php
            }
        }
        else{
            $sql1 ="SELECT * FROM message order by id asc";
            $data1=mysqli_query($conn,$sql1); 
    ?>


    <header id="blog-header" style="position: fixed;top: 0;padding: 15px;">
        <h1>NOTES APP</h1>
        <h2 style="font-weight:bolder; font-size: 20px; color:Aquamarine; letter-spacing:1px">CHAT BOX</h2>

    <nav aria-label="Main Menu">
    <ul role="menubar">
        <li ><a href="nhome.php?username=<?php echo $_SESSION["username"]; ?>"><span  style="font-family:poppins; font-size:18.5px; color:aliceblue; margin-right:10px">Home</span></a></li>
    </ul>
    </nav>
    </header>

    <div class="chatbox">
        <div class="head">
            <h1>Admin</h1>
        </div>
        <!-- ////////////////////////////////// -->


        <div class="msg">
            <br>
            <?php
                while($row1=mysqli_fetch_assoc($data1)){
                    if(($row1['sender'] == "student") && ($row1['username'] == $username) && ($row1['receiver'] == $admin) ){
                        $msg=$row1['message'];
            ?>

            <div class="text1">
                <!-- image -->
                <div class="image1">                   
                    <?php
                    $query = $conn->query("SELECT * FROM profile WHERE Username='$username'");
                    while($result=mysqli_fetch_array($query)){
                        $image=$result['Image'];
                    }
                    ?>
                    <!-- image -->
                    <?php echo "<img src='../uploads/Images/$image'>"; ?>
                </div>

                <div class="chat1">
                    <p style="padding:3px"><?php echo $msg; ?></p>
                </div>

            </div>
            <?php } 
        
            if(($row1['sender'] == "admin") && ($row1['username'] == $admin) && ($row1['receiver'] == $username)){
                $msg=$row1['message'];
                ?>
                <div class="text1">
                    <!-- image -->
                    <div class="image2">                   
                        <?php
                        $query1 = $conn->query("SELECT * FROM admin WHERE username='$admin'");
                        while($result1=mysqli_fetch_array($query1)){
                            $image=$result1['image'];
                            
                        }
                        ?>
                        <!-- image -->
                        <?php echo "<img src='../assets/images/$image'>"; ?>
                    </div>

                    <div class="chat2">
                        <p style="padding:3px"><?php echo $msg; ?></p>
                    </div>

                </div>
            <?php } } } ?>
            <br>
        </div>
        <!-- ///////////////////////////////// -->

        <div class="bottom">
            <form action="" method="post">
                <input type="text" name="msg" class="form-control" required placeholder="  Write Message....." >
                <button type="submit" name="submit" class="btn">Send</button>
            </form>
        </div>
    </div>
    <?php
    $q = $conn->query("UPDATE message set status='yes' WHERE sender='admin' and username='$admin'");
    $re=mysqli_fetch_array($q);
    ?>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>