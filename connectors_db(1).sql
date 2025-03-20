-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Mar 20, 2025 at 08:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connectors.db`
--

-- --------------------------------------------------------

--
-- Table structure for table `part`
--

CREATE TABLE `part` (
  `Nomenclature` varchar(30) NOT NULL,
  `make` varchar(20) NOT NULL,
  `quantity` int(11) NOT NULL,
  `usedqty` int(11) NOT NULL,
  `availableqty` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `part`
--

INSERT INTO `part` (`Nomenclature`, `make`, `quantity`, `usedqty`, `availableqty`) VALUES
('10-646401-035N', 'amphenol', 125, 65, 60),
('D38999-20FB-35PN', 'amphenol', 20, 10, 10),
('D38999-26FH-35PN', 'amphenol', 20, 0, 20),
('D38999-26FJ-35PN', 'emphenol', 120, 20, 100);

-- --------------------------------------------------------

--
-- Table structure for table `parts`
--

CREATE TABLE `parts` (
  `part_no` varchar(40) NOT NULL,
  `quantity` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `parts`
--

INSERT INTO `parts` (`part_no`, `quantity`) VALUES
('10-646401-035N', 104),
('10-646401-035Ni', 0),
('10-646401-035Nioil', 20),
('101', 20),
('1034', 12),
('109', 1),
('10jddjw', 20),
('123', 12),
('123456', 20),
('20', 1),
('324', 1),
('D38999-20FB-35PN', 20),
('D38999-20FE-35PN', 10),
('D38999-20FF-35PN', 10),
('D38999-20FG-35PN', 10),
('D38999-20WJ-20PA', 10),
('D38999-26FA-35BN', 10),
('D38999-26FB-35SN', 10),
('D38999-26FD-35PN', 10),
('D38999-26FE-35AN', 10),
('D38999-26FF-35AN', 10),
('D38999-26FF-35SN', 10),
('D38999-26FH-35PN', 20),
('D38999-26FH-55PN', 20),
('D38999-26FJ-35PN', 10),
('D38999-26WC-98SA', 10),
('D38999-26WE-35PN', 10),
('D38999-26WF-35SN', 20),
('D38999-26WJ-20PA', 10),
('D38999-26WJ-20PN', 10),
('D38999-31WF-20PN', 10),
('D38999/26WC35PN', 10),
('D38999/26WC98SN', 10),
('D38999/26WD19PN', 10),
('D38999/26WE35SN', 10),
('D38999/26WH35SA', 10),
('D38999/26WH35SN', 10),
('D38999/26WJ35SA', 10),
('D38999/26WJ35SB', 10),
('D38999/26WJ35SC', 10),
('D38999/26WJ35SN', 10),
('DD104F1000X', 10),
('DD104M1000X', 10),
('DD15F1000X', 30),
('DD26M1000X', 10),
('DES109-WE', 20),
('DES1200', 0),
('EVD15F10000-SAX', 15),
('EVD15M10000-PAX', 15),
('EVD50F10000-SAX', 15),
('EVD50M10000-PAX', 15),
('kjkhujgbi', 87),
('M85049/38-S-13W', 10),
('M85049/38-S-23N', 10),
('M85049/38-S-23W', 10),
('M85049/38-S-25W', 10),
('M85049/39-S-13N', 10),
('M85049/47-S-20N', 10),
('MS27473T20F35PA', 10),
('MS27473T20F35PN', 10),
('MS3475-L12-10SN', 10),
('polokf', 10),
('wes-900', 30);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `part`
--
ALTER TABLE `part`
  ADD PRIMARY KEY (`Nomenclature`);

--
-- Indexes for table `parts`
--
ALTER TABLE `parts`
  ADD PRIMARY KEY (`part_no`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
