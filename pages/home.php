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

    // Câu lệnh truy vấn lấy thông tin các môn học, thời gian, địa điểm để tạo thời khóa biểu và sắp xếp theo thứ tự từ thứ 2 đến Thứ 7
    $schedule_query = mysqli_query($con, "
        SELECT courses.course_name, courses.course_code, schedule.day_of_week, schedule.time_start, schedule.time_end, schedule.class 
        FROM schedule 
        JOIN courses ON schedule.course_id = courses.id 
        WHERE schedule.user_id = $id7
        ORDER BY FIELD(schedule.day_of_week, 'Thứ 2', 'Thứ 3', 'Thứ 4', 'Thứ 5', 'Thứ 6','Thứ 7')
    ");

   // Lấy thông tin về thứ và ngày hiện tại
   date_default_timezone_set('Asia/Ho_Chi_Minh');
   $daysOfWeek = array(
       'Sunday' => 'Chủ nhật',
       'Monday' => 'Thứ hai',
       'Tuesday' => 'Thứ ba',
       'Wednesday' => 'Thứ tư',
       'Thursday' => 'Thứ năm',
       'Friday' => 'Thứ sáu',
       'Saturday' => 'Thứ bảy'
   );
   $current_day = $daysOfWeek[date('l')];
   $current_date = date('d F Y');
   
   // Chuyển đổi tên tháng sang tiếng Việt
   $months = array(
       'January' => 'tháng 1',
       'February' => 'tháng 2',
       'March' => 'tháng 3',
       'April' => 'tháng 4',
       'May' => 'tháng 5',
       'June' => 'tháng 6',
       'July' => 'tháng 7',
       'August' => 'tháng 8',
       'September' => 'tháng 9',
       'October' => 'tháng 10',
       'November' => 'tháng 11',
       'December' => 'tháng 12'
   );
    $current_day = $daysOfWeek[date('l')];
    $current_date = date('d');
    $current_month = $months[date('F')];
    $current_year = date('Y');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/table.css">
    <title>Trang chủ</title>
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
        <h2>Trang chủ</h2>
        <div class="greeting"> 
            <h3>Xin chào, <?php echo $header_uname; ?>!</h3>
            <p>Hôm nay là: <?php echo $current_day . ', ngày ' . $current_date . ' ' . $current_month . ' năm ' . $current_year; ?></p>
        </div>
        <h3>Thời khóa biểu</h3>
            <table border="1">
                <thead>
                    <tr>
                        <th>Thứ</th>
                        <th>Thời gian bắt đầu</th>
                        <th>Thời gian kết thúc</th>
                        <th>Mã học phần</th>
                        <th>Tên học phần</th>
                        <th>Phòng học</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while($row = mysqli_fetch_assoc($schedule_query)): ?>
                        <tr>
                            <td><?php echo $row['day_of_week']; ?></td>
                            <td><?php echo $row['time_start']; ?></td>
                            <td><?php echo $row['time_end']; ?></td>
                            <td><?php echo $row['course_code']; ?></td>
                            <td><?php echo $row['course_name']; ?></td>
                            <td><?php echo $row['class']; ?></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>

