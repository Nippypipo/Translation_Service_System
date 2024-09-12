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
if (empty($_POST["send"])) { //ตรวจสอบว่าได้ส่งแบบฟอร์มไปหรือยัง
?>
    <!สร้างฟอร์ม html รับข้อมูล>
    <form action="ccti_delete.php" method="POST">
        <p>
        <h4>ลบรายการงานแปล</h4>
        <p>
        รหัสลูกค้า <input type="text" name="cust_id" maxlength="4" pattern="C\d{3}" placeholder="ตัวอย่าง C001"><p>
        รหัสงานแปล <input type="text" name="ord_id" maxlength="5" pattern="2\d{4}" placeholder="ตัวอย่าง 20001"><p>
        <input type="submit" name="send" value="Submit" onclick="return confirmDelete();">
        <input type="reset" name="cancel" value="Reset">
            <!double check>
            <script>
                function confirmDelete() {
                return confirm("คุณแน่ใจหรือไม่ที่จะลบข้อมูลดังกล่าว");
                }
            </script>
    </form>
<?php
} else {
    //กำหนดตัวแปรเพื่อมาเก็บค่า cust_id และ ord_id
    $cust_id = $_POST["cust_id"];
    $ord_id = $_POST["ord_id"];
    //เชื่อมต่อกับฐานข้อมูล
    $link = mysqli_connect("localhost", "root", "", "TransCenter");

    //สร้าง query เพื่อ match ข้อมูลที่พิมพ์เข้ากับข้อมูลในตาราง orders
    $select = "SELECT * FROM orders WHERE ord_id = '$ord_id' AND cust_id = '$cust_id'";
    $result = mysqli_query($link, $select);

    //กรณีที่มีข้อมูลอยู่ในฐานข้อมูลจริง
    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);

        //สร้าง query เพื่อเพิ่มข้อมูลที่ดึงมาจากตาราง orders เข้าไปในตาราง deleted_order
        $insert = "INSERT INTO deleted_orders (ord_id, cust_id, trans_id, ord_stat, ord_total, ord_commis, ord_service, ord_startdate, ord_duedate, trans_lang, ori_lang, ord_file, ord_type, tax_invoice, submit_date)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        //สร้างตัวแปรเพื่อเก็บค่า การเชื่อมต่อกับฐานข้อมูลและคิวรี่
        $statement = mysqli_prepare($link, $insert);

        if ($statement) {
            //bind $stmt กับคอลัมน์ทั้งหมดโดยมี value เป็น "s"(string)
            mysqli_stmt_bind_param($statement, "sssssssssssssss", $row['ord_id'], $row['cust_id'], $row['trans_id'], $row['ord_stat'], $row['ord_total'], $row['ord_commis'], $row['ord_service'], $row['ord_startdate'], $row['ord_duedate'], $row['trans_lang'], $row['ori_lang'], $row['ord_file'], $row['ord_type'], $row['tax_invoice'], $row['submit_date']);

            //execute ค่าที่ bind ไว้ในฟังก์ชันข้างบน
            $insertResult = mysqli_stmt_execute($statement);
            
             //กรณีที่ execute ค่าที่ bind ไว้สำเร็จ
            if ($insertResult) {
                //สร้าง query เพื่อลบข้อมูลดังกล่าวจากตาราง 'orders'
                $delete = "DELETE FROM orders WHERE cust_id = '$cust_id' AND ord_id = '$ord_id'";
                $deleteResult = mysqli_query($link, $delete);

            //ตรวจสอบว่าลบข้อมูลสำเร็จหรือไม่
                if ($deleteResult) {
                    echo "การลบข้อมูลในฐานข้อมูลประสบความสำเร็จ";
                    echo "<br>";
                    echo "<a href='ccti_delete.php'>กลับสู่หน้าหลัก</a>";
                } else {
                    echo "การลบข้อมูลผิดพลาด กรุณาตรวจสอบใหม่อีกครั้ง";
                    echo "<br>";
                    echo "<a href='ccti_delete.php'>กลับสู่หน้าหลัก</a>";
                }
            } else {
                echo "การลบข้อมูลผิดพลาด กรุณาตรวจสอบใหม่อีกครั้ง";
                echo "<br>";
                echo "<a href='ccti_delete.php'>กลับสู่หน้าหลัก</a>";
            }
        } else {
            echo "การลบข้อมูลผิดพลาด กรุณาตรวจสอบใหม่อีกครั้ง";
            echo "<br>";
            echo "<a href='ccti_delete.php'>กลับสู่หน้าหลัก</a>";
        }
    } else {
        //กรณีที่ไม่พบข้อมูลตามที่กรอกเข้ามา
        echo "ไม่พบข้อมูลดังกล่าว";
        echo "<br>";
        echo "<a href='ccti_delete.php'>กลับสู่หน้าหลัก</a>";
    }
}
?>
