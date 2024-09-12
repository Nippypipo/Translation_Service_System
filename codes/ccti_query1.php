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
// เช็กว่าฟอร์มถูกส่งหรือไม่
if (!empty($_POST["send"])) {
    // นำข้อมูลภาษาที่ต้องการแปลและภาษาต้นฉบับมาเก็บใส่ตัวแปร
    $ori_lang = $_POST["ori_lang"];
    $trans_lang = $_POST["trans_lang"];

    // เชื่อมต่อฐานข้อมูล
    $link = mysqli_connect("localhost", "root", "", "transcenter");

    // เขียน SQL ดึงข้อมูลต่าง ๆ ของนักแปลที่แปลตามตัวแปรที่สร้างมา โดยที่จะนับจำนวนงานแปลที่นักแปลคนนั้นกำลังทำอยู่ (สถานะกำลังดำเนินงาน)
    $sql = "
        SELECT t.trans_id, t.trans_name, t.trans_lastname, t.trans_phone, t.trans_email, IFNULL(COUNT(CASE WHEN o.ord_stat = 'กำลังดำเนินงาน' THEN 1 END), 0) AS work_status_count
        FROM translators AS t
        INNER JOIN languages AS l ON t.trans_id = l.trans_id
        LEFT JOIN orders AS o ON t.trans_id = o.trans_id AND o.ord_stat = 'กำลังดำเนินงาน'
        WHERE l.ori_lang = '$ori_lang' 
            AND l.trans_lang = '$trans_lang'
        GROUP BY t.trans_id, t.trans_name;
    ";

    // ดำเนินการดึงข้อมูลจาก SQL ที่เขียนไว้
    $result = mysqli_query($link, $sql);

    // แสดงผลลัพธ์ใส่ตาราง HTML
    echo "<h4>ค้นหานักแปล</h4>";

    if (mysqli_num_rows($result) > 0) {
        echo "<p>ภาษาที่ต้นทาง:  $ori_lang</p>";
        echo "<p>ภาษาที่ต้องการ:  $trans_lang</p>";
        

        echo "<table border='1'>";
        echo "<tr>";
        echo "<td>รหัสนักแปล</td>";
        echo "<td>ชื่อ</td>";
        echo "<td>นามสกุล</td>";
        echo "<td>เบอร์โทร</td>";
        echo "<td>อีเมล์</td>";
        echo "<td>งานแปลที่กำลังดำเนินอยู่</td>";
        echo "</tr>";

        while ($dbarr = mysqli_fetch_array($result)) {
            echo "<tr>";
            echo "<td>{$dbarr['trans_id']}</td>";
            echo "<td>{$dbarr['trans_name']}</td>";
            echo "<td>{$dbarr['trans_lastname']}</td>";
            echo "<td>{$dbarr['trans_phone']}</td>";
            echo "<td>{$dbarr['trans_email']}</td>";
            // ส่งค่า trans_id ของนักแปลแต่ละคนไปยังอีก ccti_query1.2.php เพื่อให้ไฟล์นั้นแสดงผลรายการรายละเอียดงานแปลที่นักแปลแต่ละคนกำลังดำเนินการทำอยู่
            echo "<td><a href='ccti_query1.2.php?trans_id={$dbarr['trans_id']}'>$dbarr[work_status_count] งาน</a></td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "ไม่พบนักแปลที่ต้องการ";
    }

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($link);
} else {
    // เขียนหน้าเว็บไซต์ด้วย HTML
    ?>
    <h4>ค้นหานักแปล</h4>
    <form action="ccti_query1.php" method="POST">
    <p>ภาษาต้นทาง
        <select name="ori_lang">
            <option value="" selected disabled>เลือกภาษาที่ต้องการ</option>
            <option value="ไทย">ภาษาไทย</option>
            <option value="อังกฤษ">ภาษาอังกฤษ</option>
            <option value="ญี่ปุ่น">ภาษาญี่ปุ่น</option>
            <option value="ฝรั่งเศส">ภาษาฝรั่งเศส</option>
            <option value="เยอรมัน">ภาษาเยอรมัน</option>
            <option value="สเปน">ภาษาสเปน</option>
            <option value="อิตาเลียน">ภาษาอิตาเลียน</option>
            <option value="โปรตุเกส">ภาษาโปรตุเกส</option>
            <option value="จีน">ภาษาจีน</option>
            <option value="เกาหลี">ภาษาเกาหลี</option>
            <option value="เขมร">ภาษาเขมร</option>
            <option value="มาเลย์">ภาษามาเลย์</option>
            <option value="ละติน">ภาษาละติน</option>
            <option value="อารบิก">ภาษาอารบิก</option>
            <option value="เวียดนาม">ภาษาเวียดนาม</option>
        </select>
    </p>
    <p>ภาษาปลายทาง
        <select name="trans_lang">
            <option value="" selected disabled>เลือกภาษาที่ต้องการ</option>
            <option value="ไทย">ภาษาไทย</option>
            <option value="อังกฤษ">ภาษาอังกฤษ</option>
            <option value="ญี่ปุ่น">ภาษาญี่ปุ่น</option>
            <option value="ฝรั่งเศส">ภาษาฝรั่งเศส</option>
            <option value="เยอรมัน">ภาษาเยอรมัน</option>
            <option value="สเปน">ภาษาสเปน</option>
            <option value="อิตาเลียน">ภาษาอิตาเลียน</option>
            <option value="โปรตุเกส">ภาษาโปรตุเกส</option>
            <option value="จีน">ภาษาจีน</option>
            <option value="เกาหลี">ภาษาเกาหลี</option>
            <option value="เขมร">ภาษาเขมร</option>
            <option value="มาเลย์">ภาษามาเลย์</option>
            <option value="ละติน">ภาษาละติน</option>
            <option value="อารบิก">ภาษาอารบิก</option>
            <option value="เวียดนาม">ภาษาเวียดนาม</option>
        </select>
    </p>
    <input type="submit" name="send" value="Submit">
    <input type="reset" name="cancel" value="Reset">
</form>
    <?php
}
?>
