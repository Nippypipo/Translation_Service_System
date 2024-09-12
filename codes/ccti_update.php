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
	//สร้างตัวแปรรับค่าจากฟอร์มที่ส่งมา
	$Tname = $_POST["Tname"];
	$Ocommission = $_POST["Ocommission"];
    $duedate = $_POST["duedate"];
	$Ordno = $_GET["Ordno"];
	// เชื่อมต่อกับฐานข้อมูล
	$link = mysqli_connect("localhost", "root", "", "transcenter");
	//อัปเดตข้อมูลตารางออเดอร์ในฐานข้อมูล
	$sql = "UPDATE orders SET trans_id='$Tname', ord_commis='$Ocommission', ord_duedate='$duedate' WHERE ord_id ='$Ordno'";
	$result = mysqli_query($link, $sql);
	//กรณีอัปเดตสำเร็จ
	if ($result)
	{
		echo "การแก้ไขข้อมูลในฐานข้อมูลประสบความสำเร็จ<br>";
		echo "<p><p>";
		mysqli_close($link);
	}
	else
	{
	//กรณีอัปเดตล้มเหลว
		echo "ไม่สามารถแก้ไขข้อมูลในฐานข้อมูลได้<br>";
	}
?>
<!ปุ่มกลับไปหน้าหลัก>
<a href="ccti_updateload.php">กลับสู่หน้าหลัก</a>