-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 01, 2024 at 04:52 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_library`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `data_buku`
--

CREATE TABLE `data_buku` (
  `id_buku` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `book_number` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `penulis` varchar(255) NOT NULL,
  `penerbit` varchar(255) NOT NULL,
  `tanggal_terbit` date NOT NULL,
  `jumlah_buku` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `data_buku`
--

INSERT INTO `data_buku` (`id_buku`, `image`, `book_name`, `book_number`, `description`, `penulis`, `penerbit`, `tanggal_terbit`, `jumlah_buku`) VALUES
(1, 'atomic_habits.jpg', 'Atomic Habits', '112233', 'James Clear distils the most fundamental information about habit formation, so you can accomplish more by focusing on less.', 'James Clear', 'Gramedia', '2018-10-16', 50),
(2, 'Cover_Stop_Overthinking.jpg', 'Stop Overthinking', '112234', 'Overcome negative thought patterns, reduce stress, and live a worry-free life. Overthinking is the biggest cause of unhappiness. Don\'t get stuck in a never-ending thought loop. Stay present and keep your mind off things that don\'t matter, and never will.', 'Nick Trenton', 'Gramedia', '2021-03-01', 50),
(3, 'filosofi_teras.jpg', 'Filosofi Teras', '112235', 'Stoisisme, atau Filosofi Teras, adalah filsafat Yunani-Romawi kuno yang bisa membantu kita mengatasi emosi negatif dan menghasilkan mental yang tangguh dalam menghadapi naik-turunnya kehidupan.', 'Henry Manampiring', 'Gramedia', '2018-11-26', 50),
(4, 'first_think_first.jpg', 'First Thing First', '112236', 'First Things First is a self-help book written by Stephen Covey, A. Roger Merrill, and Rebecca R. Merrill. It offers a time management approach that, if established as a habit, is intended to help readers achieve \"effectiveness\" by aligning themselves to ', 'Stephen Covey', 'Gramedia', '2023-11-29', 50),
(5, 'seni_bodo_amat.png', 'Seni untuk bersikap bodo amat', '112237', 'The Subtle Art of Not Giving a F*ck: A Counterintuitive Approach to Living a Good Life is a 2016 nonfiction self-help book by American blogger and author Mark Manson.', 'Mark manson', 'Gramedia', '2016-09-13', 50),
(6, 'The-Psychology-Of-Money.jpg', 'Pyschology of Money', '112238', 'Doing well with money isn\'t necessarily about what you know. It\'s about how you behave. And behavior is hard to teach, even to really smart peopl', 'Morgan Housel', 'Gramedia', '2020-09-08', 50);

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE `order` (
  `id` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `book_name` varchar(255) NOT NULL,
  `quantity` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone_number` bigint(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `random_code` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`id`, `image`, `book_name`, `quantity`, `name`, `phone_number`, `email`, `street`, `city`, `random_code`) VALUES
(1, 'atomic_habits.jpg', 'Atomic Habits', '1', 'Marsha Lenathea', 123123132, 'MarshaLenathea@gmail.com', 'Fx Sudirman', 'Jakarta', 'BOOKS65669c4b7759c3905'),
(2, 'filosofi_teras.jpg', 'Filosofi Teras', '1', 'jokowi', 3456789, 'doni@gmail.yahoo', 'pakisrejo', 'tulungagung', 'BOOKS65669d2c279604306');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_user` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `t_number` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_user`, `image`, `username`, `email`, `t_number`, `password`, `user_type`) VALUES
(1, 'marsha-jkt48-2.jpg', 'Marsha Lenathea ', 'MarshaLenathea@gmail.com', '0881026129442', '$2y$10$mZDGlcm4tLMMbKf1IOG70ecZJvXpbwPitQ0v42aCgzjuAFRK.zLAW', 'user'),
(2, '../img-profile/napoleon.jpg', 'napoleon', 'napoleon@gmail.com', '123123123', '$2y$10$Gunq/VQPeL5v6BYRTD/P3.q9vkUTEN6uhV6Y56Z55IdvSWe7czebS', 'admin'),
(3, 'meme 5.jpg', 'jokowidodo', 'Jokowi@gmail.com', '0998723456', '$2y$10$AS/hSKG1r6ohY3tOAL3PtO3kEO3/bcJ0/Y2cUk.KGSkKigwKdCpZy', 'user'),
(4, '../img-profile/ashel.jpg', 'ashel', 'ashel@gmail.com', '0848', '$2y$10$HTzj9mWlG88OsLkXtoCW4uNq35gdRZfurvS5Nb5VbEL/Vl4Evb2gi', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `data_buku`
--
ALTER TABLE `data_buku`
  ADD PRIMARY KEY (`id_buku`);

--
-- Indexes for table `order`
--
ALTER TABLE `order`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `data_buku`
--
ALTER TABLE `data_buku`
  MODIFY `id_buku` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `order`
--
ALTER TABLE `order`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
