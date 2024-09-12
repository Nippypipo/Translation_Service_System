USE transcenter;
DROP TRIGGER IF EXISTS calculate_ordservice_ordtotal;
CREATE TRIGGER calculate_ordservice_ordtotal
BEFORE UPDATE ON orders
FOR EACH ROW
BEGIN
    SET NEW.ord_service = NEW.ord_commis * 0.2;
    SET NEW.ord_total = NEW.ord_service + NEW.ord_commis;
    SET NEW.ord_stat = 'กำลังดำเนินงาน';
    SET NEW.ord_startdate = CURDATE();
END;

--สร้าง trigger เพื่อคำนวณค่าบริการศูนย์การแปล และราคาสุทธิที่ลูกค้าต้องจ่าย อัปเดตสถานะการแปล และอัปเดตวันที่มอบหมายงานนักแปล

 --บรรทัดที่ 7 ค่าบริการศูนย์การแปลคิดจาก 20% ของค่าแปล
 --บรรทัดที่ 8 ราคาสุทธิที่ลูกค้าต้องจ่ายคิดจาก ค่าแปล + ค่าบริการศูนย์การแปล
 --บรรทัดที่ 9 อัปเดตสถานะการแปลจาก 'รอมอบหมายงาน' เป็น 'กำลังดำเนินงาน' 
 --บรรทัดที่ 10 อัปเดตวันที่มอบหมายงานนักแปลเป็นวันที่มอบหมายงาน
