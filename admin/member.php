<?php
    include_once '../includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member</title>
</head>
<style>
        body{
            background-color:grey;
            background-size:cover;
            background-position:center center;
            font-family: poppins;
        }   

        .first{
            width:97%;
            min-height:95vh;
            margin-top:20px;
            margin-left:15px;
            background: rgba(0,0,0,0.6);
            text-align:center;
            border: 3px solid #fff;
            border-radius: 70px 0 70px;
            
        }
        table{
            margin-top:30px;
            margin-left:30px;
            font-family:arial,sans-serif;
            border: 3px solid #fff;
            border-radius: 30px 0 30px;
            width : 95%;

        }
        th{
            color:Aquamarine;
            text-align:left;
            padding:8px;
        }
        td{
            text-align:left;
            padding:8px;
        }

        tr:nth-child(even){
            background-color: #dddddd;
        }
        tr:nth-child(odd){
            color:white;
        }
        img{
           width:60px; 
           height:40px;
        }
</style>
<body>
    <div class="first">
    <form action="" method="POST" enctype="multipart/form-data">
    <table>
        <tr>
            <th>NAME</th>
            <th>USERNAME</th>
            <th>ROLL</th>
            <th>SESSION</th>
            <th>BATCH</th>
            <th>EMAIL</th>
            <th>MOBILE</th>
            <th>IMAGES</th>
        </tr>

        <?php
            $query=mysqli_query($conn,"SELECT * FROM profile");
            while($row=mysqli_fetch_array($query)){
        ?>

        <tr>
            <td><?php echo $row['Name']; ?></td>
            <td><?php echo $row['Username']; ?></td>
            <td><?php echo $row['Roll']; ?></td>
            <td><?php echo $row['Batch']; ?></td>
            <td><?php echo $row['Session']; ?></td>
            <td><?php echo $row['Email']; ?></td>
            <td><?php echo $row['PhoneNumber']; ?></td>
            <td><?php 
                $image=$row['Image'];
                echo "<img src='../uploads/Images/$image'>" ?>
            </td>
        </tr>

        <?php } ?>
    </table>
    </form>
    </div>
</body>
</html>