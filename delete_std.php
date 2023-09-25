<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>ลบข้อมูลนักศึกษา</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            background-color: #fff;
            padding: 20px;
            max-width: 400px;
            margin: 0 auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .confirmation {
            text-align: center;
            margin-top: 20px;
        }

        .confirmation button {
            background-color: #d5bdaf;
            color: #edede9;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }

        .confirmation button:hover {
            background-color: #d6ccc2;
        }

        .back-link {
            display: block;
            text-align: center;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');

        $servername = "localhost";
        $username = "root";
        $password = "knight2001";
        $dbname = "students";

        // ตรวจสอบว่ามีรหัสนักเรียนที่ส่งมาในพารามิเตอร์ id
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];

            if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['confirm'])) {
                // สร้างการเชื่อมต่อกับฐานข้อมูล
                $conn = mysqli_connect($servername, $username, $password, $dbname);
                if (!$conn) {
                    die("Connection failed " . mysqli_connect_error());
                }

                // สร้างคำสั่ง SQL สำหรับลบข้อมูล
                $sql = "DELETE FROM `std_info` WHERE `id` = $id";

                $result = mysqli_query($conn, $sql);

                if ($result) {
                    echo "<h1>ลบข้อมูลสำเร็จ</h1>";
                    echo '<div class="confirmation"><button><a href="student.php">กลับหน้ารายการนักศึกษา</a></button></div>';
                } else {
                    echo "<h1>เกิดข้อผิดพลาด</h1>";
                    echo "เกิดข้อผิดพลาดในการลบข้อมูล: " . mysqli_error($conn) . "<br>";
                    echo '<div class="confirmation"><button><a href="student.php">กลับหน้ารายการนักศึกษา</a></button></div>';
                }

                mysqli_close($conn);
            } else {
                // แสดงกล่องข้อความยืนยัน
                echo "<h1>คุณแน่ใจหรือไม่ว่าต้องการลบข้อมูลนี้?</h1>";
                echo '<form method="post" action="" class="confirmation">';
                echo '<button type="submit" name="confirm">ยืนยันการลบ</button> ';
                echo '</form>';
                echo '<div class="back-link"><a href="student.php">ยกเลิก</a></div>';
            }
        } else {
            echo "Invalid request.";
        }
        ?>
    </div>
</body>
</html>

