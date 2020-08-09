-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- 主機： 127.0.0.1
-- 產生時間： 2020-08-09 13:55:56
-- 伺服器版本： 10.4.13-MariaDB
-- PHP 版本： 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `mytest`
--

-- --------------------------------------------------------

--
-- 資料表結構 `edx_table`
--

CREATE TABLE `edx_table` (
  `ID` int(11) NOT NULL,
  `DATE_EDX` date NOT NULL,
  `MASK_ID` text NOT NULL,
  `X8_TOOl` text NOT NULL,
  `SCN_TOOL` text NOT NULL,
  `COMPOSITION` text NOT NULL,
  `PX` float NOT NULL,
  `PY` float NOT NULL,
  `SEM_SIZE` float NOT NULL,
  `SEM` text NOT NULL,
  `OM` text NOT NULL,
  `BX` text NOT NULL,
  `X8` tinyint(1) NOT NULL,
  `RR` tinyint(1) NOT NULL,
  `NOTE` text NOT NULL,
  `ENGINEER` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- 傾印資料表的資料 `edx_table`
--

INSERT INTO `edx_table` (`ID`, `DATE_EDX`, `MASK_ID`, `X8_TOOl`, `SCN_TOOL`, `COMPOSITION`, `PX`, `PY`, `SEM_SIZE`, `SEM`, `OM`, `BX`, `X8`, `RR`, `NOTE`, `ENGINEER`) VALUES
(1, '2020-08-08', 'TMMND98-7V0A-1', 'G12', 'G306', 'C/O', 23423, 4234, 88, 'SEM_OM/001.png', '', 'OK', 1, 0, 'asd', 'YZCHEN'),
(2, '2020-07-31', 'TMMND98-8V1A-1', 'H11', 'K302', 'Sn', 324, 234, 1500, 'SEM_OM/001.png', '', 'OK', 1, 1, '234', 'YZCHEN'),
(3, '2020-08-04', 'TMMND98-8V1A-1', 'G12', 'G301', 'Mo', 234, 234, 0, 'SEM_OM/001.png', '', 'OK', 1, 0, '', 'YZCHEN'),
(4, '2020-08-03', 'TMMND98-8V1A-1', 'H11', 'K303', 'C/O', 1312, 312312, 190, 'SEM_OM/001.png', '', 'OK', 1, 0, '', 'YZCHEN'),
(5, '2020-08-05', 'etret', 'X8', 'K303', 'Fe/O', 345, 234, 0, 'SEM_OM/001.png', '', 'OK', 1, 0, '', 'YZCHEN'),
(6, '2020-06-17', 'werwerwer', 'X8', 'K302', 'Mo', 234, 78954, 234, 'SEM_OM/001.png', '', 'OK', 1, 0, '', 'YZCHEN');

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `edx_table`
--
ALTER TABLE `edx_table`
  ADD PRIMARY KEY (`ID`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `edx_table`
--
ALTER TABLE `edx_table`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
