<?php
    session_start();
    include("connection.php");
    $userprofile = $_SESSION['user_name'];

    if($userprofile == true)
    {

    } else 
    {
        header('location:login.php');
    }
    $query = "SELECT * FROM user where name='$userprofile'";
    $data = mysqli_query($conn,$query);
    $result = mysqli_fetch_assoc($data);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>IT BANK | HOME</title>
</head>
<body>
    <!-- NavBar -->
    <ul>
        <li><a><i class="fas fa-hand-holding-usd"></i> IT BANK&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li><a href="#">Home</a></li>
        <li><a href="accounts.php">Account Summary</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="transfer.php">Transfer</a></li>
        
        <li style="float:right"><a class="activered" href="logout.php">Log Out</a></li>
        <li style="float:right"><a class="active" href="">Contact Us</a></li>
        <li style="float:right"><a class="activeblue" href="">Account Balance: Rs. <?php echo $result['balance'];?> </a></li>
    </ul>
    <!-- NavBar -->

    <div class="row">
        <div class="banner">
            <h1 style="text-align: center;">Welcome to IT BANK !</h1>
            <br>
            <p style="padding:20px; font-size:1.2rem ;">Dear <b><?php echo $result['name'];?></b>, to view the updated privacy policy kindly visit the nearest bank!</p>
            <p style="padding:20px;margin-top:-30px; font-size:1.2rem ;">You have created your account on <b><?php echo $result['timestamp'];?></b>, which has a current balance of Rs. <?php echo $result['balance']?> !</p>
            
        </div>
        <div class="accsum">
            <img src="./images/acount.jpg" height="180px" width="250px" alt="">
            <button class="acbtn"><a href="accounts.php" style="text-decoration:none; pointer:click;">Account Summary</a></button>
        </div>
        <div class="accsum">
            <img src="./images/transfer.jpg" height="180px" width="250px" alt="">
            <button class="acbtn"><a href="transactions.php">Transactions</a></button>
        </div>
    </div>

    <div class="row">
        <div class="accsum">
            <img src="./images/bell.gif" height="180px" width="250px" alt="">
            <button class="acbtn">Notifications</button>
        </div>
        <div class="accsum">
            <img src="./images/contacts.gif" height="180px" width="180px" alt="">
            <button class="acbtn">Contact Us</button>
        </div>
        <div class="banner">
            <h2 style="text-align: center;">Here are the latest guidelines and changes that take effect in January 2021:</h2>
            <ol style="margin-left:25px; padding-top: 15px; font-size: 1.2rem;line-height: 30px;">
                <li>NEFT Charges will be rolled back.</li>
                <br>
                <li>OTP to withdraw cash from ATM.</li>
                <li>No MDR charges for transactions on Rupay and UPI Platforms. </li>
                <li>SBI interest rates will come down.</li>
            </ol>
        </div>
    </div>

    

</body>
</html>

