DROP DATABASE IF EXISTS TransCenter;
CREATE DATABASE TransCenter;
USE TransCenter;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 21, 2023 at 07:12 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `transcenter`
--

-- --------------------------------------------------------

--
-- Table structure for table `customers`
--

CREATE TABLE `customers` (
  `cust_id` varchar(4) NOT NULL,
  `cust_name` varchar(20) DEFAULT NULL,
  `cust_lastname` varchar(30) DEFAULT NULL,
  `cust_tel` varchar(15) DEFAULT NULL,
  `cust_email` varchar(23) DEFAULT NULL,
  `cust_address` varchar(200) DEFAULT NULL,
  `cust_corp` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `customers`
--

INSERT INTO `customers` (`cust_id`, `cust_name`, `cust_lastname`, `cust_tel`, `cust_email`, `cust_address`, `cust_corp`) VALUES
('C001', 'ปิธา', 'ยิ้มเจริญ', '083-205-3131', 'pichaya_2@gmail.com', '8/96 ถนนลาดพร้าว กรุงเทพ 10900', ''),
('C002', 'สุดารักษ์', 'อิ่มท้อง', '091-023-2545', 'sudaruk@gmail.com', '11/74 ถนนมิตรภาพ เขตสายไหม แขวงสายแล้ว 10220', 'พรรคนี้เหนื่อย'),
('C003', 'ศิริ', 'แสนสุข', '091-987-6543', 'sirisanskul@gmail.com', '456 หมู่บ้านสวนผัก เขตสายไหม กรุงเทพฯ 10220', 'โรงเรียน XYZ'),
('C004', 'ประภา', 'จันทร์โอวา', '098-765-4321', 'prapaporn@gmail.com', '789 ถนนติวานนท์ เขตบางเขน กรุงเทพฯ 10210', 'บริษัท XYZ'),
('C005', 'โดนอลด์', 'ดรังค์', '064-322-4848', 'donaldsocool@gmail.com', '999/99 ซอยวิทยุ แขวงสามเสนใน เขตพญาไท กรุงเทพฯ 10400', 'บริษัทบิสบี้ จำกัด'),
('C006', 'โจใจเด็ด', 'อาร์มสตรอง', '063-874-4525', 'armverystrong@gmail.com', '555/5 หมู่ 1 ต.สุเทพ อ.เมือง จ.เชียงใหม่ 50200', ''),
('C007', 'พรรนิดา', 'ก้าวใกล้', '094-775-2133', '1000_nida@gmail.com', '99/4 หมู่ 3 ต.บึงสนั่น อ.เมือง จ.เชียงใหม่ 50100', '');

-- --------------------------------------------------------

--
-- Table structure for table `deleted_orders`
--

CREATE TABLE `deleted_orders` (
  `ord_id` int(5) NOT NULL,
  `cust_id` varchar(4) NOT NULL,
  `trans_id` varchar(4) DEFAULT NULL,
  `ord_stat` varchar(14) DEFAULT NULL,
  `ord_total` int(7) DEFAULT NULL,
  `ord_commis` int(7) DEFAULT NULL,
  `ord_service` int(7) DEFAULT NULL,
  `ord_startdate` date DEFAULT NULL,
  `ord_duedate` date DEFAULT NULL,
  `trans_lang` varchar(20) DEFAULT NULL,
  `ori_lang` varchar(20) DEFAULT NULL,
  `ord_file` varchar(50) DEFAULT NULL,
  `ord_type` varchar(20) DEFAULT NULL,
  `ord_note` varchar(100) DEFAULT NULL,
  `tax_invoice` varchar(3) DEFAULT NULL,
  `submit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE `languages` (
  `trans_id` varchar(4) NOT NULL,
  `ori_lang` varchar(20) NOT NULL,
  `trans_lang` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;




--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`trans_id`, `ori_lang`, `trans_lang`) VALUES
('T001', 'อังกฤษ', 'ไทย'),
('T001', 'ไทย', 'อังกฤษ'),
('T002', 'ญี่ปุ่น', 'ไทย'),
('T002', 'อังกฤษ', 'ไทย'),
('T002', 'เกาหลี', 'ไทย'),
('T002', 'ไทย', 'ญี่ปุ่น'),
('T002', 'ไทย', 'อังกฤษ'),
('T002', 'ไทย', 'เกาหลี'),
('T003', 'ญี่ปุ่น', 'ไทย'),
('T003', 'อังกฤษ', 'ไทย'),
('T003', 'เกาหลี', 'ไทย'),
('T003', 'ไทย', 'ญี่ปุ่น'),
('T003', 'ไทย', 'อังกฤษ'),
('T003', 'ไทย', 'เกาหลี'),
('T004', 'จีน', 'ไทย'),
('T004', 'อังกฤษ', 'ไทย'),
('T004', 'ไทย', 'จีน'),
('T004', 'ไทย', 'อังกฤษ'),
('T005', 'ฝรั่งเศส', 'ไทย'),
('T005', 'ไทย', 'ฝรั่งเศส'),
('T006', 'สเปน', 'ไทย'),
('T006', 'ไทย', 'สเปน'),
('T007', 'มาเลย์', 'ไทย'),
('T007', 'ละติน', 'ไทย'),
('T007', 'อารบิค', 'ไทย'),
('T007', 'อิตาเลียน', 'ไทย'),
('T007', 'เขมร', 'ไทย'),
('T007', 'เยอรมัน', 'ไทย'),
('T007', 'เวียดนาม', 'ไทย'),
('T007', 'โปรตุเกส', 'ไทย');



-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `ord_id` int(5) NOT NULL,
  `cust_id` varchar(4) NOT NULL,
  `trans_id` varchar(4) DEFAULT NULL,
  `ord_stat` varchar(14) DEFAULT NULL,
  `ord_total` int(7) DEFAULT NULL,
  `ord_commis` int(7) DEFAULT NULL,
  `ord_service` int(7) DEFAULT NULL,
  `ord_startdate` date DEFAULT NULL,
  `ord_duedate` date DEFAULT NULL,
  `trans_lang` varchar(20) DEFAULT NULL,
  `ori_lang` varchar(20) DEFAULT NULL,
  `ord_file` varchar(50) DEFAULT NULL,
  `ord_type` varchar(20) DEFAULT NULL,
  `ord_note` varchar(100) DEFAULT NULL,
  `tax_invoice` varchar(3) DEFAULT NULL,
  `submit_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`ord_id`, `cust_id`, `trans_id`, `ord_stat`, `ord_total`, `ord_commis`, `ord_service`, `ord_startdate`, `ord_duedate`, `trans_lang`, `ori_lang`, `ord_file`, `ord_type`, `ord_note`, `tax_invoice`, `submit_date`) VALUES
(20001, 'C001', 'T007', 'กำลังดำเนินงาน', 6000, 5000, 1000, '2021-01-14', '2021-01-28', 'เยอรมัน', 'ไทย', 'globalization_doc.pdf', 'เอกสารทั่วไป', '-', 'ใช่', '2021-01-11'),
(20002, 'C002', 'T001', 'เสร็จสมบูรณ์', 18000, 15000, 3000, '2021-01-14', '2021-01-22', 'ไทย', 'อังกฤษ', 'certificate.pdf', 'เอกสารราชการ', 'จัดส่งให้หน่อยค่ะ', 'ไม่', '2021-01-13'),
(20003, 'C003', 'T006', 'กำลังดำเนินงาน', 6600, 5500, 1100, '2021-01-22', '2021-01-07', 'สเปน', 'ไทย', 'transcript.pdf', 'เอกสารเฉพาะด้าน', 'ต้องการขอส่งผ่านไลน์', 'ไม่', '2021-01-20'),
(20004, 'C004', 'T001', 'เสร็จสมบูรณ์', 36000, 30000, 6000, '2021-02-01', '2021-01-07', 'อังกฤษ', 'ไทย', 'contract.pdf', 'เอกสารเฉพาะด้าน', 'ต้องการงานด่วน', 'ใช่', '2021-01-01'),
(20005, 'C004', 'T006', 'กำลังดำเนินงาน', 42000, 35000, 7000, '2021-02-04', '2021-02-25', 'สเปน', 'ไทย', 'products_info.docx', 'เอกสารทั่วไป', '-', 'ไม่', '2021-02-02'),
(20006, 'C001', 'T007', 'กำลังดำเนินงาน', 7800, 6500, 1300, '2021-02-10', '2021-02-27', 'อิตาเลียน', 'ไทย', 'instruction.pdf', 'เอกสารทั่วไป', '-', 'ใช่', '2021-02-09'),
(20007, 'C001', 'T006', 'กำลังดำเนินงาน', 2400, 2000, 400, '2021-02-10', '2021-02-20', 'สเปน', 'ไทย', 'document.pdf', 'เอกสารราชการ', 'รบกวนจัดส่งให้หน่อยค่ะ', 'ไม่', '2021-02-10'),
(20008, 'C005', 'T006', 'เสร็จสมบูรณ์', 2160, 1800, 360, '2021-02-10', '2021-02-22', 'ไทย', 'สเปน', 'hospital_invoice.jpg', 'เอกสารทั่วไป', '-', 'ไม่', '2021-02-10'),
(20009, 'C006', 'T001', 'กำลังดำเนินงาน', 8400, 7000, 1400, '2021-02-15', '2021-02-28', 'อังกฤษ', 'ไทย', 'medical_cert.jpeg', 'เอกสารทั่วไป', '-', 'ไม่', '2021-02-14'),
(20010, 'C007', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'ไทย', 'เกาหลี', 'products_inf.pdf', 'เอกสารทั่วไป', '-', 'ไม่', '2021-02-01'),
(20011, 'C005', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'สเปน', 'ไทย', 'menu.pdf', 'เอกสารทั่วไป', '-', 'ไม่', '2021-02-17'),
(20012, 'C006', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'สเปน', 'ไทย', 'marketing_presentation.pptx', 'เอกสารทั่วไป', '-', 'ใช่', '2021-02-19'),
(20013, 'C002', 'T001', 'กำลังดำเนินงาน', 15000, 12500, 2500, '2021-03-02', '2021-03-18', 'ไทย', 'อังกฤษ', 'contract.doc', 'เอกสารทั่วไป', '-', 'ไม่', '2021-02-28'),
(20014, 'C003', 'T003', 'กำลังดำเนินงาน', 7000, 6000, 1000, '2021-03-05', '2021-03-12', 'เกาหลี', 'ไทย', 'novel.docx', 'วรรณกรรม', '-', 'ไม่', '2021-03-03'),
(20015, 'C005', 'T006', 'เสร็จสมบูรณ์', 4500, 3750, 750, '2021-03-12', '2021-03-19', 'สเปน', 'ไทย', 'user_manual.pdf', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-03-10'),
(20016, 'C001', 'T007', 'เสร็จสมบูรณ์', 9000, 7500, 1500, '2021-03-18', '2021-03-26', 'อารบิค', 'ไทย', 'website_content.docx', 'เอกสารเฉพาะด้าน', '-', 'ไม่', '2021-03-15'),
(20021, 'C001', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'สเปน', 'ไทย', 'manual.pdf', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-04-15'),
(20022, 'C004', 'T002', 'เสร็จสมบูรณ์', 4000, 3500, 500, '2021-04-22', '2021-04-30', 'ไทย', 'ญี่ปุ่น', 'presentation.pptx', 'เอกสารทั่วไป', '-', 'ไม่', '2021-04-20'),
(20023, 'C005', 'T003', 'กำลังดำเนินงาน', 5500, 4500, 1000, '2021-05-01', '2021-05-10', 'เกาหลี', 'ไทย', 'newsletter.docx', 'เอกสารทั่วไป', '-', 'ใช่', '2021-04-28'),
(20024, 'C006', 'T007', 'กำลังดำเนินงาน', 9500, 8500, 1000, '2021-05-05', '2021-05-15', 'อารบิก', 'ไทย', 'proposal.doc', 'เอกสารเฉพาะด้าน', '-', 'ไม่', '2021-05-03'),
(20025, 'C002', 'T006', 'เสร็จสมบูรณ์', 5200, 4500, 700, '2021-05-10', '2021-05-20', 'สเปน', 'ไทย', 'survey_results.xlsx', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-05-08'),
(20026, 'C003', 'T003', 'กำลังดำเนินงาน', 6700, 6000, 700, '2021-05-15', '2021-05-25', 'อังกฤษ', 'ไทย', 'manual.pdf', 'เอกสารทั่วไป', '-', 'ใช่', '2021-05-12'),
(20027, 'C005', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'เกาหลี', 'ไทย', 'blog_post.docx', 'วรรณกรรม', '-', 'ไม่', '2021-05-18'),
(20028, 'C001', 'T003', 'กำลังดำเนินงาน', 7500, 6500, 1000, '2021-05-25', '2021-06-05', 'ไทย', 'ญี่ปุ่น', 'presentation.pptx', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-05-23'),
(20029, 'C006', 'T004', 'กำลังดำเนินงาน', 5900, 5000, 900, '2021-06-05', '2021-06-15', 'อังกฤษ', 'ไทย', 'proposal.docx', 'เอกสารทั่วไป', '-', 'ไม่', '2021-06-03'),
(20030, 'C002', 'T004', 'เสร็จสมบูรณ์', 4700, 4000, 700, '2021-06-10', '2021-06-20', 'ไทย', 'อังกฤษ', 'report.doc', 'เอกสารทั่วไป', '-', 'ใช่', '2021-06-08'),
(20031, 'C003', 'T006', 'เสร็จสมบูรณ์', 6900, 6000, 900, '2021-06-15', '2021-06-25', 'สเปน', 'ไทย', 'manual.pdf', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-06-13'),
(20032, 'C005', 'T007', 'กำลังดำเนินงาน', 4100, 3500, 600, '2021-06-20', '2021-06-30', 'อารบิก', 'ไทย', 'blog_post.docx', 'วรรณกรรม', '-', 'ไม่', '2021-06-18'),
(20033, 'C004', 'T002', 'กำลังดำเนินงาน', 3000, 2500, 500, '2021-04-18', '2021-04-30', 'ญี่ปุ่น', 'ไทย', 'report.docx', 'เอกสารทั่วไป', '-', 'ใช่', '2021-04-16'),
(20034, 'C002', 'T004', 'เสร็จสมบูรณ์', 8000, 6500, 1500, '2021-04-22', '2021-05-05', 'ไทย', 'อังกฤษ', 'presentation.ppt', 'เอกสารทั่วไป', '-', 'ใช่', '2021-04-20'),
(20035, 'C005', 'T006', 'กำลังดำเนินงาน', 6000, 5000, 1000, '2021-04-26', '2021-05-10', 'สเปน', 'ไทย', 'manual.pdf', 'เอกสารเฉพาะด้าน', '-', 'ไม่', '2021-04-24'),
(20036, 'C001', 'T007', 'กำลังดำเนินงาน', 4000, 3500, 500, '2021-04-30', '2021-05-12', 'อารบิก', 'ไทย', 'proposal.docx', 'เอกสารทั่วไป', '-', 'ไม่', '2021-04-28'),
(20037, 'C006', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'สเปน', 'ไทย', 'contract.pdf', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-05-02'),
(20038, 'C003', 'T002', 'กำลังดำเนินงาน', 5500, 4500, 1000, '2021-05-08', '2021-05-20', 'เกาหลี', 'ไทย', 'article.docx', 'วรรณกรรม', '-', 'ไม่', '2021-05-06'),
(20039, 'C006', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'สเปน', 'ไทย', 'user_guide.pdf', 'เอกสารเฉพาะด้าน', '-', 'ใช่', '2021-05-10'),
(20040, 'C004', 'T002', 'กำลังดำเนินงาน', 3500, 3000, 500, '2021-05-16', '2021-05-28', 'ญี่ปุ่น', 'ไทย', 'manual.docx', 'เอกสารทั่วไป', '-', 'ไม่', '2021-05-14'),
(20041, 'C005', '', 'รอมอบหมายงาน', 0, 0, 0, '0000-00-00', '0000-00-00', 'สเปน', 'ไทย', 'contract.pdf', 'เอกสารทางกฏหมาย', '-', 'ใช่', '2021-05-18');

-- --------------------------------------------------------

--
-- Table structure for table `tax_document`
--

CREATE TABLE `tax_document` (
  `ord_id` int(5) NOT NULL,
  `tax_name` varchar(24) DEFAULT NULL,
  `tax_address` varchar(200) DEFAULT NULL,
  `new_tax_address` varchar(200) DEFAULT NULL,
  `tax_id` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tax_document`
--

INSERT INTO `tax_document` (`ord_id`, `tax_name`, `tax_address`, `new_tax_address`, `tax_id`) VALUES
(20006, 'บริษัท อิเล็กนิกส์ จำกัด', 'ที่อยู่ใหม่', 'บริษัท อิเล็กนิกส์ จำกัด อาคารอีเลคโทรลักซ์ ชั้น 19 1910 ถนนเพชรบุรีตัดใหม่ บางกะปิ ห้วยขวาง กรุงเทพฯ 10310', '0042557221'),
(20001, 'ปิธา ยิ้มเจริญ', 'ที่อยู่เดียวกับข้างบน', '-', '0105884356984'),
(20012, 'โจใจเด็ด', '555/5 หมู่ 1 ต.สุเทพ อ.เมือง จ', '-', '0123456789123'),
(20004, 'พัชนี จันทร์โอชา', 'ที่อยู่ใหม่', '10/88 ถนนมณีนพรัตน์ ตำบลศรีภูมิ อำเภอเมือง จังหวัดเชียงใหม่ 50100', '0234561587495'),
(20034, 'สำนักงานทนายความ', '555/5 ถนนเพชรบุรีตัดใหม่ แขวงร', '-', '0345678912345'),
(20041, 'บริษัท รับปรึกษา จำกัด', '789/10 ถนนรัชดาภิเษก แขวงห้วยข', '-', '0567890123456'),
(20026, 'สมชาย ยอดจะเทิน', '567/8 ถนนพระราม แขวงสุริยวงศ์ ', '-', '0654321987654'),
(20031, 'สมชาย ยอดจะเทิน', '567/8 ถนนพระราม แขวงสุริยวงศ์ ', '-', '0654321987654'),
(20037, 'บริษัท ทดสอบ จำกัด', '999/99 หมู่ที่ 5 ตำบลแม่ครึม อ', '-', '0654321987654'),
(20015, 'โดนอลด์ ดรังค์', '999/99 ซอยวิทยุ แขวงสามเสนใน เ', '-', '0765432198726'),
(20021, 'เจมส์ แดวิส', '789/10 ถนนสุขุมวิท แขวงคลองเตย', '-', '0765432198726'),
(20025, 'นิตยา สุขใจ', '234/5 ถนนวิทยุ แขวงห้วยขวาง เข', '-', '0765432198726'),
(20030, 'อรอนงค์ แสงดาว', '789/4 ถนนสุขุมวิท แขวงคลองเตย ', '-', '0876543210987'),
(20023, 'เคท แอนด์รีวิว', '345/6 ซอยเพชรบุรีตัดใหม่ แขวงร', '-', '0987654321098'),
(20028, 'เอเลี่ยน ซุปเปอร์สตาร์', '321/10 หมู่ 3 ต.สันทราย อ.เมือ', '-', '0987654321098'),
(20033, 'บริษัท ออนไลน์ จำกัด', '123/45 ถนนสุขุมวิท แขวงคลองตัน', '-', '0987654321123'),
(20039, 'บริษัท ออนไลน์ จำกัด', '123/45 ถนนสุขุมวิท แขวงคลองตัน', '-', '0987654321123');

-- --------------------------------------------------------

--
-- Table structure for table `translators`
--

CREATE TABLE `translators` (
  `trans_id` varchar(4) NOT NULL,
  `trans_gender` varchar(10) DEFAULT NULL,
  `trans_name` varchar(20) DEFAULT NULL,
  `trans_lastname` varchar(30) DEFAULT NULL,
  `trans_startdate` date DEFAULT NULL,
  `trans_email` varchar(50) DEFAULT NULL,
  `trans_phone` varchar(15) DEFAULT NULL,
  `trans_address` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `translators`
--

INSERT INTO `translators` (`trans_id`, `trans_gender`, `trans_name`, `trans_lastname`, `trans_startdate`, `trans_email`, `trans_phone`, `trans_address`) VALUES
('T001', 'ชาย', 'ธันวานี', 'ยิ้มแย้ม', '1965-01-20', 'tanyamile@gmail.com', '123-456-7890', '123 ถนนสุขุมวิท แขวงคลองตัน เขตคลองเตย กรุงเทพฯ'),
('T002', 'หญิง', 'นันทิชา', 'คุคิ', '1964-05-11', 'nathicha.k@gmail.com', '234-567-8901', '456 หมู่บ้านวิลล่า ซอยบางนา-ตราด แขวงบางนา เขตบางนา กรุงเทพฯ'),
('T003', 'ชาย', 'นิปัน', 'อุดมสุข', '1964-04-01', 'nipun.udomsuk@gmail.com', '345-678-9012', '789 ถนนพหลโยธิน แขวงลาดยาว เขตจตุจักร กรุงเทพฯ'),
('T004', 'หญิง', 'ชาวี่', 'จันทร์เพ็ชร', '1962-05-15', 'chavvijeans@gmail.com', '456-789-0123', '012 หมู่บ้านรัชดา-ห้วยขวาง ซอยรัชดาภิเษก แขวงห้วยขวาง เขตห้วยขวาง กรุงเทพฯ'),
('T005', 'ชาย', 'นิชาพัทธ์', 'รักษ์บำรุง', '1965-11-30', 'nichapat.rakbamrung@gmail.com', '567-890-1234', '345 ถนนเลียบคลองสาน แขวงคลองต้นไทร เขตคลองสาน กรุงเทพฯ'),
('T006', 'ชาย', 'ธีรพงษ์', 'ชูทอง', '1961-07-02', 'teerapong.chutong@gmail.com', '678-901-2345', '567 ถนนรัชดาภิเษก แขวงห้วยขวาง เขตห้วยขวาง กรุงเทพฯ'),
('T007', 'ชาย', 'ปิยพุทธ', 'บริหารเสน่ห์', '1960-11-01', 'piyaput.borihansenneh@gmail.com', '789-012-3456', '678 ถนนบางนา-ตราด แขวงบางนา เขตบางนา กรุงเทพฯ');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customers`
--
ALTER TABLE `customers`
  ADD PRIMARY KEY (`cust_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`trans_id`,`ori_lang`,`trans_lang`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ord_id`,`cust_id`);

--
-- Indexes for table `tax_document`
--
ALTER TABLE `tax_document`
  ADD PRIMARY KEY (`tax_id`,`ord_id`);

--
-- Indexes for table `translators`
--
ALTER TABLE `translators`
  ADD PRIMARY KEY (`trans_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

