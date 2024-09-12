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

    <?php
    // เชื่อมต่อกับฐานข้อมูล
    $link = mysqli_connect("localhost", "root", "", "transcenter");

    // เช็กว่าปุ่มตัวกรองถูกคลิกหรือไม่ ถ้าถูกคลิกก็เก็บค่าสถานะใส่ตัวแปร
    if (isset($_POST['filter'])) {
        $filterStatus = $_POST['status'];

        // เขียน SQL ดึงข้อมูลทั้งหมดจากตาราง orders ถ้าค่าสถานะที่เก็บมาคือ all และหากค่าสถานะเป็นอย่างอื่นก็ใช้เป็นเงื่อนไขในการดึงข้อมูล
        if ($filterStatus == 'all') {
            $sql = "SELECT * FROM orders";
        } else {
            $sql = "SELECT * FROM orders WHERE ord_stat = '$filterStatus'";
        }
    } else {
        // เขียน SQL ดึงข้อมูลทั้งหมดจากตาราง orders ในกรณีที่ผู้ใช้ยังไม่กดปุ่มตัวกรองเพื่อแสดงข้อมูล
        $sql = "SELECT * FROM orders";
    }

    // ดำเนินการดึงข้อมูลจาก SQL ที่ได้เขียนไป
    $result = mysqli_query($link, $sql);

    // แสดงผลในตาราง HTML 
    echo "<h4>รายการงานแปล</h4>";
    echo "<form action='ccti_query3.php' method='POST'>";
    echo "<label for='status'>ตัวกรอง:</label>";
    echo "<select name='status' id='status'>";
    echo "<option value='' selected disabled>เลือกสถานะ</option>";
    echo "<option value='all'>ทั้งหมด</option>";
    echo "<option value='กำลังดำเนินงาน'>กำลังดำเนินงาน</option>";
    echo "<option value='เสร็จสมบูรณ์'>เสร็จสมบูรณ์</option>";
    echo "<option value='รอมอบหมายงาน'>รอมอบหมายงาน</option>";
    echo "</select>";
    echo "<input type='submit' name='filter' value='กรองข้อมูล'>";
    echo "</form>";

    echo "<table border='1'>";
    echo "<tr>";
    echo "<th>รหัสงานแปล</th>";
    echo "<th>สถานะงานแปล</th>";
    echo "<th>รหัสลูกค้า</th>";
    echo "<th>ชื่อลูกค้า</th>";
    echo "<th>รหัสนักแปล</th>";
    echo "<th>ชื่อนักแปล</th>";
    echo "<th>ภาษาที่ต้องการแปล</th>";
    echo "<th>ภาษาต้นฉบับ</th>";
    echo "<th>ประเภทงาน</th>";
    echo "<th>วันที่กำหนดส่ง</th>";
    echo "<th>ต้องการใบกำกับภาษี</th>";
    echo "</tr>";

    // ลูบวนในแต่ละแถวที่ได้ดึงข้อมูลมาและนำมาตัวแปรมาแสดงในตาราง
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>{$row['ord_id']}</td>";
        echo "<td>{$row['ord_stat']}</td>";
        // เก็บค่าชื่อลูกค้าและชื่อนักแปลใส่ตัวแปร

        $customerId = $row['cust_id'];
        $translatorId = $row['trans_id'];
        // ดึงข้อมูลชื่อลูกค้ามาจากตาราง customers จาก customer_id ที่มีอยู่
       
        $customerQuery = "SELECT cust_name, cust_id FROM customers WHERE cust_id = '$customerId'";
        $customerResult = mysqli_query($link, $customerQuery);
        $customerName = "";
        if (mysqli_num_rows($customerResult) > 0) {
            $customerName = mysqli_fetch_assoc($customerResult)['cust_name'];
        }

        // ดึงข้อมูลชื่อนักแปลมาจากตาราง translators มาเก็บใส่ตัวแปร และนำตัวแปรไปแสดงค่าในตาราง
        
        $translatorQuery = "SELECT trans_name FROM translators WHERE trans_id = '$translatorId'";
        $translatorResult = mysqli_query($link, $translatorQuery);
        $translatorName = "";
        if (mysqli_num_rows($translatorResult) > 0) {
            $translatorName = mysqli_fetch_assoc($translatorResult)['trans_name'];
        }
        echo "<td>$customerId</td>";
        echo "<td>$customerName</td>";
        // เขียนเงื่อนไขหากบางคอลัมภ์มีค่าว่าง ให้แสดง "-" (ในกรณีที่งานแปลยังไม่มีนักแปลที่ได้รับมอบหมาย)
        echo "<td>" . ($translatorId ? $translatorId : "-") . "</td>";
        echo "<td>" . ($translatorName ? $translatorName : "-") . "</td>";
        echo "<td>{$row['trans_lang']}</td>";
        echo "<td>{$row['ori_lang']}</td>";
        echo "<td>{$row['ord_type']}</td>";
        echo "<td>{$row['ord_duedate']}</td>";
        echo "<td>{$row['tax_invoice']}</td>";

        echo "</tr>";
    }

    echo "</table>";

    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($link);
    ?>
</body>
</html>
