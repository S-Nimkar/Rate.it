-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `StudentReviews`
--
-- --------------------------------------------------------
--
-- Table structure for table `Comment`
--
CREATE TABLE `Comment` (
  `CommentID` int(11) NOT NULL,
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Comment` text NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Table structure for table `Rating`
--

CREATE TABLE `Rating` (
  `RatingID` int(11) NOT NULL,
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Rating` enum('1','2','3','4','5') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Table structure for table `Review`
--
CREATE TABLE `Review` (
  `ReviewID` int(11) NOT NULL,
  `UserID` int(11) NOT NULL,
  `Address1` varchar(50) NOT NULL,
  `Address2` varchar(50) DEFAULT NULL,
  `Postcode` varchar(15) NOT NULL,
  `City` varchar(15) NOT NULL,
  `Region` varchar(15) NOT NULL,
  `ReviewBody` text NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
—
-- Table structure for table `User`
--
CREATE TABLE `User` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Fname` varchar(15) NOT NULL,
  `Sname` varchar(15) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
--
-- Dumping data for table `User`
—
INSERT INTO `User` (`UserID`, `Email`, `Fname`, `Sname`, `Username`, `Password`) VALUES
(1, 'nimkarsumedh01@gmail.com', 'Sumedh', 'Nimkar', 'sumedh123', 'password'),
(2, 'example@gmail.com', 'John', 'Smith', 'jsmith123', 'password');
--
-- Indexes for dumped tables
--
-- Indexes for table `Comment`
—
ALTER TABLE `Comment`
  ADD PRIMARY KEY (`CommentID`),
  ADD KEY `ReviewConstraint-Comment` (`ReviewID`),
  ADD KEY `UserConstaint-Comment` (`UserID`);
--
-- Indexes for table `Rating`
--
ALTER TABLE `Rating`
  ADD PRIMARY KEY (`RatingID`),
  ADD KEY `ReviewConstraint-Rating` (`ReviewID`),
  ADD KEY `UserConstraint-Rating` (`UserID`);
--
-- Indexes for table `Review`
--
ALTER TABLE `Review`
  ADD PRIMARY KEY (`ReviewID`),
  ADD KEY `UserConstraint` (`UserID`);
--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`UserID`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username` (`Username`);
--
-- AUTO_INCREMENT for dumped tables
--
-- AUTO_INCREMENT for table `Comment`
--
ALTER TABLE `Comment`
  MODIFY `CommentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `Rating`
--
ALTER TABLE `Rating`
  MODIFY `RatingID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `Review`
--
ALTER TABLE `Review`
  MODIFY `ReviewID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `User`
--
ALTER TABLE `User`
  MODIFY `UserID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--
-- Constraints for table `Comment`
--
ALTER TABLE `Comment`
  ADD CONSTRAINT `ReviewConstraint-Comment` FOREIGN KEY (`ReviewID`) REFERENCES `Review` (`ReviewID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `UserConstaint-Comment` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE NO ACTION;
--
-- Constraints for table `Rating`
--
ALTER TABLE `Rating`
  ADD CONSTRAINT `ReviewConstraint-Rating` FOREIGN KEY (`ReviewID`) REFERENCES `Review` (`ReviewID`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `UserConstraint-Rating` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE NO ACTION;
--
-- Constraints for table `Review`
--
ALTER TABLE `Review`
  ADD CONSTRAINT `UserConstraint` FOREIGN KEY (`UserID`) REFERENCES `User` (`UserID`) ON DELETE CASCADE ON UPDATE NO ACTION;