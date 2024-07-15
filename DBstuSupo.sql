CREATE DATABASE student_support;

USE student_support;

CREATE TABLE findroom (
    id INT AUTO_INCREMENT PRIMARY KEY,
    address VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    contact_info VARCHAR(100) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(100) NOT NULL
);

CREATE TABLE courses (
    id INT AUTO_INCREMENT PRIMARY KEY,
    course_name VARCHAR(100) NOT NULL,
    course_code VARCHAR(20) NOT NULL
);

CREATE TABLE grades (
    user_id INT NOT NULL,
    course_id INT NOT NULL,
    grade VARCHAR(10) NOT NULL,
    semester VARCHAR(20) NOT NULL,
	PRIMARY KEY (user_id, course_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

CREATE TABLE schedule (
    user_id INT,
    course_id INT,
    day_of_week VARCHAR(10) NOT NULL,
    time_start TIME NOT NULL,
    time_end TIME NOT NULL,
    class varchar(100),
    PRIMARY KEY (user_id, course_id),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (course_id) REFERENCES courses(id)
);

-- Thêm dữ liệu mẫu cho bảng users
INSERT INTO users (username, password, email) VALUES
('nguyenvana', 'password123', 'nguyenvana@example.com'),
('tranthib', 'password456', 'tranthib@example.com'),
('lethic', 'password789', 'lethic@example.com');

-- Thêm dữ liệu mẫu cho bảng courses
INSERT INTO courses (course_name, course_code) VALUES
('Trí tuệ nhân tạo', 'IT4100'),
('Lập trình web', 'IT3100'),
('Cơ sở dữ liệu', 'IT2100'),
('Mạng máy tính', 'IT2200'),
('Cấu trúc dữ liệu và giải thuật', 'IT2300'),
('Hệ điều hành', 'IT2400'),
('Lập trình ứng dụng', 'IT2500'),
('Phân tích thiết kế', 'IT2600'),
('An toàn thông tin', 'IT2700'),
('Giao diện và trải nghiệm người dùng', 'IT2800'),
('Lập trình hướng đối tượng', 'IT2900'),
('Kỹ thuật phần mềm', 'IT3000'),
('Nhập môn kĩ thuật máy tính', 'IT3200'),
('Cơ sở dữ liệu (TN)', 'IT3300'),
('Phân tích dữ liệu', 'IT3400'),
('Học máy', 'IT3500');

-- Thêm dữ liệu mẫu cho bảng grades (mỗi user ít nhất 15 courses)
INSERT INTO grades (user_id, course_id, grade, semester) VALUES
(1, 6, 'A', '2021.2'), (1, 7, 'B+', '2021.2'), (1, 8, 'D+', '2021.2'), (1, 9, 'B', '2021.2'), (1, 10, 'C+', '2021.2'),
(1, 11, 'A', '2021.2'), (1, 12, 'B+', '2021.2'), (1, 13, 'D', '2021.2'), (1, 14, 'B', '2021.2'), (1, 15, 'C+', '2021.2'),
(2, 1, 'B', '2021.2'), (2, 2, 'C+', '2021.2'), (2, 3, 'A', '2021.2'), (2, 4, 'B+', '2021.2'), (2, 5, 'B+', '2021.2'), 
(2, 11, 'B', '2021.2'), (2, 12, 'C+', '2021.2'), (2, 13, 'A', '2021.2'), (2, 14, 'B+', '2021.2'), (2, 15, 'D', '2021.2'),
(3, 1, 'A', '2021.2'), (3, 2, 'B', '2021.2'), (3, 3, 'C+', '2021.2'), (3, 4, 'A', '2021.2'), (3, 5, 'B+', '2021.2'), 
(3, 6, 'A', '2021.2'), (3, 7, 'B', '2021.2'), (3, 8, 'C+', '2021.2'), (3, 9, 'A', '2021.2'), (3, 10, 'B+', '2021.2');

-- Thêm dữ liệu mẫu cho bảng schedule (mỗi user có đủ các ngày từ thứ 2 đến thứ 6 và trong một ngày ít nhất 2 môn học)
INSERT INTO schedule (user_id, course_id, day_of_week, time_start, time_end, class) VALUES
(1, 1, 'Thứ 2', '08:00:00', '10:00:00', 'Room 101'), (1, 2, 'Thứ 3', '10:15:00', '12:15:00', 'Room 102'),
(1, 3, 'Thứ 4', '08:00:00', '10:00:00', 'Room 103'), (1, 4, 'Thứ 2', '10:15:00', '12:15:00', 'Room 104'),
(1, 5, 'Thứ 6', '08:00:00', '10:00:00', 'Room 105'),

(2, 6, 'Thứ 2', '10:15:00', '12:15:00', 'Room 206'),
(2, 7, 'Thứ 3', '08:00:00', '10:00:00', 'Room 207'), (2, 8, 'Thứ 5', '10:15:00', '12:15:00', 'Room 208'),
(2, 9, 'Thứ 4', '08:00:00', '10:00:00', 'Room 209'), (2, 10, 'Thứ 6', '10:15:00', '12:15:00', 'Room 210'),

(3, 11, 'Thứ 2', '08:00:00', '10:00:00', 'Room 301'), (3, 13, 'Thứ 3', '08:00:00', '10:00:00', 'Room 303'),
(3, 14, 'Thứ 3', '08:00:00', '10:00:00', 'Room 305'), (3, 15, 'Thứ 5', '08:00:00', '10:00:00', 'Room 307'), 
(3, 16, 'Thứ 6', '10:15:00', '12:15:00', 'Room 310');