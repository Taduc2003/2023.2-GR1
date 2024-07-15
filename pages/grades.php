<?php 
    session_start();
    include("../admincp/config.php");
    if(!isset($_SESSION['valid'])){
        header("Location: index.php");
    }
    $id = $_SESSION['id'];
    $header_query = mysqli_query($con,"SELECT username FROM users WHERE id=$id ");    
    $result = mysqli_fetch_assoc($header_query);
    $header_uname = $result['username'];

     // Truy vấn để lấy điểm của người dùng hiện tại
     $grades_query = mysqli_query($con, "
     SELECT courses.course_name,courses.course_code, grades.grade, grades.semester 
     FROM grades 
     JOIN courses ON grades.course_id = courses.id 
     WHERE grades.user_id = $id");
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <title>Xem điểm</title>

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
        <div class="table-content">
        <h2>Bảng điểm</h2>
            <table border="1">
                <thead>
                    <tr>
                        <th>Học kỳ</th>
                        <th>Mã học phần</th>
                        <th>Tên học phần</th>
                        <th>Điểm</th>           
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if (mysqli_num_rows($grades_query) > 0) {
                        while($row = mysqli_fetch_assoc($grades_query)) {
                            echo "<tr>";
                            echo "<td>" . htmlspecialchars($row['semester']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['course_code']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['course_name']) . "</td>";
                            echo "<td>" . htmlspecialchars($row['grade']) . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>Không có điểm nào được tìm thấy.</td></tr>";
                    }
                    ?>
                </tbody>
            </table>
        </div>
    </div>
    
</body>
</html>
