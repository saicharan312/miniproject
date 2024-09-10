-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Oct 03, 2020 at 07:55 PM
-- Server version: 10.3.24-MariaDB
-- PHP Version: 7.3.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `stuproonline_middaymeals`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `attendanceid` int(10) NOT NULL,
  `studentid` int(10) NOT NULL,
  `attendancedate` date NOT NULL,
  `attendancestatus` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`attendanceid`, `studentid`, `attendancedate`, `attendancestatus`) VALUES
(101, 3, '2020-05-23', 'Present'),
(102, 4, '2020-05-23', 'Absent'),
(103, 5, '2020-05-23', 'Present'),
(104, 6, '2020-05-23', 'Absent'),
(105, 7, '2020-05-23', 'Present'),
(106, 8, '2020-05-23', 'Present'),
(107, 9, '2020-05-23', 'Present'),
(108, 10, '2020-05-23', 'Present'),
(109, 11, '2020-05-23', 'Present'),
(110, 12, '2020-05-23', 'Present'),
(111, 13, '2020-05-23', 'Present'),
(112, 14, '2020-05-23', 'Present'),
(113, 15, '2020-05-23', 'Present'),
(114, 22, '2020-05-23', 'Present'),
(115, 23, '2020-05-23', 'Present'),
(116, 24, '2020-05-23', 'Present'),
(117, 25, '2020-05-23', 'Present'),
(118, 26, '2020-05-23', 'Absent'),
(119, 27, '2020-05-23', 'Present'),
(120, 22, '2020-05-25', 'Absent'),
(121, 23, '2020-05-25', 'Present'),
(122, 24, '2020-05-25', 'Absent'),
(123, 25, '2020-05-25', 'Present'),
(124, 26, '2020-05-25', 'Present'),
(125, 27, '2020-05-25', 'Present'),
(126, 22, '2020-08-19', 'Present'),
(127, 23, '2020-08-19', 'Present'),
(128, 24, '2020-08-19', 'Absent'),
(129, 25, '2020-08-19', 'Present'),
(130, 26, '2020-08-19', 'Present'),
(131, 27, '2020-08-19', 'Absent'),
(138, 17, '2020-09-04', 'Present'),
(139, 3, '2020-09-06', 'Present'),
(140, 4, '2020-09-06', 'Present'),
(141, 5, '2020-09-06', 'Present'),
(142, 6, '2020-09-06', 'Present'),
(143, 7, '2020-09-06', 'Present'),
(144, 8, '2020-09-06', 'Present'),
(145, 9, '2020-09-06', 'Present'),
(146, 10, '2020-09-06', 'Present'),
(147, 11, '2020-09-06', 'Present'),
(148, 12, '2020-09-06', 'Present'),
(149, 13, '2020-09-06', 'Present'),
(150, 14, '2020-09-06', 'Present'),
(151, 15, '2020-09-06', 'Present');

-- --------------------------------------------------------

--
-- Table structure for table `beoadmin`
--

