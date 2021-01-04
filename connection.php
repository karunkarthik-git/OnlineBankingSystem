<?php

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "itbank";

    $conn = mysqli_connect($servername,$username,$password,$dbname);

    if(!$conn){
        die("Connection Failed because ".mysqli_connect_error());
    }

?> 