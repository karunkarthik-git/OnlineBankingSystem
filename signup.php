<?php include("connection.php") ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IT BANK | SignUp</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <ul>
        <li style="margin-left: 45% ;"><a><i class="fas fa-hand-holding-usd"></i> IT BANK&nbsp;&nbsp;&nbsp;&nbsp;</a></li> 
    </ul>
    <div class="signupDiv" style ="height: 90vh;">
        <center style="border-bottom: 2px solid white;"><h1 class="head">Sign Up</h1></center>
        <div class="formbody">        
            <div class="signupleft" style="height: 415px;">
                <form action="" class="formleft" method="">
                    
                    <input type="text" id="accno" name="accno" class="forminputtext" minlength="6" placeholder="   Create your 6 digit account no.">
                    <br>
                    <input type="text" id="name" name="name" class="forminputtext" placeholder="   Enter your name">
                    <br>
                    <input type="text" id="phone" name="phone" class="forminputtext" placeholder="   Enter your mobile no.">
                    <br>
                    <input type="text" id="email" name="email" class="forminputtext" placeholder="   Enter your email ID.">
                    <br>
                    <input type="password" id="pwd" name="password" class="forminputtext" placeholder="   Enter your Password">
                    <br>
                    <input type="text" id="balance" name="balance" class="forminputtext" placeholder="   Enter your initial deposit.">
                    <br>
                    
                    <h3 class="forminputtext">Terms and Conditions:</h3>
                    <ul class="formdisplaytext">
                        <li>1. I am a citizen of India.</li>
                        <br>
                        <li>2. I am a student of Andhra University.</li>
                    </ul>
                    <input type="checkbox" id="terms" name="terms" class="forminputcheck">&nbsp;&nbsp;I agree to all the terms above.
                    
                    <input type="submit" class="acbtn" name = "signup" style="background-color:black; color:white;width: 80%; margin-left: 20px; margin-top: 20px;" value="signup"></input>
                    <br>
                </form>
            </div>

            <div class="signupright" style="height: 415px;">
                <h4 style="padding: 17px; color: whitesmoke;  border: 1px solid black;">Already Have an account?</h4>
                <h5 style="padding: 17px; text-align: center;  border: 1px solid black; border-top: none;"><a href="login.php" style="text-decoration: none; color: white;">Click Here to Login !</a></h5>
            </div>
        </div>
    </div>
    <?php
        error_reporting(0);
        $accno = $_GET['accno'];
        $name = $_GET['name'];
        $phone = $_GET['phone'];
        $email = $_GET['email'];
        $pwd = $_GET['password'];
        date_default_timezone_set('Asia/Kolkata'); 
        $timestamp = $_SERVER['REQUEST_TIME'];
        $createddate = date('F d,Y h:i:s A',$timestamp);
        $bal = $_GET['balance'];
        
        if($_GET['signup'] && $_GET['terms'] )
        {
            if($accno && $name && $phone && $email && $pwd && $bal){
                $query = "INSERT INTO user VALUES('$accno','$name','$phone','$email','$pwd','$createddate','$bal')";
                $data = mysqli_query($conn,$query);
                if($data){
                    header('location:login.php');
                }
            } 
            else 
            {
                echo "<script>alert('Please fill all the fields !');</script>";
            }

        } else {
            echo "<script>alert('Please check the terms and conditions !');</script>";
        }
        

    ?>
</body>
</html>