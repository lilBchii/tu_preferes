<?php

    $server = "localhost";
    $username = "root";
    $passwd = "";
    $dbname = "tu_preferes";

    $conn = mysqli_connect($server, $username, $passwd, $dbname) or die("Connection failed: " . mysqli_connect_error());
?>