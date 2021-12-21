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
(1, 'admin', '$2y$10$9uUM6t/pK.xgVJNLkGrZuuzeAP4yBonv44syZmfSjTdbuNUaRYy2.', 'admin@admin.fr', 1, 'admin', 'admin', '2021-12-03 01:10:12'),
(2, 'chris', '$2y$10$IXWaL.ZeVOlzrKMSs1/ImuXNTh8vjIpAVAlaed4lCMqBigX28A1Ii', 'chris@gmail.com', 1, 'Chris', 'DEA', '2021-11-29 12:27:13'),
(7, 'chrisdemon8', '$2y$10$IXWaL.ZeVOlzrKMSs1/ImuXNTh8vjIpAVAlaed4lCMqBigX28A1Ii', 'chris@orange.fr', 2, 'chris', 'chris', '2021-12-01 11:12:35');



INSERT INTO `question` (`id_question`, `label_question`, `level`) VALUES
(1, 'Qui était le président des États-Unis de 2012 à 2016 ?', 1),
(2, 'Quelle est la capitale du Burkina Faso ?', 6),
(4, 'Qui est le président actuel de la France ?', 1),
(5, 'Qui est l acteur qui incarne Spiderman dans Spiderman Homecoming?', 3);

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
(17, 'Andrew Garfield', 5, 0);