CREATE TABLE `beoadmin` (
  `beoadminid` int(10) NOT NULL,
  `adminname` varchar(100) NOT NULL,
  `loginid` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `beoadmin`
--

INSERT INTO `beoadmin` (`beoadminid`, `adminname`, `loginid`, `password`, `status`) VALUES
(1, 'Pritvish kumar', 'admin', 'admin', 'Active'),
(2, 'Raj kiran', 'rajkirana', '123456789', 'Active'),
(3, 'Ankesh', 'ankesh', 'ankesh', 'Active'),
(4, 'kamal', 'kamal', '123456', 'Active'),
(6, 'Akash sharma', 'akashsharma', '123456789', 'Active'),
(7, 'gopal', 'gopal', 'gopal', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `chef`
--

CREATE TABLE `chef` (
  `chefid` int(10) NOT NULL,
  `chefname` varchar(25) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `cooktype` varchar(50) NOT NULL,
  `chefimg` varchar(100) NOT NULL,
  `chefsalary` double(10,2) NOT NULL,
  `chefprofile` text NOT NULL,
  `bankaccountdetail` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chef`
--

INSERT INTO `chef` (`chefid`, `chefname`, `schoolid`, `cooktype`, `chefimg`, `chefsalary`, `chefprofile`, `bankaccountdetail`, `status`) VALUES
(6, 'Kamala', 9, 'Cook', 'chefuploads/B612_20200524_132804_882.jpg', 3000.00, 'This is expert cook record for mid day meal', 'Bank account : 10054645645456\r\nIFSC : ICIIC1001', 'Active'),
(7, 'Radha', 9, 'Helper', 'chefuploads/B612_20200319_181312_855.jpg', 2000.00, 'Helper', 'Ac No. 154891234605\r\nIFSC : 14246458', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `chefsalary`
--

CREATE TABLE `chefsalary` (
  `chefsalaryid` int(10) NOT NULL,
  `chefid` int(10) NOT NULL,
  `salarymonth` date NOT NULL,
  `salarydate` date NOT NULL,
  `salarydetail` text NOT NULL,
  `basicsalary` double(10,2) NOT NULL,
  `bonussalary` double(10,2) NOT NULL,
  `deductionsalary` double(10,2) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chefsalary`
--

INSERT INTO `chefsalary` (`chefsalaryid`, `chefid`, `salarymonth`, `salarydate`, `salarydetail`, `basicsalary`, `bonussalary`, `deductionsalary`, `status`) VALUES
(1, 3, '2020-03-10', '2020-03-10', 'test rec', 50000.00, 0.00, 0.00, 'Active'),
(2, 9, '0000-00-00', '2020-05-18', 'This is test salary', 5000.00, 500.00, 750.00, 'Active'),
(3, 9, '0000-00-00', '2020-05-18', 'This is test salary', 5000.00, 500.00, 750.00, 'Active'),
(6, 9, '2020-05-01', '2020-05-18', 'This is test salary', 5000.00, 2500.00, 750.00, 'Active'),
(1001, 10, '2020-04-01', '2020-05-19', 'Payment as first salary', 8000.00, 1500.00, 500.00, 'Active'),
(1002, 6, '2020-05-01', '2020-05-24', 'Government of Karnataka', 6000.00, 1500.00, 0.00, 'Active'),
(1003, 11, '2020-08-01', '2020-09-11', 'as a helper', 3000.00, 1000.00, 0.00, 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `city`
--

CREATE TABLE `city` (
  `cityid` int(10) NOT NULL,
  `stateid` int(10) NOT NULL,
  `city` varchar(25) NOT NULL,
  `anynote` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `city`
--

INSERT INTO `city` (`cityid`, `stateid`, `city`, `anynote`, `status`) VALUES
(1, 4, 'Mangalore', 'Beaches and seaport', 'Active'),
(2, 4, 'Mandya', 'Famous for sugarcane', 'Active'),
(4, 2, 'Kochin', 'also known as Cochin', 'Active'),
(5, 2, 'Kasargod', 'Kasaragod is a municipal town and the district headquarters of Kasaragod district of Kerala state in India.', 'Active'),
(6, 4, 'Bangalore', 'Silicone city', 'Active'),
(7, 4, 'Mysore', 'Sandalwood and rich silks', 'Active'),
(8, 5, 'Chennai', 'Chennai city', 'Active'),
(9, 6, 'Sri nagar', '', 'Active'),
(10, 4, 'gulbarga', 'Largest producer of toor dal ', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `complaint`
--

CREATE TABLE `complaint` (
  `complaint_id` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `schoolheadmasterid` int(11) NOT NULL,
  `beoadminid` int(11) NOT NULL,
  `reply_complaint_id` int(11) NOT NULL,
  `complaint_title` varchar(150) NOT NULL,
  `complaint_date` datetime NOT NULL,
  `complaint_note` text NOT NULL,
  `attachments` varchar(100) NOT NULL,
  `complaint_status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `complaint`
--

INSERT INTO `complaint` (`complaint_id`, `schoolid`, `schoolheadmasterid`, `beoadminid`, `reply_complaint_id`, `complaint_title`, `complaint_date`, `complaint_note`, `attachments`, `complaint_status`) VALUES
(1001, 9, 1, 0, 0, 'Hello', '2020-05-11 00:00:00', 'Complaint records', '14400payment1.png', 'Headmaster Reply'),
(1002, 9, 3, 0, 0, 'Hello', '2020-05-13 00:00:00', 'Complaint records', '9081payment1.png', 'New Complaint'),
(1003, 9, 1, 0, 0, '', '2020-05-17 23:27:11', '', '21698', 'New Complaint'),
(1004, 9, 1, 0, 0, 'Please activate your Zoom account', '2020-05-17 23:27:11', '\r\nHello Aravinda Naik M V,\r\nWelcome to Zoom!\r\nTo activate your account please click the button below to verify your email address:', '25619Features and Modules.docx', 'New Complaint'),
(1005, 9, 1, 0, 0, 'Checking in on your Ezoic Premium inv', '2020-05-18 23:27:11', '\r\nI saw that you received a one-time invite to Ezoic Premium but that it\'s expiring soon.  I just wanted to reach out to see if you had any questions about the program.  My advice on it is that you should give it a try and see if it works for you since there is a 14 day free trial and you get all the benefits during that time - including extra revenue, faster reporting and better optimization.  Overall, all of the publishers that I work with that are in the program are extremel', '23886payment.png', 'Headmaster Reply'),
(1007, 9, 1, 0, 1005, '', '2020-05-18 23:42:58', 'Let me know if you have any questions or if you\'re not interested as I\'m only able to invite a select number of publishers.  If you want to give it a try, get started on this page\r\n\r\nThanks so much,\r\n', '1644unnamed.jpg', 'Headmaster Reply'),
(1008, 9, 1, 0, 1005, '', '2020-05-18 23:55:39', 'Dear ARAVINDA M V,\r\n\r\nYour PIN has been successfully reset. Your new PIN is 3587\r\nPlease change your PIN when you login to your account for the first time.\r\n\r\nPlease do not share your PIN with anyone. Our represe', '31847teaslk.txt', 'Headmaster Reply'),
(1009, 9, 1, 0, 1001, '', '2020-05-19 00:06:56', 'Hey ,\r\n\r\nThis past week, I got few questions about website traffic sources, and how do I prioritize them on WPBeginner.', '16562Simple Payroll.txt', 'Headmaster Reply'),
(1010, 0, 0, 1, 1001, '', '2020-05-19 00:30:29', 'Dear aravinda mv,\r\n\r\nBelow is an update on the expiration status of your domain(s):', '11226unnamed.jpg', 'Admin Reply'),
(1011, 0, 0, 1, 1001, '', '2020-05-19 00:33:20', 'test', '23015payment1.png', 'Admin Reply'),
(1012, 9, 1, 0, 1005, '', '2020-05-19 00:37:23', 'test test test', '15419payment.png', 'Admin Reply'),
(1013, 0, 0, 1, 1001, '', '2020-05-19 00:38:59', 'test test', '18609', 'Admin Reply'),
(1014, 9, 1, 0, 1005, '', '2020-05-19 00:41:35', 'toyo', '24855', 'Admin Reply'),
(1015, 9, 1, 0, 1005, '', '2020-05-19 00:44:44', 'santoshgoala690@gmail.com is requesting access to the following document:', '16109', 'Headmaster Reply'),
(1016, 0, 0, 1, 1001, '', '2020-05-19 00:47:10', 'Action', '12578payment1.png', 'Admin Reply'),
(1017, 0, 0, 1, 1001, '', '2020-05-19 00:47:20', 'aaaaaa', '30643', 'Admin Reply'),
(1018, 0, 0, 1, 1001, '', '2020-05-19 00:47:51', 'aaaaaa', '12656', 'Admin Reply'),
(1019, 0, 0, 1, 1001, '', '2020-05-19 00:48:08', 'aaaaaa', '23785', 'Admin Reply'),
(1020, 0, 0, 1, 1001, '', '2020-05-19 00:48:23', 'Hello Aravinda,\r\n\r\nDo you want to become a great public speaker?\r\n\r\nDo you want to be confident on the stage and speak flawlessly in front of 100s of people?', '15726', 'Admin Reply'),
(1021, 9, 1, 0, 1001, '', '2020-05-19 00:48:52', 'If you are not a public speaker yet, I am sure that you either want to become good at public speaking, or you have convinced yourself that speaking on stage is not something that will work for you... and you\'ve given up on it.', '22932', 'Headmaster Reply'),
(1022, 7, 5, 0, 0, 'Stocks empty', '2020-05-19 00:53:47', 'Not getting stocks properly. Kindly check ', '27709payment.png', 'Admin Reply'),
(1023, 0, 0, 1, 1022, '', '2020-05-19 00:54:42', 'we have taken this complaint. We will verify this.', '22084', 'Admin Reply'),
(1024, 7, 5, 0, 1022, '', '2020-05-19 00:55:40', 'Thanks for the reply', '23602', 'Headmaster Reply'),
(1025, 0, 0, 0, 0, 'food', '2020-08-20 17:38:39', 'poor quality of food served', '1796532428', 'New Complaint'),
(1026, 0, 0, 0, 0, 'Stock', '2020-08-20 22:48:24', 'Stock is not delivered in time', '232828011', 'New Complaint'),
(1027, 0, 0, 0, 0, 'food', '2020-09-01 20:18:15', 'food', '1879974400', 'New Complaint'),
(1028, 0, 0, 1, 1022, '', '2020-09-02 22:45:39', 'we will solve the problem as soon as possible', '346231932', 'Admin Reply');

-- --------------------------------------------------------

--
-- Table structure for table `foodcategory`
--

CREATE TABLE `foodcategory` (
  `foodcategoryid` int(10) NOT NULL,
  `foodcategory` varchar(50) NOT NULL,
  `categorydetail` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `foodcategory`
--

INSERT INTO `foodcategory` (`foodcategoryid`, `foodcategory`, `categorydetail`, `status`) VALUES
(4, 'Rice', '', 'Active'),
(5, 'Grains', '', 'Active'),
(6, 'Non Veg', 'Eggs or Chicken', 'Active'),
(7, 'Side Dishes', 'A side dish, sometimes referred to as a side order, side item, or simply a side, is a food item that accompanies the entrÃ©e or main course at a meal.', 'Active'),
(10, 'Oil', '', 'Active'),
(12, 'pulses', 'nutrients', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fooddepartmentofficer`
--

CREATE TABLE `fooddepartmentofficer` (
  `officerid` int(10) NOT NULL,
  `officername` varchar(50) NOT NULL,
  `stateid` int(10) NOT NULL,
  `cityid` int(10) NOT NULL,
  `officercode` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooddepartmentofficer`
--

INSERT INTO `fooddepartmentofficer` (`officerid`, `officername`, `stateid`, `cityid`, `officercode`, `password`, `status`) VALUES
(2, 'tanviu', 2, 1, '10021', '1001', 'Active'),
(3, 'Raj kiran', 2, 1, 'rajkiran', '123456789', 'Active'),
(4, 'Rajani', 4, 10, 'rajani', 'rajani', 'Active'),
(5, 'Rupesh', 4, 7, 'rupesh', 'rupesh', 'Active'),
(6, 'Anand', 4, 1, 'anand', 'anand', 'Active'),
(7, 'jaya kumar', 4, 2, 'jaya kumar', 'jayakumar', 'Active'),
(8, 'Manu kumar', 4, 3, '1001', '1001', 'Active'),
(9, 'Jaya kumar', 2, 4, 'Jay', 'jay', 'Active'),
(10, 'vedanth', 2, 5, 'vedanth', 'vedanth', 'Active'),
(11, 'food department officer', 4, 6, 'fooddepartmentofficer', 'fooddepartmentofficer', 'Active'),
(12, 'shadab', 6, 9, 'shadaab1001', '1234567890', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `fooditem`
--

CREATE TABLE `fooditem` (
  `fooditemid` int(10) NOT NULL,
  `foodcategoryid` int(10) NOT NULL,
  `stateid` int(11) NOT NULL,
  `cityid` int(11) NOT NULL,
  `fooditemname` varchar(25) NOT NULL,
  `measurement` varchar(25) NOT NULL,
  `submeasurement` varchar(25) NOT NULL,
  `itemimg` varchar(100) NOT NULL,
  `itemdescription` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `fooditem`
--

INSERT INTO `fooditem` (`fooditemid`, `foodcategoryid`, `stateid`, `cityid`, `fooditemname`, `measurement`, `submeasurement`, `itemimg`, `itemdescription`, `status`) VALUES
(1, 1, 0, 0, 'test', 'kg', 'gram', 'itemuploads/Kia Seltos.jpg', 'test', 'Active'),
(2, 6, 0, 0, 'Egg', 'pc', 'NIL', 'itemuploads/egg.jpg', 'Some eggs are laid by female animals of many different species, including birds, reptiles, amphibians, mammals, and fish, and have been eaten by humans for thousands of years. Bird and reptile eggs consist of a protective eggshell, albumen, and vitellus, contained within various thin membranes.', 'Active'),
(3, 4, 0, 0, 'White rice', 'KG', 'Gram', 'itemuploads/White Rice.jpg', 'White rice is milled rice that has had its husk, bran, and germ removed. This alters the flavor, texture and appearance of the rice and helps prevent spoilage and extend its storage life. After milling, the rice is polished, resulting in a seed with a bright, white, shiny appearance.', 'Active'),
(5, 7, 0, 0, 'Pickle', 'KG', 'Gram', 'itemuploads/pickle.jpg', 'A pickled cucumber is a cucumber that has been pickled in a brine, vinegar, or other solution and left to ferment for a period of time, by either immersing the cucumbers in an acidic solution or through souring by lacto-fermentation. Pickled cucumbers are often part of mixed pickles.', 'Active'),
(6, 5, 0, 0, 'Mung bean', 'KG', 'Gram', 'itemuploads/greengram.jpeg', 'The mung bean, alternatively known as the green gram, maash, or moong, is a plant species in the legume family. The mung bean is mainly cultivated in East Asia, Southeast Asia and the Indian subcontinent. It is used as an ingredient in both savory and sweet dishes', 'Active'),
(7, 8, 0, 0, 'Pepper', 'Gram', 'NIL', 'itemuploads/Black pepper.jpg', '', 'Active'),
(8, 8, 0, 0, 'Salt', 'KG', 'GRAM', 'itemuploads/salt.jpg', 'Salt is a mineral consisting primarily of sodium chloride, a chemical compound belonging to the larger class of salts; salt in its natural form as a crystalline mineral is known as rock salt or halite. Salt is present in vast quantities in seawater, where it is the main mineral constituent.', 'Active'),
(9, 8, 0, 0, 'Chilli Powder', 'KG', 'Gram', 'itemuploads/dried-red-chilli-powder-500x500.jpg', 'Chili powder is the dried, pulverized fruit of one or more varieties of chili pepper, sometimes with the addition of other spices. It is used as a spice to add pungency and flavor to culinary dishes. In American English, the spelling is usually \"chili\"; in British English, \"chilli\" is used consistently', 'Active'),
(10, 8, 0, 0, 'Garam Masala Powder', 'KG', 'Gram', 'itemuploads/garam-masala-500x500.png', 'Garam masala is a mixture of ground spices used in preparation of Indian foods.', 'Active'),
(11, 9, 0, 0, 'Pulses', 'KG', 'GM', 'itemuploads/Pulses.jpg', 'Pulses', 'Active'),
(12, 10, 0, 0, 'Coconut oil', 'ltr', 'ml', 'itemuploads/well_coconut-articleLarge.jpg', 'Coconut oil good for health', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `middaymeal`
--

CREATE TABLE `middaymeal` (
  `middaymealid` int(10) NOT NULL,
  `day` varchar(20) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `fooditemid` int(10) NOT NULL,
  `totqty` double(10,3) NOT NULL,
  `middaymealdetail` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `middaymeal`
--

INSERT INTO `middaymeal` (`middaymealid`, `day`, `schoolid`, `fooditemid`, `totqty`, `middaymealdetail`, `status`) VALUES
(4, 'Monday', 4, 4, 0.125, 'For boiled rice', 'Active'),
(5, 'Monday', 4, 5, 0.010, 'Pickle for taste', 'Active'),
(6, 'Monday', 4, 9, 0.125, 'for each student', 'Active'),
(7, 'Tuesday', 4, 3, 0.100, 'a', 'Active'),
(14, 'Wednesday', 4, 2, 1.000, 'te', 'Active'),
(16, 'Wednesday', 4, 8, 0.010, 'tes', 'Active'),
(17, 'Tuesday', 4, 5, 0.010, 'te', 'Active'),
(18, 'Monday', 4, 2, 1.000, 'a', 'Active'),
(19, 'Monday', 8, 3, 0.100, 'a', 'Active'),
(21, 'Thursday', 4, 2, 1.000, 's', 'Active'),
(22, 'Monday', 5, 4, 0.500, 'd', 'Active'),
(23, 'Monday', 11, 2, 1.000, 'per student', 'Active'),
(24, 'Monday', 11, 3, 0.100, 'for one student', 'Active'),
(25, 'Monday', 11, 5, 0.010, 'side menu', 'Active'),
(26, 'Monday', 11, 10, 0.250, 'for curry', 'Active'),
(27, 'Friday', 4, 2, 1.000, 'egg', 'Active'),
(28, 'Friday', 4, 4, 0.100, 'rice', 'Active'),
(29, 'Friday', 4, 5, 0.025, 'pickle', 'Active'),
(30, 'Friday', 4, 7, 0.050, 'pepper', 'Active'),
(31, 'Friday', 4, 10, 0.100, 'garam masala', 'Active'),
(32, 'Saturday', 4, 2, 1.000, 'a', 'Active'),
(33, 'Wednesday', 5, 2, 1.000, 'egg', 'Active'),
(34, 'Wednesday', 5, 3, 0.200, 'white rice as main food', 'Active'),
(35, 'Wednesday', 5, 11, 0.050, 'for curry mixer', 'Active'),
(36, 'Wednesday', 5, 12, 0.100, 'for side', 'Active'),
(37, 'Wednesday', 5, 5, 0.010, 'side menu', 'Active'),
(38, 'Saturday', 4, 4, 0.200, 'per student', 'Active'),
(40, 'Tuesday', 4, 2, 1.000, 'Protein', 'Active'),
(42, 'Monday', 5, 11, 1.000, 'pulses', 'Active'),
(43, 'Monday', 9, 3, 0.100, 'Rice', 'Active'),
(44, 'Monday', 9, 5, 0.010, 'Side dish', 'Active'),
(45, 'Monday', 9, 9, 0.010, 'Chilli powder', 'Active'),
(46, 'Monday', 9, 6, 0.010, 'Mung bean', 'Active'),
(47, 'Monday', 9, 12, 0.010, 'Oil', 'Active'),
(48, 'Tuesday', 9, 3, 0.100, 'Rice', 'Active'),
(49, 'Tuesday', 9, 5, 0.010, 'Side dish', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `school`
--

CREATE TABLE `school` (
  `schoolid` int(11) NOT NULL,
  `schoolname` varchar(100) NOT NULL,
  `schooladdress` text NOT NULL,
  `stateid` int(10) NOT NULL,
  `cityid` int(10) NOT NULL,
  `pincode` varchar(10) NOT NULL,
  `schoolimage` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school`
--

INSERT INTO `school` (`schoolid`, `schoolname`, `schooladdress`, `stateid`, `cityid`, `pincode`, `schoolimage`, `status`) VALUES
(4, 'SNS school', '3rd floor', 4, 2, '575002', 'schooluploads/snsschool.jpg', 'Active'),
(5, 'Canara school', 'Jail road', 4, 3, '569874', 'schooluploads/735_1445923103CC_New deepika 1212 edt.jpg', 'Active'),
(6, 'Mandana Kasargod School', '4th block ', 2, 5, '589633', 'schooluploads/kasargod school.jpg', 'Active'),
(7, 'Bangalore govt school', ' Bangalore Mirror Karnataka, Karnataka, The model govt school', 4, 6, '658478', 'schooluploads/661212.jpg', 'Active'),
(8, 'J.S.S. PUBLIC SCHOOL', 'SIDDARTHA NAGAR MYSORE', 4, 7, '588441', 'schooluploads/jss.jpg', 'Active'),
(9, 'Sharada Karnataka Kanya Shala', 'Lingampally', 4, 6, '687442', 'schooluploads/nruputunga-high-school-1495170061-1.png', 'Active'),
(11, 'PRCI school, srinagar', 'Ajanth colony, srinagar', 6, 9, '602365', 'schooluploads/download.jpg', 'Active'),
(13, 'JMJ SCHOOL', '#303, nea campus', 4, 1, '574990', 'schooluploads/defaultimg.png', 'Active'),
(14, 'Canara school', 'Jail road', 4, 10, '569874', 'schooluploads/Best-School-in-Meerut-1.png', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `schoolheadmaster`
--

CREATE TABLE `schoolheadmaster` (
  `schoolheadmasterid` int(10) NOT NULL,
  `headmastername` varchar(50) NOT NULL,
  `headmasterimg` varchar(100) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `headmastercode` varchar(25) NOT NULL,
  `password` varchar(100) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `schoolheadmaster`
--

INSERT INTO `schoolheadmaster` (`schoolheadmasterid`, `headmastername`, `headmasterimg`, `schoolid`, `headmastercode`, `password`, `status`) VALUES
(1, 'schoolheadmaster', 'headmasteruploads/Chandan-Kumar-Maity-is-a-wall-of-support-for-many-students..jpg', 9, 'schoolheadmaster', 'schoolheadmaster', 'Active'),
(2, 'raju', 'headmasteruploads/raj.jpg', 4, '2004', 'q1w2e3r4', 'Active'),
(3, 'yograj sangli', 'headmasteruploads/5742data.jpg', 6, 'yograj', 'mynewpass', 'Active'),
(4, 'Sharan singh', 'headmasteruploads/schoolPic06374.jpg', 5, 'sharan', 'sharan', 'Active'),
(5, 'Acharya kumar', 'headmasteruploads/-rHlMm7Q_400x400.jpeg', 7, 'acharya', 'acharya', 'Active'),
(6, 'Poornesh', 'headmasteruploads/ff4263ca-9bf0-4150-9f78-3c51536053e1.jpg', 5, 'poornesh', 'poornesh', 'Active'),
(7, 'Vishal', 'headmasteruploads/images.jpg', 8, 'vishal', 'vishal', 'Active'),
(8, 'Rajaram', 'headmasteruploads/author.jpg', 6, 'rajaram10', '123456789', 'Active'),
(9, 'Arshad saja', 'headmasteruploads/profile.jpg', 11, 'arshad1001', '123456789', 'Active'),
(10, 'radha', '', 12, '123456', '1234567', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `stateid` int(10) NOT NULL,
  `state` varchar(25) NOT NULL,
  `anynote` text NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`stateid`, `state`, `anynote`, `status`) VALUES
(4, 'Karnataka', 'Karnataka state', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `stock`
--

CREATE TABLE `stock` (
  `stockid` int(11) NOT NULL,
  `stock_invoice_id` int(11) NOT NULL,
  `officerid` int(11) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `studentid` int(10) NOT NULL,
  `fooditemid` int(10) NOT NULL,
  `stocktype` varchar(50) NOT NULL,
  `entrydate` date NOT NULL,
  `stockqty` double(10,3) NOT NULL,
  `tcost` double NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock`
--

INSERT INTO `stock` (`stockid`, `stock_invoice_id`, `officerid`, `schoolid`, `studentid`, `fooditemid`, `stocktype`, `entrydate`, `stockqty`, `tcost`, `status`) VALUES
(98, 1005, 7, 4, 0, 4, 'Entry', '2020-05-23', 6.000, 100, 'Received'),
(99, 1005, 7, 4, 0, 3, 'Entry', '2020-05-23', 2.000, 250, 'Received'),
(100, 1005, 7, 4, 0, 2, 'Entry', '2020-05-23', 75.000, 200, 'Received'),
(101, 1005, 7, 4, 0, 5, 'Entry', '2020-05-23', 14.000, 500, 'Received'),
(102, 1005, 7, 4, 0, 9, 'Entry', '2020-05-23', 2.000, 100, 'Received'),
(103, 1005, 7, 4, 0, 8, 'Entry', '2020-05-23', 430.000, 5000, 'Received'),
(104, 1005, 7, 4, 0, 7, 'Entry', '2020-05-23', 1.000, 100, 'Received'),
(105, 1005, 7, 4, 0, 10, 'Entry', '2020-05-23', 2.000, 100, 'Received'),
(106, 0, 0, 4, 0, 2, 'Spent', '2020-05-23', 11.000, 0, 'Paid'),
(107, 0, 0, 4, 0, 4, 'Spent', '2020-05-23', 2.200, 0, 'Paid'),
(108, 1006, 7, 4, 0, 4, 'Entry', '2020-09-02', 10.000, 500, 'Delivered'),
(109, 1006, 7, 4, 0, 3, 'Entry', '2020-09-02', 20.000, 200, 'Delivered'),
(110, 1006, 7, 4, 0, 2, 'Entry', '2020-09-02', 200.000, 500, 'Delivered'),
(111, 1006, 7, 4, 0, 5, 'Entry', '2020-09-02', 30.000, 100, 'Delivered'),
(112, 1006, 7, 4, 0, 9, 'Entry', '2020-09-02', 30.000, 200, 'Delivered'),
(113, 1006, 7, 4, 0, 8, 'Entry', '2020-09-02', 500.000, 700, 'Delivered'),
(114, 1006, 7, 4, 0, 7, 'Entry', '2020-09-02', 5.000, 20, 'Delivered'),
(115, 1006, 7, 4, 0, 10, 'Entry', '2020-09-02', 20.000, 500, 'Delivered'),
(116, 1007, 7, 4, 0, 4, 'Entry', '2020-09-02', 5.525, 500, 'Received'),
(117, 1007, 7, 4, 0, 3, 'Entry', '2020-09-02', 1.300, 300, 'Received'),
(118, 1007, 7, 4, 0, 2, 'Entry', '2020-09-02', 78.000, 500, 'Received'),
(119, 1007, 7, 4, 0, 5, 'Entry', '2020-09-02', 13.455, 200, 'Received'),
(120, 1007, 7, 4, 0, 9, 'Entry', '2020-09-02', 1.620, 100, 'Received'),
(121, 1007, 7, 4, 0, 8, 'Entry', '2020-09-02', 300.000, 200, 'Received'),
(122, 1007, 7, 4, 0, 7, 'Entry', '2020-09-02', 0.650, 400, 'Received'),
(123, 1007, 7, 4, 0, 10, 'Entry', '2020-09-02', 1.300, 300, 'Received'),
(124, 1008, 7, 4, 0, 4, 'Entry', '2020-09-06', 100.000, 500, 'Received'),
(125, 1008, 7, 4, 0, 3, 'Entry', '2020-09-06', 20.000, 600, 'Received'),
(126, 1008, 7, 4, 0, 2, 'Entry', '2020-09-06', 10.000, 700, 'Received'),
(127, 1008, 7, 4, 0, 5, 'Entry', '2020-09-06', 20.000, 800, 'Received'),
(128, 1008, 7, 4, 0, 9, 'Entry', '2020-09-06', 49.000, 900, 'Received'),
(129, 1008, 7, 4, 0, 8, 'Entry', '2020-09-06', 50.000, 1000, 'Received'),
(130, 1008, 7, 4, 0, 7, 'Entry', '2020-09-06', 60.000, 2000, 'Received'),
(131, 1008, 7, 4, 0, 10, 'Entry', '2020-09-06', 70.000, 3000, 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `stock_invoice`
--

CREATE TABLE `stock_invoice` (
  `stock_invoice_id` int(11) NOT NULL,
  `officerid` int(11) NOT NULL,
  `schoolid` int(11) NOT NULL,
  `stocktype` varchar(25) NOT NULL,
  `entrydate` date NOT NULL,
  `totalcost` double NOT NULL,
  `invoice_status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_invoice`
--

INSERT INTO `stock_invoice` (`stock_invoice_id`, `officerid`, `schoolid`, `stocktype`, `entrydate`, `totalcost`, `invoice_status`) VALUES
(6, 7, 4, 'Entry', '2020-05-21', 1460, 'Paid'),
(1001, 7, 4, 'Entry', '2020-05-21', 2155, 'Paid'),
(1002, 7, 4, 'Entry', '2020-05-22', 100, 'Received'),
(1003, 7, 4, 'Entry', '2020-05-22', 300, 'Received'),
(1004, 8, 5, 'Entry', '2020-05-20', 910, 'Received'),
(1005, 7, 4, 'Entry', '2020-05-23', 6350, 'Received'),
(1006, 7, 4, 'Entry', '2020-09-02', 2720, 'Delivered'),
(1007, 7, 4, 'Entry', '2020-09-02', 2500, 'Received'),
(1008, 7, 4, 'Entry', '2020-09-06', 9500, 'Received');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `studentid` int(10) NOT NULL,
  `schoolid` int(10) NOT NULL,
  `studentname` varchar(50) NOT NULL,
  `rollno` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL,
  `studentclass` varchar(25) NOT NULL,
  `section` varchar(25) NOT NULL,
  `dateofbirth` date NOT NULL,
  `profileimg` varchar(100) NOT NULL,
  `studentaddress` text NOT NULL,
  `contactnumber` varchar(15) NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`studentid`, `schoolid`, `studentname`, `rollno`, `password`, `studentclass`, `section`, `dateofbirth`, `profileimg`, `studentaddress`, `contactnumber`, `status`) VALUES
(1, 7, 'Raj Kiran', '889966', '123456789', '', '', '0000-00-00', '', '', '', 'Active'),
(2, 7, 'Raj kiran', '123456789', '123456789', 'abc', '4', '2003-12-31', 'studentuploads/Jellyfish.jpg', '3rd floor, city light', '78945612030', 'Active'),
(3, 4, 'Rajesh', '123000', '123456', '1st Standard', 'A', '2005-02-01', 'studentuploads/t3.jpg', '3rd floor,\r\nCity light building, Mangalroe', '7894561230', 'Active'),
(4, 4, 'Akash', '78900', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(5, 4, 'Ananth', '11156789', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(6, 4, 'Sapalya', '10001', '10001', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(7, 4, 'Karan', '10002', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(8, 4, 'Krishna', '10003', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(9, 4, 'manohar', '10004', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(10, 4, 'Rakesh', '10005', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t3.jpg', '3rd floor, city light', '9877456123', 'Active'),
(11, 4, 'Ahalya', '10006', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/Jellyfish.jpg', '3rd floor, city light', '9877456123', 'Active'),
(12, 4, 'Ajinkya', '10007', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(13, 4, 'Krithi', '10008', 'q1w2e3r4', '2nd Standard', 'A', '2008-04-09', 'studentuploads/deepika-padukone-Padmaavat .jpg', '3rd floor,\r\ncity light,\r\nMangalore', '9877456123', ''),
(14, 4, 'Kristita', '10009', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/deepika-padukone-Padmaavat .jpg', '3rd floor, city light', '9877456123', 'Active'),
(15, 4, 'nandan', '10010', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/Desert.jpg', '3rd floor, city light', '9877456123', 'Active'),
(16, 5, 'Rakesh', '100051', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t3.jpg', '3rd floor, city light', '9877456123', 'Active'),
(17, 5, 'Ahalya', '100062', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/Jellyfish.jpg', '3rd floor, city light', '9877456123', 'Active'),
(18, 5, 'Ajinkya', '100073', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/t1.jpg', '3rd floor, city light', '9877456123', 'Active'),
(19, 5, 'Krithi', '100084', 'q1w2e3r4', '2nd Standard', 'A', '2008-04-09', 'studentuploads/deepika-padukone-Padmaavat .jpg', '3rd floor,\r\ncity light,\r\nMangalore', '9877456123', ''),
(20, 5, 'Kristita', '100095', '1234567890', '2nd Standard', 'A', '2008-04-09', 'studentuploads/deepika-padukone-Padmaavat .jpg', '3rd floor, city light', '9877456123', 'Active'),
(21, 5, 'nandan', '100106', '1234567890', '8th Standard', 'A', '2008-04-09', 'studentuploads/Desert.jpg', '3rd floor, city light', '9877456123', 'Active'),
(22, 9, 'Sonia', '23', '123456', '7th Standard', 'B', '2017-11-16', 'studentuploads/B612_20200319_180638_620.jpg', 'Neharunagar , Benglore', '1234567894', 'Active'),
(23, 9, 'Dimple', '12', '123456', '3rd Standard', 'A', '2014-03-21', 'studentuploads/20200523_141636_edited.jpg', 'Saraswati nagar, Bangalore', '9234543216', 'Active'),
(24, 9, 'Anupam', '3', '123456', '3rd Standard', 'B', '2016-11-16', 'studentuploads/20200523_141525_edited.jpg', 'Gandhinagar, Bangalore', '9876543021', 'Active'),
(25, 9, 'Vinod', '45', '123456', '4th Standard', 'A', '2016-06-16', 'studentuploads/20200523_141607_edited.jpg', 'Ghandhi nagar, Banglore', '7865432189', 'Active'),
(26, 9, 'Arya', '4', '123456', '5th Standard', 'A', '2014-09-19', 'studentuploads/20200523_141652_edited.jpg', 'Vidya Nagar, Bangalore', '7088532468', 'Active'),
(27, 9, 'Vikas', '46', '123456', '5th Standard', 'A', '2015-10-22', 'studentuploads/20200523_141714_edited.jpg', 'Vinobha nagar, Banglore', '7654321889', 'Active'),
(28, 5, 'Deghanth', '9', 'sharan', '4th Standard', 'F', '2020-09-04', '', 'Nagamangla', '7352892752', 'Active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`attendanceid`);

--
-- Indexes for table `beoadmin`
--
ALTER TABLE `beoadmin`
  ADD PRIMARY KEY (`beoadminid`);

--
-- Indexes for table `chef`
--
ALTER TABLE `chef`
  ADD PRIMARY KEY (`chefid`);

--
-- Indexes for table `chefsalary`
--
ALTER TABLE `chefsalary`
  ADD PRIMARY KEY (`chefsalaryid`);

--
-- Indexes for table `city`
--
ALTER TABLE `city`
  ADD PRIMARY KEY (`cityid`);

--
-- Indexes for table `complaint`
--
ALTER TABLE `complaint`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `foodcategory`
--
ALTER TABLE `foodcategory`
  ADD PRIMARY KEY (`foodcategoryid`);

--
-- Indexes for table `fooddepartmentofficer`
--
ALTER TABLE `fooddepartmentofficer`
  ADD PRIMARY KEY (`officerid`);

--
-- Indexes for table `fooditem`
--
ALTER TABLE `fooditem`
  ADD PRIMARY KEY (`fooditemid`);

--
-- Indexes for table `middaymeal`
--
ALTER TABLE `middaymeal`
  ADD PRIMARY KEY (`middaymealid`);

--
-- Indexes for table `school`
--
ALTER TABLE `school`
  ADD PRIMARY KEY (`schoolid`);

--
-- Indexes for table `schoolheadmaster`
--
ALTER TABLE `schoolheadmaster`
  ADD PRIMARY KEY (`schoolheadmasterid`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`stateid`);

--
-- Indexes for table `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`stockid`);

--
-- Indexes for table `stock_invoice`
--
ALTER TABLE `stock_invoice`
  ADD PRIMARY KEY (`stock_invoice_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `attendanceid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `beoadmin`
--
ALTER TABLE `beoadmin`
  MODIFY `beoadminid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chef`
--
ALTER TABLE `chef`
  MODIFY `chefid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `chefsalary`
--
ALTER TABLE `chefsalary`
  MODIFY `chefsalaryid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1004;

--
-- AUTO_INCREMENT for table `city`
--
ALTER TABLE `city`
  MODIFY `cityid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `complaint`
--
ALTER TABLE `complaint`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1029;

--
-- AUTO_INCREMENT for table `foodcategory`
--
ALTER TABLE `foodcategory`
  MODIFY `foodcategoryid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fooddepartmentofficer`
--
ALTER TABLE `fooddepartmentofficer`
  MODIFY `officerid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `fooditem`
--
ALTER TABLE `fooditem`
  MODIFY `fooditemid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `middaymeal`
--
ALTER TABLE `middaymeal`
  MODIFY `middaymealid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `school`
--
ALTER TABLE `school`
  MODIFY `schoolid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `schoolheadmaster`
--
ALTER TABLE `schoolheadmaster`
  MODIFY `schoolheadmasterid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `stateid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `stock`
--
ALTER TABLE `stock`
  MODIFY `stockid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=132;

--
-- AUTO_INCREMENT for table `stock_invoice`
--
ALTER TABLE `stock_invoice`
  MODIFY `stock_invoice_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1009;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `studentid` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
