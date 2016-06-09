-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 09 Cze 2016, 04:50
-- Wersja serwera: 5.5.49-0ubuntu0.14.04.1
-- Wersja PHP: 5.5.9-1ubuntu4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `Twitter`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Comment`
--

CREATE TABLE IF NOT EXISTS `Comment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tweet_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `creation_date` datetime DEFAULT NULL,
  `text` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `Comment_ibfk_1` (`tweet_id`),
  KEY `Comment_ibfk_2` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=41 ;

--
-- Zrzut danych tabeli `Comment`
--

INSERT INTO `Comment` (`id`, `tweet_id`, `user_id`, `creation_date`, `text`) VALUES
(6, 4, 5, '2016-02-06 11:02:00', 'Ja też'),
(10, 5, 5, '2016-06-02 11:04:00', 'A ja nie'),
(19, 17, 14, '2016-06-05 11:44:00', 'Hello to me'),
(22, 20, 15, '2016-06-05 20:43:00', 'Jestem fajny'),
(24, 2, 15, '2016-06-05 20:48:00', 'Czyli jaki?'),
(25, 3, 18, '2016-06-06 05:44:00', 'Naprawdę?'),
(26, 19, 18, '2016-06-06 05:45:00', 'Love them too!'),
(27, 5, 21, '2016-06-09 04:25:00', 'Co uczyniłeś, Boże?'),
(28, 3, 21, '2016-06-09 04:26:00', 'Lecz wy będziecie w grobach, i całuny będą na was spróchniałe'),
(29, 22, 21, '2016-06-09 04:28:00', 'Czuwajcie nad sobą, bo jesteście jak ludzie stojący na podniesieniu;'),
(30, 4, 20, '2016-06-09 04:34:00', 'Niechaj się wódka zapala.'),
(31, 3, 20, '2016-06-09 04:34:00', 'Zamykajcie drzwi na kłódki;'),
(32, 17, 20, '2016-06-09 04:35:00', 'Buchnęło, zawrzało\r\nI zgasło.'),
(33, 21, 20, '2016-06-09 04:36:00', 'Stawcie w środku kocioł wódki.'),
(34, 32, 20, '2016-06-09 04:36:00', 'Już straszna północ przybywa'),
(35, 26, 20, '2016-06-09 04:37:00', 'Tylko żwawo, tylko śmiało.'),
(36, 27, 20, '2016-06-09 04:37:00', 'Daję hasło'),
(37, 28, 20, '2016-06-09 04:38:00', 'Wszelki duch! jakaż potwora!'),
(38, 4, 19, '2016-06-09 04:39:00', 'To fajnie'),
(39, 35, 16, '2016-06-09 04:42:00', 'Szarpie mię żarłoczne ptastwo;'),
(40, 22, 16, '2016-06-09 04:43:00', 'Tak od potępieńca głowy\r\nZ trzaskiem sypią się iskrzyska.');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Message`
--

CREATE TABLE IF NOT EXISTS `Message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author_id` int(11) NOT NULL,
  `receiver_id` int(11) NOT NULL,
  `title` varchar(100) NOT NULL,
  `text` varchar(255) NOT NULL,
  `status` char(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `Message_ibfk_1` (`author_id`),
  KEY `Message_ibfk_2` (`receiver_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Zrzut danych tabeli `Message`
--

INSERT INTO `Message` (`id`, `author_id`, `receiver_id`, `title`, `text`, `status`) VALUES
(7, 5, 7, 'Trudniejsze sprawy', 'Nie mam wąsów', '0'),
(9, 7, 5, 'fasfdagg', 'dsagdsgdsgggggjsjjlkjadlsgjalksjgslkgjdlksghdsklgjlkdshfjgjytkkfskgjsjj', '1'),
(10, 15, 5, 'Hej', 'Jestem Wojtek i też mam 12 lat', '0'),
(11, 5, 15, 'Hej', 'Mam na imię Roman i jestem tokarzem', '1'),
(12, 18, 14, 'Cześć', 'Chciałbyś pójść ze mną na kolację?', '0'),
(13, 18, 16, 'Hej', 'Wybrałabyś się ze mną na zakupy?', '0'),
(14, 21, 16, 'Miejcie nadzieję', 'Bo nadzieja przejdzie z was do przyszłych pokoleń i ożywi je; ale jeśli w was umrze, to przyszłe pokolenia będą z ludzi martwych.', '0'),
(15, 21, 17, 'Miejcie nadzieję', 'Bo nadzieja przejdzie z was do przyszłych pokoleń i ożywi je; ale jeśli w was umrze, to przyszłe pokolenia będą z ludzi martwych.', '0'),
(16, 21, 18, 'Miejcie nadzieję', 'Bo nadzieja przejdzie z was do przyszłych pokoleń i ożywi je; ale jeśli w was umrze, to przyszłe pokolenia będą z ludzi martwych.', '0'),
(17, 20, 21, 'Widzicie w oknie upiora?', 'Jak kość na polu wybladły;\r\nPatrzcie! patrzcie, jakie lice!\r\nW gębie dym i błyskawice,\r\nOczy na głowę wysiadły,\r\nŚwiecą jak węgle w popiele.\r\nWłos rozczochrany na czele.\r\nA jak suchy snop cierniowy\r\nPłonąc miotłę ognia ciska,\r\nTak od potępieńca głowy\r\nZ t', '0'),
(18, 16, 17, 'Do nieba?', 'O nie! ja nie chcę do nieba;', '0');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `Tweet`
--

