-- phpMyAdmin SQL Dump
-- version 4.6.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 30, 2016 at 08:25 AM
-- Server version: 5.7.13-log
-- PHP Version: 5.6.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `client_info`
--

-- --------------------------------------------------------

--
-- Table structure for table `customer_db`
--

CREATE TABLE `customer_db` (
  `customer_id` bigint(20) UNSIGNED NOT NULL COMMENT '客戶編號',
  `s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '流水號',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司名稱',
  `nickname` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司簡稱',
  `location` int(7) DEFAULT NULL COMMENT '所處地點',
  `ubn` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '統一編號',
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '聯絡人',
  `contact_phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '聯絡人電話',
  `company_phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司電話',
  `company_fax` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司傳真',
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司地址',
  `email` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司信箱',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_db`
--

INSERT INTO `customer_db` (`customer_id`, `s_id`, `name`, `nickname`, `location`, `ubn`, `contact`, `contact_phone`, `company_phone`, `company_fax`, `address`, `email`, `invalid`) VALUES
(1, 'CTWTPE001', '李家睿國際律師事務所', '飯飯', 1, '19890412', '飯飯伊老杯', '02-2882-5252', '02-2393-9889', '02-2345-6789', '臺北市信義區市府路1號', 'qwe123@gmail.com', 0),
(2, 'CTWTYN001', '康威電競娛樂股份有限公司', '宅宅', 4, '19890928', '流口水', '03-332-7106', '03-332-2404', '03-332-5368', '桃園市中壢區元化路165巷50號', 'asdf4567@gmail.com', 0),
(3, 'CTWTYN002', '美商蘋果授權偉安資訊經銷商', '蘋偉公道價八萬一', 4, '19890417', '田心Daddy', '02-6601-3456', '02-2910-6880', '0809-013-666', '台北市內湖區行愛路141巷38號', 'zxcvb89012@gmail.com', 0),
(4, 'CCNSGH001', '統一育樂事業股份有限公司', '統一育樂', 22, '295139', '李東陽', NULL, NULL, NULL, '基隆市中正區中正路164之17號', NULL, 0),
(6, 'CTWTYN004', '桃園農產運銷股份有限公司', '桃園農產', 4, '16944357', '許秀謙', '02-412-1111', NULL, NULL, '桃園市大園區南港里許厝港102號', NULL, 0),
(7, 'CTWTYN005', '桃園航勤股份有限公司', '桃園航勤', 4, '20806736', '張建隆', '02-2396-1266', NULL, NULL, '桃園市大園區埔心里16鄰航勤北路15號', 'asdwbe@yahoo.com.tw', 0),
(8, 'CTWKEL002', '台北美上美股份有限公司', '美上', 3, '69149', '森部一夫', NULL, NULL, '10-5905-7730', '基隆市信義區培德路73號', NULL, 0),
(9, 'CTWTYN006', '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的股份有限公司', '測試用故意用超長', 4, '1234567890', '測試用故意用超長名字的測試用故意用超長名', '03-5431-5431', '03-5431-5431', '03-5431-5431', '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的地址就是OP', '測試用故意用超長名字的@測試用故意用超長名字的.測試用故意用超長名字的', 0),
(10, 'CTWNTC001', '故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 ', '留空白 做為測試', 2, '1234 5678', '故意留空白 做為測試使用 ', '02 3456 7890', '03 456 7890', '04 567 8901', '故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 ', '故意留空白 做為測試使用 故意留空白 做為測試使用 ', 0),
(32, 'C001', 'tncads', 'tnctnc', 0, '23978959', '蔡秉霖', '0963550895', '034639688', '963550895', '桃園市中壢區大華路188巷17弄22號', 'eric610446@gmail.com', 0),
(33, 'CTWPHU003', 'tnc1', '1', 15, '2', '7', '8', '3', '4', '77777asdfasdf', '5', 1),
(34, 'CTWHSZ003', 'tnc2', '111', 5, '2', '777', '88', '3', '4', '6', '5', 1),
(35, 'CTWTXG003', 'tnc3333', '11', 7, '22', '77', '88', '33', '44', '8888888', '55', 0),
(36, 'CTWTYN012', 'test', '111', 4, '222', '777', '888', '333', '444', '666', '555', 0),
(37, 'CTWTYN011', 'test3', '1', 4, '2', '7', '8', '3', '4', '6', '5', 0),
(38, 'CTWTPE002', 'test4', 'a', 1, 's', 'j', 'k', 'd', 'f', 'h', 'g', 0),
(39, 'CTWTXG001', 'tnc6', '1', 7, '2', '7', '8', '3', '4', '6', '5', 0),
(40, 'CTWTNN001', 'tnc1', '1', 12, '2', '7', '8', '3', '4', '6', '5', 1),
(41, 'CTWNTC002', 'tnc1', '1', 2, '2', '8', '65', '3', '4', '77777asdfasdf', '56', 1),
(42, 'CTWKEL005', 'tnc1', '111', 3, '222', '666', '777', '333', '444', '555', '888', 1),
(43, 'CTWTXG004', 'tnc10', 'asdf', 7, 'asdf', 'asdf', 'adf', 'adf', 'adf', 'asdf', 'asdf', 0),
(44, 'CTWKEL006', 'tnc1', 'qq', 3, 'ww', 'yy', 'uu', 'ee', 'rr', 'tt', 'ii', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item_db`
--

CREATE TABLE `item_db` (
  `item_id` bigint(20) UNSIGNED NOT NULL COMMENT '物品編號',
  `s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '流水號',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物品名稱',
  `supplier_id` int(9) DEFAULT NULL COMMENT '供應商編號',
  `price` int(9) NOT NULL DEFAULT '0' COMMENT '建議售價',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NTD' COMMENT '幣值',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `item_db`
--

INSERT INTO `item_db` (`item_id`, `s_id`, `name`, `supplier_id`, `price`, `currency`, `invalid`) VALUES
(1, 'P001', 'PS4 薄型台灣專用機（500GB）', 1, 9980, 'NTD', 0),
(2, 'P002', 'PS4 薄型台灣專用機（1TB）', 3, 10980, 'NTD', 0),
(3, 'M001', 'HORI PS4 AIR ULTIMATE 有線耳機麥克風', 1, 3190, 'NTD', 0),
(4, 'M002', 'PS4 DUALSHOCK 4 新款無線控制器', 4, 1780, 'NTD', 0),
(5, 'O001', 'PlayStation VR 頭戴裝置', 2, 12980, 'NTD', 0),
(6, 'P003', '《戰爭機器 4》Xbox One 台灣專用機同梱組', 3, 9980, 'NTD', 1),
(7, 'P004', '《最後一戰全集》Xbox One 台灣專用機同梱組', 5, 10980, 'NTD', 0),
(8, 'M003', 'Xbox One 特別版無線控制器（藍）', 1, 1690, 'NTD', 0),
(9, 'O002', '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的物品', 6, 1999999998, 'NTD', 0),
(10, 'O003', '故意留空白 做為測試使用 ', 7, 5000, 'NTD', 0),
(11, NULL, '帽子', 1, 1000, 'TWD', 0),
(12, NULL, '耳機', 4, 10000, 'TWD', 0),
(13, NULL, '筆電', 2, 40000, 'TWD', 0),
(14, '001', 'imac', 1, 40000, 'TWD', 0),
(15, 'P005', 'macbook pro', 2, 70000, 'TWD', 0),
(16, 'M004', 'apple 藍芽耳機', 4, 3000, 'TWD', 0),
(17, 'P006', 'OXE', 0, 999998, 'FRF', 0),
(18, 'P007', 'app', 0, 0, '', 0),
(19, 'P008', 'oxo', 2, 999988, 'TWD', 1),
(20, 'P009', 'oxo2', 13, 1000000, 'TWD', 0),
(21, 'P010', 'oxo', 2, 999988, 'TWD', 1),
(22, 'M005', 'app1', 3, 999111, 'TWD', 1),
(23, 'P012', 'app2', 2, 11111, 'TWD', 1),
(24, 'P013', 'app3', 1, 0, 'asd', 0),
(25, 'P014', 'app4', 1, 0, 'asd', 0),
(26, 'P015', 'app5', 1, 0, 'asf', 1),
(27, 'P016', 'app6', 1, 0, 'aa', 0),
(28, 'P017', 'app7', 1, 0, 'aa', 0),
(29, 'P018', 'app10', 2, 15000, 'TWD', 0),
(30, 'P019', 'app9', 1, 0, 'saf', 0),
(31, 'P020', 'app8', 3, 0, 'sad', 0),
(32, 'O004', 'app1', 18, 9999, 'TWD', 1),
(33, 'P021', 'app1', 19, 99999, 'TWD', 1),
(34, 'P022', 'app1', 19, 11111, 'TWD', 1),
(35, 'P023', 'app1', 19, 0, 'aa', 0);

-- --------------------------------------------------------

--
-- Table structure for table `location_db`
--

CREATE TABLE `location_db` (
  `location_id` bigint(20) UNSIGNED NOT NULL COMMENT '地點編號',
  `country` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '國家',
  `country_sid` varchar(2) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '國家(UN/LOCODE)',
  `city` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市',
  `city_sid` varchar(3) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '城市(UN/LOCODE)',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `location_db`
--

INSERT INTO `location_db` (`location_id`, `country`, `country_sid`, `city`, `city_sid`, `invalid`) VALUES
(1, '臺灣', 'TW', '臺北', 'TPE', 1),
(2, '台灣', 'TW', '新北', 'NTC', 0),
(3, '台灣', 'TW', '基隆', 'KEL', 0),
(4, '台灣', 'TW', '桃園', 'TYN', 0),
(5, '台灣', 'TW', '新竹', 'HSZ', 0),
(6, '台灣', 'TW', '苗栗', 'ZMI', 0),
(7, '台灣', 'TW', '台中', 'TXG', 0),
(8, '台灣', 'TW', '彰化', 'CHW', 0),
(9, '台灣', 'TW', '南投', 'NAN', 0),
(10, '台灣', 'TW', '雲林', 'YLN', 0),
(11, '台灣', 'TW', '嘉義', 'CYI', 0),
(12, '台灣', 'TW', '台南', 'TNN', 0),
(13, '台灣', 'TW', '高雄', 'KHH', 0),
(14, '台灣', 'TW', '屏東', 'PIF', 0),
(15, '台灣', 'TW', '澎湖', 'PHU', 0),
(16, '台灣', 'TW', '宜蘭', 'ILA', 0),
(17, '台灣', 'TW', '花蓮', 'HUN', 0),
(18, '台灣', 'TW', '台東', 'TTT', 0),
(19, '台灣', 'TW', '金門', 'KNH', 1),
(20, '台灣', 'TW', '馬祖', 'MFK', 0),
(21, '中國', 'CN', '北京', 'BJS', 0),
(22, '中國', 'CN', '上海', 'SGH', 0),
(23, '越南', 'VN', '胡志明', 'SGN', 0),
(24, 'Greenwood The Great', 'qw', 'Kingdom of Rhovanion', 'QWE', 0),
(25, '剛鐸', '25', '多爾安羅斯', '255', 0),
(26, '亞爾諾', '26', '雅西頓', '266', 0),
(27, '魔多', '27', '西力斯昂哥', '277', 0),
(28, '剛鐸', '25', '昂巴', '288', 0),
(29, '伊歐西歐德', '28', '洛汗', '288', 0),
(30, '矮人自治領土愛加拉隆', '29', '登丹人自治領土督伊頓森林', '299', 0),
(31, '澳大利亞', 'AU', '雪梨', 'SYD', 0),
(35, '美國', 'US', '紐約城', 'NYC', 0),
(36, 'ad', 'as', 'fdsad', 'asd', 0),
(37, 'ad', 'as', 'fdsad', 'asd', 0),
(38, 'aaaa', 'df', 'ssss', 'df', 1),
(39, 'aaaa', 'df', 'asss', 'df', 1),
(40, 'qw', 'er', 'qw', 'er', 0),
(41, 'er', 'qw', 'er', 'qwq', 0),
(42, '臺灣', 'TW', '臺北', 'TPE', 1),
(43, '臺灣', 'TW', '臺北', 'TPE', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_detail_db`
--

CREATE TABLE `quotation_detail_db` (
  `quo_item_id` bigint(20) UNSIGNED NOT NULL COMMENT '訂單物品編號',
  `quo_id` int(11) DEFAULT NULL COMMENT '訂單編號',
  `item_id` int(11) DEFAULT NULL COMMENT '物品編號',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '銷售數量',
  `price` int(11) NOT NULL DEFAULT '0' COMMENT '實際售價',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NTD' COMMENT '幣值',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢物品種類'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotation_detail_db`
--

INSERT INTO `quotation_detail_db` (`quo_item_id`, `quo_id`, `item_id`, `amount`, `price`, `currency`, `invalid`) VALUES
(1, 1, 3, 6, 2990, 'NTD', 0),
(2, 1, 4, 12, 1690, 'NTD', 0),
(3, 1, 5, 6, 12490, 'NTD', 0),
(4, 2, 2, 2, 10490, 'NTD', 0),
(5, 2, 4, 4, 1650, 'NTD', 0),
(6, 2, 6, 11, 9490, 'NTD', 0),
(7, 2, 8, 22, 1550, 'NTD', 0),
(8, 3, 3, 6, 2990, 'NTD', 0),
(9, 3, 4, 12, 1690, 'NTD', 0),
(10, 3, 5, 7, 12490, 'NTD', 0),
(11, 4, 4, 0, 1780, 'NTD', 0),
(12, 5, 4, 1, 1750, 'NTD', 0),
(13, 6, 4, 100000, 1650, 'NTD', 0),
(14, 7, 9, 1, 1999999998, 'NTD', 0),
(15, 8, 8, 10, 16500, 'NTD', 0),
(16, 9, 9, 1, 1999999998, 'NTD', 0),
(17, 10, 10, 1, 5000, 'NTD', 0),
(18, 10, 1, 1, 4000, 'NTD', 0);

-- --------------------------------------------------------

--
-- Table structure for table `quotation_simple_db`
--

CREATE TABLE `quotation_simple_db` (
  `quo_id` bigint(20) UNSIGNED NOT NULL COMMENT '訂單編號',
  `qu_s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '流水號',
  `po_s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL COMMENT '客戶編號',
  `date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '日期',
  `item_id` int(11) DEFAULT NULL COMMENT '重點採買的料號',
  `price` bigint(18) NOT NULL DEFAULT '0' COMMENT '訂單總額',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'NTD' COMMENT '幣值',
  `sales_tax` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否含稅',
  `is_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否為訂單',
  `date_y` int(11) DEFAULT NULL COMMENT '年份',
  `date_m` int(11) DEFAULT NULL COMMENT '月份',
  `date_qu_no` int(11) DEFAULT NULL COMMENT '月編號(報價單)',
  `date_po_no` int(11) DEFAULT NULL COMMENT '月編號(訂單)',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `quotation_simple_db`
--

INSERT INTO `quotation_simple_db` (`quo_id`, `qu_s_id`, `po_s_id`, `customer_id`, `date`, `item_id`, `price`, `currency`, `sales_tax`, `is_order`, `date_y`, `date_m`, `date_qu_no`, `date_po_no`, `invalid`) VALUES
(1, 'QU201610-00001', 'PO201610-00001', 2, '2016-10-07 10:38:20', 5, 113160, 'NTD', 0, 1, 2016, 10, 1, 1, 0),
(2, 'QU201610-00002', NULL, 1, '2016-10-11 15:24:39', 6, 166070, 'NTD', 1, 0, 2016, 10, 2, NULL, 0),
(3, 'QU201610-00003', NULL, 2, '2016-10-20 10:38:20', 5, 125650, 'NTD', 0, 0, 2016, 10, 3, NULL, 0),
(4, 'QU201610-00004\r\n', NULL, 4, '2016-10-16 10:18:46', 4, 0, 'NTD', 0, 0, 2016, 10, 4, NULL, 1),
(5, 'QU201610-00005', NULL, 4, '2016-10-16 10:20:38', 4, 1750, 'NTD', 1, 0, 2016, 10, 5, NULL, 0),
(6, 'QU201610-00006', NULL, 4, '2016-10-20 16:49:38', 4, 165000000, 'NTD', 1, 0, 2016, 10, 6, NULL, 0),
(7, 'QU201610-00007', 'PO201610-00002', 2, '2016-10-21 06:25:31', 9, 1999999998, 'NTD', 1, 1, 2016, 10, 7, 2, 0),
(8, 'QU201611-00001', NULL, 2, '2016-11-18 09:32:38', 8, 16500, 'NTD', 1, 0, 2016, 11, 1, NULL, 0),
(9, 'QU201611-00002', 'PO201611-00001', 2, '2016-11-19 16:17:05', 9, 1999999998, 'NTD', 1, 1, 2016, 11, 2, 1, 0),
(10, 'QU201611-00003', NULL, 10, '2016-11-22 00:00:00', 10, 14000, 'NTD', 1, 0, 2016, 11, 3, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `supplier_db`
--

CREATE TABLE `supplier_db` (
  `supplier_id` bigint(20) UNSIGNED NOT NULL COMMENT '供應商編號',
  `s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '流水號',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司名稱',
  `nickname` varchar(8) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司簡稱',
  `location` int(7) DEFAULT NULL COMMENT '所處地點',
  `ubn` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '統一編號',
  `contact` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '聯絡人',
  `contact_phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '聯絡人電話',
  `company_phone` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司電話',
  `company_fax` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司傳真',
  `address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司地址',
  `email` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '公司信箱',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `supplier_db`
--

INSERT INTO `supplier_db` (`supplier_id`, `s_id`, `name`, `nickname`, `location`, `ubn`, `contact`, `contact_phone`, `company_phone`, `company_fax`, `address`, `email`, `invalid`) VALUES
(1, 'SVNSGN001', '威誌株式會社', '諾克堤斯', 2, '19890115', '代表取締役社長伊格尼斯', '03-5292-8100', '06-6920-3600', '03-5771-0573', '東京都新宿区新宿6丁目27番30号 新宿イーストサイドスクエア', 'tadfgzcvx@gmail.com', 0),
(2, 'STWTYN004', '秉霖精品汽車旅館', 'B0 MOTEL', 4, '19920804', '林姿妏', '03-463-6666', '03-422-6322', '03-301-2626', '桃園市中壢區大華路122號', 'asdfwerwerq@gmail.com', 0),
(3, 'STWTYN001', '米果米寶幼兒園', '陳看護工', 4, '19820106', '林姊姊', '03-362-5468', '03-332-3351', '03-336-4093', '桃園區民權路六十七號', 'asdfa232f@gmail.com', 0),
(4, 'STWTPE001', '大台北噪音防治股份有限公司', '大台北噪音', 1, '1682616', '張興宗', '10-6453-2533', NULL, NULL, '臺北市大安區信義路3段106號3樓之7', NULL, 1),
(5, 'STWKHH001', '台北丸台運送股份有限公司', '丸台運送', 13, '3122301', '蘇信吉', '10-6453-2539', NULL, '10-6453-2539', '高雄市苓雅區凱旋一路43號2樓', NULL, 0),
(6, 'STWTPE002', '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的股份有限公司', '測試用故意用超長', 1, '123456789', '測試用故意用超長名字的', '03-4538-3366', NULL, NULL, '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的地址', '測試用故意用超長名字的@測試用故意用超長名字的.測試用故意用超長名字的', 0),
(7, 'STWTPE003', '故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 ', '留空白 做為測試', 1, '123 4567', '留空白 做為測試', '03 456 789', '03 458 798', '03 546 789', '留空白 做為測試留空白 做為測試留空白 做為測試留空白 做為測試', '留空白 做為測試留空白 做為測試留空白 做為測試留空白 做為測試', 0),
(11, 'STWTYN002', 'test1', '1', 4, '2', '7', '8', '3', '4', '6', '5', 0),
(12, 'STWTPE004', 'test2', '11', 1, '22', '77', '88', '33', '44', '66', '55', 0),
(13, 'STWTYN003', 'tnc', 's1', 4, 's2', 's7', 's8', 's3', 's4', 's6', 's5', 1),
(14, 'STWKHH002', 'tnc', '1', 13, '2', '8', '9', '3', '4', '7', '5', 1),
(15, 'STWCHW001', 'tnc', '1', 8, '2', '777', '888', '3', '4', '6', '5', 1),
(16, 'STWYLN003', 'tnc123', 'a', 10, 's', 'h', 'j', 'd', 'f', 'h', 'g', 0),
(17, 'STWTPE005', 'tnc1', 'aaa', 1, 'sss', 'hhh', 'jjj', 'ddd', 'fff', 'ggg', 'kkk', 1),
(18, 'STWTYN005', 'tnc1', '12344', 4, 'ww', 'yy', 'uu', 'ee', 'rr', 'tt', 'ii', 1),
(19, 'STWTYN006', 'tnc1', '11', 4, '22', '66', '77', '33', '44', '55', '88888', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tnc`
--

CREATE TABLE `tnc` (
  `total` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` text COLLATE utf8_unicode_ci,
  `product1` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count1` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price1` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product2` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count2` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price2` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product3` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count3` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price3` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product4` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count4` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price4` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product5` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count5` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price5` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product6` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count6` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price6` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product7` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count7` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price7` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product8` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count8` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price8` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product9` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count9` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price9` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product10` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `count10` char(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price10` char(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tnc`
--

INSERT INTO `tnc` (`total`, `date`, `product1`, `count1`, `price1`, `product2`, `count2`, `price2`, `product3`, `count3`, `price3`, `product4`, `count4`, `price4`, `product5`, `count5`, `price5`, `product6`, `count6`, `price6`, `product7`, `count7`, `price7`, `product8`, `count8`, `price8`, `product9`, `count9`, `price9`, `product10`, `count10`, `price10`) VALUES
('90000', '2016-12-12', 'mac', '1', '30000', 'mac', '2', '60000', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `customer_db`
--
ALTER TABLE `customer_db`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- Indexes for table `item_db`
--
ALTER TABLE `item_db`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id` (`item_id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- Indexes for table `location_db`
--
ALTER TABLE `location_db`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_id` (`location_id`);

--
-- Indexes for table `quotation_detail_db`
--
ALTER TABLE `quotation_detail_db`
  ADD PRIMARY KEY (`quo_item_id`),
  ADD UNIQUE KEY `quo_item_id` (`quo_item_id`);

--
-- Indexes for table `quotation_simple_db`
--
ALTER TABLE `quotation_simple_db`
  ADD PRIMARY KEY (`quo_id`),
  ADD UNIQUE KEY `quo_id` (`quo_id`),
  ADD UNIQUE KEY `s_id` (`qu_s_id`);

--
-- Indexes for table `supplier_db`
--
ALTER TABLE `supplier_db`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `customer_db`
--
ALTER TABLE `customer_db`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '客戶編號', AUTO_INCREMENT=45;
--
-- AUTO_INCREMENT for table `item_db`
--
ALTER TABLE `item_db`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '物品編號', AUTO_INCREMENT=36;
--
-- AUTO_INCREMENT for table `location_db`
--
ALTER TABLE `location_db`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '地點編號', AUTO_INCREMENT=44;
--
-- AUTO_INCREMENT for table `quotation_detail_db`
--
ALTER TABLE `quotation_detail_db`
  MODIFY `quo_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '訂單物品編號', AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `quotation_simple_db`
--
ALTER TABLE `quotation_simple_db`
  MODIFY `quo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `supplier_db`
--
ALTER TABLE `supplier_db`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '供應商編號', AUTO_INCREMENT=20;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
