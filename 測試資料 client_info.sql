-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2017-02-12 19:58:22
-- 伺服器版本: 5.7.15-log
-- PHP 版本： 5.6.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `client_info`
--

-- --------------------------------------------------------

--
-- 資料表結構 `company_db`
--

CREATE TABLE `company_db` (
  `company_id` bigint(20) UNSIGNED NOT NULL COMMENT '公司資料編號',
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
-- 資料表的匯出資料 `company_db`
--

INSERT INTO `company_db` (`company_id`, `name`, `nickname`, `location`, `ubn`, `contact`, `contact_phone`, `company_phone`, `company_fax`, `address`, `email`, `invalid`) VALUES
(0, '立旺鐵工廠', '立旺', 7, '08319015', '詹愛珠', '04-25276007', '04-25276007', '04-25200785', '臺中市神岡區豐洲里神洲路330巷33弄71號', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `customer_db`
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
-- 資料表的匯出資料 `customer_db`
--

INSERT INTO `customer_db` (`customer_id`, `s_id`, `name`, `nickname`, `location`, `ubn`, `contact`, `contact_phone`, `company_phone`, `company_fax`, `address`, `email`, `invalid`) VALUES
(1, 'CCNSGH001', '李家睿國際律師事務所', '飯飯', 22, '19890412', '飯飯伊老杯', '02-2882-5252', '02-2393-9889', '02-2345-6789', '上海市漕河涇開發區宜山路810號', 'qwe123@gmail.com', 0),
(2, 'CTWTYN001', '康威電競娛樂股份有限公司', '宅宅', 4, '19890928', '流口水', '03-332-7106', '03-332-2404', '03-332-5368', '桃園市桃園區復興路186號10樓', 'asdf4567@gmail.com', 0),
(3, 'CCNBJS001', '美商蘋果授權偉安資訊經銷商', '蘋偉公道價八萬一', 21, '19890417', '田心Daddy', '02-6601-3456', '02-2910-6880', '0809-013-666', '北京市西城區三里河東路八號', 'zxcvb89012@gmail.com', 0),
(4, 'CCNSGH002', '統一育樂事業股份有限公司', '統一育樂', 22, '295139', '李東陽', NULL, NULL, NULL, '上海市黃浦區西藏中路268 號來福士廣場3801 室－', NULL, 0),
(5, 'CGEDAR001', '金桃園科技有限公司', '金桃園', 25, '12994279', '姚甄蘋', NULL, '0800-078-777', NULL, '剛譯市中壢區光明里民權路338之13號14樓', NULL, 0),
(6, 'CRNYCT001', '桃園農產運銷股份有限公司', NULL, 26, '16944357', '許秀謙', '02-412-1111', NULL, NULL, '綠木市大園區南港里許厝港102號', NULL, 0),
(7, 'CTWTYN002', '桃園航勤股份有限公司', '桃園航勤', 4, '20806736', '張建隆', '02-2396-1266', NULL, NULL, '桃園市大園區埔心里16鄰航勤北路15號', 'asdwbe@yahoo.com.tw', 0),
(8, 'CTWKEL001', '台北美上美股份有限公司', '美上', 3, '69149', '森部一夫', NULL, NULL, '10-5905-7730', '基隆市信義區培德路73號', NULL, 0),
(9, 'CTWTXG001', '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的股份有限公司', '測試用故意用超長', 7, '1234567890', '測試用故意用超長名字的測試用故意用超長名', '03-5431-5431', '03-5431-5431', '03-5431-5431', '台中測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的地址就是OP', '測試用故意用超長名字的@測試用故意用超長名字的.測試用故意用超長名字的', 0),
(10, 'CTWNTC001', '故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 ', '留空白 做為測試', 2, '1234 5678', '故意留空白 做為測試使用 ', '02 3456 7890', '03 456 7890', '04 567 8901', '新北故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 ', '故意留空白 做為測試使用 故意留空白 做為測試使用 ', 0),
(11, 'CTWTPE002', '安麗台北體驗中心', '安麗', 1, '', '', '', '', '', '台北市敦化北路168號B1/B2樓', '', 0),
(12, 'CTWNTC002', '新北市政府經濟發展局', NULL, 2, '', '', '', '', '', '新北市板橋區中山路1段161號', '', 0),
(13, 'CTWKEL002', '臺灣港務港勤股份有限公司-基隆營運所', '', 3, '', '', '', '', '', '基隆市中山區和平里中山三路8號', '', 0),
(14, 'CTWTYN003', '葡眾企業股份有限公司', '', 4, '', '', '', '', '', '桃園市桃園區復興路186號10樓', '', 0),
(15, 'CTWHSZ001', '羅技電子股份有限公司', '', 5, '', '', '', '', '', '新竹市新竹科學園區研新四路2號', '', 0),
(16, 'CTWZMI001', '群聯電子股份有限公司', '', 6, '', '', '', '', '', '苗栗縣竹南鎮群義路1號', '', 0),
(17, 'CTWTXG002', '台銀人壽', '', 7, '', '', '', '', '', '臺中市北區太平路17號11樓', '', 0),
(18, 'CTWCHW001', '帝寶工業股份有限公司', '', 8, '', '', '', '', '', '彰化縣鹿港鎮頭南里南勢巷20之3號', '', 0),
(19, 'CTWNAN001', '義成工廠股份有限公司', '', 9, '', '', '', '', '', '南投縣南投市南崗工業區南崗三路103號', '', 0),
(20, 'CTWYLN001', '豐泰企業股份有限公司', '', 10, '', '', '', '', '', '雲林縣斗六市雲林科技工業區科工八路52號', '', 0),
(21, 'CTWTNN001', '台南企業股份有限公司', '', 12, '', '', '', '', '', '台南市歸仁區中山路三段320號', '', 0),
(26, 'CTWTTT001', '激流泛舟', '基流', 18, '', '', '', '', '', '', '', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `item_db`
--

CREATE TABLE `item_db` (
  `item_id` bigint(20) UNSIGNED NOT NULL COMMENT '物品編號',
  `s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '流水號',
  `name` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '物品名稱',
  `supplier_id` int(9) DEFAULT NULL COMMENT '供應商編號',
  `price` int(9) NOT NULL DEFAULT '0' COMMENT '建議售價',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TWD' COMMENT '幣值',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `item_db`
--

INSERT INTO `item_db` (`item_id`, `s_id`, `name`, `supplier_id`, `price`, `currency`, `invalid`) VALUES
(1, 'P001', 'LUXGEN S3 撼動版', 1, 679000, 'TWD', 0),
(2, 'P002', 'LUXGEN U6 TURBO ECO HYPER SPORTS+', 3, 892000, 'TWD', 0),
(3, 'M001', '590MPA車側兩片一體式及前方大樑', 1, 31900, 'TWD', 0),
(4, 'M002', '980MPA車底井型樑件', 4, 117800, 'TWD', 0),
(5, 'N001', '外掛式「IR紅外線夜視、倒車專用、距離線」倒車攝影機', 2, 4980, 'TWD', 0),
(6, 'P003', 'NISSAN SENTRA aero', 3, 715000, 'TWD', 1),
(7, 'P004', 'NISSAN 370Z', 5, 1980000, 'TWD', 0),
(8, 'M003', '1470MPA車門內防撞樑', 1, 16980, 'TWD', 0),
(9, 'N002', 'SONY 2016MEX-N4150BT USB/MP3藍芽主機 55瓦特×4 MEGA BASS 前置AUX和USB（iPod）的配置指導遠程輸入', 6, 1234567890, 'TWD', 0),
(10, 'N003', 'INN 創新牌 DVU-743 汽車音響主機', 7, 3280, 'TWD', 0),
(11, 'P005', 'BMW i8', 1, 9890000, 'TWD', 0),
(12, 'M004', '超高張力鋼板VHTS', 3, 95440, 'TWD', 0),
(13, 'N004', 'HP 惠普高畫質數位行車記錄器 F890G', 5, 2599, 'TWD', 0),
(14, 'N005', 'Panasonic 汽車音響主機 CQ-RX550T (贈品)', 5, 0, 'TWD', 0),
(15, 'P006', 'Audi R8', 5, 10062900, 'TWD', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `location_db`
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
-- 資料表的匯出資料 `location_db`
--

INSERT INTO `location_db` (`location_id`, `country`, `country_sid`, `city`, `city_sid`, `invalid`) VALUES
(1, '台灣', 'TW', '台北', 'TPE', 0),
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
(19, '台灣', 'TW', '金門', 'KNH', 0),
(20, '台灣', 'TW', '馬祖', 'MFK', 0),
(21, '中國', 'CN', '北京', 'BJS', 0),
(22, '中國', 'CN', '上海', 'SGH', 0),
(23, '越南', 'VN', '胡志明', 'SGN', 0),
(24, 'Greenwood The Great', 'GG', 'Kingdom of Rhovanion', 'KOR', 0),
(25, '剛鐸', 'GE', '多爾安羅斯', 'DAR', 0),
(26, '亞爾諾', 'RN', '雅西頓', 'YCT', 0),
(27, '魔多', 'MD', '西力斯昂哥', 'CLS', 0),
(28, '剛鐸', 'GE', '昂巴', 'UPA', 0),
(29, '伊歐西歐德', 'OS', '洛汗', 'RHN', 0),
(30, '矮人自治領土愛加拉隆', 'IL', '登丹人自治領土督伊頓森林', 'DET', 0),
(31, 'asf', 'as', 'qwe', 'qwe', 2),
(32, '我們', '我們', '哈囉啊啊', '哈囉啊', 1),
(33, '', 'as', '', 'qwe', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `quotation_detail_db`
--

CREATE TABLE `quotation_detail_db` (
  `quo_item_id` bigint(20) UNSIGNED NOT NULL COMMENT '訂單物品編號',
  `quo_id` int(11) DEFAULT NULL COMMENT '訂單編號',
  `item_id` int(11) DEFAULT NULL COMMENT '物品編號',
  `amount` int(11) NOT NULL DEFAULT '0' COMMENT '銷售數量',
  `price` bigint(15) NOT NULL DEFAULT '0' COMMENT '實際售價',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TWD' COMMENT '幣值',
  `discount` char(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '折扣',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢物品種類'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `quotation_detail_db`
--

INSERT INTO `quotation_detail_db` (`quo_item_id`, `quo_id`, `item_id`, `amount`, `price`, `currency`, `discount`, `invalid`) VALUES
(1, 1, 3, 6, 9999999, 'NTD', '+31,247.96%', 0),
(2, 1, 4, 12, 1690, 'NTD', '-98.57%', 0),
(3, 1, 5, 6, 12490, 'NTD', '+150.80%', 0),
(4, 2, 2, 21, 222221, 'NTD', '-75.09%', 0),
(5, 2, 4, 22, 22222, 'NTD', '-81.14%', 1),
(6, 2, 6, 23, 222223, 'NTD', '-68.92%', 1),
(7, 2, 8, 24, 224, 'NTD', '-98.68%', 1),
(8, 3, 3, 6, 12990, 'NTD', '-59.28%', 0),
(9, 3, 4, 12, 71690, 'NTD', '-39.14%', 0),
(10, 3, 5, 7, 12490, 'NTD', '+150.80%', 0),
(11, 4, 4, 0, 1780, 'NTD', NULL, 0),
(12, 5, 4, 1, 80750, 'NTD', '-31.45%', 0),
(13, 6, 4, 100000, 90650, 'NTD', '-23.05%', 0),
(14, 7, 9, 1, 1500000000, 'NTD', '+21.50%', 0),
(15, 8, 8, 10, 16500, 'NTD', '-2.83%', 0),
(16, 9, 9, 1, 1999999998, 'NTD', '+62.00%', 0),
(17, 10, 10, 1, 5000, 'NTD', '+52.44%', 0),
(18, 10, 1, 1, 4000, 'NTD', '-99.41%', 0),
(19, 11, 1, 1, 340000, 'NTD', '-49.93%', 0),
(20, 11, 13, 22, 1500, 'NTD', '-42.29%', 0),
(21, 11, 12, 333, 70000, 'NTD', '-26.66%', 0),
(22, 11, 11, 4444, 6663700, 'NTD', '-32.62%', 0),
(23, 11, 10, 55555, 4999, 'NTD', '+52.41%', 0),
(24, 11, 9, 666666, 1999999999, 'NTD', '+62.00%', 0),
(25, 11, 8, 7777777, 16000, 'NTD', '-5.77%', 0),
(26, 11, 7, 88888888, 1979999, 'NTD', '無折扣', 0),
(27, 11, 6, 999999999, 345911, 'NTD', '-51.62%', 0),
(28, 11, 5, 1000000000, 11111, 'NTD', '+123.11%', 0),
(29, 11, 4, 2147483647, 101600, 'NTD', '-13.75%', 0),
(30, 11, 3, 190, 20999, 'NTD', '-34.17%', 0),
(31, 11, 2, 200, 559999, 'NTD', '-37.22%', 0),
(32, 12, 2, 1, 99892001, 'NTD', '+11,098.65%', 1),
(33, 13, 2, 1, 9980, 'NTD', NULL, 1),
(34, 14, 2, 1, 9980, 'NTD', NULL, 1),
(35, 15, 2, 1, 9980, 'NTD', NULL, 1),
(36, 16, 2, 1, 9980, 'NTD', NULL, 1),
(37, 17, 2, 1, 99800000, 'NTD', '+11,088.34', 1),
(38, 18, 2, 1, 9980, 'NTD', NULL, 1),
(39, 19, 2, 1, 9980, 'NTD', NULL, 1),
(40, 20, 2, 1, 719980, 'NTD', '-19.28%', 0),
(41, 21, 2, 1, 444444, 'NTD', '-50.17%', 0),
(42, 22, 2, 1, 9980, 'NTD', NULL, 1),
(43, 11, 14, 2, 100, 'TWD', '原價為零', 0),
(44, 11, 14, 3, 0, 'TWD', '原價為零', 0),
(45, 11, 10, 10, 3000, 'TWD', '-8.54%', 0),
(46, 2, 1, 211, 1234567, 'TWD', '+81.82%', 0),
(61, 7, 5, 1, 3000, 'TWD', '-39.76%', 0),
(63, 22, 8, 1, 16000, 'TWD', '-5.77%', 1),
(64, 1, 9, 1, 300000000, 'TWD', '-75.70%', 0),
(65, 22, 3, 1, 30000, 'TWD', '-5.96%', 0),
(66, 22, 3, 1, 31234, 'TWD', '-2.09%', 1),
(67, 22, 3, 2, 29876, 'TWD', '-6.34%', 0),
(68, 22, 4, 3, 110000, 'TWD', '-6.62%', 0),
(69, 10, 9, 1234567890, 119876543210, 'TWD', '+9,610.00%', 0),
(70, 19, 3, 2, 29982, 'TWD', '-6.01%', 0),
(71, 18, 5, 20000, 4888, 'TWD', '-1.85%', 0),
(72, 18, 7, 1, 1888888, 'TWD', '-4.60%', 0),
(73, 17, 15, 1, 9888888, 'USD', '-1.73%', 0),
(74, 16, 12, 1, 84562, 'TWD', '-11.40%', 0),
(75, 16, 8, 23, 15379, 'TWD', '-9.43%', 0),
(76, 16, 3, 4, 32567, 'TWD', '+2.09%', 0),
(77, 16, 4, 5, 120000, 'TWD', '+1.87%', 0),
(78, 15, 1, 2, 666666, 'TWD', '-1.82%', 0),
(79, 15, 7, 3, 1888888, 'TWD', '-4.60%', 0),
(80, 15, 11, 1, 10666666, 'TWD', '+7.85%', 0),
(81, 14, 5, 100, 4777, 'TWD', '-4.08%', 0),
(82, 14, 10, 50, 3000, 'TWD', '-8.54%', 0),
(83, 14, 14, 5, 0, 'TWD', '原價為零', 0),
(84, 13, 9, 1, 2222222222, 'TWD', '+80.00%', 0),
(85, 13, 13, 5000000, 2500, 'TWD', '-3.81%', 0),
(86, 12, 11, 1, 9500000, 'TWD', '-3.94%', 0),
(87, 12, 12, 20, 94444, 'TWD', '-1.04%', 0);

-- --------------------------------------------------------

--
-- 資料表結構 `quotation_simple_db`
--

CREATE TABLE `quotation_simple_db` (
  `quo_id` bigint(20) UNSIGNED NOT NULL COMMENT '訂單編號',
  `qu_s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '流水號',
  `po_s_id` varchar(20) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_id` int(11) DEFAULT NULL COMMENT '客戶編號',
  `date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '日期',
  `po_date` datetime DEFAULT CURRENT_TIMESTAMP COMMENT '完成日期',
  `item_id` int(11) DEFAULT NULL COMMENT '重點採買的料號',
  `price` bigint(18) NOT NULL DEFAULT '0' COMMENT '訂單總額',
  `currency` varchar(3) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'TWD' COMMENT '幣值',
  `sales_tax` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否含稅',
  `is_order` tinyint(1) NOT NULL DEFAULT '0' COMMENT '是否為訂單',
  `date_y` int(11) DEFAULT NULL COMMENT '年份',
  `date_m` int(11) DEFAULT NULL COMMENT '月份',
  `date_qu_no` int(11) DEFAULT NULL COMMENT '月編號(報價單)',
  `date_po_no` int(11) DEFAULT NULL COMMENT '月編號(訂單)',
  `invalid` tinyint(1) NOT NULL DEFAULT '0' COMMENT '作廢項目'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 資料表的匯出資料 `quotation_simple_db`
--

INSERT INTO `quotation_simple_db` (`quo_id`, `qu_s_id`, `po_s_id`, `customer_id`, `date`, `po_date`, `item_id`, `price`, `currency`, `sales_tax`, `is_order`, `date_y`, `date_m`, `date_qu_no`, `date_po_no`, `invalid`) VALUES
(1, 'QU201610-00001', 'PO201610-00001', 2, '2016-10-07 10:38:20', '2017-01-25 00:05:22', 9, 360095214, 'TWD', 1, 1, 2016, 10, 1, 1, 0),
(2, 'QU201610-00002', NULL, 1, '2016-10-11 15:24:39', '2017-01-25 00:05:22', 1, 265160278, 'TWD', 1, 0, 2016, 10, 2, NULL, 0),
(3, 'QU201610-00003', NULL, 2, '2016-10-16 09:38:20', '2017-01-25 00:05:22', 4, 1025650, 'TWD', 0, 0, 2016, 10, 3, NULL, 0),
(4, 'QU201610-00004\r\n', NULL, 5, '2016-10-16 10:18:46', '2017-01-25 00:05:22', 4, 0, 'TWD', 0, 0, 2016, 10, 4, NULL, 1),
(5, 'QU201610-00005', 'PO201610-00003', 4, '2016-10-18 10:20:38', '2017-01-25 00:05:22', 4, 80750, 'TWD', 1, 1, 2016, 10, 5, 3, 0),
(6, 'QU201610-00006', 'PO201610-00004', 3, '2016-10-20 16:49:38', '2017-01-25 00:05:22', 4, 9065000000, 'TWD', 1, 1, 2016, 10, 6, 4, 0),
(7, 'QU201610-00007', 'PO201610-00002', 2, '2016-10-21 06:25:31', '2017-01-25 00:05:22', 9, 1500003000, 'TWD', 1, 0, 2016, 10, 7, 2, 0),
(8, 'QU201611-00001', 'PO201611-00002', 6, '2016-11-18 09:32:38', '2017-01-25 00:05:22', 8, 165000, 'TWD', 1, 0, 2016, 11, 1, 2, 0),
(9, 'QU201611-00002', 'PO201611-00001', 9, '2016-11-19 16:17:05', '2017-01-25 00:05:22', 9, 1999999998, 'TWD', 1, 1, 2016, 11, 2, 1, 0),
(10, 'QU201611-00003', NULL, 10, '2016-11-22 00:00:00', '2017-01-25 00:05:22', 9, 9223372036854775807, 'TWD', 1, 0, 2016, 11, 3, NULL, 0),
(11, 'QU201612-00001', NULL, 9, '2016-12-16 08:33:14', '2017-01-25 00:05:22', 9, 2084692722210800, 'TWD', 1, 0, 2016, 12, 1, NULL, 0),
(12, 'QU201701-00001', 'PO201701-00001', 11, '2017-01-02 06:31:40', '2017-01-25 00:05:22', 11, 11388880, 'TWD', 0, 0, 2017, 1, 1, 1, 0),
(13, 'QU201701-00002', 'PO201701-00002', 12, '2017-01-03 06:06:29', '2017-01-25 00:05:22', 13, 14722222222, 'TWD', 1, 1, 2017, 1, 2, 2, 0),
(14, 'QU201702-00001', NULL, 13, '2017-02-09 06:34:24', '2017-01-25 00:05:22', 5, 627700, 'TWD', 0, 0, 2017, 2, 1, NULL, 0),
(15, 'QU201703-00001', NULL, 14, '2017-03-10 14:13:37', '2017-01-25 00:05:22', 11, 17666662, 'TWD', 0, 0, 2017, 3, 1, NULL, 0),
(16, 'QU201704-00001', 'PO201704-00001', 15, '2017-04-07 05:23:46', '2017-01-25 00:05:22', 4, 1168547, 'TWD', 0, 0, 2017, 4, 1, 1, 0),
(17, 'QU201705-00001', 'PO201705-00001', 16, '2017-05-19 13:11:22', '2017-01-25 00:05:22', 15, 9888888, 'TWD', 0, 1, 2017, 5, 1, 1, 0),
(18, 'QU201706-00001', NULL, 17, '2017-06-16 17:24:31', '2017-01-25 00:05:22', 5, 99648888, 'TWD', 0, 0, 2017, 6, 1, NULL, 0),
(19, 'QU201707-00001', NULL, 18, '2017-07-21 07:32:25', '2017-01-25 00:05:22', 3, 59964, 'TWD', 0, 0, 2017, 7, 1, NULL, 0),
(20, 'QU201709-00001', NULL, 19, '2017-09-28 15:24:16', '2017-01-25 00:05:22', 2, 719980, 'TWD', 0, 0, 2017, 9, 1, NULL, 0),
(21, 'QU201712-00001', 'PO201712-00001', 20, '2017-12-28 07:11:21', '2017-01-25 00:05:22', 2, 444444, 'TWD', 1, 1, 2017, 12, 1, 1, 0),
(22, 'QU201903-00001', 'PO201903-00001', 21, '2019-03-02 06:31:40', '2017-01-25 00:05:22', 4, 419752, 'TWD', 0, 1, 2019, 3, 1, 1, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `supplier_db`
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
-- 資料表的匯出資料 `supplier_db`
--

INSERT INTO `supplier_db` (`supplier_id`, `s_id`, `name`, `nickname`, `location`, `ubn`, `contact`, `contact_phone`, `company_phone`, `company_fax`, `address`, `email`, `invalid`) VALUES
(1, 'STWNTC002', '威誌株式會社', '諾克堤斯', 2, '19890115', '代表取締役社長伊格尼斯', '03-5292-8100', '06-6920-3600', '03-5771-0573', '東京都新宿区新宿6丁目27番30号 新宿イーストサイドスクエア', 'tadfgzcvx@gmail.com', 0),
(2, 'SCNBJS001', '秉霖精品汽車旅館', 'B0 MOTEL', 21, '19920804', '林姿妏', '03-463-6666', '03-422-6322', '03-301-2626', '桃園市中壢區大華路122號', 'asdfwerwerq@gmail.com', 0),
(3, 'STWTYN001', '米果米寶幼兒園', '陳看護工', 4, '19820106', '林姊姊', '03-362-5468', '03-332-3351', '03-336-4093', '桃園區民權路六十七號', 'asdfa232f@gmail.com', 0),
(4, 'STWTPE001', '大台北噪音防治股份有限公司', '大台北噪音', 1, '1682616', '張興宗', '10-6453-2533', NULL, NULL, '臺北市大安區信義路3段106號3樓之7', NULL, 1),
(5, 'STWKHH001', '台北丸台運送股份有限公司', '丸台運送', 13, '3122301', '蘇信吉', '10-6453-2539', NULL, '10-6453-2539', '高雄市苓雅區凱旋一路43號2樓', NULL, 0),
(6, 'STWTPE002', '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的股份有限公司', '測試用故意用超長', 1, '123456789', '測試用故意用超長名字的', '03-4538-3366', NULL, NULL, '測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的測試用故意用超長名字的地址', '測試用故意用超長名字的@測試用故意用超長名字的.測試用故意用超長名字的', 0),
(7, 'STWTPE003', '故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 故意留空白 做為測試使用 ', '留空白 做為測試', 1, '123 4567', '留空白 做為測試', '03 456 789', '03 458 798', '03 546 789', '留空白 做為測試留空白 做為測試留空白 做為測試留空白 做為測試', '留空白 做為測試留空白 做為測試留空白 做為測試留空白 做為測試', 0),
(8, 'STWTPE004', '成步堂終末', 'end', 1, '', '', '', '', '', '', '', 0);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `company_db`
--
ALTER TABLE `company_db`
  ADD PRIMARY KEY (`company_id`),
  ADD UNIQUE KEY `company_id` (`company_id`);

--
-- 資料表索引 `customer_db`
--
ALTER TABLE `customer_db`
  ADD PRIMARY KEY (`customer_id`),
  ADD UNIQUE KEY `customer_id` (`customer_id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- 資料表索引 `item_db`
--
ALTER TABLE `item_db`
  ADD PRIMARY KEY (`item_id`),
  ADD UNIQUE KEY `item_id` (`item_id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- 資料表索引 `location_db`
--
ALTER TABLE `location_db`
  ADD PRIMARY KEY (`location_id`),
  ADD UNIQUE KEY `location_id` (`location_id`);

--
-- 資料表索引 `quotation_detail_db`
--
ALTER TABLE `quotation_detail_db`
  ADD PRIMARY KEY (`quo_item_id`),
  ADD UNIQUE KEY `quo_item_id` (`quo_item_id`);

--
-- 資料表索引 `quotation_simple_db`
--
ALTER TABLE `quotation_simple_db`
  ADD PRIMARY KEY (`quo_id`),
  ADD UNIQUE KEY `quo_id` (`quo_id`),
  ADD UNIQUE KEY `s_id` (`qu_s_id`);

--
-- 資料表索引 `supplier_db`
--
ALTER TABLE `supplier_db`
  ADD PRIMARY KEY (`supplier_id`),
  ADD UNIQUE KEY `supplier_id` (`supplier_id`),
  ADD UNIQUE KEY `s_id` (`s_id`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `customer_db`
--
ALTER TABLE `customer_db`
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '客戶編號', AUTO_INCREMENT=27;
--
-- 使用資料表 AUTO_INCREMENT `item_db`
--
ALTER TABLE `item_db`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '物品編號', AUTO_INCREMENT=16;
--
-- 使用資料表 AUTO_INCREMENT `location_db`
--
ALTER TABLE `location_db`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '地點編號', AUTO_INCREMENT=34;
--
-- 使用資料表 AUTO_INCREMENT `quotation_detail_db`
--
ALTER TABLE `quotation_detail_db`
  MODIFY `quo_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '訂單物品編號', AUTO_INCREMENT=88;
--
-- 使用資料表 AUTO_INCREMENT `quotation_simple_db`
--
ALTER TABLE `quotation_simple_db`
  MODIFY `quo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=23;
--
-- 使用資料表 AUTO_INCREMENT `supplier_db`
--
ALTER TABLE `supplier_db`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '供應商編號', AUTO_INCREMENT=9;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
