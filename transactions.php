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
    $user_accno = $result['accno'];

    $query2 = "SELECT * FROM transactions";
    $transactionsdata = mysqli_query($conn,$query2);
    $total = mysqli_num_rows($transactionsdata);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css" integrity="sha512-+4zCK9k+qNFUR5X+cKL9EIR+ZOhtIloNl9GIKS57V1MyNsYpYcUrUeQc9vNfzsWfV28IaLL3i96P9sdNyeRssA==" crossorigin="anonymous" />
    <link rel="stylesheet" href="style.css">
    <title>IT BANK | Transactions</title>
</head>
<body>
    <!-- NavBar -->
    <ul>
        <li><a><i class="fas fa-hand-holding-usd"></i> IT BANK&nbsp;&nbsp;&nbsp;&nbsp;</a></li>
        <li><a href="index.php">Home</a></li>
        <li><a href="accounts.php">Account Summary</a></li>
        <li><a href="#">Transactions</a></li>
        <li><a href="transfer.php">Transfer</a></li>
        <li style="float:right"><a class="activered" href="logout.php">Log Out</a></li>
        <li style="float:right"><a class="active" href="">Contact Us</a></li>
        <li style="float:right"><a class="activeblue" href="">Account Balance: Rs. <?php echo $result['balance'];?> </a></li>
    </ul>
    <!-- NavBar -->

    <div class="accbody">
        <div class="header">
            <h3 style="font-size: 1.2rem;text-align: center; padding-top: 10px; color: white;">Your transactions :</h3>
        </div>
        <table>
        <div class="accbd"  style="overflow-y:scroll; height:400px;">
            <?php
                $i = 0;
                while ($result2 = mysqli_fetch_assoc($transactionsdata)) {
                    $sender = $result2['sender_id'];
                    $receiver = $result2['receiver_id'];
                    if($user_accno == $sender || $user_accno == $receiver)
                    {
                        if($user_accno == $sender){
                            if($i++%2==0){
                                echo "<div class='dark'>
                                <p>Debited: &nbsp;Rs.".$result2['amount']." transferred to Acc. No: ".$result2['receiver_id'].".</p>
                                </div>";
                            } else {
                                echo "<div class='darklight'>
                                <p>Debited: &nbsp;Rs.".$result2['amount']." transferred to Acc. No: ".$result2['receiver_id'].".</p>
                                </div>";
                            }

                        }
                        else {
                            if($i++%2==0){
                                echo "<div class='dark'>
                                <p>Credited: &nbsp;Rs.".$result2['amount']." from Acc. No: ".$result2['receiver_id'].".</p>
                                </div>";
                            } else {
                                echo "<div class='darklight'>
                                <p>Credited: &nbsp;Rs.".$result2['amount']." from Acc. No: ".$result2['receiver_id'].".</p>
                                </div>";
                            }

                        }
                    }
                
                }
            ?>
            
        </div>
        </table>
    </div>
</body>
</html>
