<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            width:1100px;
            background:grey;
            height: 550px;
        }
        .state{
            text-align:center;
            color:black;
        }
        .status{
            text-align: center;
            color:green;

        }
        .div1{
            margin:60px 50px 50px 150px;
            width:1000px;
            height:480px;
            border:20px solid black;
        }
        .div2{
            float:left;
            width:50%;
            height:100%;
            background:url("assests/images/imag1.jpg") no-repeat;
            background-size:100% 100%;
            color:  black;
            box-sizing: border-box;
            padding: 20px 40px;
        }
        .div3{
            float:right;
            width:50%;
            height:100%;
            background:url("assests/images/pic2.jpg") no-repeat;
            background-size:100% 100%;
        }
        h1{
            margin: 0;
            padding: 0 0;
            text-align: center;
            font-size: 30px;
        }
        .div2 p{
            margin-bottom: 5px;
            padding: 0;
            font-size: 20px;
            font-weight: bold;
        }
        .div2 input{
            width:100%;
            margin-bottom: 10px;
        }
        .div2 input[type="text"], input[type="password"]{
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 40px;
            color: #556B2F;
            font-size: 15px;
            font-weight: bold;
        }
        .div2 input[type="submit"]{
            border: none;
            outline: none;
            height: 35px;   
            background: #2F4F4F;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            margin-top:20px;
        }

        .div2 input[type="submit"]:hover{
            cursor: pointer;
            background: grey;
            color: #000;
        }
        .div2 a{
            text-decoration: none;
            font-size: 18px;
            font-weight: bold;
            line-height: 20px;
            color: black;
        }

        .div2 a:hover{
            color: #ffc107;
        }

        label{
            color: #556B2F;
            font-size: 18px;
            font-weight: bold;
        }


    </style>
</head>
<body>
        <h3 class="state">
        <?php 
                if(isset($_SESSION['state'])){ 
                    echo $_SESSION['state']; 
                    unset($_SESSION['state']);
                }
            ?>
        </h3>
        <div class="div1">
        <div class="div2">
        <h1>Login Here</h1>
        <h4 class="status">
        <?php 
            if(isset($_SESSION['status'])){ 
                echo $_SESSION['status']; 
                unset($_SESSION['status']);
            }
        ?>
        </h4>
        <form action="login.php" method="post">
        <b><p style="margin-bottom: 15px; font-size: 21px; font-weight:bold; margin-top:35px">Login As : </p></b>           
            <input style="width:18px" type="radio" name="user" id="admin" value="Admin">
            <label>Admin</label>
            <input style="margin-left: 70px; width:18px" type="radio" name="user" id="student" value="Student">
            <label>Student</label><br>
            <p>User Name</p>
            <input type="text" name="username" placeholder="Enter Username" required><br>
            <p>Password</p>
            <input type="password" name="password" placeholder="Enter Password" required><br>
            <input type="submit" name="submit" value="Login"><br>
            <a href="reg.php">Don't have an account?</a>
        </form>
        </div>
        <div class="div3"></div>
    </div>
</body>
</html>

