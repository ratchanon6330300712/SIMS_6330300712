<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Insert Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            margin: 0;
            padding: 0;
        }
        .container {
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            margin: 0 auto;
            width: 400px;
            margin-top: 20px;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        form {
            text-align: left;
        }
        label {
            display: block;
            margin-bottom: 8px;
        }
        input[type="text"], input[type="email"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 3px;
        }
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 3px;
            cursor: pointer;
        }
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
        .error {
            color: red;
            margin-top: 10px;
        }
        .success {
            color: green;
            margin-top: 10px;
        }
        .back-link {
            text-align: center;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Insert Student Information</h2>
        <?php
        error_reporting(E_ALL);
        ini_set('display_errors', '1');
        ini_set('display_startup_errors', '1');
        
        $servername = "localhost";
        $username = "root";
        $password = "knight2001";
        $dbname = "students";
        
        // ตรวจสอบว่ามีการส่งข้อมูลผ่าน POST หรือไม่
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $id = trim($_POST["id"]);
            $en_name = trim($_POST["en_name"]);
            $en_surname = trim($_POST["en_surname"]);
            $th_name = trim($_POST["th_name"]);
            $th_surname = trim($_POST["th_surname"]);
            $major_code = trim($_POST["major_code"]);
            $email = trim($_POST["email"]);
        
            // ตรวจสอบว่าไม่มีค่าว่างในฟิลด์ที่ห้ามว่าง
            if (!empty($id) && !empty($en_name) && !empty($en_surname) && !empty($th_name) && !empty($th_surname) && !empty($major_code) && !empty($email)) {
                // ตรวจสอบรูปแบบของอีเมล
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    // ทำการเชื่อมต่อกับฐานข้อมูล
                    $conn = mysqli_connect($servername, $username, $password, $dbname);
                    if (!$conn) {
                        die("Connection failed " . mysqli_connect_error());
                    }
        
                    // ใช้ htmlspecialchars() เพื่อป้องกัน Cross-Site Scripting (XSS)
                    $id = htmlspecialchars($id);
                    $en_name = htmlspecialchars($en_name);
                    $en_surname = htmlspecialchars($en_surname);
                    $th_name = htmlspecialchars($th_name);
                    $th_surname = htmlspecialchars($th_surname);
                    $major_code = htmlspecialchars($major_code);
                    $email = htmlspecialchars($email);
        
                    // สร้างคำสั่ง SQL เพื่อเพิ่มข้อมูล
                    $sql = "INSERT INTO `std_info` (`id`, `en_name`, `en_surname`, `th_name`, `th_surname`, `major_code`, `email`) VALUES ('$id', '$en_name', '$en_surname', '$th_name', '$th_surname', '$major_code', '$email')";
        
                    $result = mysqli_query($conn, $sql);
        
                    if ($result) {
                        echo "New record created successfully!<br>";
                        echo '<a href="student.php">Back</a>';
                    } else {
                        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                    }
        
                    mysqli_close($conn);
                } else {
                    echo "Invalid email format. Please enter a valid email address.<br>";
                    echo '<a href="insert_std_form.html">Back to Form</a>';
                }
            } else {
                echo "Please fill in all required fields.<br>";
                echo '<a href="insert_std_form.html">Back to Form</a>';
            }
        } else {
            echo "Invalid request.";
        }
        ?>
        <div class="back-link">
            <a href="insert_std_form.html">Back to Form</a>
        </div>
    </div>
</body>
</html>