CREATE TABLE IF NOT EXISTS `Tweet` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `text` varchar(140) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=42 ;

--
-- Zrzut danych tabeli `Tweet`
--

INSERT INTO `Tweet` (`id`, `user_id`, `text`) VALUES
(1, 7, 'Jakiś text'),
(2, 5, 'Jakiś inny tweet'),
(3, 7, 'Jeszcze żyję'),
(4, 5, 'Zgoliłem wąsy'),
(5, 5, 'Nudzę się'),
(17, 14, 'Hello all\r\n'),
(18, 14, 'I am tired'),
(19, 14, 'I love pigs. Pigs are awesome!\r\n'),
(20, 15, 'Hej'),
(21, 18, 'Zjadłem naleśniki z dżemem.\r\n'),
(22, 18, 'Ogoliłem głowę'),
(23, 18, 'Lubię placki\r\n'),
(24, 21, 'Przyszli wygnańce na ziemię sybirską i obrawszy miejsce szerokie, zbudowali dom drewniany, aby zamieszkać razem w zgodzie.'),
(25, 21, 'Oto ja znałem ojców waszych także nieszczęśliwych i widziałem, jak żyli bogobojnie'),
(26, 21, 'Chcę być przyjacielem waszym, i zrobić przymierze między wami a moim ludem'),
(27, 21, 'Zostanę z wami i lud mój opuszczę'),
(28, 21, 'Odejdę z tym młodzieńcem, abym mu pokazał wiele rzeczy bolesnych, a wy zostaniecie sami uczyć się, jak znosić głód, nędzę i smutek.'),
(29, 20, 'Litwo! Ojczyzno moja! ty jesteś jak zdrowie. Ile cię trzeba cenić, ten tylko się dowie, kto cię stracił.'),
(31, 20, 'Połyskał się wstążkami jaskrawych stokrotek.'),
(32, 20, 'W oknach zawieście całuny.'),
(33, 20, 'Ciemno wszędzie, głucho wszędzie,\r\nCo to będzie, co to będzie?'),
(34, 20, 'Zamykajcie drzwi na kłódki;'),
(35, 19, 'Hej, kruki, sowy, orlice!'),
(36, 16, 'Dzieci! nie znacie mnie, dzieci?'),
(37, 16, 'Są owoce i jagody.'),
(38, 17, 'Strzelam banie i na rusztowanie'),
(39, 17, 'Ja roboty sie nie boję, mogę nawet koło niej leżeć'),
(40, 17, 'Spaliła mi się "markowa" szlifierka firmy Toya. '),
(41, 17, 'Panie majster, Mietek spadł z rusztowania!!');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fullName` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Zrzut danych tabeli `User`
--

INSERT INTO `User` (`id`, `email`, `password`, `fullName`, `active`) VALUES
(5, 'roman@wp.pl', '$2y$10$sLApPwQiGZhkit0kC9lYAujFDcrbGcY992XImUPp.WYNfHE4Ai.Zm', 'Roman Flak', 1),
(7, 'adam.kowalski@wp.pl', '$2y$10$zYeVGRXdMv5JLrPorSNJveVOTvfEfqqGNEG04EFRtnciAF/W0RAI2', 'Adam Kowalski', 1),
(14, 'marian@gmail.com', '$2y$10$Hf4ZrJ1DEvBVfkP0X.F5luRdXdYORtOrf56TLdJkANUGvoEnQvrKa', 'Marian Marecki', 1),
(15, 'wojtek1@wp.pl', '$2y$10$WfM1ijwmJT0qW3sySSopc.Xsk8mN6V8LasQSphbGa5GFSMlVW3fo2', 'Wojtek Kowalski', 0),
(16, 'anna.nowak@wp.pl', '$2y$10$uU5lnQItGF2qblt/Puc4HuCsmJ7LCXg0Hgege8hAUQ2xEWD4shl7e', 'Anna Nowak', 1),
(17, 'zenon@gmail.com', '$2y$10$1YMlk5Aj1t32ygqJo6UqB.M8Y.amHB81cozENWBgZRDjiptyQ3zdW', 'Zenon Cegła', 1),
(18, 'jerzy.slup@wp.pl', '$2y$10$7O7dYFRUf6tCibEWgWL9vOwG0c1kiALiVkXstqu4tcchkTgxTmvqO', 'Jerzy Słup', 1),
(19, 'halina@o2.pl', '$2y$10$w2LybOaXe7vISf.YdiCsb.iqSwiR2xaWaDE555yTzjFLA/rYM0XYC', 'Halina Kalina', 1),
(20, 'adam.m@wp.pl', '$2y$10$aaO9R03yAzBFfkL84YBHKeFceWH/Pmal34yBkaEf/Rral1uRbP41u', 'Adam Mickiewicz', 1),
(21, 'juliusz.s@gmail.com', '$2y$10$n1RyV0umiskdqnmMxf4ARuA9P/rriNj3YPwxPs6n17oncMdR4tUpu', 'Juliusz Słowacki', 1);

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `Comment_ibfk_1` FOREIGN KEY (`tweet_id`) REFERENCES `Tweet` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Comment_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Message`
--
ALTER TABLE `Message`
  ADD CONSTRAINT `Message_ibfk_1` FOREIGN KEY (`author_id`) REFERENCES `User` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `Message_ibfk_2` FOREIGN KEY (`receiver_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

--
-- Ograniczenia dla tabeli `Tweet`
--
ALTER TABLE `Tweet`
  ADD CONSTRAINT `Tweet_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
