-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2018 at 11:00 PM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `receipes`
--

-- --------------------------------------------------------

--
-- Table structure for table `receipe`
--

CREATE TABLE `receipe` (
  `rID` int(5) NOT NULL,
  `rName` text NOT NULL,
  `rDesc` text NOT NULL,
  `user` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `receipe`
--

INSERT INTO `receipe` (`rID`, `rName`, `rDesc`, `user`) VALUES
(1, 'Biryani', 'Soak rice for half an hour.\r\nCook in rice cooker with 15 cups of water. Cook rice until almost done.\r\nFry onions in oil until golden brown.\r\nAdd ginger and garlic.\r\nAdd chili powder, cloves, cardamom, pepper corn, cumin, curry, graham masala, coriander, cinnamon stick, bay leaves, dried plums, and salt.\r\nAdd yogurt.\r\nAdd tomatoes and cook until dry.\r\nAdd meat.\r\nAdd green chiles.\r\nCook until meat is done and add water if needed.\r\nAdd cilantro.\r\nMix saffron with hot water.', 'Kunal Jain'),
(2, 'Punjabi dal makhani', 'Soak whole black urad and rajma overnight in 3-4 cups of water.\r\nCook the soaked dal and rajma in the same water with salt, red chili powder and half the chopped ginger till dal and rajma are cooked and soft.\r\nPeel and chop the onion, ginger and garlic finely. Also chop the tomatoes.\r\nHeat oil and butter in a thick-bottomed pan. Add cumin seeds, when it crackles add chopped onions and fry till golden brown.\r\nAdd chopped ginger, garlic and chopped tomatoes. Sauté till tomatoes are well mashed and fat starts to leave the masala. Add boiled dal and rajma to this.Do not add the liquid at first.Crush(mash) the dals with the back of the ladle while stirring continuously, this gives that creamy texture to the dal .\r\nAdd the liquid and some water if required and simmer on very low heat for fifteen minutes.\r\nAdd fresh cream and garam masala powder let it simmer for another five minutes. Finish off with a couple of pinch of Kasoori methi powdered.\r\nServe hot with Naan or Paraatha.\r\nTip: Replacing the tomatoes with 4 tablespoons of thick tomato paste will enhance the taste and colour of the dish manifold.', 'Shriya Khatri'),
(3, 'Paneer Tikka', '1.Dry roast and pound cumin seeds, coriander seeds, brown cardamom, green cardamom, cloves, black pepper, star anise and shahee zeera in a mortar and pestle.\r\n2.In a bowl add ginger garlic paste, turmeric powder, red chilli powder, coriander powder, salt, kashmiri chilli powder, refined oil, coriander leaves chopped, mint leaves chopped, lime, dry mango powder, chaat masala, green chilli, whisked curd and hara masala. Mix them all.\r\nFor grilling paneer tikka:\r\n1.In a tray spread some paneer cubes, julienne onion, capsicum and tomatoes.\r\n2.Mix the masala in the tray. Marinate the paneer cubes.\r\n3.Skewer the tikkas for roasting.\r\n4.Now keep the marinated paneer tikkas in the fridge for 45 minutes.\r\n5.Then grill the tikkas till coo', 'Nishant Kabra');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `receipe`
--
ALTER TABLE `receipe`
  ADD PRIMARY KEY (`rID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
