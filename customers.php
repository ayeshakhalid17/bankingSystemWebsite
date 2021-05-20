
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customers</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="heading">
    <h1>Customers</h1>
    <h3>Click on any customer to view in detail and transfer money.</h3>
    </div>
    <div class="table-container">
        <table>
            <tr>
                <th>Name</th>
                <th>Account Number</th>
                <th>Email</th>
                <th>Telephone</th>
                <th>Current Balance</th>
            </tr>
            <?php
            $server="localhost";
            $username="root";
            $password="";

            $conn=mysqli_connect($server,$username,$password);
            if(!$conn){
                die("Connection error:".mysqli_connect_error());
            }
            $q="SELECT * FROM `banking_system`.`customers` ORDER BY c_name";
            $result=mysqli_query($conn,$q);
            while($rows=mysqli_fetch_assoc($result)){
            ?>
                <tr>
                    <td><a href="ind_customer.php?
                    c_name=<?php echo$rows['c_name'];?>
                    &acc_no=<?php echo $rows['acc_no'];?>
                    &email=<?php echo $rows['email'];?>
                    &telephone=<?php echo $rows['telephone'];?>
                    &curr_balance=<?php echo $rows['curr_balance'];?>
                    "><?php echo $rows['c_name'];?></a></td>
                    <td><?php echo $rows['acc_no'];?></td>
                    <td><?php echo $rows['email'];?></td>
                    <td><?php echo $rows['telephone'];?></td>
                    <td><?php echo $rows['curr_balance'];?></td>
                </tr>
            <?php
            }
            mysqli_free_result($result);
            mysqli_close($conn);
            ?>
        </table>
    </div>
</script></body>
</html>