<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Information</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 80%;
            margin: 0 auto;
            border-collapse: collapse;
            background-color: #edede9;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        th {
            background-color: #d5bdaf;
            color: #edede9;
        }
        a.button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #d5bdaf;
            color: #edede9;
            text-decoration: none;
            border-radius: 5px;
        }
        a.button:hover {
            background-color: #d6ccc2;
        }
    </style>
</head>
<body>
    <h1>Student Information</h1>
    <?php
    
    error_reporting(E_ALL);
    ini_set('display_errors', '1');
    ini_set('display_startup_errors', '1');
    $servername = "localhost";
    $username = "root";
    $password = "knight2001";
    $dbname = "students";
    $conn = mysqli_connect($servername, $username, $password, $dbname);
    if (!$conn) {
        die("Connection failed " . mysqli_connect_error());
    }
   
    $sql = "SELECT * FROM `std_info`";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        if (mysqli_num_rows($result) > 0) {
            echo "<table>";
            echo "<tr><th>ID</th><th>Name</th><th>Surname</th>";
            echo "<th>ชื่อ</th><th>นามสกุล</th>";
            echo "<th>Major</th><th>Email</th><th>Action</th></tr>";
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<tr><td>" . $row["id"] . "</td>";
                echo "<td>" . $row["en_name"] . "</td>";
                echo "<td>" . $row["en_surname"] . "</td>";
                echo "<td>" . $row["th_name"] . "</td>";
                echo "<td>" . $row["th_surname"] . "</td>";
                echo "<td>" . $row["major_code"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td><a class='button' href='delete_std.php?id=" . $row["id"] . "'>Delete</a> ";
                echo "<a class='button' href='update_std_form.php?id=" . $row["id"] . "'>Update</a></td></tr>";
            }
            echo "</table>";
        }
    }
    echo "<p style='text-align:center;'><a class='button' href='insert_std_form.html'>Insert New Record</a></p>";
    mysqli_close($conn);
    ?>
</body>
</html>
