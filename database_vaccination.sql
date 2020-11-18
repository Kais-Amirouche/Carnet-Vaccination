-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2020 at 03:25 PM
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
  `fait_at` date NOT NULL,
  `rappel` varchar(20) DEFAULT NULL,
  `numero_lot` varchar(20) NOT NULL
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
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar.png'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `vac_vaccins`
--

CREATE TABLE `vac_vaccins` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `age` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `rappel` varchar(250) DEFAULT NULL,
  `statuts` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vac_vaccins`
--

INSERT INTO `vac_vaccins` (`id`, `name`, `age`, `description`, `rappel`, `statuts`) VALUES
(1, 'La Diphtérie', '2 et 4 mois', 'La Diphtérie est une maladie infectieuse très contagieuse. Elle se transmet par la salive quand une personne tousse, crache , etc.', '11 mois, 6 ans, entre 11 et 13 ans, à 25 ans, 45 ans, 65 ans, puis tous les dix ans chez les adultes de plus de 65 ans.', 'obligatoire'),
(2, 'Le Tétanos', '2 mois', 'Le tétanos est une maladie infectieuse causée par une bactérie qui peut provoquer la paralysie.', 'Enfants à 12 mois, puis entre 4 et 7 ans, aux adolescents 11-13 ans, aux jeunes adultes de 25 à 29 ans, aux adultes et aux seniors tous les 20 ans pour les vaccins reçus entre 25 et 64 ans, puis tous les 10 ans.', 'obligatoire'),
(3, 'La poliomyélite', '2 et 4 mois', 'La Poliomyélite est une maladie infectieuse aigüe et contagieuse qui provoque une paralysie chez l\'enfant.', 'Entre 15 et 24 mois, puis entre 4 et 7 ans et entre 11-13 ans.', 'obligatoire'),
(4, 'l’Haemophilus influenzae B  (hib)', '2 et 4 mois', 'C\'est une bactérie qui est à l\'origine de méningites et d\'infections respiratoires aigües principalement chez l\'enfant.', '11 mois', 'obligatoire'),
(5, 'La Coqueluche', '2 et 4 mois', 'La Coqueluche est une infection respiratoire très contagieuse qui se transmet par contact', '11 mois et entre 11 et 13 ans', 'obligatoire'),
(6, 'Hépatite B', '6 à 12 mois', 'L\'Hépatite B est une infection virale qui s\'attaque au foie et peut entraîner une affection aiguë comme une affection chronique de cet organe.', 'aucun', 'obligatoire'),
(7, 'La Rougeole ', '12 mois et entre 16-18 mois ', 'La Rougeole est une infection virale très contagieuse qui se caractérise par une forte fièvre, une toux.....', 'aucun', 'obligatoire'),
(8, 'Les oreillons', '2 doses à 12 mois et entre 16-18 mois', 'Les oreillons sont une maladie virale contagieuse responsable d\'une inflammation des glandes salivaires.', 'aucun', 'obligatoire'),
(9, 'La Rubéole', '2 doses à 12 mois et entre 16-18 mois', 'La rubéole est une infection causée par un virus. Elle est moins grave que la rougeole, sauf chez les femmes enceintes. ', 'aucun', 'obligatoire'),
(10, 'Le Méningocoque c', '5 et 12mois et peut se faire 1 fois de 12mois à 24 ans chez les non vaccinés.\r\n', 'Le méningocoque est une bactérie très fragile qui ne survit pas dans le milieu extérieur. Il est exclusivement retrouvé chez l\'homme, où il se développe au niveau de la gorge, qui est à la fois la porte d\'entrée, le lieu de vie et la voie d\'élimination de cette bactérie.', 'aucun', 'obligatoire'),
(11, 'Le Pneumocoque', 'Bébés : Un total de 3 doses, à 2 mois, à 4 mois.\r\n\r\nAdultes : La vaccination des adultes consiste en l’administration en 2 doses du vaccin conjugué 13-valent ou du vaccin polysaccharidique 23-valent, ', 'Le Pneumocoque est une espèce de bactérie. C\'est un important agent pathogène chez l\'humain. Il est notamment responsable de nombreuses co-infections.', 'Une dose de rappel à 12 mois.', 'obligatoire');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vac_users`
--
ALTER TABLE `vac_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vac_vaccins`
--
ALTER TABLE `vac_vaccins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
