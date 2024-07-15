<?php 
    include("../admincp/config.php");
    if(isset($_POST['submit'])){
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $cfpassword = $_POST['cfpassword'];

         //Kiểm tra xem email đã tồn tài chưa
         $verify_query = mysqli_query($con,"SELECT email FROM users WHERE Email='$email'");

         if(mysqli_num_rows($verify_query) !=0 ){ // Hiện ra thông báo nếu email tồn tại
            echo "<div class='message'>
                      <p>Email đã tồn tại, Hãy thử cái khác!</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Trở lại</button>";
         }
         else if($password == $cfpassword){ // Kiểm tra mật khẩu và mật khẩu xác nhặn

            mysqli_query($con,"INSERT INTO users(username,email,password) VALUES('$username','$email','$password')") or die("Erroe Occured");

            echo "<div class='message'>
                      <p>Đăng ký thành công!</p>
                  </div> <br>";
            echo "<a href='index.php'><button class='btn'>Đăng nhập ngay</button>";
         }else{ // Nếu 2 mất khẩu khác nhau thì phải nhập lại
            echo "<div class='message'>
                      <p>Kiểm tra lại mật khẩu vừa nhập</p>
                  </div> <br>";
            echo "<a href='javascript:self.history.back()'><button class='btn'>Trở lại</button>";
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
        <header>Đăng ký</header>
        <form method="post" action="register.php">
            <div class="input-field">
                <label > Họ và tên </label>
                <input type="username" name="username" id="username"required><br>
            </div>
            <div class="input-field">
                <label > Email</label>
                <input type="email" name="email" id="email"required><br>
            </div>
            <div class="input-field">
                <label > Mật khẩu</label>
                <input type="password" name="password" id="password"required><br>
            </div>

            <div class="input-field">
                <label > Xác nhận mật khẩu</label>
                <input type="password" name="cfpassword" id="cfpassword"required><br>
            </div>
            <div class="field">
                    <input type="submit" class="btn" name="submit" value="Tạo tài khoản" required>
            </div>
            <div class="create-account">
                Bạn đã có tài khoản? <a href="../pages/index.php">Đăng nhập ngay</a>
            </div>
        </form>
    </div>
    </div>
</body>
</html>