<?php  
    session_start();
    include("../admincp/config.php");
    if(isset($_POST['submit'])){
        $email = mysqli_real_escape_string($con,$_POST['email']);
        $password = mysqli_real_escape_string($con,$_POST['password']);
        
        // Câu lệnh truy vấn dùng lấy email và mật khẩu để kiểm tra
        $result = mysqli_query($con,"SELECT * FROM users WHERE email='$email' AND password='$password' ") or die("Select Error");
        $row = mysqli_fetch_assoc($result);

         // Kiểm tra email và mặt khẩu
        if(is_array($row) && !empty($row)){
            $_SESSION['valid'] = $row['email'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['id'] = $row['id'];
        }else{
            echo "<div class='message'>
                <p>Email hoặc mật khẩu nhập sai</p>
                </div> <br>";
            echo "<a href='index.php'><button class='btn'>Trở lại</button>";

        }
        if(isset($_SESSION['valid'])){
            header("Location: home.php");
        }
    }             
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/stylee.css">
    <title>Đăng nhập</title>
</head>
<body>
    <div class="container"> 
        <div class="form-login">
        <header>Đăng nhập</header>
        <form method="post" action="index.php">
            <div class="input-field">
                <label > Email</label>
                <input type="email" name="email" id="email"required><br>
            </div>
            <div class="input-field">
                <label > Mật khẩu</label>
                <input type="password" name="password" id="password"required><br>
            </div>
            <div class="field">
                    <input type="submit" class="btn" name="submit" value="Đăng nhập" required>
            </div>

            <div class="create-account">
                Bạn chưa có tài khoản? <a href="register.php"> Tạo ngay nào</a>
            </div>
        </form>
    </div>
    </div>
</body>
</html>
