-- phpMyAdmin SQL Dump
-- version 4.6.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2017-02-14 14:27:37
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
(0, '立旺鐵工廠', '立旺', 7, '08319015', '詹愛珠', '(04)2527-6007', '(04)2527-6007', '(04)2520-0785', '臺中市神岡區豐洲里神洲路330巷33弄71號', '', 0);

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
(0, '請在創建第一筆客戶資料後作廢"預設資料"', '預設資料', '預設資料', 7, '20170214', '', '謝謝您的配合', '在創建第一筆資料後', '', '請立刻將本項設定為作廢', '', 0);

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
(0, '請在創建第一筆物品資料後作廢"預設資料"', '預設資料', 0, 0, '', 0);

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
(23, '越南', 'VN', '胡志明', 'SGN', 0);

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
(0, '請在創建第一筆供應商資料後作廢"預設資料', '預設資料', '預設資料', 7, '20140214', '', '謝謝您的配合', '在創建第一筆資料後', '', '請立刻將本項設定為作廢', '', 0);

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
  MODIFY `customer_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '客戶編號';
--
-- 使用資料表 AUTO_INCREMENT `item_db`
--
ALTER TABLE `item_db`
  MODIFY `item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '物品編號';
--
-- 使用資料表 AUTO_INCREMENT `location_db`
--
ALTER TABLE `location_db`
  MODIFY `location_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '地點編號', AUTO_INCREMENT=24;
--
-- 使用資料表 AUTO_INCREMENT `quotation_detail_db`
--
ALTER TABLE `quotation_detail_db`
  MODIFY `quo_item_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '訂單物品編號';
--
-- 使用資料表 AUTO_INCREMENT `quotation_simple_db`
--
ALTER TABLE `quotation_simple_db`
  MODIFY `quo_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '訂單編號';
--
-- 使用資料表 AUTO_INCREMENT `supplier_db`
--
ALTER TABLE `supplier_db`
  MODIFY `supplier_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '供應商編號';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
