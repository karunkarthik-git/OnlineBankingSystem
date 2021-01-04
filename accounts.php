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
        <li><a href="index.php">Home</a></li>
        <li><a href="#">Account Summary</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="transfer.php">Transfer</a></li>
        
        <li style="float:right"><a class="activered" href="logout.php">Log Out</a></li>
        <li style="float:right"><a class="active" href="">Contact Us</a></li>
        <li style="float:right"><a class="activeblue" href="">Account Balance: Rs. <?php echo $result['balance'];?> </a></li>
    </ul>
    <!-- NavBar -->

    <div class="accbody">
        <div class="header">
            <h3 style="font-size: 1.2rem;text-align: center; padding-top: 10px; color: white;">Your account Information:</h3>
        </div>
        <table>
        <div class="accbd" >
            <div class="darklight">
                <p>Account No: <?php echo $result['accno'];?></p>
            </div>
            <div class="dark ">
                <p>Holder Name: <?php echo $result['name'];?></p>
            </div>
            <div class="darklight">
                <p>Balance : Rs.<?php echo $result['balance'];?></p>
            </div>
            <div class="dark">
                <p>Email : <?php echo $result['email'];?></p>
            </div>
            <div class="darklight">
                <p>Mobile No : <?php echo $result['phone'];?></p>
            </div>
            <div class="dark">
                <p>Created On : <?php echo $result['timestamp'];?></p>
            </div>
            <div class="darklight">
                <p>Branch Name: IT BANK</p>
            </div>
            <div class="dark">
                <p>Branch Location: Andhra University</p>
            </div>
        </div>
        </table>
    </div>
</body>
</html>