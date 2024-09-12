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
    // รับข้อมูล trans_id, month, year จากไฟล์ ccti_query2.php เพื่อแสดงรายการรายละเอียดงานแปลทั้งที่ได้ทำของนักแปลไอดีนี้
    $trans_id = $_GET['trans_id'];
    $month = $_GET['month'];
    $year = $_GET['year'];
    $monthName = $_GET['monthName'];
   
    
    // เชื่อมต่อฐานข้อมูล
    $link = mysqli_connect("localhost", "root", "", "transcenter");
    
    // เขียน SQL ดึงข้อมูลงานแปลของนักแปล trans_id ที่รับค่ามา โดยดึงข้อมูลทั้งจากตาราง orders และ customers เพื่อดึงข้อมูลลูกค้า
    $sql = "SELECT o.ord_id, c.cust_id, c.cust_name, o.ord_startdate, o.ord_duedate, o.ord_type, o.ord_stat
        FROM orders o, customers c
        WHERE o.trans_id = '$trans_id'
        AND MONTH(o.ord_startdate) = $month  AND YEAR(o.ord_startdate) = $year
        AND c.cust_id = o.cust_id";

    
    // ดำเนินการดึงข้อมูลและรับชุดข้อมูลผลลัพธ์
    $result = mysqli_query($link, $sql);

    // เขียน SQL ดึงข้อมูลชื่อและนามสกุลของนักแปลเพื่อจะนำไปแสดงผลหน้าเว็บไซต์
    
    $trans_query = "SELECT trans_name, trans_lastname FROM translators WHERE trans_id = '$trans_id'";
    
    // ดำเนินการดึงข้อมูลจาก SQL ที่เขียนไว้
    $trans_result = mysqli_query($link, $trans_query);
    $trans_row = mysqli_fetch_assoc($trans_result);
    $trans_name = $trans_row['trans_name'];
    $trans_lastname = $trans_row['trans_lastname'];
    
    // นำค่าตัวแปรที่เก็บข้อมูลที่เราได้ดำเนินการดึงข้อมูลมาไปแสดงผลในตารางหน้าเว็บไซต์
    echo "<h4>สรุปเบิกค่าตอบแทนนักแปล</h4>";
    echo "<p>งานแปลในเดือน$monthName ปี $year คุณ$trans_name $trans_lastname </p>";
    echo "<table border=1>";						 
    echo "<tr>";							
        echo "<td>รหัสงานแปล</td>";	
        echo "<td>รหัสลูกค้า</td>";	  				
        echo "<td>ชื่อลูกค้า</td>";					  
        echo "<td>วันที่เริ่มงาน</td>";
        echo "<td>วันกำหนดส่ง</td>"; 
        echo "<td>สถานะงานแปล</td>"; 	
        echo "<td>ประเภทเอกสาร</td>"; 					  
    echo "</tr>";
    while ($row = mysqli_fetch_assoc($result))				
    {									  
        echo "<tr>";							  
            echo "<td>{$row['ord_id']}</td>";
            echo "<td>{$row['cust_id']}</td>";				  	
            echo "<td>{$row['cust_name']}</td>";	
            echo "<td>{$row['ord_startdate']}</td>";
            echo "<td>{$row['ord_duedate']}</td>";
            echo "<td>{$row['ord_stat']}</td>";	
            echo "<td>{$row['ord_type']}</td>";	
        echo "</tr>";							
    }									 
    echo "</table> ";							 
    
    // ปิดการเชื่อมต่อฐานข้อมูล
    mysqli_close($link);							
?>
