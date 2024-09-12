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
if(empty($_POST["send"])) {
?>
<!สร้าง html ฟอร์มเพื่อรับข้อมูล>
<form action="ccti_insert.php" method="POST">
	<!เพิ่มนักแปล>
		<p>
		<h4>เพิ่มนักแปล</h4>
		<p>
		รหัสนักแปล <input type="text" name="trans_id" maxlength="4" pattern="T\d{3}" placeholder="ตัวอย่าง T001"><p>
	<?php
		//สร้าง dropdown สำหรับคอลัมน์ trans_gender
		//เชื่อมต่อฐานข้อมูล
		$link = mysqli_connect("localhost", "root", "", "TransCenter");
		//สร้าง query เพื่อดึงข้อมูลจากตาราง translator
		$query = "select * from translators;";
		$result = mysqli_query($link, $query);
		echo "เพศกำเนิด <select name=trans_gender>";
		$addedValues = array();
		//วนลูบเอาค่าเพศกำเนิดจากในคอลัมน์
		while ($dbarr = mysqli_fetch_array($result)) 
		{
			$transGender = $dbarr['trans_gender'];
			//ดูว่ามีช้อยส์ที่ซ้ำหรือยัง
			if (!in_array($transGender, $addedValues)) {
				echo "<option value='$transGender'>$transGender</option>";
				$addedValues[] = $transGender; //เพิ่มตัวที่ยังไม่มีเข้าไปใน dropdown
			}
		}
		echo "</select> <p>";
	?>
		ชื่อ <input type="text" name="trans_name" maxlength="20"><p>
		นามสกุล <input type="text" name="trans_lastname" maxlength="30"><p>
		วันที่เริ่มงาน <input type="date" name="trans_startdate"><p>
		อีเมล์ <input type="text" name="trans_email" maxlength="50"><p>
		เบอร์โทรศัพท์ <input type="text" name="trans_phone" maxlength="15"><p>
		ที่อยู่ <input type="text" name="trans_address" maxlength="100">

		<p>ภาษาที่สามารถแปลได้ <br>
        <select name="lang1">
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
    <p>
		<select name="lang2">
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
        
    

		<!ปุ่มส่งฟอร์ม>
		<input type="submit" name="send" value="Submit">
		<!ปุ่นรีเซ็ตฟอร์ม>
		<input type="reset" name="cancel" value="Reset">
</form>
<?php
}
	else { //เก็บค่าที่ส่งมาจากแบบฟอร์มข้างบนไปใส่ในตัวแปรต่าง ๆ
		$trans_id = $_POST["trans_id"];
		$trans_gender = $_POST["trans_gender"];
		$trans_name = $_POST["trans_name"];
		$trans_lastname = $_POST["trans_lastname"];
		$trans_startdate = $_POST["trans_startdate"];
		$trans_email = $_POST["trans_email"];
		$trans_phone = $_POST["trans_phone"];
		$trans_address = $_POST["trans_address"];
		$lang1 = $_POST["lang1"];
		$lang2 = $_POST["lang2"];

		$link = mysqli_connect("localhost", "root", "", "TransCenter");

		//query สำหรับตรวจสอบว่า trans_id ที่กรอกไป มีใน translator table แล้วหรือยัง
		$checkQuery = "SELECT * FROM translators WHERE trans_id = '$trans_id'";
		$checkResult = mysqli_query($link, $checkQuery);


		//กรณีที่มี trans_id นั้นแล้ว
		if (mysqli_num_rows($checkResult) > 0) {
			echo "รหัสนักแปลนี้มีอยู่ในระบบแล้ว";
			echo "<br>";
			echo "<a href='ccti_insert.php'>กลับสู่หน้าหลัก</a>";
		} else {
			//กรณีที่ trans_id ไม่ซ้ำ จะเพิ่มข้อมูลที่ผู้ใช้กรอกลงในตาราง translator
			$sql1 = "INSERT INTO translators (trans_id, trans_gender, trans_name, trans_lastname, trans_startdate, trans_email, trans_phone, trans_address)
					VALUES('$trans_id', '$trans_gender','$trans_name', '$trans_lastname', '$trans_startdate', '$trans_email', '$trans_phone', '$trans_address');";
			

			$sql2 = "INSERT INTO languages (trans_id, ori_lang, trans_lang)
					VALUES ('$trans_id', '$lang1', '$lang2'),
							('$trans_id', '$lang2', '$lang1')";

			
			$result1 = mysqli_query($link, $sql1);
			$result2 = mysqli_query($link, $sql2);

			if ($result1 && $result2) 
			{	echo "การเพิ่มข้อมูลลงในฐานข้อมูลประสบความสำเร็จ<br>";
				echo "<br>";
				echo "<a href='ccti_insert.php'>กลับสู่หน้าหลัก</a>";
				mysqli_close($link);	}
			else	// กรณีที่ไม่สามารถเพิ่มข้อมูลได้
			{	echo "ไม่สามารถเพิ่มข้อมูลลงในฐานข้อมูลได้". mysqli_error($link) ."<br>";
				echo "<br>";
				echo "<a href='ccti_insert.php'>กลับสู่หน้าหลัก</a>";	
			}
		}
	}
?>
