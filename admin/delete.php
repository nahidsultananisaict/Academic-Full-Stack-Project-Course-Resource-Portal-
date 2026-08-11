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
            font-size:12px;
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
            border:3px solid black;
            background: linear-gradient(125deg, #00ff35, #0091a7 60%);
            color:black;
            cursor:pointer;
            border-radius:15px 0 15px;
            padding:7px;
        }
    </style>
</head>
<body>

<!-- header starts here -->

<header id="blog-header">
    <h1 style="margin-left:40%; letter-spacing:1px">DELETED REQUEST LIST</h1>
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
        </tr>

        <?php
            $result = $conn->query("SELECT * FROM delete_request");
            while($row=mysqli_fetch_array($result)){ 
        ?> 

        <tr>
            <td><?PHP echo $row['roll']; ?></td>
            <td><?PHP echo $row['session']; ?></td>
            <td><?PHP echo $row['subject']; ?></td>
            <td><?PHP echo $row['reason']; ?></td>
            <td>Deleted</td>           
        </tr>

        <?php 
        }
        ?>
</table>
</div>

<script>
if ( window.history.replaceState ) {
  window.history.replaceState( null, null, window.location.href );
}
</script>
</body>
</html>