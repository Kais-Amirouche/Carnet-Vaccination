-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 16, 2020 at 09:48 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vaccination`
--

-- --------------------------------------------------------

--
-- Table structure for table `user_vaccin`
--

CREATE TABLE `user_vaccin` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vaccin_id` int(11) NOT NULL,
  `fait_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vac_contact`
--

CREATE TABLE `vac_contact` (
  `id` int(11) NOT NULL,
  `email` varchar(150) NOT NULL,
  `message` text NOT NULL,
  `created_at` datetime NOT NULL,
  `statuts` varchar(20) NOT NULL,
  `answer` text DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vac_contact`
--

INSERT INTO `vac_contact` (`id`, `email`, `message`, `created_at`, `statuts`, `answer`, `updated_at`) VALUES
(1, 'coucou@yaho.com', 'azeraaefafaefzad', '2020-11-12 14:36:27', 'ok', 'Bonjour, c\'est tiyt simple bb', '2020-11-12 18:38:51'),
(2, 'coucou@yaho.com', 'papapapapapa', '2020-11-12 15:57:00', 'attente', NULL, NULL),
(3, 'floricourtcamille@gmail.com', 'ça va ? ', '2020-11-12 19:10:05', 'attente', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vac_users`
--

CREATE TABLE `vac_users` (
  `id` int(11) NOT NULL,
  `email` varchar(120) NOT NULL,
  `nom` varchar(150) DEFAULT NULL,
  `prenom` varchar(150) DEFAULT NULL,
  `password` varchar(250) NOT NULL,
  `birth_date` datetime DEFAULT NULL,
  `role` varchar(15) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `avatar` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vac_users`
--

INSERT INTO `vac_users` (`id`, `email`, `nom`, `prenom`, `password`, `birth_date`, `role`, `token`, `created_at`, `avatar`) VALUES
(1, 'allanlebogosdu76@gg.com', 'Leblond', 'Allan', '$2y$10$I.8m6nUGhNM9Wwkm3CoYHuvwyzioLzTDMVcbVePqYNdy0.BcnlEey', NULL, 'admin', 'BFXlnmuRfbFeTAq3PXTHIsraIRmab9PdyPU0asH26XTLZ1CRTCXWwigCufj1jtsW7DvxIJmuEMX1IElGnewGtJnnQJRzhewmS7w2vC36fvWqzkKf2pvqxopQ', '2020-11-10 15:51:21', '1.png'),
(2, 'bonjour@cc.com', 'bonjour', 'bonjour', '$2y$10$te4OLgap.V71l9H8kFYcTOf5SJHwQVPCbIimsoCsegu/qRAXgS/Ca', NULL, 'abonne', 'p2gVwZJr8KAPzgiRtqq2jht7TAQN4LKIIBTssyWsXIEGwvmP3nZQJjTH2S4yQqiVaVRAfwbouc4XvBsbnpEBOINVC0rQiF4zIL75rhwhraQoPhe87YFq1wrA', '2020-11-12 09:15:54', ''),
(3, 'aa@cc.com', 'aaa', 'aaa', '$2y$10$.C3MwkIvRJgkDKMaSlUv2eudVsAFngjm.zjZUVTA3qCv.IpZNAvMy', NULL, 'abonne', 'zYSu5MbcduEbkaMxZkwuZiwddu5eSx0V2oLhKLHmJbS7eQfTomQKmnbibjDzBHxSB64gRpxbWD0Vs1SUOrmcUGOUIAbWtlolRlv4Kft4fiYaGxlYHAY3kM3R', '2020-11-12 09:17:57', ''),
(4, 'floricourtcamille@gmail.com', 'floricourt', 'camille', '$2y$10$E7fCW56TacUGDVuwZ2htPOAZ89gOA1gquq.H4TBcDculPahRFc0Ly', NULL, 'abonne', 'NBTIwOp5m00qcXrvnX1CHJd6pCuSCWRajVtkX2iu3EK1T9BD1rYM1LmsmJfSF67VpYYLQkBe5PXfH6JPWeEYJCks7VrhJ8P8qfcwAvoAAF3UMPXCk6pxTwgh', '2020-11-12 19:09:12', '');

-- --------------------------------------------------------

--
-- Table structure for table `vac_vaccins`
--

CREATE TABLE `vac_vaccins` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `age` varchar(20) NOT NULL,
  `description` text NOT NULL,
  `rappel` varchar(250) DEFAULT NULL,
  `statuts` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `user_vaccin`
--
ALTER TABLE `user_vaccin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vac_contact`
--
ALTER TABLE `vac_contact`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vac_users`
--
ALTER TABLE `vac_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vac_vaccins`
--
ALTER TABLE `vac_vaccins`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `user_vaccin`
--
ALTER TABLE `user_vaccin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vac_contact`
--
ALTER TABLE `vac_contact`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vac_users`
--
ALTER TABLE `vac_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vac_vaccins`
--
ALTER TABLE `vac_vaccins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
