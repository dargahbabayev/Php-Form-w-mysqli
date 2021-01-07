-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Anamakine: 127.0.0.1:3306
-- Üretim Zamanı: 07 Oca 2021, 20:37:20
-- Sunucu sürümü: 8.0.21
-- PHP Sürümü: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Veritabanı: `info`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `members`
--

DROP TABLE IF EXISTS `members`;
CREATE TABLE IF NOT EXISTS `members` (
  `id` int NOT NULL AUTO_INCREMENT,
  `Name` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `Surname` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `City` varchar(20) COLLATE utf8_turkish_ci NOT NULL,
  `Job` varchar(50) COLLATE utf8_turkish_ci NOT NULL,
  `Mtype` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci;

--
-- Tablo döküm verisi `members`
--

INSERT INTO `members` (`id`, `Name`, `Surname`, `City`, `Job`, `Mtype`) VALUES
(2, 'Suleyman', 'Aliyev', 'Lenkeran', 'Hakim', 1),
(4, 'Farid', 'Babayeva', 'Qax', 'Polis', 1),
(5, 'Deniz', 'Veliyeva', 'Baki', 'Muellime', 1),
(6, '1Dargah', 'Babayev', 'Qax', 'Coder', 1),
(13, 'Togrul', 'Hadiyev', 'Baki', 'Socar', 1),
(25, 'Ramis', 'noo', 'selyan', 'memar', 1),
(26, 'Ahmet', 'Kaya', 'Istanbul', 'Raper  ', 1);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
