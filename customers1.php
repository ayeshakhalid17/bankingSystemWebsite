<?php
    $server="localhost";
    $username="root";
    $password="";

    $conn=mysqli_connect($server,$username,$password);
    if(!$conn){
        die("Connection error:".mysqli_connect_error());
    }
    $q="SELECT * FROM `banking_system`.`customers`";
    $result=mysqli_query($conn,$q);
    while($rows=mysqli_fetch_assoc($result)){
        echo $rows['name'];
        echo "<br>";
        echo $rows['acc_no'];
        echo "<br>";
        echo $rows['email'];
        echo "<br>";
        echo $rows['telephone'];
        echo "<br>";
        echo $rows['curr_balance'];
        echo "<br>";
    }
?>