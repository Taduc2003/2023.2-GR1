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



$query = "SELECT * FROM findroom WHERE 1=1";
if(isset($_POST['submit'])){
    $district = isset($_POST['district']) ? $_POST['district'] : '';

    // Nếu quận không trống, thêm điều kiện tìm kiếm theo quận vào câu truy vấn
    if (!empty($district)) {
        $query = "SELECT * FROM findroom WHERE address LIKE '%" .$con->real_escape_string($district) .  "%'";
    }
}

// Sắp xếp kết quả theo giá từ thấp đến cao hoặc từ cao đến thấp
if(isset($_POST['order_by_price'])){
    $order_by_price = $_POST['order_by_price'];
    if ($order_by_price == 'asc') {
        $query .= " ORDER BY price ASC";
    } elseif ($order_by_price == 'desc') {
        $query .= " ORDER BY price DESC";
    }
}

$result = mysqli_query($con, $query);

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../css/home.css">
    <link rel="stylesheet" type="text/css" href="../css/findroom.css">
    <title>Tìm trọ</title>

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
                <label><?php echo "$header_uname"?></label>
                <div class="avatar"></div>
            </div>
        </div>  
        <div class="find-content">
            <h2>Tìm trọ</h2>
            <div class="search-form">
            
                <form method="POST" action="findroom.php">
                <div class="field">
                    <div class="input-field">
                        <label for="district">Quận:</label>
                        <input type="text" id="district" name="district" value="<?php echo isset($_POST['district']) ? $_POST['district'] : ''; ?>">
                    </div>
                    <div class="input-field">
                        <label for="order_by_price">Sắp xếp theo giá:</label>
                        <select id="order_by_price" name="order_by_price">
                            <option value="asc">Tăng dần</option>
                            <option value="desc">Giảm dần</option>
                        </select>
                    </div>

                    <input  class="btn" type="submit" name="submit" value="Tìm kiếm">
                </div>
                </form>
            </div> 
            <div class="house-result">
                    <h3>Kết quả tìm kiếm:</h3>
                    <?php
                    if ($result->num_rows > 0) {
                        echo "<ul class='results-list'>";
                        while($row = $result->fetch_assoc()) {
                            echo "<div class='result-item'>";
                            echo "<img src='../img/house.jpg' class='result-image' alt=''>";
                                echo "<div class='info-item'>";
                                echo "<strong>Địa chỉ:</strong> " . $row["address"] . "<br>";
                                echo "<strong>Mô tả:</strong> " . $row["description"] . "<br>";
                                echo "<strong>Giá:</strong> " . number_format($row["price"]) . " VND/tháng<br>";
                                echo "<strong>Liên hệ:</strong> " . $row["contact_info"] . "<br>";
                                echo "<strong>Diện tích:</strong> " . $row["dientich"] . "<br>";
                                echo "</div><br>";
                                echo "</div><br>";

                        }
                        echo "</ul>";
                    } else {
                        echo "<div class='no-results'>Không có kết quả phù hợp.</div>";
                    }
                    $con->close();
                    ?>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>