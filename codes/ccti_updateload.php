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
//ตรวจสอบว่าได้ส่งแบบฟอร์มแล้วหรือไม่
if (empty($_POST["send"])) {
?>
<!สร้าง html ฟอร์มเพื่อรับรหัสงานแปล>
    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <h4>แบบฟอร์มประเมินราคาและมอบหมายงานแปล</h4>
        <p>กรุณากรอกรหัสงานแปล</p>
        <p>รหัสงานแปล<input type="text" name="id"></p>
        <!ปุ่มส่งฟอร์ม>
        <input type="submit" name="send" value="Submit">
        <!ปุ่มรีเซ็ตฟอร์ม>
        <input type="reset" name="reset" value="Reset">
    </form>
<?php
} else {
    //สร้างตัวแปรเพื่อเก็บค่า id ของ ord_id
    $id = $_POST["id"];
    //เชื่อมต่อกับฐานข้อมูล
    $link = mysqli_connect("localhost", "root", "", "transcenter");
    //ตรวจสอบว่าเชื่อมต่อกับฐานข้อมูลสำเร็จหรือไม่
    if (!$link) {
        die("ไม่สามารถเชื่อมต่อกับฐานข้อมูลได้");
    }
    //คิวรี่ข้อมูลจากตาราง orders, translators
    $query = "SELECT t.trans_id, t.trans_name, t.trans_lastname, o.ord_commis, o.ord_duedate, o.ord_stat
              FROM orders o, translators t
              WHERE o.ord_id = ?";
    //สร้างตัวแปรเพื่อเก็บค่า การเชื่อมต่อกับฐานข้อมูลและคิวรี่
    $stmt = mysqli_prepare($link, $query);
    //bind $stmt กับ $id โดยมี value เป็น "s"(string)
    mysqli_stmt_bind_param($stmt, "s", $id);
    //execute ค่าที่ bind ไว้ในฟังก์ชันข้างบน
    mysqli_stmt_execute($stmt);
    //เก็บค่าที่ execute ไว้ใน $result
    $result = mysqli_stmt_get_result($stmt);
    //ตรวจสอบว่าเรียกข้อมูลได้หรือไม่
    if (!$result) {
        die("ไม่สามารถเรียกข้อมูลได้");
    }
    //ตรวจสอบว่ามีรหัสงานแปลในฐานข้อมูลหรือไม่ ถ้าไม่มีให้กลับไปหน้าหลัก
    if (mysqli_num_rows($result) === 0) {
        echo "ไม่พบรหัสงานแปลในฐานข้อมูล.";
		echo "<p><p>";
        //ปุ่มกลับไปหน้าหลัก
        echo "<a href='javascript:history.go(-1)'>กลับสู่หน้าหลัก</a>";
        //ปิดการเชื่อมต่อกับฐานข้อมูล เพื่อลดการใช้งาน memory และ resources
        mysqli_close($link);
    } else {
        //ตรวจสอบว่างานแปลได้รับมอบหมายแล้วหรือยัง ถ้าได้รับมอบหมายแล้วให้กลับไปหน้าหลัก
        $row = mysqli_fetch_assoc($result);
        if ($row['ord_stat'] != 'รอมอบหมายงาน') {
            echo "งานแปลนี้ได้รับมอบหมายแล้ว โปรดเลือกงานแปลอื่น.";
            echo "<p><p>";
            //ปุ่มกลับไปหน้าหลัก
            echo "<a href='javascript:history.go(-1)'>กลับสู่หน้าหลัก</a>";
            //ปิดการเชื่อมต่อกับฐานข้อมูล เพื่อลดการใช้งาน memory และ resources
            mysqli_close($link);
        } else {
            //ถ้า ord_id อยู่ในฐานข้อมูล และ ord_stat = 'รอมอบหมายงาน'
            //สร้างฟอร์มแสดงข้อมูลพนักงาน โดยถ้าคลิกปุ่ม  Submit จะส่งไปยังไฟล์ ccti_update.php
            //โดยมีการส่งรหัสออเดอร์ผ่านตัวแปร Empno ไปด้วย
            echo "<form action='ccti_update.php?Ordno=$id' method='post'>";
            echo "<h4>แบบฟอร์มประเมินราคาและมอบหมายงานแปล</h4>";
            echo "<p>รหัสงานแปล: $id</p>";
            echo "<p>เลือกนักแปล: <select name='Tname'>";
            //คิวรี่ข้อมูลในตาราง translators
            $sql = "SELECT * FROM translators";
            //สร้างตัวแปรเพื่อเก็บค่า การเชื่อมต่อกับฐานข้อมูลและคิวรี่
            $result = mysqli_query($link, $sql);
            //นำชื่อและนามสกุลของนักแปลวนลูปใส่ใน drop down และรหัสนักแปลใส่เป็น value
            while ($dbarr = mysqli_fetch_array($result)) {
                echo "<option value='$dbarr[trans_id]'>" . $dbarr['trans_name'] . " " . $dbarr['trans_lastname'] . "</option>";
            }
            echo "</select></p>";
            //input ที่เหลือสำหรับอัปเดตข้อมูลออเดอร์
            echo "<p>ค่าตอบแทนนักแปลและนักอ่าน: <input type='number' name='Ocommission' value='" . (int)$row['ord_commis'] . "'></p>";
            echo "<p>วันกำหนดส่งงานแปล: <input type='date' name='duedate' value='" . (!empty($row['ord_duedate']) ? $row['ord_duedate'] : '') . "'></p>";
            //ปุ่มส่งฟอร์ม
            echo "<input type='submit' name='Submit' value='Submit'>";
            //ปุ่มรีเซ็ตฟอร์ม
            echo "<input type='reset' name='Reset' value='Reset'>";
            echo "</form>";
            //ปิดการเชื่อมต่อกับฐานข้อมูล เพื่อลดการใช้งาน memory และ resources
            mysqli_close($link);
        }
    }
}
?>
