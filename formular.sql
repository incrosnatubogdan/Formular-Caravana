-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 12, 2018 at 05:26 PM
-- Server version: 5.5.61-cll
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `x28crvnc_formular`
--

-- --------------------------------------------------------

--
-- Table structure for table `formular`
--

CREATE TABLE `formular` (
  `id` int(11) NOT NULL,
  `name` varchar(60) DEFAULT NULL,
  `gender` varchar(60) DEFAULT NULL,
  `varsta` varchar(60) DEFAULT NULL,
  `datanasterii` varchar(60) DEFAULT NULL,
  `phone` varchar(60) DEFAULT NULL,
  `Adresa` varchar(60) DEFAULT NULL,
  `Localitate` varchar(60) DEFAULT NULL,
  `Judet` varchar(60) DEFAULT NULL,
  `Talie` varchar(60) DEFAULT NULL,
  `Greutate` varchar(60) DEFAULT NULL,
  `Circumferinta-abdominala` varchar(300) DEFAULT NULL,
  `Circumferinta-soldurilor` varchar(300) DEFAULT NULL,
  `Tensiunea-arteriala-ortostatism` varchar(300) DEFAULT NULL,
  `Tensiunea-arteriala-clinostatism` varchar(300) DEFAULT NULL,
  `acuze` varchar(300) DEFAULT NULL,
  `Antecedente-heredo-colaterale` varchar(300) DEFAULT NULL,
  `antecedente-fiziologice` varchar(300) DEFAULT NULL,
  `Antecedente-personale-fiziologice` varchar(300) DEFAULT NULL,
  `antecedente-patologice` varchar(300) DEFAULT NULL,
  `antecedente-personale-patologice` varchar(300) DEFAULT NULL,
  `loc-munca` varchar(300) DEFAULT NULL,
  `fumator` varchar(60) DEFAULT NULL,
  `pachete-an` varchar(60) DEFAULT NULL,
  `an-nefumator` varchar(60) DEFAULT NULL,
  `mese-zi` varchar(60) DEFAULT NULL,
  `legume` varchar(60) DEFAULT NULL,
  `fructe` varchar(60) DEFAULT NULL,
  `lactate` varchar(60) DEFAULT NULL,
  `fainoase` varchar(60) DEFAULT NULL,
  `proteine` varchar(60) DEFAULT NULL,
  `ml-alcool` varchar(60) DEFAULT NULL,
  `alcool-zi` varchar(60) DEFAULT NULL,
  `suplimente` varchar(60) DEFAULT NULL,
  `observatii-tegumente` varchar(300) DEFAULT NULL,
  `tegumente-mucoase-fanere` varchar(300) DEFAULT NULL,
  `tesut-conjuctiv-adipos` varchar(300) DEFAULT NULL,
  `observatii-tesut` varchar(300) DEFAULT NULL,
  `sistem-ganglionar` varchar(300) DEFAULT NULL,
  `observatii-ganglionar` varchar(300) DEFAULT NULL,
  `muscular-osteo-articular` varchar(300) DEFAULT NULL,
  `observatii-muscular` varchar(300) DEFAULT NULL,
  `aparat-respirator` varchar(300) DEFAULT NULL,
  `observatii-aparat-respirator` varchar(300) DEFAULT NULL,
  `aparat-cardiovascular` varchar(300) DEFAULT NULL,
  `observatii-cardiovascular` varchar(300) DEFAULT NULL,
  `abdomen` varchar(300) DEFAULT NULL,
  `observatii-abdomen` varchar(300) DEFAULT NULL,
  `ficat-bila-splina` varchar(300) DEFAULT NULL,
  `observatii-ficat` varchar(300) DEFAULT NULL,
  `aparat-genito-urinar` varchar(300) DEFAULT NULL,
  `observatii-genito-urinar` varchar(300) DEFAULT NULL,
  `observatii-sistem-nervos` varchar(300) DEFAULT NULL,
  `organe-de-simt` varchar(300) DEFAULT NULL,
  `observatii-organe-de-simt` varchar(300) DEFAULT NULL,
  `tiroida` varchar(300) DEFAULT NULL,
  `observatii-tiroida` varchar(300) DEFAULT NULL,
  `consultari-suplimentare` varchar(300) DEFAULT NULL,
  `alte-consulturi` varchar(300) DEFAULT NULL,
  `diagnostice` varchar(300) DEFAULT NULL,
  `recomandari` varchar(300) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `formular`
--

INSERT INTO `formular` (`id`, `name`, `gender`, `varsta`, `datanasterii`, `phone`, `Adresa`, `Localitate`, `Judet`, `Talie`, `Greutate`, `Circumferinta-abdominala`, `Circumferinta-soldurilor`, `Tensiunea-arteriala-ortostatism`, `Tensiunea-arteriala-clinostatism`, `acuze`, `Antecedente-heredo-colaterale`, `antecedente-fiziologice`, `Antecedente-personale-fiziologice`, `antecedente-patologice`, `antecedente-personale-patologice`, `loc-munca`, `fumator`, `pachete-an`, `an-nefumator`, `mese-zi`, `legume`, `fructe`, `lactate`, `fainoase`, `proteine`, `ml-alcool`, `alcool-zi`, `suplimente`, `observatii-tegumente`, `tegumente-mucoase-fanere`, `tesut-conjuctiv-adipos`, `observatii-tesut`, `sistem-ganglionar`, `observatii-ganglionar`, `muscular-osteo-articular`, `observatii-muscular`, `aparat-respirator`, `observatii-aparat-respirator`, `aparat-cardiovascular`, `observatii-cardiovascular`, `abdomen`, `observatii-abdomen`, `ficat-bila-splina`, `observatii-ficat`, `aparat-genito-urinar`, `observatii-genito-urinar`, `observatii-sistem-nervos`, `organe-de-simt`, `observatii-organe-de-simt`, `tiroida`, `observatii-tiroida`, `consultari-suplimentare`, `alte-consulturi`, `diagnostice`, `recomandari`) VALUES
(2, 'laurentiu alibnos', 'Masculin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, 'laurentiu alibnos', 'Masculin', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `formular`
--
ALTER TABLE `formular`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `formular`
--
ALTER TABLE `formular`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
