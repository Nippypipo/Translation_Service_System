<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="ccti_decorate.css">
</head>
<body>
    <h1>หน่วยบริการงานแปลและงานล่ามหน่วยบริการงานแปลและงานล่าม</h1>
    <ul class="navbar">
        <li class="nav-item"><a href="ccti_homepage.html">หน้าแรก</a></li>
        <li class="nav-item"><a href="ccti_query3.php">รายการงานแปล</a></li>
        <li class="nav-item"><a href="ccti_delete.php">ลบรายการงานแปล</a></li>
        <li class="nav-item"><a href="ccti_query1.php">ค้นหานักแปล</a></li>
        <li class="nav-item"><a href="ccti_updateload.php">มอบหมายงานแปล</a></li>
        <li class="nav-item"><a href="ccti_query2.php">สรุปเบิกค่าตอบแทนนักแปล</a></li>
        <li class="nav-item"><a href="ccti_query4.php">นักแปลทั้งหมด</a></li>
        <li class="nav-item"><a href="ccti_insert.php">เพิ่มนักแปล</a></li>
        
    </ul>
</body>
</html>


<?php
// เชื่อมต่อกับฐานข้อมูล
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "transcenter";

$conn = new mysqli($servername, $username, $password, $dbname);

// เช็กการเชื่อมต่อ
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ดึงข้อมูลทั้งหมดจากตาราง translators
$sql = "SELECT * FROM translators";
$result = $conn->query($sql);

// เช็กว่ามีค่าที่ return ออกมาหรือไม่
if ($result->num_rows > 0) {
    // แสดงตาราง HTML
    echo "<h4>นักแปลทั้งหมด</h4>";
    echo "<table  border='1'>";
    echo "<tr><th>รหัสนักแปล</th><th>เพศ</th><th>ชื่อ</th><th>นามสกุล</th><th>วันที่เริ่มงาน</th><th>อีเมล์</th><th>เบอร์โทร</th><th>ที่อยู่</th></tr>";

    // แสดงผลลัพธ์แต่ละแถวในตาราง
    while ($row = $result->fetch_assoc()) {
    
        echo "<tr>";
        echo "<td>" . $row["trans_id"] . "</td>";
        echo "<td>" . $row["trans_gender"] . "</td>";
        echo "<td>" . $row["trans_name"] . "</td>";
        echo "<td>" . $row["trans_lastname"] . "</td>";
        echo "<td>" . $row["trans_startdate"] . "</td>";
        echo "<td>" . $row["trans_email"] . "</td>";
        echo "<td>" . $row["trans_phone"] . "</td>";
        echo "<td>" . $row["trans_address"] . "</td>";
        echo "</tr>";
    }

    
    echo "</table>";
} else {
    echo "No results found.";
}

// ปิดการเชื่อมต่อฐานข้อมูล
$conn->close();
?>
