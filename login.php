<?php
session_start();
ob_start();
if(isset($_SESSION['isLogin'])){
    header("Location: index.php");
}
include "service/connect.php";
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $passwordhash = hash("sha256", $password);
    $queryLogin = "select *from akun where username='$username' and password='$passwordhash'";
    $resultLogin = mysqli_query($db, $queryLogin);
    while($row = mysqli_fetch_assoc($resultLogin)) {
        $_SESSION["isLogin"] = true;
        $_SESSION["email"] = $row['email'];
        $_SESSION["access"] = $row['access'];
        header("Location: index.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <style>
        * {
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        body {
            background: linear-gradient(to bottom, #190482, #8E8FFA);
        }

        form {
            height: 100vh;
            align-items: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        form h1 {
            font-size: 2rem;
            font-weight: 400;
            margin-bottom: 24px;
            color: white;
        }

        form input,
        form button {
            width: 20%;
            padding: 8px;
            margin-bottom: 12px;
            border: 2px solid black;
            border-radius: 8px;
            box-shadow: 0 0 6px #C2D9FF;
        }

        form p {
            color: white;
            margin-bottom: 8px;
        }

        form p span a {
            text-decoration: none;
            color: #C2D9FF;
        }

        form button#btn {
            width: auto;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <center>
        <form action="login.php" method="post">
            <h1>Login</h1>
            <input type="text" name="username" placeholder="Username" required>
            <input type="password" name="password" placeholder="Password" required>
            <p>Belum punya akun? <span><a href="daftar.php">Daftar Sekarang</a></span></p>
            <button type="submit" name="submit" id="btn">Login</button>
        </form>
    </center>
</body>

</html>