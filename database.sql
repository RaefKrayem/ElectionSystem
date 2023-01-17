

CREATE TABLE `users` (
  `ID` int(4) NOT NULL AUTO_INCREMENT,
  `fullName` varchar(60) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `voted` tinyint(1) NOT NULL,
  PRIMARY KEY (`ID`)
);

CREATE TABLE `prescandidates` (
  `ID` int(4) NOT NULL,
  `fullName` varchar(60) NOT NULL,
  `votesNum` int(4) NOT NULL,
  PRIMARY KEY (`ID`)
);

INSERT INTO `prescandidates`(`ID`, `fullName`, `votesNum`) VALUES ( 1 , 'Eric Charles' , 0 );
INSERT INTO `prescandidates`(`ID`, `fullName`, `votesNum`) VALUES ( 2 , 'Angela Wood' , 0 );


CREATE TABLE `vicecandidates` (
  `ID` int(4) NOT NULL,
  `fullName` varchar(60) NOT NULL,
  `votesNum` int(4) NOT NULL,
  PRIMARY KEY (`ID`)
);

INSERT INTO `vicecandidates`(`ID`, `fullName`, `votesNum`) VALUES ( 1 , 'Jessica Ramirez' , 0 );
INSERT INTO `vicecandidates`(`ID`, `fullName`, `votesNum`) VALUES ( 2 , 'Adam Baker' , 0 );
INSERT INTO `vicecandidates`(`ID`, `fullName`, `votesNum`) VALUES ( 3 , 'Brandon Washington' , 0 );



CREATE TABLE `vote` (
  `userID` int(4) NOT NULL,
  `presID` int(4) NOT NULL,
  `viceID` int(4) NOT NULL,
  KEY `userID` (`userID`),
  KEY `presID` (`presID`),
  KEY `viceID` (`viceID`),
  CONSTRAINT `vote_ibfk_1` FOREIGN KEY (`viceID`) REFERENCES `vicecandidates` (`ID`) ON DELETE CASCADE ON UPDATE CASCADE
) 

