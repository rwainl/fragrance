
<?php 
    $hostname = "localhost";
    $username = "root";
    $password = "";
    $database_name = "quizweb1";
    $db = mysqli_connect($hostname, $username, $password, $database_name);
    if($db->connect_error)
    die("Error" + $db->connect_error);
?>