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
    $query1 = "SELECT * FROM user where name='$userprofile'";
    $data = mysqli_query($conn,$query1);
    $result = mysqli_fetch_assoc($data);

    $user_accno = $result['accno'];
    $user_balance = $result['balance'];

    $query2 = "SELECT * FROM user";
    $listdata = mysqli_query($conn,$query2);
    $total = mysqli_num_rows($listdata);
?>
        
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>IT BANK | Amount Transfer</title>
</head>
<body>
    <!-- NavBar -->
    <ul>
        <li><a><i class="fas fa-hand-holding-usd"></i> IT BANK&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="accounts.php">Account Summary</a></li>
        <li><a href="transactions.php">Transactions</a></li>
        <li><a href="#">Transfer</a></li>
        
        <li style="float:right"><a class="activered" href="logout.php">Log Out</a></li>
        <li style="float:right"><a class="active" href="">Contact Us</a></li>
        <li style="float:right"><a class="activeblue" href="">Account Balance: Rs. <?php echo $result['balance'];?> </a></li>
    </ul>
    <!-- NavBar -->

    <div class="accbody">
        <div class="header">
            <h3 style="font-size: 1.2rem;text-align: center; padding-top: 10px; color: white;">Enter the account Number :</h3>
        </div>
        <div class="transacinput">
        <form action="" method="">
            <input class="inputtext" type="text" name="receiveraccno" placeholder="   Enter the Acc.No of the Receiver:" style="padding-left:15px;">
            <input class="inputtext" type="text" name="sentamount" placeholder="   Enter the Amount to Send:" style="padding-left:15px;">
            <input class="inputsend" type="submit" name="send" value="send" placeholder="Send">
        </form>
        </div>
        
        <div class="transacaccbd" style="overflow-y:scroll; height:300px;" >
            <div class="dark ">
                <p>Receiver Acc.No&emsp;|&emsp; Receiver Name</p>
            </div>
            <div class="darklight">
                <?php
                    while ($result2 = mysqli_fetch_assoc($listdata)) {
                        if($user_accno != $result2['accno']){
                            echo "<div class='darklight'>
                                <p>".$result2['accno']."&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;&emsp;".$result2['name']."</p>
                            </div>";
                        }
                    }
                ?>
            </div>
        </div>
    </div>
</body>
</html>

<?php

    error_reporting(0);
    $receiveraccno = $_GET['receiveraccno'];
    $sentamount = $_GET['sentamount'];
    
    if($_GET['send'])
    {
        if($receiveraccno && $sentamount)
        {
            if($user_balance >= $sentamount)
            {
                //Update transaction Table
                $query3 = "INSERT INTO transactions VALUES('$user_accno','$receiveraccno','$sentamount')";
                $data = mysqli_query($conn,$query3);
                $user_balance = $user_balance - $sentamount;

                //Update User DB
                $userbalquery = "UPDATE user SET balance='$user_balance' WHERE accno='$user_accno' ";
                $userbaldata = mysqli_query($conn,$userbalquery);

                //Get Receiver Balance
                $query4 = "SELECT * FROM user where accno='$receiveraccno'";
                $rbal_data = mysqli_query($conn,$query4);
                $result3 = mysqli_fetch_assoc($rbal_data);
                $r_bal = $result3['balance'];
                $r_bal = $r_bal + $sentamount;

                //Update Receiver DB
                $receiverbalquery = "UPDATE user SET balance='$r_bal' WHERE accno='$receiveraccno' ";
                $receiverbaldata = mysqli_query($conn,$receiverbalquery);

                if($receiverbaldata){
                    header("location:transactions.php");
                }
            } else {
                //Handle less amount
                echo "<script>alert('Insufficient Bank Balance !')</script>";
            }    
        } 
    }

?>
