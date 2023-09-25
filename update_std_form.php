<?php
error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

$servername = "localhost";
$username = "root";
$password = "knight2001";
$dbname = "students";

if ($_SERVER["REQUEST_METHOD"] == "GET" && isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }

    $sql = "SELECT * FROM `std_info` WHERE `id` = $id";
    $result = mysqli_query($conn, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $en_name = $row["en_name"];
        $en_surname = $row["en_surname"];
        $th_name = $row["th_name"];
        $th_surname = $row["th_surname"];
        $major_code = $row["major_code"];
        $email = $row["email"];
    } else {
        echo "No record found with ID $id.";
        mysqli_close($conn);
        exit;
    }

    mysqli_close($conn);
} else {
    echo "Invalid request.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="th">
<head>
    <meta charset="UTF-8">
    <title>แก้ไขข้อมูลนักศึกษา</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        form {
            background-color: #fff;
            padding: 50px;
            max-width: 400px;
            margin: 0 auto;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);
        }

        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border: 1px solid #ddd;
            border-radius: 3px;
        }

        input[type="submit"] {
            background-color: #d5bdaf;
            color: #edede9;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }

        input[type="submit"]:hover {
            background-color: #d6ccc2;
        }

        h1 {
            text-align: center;
            color: #333;
        }
    </style>
</head>
<body>
    <h1>แก้ไขข้อมูลนักศึกษา</h1>
    <form method="post" action="update_std.php">
        <input type="hidden" name="id" value="<?php echo $id; ?>">
        name: <input type="text" name="en_name" value="<?php echo $en_name; ?>"><br>
        surname: <input type="text" name="en_surname" value="<?php echo $en_surname; ?>"><br>
        ชื่อ: <input type="text" name="th_name" value="<?php echo $th_name; ?>"><br>
        นามสกุล: <input type="text" name="th_surname" value="<?php echo $th_surname; ?>"><br>
        Major: <input type="text" name="major_code" value="<?php echo $major_code; ?>"><br>
        Email: <input type="text" name="email" value="<?php echo $email; ?>"><br>
        <input type="submit" value="Update">
    </form>
</body>
</html>
