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
// เช็กว่าฟอร์มบนหน้าเว็บถูกส่งหรือไม่
if (!empty($_POST["send"])) {
    // หากถูกส่งก็ดึงข้อมูลเดือนและปีมาเก็บใส่ตัวแปร
    $month = $_POST["month"];
    $year = $_POST["year"];

    // เชื่อมฐานข้อมูล
    $link = mysqli_connect("localhost", "root", "", "transcenter");

    // เขียน SQL ดึงข้อมูลนักแปลที่มีงานแปลในแต่ละเดือนและปีที่กำหนดไว้ โดยที่คำนวนค่าตอบแทนที่นักแปลได้ในเดือนนั้น
    // นำตัวแปรเดือนและปีที่สร้างไว้ไปเป็นเงื่อนไขในการดึงข้อมูล
    $sql = "
        SELECT t.trans_id, t.trans_name, t.trans_lastname , SUM(o.ord_commis) AS total_commis, COUNT(ord_id) AS work_amount
        FROM translators AS t 
        INNER JOIN orders AS o ON t.trans_id = o.trans_id
        WHERE MONTH(o.ord_startdate) = $month  AND YEAR(o.ord_startdate) = $year
        GROUP BY t.trans_id;
    ";
    // เขียน SQL ดึงข้อมูลยอดรวมค่าตอบแทนนักแปลทั้งหมดในเดือนและปีที่กำหนดไว้
    $sql2 = "
        SELECT SUM(o.ord_commis) AS total_month
        FROM orders o
        WHERE MONTH(o.ord_startdate) = $month  AND YEAR(o.ord_startdate) = $year
    ";

    // ดำเนินการดึงข้อมูลของทั้ง 2 สคริป SQL ที่ดึงข้อมูล
    $result = mysqli_query($link, $sql);
    $result2 = mysqli_query($link, $sql2);

    // กำหนด array ในการเปลี่ยนเลขเดือนให้เป็นชื่อเดือนไทยแบบเต็ม
    $monthNamesThai = array(
        1 => "มกราคม",
        2 => "กุมภาพันธ์",
        3 => "มีนาคม",
        4 => "เมษายน",
        5 => "พฤษภาคม",
        6 => "มิถุนายน",
        7 => "กรกฎาคม",
        8 => "สิงหาคม",
        9 => "กันยายน",
        10 => "ตุลาคม",
        11 => "พฤศจิกายน",
        12 => "ธันวาคม"
    );

    // นำค่าตัวแปรเดือนที่ตอนแรกที่เป็นตัวเลขมาเปลี่ยนให้เป็นตัวหนังสือและเก็บใส่ตัวแปร
    $monthName = $monthNamesThai[$month];

    // เอาค่าตัวแปรไปแสดงในตาราง
    echo "<h4>สรุปเบิกค่าตอบแทนนักแปล</h4>";
    echo "<p>เดือน $monthName</p>";
    echo "<p>ปี ค.ศ. $year</p>";

    // เช็กว่าได้ผลลัพธ์การดึงข้อมูลหรือไม่
    if (mysqli_num_rows($result) > 0) {
        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>รหัสนักแปล</td>";
        echo "<td>ชื่อ</td>";
        echo "<td>นามสกุล</td>";
        echo "<td>ค่าตอบแทนในเดือนนี้</td>";
        echo "<td>จำนวนงานทั้งหมด</td>";
        echo "</tr>";

        // นำค่าผลลัพธ์ของการคำนวนค่าตอบแทนนักแปลทั้งหมดมาเก็บใส่ตัวแปรและนำไปแสดงผลหน้าเว็บไซต์
        $row2 = mysqli_fetch_assoc($result2);
        echo "<p>รวมยอดเบิกในเดือนนี้ ".$row2['total_month']." บาท</p>";

        
        // นำค่าผลลัพธ์ของค่าตอบแทนของนักแปลแต่ละคนในเดือนที่กำหนดมาเก็บใส่ตัวแปรและนำไปแสดงผลหน้าเว็บไซต์
        while ($dbarr = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$dbarr['trans_id']}</td>";
            echo "<td>{$dbarr['trans_name']}</td>";
            echo "<td>{$dbarr['trans_lastname']}</td>";
            echo "<td>{$dbarr['total_commis']}</td>";
            // ส่งค่า trans_id, month, year, monthName ของนักแปลแต่ละคนไปยังอีก ccti_query2.2.php เพื่อให้ไฟล์นั้นแสดงผลรายการรายละเอียดงานแปลทั้งหมดของนักแปลแต่ละคนในเดือนและปีที่กำหนด
            echo "<td><a href='ccti_query2.2.php?trans_id={$dbarr['trans_id']}&month=$month&year=$year&monthName=$monthName'>$dbarr[work_amount] งาน</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>ไม่พบงานแปลในเดือนนี้</p>";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($link);
} else {
    // แสดงผลตาราง HTML
    echo "<h4>สรุปเบิกค่าตอบแทนนักแปล</h4>";
    ?>
    <form action="ccti_query2.php" method="POST">
        <p>
            เดือน
            <select name="month">
                <option value="" selected disabled>เลือกเดือนที่ต้องการ</option>
                <option value="1">มกราคม</option>
                <option value="2">กุมภาพันธ์</option>
                <option value="3">มีนาคม</option>
                <option value="4">เมษายน</option>
                <option value="5">พฤษภาคม</option>
                <option value="6">มิถุนายน</option>
                <option value="7">กรกฎาคม</option>
                <option value="8">สิงหาคม</option>
                <option value="9">กันยายน</option>
                <option value="10">ตุลาคม</option>
                <option value="11">พฤศจิกายน</option>
                <option value="12">ธันวาคม</option>
            </select>
        </p>
        <p>
            ปี ค.ศ.
            <select name="year">
                <option value="" selected disabled>เลือกปีที่ต้องการ</option>
                <option value="2021">2021</option>
                <option value="2022">2022</option>
              
                
            </select>
        </p>
        <input type="submit" name="send" value="Submit">
        <input type="reset" name="cancel" value="Reset">
    </form>

    <?php
}
?>
