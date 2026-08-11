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
    <title>Home</title>

    <link rel="stylesheet" href="/noteapp/assets/css/style.css">
    <style>
        body{
            width:108%;
            background-color:darkslategray;
        }
        header{
            margin:0 7px 0 7px;
            width:99%;
        }
        .divtable{
            width:100%;
            min-height:82.5vh;
            overflow:hidden;
            margin-top:50px;
            padding:0 20px 20px 20px;
        }
        .divtable table{
            width:100%;
            height:100%;
            font-family:arial,sans-serif;
            border:5px solid black;
            padding:5px;
            border-collapse:collapse;
        }
        tr{
            border-bottom: 3px solid black;
        }
        th{
            color:Aquamarine; 
            font-size:15px; 
            font-weight:700; 
            text-align:left; 
            padding:5px;
            border:2px solid black;
        }
        td{
            text-align:left;
            padding:5px;
            font-size:13px;
            border:2px solid black;
        }
        tr:nth-child(even){
            background-color: #8cb3d9;
            color:black;
        }
        tr:nth-child(odd){
            color:white;
        }
        input{
            background: linear-gradient(125deg, #00ff35, #0091a7 60%);
            color:#fff;
            cursor:pointer;
            border-radius:5px;
            padding:7px 0;
            width:80px;
        }
        .btn:hover{
            background:#560319;
            transform:scale(1.1);
        }
    </style>
</head>
<body>
<!-- header starts here -->

<header id="blog-header">
    <h1 style="margin-left:45%; letter-spacing:1px">PENDING LIST</h1>
</header>
<!-- header ends here -->

<div class="divtable">
    <table>
        <tr style="">
            <th>ID</th>
            <th>SESSION</th>
            <th>SUBJECT</th>
            <th>REASON</th>
            <th>STATUS</th>
            <th>ACTION</th>
        </tr>

        <?php
            $seen="yes";
            $que ="UPDATE request SET seen='$seen' WHERE seen='no'";
            $re=mysqli_query($conn,$que);
            $result = $conn->query("SELECT * FROM request WHERE status='0'");
            while($row=mysqli_fetch_array($result)){ 
        ?> 

        <tr>
            <td><?PHP echo $row['roll']; ?></td>
            <td><?PHP echo $row['session']; ?></td>
            <td><?PHP echo $row['subject']; ?></td>
            <td><?PHP echo $row['reason']; ?></td>
            <td>Pending</td>
            <td>
                <form action="requested.php" method="POST">
                    <input type="hidden" name="id" value="<?PHP echo $row['id']; ?>">
                    <input type="submit" name="approve" value="Approve" onclick = "return checkapprove()" class="btn">
                    <input type="submit" name="deny" value="Deny" onclick = "return checkdeny()" style="margin-left:10px" class="btn">
                    </form>
                    <?php
                        if(isset($_POST['approve'])){
                        $id=$_POST['id'];
                        $status=1;

                        $sql ="UPDATE request SET status='$status' WHERE id='$id'";
                        $data=mysqli_query($conn,$sql); 
                        if($data){
                            echo"<script>alert('Permission is granted');</script>";
                            ?>
                            <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/approve.php">
                            <?php
                        }
                        else{
                            echo"<script>alert('Something went wrong please try again later');</script>";
                        }
                        }
                    ?>

                <?php
                    if(isset($_POST['deny'])){
                    $id=$_POST['id'];
                    $query=$conn->query("SELECT * FROM request WHERE id='$id'");
                    while($row = $query->fetch_assoc()){
                    $roll=$row['roll'];
                    $name=$row['name'];
                    $session=$row['session'];
                    $batch=$row['batch'];
                    $username=$row['username']; 
                    $email=$row['email']; 
                    $subject=$row['subject']; 
                    $reason=$row['reason'];
                    $status='deleted';  
                    $request=0; 
                    }
                    $sql ="INSERT into delete_request(roll,name,session,batch,username,email,subject,reason,status) VALUES('$roll','$name','$session','$batch','$username','$email','$subject','$reason','$status')";
                    $data1=mysqli_query($conn,$sql); 

                    $sql1="UPDATE profile SET request='$request' WHERE Username='$username'";
                    $data=mysqli_query($conn,$sql1);

                    $result="DELETE FROM request WHERE id='$id'";
                    $data2=mysqli_query($conn,$result);
                    
                    if($data2){
                        echo"<script>alert('Permission is denied');</script>";
                        ?>
                        <META HTTP-EQUIV="Refresh" CONTENT ="0; URL= http://localhost/noteapp/admin/delete.php?username=<?php $_SESSION["admin"]; ?>">
                        <?php
                    }
                    else{
                        echo"<script>alert('Something went wrong please try again later');</script>";
                    }
                    }
                ?>
            </td>
            
        </tr>
<?php 
}
?>

    </table>

</div>


<script>
    function checkapprove()
    {
        return confirm('Are you sure you want to approve this request');
    }
</script>

<script>
    function checkdeny()
    {
        return confirm('Are you sure you want to deny this request');
    }
</script>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>