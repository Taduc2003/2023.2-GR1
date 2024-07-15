<?php 
    session_start();
    include("../admincp/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
    $id = $_SESSION['id'];
    $query = mysqli_query($con,"SELECT username FROM users WHERE id=$id ");
    $result = mysqli_fetch_assoc($query);
    $header_uname = $result['username'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/profile.css">
    <title>Thông tin cá nhân</title>
    <script>
        function confirmLogout(event) {
            if (!confirm('Bạn có chắc chắn muốn đăng xuất không?')) {
                event.preventDefault();
            }
        }
    </script>
</head>
<body>
    <div class="home-container" >
        <div class="sidebar">
        <img src="../img/logo.jpg" class="logo-image" alt="">
            <a href="home.php" class="bar-item">Trang chủ</a>
            <a href="profile.php"class="bar-item">Thông tin cá nhân</a>
            <a href="grades.php"class="bar-item">Xem điểm</a>
            <!-- <a href="schedule.php"class="bar-item">Xem thời khóa biểu</a> -->
            <a href="findroom.php"class="bar-item">Tìm trọ</a>
            <a href="../admincp/logout.php"class="bar-item" onclick="confirmLogout(event)">Đăng xuất</a>
        </div>
        <div class="header">
                <h1>StuSupport</h1>
                <div class="user">
                    <label><?php echo $header_uname; ?></label>
                    <div class="avatar"></div>
                </div>
        </div>  
        <div class="edit-content">
        <h2>Thông tin cá nhân</h2>
        <?php 
            if(isset($_POST['submit'])){
                $username = $_POST['username'];
                $email = $_POST['email'];
                $password = $_POST['password'];
        
                $id = $_SESSION['id'];
        
                $edit_query = mysqli_query($con,"UPDATE users SET username='$username', email='$email',password='$password' WHERE id=$id ") or die("error occurred");
        
                if($edit_query){
                    echo "<div class='message'>
                    <p>Chỉnh sửa thành công!</p>
                    </div> <br>";
                     echo "<a href='profile.php'><button class='btn'>Ok</button>";
                }
               }else{ // Nếu không submit thì hiện thị thông tin của người dùng.
        
                $id = $_SESSION['id'];
                $query = mysqli_query($con,"SELECT*FROM users WHERE id=$id ");
        
                while($result = mysqli_fetch_assoc($query)){
                    $res_Uname = $result['username'];
                    $res_Email = $result['email'];
                    $res_password = $result['password'];
                } 
            ?>
        <div class="form-edit">
        <form action="profile.php" method="post">
                <div class="input-field">
                    <label for="username">Họ và tên</label>
                    <input type="text" name="username" id="username" value="<?php echo $res_Uname; ?>" autocomplete="off" required>
                </div>

                <div class="input-field">
                    <label for="email">Email</label>
                    <input type="text" name="email" id="email" value="<?php echo $res_Email; ?>" autocomplete="off" required>
                </div>

                <div class="input-field">
                    <label for="password">Mật khẩu</label>
                    <input type="text" name="password" id="password" value="<?php echo $res_password; ?>" autocomplete="off" required>
                </div>
                
                <div class="input-field">
                    <input type="submit" class="btn" name="submit" value="Chỉnh sửa" required>
                </div>
                
            </form>
        </div>
        <?php }?>
        </div>
    </div>
    
</body>
</html>
