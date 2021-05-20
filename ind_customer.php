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
        body {
            background-color: rgba(221, 172, 98, 0.7);
            font-family: 'Noto Serif JP', sans-serif;
            font-weight: 800;
        }
        input,
        select {
            width: 32%;
            margin: 25 0;
            height: 30px;
        }
        .link {
            font-size: 30px;
            color: rgba(221, 172, 98, 0.9);
            padding: 7px;
            background-color: rgb(28, 57, 78);
            cursor: pointer;
            text-decoration: none;
            padding: 0.35em 1.2em;
            border: 0.1em solid black;
            border-radius: 0.12em;
            box-sizing: border-box;
            text-decoration: none;
            text-align: center;
            transition: all 0.2s;
            margin:7px 0;
            margin-bottom: 20px;
            width: 12em;
            height: 70px;
            font-family: 'Noto Serif JP', sans-serif;
        }
        .link:hover {
            color: rgb(28, 57, 78);
            background-color: rgba(221, 172, 98, 0.7);
        }
        #transfer {
            margin-top: 13px;
            display: flex;
            flex-direction: column;
            flex-wrap: wrap;
            margin-left: 13%;
        }

        .heading {
            background-color: rgb(28, 57, 78);
            color: rgba(221, 172, 98, 0.7);
            margin: 0;
            padding-bottom: 10px;
        }
        #t-btn {
            font-weight: 800;
        }
        #t-success{
            color: green;
            font-size: 1.5em;
            margin:5px;
        }
    </style>
</head>

<body>
    <div class="heading">
        <h1>Transfer Money</h1>
        <h3>Specify the amount and transfer money to any customer.</h3>
    </div>
    <div class="table">
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
    </div>
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
                $q = "SELECT * FROM `banking_system`.`customers` ORDER BY c_name";
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
            <input class="link" id="t-btn" type="submit" name="transfer" value="Transfer" required>
            <?php
            if (isset($_POST['transfer'])) {
                echo "<span id='t-success'>Transfer Successful!</span>";
            }
            ?>
            <br>
            <a class="link" href="customers.php">View All Customers</a>
            <?php
            if (isset($_POST['transfer'])) {
                $send_to_name = $_POST['transfer-to'];
                $send_by_name = $_GET['c_name'];
                $amount = $_POST['amount'];
                $update_send_to = "UPDATE `banking_system`.`customers` SET curr_balance=curr_balance+$amount WHERE c_name='$send_to_name'";
                $update_send_by = "UPDATE `banking_system`.`customers` SET curr_balance=curr_balance-$amount WHERE c_name='$send_by_name'";
                $insert = "INSERT INTO `banking_system`.`transfers` (send_to, send_by, amount) VALUES ('$send_to_name','$send_by_name',$amount)";
                $updatequery1 = mysqli_query($conn, $update_send_to);
                $updatequery2 = mysqli_query($conn, $update_send_by);
                $insertquery = mysqli_query($conn, $insert);
                if (!$updatequery1 or !$updatequery2 or !$insertquery) {
                    echo mysqli_error($conn);
                }
                mysqli_close($conn);
            }
            ?>
        </form>
    </div>

</body>

</html>