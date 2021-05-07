<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recipt</title>
    <style>
        html{
            background-color: rgb(70, 194, 152);
            padding: 10%;
            font-size: 300%;
            color: white;
        }
    </style>
</head>
<body>
    <p>Transaction Status : </p>
<?php
$servername="localhost";
$username="root";
$password="";
$database_name="banking";

$conn=mysqli_connect($servername,$username,$password,$database_name);

//now check for connection
if(!$conn){
    die("connection failed:".mysqli_connect_error());
}

if(isset($_POST['save'])){
    $u1 = $_POST['u1'];
    $tamount = $_POST['amount'];
    $u2 = $_POST['u2'];
    $sql_query = "select balance from users where username = '$u1'";
    $result = mysqli_query($conn,$sql_query);
    $element =mysqli_fetch_assoc($result);
    $u1b = $element['balance'];
    $u1b -=$tamount;
    $sql_query = "select balance from users where username = '$u2'";
    $result = mysqli_query($conn,$sql_query);
    $element =mysqli_fetch_assoc($result);
    $u2b = $element['balance'];
    $u2b +=$tamount;
    $sql_query = "UPDATE users SET balance = '$u1b' WHERE username = '$u1'";
    mysqli_query($conn,$sql_query);
    $sql_query = "UPDATE users SET balance = '$u2b' WHERE username = '$u2'";
    mysqli_query($conn,$sql_query);
    $sql_query = "INSERT INTO transaction (u1,u2,amount) VALUES ('$u1', '$u2', '$tamount')";
    if(mysqli_query($conn,$sql_query)){
        echo "Transaction successful !";
    }else{
        echo "Transaction Unsuccessful !";
    }
    mysqli_close($conn);
}

?>
<br>
<br>
<a href="index.html" style="color:rgb(70, 194, 152) ; background-color: white;padding: 1%; text-decoration: solid; ">Go back</a>
</body>
</html>