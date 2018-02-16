-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 06 Okt 2017 pada 21.50
-- Versi Server: 10.1.26-MariaDB
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pr-ojek`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `drivers`
--

CREATE TABLE `drivers` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `total_rating` int(11) NOT NULL DEFAULT '0',
  `total_passangers` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `drivers`
--

INSERT INTO `drivers` (`ID`, `name`, `total_rating`, `total_passangers`) VALUES
(2, 'Adya Naufal Fikri', 0, 0),
(3, 'Vigor Akbar', 0, 0),
(4, 'Turfa Auliarachman', 0, 0),
(5, 'Fildah Ananda Amalia', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `driver_locations`
--

CREATE TABLE `driver_locations` (
  `ID` int(11) NOT NULL,
  `location` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `driver_locations`
--

INSERT INTO `driver_locations` (`ID`, `location`) VALUES
(2, 'Cisitu'),
(3, 'Cisitu'),
(3, 'Tubagus Ismail'),
(4, 'Tubagus Ismail'),
(4, 'Pelesiran'),
(2, 'Pelesiran'),
(5, 'Tubagus Ismail'),
(5, 'Tamansari'),
(5, 'Cisitu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaction`
--

CREATE TABLE `transaction` (
  `ID` int(11) NOT NULL,
  `id_user` int(11) NOT NULL,
  `id_driver` int(11) NOT NULL,
  `rating` int(11) NOT NULL,
  `comment` varchar(1024) NOT NULL,
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `picking_point` varchar(50) NOT NULL,
  `destination` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `transaction`
--

INSERT INTO `transaction` (`ID`, `id_user`, `id_driver`, `rating`, `comment`, `time`, `picking_point`, `destination`) VALUES
(1, 1, 2, 4, 'Nebeng teross', '2017-10-07 02:10:48', 'tubagus ismail', 'pasar baru'),
(2, 3, 4, 3, 'Lamban banget euy', '2017-10-07 02:12:22', 'stasiun bandung', 'dipatiukur');

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `ID` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `username` varchar(25) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` varchar(15) NOT NULL,
  `driver` tinyint(1) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT './img/profile-placeholder.png'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`ID`, `name`, `username`, `email`, `password`, `phone_number`, `driver`, `image`) VALUES
(1, 'Jehian', 'reiva5', 'jehiannormansaviero@gmail.com', '1arext1ar', '081382525626', 0, './img/HMIF-Jehian.jpg'),
(2, 'Adya Naufal Fikri', 'adyanf', 'adyanf@gmail.com', 'opsrtisuc', '089510149602', 1, './img/HMIF-Adya.jpg'),
(3, 'Vigor Akbar', 'vigorakbar', 'vigorakbar@gmail.com', 'bsuigasum', '08812387183', 1, './img/HMIF-Vigor.jpg'),
(4, 'Turfa Auliarachman', 'kingfalcon', 'nangisdarah@gmail.com', 'thtorhrot', '082132400651', 1, './img/HMIF-Turfa.jpg'),
(5, 'Fildah Ananda Amalia', 'fildahfreeze', 'fildahanandaamalia@gmail.com', 'nadlsshhsd', '081381767784', 1, './img/HMIF-Fildah.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `drivers`
--
ALTER TABLE `drivers`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `transaction`
--
ALTER TABLE `transaction`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `id_driver` (`id_driver`),
  ADD KEY `id_user` (`id_user`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `drivers`
--
ALTER TABLE `drivers`
  ADD CONSTRAINT `drivers_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `users` (`ID`);

--
-- Ketidakleluasaan untuk tabel `driver_locations`
--
ALTER TABLE `driver_locations`
  ADD CONSTRAINT `driver_locations_ibfk_1` FOREIGN KEY (`ID`) REFERENCES `drivers` (`ID`);

--
-- Ketidakleluasaan untuk tabel `transaction`
--
ALTER TABLE `transaction`
  ADD CONSTRAINT `transaction_ibfk_1` FOREIGN KEY (`id_driver`) REFERENCES `drivers` (`ID`),
  ADD CONSTRAINT `transaction_ibfk_2` FOREIGN KEY (`id_user`) REFERENCES `users` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
