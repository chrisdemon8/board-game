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