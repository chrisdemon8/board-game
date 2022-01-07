-- --------------------------------------------------------

DROP DATABASE IF EXISTS php_project;
CREATE DATABASE php_project;

--
-- Structure de la table `role`
--

CREATE TABLE `role` (
  `id_role` int(3) NOT NULL AUTO_INCREMENT,
  `label_role` varchar(10) NOT NULL, 
   PRIMARY KEY (`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id_user` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` int(3) NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `createdAt` datetime NOT NULL, 
  PRIMARY KEY (`id_user`),
  CONSTRAINT FK_UserRole FOREIGN KEY (`role`)
    REFERENCES `role`(`id_role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE `question` (
  `id_question` int(11) NOT NULL AUTO_INCREMENT,
  `label_question` varchar(255) NOT NULL,
  `level` int(2) NOT NULL,
   PRIMARY KEY (`id_question`) /*
  `answers` int(11) NOT NULL
  
  PRIMARY KEY (`id_question`),
  CONSTRAINT FK_AnswerId FOREIGN KEY (`answers`)
    REFERENCES `answer`(`id_answer`)
    */
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Structure de la table `answer`
--

CREATE TABLE `answer` (
  `id_answer` int(11) NOT NULL AUTO_INCREMENT,
  `label_answer` varchar(255) NOT NULL,
  `id_question` int(2) NOT NULL,
  `valid` BOOLEAN NOT NULL,
  PRIMARY KEY (`id_answer`),
  CONSTRAINT FK_AnswerId FOREIGN KEY (`id_question`)
    REFERENCES `question`(`id_question`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;




INSERT INTO `role` (`id_role`, `label_role`) VALUES
(1, 'ROLE_ADMIN'),
(2, 'ROLE_USER');


INSERT INTO `user` (`id_user`, `username`, `password`, `email`, `role`, `firstName`, `lastName`, `createdAt`) VALUES
(1, 'admin', '$2y$10$9uUM6t/pK.xgVJNLkGrZuuzeAP4yBonv44syZmfSjTdbuNUaRYy2.', 'chrisrabinov@gmail.com', 1, 'admin', 'admin', '2021-12-03 01:10:12'),
(2, 'valou', '$2y$10$IXWaL.ZeVOlzrKMSs1/ImuXNTh8vjIpAVAlaed4lCMqBigX28A1Ii', 'chrisrabinova@gmail.com', 1, 'Valentin', 'CAZZOLI', '2021-11-29 12:27:13'),
(7, 'chrisdemon8', '$2y$10$IXWaL.ZeVOlzrKMSs1/ImuXNTh8vjIpAVAlaed4lCMqBigX28A1Ii', 'chrisrabinovaa@gmail.com', 2, 'chris', 'PETRE', '2021-12-01 11:12:35'),
(10, 'Allan', '$2y$10$wACLvOdj5Nhzw.kyx3bSiO/GU81tY7wMkLZR6Tg8xVyN.2JOSlZtO', 'chrisrabinovaza@gmail.com', 2, 'Allan', 'Rabinov', '2022-01-07 11:01:40'),
(11, 'flo', '$2y$10$89aXWBfU9Bd0.cnRRv0FQeQpf6qSk20.H74YaKwC1CeZ.VSk4o0hq', 'chrisrabinovaaa@gmail.com', 2, 'flo', 'Rabinov', '2022-01-07 11:01:27');



INSERT INTO `question` (`id_question`, `label_question`, `level`) VALUES
(1, 'Qui était le président des États-Unis de 2012 à 2016 ?', 1),
(2, 'Quelle est la capitale du Burkina Faso ?', 6),
(4, 'Qui est le président actuel de la France ?', 1),
(5, 'Qui est l\'acteur qui incarne Spiderman dans Spiderman Homecoming?', 3),
(6, 'Quel est la définition du full HD ?', 2),
(7, 'En quelle année a été établie la 5ème république ?', 4),
(8, 'Dans quel arc de One Piece apparait pour la première fois Trafalgar D. Water Law ?', 5),
(9, 'Quelle est la capitale de l\'Afrique du Sud ?', 3),
(10, 'Quelle est la capitale de la Corée du Sud ?', 3),
(11, 'Quelle est la capitale de l\'Ouganda ?', 6),
(12, 'Quelle est la capitale du Zimbabwe?', 6),
(13, 'Quelle est la capitale du Mali ?', 5),
(14, 'Quelle est la capitale de la France?', 1),
(15, 'Quelle est la capitale de l\'Irlande ?', 2),
(16, 'Quelle est la capitale de la Belgique?', 1),
(17, 'Quel continent est appelé le vieux continent ?', 1),
(18, 'Quelle est la monnaie de la Chine', 4),
(19, 'Quelle est la capitale de la Russie ?', 2),
(20, 'Quelle grande puissance a gagné la guerre froide ?', 3),
(21, 'Quand s\'est déroulée la guerre de d\'Algérie ?', 4),
(22, 'Quel roi de France était appelé le Roi-Soleil ?', 2),
(23, 'Quelle est la langue officielle de Cuba ?', 3),
(24, 'Quelle est la monnaie de l\'Argentine ?', 4),
(25, 'Qui a remporté la première coupe du monde ?', 5),
(26, 'Que signifie dns en informatique ?', 5),
(27, 'Dans la mythologie grecs qui est le dieux du soleil et des arts ?', 5),
(28, 'Combien de pays compte l\'Afrique ?', 6),
(29, 'Combien y-a-t-il de pays dans l\'union européenne ?', 4),
(30, 'Combien y a-t-il de lettre dans l\'alphabet ?', 1),
(31, 'Citer les entreprises dans l\'acronyme GAFAM', 2),
(32, 'Dans quelle pays se trouve la région de la Sardaigne ?', 3),
(33, 'Quel jour de l\'année fêtons l\'Épiphanie ?', 4),
(34, 'Dans quel état américain se trouve la Silicon Valley ?', 3);

INSERT INTO `answer` (`id_answer`, `label_answer`, `id_question`, `valid`) VALUES
(1, 'Barack Obama', 1, 1),
(2, 'Donald Trump', 1, 0),
(3, 'Ouagadougou', 2, 1),
(5, 'George W. Bush', 1, 0),
(6, 'Kaboul', 2, 0),
(7, 'Téhéran ', 2, 0),
(8, 'Tony Stark', 1, 0),
(12, 'Emmanuel Macron', 4, 1),
(13, 'François Hollande', 4, 0),
(14, 'Nicolas Sarkozy', 4, 0),
(15, 'Tom Holland', 5, 1),
(16, 'Tobey Maguire', 5, 0),
(17, 'Andrew Garfield', 5, 0),
(18, '1920*1080', 6, 1),
(19, '1958', 7, 1),
(20, 'Arc Sabaody', 8, 1),
(21, 'La Cap', 9, 1),
(22, 'Séoul', 10, 1),
(23, 'Pékin', 10, 0),
(24, 'Tokyo', 10, 0),
(25, 'Bagdad', 10, 0),
(26, 'Kampala', 11, 1),
(27, 'Harare', 12, 1),
(28, 'Bamako', 13, 1),
(29, 'Paris', 14, 1),
(30, 'Dublin', 15, 1),
(31, 'Bruxelles', 16, 1),
(32, 'Europe', 17, 1),
(33, 'Yuan', 18, 1),
(34, 'Yen', 18, 0),
(35, 'Won', 18, 0),
(36, 'Moscou', 19, 1),
(37, 'États-Unis ', 20, 1),
(38, '1954 – 1962', 21, 1),
(39, '2002 – 2006', 21, 0),
(40, '1854 – 1862', 21, 0),
(41, 'Louis XIV', 22, 1),
(42, 'Espagnol', 23, 1),
(43, 'Peso argentin', 24, 1),
(44, 'Uruguay', 25, 1),
(45, 'Domain Name System', 26, 1),
(46, 'Apollon', 27, 1),
(47, '54', 28, 1),
(48, '27', 29, 1),
(49, '26', 30, 1),
(50, 'Google Apple Facebook Amazon Microsoft', 31, 1),
(51, 'Italie', 32, 1),
(52, '6 janvier', 33, 1),
(53, '27', 30, 0),
(54, '25', 30, 0),
(55, '2', 30, 0),
(56, 'Californie', 34, 1),
(57, 'Nevada', 34, 0);