<?php 
    session_start();
    ob_start();
    include "service/connect.php";
    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $username = $_POST['username'];
        $password = $_POST['password'];
        $passwordhash = hash("sha256", $password);
        $access = "User";
        $queryDaftar = "insert into akun values('$email','$username','$passwordhash','$access')";
        $resultDaftar = mysqli_query($db, $queryDaftar);
        if($resultDaftar){
            try{
                header("Location: login.php");
                exit();
            }catch(mysqli_sql_exception){
                echo "<script>alert('Pendaftaran Gagal');</script>";
            }
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar</title>
    <style>
        *{
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }
        body{
            background: linear-gradient(to bottom, #191825, #865DFF);
        }
        form{
            height: 100vh;
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        form h1{
            font-size: 2rem;
            font-weight: 400;
            margin-bottom: 24px;
            color: white;
        }
        form input, form button{
            width: 20%;
            padding: 8px;
            margin-bottom: 12px;
            border: 2px solid black;
            border-radius: 8px;
            box-shadow: 0 0 6px #C2D9FF;
        }
        form p{
            color: white;
            margin-bottom: 8px;
        }
        form p span a{
            text-decoration: none;
            color: #C2D9FF;
        }
        form button#btn{
            width: auto;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <center>
        <form action="daftar.php" method="post">
            <h1>Daftar</h1>
            <input type="text" name="email" placeholder="Email" required>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <p>Sudah punya akun? <span><a href="login.php">Login Sekarang</a></span></p>
            <button type="submit" name="submit" id="btn">Daftar</button>
        </form>
    </center>
</body>
</html>