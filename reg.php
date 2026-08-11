<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page </title>
    <style>
        body{
            width:1100px;
            background:grey;
            height: 550px;
        }
        .stat{
            text-align: center;
            color:white;
        }
        .sta{
            text-align: center;
            color:white;
        }
        .div1{
            margin:50px 50px 50px 280px;
            width:700px;
            height:500px;
            border:20px solid black;
        }
        .div2{
            width:100%;
            height:100%;
            background:url("assests/images/lib.jpg") no-repeat;
            background-size:100% 100%;
            color:  black;
            box-sizing: border-box;
            padding: 30px 30px 20px 80px;
        }
        h1{
            margin: 0;
            padding: 0 0;
            text-align: center;
            color:black;
            font-size: 25px;
            margin-bottom: 10px;
        }
        .div2 p{
            margin-bottom: 5px;
            padding: 0;
            font-size: 18px;
            font-weight: bold;
        }
        .div2 input{
            width:90%;
            margin-bottom: 5px;
        }
        .div2 input[type="text"], input[type="email"], input[type="password"]{
            border: none;
            border-bottom: 1px solid #fff;
            background: transparent;
            outline: none;
            height: 20px;
            color: #556B2F;
            font-size: 15px;
            font-weight: bold;
        }
        .div2 input[type="submit"]{
            border: none;
            outline: none;
            height: 30px;
            background: #2F4F4F;
            color: #fff;
            font-size: 18px;
            border-radius: 20px;
            margin-top:30px;
        }

        .div2 input[type="submit"]:hover{
            cursor: pointer;
            background: grey;
            color: #000;
        }
    </style>
</head>
<body>
<h3 class="stat">
    <?php 
            if(isset($_SESSION['stat'])){ 
                echo $_SESSION['stat']; 
                unset($_SESSION['stat']);
            }
        ?>
    </h3>
    <h3 class="sta">
    <?php 
            if(isset($_SESSION['sta'])){ 
                echo $_SESSION['sta']; 
                unset($_SESSION['sta']);
            }
        ?>
    </h3>
    <div class="div1">
        <div class="div2">
        <h1>Registration Form</h1>
        <form action="register.php" method="post">
            <p>Name<span style="color:red"> *</span></p>
            <input type="text" pattern="[a-zA-Z\s]+" name="name" placeholder="Enter Name" required ><br>
            <p>User Name<span style="color:red"> *</span></p>
            <input type="text" pattern="[a-zA-Z0-9\s]+" name="username" placeholder="Enter Username" required><br>
            <p>Email<span style="color:red"> *</span></p>
            <input type="email"  pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2, 4}$" name="email" placeholder="Enter Email" required><br>
            <p>Password<span style="color:red"> *</span></p>
            <input type="password"  pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one  number and one uppercase and lowercase letter, and at least 8 or more characters" name="password" placeholder="Enter Password" required><br>
            <p>Confirm Password<span style="color:red"> *</span></p>
            <input type="password" name="cpassword" placeholder="Re-enter Password" required><br>

            <input type="submit" name="submit" value="Register"><br>           
        </form>
        </div>
    </div>
</body>
</html>