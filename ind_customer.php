<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title> <?php
            echo $name = $_GET['c_name'];
            ?>
    </title>
    <style>
        input,
        select {
            width: 40%;
            margin: 25 0;
        }

        #transfer {
            width: 74%;
            margin: auto;
        }
    </style>
</head>

<body>
    <div class="heading">
        <h1>Transfer Money</h1>
        <h3>Specify the amount and transfer money to any customer.</h3>
    </div>
    <table>
        <tr>
            <th>Name</th>
            <th>Account Number</th>
            <th>Email</th>
            <th>Telephone</th>
            <th>Current Balance</th>
        </tr>
        <tr>
            <td>
                <?php
                echo $sender_name = $_GET['c_name'];
                ?>
            </td>
            <td>
                <?php
                echo $acc_no = $_GET['acc_no'];
                ?>
            </td>
            <td>
                <?php
                echo $email = $_GET['email'];
                ?>
            </td>
            <td>
                <?php
                echo $telephone = $_GET['telephone'];
                ?>
            </td>
            <td>
                <?php
                echo $curr_balance = $_GET['curr_balance'];
                ?>
            </td>
        </tr>
    </table>
    <div id="transfer">
        <h3>Transfer to:</h3>
        <form action="" method="post">
            <select name="transfer-to">
                <?php
                $server = "localhost";
                $username = "root";
                $password = "";

                $conn = mysqli_connect($server, $username, $password);
                if (!$conn) {
                    die("Connection error:" . mysqli_connect_error());
                }
                $q = "SELECT * FROM `banking_system`.`customers`";
                $result = mysqli_query($conn, $q);
                while ($rows = mysqli_fetch_assoc($result)) {
                ?>
                    <option><?php echo $rows['c_name']; ?></option>
                <?php
                }
                mysqli_free_result($result);

                ?>
            </select>
            <h3>Amount:</h3>
            <input type="number" name="amount" placeholder="Enter amount to be transferred">
            <br>
            <input class="link" type="submit" name="transfer" value="Transfer" required>
            <a class="link" id="link" href="customers.php">View All Customers</a>
    </div>
    </form>
    <?php
    if (isset($_POST['transfer'])) {
        $sendee_name = $_POST['transfer-to'];
        echo $sendee_name;
        echo $sender_name;
        $amount=$_POST['amount'];
        $update_sendee="UPDATE `banking_system`.`customers` SET curr_balance=curr_balance+$amount WHERE c_name='$sendee_name'";
        $update_sender="UPDATE `banking_system`.`customers` SET curr_balance=curr_balance-$amount WHERE c_name='$sender_name'";
        echo $update_sendee;
        echo $update_sender;
        $updatequery1=mysqli_query($conn,$update_sendee);
        $updatequery2=mysqli_query($conn,$update_sender);
        if(!$updatequery1){
            echo mysqli_error($conn);
        }
        mysqli_close($conn);
    }
    ?>
</body>

</html>