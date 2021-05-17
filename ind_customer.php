
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Serif+JP:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <title>Customer Details</title>
</head>
<body>
    <?php
        echo $name=$_GET['name'];
        echo $acc_no=$_GET['acc_no'];
        echo $email=$_GET['email'];
        echo $telephone=$_GET['telephone'];
        echo $curr_balance=$_GET['curr_balance'];
    ?>
</body>
</html>