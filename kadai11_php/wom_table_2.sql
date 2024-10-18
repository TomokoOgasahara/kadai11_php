-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: localhost
-- 生成日時: 2024 年 10 月 18 日 23:55
-- サーバのバージョン： 10.4.28-MariaDB
-- PHP のバージョン: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `gs_db`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `wom_table_2`
--

CREATE TABLE `wom_table_2` (
  `comp` varchar(64) NOT NULL,
  `type1` varchar(64) NOT NULL,
  `type2` varchar(64) NOT NULL,
  `wratiorec` float DEFAULT NULL,
  `wratioall` float DEFAULT NULL,
  `myear` float DEFAULT NULL,
  `wyear` float DEFAULT NULL,
  `mchild` float DEFAULT NULL,
  `wchild` float DEFAULT NULL,
  `overtime` float DEFAULT NULL,
  `holiday` float DEFAULT NULL,
  `wchief` float DEFAULT NULL,
  `wmanager` float DEFAULT NULL,
  `wboard` float DEFAULT NULL,
  `paidgap` float DEFAULT NULL,
  `yeargap` float DEFAULT NULL,
  `pipeline` float DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- テーブルのデータのダンプ `wom_table_2`
--

INSERT INTO `wom_table_2` (`comp`, `type1`, `type2`, `wratiorec`, `wratioall`, `myear`, `wyear`, `mchild`, `wchild`, `overtime`, `holiday`, `wchief`, `wmanager`, `wboard`, `paidgap`, `yeargap`, `pipeline`, `data`) VALUES
('株式会社アイシン', '輸送用機械器具製造業', '自動車', 19.3, 11.7, 16.2, 12.7, 50.4, 100, 26.1, 101, 4.8, 2.8, 25, 68.8, 78, 24, '2024-06-27'),
('株式会社アドヴィックス', '輸送用機械器具製造業', '自動車', 16, NULL, 13.8, 8.3, NULL, 100, NULL, 100, 5.9, 1.4, 0, 70.1, 60, NULL, '2024-07-05'),
('いすゞ自動車株式会社', '輸送用機械器具製造業', '自動車', 30.3, 31, NULL, NULL, 53.1, 82.4, NULL, NULL, NULL, 3.7, NULL, 81.3, NULL, 12, '2024-09-13'),
('スズキ株式会社', '輸送用機械器具製造業', '自動車', 4.7, 12, 19.3, 14, 43, 100, 24, 81.4, 4.3, 1.6, 2.9, 64, 73, 13, '2023-07-10'),
('ダイハツ工業株式会社', '輸送用機械器具製造業', '自動車', 18, 8.3, 19.4, 16.2, 70, 100, 18, 96.9, 5.7, 3.2, 6.7, 77.5, 84, 39, '2024-07-26'),
('株式会社デンソー', '輸送用機械器具製造業', '自動車', 31, 16, 19, 11.5, 53.5, 101.6, 19.5, 95.7, 4.7, 2, 9.5, 67.3, 61, 13, '2024-06-28'),
('(株) 東海理化電機製作所', '輸送用機械器具製造業', '自動車', 34, 15.9, 18.8, 16.8, 72.2, 107, 19.4, 90.7, 5, 1.9, 6.3, 64.2, 89, 12, '2024-08-08'),
('豊田合成株式会社', '輸送用機械器具製造業', '自動車', 16.5, 18.7, 14.8, 16.2, 59.6, 100, 14.8, 92.4, 5.2, 3.6, 15.4, 76.8, 109, 19, '2024-06-14'),
('トヨタ自動車株式会社', '輸送用機械器具製造業', '自動車', 17.3, 13, 16, 13.6, 61.5, 112.8, 21.8, 87.8, 9.1, 3.7, 12.5, 66.9, 85, 28, '2024-08-26'),
('トヨタ自動車東日本株式会社', '輸送用機械器具製造業', '自動車', 9.4, NULL, 21.5, 18.9, NULL, NULL, 97, NULL, 2.3, NULL, NULL, 70.4, 88, NULL, '2024-07-25'),
('株式会社豊田自動織機', '輸送用機械器具製造業', '自動車', 54.7, 42.2, 18.1, 18.3, 40.6, 95.8, 25.7, 97.7, 8.9, 2, 2.8, 65.2, 101, 5, '2024-07-10'),
('トヨタ車体株式会社', '輸送用機械器具製造業', '自動車', 52.6, 49.8, 21.1, 22, 52.9, 92.9, 23.8, 108.5, 3.7, 2.4, NULL, 73.2, 104, 5, '2024-06-28'),
('日産自動車株式会社', '輸送用機械器具製造業', '自動車', 17.2, 14.7, 15.6, 11.2, 51.4, 95, 25.4, 97, NULL, 10.7, 12.9, 79, 72, 73, '2024-10-11'),
('パナソニックオートモーティブシステムズ株式会社', '輸送用機械器具製造業', '自動車', 17, 13.2, 21, 22.6, 107, 63, 23.2, 77, 4.1, 4.7, 5.9, 75.2, 108, 36, '2024-07-09'),
('日立Astemo株式会社', '輸送用機械器具製造業', '自動車', NULL, NULL, NULL, NULL, 66, 76, NULL, NULL, 1.8, NULL, NULL, 74.4, NULL, NULL, '2024-01-19'),
('ボッシュ株式会社', '輸送用機械器具製造業', '自動車', 23, 16.2, 20.3, 16.2, 42.9, 100, 10.6, 82.7, NULL, 8.3, NULL, 76.4, 80, 51, '2024-04-02'),
('本田技研工業株式会社', '輸送用機械器具製造業', '自動車', 15.8, 9.5, 22.7, 15.5, 49.7, 97.1, 21.6, 99, NULL, 2.9, 25, 72.5, 68, 31, '2024-07-18'),
('マツダ株式会社', '輸送用機械器具製造業', '自動車', 10.8, NULL, 17.5, 14.3, 93.4, 100, 21.1, NULL, 4.3, NULL, NULL, 85.3, 82, NULL, '2024-07-31'),
('三菱自動車工業株式会社', '輸送用機械器具製造業', '自動車', 11.3, 11.5, 15.8, 11.8, 70.6, 95.3, 24.8, 93.4, 12.7, 6.3, 13.6, 78.9, 75, 55, '2024-09-24'),
('三菱ふそうトラック・バス株式会社', '輸送用機械器具製造業', '自動車', 41.7, 6.3, 25.9, 10.1, 3.5, 7.7, NULL, NULL, 9.2, 6.4, 12.5, 86.2, 39, 102, '2024-08-08'),
('ヤマハ発動機株式会社', '輸送用機械器具製造業', '自動車', NULL, 12.7, 20, 17.3, 65.2, 100, NULL, NULL, 3.7, 26.7, NULL, 71.5, 87, 29, '2024-04-24'),
('UDトラックス株式会社', '輸送用機械器具製造業', '自動車', 2.5, 1.7, NULL, NULL, 61, 100, NULL, NULL, 5.9, NULL, NULL, 89.8, NULL, 347, '2024-08-21'),
('ユニプレス株式会社', '輸送用機械器具製造業', '自動車', 29.5, 11.5, 21.8, 14.8, 73.1, 100, 13.4, 87.5, NULL, 5.8, 8, 73.3, 68, 50, '2024-06-18');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
