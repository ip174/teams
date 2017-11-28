-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 25, 2017 at 09:01 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `techno05_team_network`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE IF NOT EXISTS `admins` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `name`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', '$2y$10$Qw9E7VGCPdioU9IYzpjWjuTPTVMFxw7eVTdQ1J.YC5YyigmBDWgvu', 'eSDeMadBSvGznGeTwR8We6E13EJvqGXjueqbHDD1qnyNz4NEejn4kgvj2kLY', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `budgets`
--

CREATE TABLE IF NOT EXISTS `budgets` (
  `id` int(11) NOT NULL,
  `budget_type` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `budget_type`, `status`) VALUES
(1, 'All', '1'),
(2, '0-5000', '1'),
(3, '5000 - 10000', '1'),
(4, '10000+', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category_subcategory`
--

CREATE TABLE IF NOT EXISTS `category_subcategory` (
  `category_id` int(11) NOT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=176 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_subcategory`
--

INSERT INTO `category_subcategory` (`category_id`, `parent_category_id`, `category_name`, `status`) VALUES
(1, 0, 'Design & Creative', '1'),
(2, 0, 'Web & Mobile', '1'),
(3, 0, 'Writing', '1'),
(4, 0, 'Marketing & Sales', '1'),
(5, 0, 'Audio & Video', '1'),
(6, 0, 'Photography', '1'),
(7, 0, 'Software Development', '1'),
(8, 0, 'Search Marketing', '1'),
(9, 0, 'Translation', '1'),
(10, 0, 'Social Marketing', '1'),
(11, 0, 'Tutorials', '1'),
(12, 0, 'Admin', '1'),
(13, 1, 'Logo Design', '1'),
(14, 1, 'Illustration & Graphics', '1'),
(15, 1, 'Website Design', '1'),
(16, 1, 'T-shirt & Clothing', '1'),
(17, 1, '3D Design', '1'),
(18, 1, 'Brochure', '1'),
(19, 1, 'Flyer & Leaflet', '1'),
(20, 1, 'CAD', '1'),
(21, 1, 'Label & Packaging', '1'),
(22, 1, 'Presentation', '1'),
(23, 1, 'Book & Magazine', '1'),
(24, 1, 'Interior Design', '1'),
(25, 1, 'Banner Ad', '1'),
(26, 1, 'Cartoons & Comics', '1'),
(27, 1, 'Business Card & Stationery', '1'),
(28, 1, 'Email & Newsletter', '1'),
(29, 1, 'Social Media', '1'),
(30, 1, 'Other', '1'),
(31, 2, 'Wordpress', '1'),
(32, 2, 'Custom Website', '1'),
(33, 2, 'E-commerce', '1'),
(34, 2, 'PHP', '1'),
(35, 2, 'HTML/CSS', '1'),
(36, 2, 'Magento', '1'),
(37, 2, 'Theme/Template', '1'),
(38, 2, 'Javascript/jQuery/Ajax', '1'),
(39, 2, 'Integration & Administration', '1'),
(40, 2, 'Database', '1'),
(41, 2, 'Blog', '1'),
(42, 2, 'Joomla', '1'),
(43, 2, 'Opencart', '1'),
(44, 2, 'Social Media', '1'),
(45, 2, 'Drupal', '1'),
(46, 2, 'Prestashop', '1'),
(47, 2, 'Other', '1'),
(48, 3, 'Blog & Article Writing', '1'),
(49, 3, 'Website Content', '1'),
(50, 3, 'Copywriting', '1'),
(51, 3, 'Editing & Proofreading', '1'),
(52, 3, 'Creative Writing', '1'),
(53, 3, 'Technical Writing', '1'),
(54, 3, 'CV & Cover Letter', '1'),
(55, 3, 'Ghost Writing', '1'),
(56, 3, 'Product Description & Review', '1'),
(57, 3, 'Report Writing', '1'),
(58, 3, 'Screen & Script writing', '1'),
(59, 3, 'Company Profile', '1'),
(60, 3, 'E-book', '1'),
(61, 3, 'Email & Newsletter', '1'),
(62, 3, 'Letter', '1'),
(63, 3, 'Other', '1'),
(64, 4, 'Lead Generation', '1'),
(65, 4, 'Email Marketing', '1'),
(66, 4, 'Telemarketing', '1'),
(67, 4, 'General Communications', '1'),
(68, 4, 'Press & Media Relations', '1'),
(69, 4, 'Viral Campaigns', '1'),
(70, 4, 'Display Advertising', '1'),
(71, 4, 'Offline Marketing', '1'),
(72, 4, 'Press Releases', '1'),
(73, 4, 'BTL Advertising', '1'),
(74, 4, 'ATL Advertising', '1'),
(75, 4, 'Other', '1'),
(76, 5, 'Video Production', '1'),
(77, 5, 'Photo Retouching/Editing', '1'),
(78, 5, 'Video Editing', '1'),
(79, 5, 'Promotional Videos', '1'),
(80, 5, 'Voice-over', '1'),
(81, 5, 'Videography', '1'),
(82, 5, 'Presenting/Acting', '1'),
(83, 5, 'Music Production', '1'),
(84, 5, 'Audio Editing', '1'),
(85, 5, 'Podcasts', '1'),
(86, 5, 'Screencasts', '1'),
(87, 5, 'Other', '1'),
(88, 6, 'Photoshoot', '1'),
(89, 6, 'Indoord Photography', '1'),
(90, 6, 'Outdoor Photography', '1'),
(91, 6, 'Product Photography', '1'),
(92, 6, 'Technical Photography', '1'),
(93, 6, 'Photoshop', '1'),
(94, 6, 'Photo retouch', '1'),
(95, 6, 'Other', '1'),
(96, 7, 'Application Development', '1'),
(97, 7, 'Integration & API, General Programming', '1'),
(98, 7, '.NET', '1'),
(99, 7, 'Script', '1'),
(100, 7, 'C / C++', '1'),
(101, 7, 'Programming', '1'),
(102, 7, 'Database Development', '1'),
(103, 7, 'ERP/CRM', '1'),
(104, 7, 'User Interface', '1'),
(105, 7, 'Java Programming', '1'),
(106, 7, 'Server & System Administration Desktop Application', '1'),
(107, 7, 'Game Development', '1'),
(108, 7, 'Plug-in & Extension', '1'),
(109, 7, 'Software Testing', '1'),
(110, 7, 'Visual Basic', '1'),
(111, 7, 'Other', '1'),
(112, 8, 'Link Building', '1'),
(113, 8, 'On-site SEO', '1'),
(114, 8, 'Google Adwords', '1'),
(115, 8, 'Keyword Research', '1'),
(116, 8, 'Article Submission', '1'),
(117, 8, 'SEO Training', '1'),
(118, 8, 'Bing/Yahoo PPC', '1'),
(119, 8, 'Other', '1'),
(120, 9, 'Arabic', '1'),
(121, 9, 'Bengali', '1'),
(122, 9, 'Chinese (Cantonese)', '1'),
(123, 9, 'Chinese Mandarin (Simplified)', '1'),
(124, 9, 'English (UK)', '1'),
(125, 9, 'English (US)', '1'),
(126, 9, 'Flemish', '1'),
(127, 9, 'French', '1'),
(128, 9, 'German', '1'),
(129, 9, 'Greek', '1'),
(130, 9, 'Hebrew', '1'),
(131, 9, 'Hindi', '1'),
(132, 9, 'Italian', '1'),
(133, 9, 'Japanese', '1'),
(134, 9, 'Korean', '1'),
(135, 9, 'Polish', '1'),
(136, 9, 'Portuguese (Brazil)', '1'),
(137, 9, 'Portuguese (Portugal)', '1'),
(138, 9, 'Russian', '1'),
(139, 9, 'Spanish (Latin American)', '1'),
(140, 9, 'Spanish (Spain)', '1'),
(141, 9, 'Swedish', '1'),
(142, 9, 'Tamil', '1'),
(143, 9, 'Turkish', '1'),
(144, 9, 'Urdu', '1'),
(145, 9, 'Other', '1'),
(146, 10, 'Blogosphere', '1'),
(147, 10, 'Community Management', '1'),
(148, 10, 'Facebook', '1'),
(149, 10, 'Google+', '1'),
(150, 10, 'LinkedIn', '1'),
(151, 10, 'Social Media Strategy', '1'),
(152, 10, 'Twitter', '1'),
(153, 10, 'Virals', '1'),
(154, 10, 'YouTube', '1'),
(155, 10, 'Other', '1'),
(156, 11, 'Accounting & Finance', '1'),
(157, 11, 'Design', '1'),
(158, 11, 'Fun & Bizarre', '1'),
(159, 11, 'Languages', '1'),
(160, 11, 'Other - How To', '1'),
(161, 11, 'Programming', '1'),
(162, 11, 'Software', '1'),
(163, 11, 'Video & Photo', '1'),
(164, 11, 'Writing', '1'),
(165, 11, 'Other', '1'),
(166, 12, 'Customer Service', '1'),
(167, 12, 'Data Entry', '1'),
(168, 12, 'Email Support', '1'),
(169, 12, 'Office Management', '1'),
(170, 12, 'Personal Assistance', '1'),
(171, 12, 'Presentations', '1'),
(172, 12, 'Telephone Support', '1'),
(173, 12, 'Transcription', '1'),
(174, 12, 'Virtual Assistance', '1'),
(175, 12, 'Word Processing', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(10) unsigned NOT NULL,
  `state_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE IF NOT EXISTS `countries` (
  `id` int(10) unsigned NOT NULL,
  `code` varchar(5) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '',
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=246 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `code`, `name`) VALUES
(1, 'AF', 'Afghanistan'),
(2, 'AL', 'Albania'),
(3, 'DZ', 'Algeria'),
(4, 'DS', 'American Samoa'),
(5, 'AD', 'Andorra'),
(6, 'AO', 'Angola'),
(7, 'AI', 'Anguilla'),
(8, 'AQ', 'Antarctica'),
(9, 'AG', 'Antigua and Barbuda'),
(10, 'AR', 'Argentina'),
(11, 'AM', 'Armenia'),
(12, 'AW', 'Aruba'),
(13, 'AU', 'Australia'),
(14, 'AT', 'Austria'),
(15, 'AZ', 'Azerbaijan'),
(16, 'BS', 'Bahamas'),
(17, 'BH', 'Bahrain'),
(18, 'BD', 'Bangladesh'),
(19, 'BB', 'Barbados'),
(20, 'BY', 'Belarus'),
(21, 'BE', 'Belgium'),
(22, 'BZ', 'Belize'),
(23, 'BJ', 'Benin'),
(24, 'BM', 'Bermuda'),
(25, 'BT', 'Bhutan'),
(26, 'BO', 'Bolivia'),
(27, 'BA', 'Bosnia and Herzegovina'),
(28, 'BW', 'Botswana'),
(29, 'BV', 'Bouvet Island'),
(30, 'BR', 'Brazil'),
(31, 'IO', 'British Indian Ocean Territory'),
(32, 'BN', 'Brunei Darussalam'),
(33, 'BG', 'Bulgaria'),
(34, 'BF', 'Burkina Faso'),
(35, 'BI', 'Burundi'),
(36, 'KH', 'Cambodia'),
(37, 'CM', 'Cameroon'),
(38, 'CA', 'Canada'),
(39, 'CV', 'Cape Verde'),
(40, 'KY', 'Cayman Islands'),
(41, 'CF', 'Central African Republic'),
(42, 'TD', 'Chad'),
(43, 'CL', 'Chile'),
(44, 'CN', 'China'),
(45, 'CX', 'Christmas Island'),
(46, 'CC', 'Cocos (Keeling) Islands'),
(47, 'CO', 'Colombia'),
(48, 'KM', 'Comoros'),
(49, 'CG', 'Congo'),
(50, 'CK', 'Cook Islands'),
(51, 'CR', 'Costa Rica'),
(52, 'HR', 'Croatia (Hrvatska)'),
(53, 'CU', 'Cuba'),
(54, 'CY', 'Cyprus'),
(55, 'CZ', 'Czech Republic'),
(56, 'DK', 'Denmark'),
(57, 'DJ', 'Djibouti'),
(58, 'DM', 'Dominica'),
(59, 'DO', 'Dominican Republic'),
(60, 'TP', 'East Timor'),
(61, 'EC', 'Ecuador'),
(62, 'EG', 'Egypt'),
(63, 'SV', 'El Salvador'),
(64, 'GQ', 'Equatorial Guinea'),
(65, 'ER', 'Eritrea'),
(66, 'EE', 'Estonia'),
(67, 'ET', 'Ethiopia'),
(68, 'FK', 'Falkland Islands (Malvinas)'),
(69, 'FO', 'Faroe Islands'),
(70, 'FJ', 'Fiji'),
(71, 'FI', 'Finland'),
(72, 'FR', 'France'),
(73, 'FX', 'France, Metropolitan'),
(74, 'GF', 'French Guiana'),
(75, 'PF', 'French Polynesia'),
(76, 'TF', 'French Southern Territories'),
(77, 'GA', 'Gabon'),
(78, 'GM', 'Gambia'),
(79, 'GE', 'Georgia'),
(80, 'DE', 'Germany'),
(81, 'GH', 'Ghana'),
(82, 'GI', 'Gibraltar'),
(83, 'GK', 'Guernsey'),
(84, 'GR', 'Greece'),
(85, 'GL', 'Greenland'),
(86, 'GD', 'Grenada'),
(87, 'GP', 'Guadeloupe'),
(88, 'GU', 'Guam'),
(89, 'GT', 'Guatemala'),
(90, 'GN', 'Guinea'),
(91, 'GW', 'Guinea-Bissau'),
(92, 'GY', 'Guyana'),
(93, 'HT', 'Haiti'),
(94, 'HM', 'Heard and Mc Donald Islands'),
(95, 'HN', 'Honduras'),
(96, 'HK', 'Hong Kong'),
(97, 'HU', 'Hungary'),
(98, 'IS', 'Iceland'),
(99, 'IN', 'India'),
(100, 'IM', 'Isle of Man'),
(101, 'ID', 'Indonesia'),
(102, 'IR', 'Iran (Islamic Republic of)'),
(103, 'IQ', 'Iraq'),
(104, 'IE', 'Ireland'),
(105, 'IL', 'Israel'),
(106, 'IT', 'Italy'),
(107, 'CI', 'Ivory Coast'),
(108, 'JE', 'Jersey'),
(109, 'JM', 'Jamaica'),
(110, 'JP', 'Japan'),
(111, 'JO', 'Jordan'),
(112, 'KZ', 'Kazakhstan'),
(113, 'KE', 'Kenya'),
(114, 'KI', 'Kiribati'),
(115, 'KP', 'Korea, Democratic People''s Republic of'),
(116, 'KR', 'Korea, Republic of'),
(117, 'XK', 'Kosovo'),
(118, 'KW', 'Kuwait'),
(119, 'KG', 'Kyrgyzstan'),
(120, 'LA', 'Lao People''s Democratic Republic'),
(121, 'LV', 'Latvia'),
(122, 'LB', 'Lebanon'),
(123, 'LS', 'Lesotho'),
(124, 'LR', 'Liberia'),
(125, 'LY', 'Libyan Arab Jamahiriya'),
(126, 'LI', 'Liechtenstein'),
(127, 'LT', 'Lithuania'),
(128, 'LU', 'Luxembourg'),
(129, 'MO', 'Macau'),
(130, 'MK', 'Macedonia'),
(131, 'MG', 'Madagascar'),
(132, 'MW', 'Malawi'),
(133, 'MY', 'Malaysia'),
(134, 'MV', 'Maldives'),
(135, 'ML', 'Mali'),
(136, 'MT', 'Malta'),
(137, 'MH', 'Marshall Islands'),
(138, 'MQ', 'Martinique'),
(139, 'MR', 'Mauritania'),
(140, 'MU', 'Mauritius'),
(141, 'TY', 'Mayotte'),
(142, 'MX', 'Mexico'),
(143, 'FM', 'Micronesia, Federated States of'),
(144, 'MD', 'Moldova, Republic of'),
(145, 'MC', 'Monaco'),
(146, 'MN', 'Mongolia'),
(147, 'ME', 'Montenegro'),
(148, 'MS', 'Montserrat'),
(149, 'MA', 'Morocco'),
(150, 'MZ', 'Mozambique'),
(151, 'MM', 'Myanmar'),
(152, 'NA', 'Namibia'),
(153, 'NR', 'Nauru'),
(154, 'NP', 'Nepal'),
(155, 'NL', 'Netherlands'),
(156, 'AN', 'Netherlands Antilles'),
(157, 'NC', 'New Caledonia'),
(158, 'NZ', 'New Zealand'),
(159, 'NI', 'Nicaragua'),
(160, 'NE', 'Niger'),
(161, 'NG', 'Nigeria'),
(162, 'NU', 'Niue'),
(163, 'NF', 'Norfolk Island'),
(164, 'MP', 'Northern Mariana Islands'),
(165, 'NO', 'Norway'),
(166, 'OM', 'Oman'),
(167, 'PK', 'Pakistan'),
(168, 'PW', 'Palau'),
(169, 'PS', 'Palestine'),
(170, 'PA', 'Panama'),
(171, 'PG', 'Papua New Guinea'),
(172, 'PY', 'Paraguay'),
(173, 'PE', 'Peru'),
(174, 'PH', 'Philippines'),
(175, 'PN', 'Pitcairn'),
(176, 'PL', 'Poland'),
(177, 'PT', 'Portugal'),
(178, 'PR', 'Puerto Rico'),
(179, 'QA', 'Qatar'),
(180, 'RE', 'Reunion'),
(181, 'RO', 'Romania'),
(182, 'RU', 'Russian Federation'),
(183, 'RW', 'Rwanda'),
(184, 'KN', 'Saint Kitts and Nevis'),
(185, 'LC', 'Saint Lucia'),
(186, 'VC', 'Saint Vincent and the Grenadines'),
(187, 'WS', 'Samoa'),
(188, 'SM', 'San Marino'),
(189, 'ST', 'Sao Tome and Principe'),
(190, 'SA', 'Saudi Arabia'),
(191, 'SN', 'Senegal'),
(192, 'RS', 'Serbia'),
(193, 'SC', 'Seychelles'),
(194, 'SL', 'Sierra Leone'),
(195, 'SG', 'Singapore'),
(196, 'SK', 'Slovakia'),
(197, 'SI', 'Slovenia'),
(198, 'SB', 'Solomon Islands'),
(199, 'SO', 'Somalia'),
(200, 'ZA', 'South Africa'),
(201, 'GS', 'South Georgia South Sandwich Islands'),
(202, 'ES', 'Spain'),
(203, 'LK', 'Sri Lanka'),
(204, 'SH', 'St. Helena'),
(205, 'PM', 'St. Pierre and Miquelon'),
(206, 'SD', 'Sudan'),
(207, 'SR', 'Suriname'),
(208, 'SJ', 'Svalbard and Jan Mayen Islands'),
(209, 'SZ', 'Swaziland'),
(210, 'SE', 'Sweden'),
(211, 'CH', 'Switzerland'),
(212, 'SY', 'Syrian Arab Republic'),
(213, 'TW', 'Taiwan'),
(214, 'TJ', 'Tajikistan'),
(215, 'TZ', 'Tanzania, United Republic of'),
(216, 'TH', 'Thailand'),
(217, 'TG', 'Togo'),
(218, 'TK', 'Tokelau'),
(219, 'TO', 'Tonga'),
(220, 'TT', 'Trinidad and Tobago'),
(221, 'TN', 'Tunisia'),
(222, 'TR', 'Turkey'),
(223, 'TM', 'Turkmenistan'),
(224, 'TC', 'Turks and Caicos Islands'),
(225, 'TV', 'Tuvalu'),
(226, 'UG', 'Uganda'),
(227, 'UA', 'Ukraine'),
(228, 'AE', 'United Arab Emirates'),
(229, 'GB', 'United Kingdom'),
(230, 'US', 'United States'),
(231, 'UM', 'United States minor outlying islands'),
(232, 'UY', 'Uruguay'),
(233, 'UZ', 'Uzbekistan'),
(234, 'VU', 'Vanuatu'),
(235, 'VA', 'Vatican City State'),
(236, 'VE', 'Venezuela'),
(237, 'VN', 'Vietnam'),
(238, 'VG', 'Virgin Islands (British)'),
(239, 'VI', 'Virgin Islands (U.S.)'),
(240, 'WF', 'Wallis and Futuna Islands'),
(241, 'EH', 'Western Sahara'),
(242, 'YE', 'Yemen'),
(243, 'ZR', 'Zaire'),
(244, 'ZM', 'Zambia'),
(245, 'ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `experience_levels`
--

CREATE TABLE IF NOT EXISTS `experience_levels` (
  `level_id` int(11) NOT NULL,
  `experience_type` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `experience_levels`
--

INSERT INTO `experience_levels` (`level_id`, `experience_type`, `status`) VALUES
(1, 'Beginner', '1'),
(2, 'Intermediate', '1'),
(3, 'Experience', '1');

-- --------------------------------------------------------

--
-- Table structure for table `field_of_work_type`
--

CREATE TABLE IF NOT EXISTS `field_of_work_type` (
  `type_id` int(11) NOT NULL,
  `type_title` varchar(255) NOT NULL,
  `type_description` text,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Visibility Status. 0=> Inactive, 1=> Active'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `field_of_work_type`
--

INSERT INTO `field_of_work_type` (`type_id`, `type_title`, `type_description`, `status`) VALUES
(1, 'Audio & video / Animation', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `focus_type`
--

CREATE TABLE IF NOT EXISTS `focus_type` (
  `focus_type_id` int(11) NOT NULL,
  `focus_type` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Visibility Status. 0=> Inactive, 1=> Active'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `focus_type`
--

INSERT INTO `focus_type` (`focus_type_id`, `focus_type`, `status`) VALUES
(1, 'Motion Graphic design, 2D & 3D Animation', '1');

-- --------------------------------------------------------

--
-- Table structure for table `hirer_subscriptions`
--

CREATE TABLE IF NOT EXISTS `hirer_subscriptions` (
  `id` int(11) NOT NULL,
  `emailAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ipaddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `hirer_subscriptions`
--

INSERT INTO `hirer_subscriptions` (`id`, `emailAddress`, `ipaddress`, `updated_at`, `created_at`) VALUES
(1, 'pabitra@technoexponent.com', '45.249.80.227', '2017-10-28 19:11:34', '2017-10-28 19:11:34'),
(2, 'pabitra1@technoexponent.com', '45.249.80.227', '2017-10-28 19:12:09', '2017-10-28 19:12:09'),
(3, 'sfdsf@dfdfsd.fgh', '45.249.80.227', '2017-10-28 19:31:21', '2017-10-28 19:31:21'),
(4, 'heropersian@gmail.com', '176.27.206.103', '2017-11-06 17:14:18', '2017-11-06 17:14:18'),
(5, 'rr@gmail.com', '62.190.18.120', '2017-11-07 00:01:35', '2017-11-07 00:01:35'),
(6, 'nanu_rtc@yahoo.com', '71.58.84.240', '2017-11-09 00:23:43', '2017-11-09 00:23:43'),
(7, 'uttam@techknoexponent.com', '45.249.80.227', '2017-11-09 18:30:10', '2017-11-09 18:30:10'),
(8, 'subirroy73@googlemail.com', '82.47.239.225', '2017-11-13 09:48:54', '2017-11-13 09:48:54'),
(9, 'nejad.saman@gmail.com', '5.67.2.195', '2017-11-25 02:20:21', '2017-11-25 02:20:21');

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL,
  `invoice_for_user` int(11) NOT NULL COMMENT 'To whom will be pay',
  `invoice_by_user` int(11) NOT NULL COMMENT 'Who will pay',
  `invoice_date` datetime NOT NULL,
  `invoice_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'time()-job_id-proposal_id',
  `why_raising_invoice` text COLLATE utf8_unicode_ci,
  `description` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL COMMENT '1=Paid, 2=Unpaid, 3=Declined',
  `gross_amt` float(10,2) NOT NULL,
  `fee_amt` float(10,2) NOT NULL,
  `vat_percent` float(10,2) DEFAULT '0.00',
  `job_id` int(11) NOT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `milestone_id` int(11) DEFAULT '0',
  `quantity` int(11) DEFAULT NULL,
  `invoice_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unit_cost` float(10,2) DEFAULT NULL,
  `time_period` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_for_user`, `invoice_by_user`, `invoice_date`, `invoice_no`, `why_raising_invoice`, `description`, `status`, `gross_amt`, `fee_amt`, `vat_percent`, `job_id`, `proposal_id`, `milestone_id`, `quantity`, `invoice_type`, `unit_cost`, `time_period`) VALUES
(1, 7, 1, '2017-10-10 12:28:36', '1507638516-9-2', NULL, NULL, 1, 100.00, 0.00, 0.00, 9, 2, 0, NULL, NULL, NULL, NULL),
(2, 7, 1, '2017-10-11 07:22:00', '1507706520-10-4', NULL, NULL, 1, 100.00, 0.00, 0.00, 10, 4, 0, NULL, NULL, NULL, NULL),
(3, 7, 1, '2017-10-17 13:09:09', '1508245749-2-1', 'Other reason', 'desc1', 1, 150.00, 0.00, 0.00, 2, 1, 0, 3, 'Fixed', 50.00, '6-10 - 6/11'),
(4, 7, 1, '2017-10-17 13:09:09', '1508245749-2-1', 'Other reason', 'desc2', 2, 260.00, 0.00, 0.00, 2, 1, 0, 4, 'Hourly', 65.00, '7-10 - 7/11'),
(5, 7, 1, '2017-10-28 01:23:37', '1509134017-2-1', NULL, NULL, 1, 100.00, 0.00, 0.00, 2, 1, 0, NULL, NULL, NULL, NULL),
(6, 1, 7, '2017-11-01 14:37:45', '1509527265-12-5', NULL, NULL, 1, 175.00, 0.00, 0.00, 12, 5, 0, NULL, NULL, NULL, NULL),
(7, 1, 7, '2017-11-01 14:38:33', '1509527313-12-5', NULL, NULL, 1, 150.00, 0.00, 0.00, 12, 5, 0, NULL, NULL, NULL, NULL),
(8, 2, 1, '2017-11-13 21:29:56', '1510588796-29-24', NULL, NULL, 1, 100.00, 0.00, 0.00, 29, 24, 0, NULL, NULL, NULL, NULL),
(9, 10, 13, '2017-11-17 15:23:03', '1510912383-31-25', 'I have completed and delivered the job as per contract agreement with the hirer.', 'Graphics design', 2, 20.00, 0.00, 0.00, 31, 25, 0, 1, 'Fixed', 20.00, '6/10'),
(10, 1, 10, '2017-11-17 16:30:48', '1510916448-8-3', NULL, NULL, 1, 150.00, 0.00, 0.00, 8, 3, 0, NULL, NULL, NULL, NULL),
(11, 1, 13, '2017-11-20 21:27:53', '1511193473-32-26', NULL, NULL, 1, 100.00, 0.00, 0.00, 32, 26, 0, NULL, NULL, NULL, NULL),
(12, 10, 13, '2017-11-20 22:36:04', '1511197564-31-25', NULL, NULL, 1, 100.00, 0.00, 0.00, 31, 25, 0, NULL, NULL, NULL, NULL),
(13, 1, 2, '2017-11-23 21:47:48', '1511453868-36-30', NULL, NULL, 1, 1000.00, 0.00, 0.00, 36, 30, 0, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `jobassets`
--

CREATE TABLE IF NOT EXISTS `jobassets` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `is_file` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'file=1,folder=0',
  `parent_id` int(11) NOT NULL DEFAULT '0',
  `mime_type` varchar(100) DEFAULT NULL,
  `size` varchar(100) DEFAULT NULL,
  `asset_file_path` varchar(255) DEFAULT NULL,
  `job_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobassets`
--

INSERT INTO `jobassets` (`id`, `name`, `is_file`, `parent_id`, `mime_type`, `size`, `asset_file_path`, `job_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'application.pdf', 1, 0, 'application/pdf', '433994', '1506147668v4UKIO7p7j-DOC.pdf', 7, 0, '2017-09-23 06:21:08', '2017-09-23 06:21:08'),
(2, 'Root folder', 0, 0, '', '', '', 7, 0, '2017-09-23 06:22:22', '2017-09-23 06:22:22'),
(3, 'Test', 0, 0, '', '', '', 7, 0, '2017-09-23 19:50:59', '2017-09-23 19:50:59'),
(4, 'hero-collaboration-partial.png', 1, 3, 'image/png', '77730', '1506196287cIClvLHlhf-DOC.png', 7, 0, '2017-09-23 19:51:27', '2017-09-23 19:51:27'),
(5, 'test', 0, 0, '', '', '', 2, 0, '2017-09-24 05:53:35', '2017-09-24 05:53:35'),
(6, '16388108_107142469802403_7153629569236143291_n.jpg', 1, 0, 'image/jpeg', '54728', '1506232438me4maBnXJX-DOC.jpg', 2, 0, '2017-09-24 05:53:58', '2017-09-24 05:53:58'),
(7, 'test', 0, 0, '', '', '', 4, 0, '2017-10-16 13:36:26', '2017-10-16 13:36:26'),
(8, 'tour1.jpg', 1, 7, 'image/jpeg', '215293', '150816100770mryx8kq5-DOC.jpg', 4, 0, '2017-10-16 13:36:47', '2017-10-16 13:36:47'),
(9, 'Branding', 0, 0, '', '', '', 31, 0, '2017-11-18 00:48:28', '2017-11-18 00:48:28'),
(10, 'TN.png', 1, 9, 'image/png', '21491', '1510946324mLAQxqNNQi-DOC.png', 31, 0, '2017-11-18 00:48:44', '2017-11-18 00:48:44');

-- --------------------------------------------------------

--
-- Table structure for table `jobprovider_transactions`
--

CREATE TABLE IF NOT EXISTS `jobprovider_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_no` varchar(255) DEFAULT NULL,
  `job_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `payment_type` enum('P','S') NOT NULL DEFAULT 'P',
  `payment_status` enum('S','P','C') NOT NULL DEFAULT 'P' COMMENT 'S=Success, P=Pending, C=Cancel',
  `payment_gateway_response` longtext,
  `start_date` int(11) DEFAULT NULL,
  `expiry_date` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobprovider_transactions`
--

INSERT INTO `jobprovider_transactions` (`id`, `user_id`, `transaction_no`, `job_id`, `proposal_id`, `amount`, `payment_type`, `payment_status`, `payment_gateway_response`, `start_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'WO3664-1-1', 2, 1, 325, 'S', 'P', NULL, NULL, NULL, '2017-10-06 14:53:54', '2017-10-06 19:53:54'),
(2, 1, 'WO8186-2-1', 2, 1, 325, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Fri, 06 Oct 2017 15:10:11 GMT\r\n\r\n{"id":"ch_1B9xSoHk4874UBnITOcRmPe3","object":"charge","amount":32500,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1B9xSpHk4874UBnIwrdShl5s","captured":true,"created":1507302610,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1B9xSoHk4874UBnITOcRmPe3\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-06 15:10:11', '2017-10-06 20:10:11'),
(3, 1, 'WO3311-3-2', 9, 2, 500, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 10 Oct 2017 06:32:08 GMT\r\n\r\n{"id":"ch_1BBHHfHk4874UBnIq7rwJ7Uk","object":"charge","amount":50000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BBHHfHk4874UBnIJZgr93Hm","captured":true,"created":1507617127,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BBHHfHk4874UBnIq7rwJ7Uk\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-10 06:32:08', '2017-10-10 11:32:08'),
(4, 1, 'WO9142-4-4', 10, 4, 500, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Wed, 11 Oct 2017 07:20:32 GMT\r\n\r\n{"id":"ch_1BBeW3Hk4874UBnICg6k0dCf","object":"charge","amount":50000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BBeW3Hk4874UBnI6CEOlUIM","captured":true,"created":1507706431,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BBeW3Hk4874UBnICg6k0dCf\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-11 07:20:32', '2017-10-11 12:20:32'),
(5, 1, 'WO8524-5-1', 2, 1, 100, '', 'P', NULL, NULL, NULL, '2017-10-17 15:23:32', '2017-10-17 20:23:32'),
(6, 1, 'WO1449-6-1', 2, 1, 100, '', 'P', NULL, NULL, NULL, '2017-10-17 15:24:00', '2017-10-17 20:24:00'),
(7, 1, 'WO3860-7-1', 2, 1, 100, '', 'P', NULL, NULL, NULL, '2017-10-17 15:28:06', '2017-10-17 20:28:06'),
(8, 1, 'WO8099-8-1', 2, 1, 100, '', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 17 Oct 2017 15:38:39 GMT\r\n\r\n{"id":"ch_1BDx9OHk4874UBnIHtBzytkm","object":"charge","amount":10000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BDx9OHk4874UBnIgLzsn9lE","captured":true,"created":1508254718,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BDx9OHk4874UBnIHtBzytkm\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-17 15:38:39', '2017-10-17 20:38:39'),
(9, 1, 'WO7962-9-2', 9, 2, 256, '', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 17 Oct 2017 15:41:26 GMT\r\n\r\n{"id":"ch_1BDxC5Hk4874UBnIPjiXRCMe","object":"charge","amount":25600,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BDxC5Hk4874UBnIP3UHNRN4","captured":true,"created":1508254885,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BDxC5Hk4874UBnIPjiXRCMe\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-17 15:41:26', '2017-10-17 20:41:26'),
(10, 1, 'WO6097-10-1-4', 2, 1, 260, '', 'P', NULL, NULL, NULL, '2017-10-23 10:20:57', '2017-10-23 20:50:57'),
(17, 1, 'WO8795-17-1-3', 2, 1, 150, '', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 23 Oct 2017 10:37:45 GMT\r\n\r\n{"id":"ch_1BG3JUHk4874UBnIuWLCaBzP","object":"charge","amount":15000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BG3JUHk4874UBnIzzPilUkf","captured":true,"created":1508755064,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BG3JUHk4874UBnIuWLCaBzP\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-23 10:37:45', '2017-10-23 21:07:45'),
(19, 7, 'WO4231-19-5', 12, 5, 325, 'S', 'P', NULL, NULL, NULL, '2017-10-24 11:13:35', '2017-10-24 21:43:35'),
(20, 7, 'WO1181-20-5', 12, 5, 325, 'S', 'P', NULL, NULL, NULL, '2017-10-24 11:14:45', '2017-10-24 21:44:45'),
(21, 1, 'WO5209-21-1', 2, 1, 150, '', 'P', NULL, NULL, NULL, '2017-10-27 19:55:49', '2017-10-28 06:25:49'),
(22, 7, 'WO4271-22-5', 12, 5, 325, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Wed, 01 Nov 2017 07:54:14 GMT\r\n\r\n{"id":"ch_1BJH3BHk4874UBnI93whNZz8","object":"charge","amount":32500,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BJH3BHk4874UBnIhaPS5pFo","captured":true,"created":1509522853,"currency":"usd","customer":"cus_BgeG1cpNM9AaoG","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"navinr@europe.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BJH3BHk4874UBnI93whNZz8\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BJGxnHk4874UBnI0rvt7Ngz","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"78569","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BgeG1cpNM9AaoG","cvc_check":"pass","dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Navin Raj","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-01 07:54:14', '2017-11-01 18:24:14'),
(23, 1, 'WO5680-23-4', 10, 4, 1000, '', 'P', NULL, NULL, NULL, '2017-11-02 10:45:03', '2017-11-02 21:15:03'),
(24, 1, 'WO4973-24-4', 10, 4, 100, '', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 02 Nov 2017 10:48:03 GMT\r\n\r\n{"id":"ch_1BJgEwHk4874UBnIKb5sd8tM","object":"charge","amount":10000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BJgEwHk4874UBnIp4nLR1JE","captured":true,"created":1509619682,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BJgEwHk4874UBnIKb5sd8tM\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-02 10:48:03', '2017-11-02 21:18:03'),
(25, 1, 'WO9869-25-21-1', 21, 0, 3, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 06 Nov 2017 05:42:04 GMT\r\n\r\n{"id":"ch_1BL3N1Hk4874UBnI8oIrBDrO","object":"charge","amount":300,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BL3N1Hk4874UBnIeqXqzcoB","captured":true,"created":1509946923,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BL3N1Hk4874UBnI8oIrBDrO\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-06 05:42:04', '2017-11-06 17:12:04'),
(26, 1, 'WO0411-26-21-1', 21, 0, 3, 'S', 'P', NULL, NULL, NULL, '2017-11-06 06:58:24', '2017-11-06 18:28:24'),
(29, 7, 'WO5524-29-2', 0, 0, 7, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 06 Nov 2017 14:31:58 GMT\r\n\r\n{"id":"ch_1BLBdqHk4874UBnIlzV3sWfk","object":"charge","amount":700,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BLBdqHk4874UBnIrqqU8E0b","captured":true,"created":1509978718,"currency":"usd","customer":"cus_BgeG1cpNM9AaoG","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"navinr@europe.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BLBdqHk4874UBnIlzV3sWfk\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BJGxnHk4874UBnI0rvt7Ngz","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"78569","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BgeG1cpNM9AaoG","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Navin Raj","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-06 14:31:58', '2017-11-07 02:01:58'),
(30, 7, 'WO2495-30-1', 0, 0, 4, 'S', 'P', NULL, NULL, NULL, '2017-11-06 15:05:16', '2017-11-07 02:35:16'),
(31, 10, 'WO7689-31-4', 0, 0, 17, 'S', 'P', NULL, NULL, NULL, '2017-11-06 18:25:26', '2017-11-07 05:55:26'),
(32, 10, 'WO3476-32-3', 8, 3, 500, 'S', 'P', NULL, NULL, NULL, '2017-11-06 19:01:55', '2017-11-07 06:31:55'),
(33, 1, 'WO1120-33-22-1', 22, 0, 3, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 07 Nov 2017 09:46:11 GMT\r\n\r\n{"id":"ch_1BLTeoHk4874UBnIMJPSTTXn","object":"charge","amount":300,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BLTeoHk4874UBnIwY9BagRP","captured":true,"created":1510047970,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BLTeoHk4874UBnIMJPSTTXn\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-07 09:46:11', '2017-11-07 21:16:11'),
(34, 1, 'WO3235-34-23-1', 23, 0, 3, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 07 Nov 2017 09:47:38 GMT\r\n\r\n{"id":"ch_1BLTgDHk4874UBnI0bXKP7sy","object":"charge","amount":300,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BLTgDHk4874UBnITHbm2TQw","captured":true,"created":1510048057,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BLTgDHk4874UBnI0bXKP7sy\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-07 09:47:38', '2017-11-07 21:17:38'),
(35, 1, 'WO6817-35-2', 0, 0, 7, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 07 Nov 2017 09:55:02 GMT\r\n\r\n{"id":"ch_1BLTnOHk4874UBnI7iqeNcPX","object":"charge","amount":700,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BLTnOHk4874UBnIg1WvcZ6b","captured":true,"created":1510048502,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BLTnOHk4874UBnI7iqeNcPX\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-07 09:55:03', '2017-11-07 21:25:03'),
(36, 1, 'WO9998-36-1', 0, 0, 4, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 07 Nov 2017 09:55:39 GMT\r\n\r\n{"id":"ch_1BLTnyHk4874UBnIIcgxpv9n","object":"charge","amount":400,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BLTnzHk4874UBnI51AKSXO5","captured":true,"created":1510048538,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BLTnyHk4874UBnIIcgxpv9n\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-07 09:55:39', '2017-11-07 21:25:39'),
(37, 4, 'WO5004-37-1', 0, 0, 4, 'S', 'P', NULL, NULL, NULL, '2017-11-07 22:52:50', '2017-11-08 10:22:50'),
(38, 10, 'WO6081-38-1', 0, 0, 4, 'S', 'P', NULL, NULL, NULL, '2017-11-08 20:15:40', '2017-11-09 07:45:40'),
(39, 10, 'WO7988-39-4', 0, 0, 17, 'S', 'P', NULL, NULL, NULL, '2017-11-08 20:21:01', '2017-11-09 07:51:01'),
(40, 1, 'WO8083-40-18-1', 18, 0, 3, 'S', 'P', NULL, NULL, NULL, '2017-11-09 07:02:41', '2017-11-09 18:32:41'),
(41, 1, 'WO0573-41-18-1', 18, 0, 3, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 09 Nov 2017 08:13:56 GMT\r\n\r\n{"id":"ch_1BMBAdHk4874UBnIgC6HqjJh","object":"charge","amount":300,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BMBAdHk4874UBnIhYa5iGzZ","captured":true,"created":1510215235,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BMBAdHk4874UBnIgC6HqjJh\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-09 08:13:56', '2017-11-09 19:43:56'),
(42, 1, 'WO3913-42-25-1', 25, 0, 3, 'S', 'P', NULL, NULL, NULL, '2017-11-09 10:31:04', '2017-11-09 22:01:04'),
(43, 1, 'WO9001-43-26-1', 26, 0, 3, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 09 Nov 2017 10:38:59 GMT\r\n\r\n{"id":"ch_1BMDR0Hk4874UBnIheLgPCEX","object":"charge","amount":300,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BMDR0Hk4874UBnIu7MKLpBT","captured":true,"created":1510223938,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BMDR0Hk4874UBnIheLgPCEX\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-09 10:38:59', '2017-11-09 22:08:59'),
(44, 1, 'WO4675-44-2719', 27, 19, 1, 'S', 'P', NULL, NULL, NULL, '2017-11-09 12:49:33', '2017-11-10 00:19:33'),
(45, 1, 'WO8549-45-2720', 27, 20, 1, 'S', 'P', NULL, NULL, NULL, '2017-11-09 12:54:35', '2017-11-10 00:24:35'),
(46, 1, 'WO9093-46-27-20', 27, 20, 1, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 09 Nov 2017 12:58:33 GMT\r\n\r\n{"id":"ch_1BMFc5Hk4874UBnIQTJ1gnxg","object":"charge","amount":100,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BMFc5Hk4874UBnIMiffxSHk","captured":true,"created":1510232313,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BMFc5Hk4874UBnIQTJ1gnxg\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-09 12:58:33', '2017-11-10 00:28:33'),
(47, 1, 'WO9578-47-29-1', 29, 0, 3, 'S', 'P', NULL, NULL, NULL, '2017-11-09 15:18:26', '2017-11-10 02:48:26'),
(48, 1, 'WO2668-48-28-22', 28, 22, 1, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Fri, 10 Nov 2017 10:36:51 GMT\r\n\r\n{"id":"ch_1BMZsUHk4874UBnIquDnLUUX","object":"charge","amount":100,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BMZsUHk4874UBnILjE1MZI0","captured":true,"created":1510310210,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BMZsUHk4874UBnIquDnLUUX\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-10 10:36:51', '2017-11-10 22:06:51'),
(49, 10, 'WO3313-49-4', 0, 0, 17, 'S', 'P', NULL, NULL, NULL, '2017-11-12 20:01:12', '2017-11-13 07:31:12'),
(50, 2, 'WO3217-50-1', 0, 0, 4, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 13 Nov 2017 15:57:27 GMT\r\n\r\n{"id":"ch_1BNkJOHk4874UBnI79oaOugm","object":"charge","amount":400,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BNkJOHk4874UBnIpoxOccnK","captured":true,"created":1510588646,"currency":"usd","customer":"cus_BlGrSCrdlHqQkT","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"technoexponent02@gmail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BNkJOHk4874UBnI79oaOugm\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BNkJLHk4874UBnIDLuAbv5v","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BlGrSCrdlHqQkT","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"S Saha","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-13 15:57:27', '2017-11-14 03:27:27'),
(51, 1, 'WO7640-51-24', 29, 24, 100, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 13 Nov 2017 15:59:38 GMT\r\n\r\n{"id":"ch_1BNkLVHk4874UBnIBvolYxW9","object":"charge","amount":10000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BNkLVHk4874UBnI3KjEFeY2","captured":true,"created":1510588777,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BNkLVHk4874UBnIBvolYxW9\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-13 15:59:38', '2017-11-14 03:29:38'),
(52, 10, 'WO2809-52-4', 0, 0, 17, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 14 Nov 2017 19:44:34 GMT\r\n\r\n{"id":"ch_1BOAKjHk4874UBnIee5xblAI","object":"charge","amount":1700,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BOAKjHk4874UBnIB3ZfNyDi","captured":true,"created":1510688673,"currency":"usd","customer":"cus_Blhkg5IDt0qy5C","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"heropersian@gmail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BOAKjHk4874UBnIee5xblAI\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BOAKgHk4874UBnI0nlG1pfM","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Blhkg5IDt0qy5C","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"sam nej","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-14 19:44:34', '2017-11-15 07:14:34'),
(53, 10, 'WO3336-53-3', 8, 3, 500, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Wed, 15 Nov 2017 11:00:28 GMT\r\n\r\n{"id":"ch_1BOOd5Hk4874UBnIKvPAVEx2","object":"charge","amount":50000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BOOd5Hk4874UBnIcY4eqz6u","captured":true,"created":1510743627,"currency":"usd","customer":"cus_Blhkg5IDt0qy5C","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"heropersian@gmail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BOOd5Hk4874UBnIKvPAVEx2\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BOAKgHk4874UBnI0nlG1pfM","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Blhkg5IDt0qy5C","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"sam nej","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-15 11:00:28', '2017-11-15 22:30:28'),
(54, 14, 'WO6635-54-4', 0, 0, 17, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Wed, 15 Nov 2017 16:37:20 GMT\r\n\r\n{"id":"ch_1BOTt5Hk4874UBnI6qcREM1H","object":"charge","amount":1700,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BOTt5Hk4874UBnIzpNvUiSD","captured":true,"created":1510763839,"currency":"usd","customer":"cus_Bm1wzSw8ytiqce","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"saman2u2001@yahoo.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BOTt5Hk4874UBnI6qcREM1H\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BOTt2Hk4874UBnIMX74FK3N","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bm1wzSw8ytiqce","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Tester One","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-15 16:37:20', '2017-11-16 04:07:20'),
(55, 1, 'WO9901-55-30-1', 30, 0, 3, 'S', 'P', NULL, NULL, NULL, '2017-11-16 15:01:33', '2017-11-17 02:31:33'),
(56, 13, 'WO8225-56-25', 31, 25, 100, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Fri, 17 Nov 2017 09:36:56 GMT\r\n\r\n{"id":"ch_1BP6HLHk4874UBnIuySaLcnx","object":"charge","amount":10000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BP6HLHk4874UBnIQpFH4UhH","captured":true,"created":1510911415,"currency":"usd","customer":"cus_Bmfc63MOYSR0aI","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"subirroy73@googlemail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BP6HLHk4874UBnIuySaLcnx\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BP6HIHk4874UBnInGWWaigR","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bmfc63MOYSR0aI","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Subir Roy","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-17 09:36:56', '2017-11-17 21:06:56'),
(57, 10, 'WO1836-57-3', 8, 3, 50, '', 'P', NULL, NULL, NULL, '2017-11-17 19:21:38', '2017-11-18 06:51:38'),
(58, 13, 'WO6175-58-26', 32, 26, 100, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 20 Nov 2017 15:54:32 GMT\r\n\r\n{"id":"ch_1BQHbPHk4874UBnIs2encIKG","object":"charge","amount":10000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BQHbPHk4874UBnI2OzlE1EV","captured":true,"created":1511193271,"currency":"usd","customer":"cus_Bmfc63MOYSR0aI","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"subirroy73@googlemail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BQHbPHk4874UBnIs2encIKG\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BP6HIHk4874UBnInGWWaigR","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bmfc63MOYSR0aI","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Subir Roy","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-20 15:54:32', '2017-11-21 03:24:32'),
(59, 10, 'WO9671-59-30-27', 30, 27, 1, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Mon, 20 Nov 2017 16:55:19 GMT\r\n\r\n{"id":"ch_1BQIYEHk4874UBnIFIbM4gHF","object":"charge","amount":100,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BQIYEHk4874UBnIz4gqt2Qe","captured":true,"created":1511196918,"currency":"usd","customer":"cus_Blhkg5IDt0qy5C","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"heropersian@gmail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BQIYEHk4874UBnIFIbM4gHF\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BOAKgHk4874UBnI0nlG1pfM","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Blhkg5IDt0qy5C","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"sam nej","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-20 16:55:19', '2017-11-21 04:25:19'),
(60, 14, 'WO0100-60-34-1', 34, 0, 3, 'S', 'S', NULL, NULL, NULL, '2017-11-23 10:36:52', '2017-11-23 22:06:52'),
(61, 14, 'WO7939-61-35-1', 35, 0, 3, 'S', 'S', NULL, NULL, NULL, '2017-11-23 10:37:39', '2017-11-23 22:07:39'),
(62, 14, 'WO6428-62-28', 35, 28, 100, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 10:42:47 GMT\r\n\r\n{"id":"ch_1BRIAMHk4874UBnI0K33Bsxe","object":"charge","amount":10000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRIAMHk4874UBnI9Ir98cJR","captured":true,"created":1511433766,"currency":"usd","customer":"cus_Bm1wzSw8ytiqce","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"saman2u2001@yahoo.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRIAMHk4874UBnI0K33Bsxe\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BOTt2Hk4874UBnIMX74FK3N","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bm1wzSw8ytiqce","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Tester One","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 10:42:47', '2017-11-23 22:12:47');
INSERT INTO `jobprovider_transactions` (`id`, `user_id`, `transaction_no`, `job_id`, `proposal_id`, `amount`, `payment_type`, `payment_status`, `payment_gateway_response`, `start_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(63, 15, 'WO0777-63-1', 0, 0, 4, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 11:16:21 GMT\r\n\r\n{"id":"ch_1BRIgqHk4874UBnI4NrShnwQ","object":"charge","amount":400,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRIgqHk4874UBnINyEWV2QI","captured":true,"created":1511435780,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRIgqHk4874UBnI4NrShnwQ\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 11:16:21', '2017-11-23 22:46:21'),
(64, 15, 'WO4056-64-30-29', 30, 29, 1, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 11:17:45 GMT\r\n\r\n{"id":"ch_1BRIiCHk4874UBnIGqXsTGxu","object":"charge","amount":100,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRIiCHk4874UBnIv7vdjJvB","captured":true,"created":1511435864,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRIiCHk4874UBnIGqXsTGxu\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 11:17:45', '2017-11-23 22:47:45'),
(65, 2, 'WO1476-65-30', 36, 30, 1000, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 16:17:09 GMT\r\n\r\n{"id":"ch_1BRNNwHk4874UBnII6qm7Heb","object":"charge","amount":100000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRNNwHk4874UBnID6THVoK2","captured":true,"created":1511453828,"currency":"usd","customer":"cus_BlGrSCrdlHqQkT","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"technoexponent02@gmail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRNNwHk4874UBnII6qm7Heb\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BNkJLHk4874UBnIDLuAbv5v","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BlGrSCrdlHqQkT","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"S Saha","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 16:17:09', '2017-11-24 03:47:09'),
(66, 4, 'WO7190-66-38-1', 38, 0, 3, 'S', 'P', NULL, NULL, NULL, '2017-11-23 20:04:57', '2017-11-24 07:34:57'),
(67, 4, 'WO5017-67-4', 0, 0, 17, 'S', 'P', NULL, NULL, NULL, '2017-11-23 20:54:13', '2017-11-24 08:24:13'),
(68, 4, 'WO9272-68-4', 0, 0, 17, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 20:58:29 GMT\r\n\r\n{"id":"ch_1BRRmCHk4874UBnIpqjBnfdd","object":"charge","amount":1700,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRRmCHk4874UBnIWaurqAc6","captured":true,"created":1511470708,"currency":"usd","customer":"cus_Bp5yK8wN5w0l3J","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"nanu_rtc@yahoo.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRRmCHk4874UBnIpqjBnfdd\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BRRm8Hk4874UBnIU6fXma5g","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bp5yK8wN5w0l3J","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Ion Paaa","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 20:58:29', '2017-11-24 08:28:29'),
(69, 4, 'WO6086-69-39-31', 39, 31, 1, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 21:00:05 GMT\r\n\r\n{"id":"ch_1BRRnkHk4874UBnIIWyCIcgB","object":"charge","amount":100,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRRnkHk4874UBnI8pFp2pgC","captured":true,"created":1511470804,"currency":"usd","customer":"cus_Bp5yK8wN5w0l3J","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"nanu_rtc@yahoo.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRRnkHk4874UBnIIWyCIcgB\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BRRm8Hk4874UBnIU6fXma5g","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bp5yK8wN5w0l3J","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Ion Paaa","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 21:00:05', '2017-11-24 08:30:05'),
(70, 13, 'WO6123-70-31', 39, 31, 45, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 21:01:04 GMT\r\n\r\n{"id":"ch_1BRRogHk4874UBnIBDKFTWo9","object":"charge","amount":4500,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRRohHk4874UBnIiYuKqAlS","captured":true,"created":1511470862,"currency":"usd","customer":"cus_Bmfc63MOYSR0aI","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"subirroy73@googlemail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRRogHk4874UBnIBDKFTWo9\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BP6HIHk4874UBnInGWWaigR","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bmfc63MOYSR0aI","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Subir Roy","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 21:01:04', '2017-11-24 08:31:04'),
(71, 13, 'WO3777-71-25', 31, 25, 1000000, '', 'P', NULL, NULL, NULL, '2017-11-23 22:23:56', '2017-11-24 09:53:56'),
(72, 13, 'WO8912-72-25', 31, 25, 1000000, '', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Thu, 23 Nov 2017 22:25:00 GMT\r\n\r\n{"id":"ch_1BRT7vHk4874UBnIUeEgVj9a","object":"charge","amount":99999999,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRT7wHk4874UBnIBNttxKeX","captured":true,"created":1511475899,"currency":"usd","customer":"cus_Bmfc63MOYSR0aI","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"subirroy73@googlemail.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRT7vHk4874UBnIUeEgVj9a\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BP6HIHk4874UBnInGWWaigR","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_Bmfc63MOYSR0aI","cvc_check":null,"dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"Subir Roy","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-23 22:25:00', '2017-11-24 09:55:00'),
(73, 16, 'WO4629-73-4', 0, 0, 17, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Fri, 24 Nov 2017 21:32:17 GMT\r\n\r\n{"id":"ch_1BRomSHk4874UBnI3OF6ESEQ","object":"charge","amount":1700,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRomSHk4874UBnIz3jQvuDZ","captured":true,"created":1511559136,"currency":"usd","customer":"cus_BpTjLcshrRhffa","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"lorkonurdu@deyom.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRomSHk4874UBnI3OF6ESEQ\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BRomPHk4874UBnISgVf1G1h","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BpTjLcshrRhffa","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"X Y","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-24 21:32:17', '2017-11-25 09:02:17'),
(74, 16, 'WO7523-74-4', 0, 0, 17, 'S', 'P', NULL, NULL, NULL, '2017-11-24 21:33:52', '2017-11-25 09:03:52'),
(75, 16, 'WO6439-75-4', 0, 0, 17, 'S', 'P', NULL, NULL, NULL, '2017-11-24 21:34:10', '2017-11-25 09:04:10'),
(76, 16, 'WO0431-76-38-32', 38, 32, 1, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Fri, 24 Nov 2017 21:38:52 GMT\r\n\r\n{"id":"ch_1BRospHk4874UBnIhhc40dGO","object":"charge","amount":100,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BRosqHk4874UBnIzjiGD9BX","captured":true,"created":1511559531,"currency":"usd","customer":"cus_BpTjLcshrRhffa","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"lorkonurdu@deyom.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BRospHk4874UBnIhhc40dGO\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1BRomPHk4874UBnISgVf1G1h","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"12345","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BpTjLcshrRhffa","cvc_check":"pass","dynamic_last4":null,"exp_month":2,"exp_year":2020,"fingerprint":"OosfPGsS6BfNC2mt","funding":"credit","last4":"4242","metadata":[],"name":"X Y","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-11-24 21:38:52', '2017-11-25 09:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `job_assesments`
--

CREATE TABLE IF NOT EXISTS `job_assesments` (
  `assesment_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `assesments` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_assesments`
--

INSERT INTO `job_assesments` (`assesment_id`, `job_id`, `assesments`) VALUES
(6, 1, 'What is your experience?'),
(7, 1, 'How many projects you have already complete?'),
(8, 1, 'q1'),
(9, 1, 'q2'),
(19, 2, 'How many projects you have already complete?'),
(20, 2, 'How much you have skills?'),
(21, 2, 'What is your experience?'),
(22, 6, 'what challenges do you see?'),
(23, 8, 'No questions!'),
(24, 10, 'How many years of experience do you have regarding this field?'),
(27, 20, 'How many years of experience do you have regarding this field?'),
(28, 20, 'How many years of experience do you have regarding this field?'),
(37, 21, 'How many years of experience do you have regarding this field?'),
(40, 18, 'How many years of experience do you have regarding this field?'),
(41, 18, 'How many years of experience do you have regarding this field?'),
(42, 27, 'How many years of experience do you have regarding this field?'),
(43, 27, 'How many years of experience do you have regarding this field?'),
(44, 28, 'How many years of experience do you have regarding this field?'),
(45, 28, 'How many years of experience do you have regarding this field?'),
(46, 29, 'test question 1'),
(47, 29, 'test question 2'),
(58, 30, 'How many years of experience do you have regarding this field?'),
(59, 30, 'How many years of experience do you have regarding this field? 12'),
(60, 31, 'What do you do?'),
(61, 32, 'What do you do?'),
(84, 33, 'question 1'),
(85, 33, 'question 2'),
(86, 36, 'test'),
(87, 38, 'Design'),
(88, 39, 'What do you do?');

-- --------------------------------------------------------

--
-- Table structure for table `job_bid_credit_lists`
--

CREATE TABLE IF NOT EXISTS `job_bid_credit_lists` (
  `id` int(11) NOT NULL,
  `description` text NOT NULL,
  `credit_limit` int(11) NOT NULL,
  `amount` float(10,2) NOT NULL,
  `status` enum('A','I','D') NOT NULL DEFAULT 'A',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_bid_credit_lists`
--

INSERT INTO `job_bid_credit_lists` (`id`, `description`, `credit_limit`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, '5 credits for £ 3.99', 5, 3.99, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, '15 extra credits for £ 6.99', 15, 6.99, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, '25 extra credits for £ 9.99', 25, 9.99, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, '50 extra credits for <del>£ 18.99</del> £16, 99 <span class="text-orange">(Special offer!)</span>', 50, 16.99, 'A', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `job_proposals`
--

CREATE TABLE IF NOT EXISTS `job_proposals` (
  `proposal_id` int(11) NOT NULL,
  `sent_by_user` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `proposal_referance_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `interview_question_challanges` text COLLATE utf8_unicode_ci NOT NULL,
  `attached_file` varchar(255) CHARACTER SET latin1 NOT NULL,
  `is_highlight_bid` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `is_shortlisted` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT '''Y'' if the proposal is shortlisted only',
  `is_accepted` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT '''Y'' if the proposal is shortlisted & accepted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_proposals`
--

INSERT INTO `job_proposals` (`proposal_id`, `sent_by_user`, `job_id`, `proposal_referance_no`, `description`, `interview_question_challanges`, `attached_file`, `is_highlight_bid`, `is_shortlisted`, `is_accepted`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 'JP1507300445912', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1507300445LkvjSKurk4-DOC.jpg', 'N', 'Y', 'Y', '2017-10-06 14:34:05', '2017-10-23 16:21:35'),
(2, 7, 9, 'JP1507616923604', 'I am intested to work', 'I am intested to work', '1507616923uy6lXyqGEO-DOC.docx', 'N', 'Y', 'Y', '2017-10-10 06:28:43', '2017-10-17 15:41:26'),
(3, 1, 8, 'JP1507639234933', 'I am very interested', 'I am very interested', '1507639234vX1ueIsJvJ-DOC.docx', 'N', 'Y', 'Y', '2017-10-10 12:40:34', '2017-11-15 16:30:28'),
(4, 7, 10, 'JP1507706093421', 'asd asdasda sd', 'asd  asdasdasdas', '15077060939GYAEm9LHv-DOC.docx', 'N', 'Y', 'Y', '2017-10-11 07:14:53', '2017-11-02 16:18:03'),
(5, 1, 12, 'JP1508843590890', 'xvxcv xcv', 'fh fg hfgh fg', '1508843590206cz95byg-DOC.png', 'N', 'Y', 'Y', '2017-10-24 16:43:10', '2017-11-01 13:24:14'),
(6, 1, 11, 'JP1509521651709', 'Test proosal', 'Question1\r\nQuestion2\r\nQuestion3', '1509521651e13GgNe1fE-DOC.png', 'N', 'N', 'N', '2017-11-01 13:04:11', '2017-11-01 13:04:11'),
(10, 7, 17, 'JP1509636728231', 'Get a Quote', 'Get a Quote', '', 'N', 'N', 'N', '2017-11-02 21:02:08', '2017-11-02 21:02:08'),
(11, 11, 19, 'JP1509699454562', 'Get a Quote', 'Get a Quote', '', 'N', 'N', 'N', '2017-11-03 14:27:34', '2017-11-18 01:49:50'),
(12, 11, 24, 'JP1510048176722', 'Get a Quote', 'Get a Quote', '', 'N', 'N', 'N', '2017-11-07 15:19:36', '2017-11-07 15:19:36'),
(18, 7, 23, 'JP1510231519397', 'd mkgyjfg', 'g jjfgj fgj fgj', '1510231519tTyrLTWghN-DOC.jpg', 'Y', 'N', 'N', '2017-11-09 18:15:19', '2017-11-09 20:40:28'),
(20, 1, 27, 'JP1510231978358', 'hj ghjghjkkkkkgh k', 'gh khg jfh jfhgj', '1510231978Nbn0glAylu-DOC.jpg', 'Y', 'N', 'N', '2017-11-09 18:22:58', '2017-11-09 18:28:33'),
(22, 1, 28, 'JP1510310166282', 'test proposal Highlight bid', 'Interview question', '1510310166BHxUZYbnbn-DOC.jpg', 'Y', 'N', 'N', '2017-11-10 16:06:06', '2017-11-10 16:06:51'),
(23, 2, 28, 'JP1510588687612', 'asdasd', 'asdas', '1510588687jPHXHXYyOI-DOC.docx', 'N', 'N', 'N', '2017-11-13 21:28:07', '2017-11-13 21:28:07'),
(24, 2, 29, 'JP1510588744722', 'asdas', 'sdfsdf', '1510588744ApY2Dw1bYD-DOC.docx', 'N', 'Y', 'Y', '2017-11-13 21:29:04', '2017-11-13 21:29:38'),
(25, 10, 31, 'JP1510910936997', 'Hi Subir,\r\n\r\nI am interested in this job.\r\nPlease accept my proposal.\r\n\r\nRegards,\r\nSam', 'Hello World', '1510910936whauxc64NJ-DOC.png', 'N', 'Y', 'Y', '2017-11-17 14:58:56', '2017-11-24 03:55:00'),
(26, 1, 32, 'JP1511193142609', 'I am intested', 'test', '1511193142fbIArEU7hf-DOC.docx', 'N', 'Y', 'Y', '2017-11-20 21:22:22', '2017-11-20 21:24:32'),
(27, 10, 30, 'JP1511196885933', 'Hi Pabitra,\r\n\r\nI am interested in your project.\r\n\r\nthanks', 'Nothing', '1511196885C0jSyNkSoj-DOC.png', 'Y', 'N', 'N', '2017-11-20 22:24:45', '2017-11-23 17:07:44'),
(28, 10, 35, 'JP1511433602728', 'Hi SAM, I am interested in this job', 'nothing', '15114336026wKmsfD7rL-DOC.png', 'N', 'Y', 'Y', '2017-11-23 16:10:02', '2017-11-23 16:12:47'),
(29, 15, 30, 'JP1511435844286', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem', '1511435844mWUbtLXAYT-DOC.png', 'Y', 'N', 'N', '2017-11-23 16:47:24', '2017-11-23 17:06:25'),
(30, 1, 36, 'JP1511453759331', 'sdsd', 'dsds', '1511453759jbhC4Bb6uA-DOC.docx', 'N', 'Y', 'Y', '2017-11-23 21:45:59', '2017-11-23 21:47:09'),
(31, 4, 39, 'JP1511470774556', 'Hi', 'design', '1511470774EVBcb9eUAd-DOC.png', 'Y', 'Y', 'Y', '2017-11-24 02:29:34', '2017-11-24 02:31:04'),
(32, 16, 38, 'JP1511559513354', 'I am interested to make your TESTING', '111111', '1511559513SDTXpww8BX-DOC.png', 'Y', 'Y', 'N', '2017-11-25 03:08:33', '2017-11-25 03:52:41'),
(33, 14, 40, 'JP1511561330199', 'lajdsf;l jadlfj adlsfj alsdkjf lasdkj', 'lasjdf lajdf la', '1511561330DbRbOB6BXe-DOC.png', 'N', 'N', 'N', '2017-11-25 03:38:50', '2017-11-25 03:46:03');

-- --------------------------------------------------------

--
-- Table structure for table `job_proposal_amounts`
--

CREATE TABLE IF NOT EXISTS `job_proposal_amounts` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `proposal_id` int(11) NOT NULL,
  `sent_by_user` int(11) NOT NULL,
  `item_description` text COLLATE utf8_unicode_ci NOT NULL,
  `amount` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `is_paid` int(2) DEFAULT '0' COMMENT '0=Not Paid, 1=Paid',
  `updated_at` datetime DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=68 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_proposal_amounts`
--

INSERT INTO `job_proposal_amounts` (`id`, `job_id`, `proposal_id`, `sent_by_user`, `item_description`, `amount`, `is_paid`, `updated_at`, `created_at`) VALUES
(1, 2, 1, 7, 'Mile Stone 1', '100', 1, '2017-10-28 01:23:37', '2017-10-06 14:34:05'),
(2, 2, 1, 7, 'Mile Stone 2', '225', 0, '2017-10-06 14:34:05', '2017-10-06 14:34:05'),
(3, 9, 2, 7, 'ms1', '100', 1, '2017-10-10 12:28:36', '2017-10-10 06:28:43'),
(4, 9, 2, 7, 'ms 2', '150', 0, '2017-10-10 06:28:43', '2017-10-10 06:28:43'),
(5, 9, 2, 7, 'ms 3', '150', 0, '2017-10-10 11:19:20', '2017-10-10 06:28:43'),
(6, 9, 2, 7, 'ms 4', '100', 0, '2017-10-10 06:28:43', '2017-10-10 06:28:43'),
(10, 10, 4, 7, 'milestone 1', '100', 1, '2017-10-11 07:22:00', '2017-10-11 07:14:53'),
(11, 10, 4, 7, 'milestone 2', '150', 0, '2017-10-11 07:14:53', '2017-10-11 07:14:53'),
(12, 10, 4, 7, 'milestone 3', '150', 0, '2017-10-11 07:14:53', '2017-10-11 07:14:53'),
(13, 10, 4, 7, 'milestone 4', '100', 0, '2017-10-11 07:14:53', '2017-10-11 07:14:53'),
(14, 2, 1, 7, 'desc1', '150', 0, '2017-10-17 13:09:09', '2017-10-17 13:09:09'),
(15, 2, 1, 7, 'desc2', '260', 0, '2017-10-17 13:09:09', '2017-10-17 13:09:09'),
(16, 12, 5, 1, 'mile 2', '175', 1, '2017-11-01 14:37:45', '2017-10-24 16:43:10'),
(17, 12, 5, 1, 'mile 3', '150', 1, '2017-11-01 14:38:33', '2017-10-24 16:43:10'),
(18, 11, 6, 1, 'Mile 1', '150', 0, '2017-11-01 13:04:11', '2017-11-01 13:04:11'),
(19, 11, 6, 1, 'mile 2', '175', 0, '2017-11-01 13:04:11', '2017-11-01 13:04:11'),
(20, 11, 6, 1, 'mile 3', '175', 0, '2017-11-01 13:04:11', '2017-11-01 13:04:11'),
(35, 27, 20, 1, 'mile 1', '100', 0, '2017-11-09 18:22:58', '2017-11-09 18:22:58'),
(36, 27, 20, 1, 'mile 2', '125', 0, '2017-11-09 18:22:58', '2017-11-09 18:22:58'),
(45, 23, 18, 7, 'Mile 1', '150', 0, '2017-11-09 20:40:28', '2017-11-09 20:40:28'),
(46, 23, 18, 7, 'mile 2', '180', 0, '2017-11-09 20:40:28', '2017-11-09 20:40:28'),
(49, 28, 22, 1, 'mile 1', '125', 0, '2017-11-10 16:06:06', '2017-11-10 16:06:06'),
(50, 28, 22, 1, 'mile 2', '175', 0, '2017-11-10 16:06:06', '2017-11-10 16:06:06'),
(51, 28, 23, 2, 'ms 1', '250', 0, '2017-11-13 21:28:07', '2017-11-13 21:28:07'),
(52, 29, 24, 2, 'ms', '100', 1, '2017-11-13 21:29:56', '2017-11-13 21:29:04'),
(56, 8, 3, 1, 'Mile 1', '150', 1, '2017-11-17 16:30:48', '2017-11-15 01:34:51'),
(57, 8, 3, 1, 'mile 2', '175', 0, '2017-11-15 01:34:51', '2017-11-15 01:34:51'),
(58, 8, 3, 1, 'mile 3', '175', 0, '2017-11-15 01:34:51', '2017-11-15 01:34:51'),
(59, 31, 25, 10, 'Testing if it works', '100', 1, '2017-11-20 22:36:04', '2017-11-17 14:58:57'),
(60, 32, 26, 1, 'test', '100', 1, '2017-11-20 21:27:53', '2017-11-20 21:22:22'),
(61, 30, 27, 10, 'Invoice -1', '250', 0, '2017-11-20 22:24:45', '2017-11-20 22:24:45'),
(62, 35, 28, 10, 'Video animation', '100', 0, '2017-11-23 16:10:02', '2017-11-23 16:10:02'),
(63, 30, 29, 15, '10', '150', 0, '2017-11-23 16:47:24', '2017-11-23 16:47:24'),
(64, 36, 30, 1, 'test', '1000', 1, '2017-11-23 21:47:48', '2017-11-23 21:45:59'),
(65, 39, 31, 4, 'logo', '45', 0, '2017-11-24 02:29:34', '2017-11-24 02:29:34'),
(66, 38, 32, 16, 'Nothing', '10', 0, '2017-11-25 03:08:33', '2017-11-25 03:08:33'),
(67, 40, 33, 14, 'ssss', '245', 0, '2017-11-25 03:38:50', '2017-11-25 03:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `job_ratings`
--

CREATE TABLE IF NOT EXISTS `job_ratings` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `review_for_user` int(11) NOT NULL DEFAULT '0',
  `review_by_user` int(11) NOT NULL DEFAULT '0',
  `rating` float(5,1) NOT NULL,
  `review_feedback` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_ratings`
--

INSERT INTO `job_ratings` (`id`, `job_id`, `review_for_user`, `review_by_user`, `rating`, `review_feedback`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 7, 4.5, 'Good Job Provider', '0000-00-00 00:00:00', NULL),
(2, 17, 1, 7, 4.0, 'Good Job Provider', '0000-00-00 00:00:00', NULL),
(3, 23, 1, 7, 4.5, 'Good Job Provider', '0000-00-00 00:00:00', NULL),
(4, 23, 7, 1, 4.0, 'Good Freelancer', '0000-00-00 00:00:00', NULL),
(5, 17, 7, 1, 4.0, 'Good Freelancer', '0000-00-00 00:00:00', NULL),
(6, 2, 7, 1, 4.5, 'Good Freelancer', '0000-00-00 00:00:00', NULL),
(7, 29, 0, 2, 5.0, 'Hi', '2017-11-13 21:34:48', '2017-11-13 21:34:48'),
(8, 29, 0, 1, 5.0, 'good', '2017-11-13 21:34:58', '2017-11-13 21:34:58'),
(9, 12, 1, 7, 5.0, 'good review', '2017-11-15 19:23:52', '2017-11-15 19:23:52'),
(10, 31, 13, 10, 2.5, 'Need to work faster', '2017-11-23 15:57:46', '2017-11-23 15:57:46'),
(11, 36, 2, 1, 5.0, 'sdsds', '2017-11-23 21:52:22', '2017-11-23 21:52:22');

-- --------------------------------------------------------

--
-- Table structure for table `job_skill_maps`
--

CREATE TABLE IF NOT EXISTS `job_skill_maps` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_skill_maps`
--

INSERT INTO `job_skill_maps` (`id`, `job_id`, `skill_id`) VALUES
(1, 1, 7),
(2, 1, 1),
(3, 3, 1),
(4, 3, 8),
(5, 2, 6),
(6, 2, 7),
(7, 2, 1),
(8, 4, 7),
(9, 4, 9),
(10, 4, 5),
(11, 4, 10),
(12, 4, 2),
(13, 4, 3),
(14, 5, 8),
(15, 6, 1),
(16, 6, 9),
(17, 7, 9),
(18, 8, 2),
(19, 9, 1),
(20, 9, 3),
(21, 11, 6),
(22, 11, 1),
(23, 11, 5),
(24, 10, 6),
(25, 10, 5),
(26, 10, 2),
(27, 10, 3),
(28, 12, 1),
(29, 12, 9),
(30, 12, 2),
(31, 15, 7),
(32, 15, 1),
(33, 15, 9),
(34, 15, 5),
(35, 15, 10),
(36, 15, 2),
(37, 15, 3),
(38, 15, 4),
(42, 20, 1),
(43, 20, 9),
(44, 20, 2),
(61, 22, 6),
(62, 22, 1),
(65, 23, 6),
(66, 21, 1),
(67, 21, 2),
(71, 18, 1),
(72, 18, 10),
(73, 18, 8),
(74, 25, 6),
(76, 27, 1),
(77, 27, 2),
(78, 28, 7),
(79, 28, 1),
(80, 29, 1),
(96, 30, 1),
(97, 30, 9),
(98, 30, 2),
(99, 26, 6),
(100, 31, 8),
(101, 32, 10),
(102, 32, 2),
(107, 34, 1),
(108, 34, 5),
(109, 34, 2),
(110, 34, 3),
(111, 35, 1),
(112, 35, 5),
(113, 35, 2),
(114, 35, 3),
(133, 33, 1),
(134, 33, 2),
(135, 36, 6),
(136, 37, 7),
(137, 38, 1),
(138, 39, 8),
(144, 40, 1),
(145, 40, 9),
(146, 40, 5),
(147, 40, 10),
(148, 40, 2);

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE IF NOT EXISTS `job_type` (
  `job_type_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_type_desc` text,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Visibility status. 0=>Inactive, 1=> Active'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`job_type_id`, `job_title`, `job_type_desc`, `status`) VALUES
(1, 'Full Time', 'Full Time', '1'),
(2, 'Part Time', 'Part Time', '1'),
(3, 'Freelance', 'Freelance', '1');

-- --------------------------------------------------------

--
-- Table structure for table `languages`
--

CREATE TABLE IF NOT EXISTS `languages` (
  `id` int(10) unsigned NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `locale` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weight` int(10) unsigned NOT NULL,
  `fallback_locale` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Deafult language',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `languages`
--

INSERT INTO `languages` (`id`, `name`, `locale`, `weight`, `fallback_locale`, `created_at`, `updated_at`) VALUES
(1, 'English', 'en', 1, 'Y', '2017-06-15 09:04:45', '2017-06-15 09:04:45'),
(2, 'Dutch', 'nl', 2, 'N', '2017-06-15 09:04:45', '2017-06-15 09:04:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) unsigned NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2017_06_09_121924_create_countries_table', 1),
(2, '2017_06_09_122401_create_states_table', 1),
(3, '2017_06_09_122409_create_cities_table', 1),
(4, '2017_06_13_075829_create_settings_table', 1),
(5, '2017_06_13_151208_create_admin_table', 1),
(6, '2017_06_15_060855_create_languages_table', 1),
(7, '2017_06_30_132125_create_users_table', 1),
(8, '2017_06_30_140610_create_customer_addresses_table', 1),
(9, '2017_07_01_100000_create_password_resets_table', 1),
(10, '2017_07_03_112007_create_sellers_table', 1),
(11, '2017_07_03_113433_create_tags_table', 1),
(12, '2017_07_03_144241_create_categories_table', 1),
(13, '2017_07_03_144342_create_brands_table', 1),
(14, '2017_07_03_144834_create_shipping_templates_table', 1),
(15, '2017_07_03_145412_create_products_table', 1),
(16, '2017_07_03_145436_create_product_images_table', 1),
(17, '2017_07_04_110928_create_product_colors_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `monthly_bid_details`
--

CREATE TABLE IF NOT EXISTS `monthly_bid_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `job_id` int(11) DEFAULT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `bid_debited_credit_amount` int(11) NOT NULL DEFAULT '0',
  `type` enum('D','C') NOT NULL DEFAULT 'D' COMMENT 'D=>Bid debited for job after sent job proposal, C=>Bid credited after buy bid',
  `amount_type` enum('F','P') NOT NULL DEFAULT 'F' COMMENT 'F=Free bid, P=Paid bid',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `monthly_bid_details`
--

INSERT INTO `monthly_bid_details` (`id`, `user_id`, `job_id`, `proposal_id`, `bid_debited_credit_amount`, `type`, `amount_type`, `created_at`, `updated_at`) VALUES
(1, 7, NULL, NULL, 15, 'C', 'P', '2017-11-06 20:01:58', '2017-11-06 20:01:58'),
(2, 7, NULL, NULL, 5, 'C', 'P', '2017-11-06 20:42:48', '2017-11-06 20:42:48'),
(3, 7, NULL, NULL, 25, 'C', 'P', '2017-11-06 20:45:17', '2017-11-06 20:45:17'),
(4, 1, NULL, NULL, 15, 'C', 'P', '2017-11-07 15:25:02', '2017-11-07 15:25:02'),
(5, 1, NULL, NULL, 5, 'C', 'P', '2017-11-07 15:25:39', '2017-11-07 15:25:39'),
(6, 1, 28, 22, 1, 'D', 'P', '2017-11-10 16:06:06', '2017-11-10 16:06:06'),
(7, 2, NULL, NULL, 5, 'C', 'P', '2017-11-13 21:27:27', '2017-11-13 21:27:27'),
(8, 2, 28, 23, 1, 'D', 'P', '2017-11-13 21:28:07', '2017-11-13 21:28:07'),
(9, 2, 29, 24, 1, 'D', 'P', '2017-11-13 21:29:04', '2017-11-13 21:29:04'),
(10, 10, NULL, NULL, 50, 'C', 'P', '2017-11-15 01:14:34', '2017-11-15 01:14:34'),
(11, 14, NULL, NULL, 50, 'C', 'P', '2017-11-15 22:07:20', '2017-11-15 22:07:20'),
(12, 10, 31, 25, 1, 'D', 'P', '2017-11-17 14:58:57', '2017-11-17 14:58:57'),
(13, 1, 32, 26, 1, 'D', 'P', '2017-11-20 21:22:22', '2017-11-20 21:22:22'),
(14, 10, 30, 27, 1, 'D', 'P', '2017-11-20 22:24:45', '2017-11-20 22:24:45'),
(15, 10, 35, 28, 1, 'D', 'P', '2017-11-23 16:10:02', '2017-11-23 16:10:02'),
(16, 15, NULL, NULL, 5, 'C', 'P', '2017-11-23 16:46:21', '2017-11-23 16:46:21'),
(17, 15, 30, 29, 1, 'D', 'P', '2017-11-23 16:47:24', '2017-11-23 16:47:24'),
(18, 1, 36, 30, 1, 'D', 'P', '2017-11-23 21:45:59', '2017-11-23 21:45:59'),
(19, 4, NULL, NULL, 50, 'C', 'P', '2017-11-24 02:28:28', '2017-11-24 02:28:28'),
(20, 4, NULL, NULL, 50, 'C', 'P', '2017-11-24 02:28:29', '2017-11-24 02:28:29'),
(21, 4, 39, 31, 1, 'D', 'P', '2017-11-24 02:29:34', '2017-11-24 02:29:34'),
(22, 16, NULL, NULL, 50, 'C', 'P', '2017-11-25 03:02:17', '2017-11-25 03:02:17'),
(23, 16, 38, 32, 1, 'D', 'P', '2017-11-25 03:08:33', '2017-11-25 03:08:33'),
(24, 14, 40, 33, 1, 'D', 'P', '2017-11-25 03:38:50', '2017-11-25 03:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `notification_masters`
--

CREATE TABLE IF NOT EXISTS `notification_masters` (
  `id` int(11) NOT NULL,
  `details` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `notification_masters`
--

INSERT INTO `notification_masters` (`id`, `details`, `is_active`) VALUES
(1, 'Job invitations', 'Y'),
(2, 'New jobs posted', 'Y'),
(3, 'Job recommendations', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('heropersian@gmail.com', '$2y$10$aTbOOwZQijV347x6VPxIn.UzTqghmRpWDZDtJgNpxIrLhN5Xko232', '2017-09-26 19:38:21'),
('nanu_rtc@yahoo.com', '$2y$10$8fyfICp3GQLRaZsYhsYUQe2RqzwkDSIrL6ReNpkpiYvPiwHmMG/DG', '2017-10-04 20:32:11'),
('pabitra@technoexponent.com', '$2y$10$kNjUGWst1uGCNuogkARpTOZMErJNo..hkxlj8KhaKml6KybTQ/F3K', '2017-10-09 12:12:15'),
('nejad.saman@gmail.com', '$2y$10$JLGUWDnyOblPJ1MRPOjrleFc7Ap/lIwU2bE/6vpEALsO5PzCeNhS.', '2017-11-25 08:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `portfolios_like_share_preview`
--

CREATE TABLE IF NOT EXISTS `portfolios_like_share_preview` (
  `action_id` int(11) NOT NULL,
  `portfolio_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `action_status` enum('1','2','3') NOT NULL COMMENT '1=>Like, 2=>Preview, 3=>Share',
  `date_time` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolios_like_share_preview`
--

INSERT INTO `portfolios_like_share_preview` (`action_id`, `portfolio_id`, `user_id`, `action_status`, `date_time`) VALUES
(1, 2, 7, '1', '2017-10-28 17:18:17'),
(2, 2, 1, '1', '2017-10-28 17:33:33'),
(3, 1, 1, '2', '2017-10-28 17:33:51'),
(4, 1, 7, '2', '2017-10-28 17:34:03'),
(5, 13, 4, '2', '2017-10-28 23:10:53'),
(6, 13, 10, '2', '2017-10-29 22:55:33'),
(7, 12, 10, '2', '2017-10-29 22:55:39'),
(8, 10, 10, '2', '2017-10-29 22:55:43'),
(9, 12, 4, '2', '2017-10-30 00:10:16'),
(10, 14, 10, '2', '2017-10-30 13:54:21'),
(11, 11, 10, '2', '2017-10-30 13:54:24'),
(12, 10, 1, '2', '2017-11-01 20:02:01'),
(13, 12, 4, '1', '2017-11-01 21:28:05'),
(14, 13, 1, '2', '2017-11-02 12:51:50'),
(15, 12, 1, '2', '2017-11-02 12:51:56'),
(16, 8, 10, '2', '2017-11-02 17:49:43'),
(17, 5, 4, '1', '2017-11-02 20:49:06'),
(18, 10, 4, '2', '2017-11-08 03:56:23'),
(19, 5, 1, '2', '2017-11-11 14:56:19'),
(20, 14, 13, '2', '2017-11-17 15:05:47'),
(21, 15, 13, '2', '2017-11-23 21:25:48'),
(22, 18, 13, '2', '2017-11-23 22:17:20'),
(23, 18, 13, '1', '2017-11-23 22:17:36'),
(24, 18, 10, '2', '2017-11-24 01:30:46'),
(25, 15, 4, '2', '2017-11-24 01:31:46');

-- --------------------------------------------------------

--
-- Table structure for table `postedjobs`
--

CREATE TABLE IF NOT EXISTS `postedjobs` (
  `job_id` int(11) NOT NULL,
  `posted_by_user` int(11) NOT NULL,
  `experience_level` int(11) NOT NULL,
  `project_length` int(11) NOT NULL,
  `location` varchar(300) NOT NULL,
  `turn_around_time` int(11) NOT NULL,
  `job_type` int(11) NOT NULL DEFAULT '0',
  `budget_type` int(11) NOT NULL,
  `budget_amount` float(10,2) NOT NULL DEFAULT '0.00',
  `paymentType` varchar(50) DEFAULT NULL,
  `roundsOfRevisions` varchar(255) DEFAULT NULL,
  `needs_to_design_job` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `attached_file` varchar(200) NOT NULL,
  `have_assesment` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=>Have Assesments, 0=>Does not have Assesments',
  `job_reference_id` varchar(30) NOT NULL,
  `total_proposal` int(5) DEFAULT '0',
  `is_urgent_assignment` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `job_status` enum('1','2','3','4','5') NOT NULL DEFAULT '1' COMMENT '1=>All Jobs, 2=>In Progress, 3=>Pending, 4=>Completed, 5=>Get a quote',
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postedjobs`
--

INSERT INTO `postedjobs` (`job_id`, `posted_by_user`, `experience_level`, `project_length`, `location`, `turn_around_time`, `job_type`, `budget_type`, `budget_amount`, `paymentType`, `roundsOfRevisions`, `needs_to_design_job`, `category`, `subcategory`, `job_description`, `attached_file`, `have_assesment`, `job_reference_id`, `total_proposal`, `is_urgent_assignment`, `created_at`, `created_ip`, `job_status`, `updated_at`) VALUES
(1, 2, 1, 1, 'kolkata', 1, 0, 2, 0.00, NULL, NULL, 'sabya', 2, 3, 'sdfsd', '1501860004UySDYGUT4H-DOC.jpg', '0', '150376125814898', 1, 'N', '2017-08-04 15:20:04', '', '1', '2017-08-26 16:45:25'),
(2, 1, 1, 1, 'Kolkata, WB, India', 1, 0, 2, 0.00, NULL, NULL, 'Need an web portal', 1, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1501861098zGW2M3bEFz-DOC.jpg', '1', '158936778514898', 3, 'N', '2017-08-24 12:05:00', '', '2', '2017-10-23 16:21:35'),
(3, 4, 2, 3, 'London', 2, 0, 3, 0.00, NULL, NULL, 'New logo', 2, 5, 'I need a new logo', '15019371122QSJ8BWcJ7-DOC.png', '0', '150376748514898', 1, 'N', '2017-08-14 21:00:32', '', '1', '2017-09-02 17:47:22'),
(4, 9, 2, 3, 'New York', 2, 0, 3, 0.00, NULL, NULL, 'New website', 1, 3, 'New website for selling clothes online', '1503767785qpy5AnG3X6-DOC.png', '1', '150376778514898', 1, 'N', '2017-08-26 17:16:25', '', '1', '2017-08-26 17:17:56'),
(5, 9, 3, 1, 'Dubai', 2, 0, 2, 0.00, NULL, NULL, 'new logo', 2, 5, 'new logo', '1503768135uOSBKYOOEG-DOC.png', '1', '150376813591435', 1, 'N', '2017-08-26 17:22:15', '', '1', '2017-08-26 17:25:46'),
(6, 4, 1, 2, 'London', 1, 0, 1, 0.00, NULL, NULL, 'Video animator', 2, 6, 'Hello world', '1504370134Ve51Cy0Xw1-DOC.jpg', '1', '150437013464233', 1, 'N', '2017-09-02 16:35:34', '', '1', '2017-09-02 16:36:34'),
(7, 4, 3, 3, 'Oxford', 2, 0, 2, 0.00, NULL, NULL, 'Videooo', 2, 4, 'heyyy aldkjf ladjl ajdlfa jsdlf ajdlf asdlfjkasd l;fjkas;d', '15043745308s6D7fXqXg-DOC.jpg', '1', '150437453040155', 3, 'N', '2017-09-02 17:48:50', '', '1', '2017-10-04 08:09:13'),
(8, 10, 1, 1, 'Oxford', 1, 0, 1, 0.00, NULL, NULL, 'Anything', 2, 5, 'Need a developer who can deliver the job on time!', '1507104673JzZgPqw4ao-DOC.png', '1', '150710467315476', 1, 'N', '2017-10-04 08:11:13', '', '2', '2017-11-15 16:30:28'),
(9, 1, 1, 1, 'kolkata', 1, 0, 2, 0.00, NULL, NULL, 'Job to work', 1, 4, 'Job to work', '1507616750viCIzred8u-DOC.docx', '1', '150761675075359', 1, 'N', '2017-10-10 06:25:50', '', '2', '2017-10-17 15:41:26'),
(10, 1, 2, 2, 'kolkata', 2, 1, 2, 365.00, NULL, NULL, 'check job test', 1, 3, 'asdas asd asd asd', '1507705986PWstfZMVMb-DOC.docx', '1', '150770598684401', 1, 'N', '2017-10-20 16:13:40', '', '2', '2017-11-02 16:18:03'),
(11, 11, 1, 1, 'Kolklata', 1, 0, 2, 0.00, NULL, NULL, 'Test Job', 2, 3, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1508342284smpw1fjkg7-DOC.png', '1', '150834228472095', 1, 'N', '2017-10-18 15:58:04', '', '1', '2017-11-01 13:04:11'),
(12, 7, 1, 1, 'Kolkata', 2, 1, 2, 500.00, NULL, NULL, 'Test job search', 1, 5, 'I add a field to the users migration, "type" to defer the users type.\r\nWhat I want is, when a user log in to the website, it''s redirect to a proper page, different for each one.\r\nThe laravel auth assumes that all the users are the same, how can I change that, using the "type" field ?\r\nThanks in advance.', '15085007750xfz9GlbJd-DOC.png', '1', '150850077556625', 1, 'N', '2017-10-20 17:29:35', '', '4', '2017-11-01 14:38:33'),
(15, 4, 1, 1, 'london', 2, 1, 1, 100000000.00, NULL, NULL, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has su', 2, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1509635570Gu9FNx36ya-DOC.png', '1', '150963557070838', 0, 'N', '2017-11-02 20:42:50', '', '1', '2017-11-02 20:42:50'),
(17, 1, 1, 1, 'Get a Quote', 1, 1, 1, 0.00, NULL, NULL, 'Get a Quote', 2, 3, 'Get a Quote', '', '0', '150963672860384', 1, 'N', '2017-11-02 21:02:08', '', '5', '2017-11-02 21:02:08'),
(18, 1, 2, 2, 'kolkata', 1, 1, 1, 1000.00, NULL, NULL, 'Need Jobs', 1, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1509639253xDrsuF3BHl-DOC.png', '1', '150963925337870', 0, 'Y', '2017-11-09 13:43:28', '', '1', '2017-11-09 13:43:56'),
(19, 10, 1, 1, 'Get a Quote', 1, 1, 1, 0.00, NULL, NULL, 'Get a Quote', 2, 3, 'Get a Quote', '', '0', '150969945443470', 1, 'N', '2017-11-03 14:27:34', '', '5', '2017-11-03 14:27:34'),
(20, 1, 1, 2, 'kolkata', 1, 1, 2, 259.00, NULL, NULL, 'Get a Quote Test Job', 1, 3, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.\r\nIt has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1509945855eKrJ6RYPhx-DOC.png', '1', '150994585568499', 0, 'N', '2017-11-06 10:54:15', '', '1', '2017-11-06 10:54:15'),
(21, 1, 3, 1, 'Delhi', 1, 1, 3, 1000.00, NULL, NULL, 'Lorem Ipsum', 1, 7, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English.\r\nMany desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1509946654NCsmrq2gZV-DOC.png', '1', '150994665482022', 0, 'Y', '2017-11-09 12:32:14', '', '1', '2017-11-09 12:32:14'),
(22, 1, 1, 1, 'kolkata', 1, 1, 2, 1000.00, NULL, NULL, 'new Test Job 07.11', 1, 3, 'sd ds ds', '1510047902ZghxpIUogE-DOC.docx', '1', '151004790294192', 0, 'Y', '2017-11-07 15:15:02', '', '1', '2017-11-07 15:16:11'),
(23, 1, 1, 1, 'kolkata', 1, 1, 1, 22.00, NULL, NULL, 'test job 07.11.2017 - 2', 1, 3, 'asdas', '1510048036GcyVQpUAo4-DOC.doc', '0', '151004803687600', 1, 'Y', '2017-11-09 12:31:53', '', '1', '2017-11-09 18:15:19'),
(24, 1, 1, 1, 'Get a Quote', 1, 1, 1, 0.00, NULL, NULL, 'test 0711', 2, 3, 'test 0711', '', '0', '151004817654338', 1, 'N', '2017-11-07 15:19:36', '', '5', '2017-11-07 15:19:36'),
(25, 1, 2, 1, 'kolkata', 2, 1, 2, 20000.00, NULL, NULL, 'sadasdasd', 2, 5, 'asdasdsad', '1510223463g6z0ahyeuW-DOC.jpg', '1', '151022346341613', 0, 'N', '2017-11-09 16:01:03', '', '1', '2017-11-09 16:01:03'),
(26, 1, 2, 1, 'Remotely (anywhere)', 1, 1, 2, 20000.00, 'Bank', 'Revisions', 'sadasdasd', 1, 5, 'asdasdsad', '15102235357Sxn94JvPG-DOC.jpg', '0', '151022353533526', 0, 'Y', '2017-11-16 20:32:18', '', '1', '2017-11-16 20:32:18'),
(27, 7, 1, 1, 'kolkata', 2, 1, 2, 259.00, NULL, NULL, 'Test 3', 1, 5, 'cxv xc vblkn jngck k njn jmfh jfk;lg fd gfd', '1510231617cZU7NLCbEy-DOC.jpg', '1', '151023161724079', 1, 'N', '2017-11-09 18:16:57', '', '1', '2017-11-09 18:22:58'),
(28, 7, 1, 2, 'kolkata', 1, 1, 2, 255.00, NULL, NULL, 'Test 4', 1, 5, 'xvb cvb fghfjhkjlhkhj kghhg', '1510240626PxAEyYqFyg-DOC.jpg', '1', '151024062616712', 2, 'N', '2017-11-09 20:47:06', '', '1', '2017-11-13 21:28:07'),
(29, 1, 2, 3, 'kolkata', 2, 1, 2, 100.00, NULL, NULL, 'Test 5', 1, 7, 'm  jkhjgjfg jfgh', '1510240705Lrf6jDWqw0-DOC.jpg', '1', '151024070523161', 1, 'N', '2017-11-09 20:48:25', '', '4', '2017-11-13 21:29:56'),
(30, 1, 2, 2, 'Remotely (anywhere)', 2, 1, 2, 551.00, 'Bank', 'Revisions1', 'What is Lorem Ipsum?', 1, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1510843191UwnEXkbSc2-DOC.jpg', '1', '151084319159797', 2, 'N', '2017-11-16 20:31:33', '', '1', '2017-11-23 16:47:24'),
(31, 13, 1, 1, 'On-site (preferred location)', 2, 1, 1, 100.00, 'Bank', '2', 'Graphics', 2, 6, 'qwertyuiopasdfghjklzxcvbnm', '15108659921qfafUDOmi-DOC.jpg', '1', '151086599241942', 1, 'N', '2017-11-17 02:29:52', '', '2', '2017-11-24 03:55:00'),
(32, 13, 1, 1, 'Remotely (anywhere)', 2, 1, 1, 100.00, 'Bank', '2', 'Graphics 20th', 2, 3, 'qwertyuip', '1511193096SHGdU04o8S-DOC.jpg', '1', '151119309640110', 1, 'N', '2017-11-20 21:21:36', '', '4', '2017-11-20 21:27:53'),
(33, 1, 2, 2, 'Both', 2, 1, 2, 255.00, 'Fixed', '', 'Test job', 7, 98, 'Description', '', '1', '151136277277227', 0, 'N', '2017-11-23 21:26:59', '', '1', '2017-11-23 21:26:59'),
(34, 14, 2, 2, 'Remotely (anywhere)', 2, 1, 3, 100.00, 'Bank', '3', 'Motion Graphics Design', 2, 4, 'I need a professional video producer for 2 days in Oxford!', '', '1', '151143338731624', 0, 'N', '2017-11-23 16:06:27', '', '1', '2017-11-23 16:06:27'),
(35, 14, 2, 2, 'Remotely (anywhere)', 2, 1, 3, 100.00, 'Bank', '3', 'Motion Graphics Design', 2, 4, 'I need a professional video producer for 2 days in Oxford!', '', '1', '151143341952053', 1, 'N', '2017-11-23 16:06:59', '', '2', '2017-11-23 16:12:47'),
(36, 2, 1, 1, 'Onsite', 2, 1, 2, 1111.00, 'Fixed', '222', 'Test 2311', 12, 166, 'Test 2311', '', '1', '151145371837218', 1, 'N', '2017-11-23 21:45:18', '', '4', '2017-11-23 21:47:48'),
(37, 10, 2, 1, 'Both', 3, 3, 2, 300.00, 'Both', '1', 'Looking for a Russian translator', 9, 138, 'Russian translator needed for a book translation.', '', '1', '151146743451534', 0, 'N', '2017-11-24 01:33:54', '', '1', '2017-11-24 01:33:54'),
(38, 4, 3, 2, 'Onsite', 2, 2, 3, 10000.00, 'Fixed', '', 'Test New Job', 1, 15, 'Test new job', '', '1', '151146749729663', 1, 'N', '2017-11-24 01:34:57', '', '1', '2017-11-25 03:08:33'),
(39, 13, 1, 1, 'Onsite', 2, 1, 1, 100.00, 'Hourly', '3', 'Testing', 5, 76, 'qwertyuiop', '', '1', '151146779213122', 1, 'N', '2017-11-24 01:39:52', '', '2', '2017-11-24 02:31:04'),
(40, 16, 2, 1, 'Both', 2, 1, 1, 100.00, 'Both', '1', 'website design job', 2, 35, 'Website designer needed in London', '', '0', '151156053779563', 1, 'N', '2017-11-25 03:27:20', '', '1', '2017-11-25 03:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `project_lengths`
--

CREATE TABLE IF NOT EXISTS `project_lengths` (
  `id` int(11) NOT NULL,
  `length_type` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_lengths`
--

INSERT INTO `project_lengths` (`id`, `length_type`, `status`) VALUES
(1, 'Week', '1'),
(2, 'Month', '1'),
(3, '6 month', '1');

-- --------------------------------------------------------

--
-- Table structure for table `project_settings`
--

CREATE TABLE IF NOT EXISTS `project_settings` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `working_days_from` int(2) DEFAULT NULL,
  `working_days_to` int(2) DEFAULT NULL,
  `working_hours` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_settings`
--

INSERT INTO `project_settings` (`id`, `job_id`, `working_days_from`, `working_days_to`, `working_hours`) VALUES
(1, 8, 3, 2, '20'),
(2, 7, 2, 3, NULL),
(3, 2, 2, 6, NULL),
(4, 10, 2, 6, '8'),
(5, 15, 2, 3, NULL),
(6, 38, 1, 1, '23');

-- --------------------------------------------------------

--
-- Table structure for table `security_questions`
--

CREATE TABLE IF NOT EXISTS `security_questions` (
  `id` int(11) NOT NULL,
  `question` text COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `security_questions`
--

INSERT INTO `security_questions` (`id`, `question`, `is_active`, `created_at`, `updated_at`) VALUES
(1, 'Your first teacher in School?', 'Y', '2017-10-09 15:19:52', '0000-00-00 00:00:00'),
(2, 'What is your pet name?', 'Y', '2017-10-09 15:19:52', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) unsigned NOT NULL,
  `admin_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_logo` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_fb_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_twitter_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_gplus_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_linkedin_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `site_pinterest_link` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `admin_commission_per_job` float(10,2) NOT NULL DEFAULT '0.00',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_name`, `admin_email`, `site_title`, `contact_email`, `contact_name`, `contact_phone`, `site_logo`, `site_fb_link`, `site_twitter_link`, `site_gplus_link`, `site_linkedin_link`, `site_pinterest_link`, `admin_commission_per_job`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'wholesale', 'info@admin.com', 'Contact wholesale', '1234567890', '14988183520h4QbVdYWB.png', 'https://www.facebook.com/example', 'https://www.twitter.com/example', 'https://plus.google.com/u/0/+example', 'https://www.linkedin.com/example', 'https://www.pinterest.com/example', 10.00, NULL, '2017-06-30 19:01:56');

-- --------------------------------------------------------

--
-- Table structure for table `settings_jobs`
--

CREATE TABLE IF NOT EXISTS `settings_jobs` (
  `id` int(11) NOT NULL,
  `free_credit_to_all` int(11) DEFAULT '0',
  `normal_fee_per_bid` int(11) NOT NULL DEFAULT '0',
  `highlight_bid_fee` int(11) DEFAULT '0',
  `modified_by` int(11) DEFAULT '0',
  `updated_at` datetime NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `settings_jobs`
--

INSERT INTO `settings_jobs` (`id`, `free_credit_to_all`, `normal_fee_per_bid`, `highlight_bid_fee`, `modified_by`, `updated_at`, `created_at`) VALUES
(1, 15, 1, 1, 1, '2017-11-03 15:20:01', '2017-11-03 15:20:01');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE IF NOT EXISTS `skills` (
  `skill_id` int(11) NOT NULL,
  `skill_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Visibility Status. 0=> Inactive, 1=> Active'
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`skill_id`, `skill_name`, `status`) VALUES
(1, 'CodeIgniter', '1'),
(2, 'Laravel', '1'),
(3, 'Symfony', '1'),
(4, 'Zend', '1'),
(5, 'Java', '1'),
(6, 'C', '1'),
(7, 'C++', '1'),
(8, 'WordPress', '1'),
(9, 'Hybrid', '1'),
(10, 'Joomla', '1');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_assigned_members`
--

CREATE TABLE IF NOT EXISTS `task_assigned_members` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `assigned_by_user` int(11) NOT NULL,
  `assigned_to_member` int(11) NOT NULL,
  `is_completed` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `due_date` date NOT NULL,
  `assigned_date` datetime NOT NULL,
  `priority` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_assigned_members`
--

INSERT INTO `task_assigned_members` (`id`, `job_id`, `task_id`, `type`, `assigned_by_user`, `assigned_to_member`, `is_completed`, `due_date`, `assigned_date`, `priority`) VALUES
(1, 8, 1, '1', 10, 1, 'N', '2017-11-15', '2017-11-15 16:34:34', '1'),
(2, 31, 2, '3', 10, 13, 'N', '2017-11-17', '2017-11-18 01:40:06', '1'),
(3, 32, 3, '2', 13, 1, 'N', '2017-11-30', '2017-11-20 21:26:11', '1'),
(4, 39, 4, '1', 13, 4, 'N', '2017-11-30', '2017-11-24 02:32:10', '1');

-- --------------------------------------------------------

--
-- Table structure for table `task_attachments`
--

CREATE TABLE IF NOT EXISTS `task_attachments` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `task_attachments`
--

INSERT INTO `task_attachments` (`id`, `job_id`, `task_id`, `file_name`) VALUES
(1, 8, 1, '6524831510743860TN.png');

-- --------------------------------------------------------

--
-- Table structure for table `travel_master`
--

CREATE TABLE IF NOT EXISTS `travel_master` (
  `travel_id` int(11) NOT NULL,
  `travel_type` text COLLATE utf8_unicode_ci NOT NULL,
  `travel_distance` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` enum('0','1') CHARACTER SET latin1 NOT NULL DEFAULT '1' COMMENT 'Visibility status. 0=>Inactive, 1=> Active'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `travel_master`
--

INSERT INTO `travel_master` (`travel_id`, `travel_type`, `travel_distance`, `status`) VALUES
(1, 'I can work remotely', NULL, '1'),
(2, 'I can work onsite', NULL, '1'),
(3, 'Both', NULL, '1');

-- --------------------------------------------------------

--
-- Table structure for table `turn_around_times`
--

CREATE TABLE IF NOT EXISTS `turn_around_times` (
  `id` int(11) NOT NULL,
  `around_time_type` varchar(200) NOT NULL,
  `is_need_payment` enum('Y','N') NOT NULL DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `payable_amount` float(7,2) DEFAULT '0.00',
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turn_around_times`
--

INSERT INTO `turn_around_times` (`id`, `around_time_type`, `is_need_payment`, `payable_amount`, `status`) VALUES
(1, 'Urgent', 'Y', 3.00, '1'),
(2, 'Normal', 'N', 0.00, '1'),
(3, 'No planning', 'N', 0.00, '1');

-- --------------------------------------------------------

--
-- Table structure for table `update_masters`
--

CREATE TABLE IF NOT EXISTS `update_masters` (
  `id` int(11) NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `update_masters`
--

INSERT INTO `update_masters` (`id`, `details`, `is_active`) VALUES
(1, 'Daily special Offers', 'Y'),
(2, 'Promotions, Product updates', 'Y'),
(3, 'Newsletter and Comunity', 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_name` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number_code` varchar(5) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone_number` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = Freelancer, 2 = Job Provider',
  `login_type` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = Normal, 2 = LinkedIn, 3 = Google +, 4 = Github, 5 = Facebook',
  `is_active` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y = Active, N = Not Active',
  `profile_picture` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_signature` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `profile_availability` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0' COMMENT 'profile available in search engine. 0=> No, 1=> Yes',
  `language_id` int(10) unsigned DEFAULT NULL,
  `country_id` int(10) unsigned DEFAULT NULL,
  `provider` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `provider_id` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `profile_link` text COLLATE utf8mb4_unicode_ci COMMENT 'Profile Link of this user',
  `stripe_customer_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `available_from` int(2) DEFAULT '0',
  `available_to` int(2) DEFAULT '0',
  `question_id` int(11) DEFAULT '0',
  `answer` text COLLATE utf8mb4_unicode_ci,
  `notificationSoundAlert` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `showEarningsInProfile` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Y',
  `showClientFeedbackInProfile` enum('Y','N') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'N',
  `paymentVatRegNo` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentIdentificationSettings` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `paymentSecuritySettings` enum('Y','N') COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Y=Active, N=Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `first_name`, `last_name`, `phone_number_code`, `phone_number`, `password`, `remember_token`, `type`, `login_type`, `is_active`, `profile_picture`, `profile_signature`, `profile_availability`, `language_id`, `country_id`, `provider`, `provider_id`, `created_at`, `updated_at`, `profile_link`, `stripe_customer_id`, `available_from`, `available_to`, `question_id`, `answer`, `notificationSoundAlert`, `showEarningsInProfile`, `showClientFeedbackInProfile`, `paymentVatRegNo`, `paymentIdentificationSettings`, `paymentSecuritySettings`) VALUES
(1, 'pabitra@technoexponent.com', 'PKM', 'Pabitra', 'Mandal', NULL, NULL, '$2y$10$6cHokasbv0hp1VVKHrfX2OsCEO4l1x1VY/N7F2A0qVgtrtLGrAiaS', 'Yhqg6CRaYU7qrZCVjLOR3Gj4EWLbCMgKtKOuL5P64PydNYFlaEPJ7f64rVHi', 2, 1, 'Y', '1-1-7.jpg', 'Pabitra-M11508150122.png', '', NULL, NULL, NULL, NULL, '2017-07-25 14:49:33', '2017-11-02 23:25:12', NULL, 'cus_BVrUljnCkvofoR', 5, 5, 2, 'Pabitra', 'Y', 'N', 'Y', '0145262', 'Aadhaar Card', 'N'),
(2, 'technoexponent02@gmail.com', 'technoexponent02', 'S', 'Saha', NULL, NULL, '$2y$10$MvuZ4nwBOvPmLdbsFW17Y.A3R2k0rfdHqC2x0bDk9LDof.GmnjSWK', 'alwF7nXsGLbIY9WHa0SdSTVLxkcU5vbqrfGFbzDVM461EU2VlrbclC4MSdkL', 1, 1, 'Y', '2-fl-18-07-2017-16-42-32.jpg', NULL, '', NULL, NULL, NULL, NULL, '2017-07-25 17:08:25', '2017-11-14 03:27:26', NULL, 'cus_BlGrSCrdlHqQkT', 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(3, 'hello@matchpol.net', 'SJ', 'Sunny', 'Jim', NULL, NULL, '$2y$10$/tLQYWOUOSXq7nbPYR6cUOW4xoDnFLPENgnADzNgtU3z4d5.gRukW', 'SHxKjwE2QWprpoMtkqhVu0qqgj2c8v2DGwwySBzDzwvrhXOX0UWIVUaLlsHV', 2, 1, 'Y', NULL, NULL, '', NULL, NULL, NULL, NULL, '2017-07-25 19:57:39', '2017-07-25 19:57:39', NULL, NULL, 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(4, 'nanu_rtc@yahoo.com', 'ion', 'Ion', 'Paaa', NULL, NULL, '$2y$10$UFV7F7CiUeL6kSSrPuz1FOBhE.wTDSKqQS0QCl8D4CYyOQi.oxIby', 'quheEQ3RziQmB3I5IbnzArSRUBD8bdPwEtJVzjpFF66BxLqo2KrR8ggZg0bv', 1, 1, 'Y', NULL, NULL, '', NULL, NULL, NULL, NULL, '2017-08-05 17:33:07', '2017-11-24 08:28:27', NULL, 'cus_Bp5yK8wN5w0l3J', 1, 2, 0, NULL, 'Y', 'Y', 'Y', '3434444', 'Voter ID', NULL),
(5, 'dan.vorosky@gmail.com', 'dan', 'D', 'Vorosky', NULL, NULL, '$2y$10$AYqRoTLx5UmkHc7pRYtfj.ZTYjC0bbQVj2lpngQVJBQgSQeFNPCN6', 'AzCC4nCqGi8VFUOayebPFJcdSOk4xEYrQsjhjHP55JMemxfFghl7jjw8KDvZ', 1, 1, 'Y', NULL, NULL, '1', NULL, NULL, NULL, NULL, '2017-08-14 23:54:11', '2017-08-14 23:54:11', NULL, NULL, 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(6, 'timrichardson@uymail.com', 'tim', 'Tim', 'Richardson', NULL, NULL, '$2y$10$uN5L3KYdTfQQr5eOaSbiluCQzSfotonr4No1YIivEX6e0zZ578d1S', '5p6PpE3I7iz5eyhmsyfia6zmF2VyOS7smUwAU8Nr4VmOdmyZU2Ea3WWV3dJd', 1, 1, 'Y', NULL, NULL, '1', NULL, NULL, NULL, NULL, '2017-08-15 00:12:44', '2017-08-15 00:12:44', NULL, NULL, 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(7, 'navinr@europe.com', 'nav', 'Navin', 'Raj', NULL, NULL, '$2y$10$q9Ofssua9eVqExp9b9dk6ej0OQ4bjHheTBw5ZlDpgPTp/bQ6dwR.m', '3H97fwyRSF8KgJeIWgO0DjM13ZXwk5M8KquexHShqSbGytPpPQZN8fp0Q4AC', 1, 1, 'Y', '7-1455878863current_offerroom-image6.jpg', NULL, '0', NULL, NULL, NULL, NULL, '2017-08-15 00:57:12', '2017-11-01 18:18:42', NULL, 'cus_BgeG1cpNM9AaoG', 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(8, 'nejad.saman@gmail.com', 'saman', 'Sam', 'Nejad', NULL, NULL, '$2y$10$5HFb7tKoi6TCRsiqwcFF8uS8hgxCPPOYyU7jYez6w76YnnLOl4y5e', NULL, 2, 1, 'N', NULL, NULL, '0', NULL, NULL, NULL, NULL, '2017-08-15 17:05:00', '2017-08-15 17:05:00', NULL, NULL, 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(9, 'nanuofficial@googlemail.com', 'ion12', 'Ion', 'Pantalon', NULL, NULL, '$2y$10$EEzgb77mrc8D67SjmB2OD.ZL4byFdLsAA7lFyEXj9EG.ZzjXSl166', 'Bgbi8wz9CKDOde2g9Ra8wBxybiyazNOnKsza7fov5IyboEOkCPa0dnkvUq3t', 2, 1, 'Y', NULL, NULL, '0', NULL, NULL, NULL, NULL, '2017-08-26 21:59:50', '2017-08-26 21:59:50', NULL, NULL, 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(10, 'heropersian@gmail.com', 'saman123', 'sam', 'nej', NULL, NULL, '$2y$10$7Ejd8Yo/B8Uxn.OSRajfAO3aclbjN6w1LzhHLjs5z5yHCy2HQpD0S', 'VrCNHKKdWBJM9k78RygzZ3ts2Nd4LYPrv3qH9m1P6MSlcwAARxlUIKZJaP4b', 1, 1, 'Y', '10-screen-shot-2017-10-13-at-12.21.21.png', NULL, '1', NULL, NULL, NULL, NULL, '2017-09-25 22:29:18', '2017-11-15 07:14:32', NULL, 'cus_Blhkg5IDt0qy5C', 1, 3, 1, '111', 'Y', 'Y', 'N', NULL, 'Passport', NULL),
(11, 'avoy.php@gmail.com', 'avoydebnath', 'Avoy', 'Debnath', NULL, NULL, '$2y$10$sC7WQRiejjn69jqzpdf2zOsq8V3kEUNIm2PsN2rIFABT4wpaNn8PS', 'FW6VW8MQutPkJSBAiPfOrLQDjapTxBmz8umuvp5gyZ59dQsrfcQTDcBExO4e', 1, 1, 'Y', NULL, NULL, '1', NULL, NULL, NULL, NULL, '2017-10-05 14:49:54', '2017-10-13 17:13:47', NULL, NULL, 1, 1, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(12, 'prosenjit@technoexponent.com', 'prosenjit', 'Prosenjit', 'Das', NULL, NULL, '$2y$10$iFvy3jAghl5MoFQZnFXlHumVnRki2WLUZLn5Gcy1s6KgGs8h0OS.e', NULL, 1, 1, 'Y', NULL, NULL, '0', NULL, NULL, NULL, NULL, '2017-11-15 00:00:40', '2017-11-15 00:00:40', NULL, NULL, 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(13, 'subirroy73@googlemail.com', 'SubZer0', 'Subir', 'Roy', NULL, NULL, '$2y$10$NlQBnNI61JD9wEgPgTkbaOJ9evaKxq3dDFBzIus9Y7fqxLV93Wpei', 'BA3mFh0AdbwuY5WF4GOCmEoKVHby8GsXcAz2BElNFv5yZVXjqPJJ0WVJZ5LO', 1, 1, 'Y', '1511455787^41bdfce5c30ca93ddc8a4eb0c4fc9bb14b4660a6ee3526df37^pimgpsh_fullsize_distr.png', NULL, '1', NULL, NULL, NULL, NULL, '2017-11-15 06:38:52', '2017-11-17 21:06:54', NULL, 'cus_Bmfc63MOYSR0aI', 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(14, 'saman2u2001@yahoo.com', 'Tester_1', 'SAMAN', 'NEJAD', NULL, NULL, '$2y$10$TxWJG8O.ci0J0qIacCF5kevEpZ8bRmytDsQWRDeN0SQixKVRKkhem', 'TAVCuIuQ0yvG2ey9lSftqzPUok15QzVKjtufueAX0tQOHowNt9rn0FqVgh1x', 1, 1, 'Y', '14-tn.png', NULL, '', NULL, NULL, NULL, NULL, '2017-11-16 03:59:45', '2017-11-16 04:07:19', NULL, 'cus_Bm1wzSw8ytiqce', 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL),
(15, 'uttam@technoexponent.com', 'uttam', 'Uttam', 'Chowdhury', NULL, NULL, '$2y$10$6cHokasbv0hp1VVKHrfX2OsCEO4l1x1VY/N7F2A0qVgtrtLGrAiaS', 'FGDHQQ7pajkxWDqB07TLJnHtdlo9dCfFz1ByjzyWzad5RAZYFJOfuMMcx0op', 2, 1, 'Y', '15-tulips.jpg', 'Pabitra-M11508150122.png', '', NULL, NULL, NULL, NULL, '2017-07-25 14:49:33', '2017-11-02 23:25:12', NULL, 'cus_BVrUljnCkvofoR', 5, 5, 2, 'Pabitra', 'Y', 'N', 'Y', '0145262', 'Aadhaar Card', 'N'),
(16, 'lorkonurdu@deyom.com', 'Lork', 'X', 'Y', NULL, NULL, '$2y$10$lpJ9WIvLB9IgRDLcm6MGZOSV.IG1Au5RMZlIMe14Sp0e1Q.eYzQlq', 'DlO8v1sl4Pl0l4i4yoUbUlozQcDADHc42z2lEPTVs2XlBM0UJmDF3EtNMBDR', 1, 1, 'Y', '16-tn.png', NULL, '0', NULL, NULL, NULL, NULL, '2017-11-25 08:39:40', '2017-11-25 09:02:15', NULL, 'cus_BpTjLcshrRhffa', 0, 0, 0, NULL, 'Y', 'Y', 'N', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users_profile_views`
--

CREATE TABLE IF NOT EXISTS `users_profile_views` (
  `id` int(11) NOT NULL,
  `view_to_user` int(11) NOT NULL,
  `view_by_user` int(11) NOT NULL,
  `weekdays` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=129 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users_profile_views`
--

INSERT INTO `users_profile_views` (`id`, `view_to_user`, `view_by_user`, `weekdays`, `created_at`, `updated_at`) VALUES
(1, 1, 7, '6', '2017-11-11 16:24:32', '2017-11-11 16:24:32'),
(2, 1, 7, '1', '2017-11-11 16:48:10', '2017-11-11 16:48:10'),
(3, 1, 7, '3', '2017-11-11 16:48:13', '2017-11-11 16:48:13'),
(4, 1, 7, '1', '2017-11-11 16:48:15', '2017-11-11 16:48:15'),
(5, 1, 7, '6', '2017-11-11 16:48:16', '2017-11-11 16:48:16'),
(6, 1, 7, '0', '2017-11-11 16:48:17', '2017-11-11 16:48:17'),
(7, 1, 7, '3', '2017-11-11 16:48:19', '2017-11-11 16:48:20'),
(8, 1, 7, '6', '2017-11-11 16:48:30', '2017-11-11 16:48:30'),
(9, 1, 7, '2', '2017-11-11 16:48:31', '2017-11-11 16:48:31'),
(10, 11, 10, '1', '2017-11-13 14:18:46', '2017-11-13 14:18:46'),
(11, 6, 10, '1', '2017-11-13 14:20:38', '2017-11-13 14:20:38'),
(12, 11, 10, '1', '2017-11-13 14:23:00', '2017-11-13 14:23:00'),
(13, 11, 10, '2', '2017-11-14 00:41:40', '2017-11-14 00:41:40'),
(14, 11, 10, '2', '2017-11-14 00:42:17', '2017-11-14 00:42:17'),
(15, 12, 10, '2', '2017-11-14 19:50:55', '2017-11-14 19:50:55'),
(16, 1, 10, '3', '2017-11-15 01:37:52', '2017-11-15 01:37:52'),
(17, 1, 10, '3', '2017-11-15 01:40:32', '2017-11-15 01:40:33'),
(18, 12, 10, '3', '2017-11-15 01:46:40', '2017-11-15 01:46:40'),
(19, 11, 10, '3', '2017-11-15 01:46:44', '2017-11-15 01:46:44'),
(20, 12, 10, '3', '2017-11-15 01:50:46', '2017-11-15 01:50:46'),
(21, 10, 13, '5', '2017-11-17 15:05:42', '2017-11-17 15:05:42'),
(22, 13, 10, '5', '2017-11-17 18:31:57', '2017-11-17 18:31:57'),
(23, 14, 10, '6', '2017-11-18 00:50:19', '2017-11-18 00:50:19'),
(24, 1, 10, '6', '2017-11-18 00:50:42', '2017-11-18 00:50:42'),
(25, 14, 10, '6', '2017-11-18 01:45:53', '2017-11-18 01:45:53'),
(26, 13, 10, '1', '2017-11-20 17:06:42', '2017-11-20 17:06:42'),
(27, 1, 10, '1', '2017-11-20 17:07:03', '2017-11-20 17:07:03'),
(28, 13, 10, '1', '2017-11-20 17:07:28', '2017-11-20 17:07:28'),
(29, 13, 10, '1', '2017-11-20 20:38:20', '2017-11-20 20:38:20'),
(30, 14, 4, '1', '2017-11-20 21:33:14', '2017-11-20 21:33:14'),
(31, 11, 10, '1', '2017-11-20 22:51:34', '2017-11-20 22:51:34'),
(32, 12, 10, '1', '2017-11-20 22:52:15', '2017-11-20 22:52:15'),
(33, 13, 10, '2', '2017-11-21 03:33:59', '2017-11-21 03:33:59'),
(34, 13, 1, '2', '2017-11-21 21:53:10', '2017-11-21 21:53:10'),
(35, 12, 1, '2', '2017-11-21 21:53:13', '2017-11-21 21:53:13'),
(36, 14, 4, '2', '2017-11-21 21:53:51', '2017-11-21 21:53:51'),
(37, 14, 4, '2', '2017-11-21 21:55:13', '2017-11-21 21:55:13'),
(38, 14, 1, '2', '2017-11-21 21:58:53', '2017-11-21 21:58:53'),
(39, 11, 4, '2', '2017-11-21 22:03:51', '2017-11-21 22:03:51'),
(40, 14, 1, '3', '2017-11-22 10:48:29', '2017-11-22 10:48:29'),
(41, 12, 1, '3', '2017-11-22 10:49:55', '2017-11-22 10:49:55'),
(42, 12, 1, '3', '2017-11-22 10:50:10', '2017-11-22 10:50:10'),
(43, 14, 1, '3', '2017-11-22 17:52:11', '2017-11-22 17:52:12'),
(44, 14, 1, '3', '2017-11-22 18:08:59', '2017-11-22 18:08:59'),
(45, 14, 1, '3', '2017-11-22 18:17:10', '2017-11-22 18:17:10'),
(46, 14, 1, '3', '2017-11-22 18:29:17', '2017-11-22 18:29:17'),
(47, 14, 1, '3', '2017-11-22 18:29:21', '2017-11-22 18:29:21'),
(48, 14, 1, '3', '2017-11-22 18:29:24', '2017-11-22 18:29:24'),
(49, 14, 1, '3', '2017-11-22 18:32:16', '2017-11-22 18:32:16'),
(50, 14, 1, '3', '2017-11-22 18:35:34', '2017-11-22 18:35:34'),
(51, 14, 1, '3', '2017-11-22 18:37:35', '2017-11-22 18:37:35'),
(52, 14, 1, '3', '2017-11-22 18:37:40', '2017-11-22 18:37:40'),
(53, 14, 1, '3', '2017-11-22 19:51:00', '2017-11-22 19:51:00'),
(54, 14, 1, '3', '2017-11-22 20:20:08', '2017-11-22 20:20:08'),
(55, 12, 1, '4', '2017-11-23 15:30:10', '2017-11-23 15:30:10'),
(56, 12, 1, '4', '2017-11-23 15:33:30', '2017-11-23 15:33:30'),
(57, 12, 1, '4', '2017-11-23 15:33:33', '2017-11-23 15:33:33'),
(58, 12, 1, '4', '2017-11-23 15:41:13', '2017-11-23 15:41:13'),
(59, 7, 1, '4', '2017-11-23 15:50:14', '2017-11-23 15:50:14'),
(60, 14, 10, '4', '2017-11-23 15:55:19', '2017-11-23 15:55:19'),
(61, 13, 10, '4', '2017-11-23 15:55:27', '2017-11-23 15:55:27'),
(62, 1, 10, '4', '2017-11-23 15:55:41', '2017-11-23 15:55:41'),
(63, 1, 10, '4', '2017-11-23 15:55:53', '2017-11-23 15:55:53'),
(64, 13, 10, '4', '2017-11-23 15:57:58', '2017-11-23 15:57:58'),
(65, 10, 14, '4', '2017-11-23 16:12:12', '2017-11-23 16:12:12'),
(66, 10, 14, '4', '2017-11-23 16:12:18', '2017-11-23 16:12:18'),
(67, 15, 1, '4', '2017-11-23 16:48:47', '2017-11-23 16:48:47'),
(68, 10, 1, '4', '2017-11-23 17:07:54', '2017-11-23 17:07:54'),
(69, 15, 1, '4', '2017-11-23 17:08:07', '2017-11-23 17:08:07'),
(70, 10, 1, '4', '2017-11-23 17:15:45', '2017-11-23 17:15:45'),
(71, 15, 1, '4', '2017-11-23 17:16:08', '2017-11-23 17:16:08'),
(72, 14, 1, '4', '2017-11-23 20:35:41', '2017-11-23 20:35:41'),
(73, 15, 1, '4', '2017-11-23 20:46:46', '2017-11-23 20:46:46'),
(74, 14, 1, '4', '2017-11-23 20:47:47', '2017-11-23 20:47:47'),
(75, 14, 1, '4', '2017-11-23 20:48:41', '2017-11-23 20:48:41'),
(76, 14, 1, '4', '2017-11-23 20:49:15', '2017-11-23 20:49:15'),
(77, 14, 1, '4', '2017-11-23 20:49:17', '2017-11-23 20:49:17'),
(78, 14, 1, '4', '2017-11-23 20:50:23', '2017-11-23 20:50:23'),
(79, 14, 1, '4', '2017-11-23 20:51:45', '2017-11-23 20:51:45'),
(80, 14, 13, '4', '2017-11-23 21:25:45', '2017-11-23 21:25:45'),
(81, 1, 2, '4', '2017-11-23 21:47:39', '2017-11-23 21:47:39'),
(82, 14, 1, '4', '2017-11-23 21:53:33', '2017-11-23 21:53:33'),
(83, 13, 10, '5', '2017-11-24 01:30:40', '2017-11-24 01:30:40'),
(84, 14, 4, '5', '2017-11-24 01:31:42', '2017-11-24 01:31:42'),
(85, 14, 4, '5', '2017-11-24 01:35:14', '2017-11-24 01:35:14'),
(86, 14, 4, '5', '2017-11-24 01:47:49', '2017-11-24 01:47:49'),
(87, 14, 4, '5', '2017-11-24 01:48:04', '2017-11-24 01:48:04'),
(88, 14, 4, '5', '2017-11-24 01:48:06', '2017-11-24 01:48:06'),
(89, 13, 4, '5', '2017-11-24 02:04:29', '2017-11-24 02:04:29'),
(90, 14, 10, '5', '2017-11-24 03:12:41', '2017-11-24 03:12:41'),
(91, 14, 10, '5', '2017-11-24 03:15:37', '2017-11-24 03:15:37'),
(92, 14, 10, '5', '2017-11-24 03:19:34', '2017-11-24 03:19:34'),
(93, 13, 10, '5', '2017-11-24 03:21:47', '2017-11-24 03:21:47'),
(94, 14, 1, '5', '2017-11-24 11:27:52', '2017-11-24 11:27:52'),
(95, 14, 2, '5', '2017-11-24 11:33:27', '2017-11-24 11:33:27'),
(96, 14, 1, '5', '2017-11-24 19:48:00', '2017-11-24 19:48:00'),
(97, 14, 1, '5', '2017-11-24 20:07:18', '2017-11-24 20:07:18'),
(98, 14, 1, '5', '2017-11-24 20:07:55', '2017-11-24 20:07:55'),
(99, 14, 1, '5', '2017-11-24 20:11:25', '2017-11-24 20:11:25'),
(100, 14, 1, '5', '2017-11-24 20:11:28', '2017-11-24 20:11:28'),
(101, 14, 1, '5', '2017-11-24 20:11:34', '2017-11-24 20:11:34'),
(102, 14, 1, '5', '2017-11-24 20:11:36', '2017-11-24 20:11:36'),
(103, 14, 1, '5', '2017-11-24 20:12:09', '2017-11-24 20:12:09'),
(104, 14, 1, '5', '2017-11-24 20:14:07', '2017-11-24 20:14:07'),
(105, 14, 1, '5', '2017-11-24 20:14:09', '2017-11-24 20:14:09'),
(106, 14, 1, '5', '2017-11-24 20:14:34', '2017-11-24 20:14:34'),
(107, 14, 1, '5', '2017-11-24 20:15:18', '2017-11-24 20:15:18'),
(108, 14, 1, '5', '2017-11-24 20:18:49', '2017-11-24 20:18:49'),
(109, 14, 1, '5', '2017-11-24 20:21:28', '2017-11-24 20:21:28'),
(110, 14, 1, '5', '2017-11-24 20:22:11', '2017-11-24 20:22:11'),
(111, 14, 1, '5', '2017-11-24 20:22:18', '2017-11-24 20:22:18'),
(112, 14, 1, '5', '2017-11-24 20:22:19', '2017-11-24 20:22:19'),
(113, 14, 1, '5', '2017-11-24 20:22:21', '2017-11-24 20:22:21'),
(114, 14, 1, '5', '2017-11-24 20:30:17', '2017-11-24 20:30:17'),
(115, 14, 1, '5', '2017-11-24 20:30:44', '2017-11-24 20:30:44'),
(116, 14, 10, '5', '2017-11-24 20:32:07', '2017-11-24 20:32:07'),
(117, 14, 1, '5', '2017-11-24 20:32:34', '2017-11-24 20:32:34'),
(118, 14, 1, '5', '2017-11-24 20:36:57', '2017-11-24 20:36:57'),
(119, 14, 1, '5', '2017-11-24 20:43:05', '2017-11-24 20:43:05'),
(120, 14, 2, '5', '2017-11-24 20:52:31', '2017-11-24 20:52:31'),
(121, 14, 10, '6', '2017-11-25 01:41:56', '2017-11-25 01:41:56'),
(122, 13, 16, '6', '2017-11-25 02:50:54', '2017-11-25 02:50:54'),
(123, 16, 4, '6', '2017-11-25 03:53:21', '2017-11-25 03:53:21'),
(124, 16, 1, '6', '2017-11-25 19:29:14', '2017-11-25 19:29:14'),
(125, 11, 1, '6', '2017-11-25 19:29:21', '2017-11-25 19:29:21'),
(126, 12, 1, '6', '2017-11-25 19:29:28', '2017-11-25 19:29:28'),
(127, 1, 15, '6', '2017-11-25 19:34:51', '2017-11-25 19:34:51'),
(128, 1, 15, '6', '2017-11-25 20:28:11', '2017-11-25 20:28:11');

-- --------------------------------------------------------

--
-- Table structure for table `user_chats`
--

CREATE TABLE IF NOT EXISTS `user_chats` (
  `id` int(11) NOT NULL COMMENT 'primary key of this table',
  `user_id` int(11) NOT NULL COMMENT 'message sent by user, foreign key of users table id',
  `to_user_id` int(11) DEFAULT '0' COMMENT 'message sent to user, foreign key of users table id',
  `job_id` int(11) NOT NULL COMMENT 'message sent for job, foreign key of postedjobs table job_id',
  `message_subject` text COLLATE utf8_unicode_ci,
  `message_content` text COLLATE utf8_unicode_ci NOT NULL,
  `message_read_status` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N' COMMENT 'Y- Read, N- Not Read',
  `is_starred_for_sender` int(2) DEFAULT '0' COMMENT '0=> Not Starred, 1= Starred',
  `is_starred_for_receiver` int(2) DEFAULT '0' COMMENT '0=> Not Starred, 1= Starred',
  `message_dttime` datetime NOT NULL,
  `deleted_by_sender` int(2) DEFAULT '0' COMMENT '0=> Not Deleted, 1= Deleted',
  `deleted_by_receiver` int(2) DEFAULT '0' COMMENT '0=> Not Deleted, 1= Deleted'
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_chats`
--

INSERT INTO `user_chats` (`id`, `user_id`, `to_user_id`, `job_id`, `message_subject`, `message_content`, `message_read_status`, `is_starred_for_sender`, `is_starred_for_receiver`, `message_dttime`, `deleted_by_sender`, `deleted_by_receiver`) VALUES
(1, 1, 7, 2, 'Hi, I got your proposal...\r\nThe standard...', 'Hi, I got your proposal...\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'Y', 0, 0, '2017-10-06 14:39:54', 0, 0),
(2, 1, 7, 10, 'Hi How are you', 'Hi How are you', 'Y', 0, 0, '2017-10-11 07:15:18', 1, 0),
(3, 7, 1, 10, 'I am fine how are you?', 'I am fine how are you?', 'Y', 0, 1, '2017-10-11 07:17:10', 0, 0),
(4, 7, 1, 2, 'Ok, thank you...', 'Ok, thank you...', 'Y', 0, 1, '2017-10-12 06:30:13', 0, 1),
(5, 10, 1, 8, 'hello', 'hello', 'Y', 0, 0, '2017-11-15 16:36:05', 0, 0),
(6, 10, 13, 31, 'Hi Subir, I am testing the message funct...', 'Hi Subir, I am testing the message functionality', 'Y', 1, 0, '2017-11-17 15:16:28', 0, 0),
(7, 10, 13, 31, 'Hello Again, I am replying to a message ...', 'Hello Again, I am replying to a message I don''t know why!', 'Y', 0, 0, '2017-11-17 15:24:38', 0, 0),
(8, 10, 13, 31, 'test test test', 'test test test', 'Y', 0, 0, '2017-11-18 00:49:16', 1, 0),
(9, 10, 1, 30, 'Hi, Can you see my message?', 'Hi, Can you see my message?', 'Y', 0, 0, '2017-11-20 22:28:37', 0, 0),
(10, 13, 10, 31, 'Hello Sam thanks', 'Hello Sam thanks', 'Y', 0, 0, '2017-11-20 22:30:59', 0, 0),
(11, 10, 13, 31, 'Hello', 'Hello', 'N', 0, 0, '2017-11-20 22:32:31', 0, 0),
(12, 1, 7, 2, 'test', 'test', 'N', 0, 0, '2017-11-23 10:49:59', 0, 0),
(13, 1, 7, 2, 'zXzxz', 'zXzxz', 'N', 0, 0, '2017-11-23 10:50:17', 0, 0),
(14, 1, 7, 2, 'Lorem ipsum dolor sit amet, consectetuer...', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,', 'N', 0, 0, '2017-11-23 10:53:32', 0, 0),
(15, 1, 7, 2, 'Lorem ipsum dolor sit amet, consectetuer...', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,', 'N', 0, 0, '2017-11-23 10:53:33', 0, 0),
(16, 1, 7, 2, 'this is test msg...', 'this is test msg...', 'N', 0, 0, '2017-11-23 11:04:22', 0, 0),
(17, 15, 1, 30, 'Lorem Ipsum is simply dummy text of the ...', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.\r\nIt was popularised in the 1960s with the release of Letraset sheets containing Lorem', 'Y', 0, 0, '2017-11-23 16:49:12', 0, 0),
(18, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:05', 0, 0),
(19, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:05', 1, 0),
(20, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:06', 1, 1),
(21, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:06', 1, 1),
(22, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:06', 1, 1),
(23, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:06', 1, 1),
(24, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:06', 1, 1),
(25, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:07', 1, 1),
(26, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:07', 1, 1),
(27, 1, 15, 30, 'Yes, I will give you more detail.\r\nThank...', 'Yes, I will give you more detail.\r\nThanks for quick response.', 'Y', 0, 0, '2017-11-23 16:57:07', 1, 1),
(28, 1, 15, 30, 'ok great', 'ok great', 'Y', 0, 0, '2017-11-23 17:04:38', 0, 0),
(29, 15, 1, 30, 'Lorem ipsum dolor sit amet, consectetuer...', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligula. Fusce fermentum. Nullam cursus lacinia erat. Praesent blandit laoreet nibh. Fusce convallis metus id felis luctus adipiscing. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Quisque id mi. Ut tincidunt tincidunt erat. Etiam feugiat lorem non metus. Vestibulum dapibus nunc ac augue. Curabitur vestibulum aliquam leo. Praesent egestas neque eu enim. In hac habitasse platea dictumst. Fusce a quam. Etiam ut purus mattis mauris sodales aliquam. Curabitur nisi. Quisque malesuada placerat nisl. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Mauris sollicitudin fermentum libero. Praesent nonummy mi in odio. Nunc interdum lacus sit amet orci. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Morbi mollis tellus ac sapien. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Fusce vel dui. Sed in libero ut nibh placerat accumsan. Proin faucibus arcu quis ante. In consectetuer turpis ut velit. Nulla sit amet est. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Suspendisse feugiat. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Praesent nec nisl a purus blandit viverra. Praesent ac massa at ligula laoreet iaculis. Nulla neque dolor, sagittis eget, iaculis quis, molestie non, velit. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Fusce pharetra convallis urna. Quisque ut nisi. Donec mi odio, faucibus at, scelerisque quis,', 'Y', 0, 0, '2017-11-23 17:08:13', 0, 0),
(30, 15, 1, 30, 'Lorem ipsum dolor sit amet, consectetuer...', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligula. Fusce fermentum. Nullam cursus lacinia erat. Praesent blandit laoreet nibh. Fusce convallis metus id felis luctus adipiscing. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Quisque id mi. Ut tincidunt tincidunt erat. Etiam feugiat lorem non metus. Vestibulum dapibus nunc ac augue. Curabitur vestibulum aliquam leo. Praesent egestas neque eu enim. In hac habitasse platea dictumst. Fusce a quam. Etiam ut purus mattis mauris sodales aliquam. Curabitur nisi. Quisque malesuada placerat nisl. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Mauris sollicitudin fermentum libero. Praesent nonummy mi in odio. Nunc interdum lacus sit amet orci. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Morbi mollis tellus ac sapien. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Fusce vel dui. Sed in libero ut nibh placerat accumsan. Proin faucibus arcu quis ante. In consectetuer turpis ut velit. Nulla sit amet est. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Suspendisse feugiat. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Praesent nec nisl a purus blandit viverra. Praesent ac massa at ligula laoreet iaculis. Nulla neque dolor, sagittis eget, iaculis quis, molestie non, velit. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Fusce pharetra convallis urna. Quisque ut nisi. Donec mi odio, faucibus at, scelerisque quis,', 'Y', 0, 0, '2017-11-23 17:08:14', 0, 0),
(31, 15, 1, 30, 'Lorem ipsum dolor sit amet, consectetuer...', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam quam nunc, blandit vel, luctus pulvinar, hendrerit id, lorem. Maecenas nec odio et ante tincidunt tempus. Donec vitae sapien ut libero venenatis faucibus. Nullam quis ante. Etiam sit amet orci eget eros faucibus tincidunt. Duis leo. Sed fringilla mauris sit amet nibh. Donec sodales sagittis magna. Sed consequat, leo eget bibendum sodales, augue velit cursus nunc, quis gravida magna mi a libero. Fusce vulputate eleifend sapien. Vestibulum purus quam, scelerisque ut, mollis sed, nonummy id, metus. Nullam accumsan lorem in dui. Cras ultricies mi eu turpis hendrerit fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; In ac dui quis mi consectetuer lacinia. Nam pretium turpis et arcu. Duis arcu tortor, suscipit eget, imperdiet nec, imperdiet iaculis, ipsum. Sed aliquam ultrices mauris. Integer ante arcu, accumsan a, consectetuer eget, posuere ut, mauris. Praesent adipiscing. Phasellus ullamcorper ipsum rutrum nunc. Nunc nonummy metus. Vestibulum volutpat pretium libero. Cras id dui. Aenean ut eros et nisl sagittis vestibulum. Nullam nulla eros, ultricies sit amet, nonummy id, imperdiet feugiat, pede. Sed lectus. Donec mollis hendrerit risus. Phasellus nec sem in justo pellentesque facilisis. Etiam imperdiet imperdiet orci. Nunc nec neque. Phasellus leo dolor, tempus non, auctor et, hendrerit quis, nisi. Curabitur ligula sapien, tincidunt non, euismod vitae, posuere imperdiet, leo. Maecenas malesuada. Praesent congue erat at massa. Sed cursus turpis vitae tortor. Donec posuere vulputate arcu. Phasellus accumsan cursus velit. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Sed aliquam, nisi quis porttitor congue, elit erat euismod orci, ac placerat dolor lectus quis orci. Phasellus consectetuer vestibulum elit. Aenean tellus metus, bibendum sed, posuere ac, mattis non, nunc. Vestibulum fringilla pede sit amet augue. In turpis. Pellentesque posuere. Praesent turpis. Aenean posuere, tortor sed cursus feugiat, nunc augue blandit nunc, eu sollicitudin urna dolor sagittis lacus. Donec elit libero, sodales nec, volutpat a, suscipit non, turpis. Nullam sagittis. Suspendisse pulvinar, augue ac venenatis condimentum, sem libero volutpat nibh, nec pellentesque velit pede quis nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Fusce id purus. Ut varius tincidunt libero. Phasellus dolor. Maecenas vestibulum mollis diam. Pellentesque ut neque. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. In dui magna, posuere eget, vestibulum et, tempor auctor, justo. In ac felis quis tortor malesuada pretium. Pellentesque auctor neque nec urna. Proin sapien ipsum, porta a, auctor quis, euismod ut, mi. Aenean viverra rhoncus pede. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Ut non enim eleifend felis pretium feugiat. Vivamus quis mi. Phasellus a est. Phasellus magna. In hac habitasse platea dictumst. Curabitur at lacus ac velit ornare lobortis. Curabitur a felis in nunc fringilla tristique. Morbi mattis ullamcorper velit. Phasellus gravida semper nisi. Nullam vel sem. Pellentesque libero tortor, tincidunt et, tincidunt eget, semper nec, quam. Sed hendrerit. Morbi ac felis. Nunc egestas, augue at pellentesque laoreet, felis eros vehicula leo, at malesuada velit leo quis pede. Donec interdum, metus et hendrerit aliquet, dolor diam sagittis ligula, eget egestas libero turpis vel mi. Nunc nulla. Fusce risus nisl, viverra et, tempor et, pretium in, sapien. Donec venenatis vulputate lorem. Morbi nec metus. Phasellus blandit leo ut odio. Maecenas ullamcorper, dui et placerat feugiat, eros pede varius nisi, condimentum viverra felis nunc et lorem. Sed magna purus, fermentum eu, tincidunt eu, varius ut, felis. In auctor lobortis lacus. Quisque libero metus, condimentum nec, tempor a, commodo mollis, magna. Vestibulum ullamcorper mauris at ligula. Fusce fermentum. Nullam cursus lacinia erat. Praesent blandit laoreet nibh. Fusce convallis metus id felis luctus adipiscing. Pellentesque egestas, neque sit amet convallis pulvinar, justo nulla eleifend augue, ac auctor orci leo non est. Quisque id mi. Ut tincidunt tincidunt erat. Etiam feugiat lorem non metus. Vestibulum dapibus nunc ac augue. Curabitur vestibulum aliquam leo. Praesent egestas neque eu enim. In hac habitasse platea dictumst. Fusce a quam. Etiam ut purus mattis mauris sodales aliquam. Curabitur nisi. Quisque malesuada placerat nisl. Nam ipsum risus, rutrum vitae, vestibulum eu, molestie vel, lacus. Sed augue ipsum, egestas nec, vestibulum et, malesuada adipiscing, dui. Vestibulum facilisis, purus nec pulvinar iaculis, ligula mi congue nunc, vitae euismod ligula urna in dolor. Mauris sollicitudin fermentum libero. Praesent nonummy mi in odio. Nunc interdum lacus sit amet orci. Vestibulum rutrum, mi nec elementum vehicula, eros quam gravida nisl, id fringilla neque ante vel mi. Morbi mollis tellus ac sapien. Phasellus volutpat, metus eget egestas mollis, lacus lacus blandit dui, id egestas quam mauris ut lacus. Fusce vel dui. Sed in libero ut nibh placerat accumsan. Proin faucibus arcu quis ante. In consectetuer turpis ut velit. Nulla sit amet est. Praesent metus tellus, elementum eu, semper a, adipiscing nec, purus. Cras risus ipsum, faucibus ut, ullamcorper id, varius ac, leo. Suspendisse feugiat. Suspendisse enim turpis, dictum sed, iaculis a, condimentum nec, nisi. Praesent nec nisl a purus blandit viverra. Praesent ac massa at ligula laoreet iaculis. Nulla neque dolor, sagittis eget, iaculis quis, molestie non, velit. Mauris turpis nunc, blandit et, volutpat molestie, porta ut, ligula. Fusce pharetra convallis urna. Quisque ut nisi. Donec mi odio, faucibus at, scelerisque quis,', 'Y', 0, 0, '2017-11-23 17:08:14', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_chat_files`
--

CREATE TABLE IF NOT EXISTS `user_chat_files` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_chat_files`
--

INSERT INTO `user_chat_files` (`id`, `message_id`, `file_name`) VALUES
(1, 17, 'testibg.png1511435952');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `details_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `availability_status` varchar(12) NOT NULL DEFAULT 'Available' COMMENT 'Is user available or not',
  `rate_per_hour` varchar(255) DEFAULT NULL,
  `location` varchar(255) DEFAULT NULL,
  `travel_distance` varchar(255) DEFAULT NULL,
  `job_type` int(11) NOT NULL DEFAULT '0',
  `website` varchar(255) DEFAULT NULL,
  `sample_video` varchar(255) DEFAULT NULL,
  `focus` int(11) NOT NULL DEFAULT '0',
  `field_of_work` int(11) DEFAULT '0',
  `about` text,
  `linkedin_profile` text,
  `vimeo_profile` text,
  `twitter_profile` text,
  `behance_profile` text,
  `user_address` text
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`details_id`, `user_id`, `availability_status`, `rate_per_hour`, `location`, `travel_distance`, `job_type`, `website`, `sample_video`, `focus`, `field_of_work`, `about`, `linkedin_profile`, `vimeo_profile`, `twitter_profile`, `behance_profile`, `user_address`) VALUES
(1, 2, 'Available', '34', 'India', '1', 1, NULL, '1501008840-download.jpeg', 1, 1, 'Hellos just testing.', NULL, NULL, NULL, NULL, NULL),
(2, 3, 'Available', NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 'Expert in stuff.', NULL, NULL, NULL, NULL, NULL),
(3, 1, 'Offline', '100', 'Kolkata, W.B., India', '1', 1, 'https://www.technoexponent.com/', NULL, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'https://in.linkedin.com/', 'https://vimeo.com/', 'https://twitter.com/login', 'https://www.behance.net/', '74, Ashbrook Road, London, N19 3ES'),
(4, 4, 'Available', '102', 'London, United Kingdom', '1', 1, 'www.test.com', NULL, 1, 1, 'Graphic Designdslksklcm.,mxz,.c.,mxznc.,ds;`dk;sz./cxz.,mc.,xzcmxz,mc.xz', NULL, NULL, NULL, NULL, 'London, UK'),
(5, 5, 'Available', '40', 'Dubai', '1', 1, NULL, NULL, 1, 1, 'Design', 'linkedin.com/dan', NULL, NULL, NULL, NULL),
(6, 6, 'Available', '46', 'New York', '3', 1, NULL, NULL, 1, 1, 'Hybrid', NULL, NULL, NULL, NULL, NULL),
(7, 9, 'Busy', '100', NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(8, 10, 'Offline', '35', NULL, '3', 1, 'www.xplainers.video', '1508414090-Going-Home---SFX.mp3', 1, 1, 'I am expert in user experience,  user interface design and interaction. I also have experience in motion graphics design and animation. with over 15 years of experience. if you want to know more about me, contact me and I will respond.', NULL, NULL, NULL, NULL, NULL),
(9, 11, 'Available', '520', 'kolkata', '1', 1, 'http://template1.teexponent.com/leadview360/', NULL, 1, 1, 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', NULL, NULL, NULL, NULL, NULL),
(10, 7, 'Offline', NULL, 'hh', NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL),
(11, 15, 'Available', '50', 'kolkata', '1', 1, 'https://www.technoexponent.com/', '1511437168-how-it-work.png', 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(12, 14, 'Available', NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 'I am expert in posting jobs!', NULL, NULL, NULL, NULL, NULL),
(13, 13, 'Available', '28', 'London', '1', 1, NULL, '1511456077-Company-Profile-Sample---After-Effect-Template.mp4', 1, 1, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus in condimentum eros, egestas placerat metus. Phasellus ut orci et lectus bibendum consectetur. Ut velit augue, tempus sit amet porttitor a, maximus a tellus. Integer laoreet pretium aliquam. Quisque nec ipsum pellentesque, mattis enim sed, hendrerit dui. Ut viverra, arcu et congue blandit, quam felis sagittis dolor, sit amet mattis mi odio eu risus. Vivamus lobortis blandit lectus, ut rutrum lectus condimentum non. Curabitur nec nisi sed nisi cursus venenatis ut quis leo. Fusce convallis volutpat nisi, non gravida arcu auctor eu.\r\n\r\nNam consequat nisl purus, id fermentum eros gravida eget. Proin sodales odio venenatis ipsum aliquet, ut dignissim ex interdum. Interdum et malesuada fames ac ante ipsum primis in faucibus. Duis eget mauris a urna consectetur venenatis. Etiam sed elit fermentum, venenatis ex sit amet, vehicula velit. Nunc aliquam dapibus mattis. Curabitur posuere mauris in leo hendrerit faucibus. Fusce faucibus nulla eget tellus facilisis porta. Maecenas ut metus mi.\r\n\r\nAenean vitae dignissim risus, imperdiet lobortis sapien. In viverra velit vel leo mattis varius. Mauris elementum, nulla sed mattis malesuada, justo elit tempor lorem, eu faucibus diam urna vel nibh. Integer orci quam, pellentesque sed ipsum fringilla, varius efficitur risus. Sed iaculis aliquet quam eu euismod. Nullam maximus accumsan pretium. Sed mattis sem justo, et mattis magna vestibulum sed.', NULL, NULL, NULL, NULL, NULL),
(14, 16, 'Available', NULL, NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `user_general_settings`
--

CREATE TABLE IF NOT EXISTS `user_general_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `available_from` int(2) DEFAULT NULL,
  `available_to` int(2) DEFAULT NULL,
  `security_question` int(2) NOT NULL,
  `security_answer` text COLLATE utf8_unicode_ci,
  `account_active` int(2) NOT NULL,
  `last_updated` datetime NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `user_job_tasks`
--

CREATE TABLE IF NOT EXISTS `user_job_tasks` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `assigned_by_user` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_job_tasks`
--

INSERT INTO `user_job_tasks` (`id`, `job_id`, `assigned_by_user`, `title`, `type`, `description`, `created_date`) VALUES
(1, 8, 10, 'Workflow Introduction', '1', 'This is a test for checking the workflow', '2017-11-15 16:34:20'),
(2, 31, 10, 'First milestone on test project 1', '3', 'Testing if the on-hold sect of the workflow works properly', '2017-11-17 15:19:10'),
(3, 32, 13, '1st Task', '2', 'qebwjfbnkjdsnf fkskdnlkdsnv dvskdnvslkd', '2017-11-20 21:25:52'),
(4, 39, 13, 'Task 1', '1', 'qwertyuiop', '2017-11-24 02:32:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_logins`
--

CREATE TABLE IF NOT EXISTS `user_logins` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loginDtTime` datetime NOT NULL,
  `loginIP` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=268 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_logins`
--

INSERT INTO `user_logins` (`id`, `user_id`, `loginDtTime`, `loginIP`) VALUES
(1, 7, '2017-10-20 09:41:00', '45.249.80.227'),
(2, 7, '2017-10-20 09:42:46', '45.249.80.227'),
(3, 7, '2017-10-20 15:23:39', '45.249.80.227'),
(4, 1, '2017-10-20 15:28:07', '45.249.80.227'),
(5, 1, '2017-10-20 16:15:54', '45.249.80.227'),
(6, 11, '2017-10-20 17:21:40', '45.64.221.218'),
(7, 10, '2017-10-20 19:28:47', '176.27.206.103'),
(8, 10, '2017-10-21 03:24:30', '176.251.28.14'),
(9, 4, '2017-10-21 03:30:51', '71.58.84.240'),
(10, 4, '2017-10-21 19:30:21', '71.58.84.240'),
(11, 7, '2017-10-21 19:32:26', '71.58.84.240'),
(12, 7, '2017-10-21 19:33:43', '71.58.84.240'),
(13, 5, '2017-10-21 19:33:52', '71.58.84.240'),
(14, 10, '2017-10-22 00:19:27', '176.251.28.14'),
(15, 4, '2017-10-22 06:58:29', '71.58.84.240'),
(16, 10, '2017-10-23 11:13:09', '176.27.206.103'),
(17, 1, '2017-10-23 11:50:04', '115.187.63.93'),
(18, 7, '2017-10-23 13:16:52', '45.249.80.227'),
(19, 7, '2017-10-23 13:16:59', '45.249.80.227'),
(20, 7, '2017-10-23 16:16:39', '45.249.80.227'),
(21, 7, '2017-10-23 16:31:49', '45.249.80.227'),
(22, 10, '2017-10-23 18:53:42', '176.27.206.103'),
(23, 4, '2017-10-23 20:58:17', '71.58.84.240'),
(24, 11, '2017-10-23 21:02:01', '45.64.221.218'),
(25, 10, '2017-10-24 13:39:38', '176.27.206.103'),
(26, 7, '2017-10-24 16:42:07', '45.249.80.227'),
(27, 1, '2017-10-24 18:20:27', '115.187.63.68'),
(28, 11, '2017-10-24 20:16:29', '45.64.221.218'),
(29, 1, '2017-10-24 20:16:51', '45.249.80.227'),
(30, 10, '2017-10-24 23:16:53', '176.27.206.103'),
(31, 10, '2017-10-25 14:30:57', '176.27.206.103'),
(32, 11, '2017-10-25 20:49:33', '45.64.221.218'),
(33, 4, '2017-10-25 20:53:49', '71.58.84.240'),
(34, 11, '2017-10-25 20:55:06', '82.47.239.225'),
(35, 11, '2017-10-25 21:07:07', '45.64.221.218'),
(36, 4, '2017-10-25 23:54:54', '71.58.84.240'),
(37, 4, '2017-10-26 00:43:06', '71.58.84.240'),
(38, 4, '2017-10-26 21:59:33', '71.58.84.240'),
(39, 11, '2017-10-26 22:00:37', '82.47.239.225'),
(40, 4, '2017-10-27 02:09:44', '71.58.84.240'),
(41, 7, '2017-10-27 11:24:45', '45.249.80.227'),
(42, 7, '2017-10-27 18:58:07', '45.249.80.227'),
(43, 1, '2017-10-27 19:25:53', '45.249.80.227'),
(44, 7, '2017-10-27 20:17:53', '45.249.80.227'),
(45, 1, '2017-10-27 20:18:13', '45.249.80.227'),
(46, 4, '2017-10-27 20:40:03', '71.58.84.240'),
(47, 1, '2017-10-27 20:44:58', '45.64.221.236'),
(48, 4, '2017-10-27 20:53:32', '71.58.84.240'),
(49, 1, '2017-10-28 01:20:28', '42.110.206.72'),
(50, 1, '2017-10-28 12:53:56', '45.64.221.218'),
(51, 1, '2017-10-28 13:03:09', '45.64.221.218'),
(52, 7, '2017-10-28 17:15:46', '45.249.80.227'),
(53, 11, '2017-10-28 18:32:38', '45.64.221.218'),
(54, 1, '2017-10-28 19:34:56', '115.187.63.68'),
(55, 11, '2017-10-28 19:35:30', '115.187.63.68'),
(56, 1, '2017-10-28 19:38:39', '45.249.80.227'),
(57, 1, '2017-10-28 20:54:53', '45.249.80.227'),
(58, 1, '2017-10-28 21:03:06', '45.249.80.227'),
(59, 4, '2017-10-28 21:43:51', '71.58.84.240'),
(60, 7, '2017-10-28 21:53:21', '45.249.80.227'),
(61, 11, '2017-10-29 18:06:43', '82.47.239.225'),
(62, 4, '2017-10-29 22:32:11', '71.58.84.240'),
(63, 11, '2017-10-30 11:40:11', '45.64.221.218'),
(64, 11, '2017-10-30 15:20:56', '115.187.63.68'),
(65, 7, '2017-10-30 18:30:05', '45.249.80.227'),
(66, 1, '2017-10-31 12:19:21', '45.249.80.227'),
(67, 1, '2017-10-31 13:03:52', '45.249.80.227'),
(68, 1, '2017-10-31 15:32:01', '45.64.221.236'),
(69, 1, '2017-10-31 15:48:00', '45.64.221.236'),
(70, 1, '2017-10-31 17:42:58', '45.249.80.227'),
(71, 1, '2017-10-31 18:37:03', '45.249.80.227'),
(72, 1, '2017-10-31 20:56:28', '45.249.80.227'),
(73, 1, '2017-10-31 21:11:27', '45.64.221.236'),
(74, 4, '2017-10-31 21:28:38', '71.58.84.240'),
(75, 4, '2017-10-31 21:36:45', '71.58.84.240'),
(76, 4, '2017-11-01 00:27:41', '71.58.84.240'),
(77, 11, '2017-11-01 12:02:47', '45.64.221.218'),
(78, 7, '2017-11-01 13:12:52', '45.249.80.227'),
(79, 1, '2017-11-01 19:22:01', '45.249.80.227'),
(80, 1, '2017-11-01 19:36:35', '45.249.80.227'),
(81, 1, '2017-11-01 19:36:39', '45.249.80.227'),
(82, 1, '2017-11-01 19:36:42', '45.249.80.227'),
(83, 1, '2017-11-01 20:36:52', '45.64.221.236'),
(84, 4, '2017-11-01 21:27:31', '71.58.84.240'),
(85, 1, '2017-11-01 22:03:53', '45.249.80.227'),
(86, 1, '2017-11-02 11:48:34', '45.249.80.227'),
(87, 1, '2017-11-02 12:32:25', '45.249.80.227'),
(88, 1, '2017-11-02 13:11:19', '45.249.80.227'),
(89, 1, '2017-11-02 16:56:30', '45.64.221.236'),
(90, 11, '2017-11-02 17:51:12', '82.47.239.225'),
(91, 11, '2017-11-02 17:51:16', '82.47.239.225'),
(92, 1, '2017-11-02 18:08:05', '45.249.80.227'),
(93, 4, '2017-11-02 20:35:03', '71.58.84.240'),
(94, 11, '2017-11-02 20:36:41', '82.47.239.225'),
(95, 7, '2017-11-02 21:19:09', '45.249.80.227'),
(96, 5, '2017-11-03 02:10:47', '71.58.84.240'),
(97, 7, '2017-11-03 02:11:14', '82.132.246.21'),
(98, 1, '2017-11-03 15:49:26', '45.64.221.236'),
(99, 1, '2017-11-03 18:24:25', '45.249.80.227'),
(100, 1, '2017-11-04 10:45:09', '42.110.199.51'),
(101, 1, '2017-11-06 10:44:11', '45.249.80.227'),
(102, 7, '2017-11-06 10:56:14', '45.249.80.227'),
(103, 11, '2017-11-06 11:46:09', '45.64.221.218'),
(104, 11, '2017-11-06 11:53:48', '115.187.63.68'),
(105, 7, '2017-11-06 13:04:42', '45.249.80.227'),
(106, 1, '2017-11-06 13:31:50', '45.249.80.227'),
(107, 1, '2017-11-06 14:54:25', '45.249.80.227'),
(108, 1, '2017-11-06 20:04:38', '45.249.80.227'),
(109, 7, '2017-11-06 20:04:57', '45.249.80.227'),
(110, 10, '2017-11-06 23:51:26', '62.190.18.124'),
(111, 1, '2017-11-07 12:04:18', '45.249.80.227'),
(112, 1, '2017-11-07 12:04:58', '45.249.80.227'),
(113, 11, '2017-11-07 12:17:03', '45.64.221.218'),
(114, 11, '2017-11-07 12:19:08', '45.64.221.218'),
(115, 10, '2017-11-07 12:29:04', '176.27.206.103'),
(116, 1, '2017-11-07 12:35:45', '45.249.80.227'),
(117, 1, '2017-11-07 12:36:56', '45.249.80.227'),
(118, 1, '2017-11-07 12:37:26', '45.249.80.227'),
(119, 1, '2017-11-07 12:38:12', '45.249.80.227'),
(120, 1, '2017-11-07 12:39:17', '45.249.80.227'),
(121, 1, '2017-11-07 12:41:15', '45.249.80.227'),
(122, 1, '2017-11-07 13:08:40', '45.249.80.227'),
(123, 1, '2017-11-07 15:13:44', '45.64.221.236'),
(124, 11, '2017-11-07 18:46:26', '115.187.63.154'),
(125, 4, '2017-11-08 03:54:12', '71.58.84.240'),
(126, 10, '2017-11-08 04:02:57', '176.27.206.103'),
(127, 1, '2017-11-08 11:02:29', '45.249.80.227'),
(128, 10, '2017-11-08 14:58:21', '176.27.206.103'),
(129, 4, '2017-11-08 23:52:12', '71.58.84.240'),
(130, 4, '2017-11-09 00:35:19', '71.58.84.240'),
(131, 10, '2017-11-09 01:45:06', '176.27.206.103'),
(132, 1, '2017-11-09 12:30:34', '45.249.80.227'),
(133, 7, '2017-11-09 13:22:02', '45.249.80.227'),
(134, 11, '2017-11-09 13:34:57', '45.64.221.218'),
(135, 1, '2017-11-09 13:43:05', '45.249.80.227'),
(136, 10, '2017-11-09 14:25:35', '176.27.206.103'),
(137, 1, '2017-11-09 17:14:44', '45.249.80.227'),
(138, 1, '2017-11-09 17:15:08', '45.249.80.227'),
(139, 1, '2017-11-09 17:15:13', '45.249.80.227'),
(140, 1, '2017-11-09 19:21:53', '45.249.80.227'),
(141, 1, '2017-11-09 20:28:23', '45.64.221.236'),
(142, 1, '2017-11-09 21:25:15', '45.249.80.227'),
(143, 1, '2017-11-10 11:44:32', '45.249.80.227'),
(144, 7, '2017-11-10 11:45:48', '45.249.80.227'),
(145, 7, '2017-11-10 11:45:55', '45.249.80.227'),
(146, 1, '2017-11-10 15:24:22', '45.249.80.227'),
(147, 1, '2017-11-10 15:28:26', '45.249.80.227'),
(148, 7, '2017-11-10 16:07:32', '45.249.80.227'),
(149, 10, '2017-11-10 16:54:32', '176.27.206.103'),
(150, 1, '2017-11-10 18:24:13', '45.249.80.227'),
(151, 7, '2017-11-10 19:28:58', '45.249.80.227'),
(152, 7, '2017-11-10 19:29:07', '45.249.80.227'),
(153, 7, '2017-11-10 19:29:14', '45.249.80.227'),
(154, 1, '2017-11-10 20:59:37', '45.64.221.236'),
(155, 1, '2017-11-11 10:42:26', '45.249.80.227'),
(156, 1, '2017-11-11 11:16:35', '45.249.80.227'),
(157, 1, '2017-11-11 11:35:35', '45.64.221.236'),
(158, 11, '2017-11-11 12:09:32', '45.64.221.218'),
(159, 7, '2017-11-11 15:17:20', '45.249.80.227'),
(160, 1, '2017-11-11 15:17:50', '45.249.80.227'),
(161, 7, '2017-11-11 15:18:06', '45.249.80.227'),
(162, 1, '2017-11-11 15:44:44', '45.249.80.227'),
(163, 7, '2017-11-11 15:45:51', '45.249.80.227'),
(164, 1, '2017-11-11 15:59:59', '45.249.80.227'),
(165, 7, '2017-11-11 16:00:21', '45.249.80.227'),
(166, 1, '2017-11-11 16:53:04', '45.249.80.227'),
(167, 11, '2017-11-11 17:55:18', '45.64.221.218'),
(168, 1, '2017-11-11 18:01:08', '45.249.80.227'),
(169, 1, '2017-11-11 18:53:26', '45.249.80.227'),
(170, 7, '2017-11-11 19:54:55', '45.249.80.227'),
(171, 1, '2017-11-11 20:06:55', '45.249.80.227'),
(172, 10, '2017-11-11 23:18:39', '176.251.28.14'),
(173, 10, '2017-11-11 23:19:12', '176.251.28.14'),
(174, 10, '2017-11-13 01:30:13', '176.251.28.14'),
(175, 1, '2017-11-13 13:00:23', '45.249.80.227'),
(176, 10, '2017-11-13 14:18:16', '176.27.206.103'),
(177, 1, '2017-11-13 21:22:48', '45.64.221.236'),
(178, 2, '2017-11-13 21:26:34', '45.64.221.236'),
(179, 1, '2017-11-13 21:42:55', '82.47.239.225'),
(180, 4, '2017-11-13 23:16:46', '82.47.239.225'),
(181, 4, '2017-11-13 23:17:11', '82.47.239.225'),
(182, 4, '2017-11-13 23:17:26', '82.47.239.225'),
(183, 4, '2017-11-13 23:17:31', '82.47.239.225'),
(184, 4, '2017-11-13 23:17:37', '82.47.239.225'),
(185, 4, '2017-11-13 23:17:46', '82.47.239.225'),
(186, 10, '2017-11-14 00:41:30', '176.27.206.103'),
(187, 10, '2017-11-14 19:50:49', '176.27.206.103'),
(188, 1, '2017-11-15 00:36:55', '82.47.239.225'),
(189, 10, '2017-11-15 00:49:40', '176.27.206.103'),
(190, 10, '2017-11-15 16:28:53', '176.27.206.103'),
(191, 10, '2017-11-15 16:28:53', '176.27.206.103'),
(192, 1, '2017-11-15 19:02:08', '45.249.80.227'),
(193, 7, '2017-11-15 19:03:14', '45.249.80.227'),
(194, 1, '2017-11-15 19:24:50', '45.249.80.227'),
(195, 14, '2017-11-15 22:00:49', '176.27.206.103'),
(196, 10, '2017-11-16 02:56:51', '176.27.206.103'),
(197, 13, '2017-11-16 03:07:38', '82.47.239.225'),
(198, 4, '2017-11-16 03:07:54', '216.189.172.164'),
(199, 1, '2017-11-16 11:23:44', '45.249.80.227'),
(200, 10, '2017-11-16 15:09:14', '5.67.2.195'),
(201, 13, '2017-11-16 18:23:11', '82.47.239.225'),
(202, 13, '2017-11-16 18:23:15', '82.47.239.225'),
(203, 1, '2017-11-16 18:27:33', '45.64.221.236'),
(204, 13, '2017-11-17 02:27:19', '82.47.239.225'),
(205, 10, '2017-11-17 14:41:29', '5.67.2.195'),
(206, 13, '2017-11-17 15:04:07', '82.47.239.225'),
(207, 13, '2017-11-17 15:04:14', '82.47.239.225'),
(208, 13, '2017-11-17 15:20:25', '82.47.239.225'),
(209, 10, '2017-11-18 00:47:26', '5.67.2.195'),
(210, 1, '2017-11-20 11:33:23', '45.249.80.227'),
(211, 11, '2017-11-20 15:01:30', '45.64.221.218'),
(212, 13, '2017-11-20 15:58:37', '82.47.239.225'),
(213, 13, '2017-11-20 15:58:46', '82.47.239.225'),
(214, 10, '2017-11-20 17:06:06', '5.67.2.195'),
(215, 10, '2017-11-20 20:37:52', '5.67.2.195'),
(216, 1, '2017-11-20 21:20:24', '45.64.221.236'),
(217, 4, '2017-11-20 21:24:16', '71.58.84.240'),
(218, 10, '2017-11-20 22:20:51', '5.67.2.195'),
(219, 4, '2017-11-20 22:30:35', '71.58.84.240'),
(220, 10, '2017-11-21 03:32:50', '5.67.2.195'),
(221, 1, '2017-11-21 10:35:38', '45.64.221.236'),
(222, 1, '2017-11-21 21:52:24', '45.64.221.236'),
(223, 4, '2017-11-21 21:52:27', '71.58.84.240'),
(224, 13, '2017-11-21 21:52:46', '82.47.239.225'),
(225, 13, '2017-11-21 21:52:50', '82.47.239.225'),
(226, 1, '2017-11-22 10:48:10', '45.64.221.236'),
(227, 10, '2017-11-22 11:56:52', '5.67.2.195'),
(228, 1, '2017-11-22 17:49:27', '45.249.80.227'),
(229, 11, '2017-11-22 18:13:37', '45.64.221.218'),
(230, 1, '2017-11-22 21:06:54', '45.249.80.227'),
(231, 13, '2017-11-23 02:58:37', '82.47.239.225'),
(232, 13, '2017-11-23 02:58:45', '82.47.239.225'),
(233, 4, '2017-11-23 02:59:28', '71.58.84.240'),
(234, 1, '2017-11-23 10:45:56', '45.249.80.227'),
(235, 13, '2017-11-23 14:23:30', '82.47.239.225'),
(236, 13, '2017-11-23 14:23:34', '82.47.239.225'),
(237, 1, '2017-11-23 14:48:23', '45.64.221.236'),
(238, 1, '2017-11-23 15:49:56', '45.249.80.227'),
(239, 10, '2017-11-23 15:54:08', '5.67.2.195'),
(240, 7, '2017-11-23 15:55:38', '45.249.80.227'),
(241, 15, '2017-11-23 15:57:31', '45.249.80.227'),
(242, 15, '2017-11-23 15:59:52', '45.249.80.227'),
(243, 14, '2017-11-23 16:00:35', '5.67.2.195'),
(244, 14, '2017-11-23 16:00:45', '5.67.2.195'),
(245, 15, '2017-11-23 16:40:59', '45.249.80.227'),
(246, 1, '2017-11-23 17:39:10', '45.249.80.227'),
(247, 1, '2017-11-23 19:58:49', '45.249.80.227'),
(248, 1, '2017-11-23 19:59:24', '45.249.80.227'),
(249, 2, '2017-11-23 21:43:51', '45.64.221.236'),
(250, 13, '2017-11-24 01:26:55', '82.47.239.225'),
(251, 4, '2017-11-24 01:29:01', '71.58.84.240'),
(252, 1, '2017-11-24 11:20:15', '45.64.221.218'),
(253, 10, '2017-11-24 11:22:53', '5.67.2.195'),
(254, 14, '2017-11-24 11:25:54', '5.67.2.195'),
(255, 2, '2017-11-24 11:30:59', '45.64.221.218'),
(256, 13, '2017-11-24 13:54:18', '82.47.239.225'),
(257, 1, '2017-11-24 19:47:59', '45.249.80.227'),
(258, 10, '2017-11-24 20:20:30', '5.67.2.195'),
(259, 2, '2017-11-24 20:52:22', '45.64.221.236'),
(260, 4, '2017-11-24 21:38:00', '71.58.84.240'),
(261, 4, '2017-11-25 02:00:04', '71.58.84.240'),
(262, 4, '2017-11-25 02:04:19', '71.58.84.240'),
(263, 16, '2017-11-25 02:41:56', '5.67.2.195'),
(264, 14, '2017-11-25 03:38:25', '5.67.2.195'),
(265, 2, '2017-11-25 14:41:13', '45.64.221.236'),
(266, 1, '2017-11-25 16:28:11', '45.249.80.227'),
(267, 15, '2017-11-25 19:29:53', '45.249.80.227');

-- --------------------------------------------------------

--
-- Table structure for table `user_nda_settings`
--

CREATE TABLE IF NOT EXISTS `user_nda_settings` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `ndaName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ndaCompanyNo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ndaVatReg` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ndaAddress` text COLLATE utf8_unicode_ci,
  `ndaSignature` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ndaSecurity` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N'
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_nda_settings`
--

INSERT INTO `user_nda_settings` (`id`, `user_id`, `ndaName`, `ndaCompanyNo`, `ndaVatReg`, `ndaAddress`, `ndaSignature`, `ndaSecurity`) VALUES
(1, 1, 'Text', 'fsdfds', NULL, NULL, NULL, 'Y'),
(2, 4, 'test', '343422555', '2525333', 'London, UK', NULL, 'N'),
(3, 10, NULL, NULL, NULL, NULL, NULL, 'N');

-- --------------------------------------------------------

--
-- Table structure for table `user_notifications`
--

CREATE TABLE IF NOT EXISTS `user_notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `sent_by_user` int(11) NOT NULL,
  `title` text COLLATE utf8_unicode_ci,
  `short_description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `full_description` text COLLATE utf8_unicode_ci,
  `notification_link` text COLLATE utf8_unicode_ci,
  `viewed_status` enum('Y','N','D') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y=Viewed, N=Not Viewed, D=Deleted',
  `is_starred` enum('Y','N') COLLATE utf8_unicode_ci DEFAULT 'N' COMMENT 'Y=Yes, N=No',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_notifications`
--

INSERT INTO `user_notifications` (`id`, `user_id`, `sent_by_user`, `title`, `short_description`, `full_description`, `notification_link`, `viewed_status`, `is_starred`, `created_at`, `updated_at`) VALUES
(1, 11, 1, '', 'Pabitra M sent a proposal', 'Pabitra M sent a proposal', NULL, 'N', 'N', '2017-11-01 13:04:11', '2017-11-01 13:04:11'),
(2, 1, 7, '', 'Navin Raj accepted your proposal', 'Navin Raj accepted your proposal', NULL, 'Y', 'Y', '2017-11-01 13:24:14', '2017-11-21 10:36:17'),
(3, 1, 7, '', 'Navin Raj funded to your wallet', 'Navin Raj funded to your wallet', NULL, 'Y', 'N', '2017-11-01 14:37:45', '2017-11-21 10:36:17'),
(4, 1, 7, '', 'Navin Raj funded to your wallet', 'Navin Raj funded to your wallet', NULL, 'Y', 'N', '2017-11-01 14:38:33', '2017-11-21 10:36:17'),
(6, 7, 1, '', 'Pabitra M posted a review respect your posted job', 'Pabitra M posted a review respect your posted job', NULL, 'N', 'N', '2017-11-01 16:10:44', '2017-11-01 16:10:44'),
(8, 1, 7, '', 'Navin Raj posted a review respect your work done', 'Navin Raj posted a review respect your work done', NULL, 'Y', 'N', '2017-11-01 16:48:41', '2017-11-21 10:36:17'),
(9, 7, 1, '', 'Pabitra M invited you to view a new posted job', 'Pabitra M invited you to view a new posted job', NULL, 'N', 'N', '2017-11-02 19:55:57', '2017-11-02 19:55:57'),
(10, 7, 1, '', 'Pabitra M invited you to view a new posted job', 'Pabitra M invited you to view a new posted job', NULL, 'N', 'N', '2017-11-02 19:59:01', '2017-11-02 19:59:01'),
(11, 7, 1, '', 'Pabitra M invited you to view a new posted job', 'Pabitra M invited you to view a new posted job', NULL, 'N', 'N', '2017-11-02 20:54:34', '2017-11-02 20:54:34'),
(12, 7, 1, '', 'Pabitra M invited you to view a new posted job', 'Pabitra M invited you to view a new posted job', NULL, 'N', 'N', '2017-11-02 21:02:08', '2017-11-02 21:02:08'),
(13, 11, 10, '', 'sam nej invited you to view a new posted job', 'sam nej invited you to view a new posted job', NULL, 'N', 'N', '2017-11-03 14:27:34', '2017-11-03 14:27:34'),
(14, 11, 1, '', 'Pabitra Mandal invited you to view a new posted job', 'Pabitra Mandal invited you to view a new posted job', NULL, 'N', 'N', '2017-11-07 15:19:36', '2017-11-07 15:19:36'),
(15, 1, 7, '', 'Navin Raj sent a proposal', 'Navin Raj sent a proposal', NULL, 'Y', 'N', '2017-11-09 18:15:19', '2017-11-21 10:36:17'),
(16, 7, 1, '', 'Pabitra Mandal sent a proposal', 'Pabitra Mandal sent a proposal', NULL, 'N', 'N', '2017-11-09 18:19:32', '2017-11-09 18:19:32'),
(17, 7, 1, '', 'Pabitra Mandal sent a proposal', 'Pabitra Mandal sent a proposal', NULL, 'N', 'N', '2017-11-09 18:22:58', '2017-11-09 18:22:58'),
(18, 7, 1, '', 'Pabitra Mandal sent a proposal', 'Pabitra Mandal sent a proposal', NULL, 'N', 'N', '2017-11-10 16:03:16', '2017-11-10 16:03:16'),
(19, 7, 1, '', 'Pabitra Mandal sent a proposal', 'Pabitra Mandal sent a proposal', NULL, 'N', 'N', '2017-11-10 16:06:06', '2017-11-10 16:06:06'),
(20, 7, 2, '', 'S Saha sent a proposal', 'S Saha sent a proposal', NULL, 'N', 'N', '2017-11-13 21:28:07', '2017-11-13 21:28:07'),
(21, 1, 2, '', 'S Saha sent a proposal', 'S Saha sent a proposal', NULL, 'Y', 'N', '2017-11-13 21:29:04', '2017-11-21 10:36:17'),
(22, 2, 1, '', 'Pabitra Mandal accepted your proposal', 'Pabitra Mandal accepted your proposal', NULL, 'Y', 'N', '2017-11-13 21:29:38', '2017-11-24 11:31:37'),
(23, 2, 1, '', 'Pabitra Mandal funded to your wallet', 'Pabitra Mandal funded to your wallet', NULL, 'Y', 'N', '2017-11-13 21:29:56', '2017-11-24 11:31:37'),
(24, 1, 2, '', 'S Saha posted a review respect your posted job', 'S Saha posted a review respect your posted job', NULL, 'Y', 'N', '2017-11-13 21:34:48', '2017-11-21 10:36:17'),
(25, 2, 1, '', 'Pabitra Mandal posted a review respect your work done', 'Pabitra Mandal posted a review respect your work done', NULL, 'Y', 'N', '2017-11-13 21:34:58', '2017-11-24 11:31:37'),
(26, 1, 10, '', 'sam nej accepted your proposal', 'sam nej accepted your proposal', NULL, 'Y', 'N', '2017-11-15 16:30:28', '2017-11-21 10:36:17'),
(27, 1, 7, '', 'Navin Raj posted a review respect your work done', 'Navin Raj posted a review respect your work done', NULL, 'D', 'N', '2017-11-15 19:23:52', '2017-11-15 19:43:07'),
(28, 13, 10, '', 'sam nej sent a proposal', 'sam nej sent a proposal', NULL, 'Y', 'N', '2017-11-17 14:58:57', '2017-11-24 02:32:19'),
(29, 10, 13, '', 'Subir Roy accepted your proposal', 'Subir Roy accepted your proposal', NULL, 'Y', 'Y', '2017-11-17 15:06:56', '2017-11-23 15:57:55'),
(30, 1, 10, '', 'sam nej funded to your wallet', 'sam nej funded to your wallet', NULL, 'Y', 'N', '2017-11-17 16:30:48', '2017-11-21 10:36:17'),
(31, 13, 1, '', 'Pabitra Mandal sent a proposal', 'Pabitra Mandal sent a proposal', NULL, 'Y', 'N', '2017-11-20 21:22:22', '2017-11-24 02:32:19'),
(32, 1, 13, '', 'Subir Roy accepted your proposal', 'Subir Roy accepted your proposal', NULL, 'Y', 'N', '2017-11-20 21:24:30', '2017-11-21 10:36:17'),
(33, 1, 13, '', 'Subir Roy accepted your proposal', 'Subir Roy accepted your proposal', NULL, 'Y', 'N', '2017-11-20 21:24:32', '2017-11-21 10:36:17'),
(34, 1, 13, '', 'Subir Roy funded to your wallet', 'Subir Roy funded to your wallet', NULL, 'Y', 'N', '2017-11-20 21:27:53', '2017-11-21 10:36:17'),
(35, 1, 10, '', 'sam nej sent a proposal', 'sam nej sent a proposal', NULL, 'Y', 'N', '2017-11-20 22:24:45', '2017-11-21 10:36:17'),
(36, 10, 13, '', 'Subir Roy funded to your wallet', 'Subir Roy funded to your wallet', NULL, 'Y', 'N', '2017-11-20 22:36:04', '2017-11-23 15:57:55'),
(37, 13, 10, '', 'sam nej posted a review respect your posted job', 'sam nej posted a review respect your posted job', NULL, 'Y', 'N', '2017-11-23 15:57:46', '2017-11-24 02:32:19'),
(38, 14, 10, '', 'sam nej sent a proposal', 'sam nej sent a proposal', NULL, 'N', 'N', '2017-11-23 16:10:02', '2017-11-23 16:10:02'),
(39, 10, 14, '', 'SAMAN NEJAD accepted your proposal', 'SAMAN NEJAD accepted your proposal', NULL, 'N', 'N', '2017-11-23 16:12:47', '2017-11-23 16:12:47'),
(40, 1, 15, '', 'Uttam Chowdhuri sent a proposal', 'Uttam Chowdhuri sent a proposal', '/jobs/view-project/30', 'N', 'N', '2017-11-23 16:47:24', '2017-11-23 16:47:24'),
(41, 2, 1, '', 'Pabitra Mandal sent a proposal', 'Pabitra Mandal sent a proposal', '/jobs/view-project/36', 'Y', 'N', '2017-11-23 21:45:59', '2017-11-24 11:31:37'),
(42, 1, 2, '', 'S Saha accepted your proposal', 'S Saha accepted your proposal', '/jobs/send-proposal/36', 'N', 'N', '2017-11-23 21:47:09', '2017-11-23 21:47:09'),
(43, 1, 2, '', 'S Saha funded to your wallet', 'S Saha funded to your wallet', '/payments/view-payments/36', 'N', 'N', '2017-11-23 21:47:48', '2017-11-23 21:47:48'),
(44, 2, 1, '', 'Pabitra Mandal posted a review respect your posted job', 'Pabitra Mandal posted a review respect your posted job', '/jobs/my-workstream', 'Y', 'N', '2017-11-23 21:52:22', '2017-11-24 11:31:37'),
(45, 13, 4, '', 'Ion Paaa sent a proposal', 'Ion Paaa sent a proposal', '/jobs/view-project/39', 'Y', 'N', '2017-11-24 02:29:34', '2017-11-24 02:32:19'),
(46, 4, 13, '', 'Subir Roy accepted your proposal', 'Subir Roy accepted your proposal', '/jobs/send-proposal/39', 'Y', 'N', '2017-11-24 02:31:01', '2017-11-24 02:32:10'),
(47, 4, 13, '', 'Subir Roy accepted your proposal', 'Subir Roy accepted your proposal', '/jobs/send-proposal/39', 'D', 'N', '2017-11-24 02:31:04', '2017-11-24 02:32:06'),
(48, 4, 16, '', 'X Y sent a proposal', 'X Y sent a proposal', '/jobs/view-project/38', 'N', 'N', '2017-11-25 03:08:33', '2017-11-25 03:08:33'),
(49, 16, 14, '', 'SAMAN NEJAD sent a proposal', 'SAMAN NEJAD sent a proposal', '/jobs/view-project/40', 'N', 'N', '2017-11-25 03:38:50', '2017-11-25 03:38:50');

-- --------------------------------------------------------

--
-- Table structure for table `user_portfolios`
--

CREATE TABLE IF NOT EXISTS `user_portfolios` (
  `portfolio_id` int(11) NOT NULL COMMENT 'primary key for this table',
  `user_id` int(11) NOT NULL COMMENT 'user, who uploaded the portfolio',
  `portfolio_name` varchar(255) NOT NULL,
  `uploaded_date` datetime NOT NULL,
  `description` text,
  `short_desription` varchar(50) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `file_name` varchar(150) NOT NULL,
  `portfolio_link` text,
  `number_of_views` int(11) NOT NULL DEFAULT '0',
  `likes` int(11) NOT NULL DEFAULT '0',
  `shares` int(11) NOT NULL DEFAULT '0',
  `status` enum('1','2','3') NOT NULL DEFAULT '1' COMMENT '1=Active, 2=inactive, 3=Deleted'
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_portfolios`
--

INSERT INTO `user_portfolios` (`portfolio_id`, `user_id`, `portfolio_name`, `uploaded_date`, `description`, `short_desription`, `file_path`, `file_name`, `portfolio_link`, `number_of_views`, `likes`, `shares`, `status`) VALUES
(1, 1, 'My first portfolio 1', '2017-08-01 05:25:43', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br />\r\nIt has survived not only five centuries, but also the leap into electronic typesetting', 'Lorem Ipsum is simply dummy te', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15015115541Hydrangeas.jpg', NULL, 2, 0, 0, '1'),
(2, 1, 'My first portfolios 2', '2017-08-10 07:52:03', 'My first portfolio 2', 'My first portfolio 2', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150156522511-7-(1).jpg', 'http://www.technoexponent.com/', 0, 2, 0, '1'),
(3, 2, 'test update', '2017-08-01 08:13:51', 'testtsts', 'testtsts', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15015752192Professional-Man-Business-Suit-Dressed.jpg', NULL, 0, 0, 0, '1'),
(5, 4, 'Project 2', '2017-08-05 12:38:48', 'This is the second project', 'This is the second project', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150193672841377071783-fd1df0b69162f1327f41386e498c27f8.png', 'www.project2.com', 1, 1, 0, '1'),
(7, 5, 'Website', '2017-08-14 19:01:41', 'Website for social media', 'Website for social media', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15027372525234590_633876614566045295.jpg', NULL, 0, 0, 0, '1'),
(8, 6, 'hibryd app', '2017-08-14 19:15:36', 'hibrid app done using MEAN', 'hibrid app done using MEAN', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15027381366the-inspirations-behind-20-of-the-most-well-known-logos-in-high-fashion-05.jpg', NULL, 1, 0, 0, '1'),
(9, 9, 'Ion Pantalon', '2017-08-26 17:12:16', 'my first project', 'my first project', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '1503767536916388108_107142469802403_7153629569236143291_n.jpg', NULL, 0, 0, 0, '1'),
(10, 11, 'Test', '2017-10-18 16:59:06', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'It is a long established fact ', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150834594611changes.jpg', 'http://template1.teexponent.com/leadview360/', 3, 0, 0, '1'),
(11, 10, 'TeamsNetwork', '2017-10-19 09:22:50', 'Artwork', 'Artwork', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150840497010Banner_Image.png', NULL, 1, 0, 0, '1'),
(12, 11, 'Web Design', '2017-10-19 12:27:24', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'It is a long established fact ', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150841604411hourglass-1716428_1920.jpg', 'https://www.youtube.com/embed/r8vzJN_DmhQ', 3, 1, 0, '1'),
(13, 11, 'Art Design', '2017-10-19 12:31:39', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 'It is a long established fact ', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150841629911forest-1960253_1920.jpg', NULL, 3, 0, 0, '1'),
(14, 10, 'Characters', '2017-10-24 17:12:26', 'Charcters for Teams Network Branding', 'Charcters for Teams Network Br', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150884534610Screen-Shot-2017-10-13-at-12.17.20.png', NULL, 2, 0, 0, '1'),
(15, 14, 'First', '2017-11-23 16:02:44', 'Upload', 'Upload', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '151143316414dss00002-600x600-600x600.jpg', NULL, 2, 0, 0, '1'),
(16, 15, 'TeamNetwork', '2017-11-23 17:11:04', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. Nulla consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget, arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi. Aenean vulputate eleifend tellus. Aenean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante, dapibus in, viverra quis, feugiat a,', 'Lorem ipsum dolor sit amet, co', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '151143726415Home@2x.png', NULL, 0, 0, 0, '1'),
(17, 15, 'TeamNetwork', '2017-11-23 17:11:49', 'Al pages html', 'Al pages html', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '151143730915LOGIN@2x.png', NULL, 0, 0, 0, '1'),
(18, 13, 'First Website', '2017-11-23 22:17:14', 'Food Website', 'Food Website', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '151145563413Chinese-Herbs.jpg', 'www.food.com', 2, 1, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_skill_map`
--

CREATE TABLE IF NOT EXISTS `user_skill_map` (
  `map_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=146 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_skill_map`
--

INSERT INTO `user_skill_map` (`map_id`, `user_id`, `skill_id`) VALUES
(10, 3, 6),
(70, 2, 6),
(71, 2, 7),
(72, 2, 9),
(73, 2, 5),
(74, 2, 10),
(75, 2, 2),
(79, 5, 8),
(81, 6, 9),
(82, 7, 7),
(119, 11, 6),
(120, 11, 7),
(124, 4, 7),
(125, 4, 1),
(126, 4, 9),
(127, 4, 5),
(128, 4, 10),
(129, 4, 8),
(130, 10, 10),
(131, 1, 6),
(132, 1, 7),
(133, 1, 1),
(134, 1, 5),
(135, 1, 2),
(141, 13, 6),
(142, 13, 7),
(143, 13, 5),
(144, 13, 2),
(145, 13, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE IF NOT EXISTS `user_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0' COMMENT 'payment made by user',
  `job_id` int(11) NOT NULL DEFAULT '0' COMMENT 'paid for job',
  `proposal_id` int(11) NOT NULL DEFAULT '0' COMMENT 'paid for proposal',
  `milestone_id` int(11) DEFAULT '0',
  `transaction_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` float(11,2) NOT NULL,
  `paid_by` enum('P','S','I','D') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P' COMMENT 'P= Paypal, S=Stripe, I=Invoice, D=Deduct from wallet',
  `transaction_type` enum('D','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'D=Debit, C=Credit',
  `payment_for` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `is_cashout_admin` enum('Y','N','S') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y- Yes, N- No, S- Request scheduled but still pending',
  `is_released` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `is_withdraw_request_received` enum('Y','P','R') COLLATE utf8_unicode_ci DEFAULT 'Y' COMMENT 'Y=Yes Delivered, P=Pending, R=Rejected',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `user_id`, `job_id`, `proposal_id`, `milestone_id`, `transaction_id`, `amount`, `paid_by`, `transaction_type`, `payment_for`, `payment_status`, `is_cashout_admin`, `is_released`, `is_withdraw_request_received`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 1, 0, 'WO8186-2-1', 325.00, 'S', 'C', 'Proposal amount', 'Y', 'Y', 'N', 'P', '2017-10-10 08:00:29', '2017-10-06 20:48:39'),
(2, 1, 9, 2, 0, 'WO3311-3-2', 500.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'P', '2017-10-10 12:02:23', '2017-10-10 11:34:25'),
(3, 1, 9, 2, 3, '1507638516-9-2', 100.00, 'I', 'D', 'Project completion amount', 'Y', 'N', 'Y', 'P', '2017-10-10 17:28:36', '2017-10-10 17:28:36'),
(4, 7, 9, 2, 3, '1507638516-9-2', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'P', '2017-10-10 17:28:36', '2017-10-10 17:28:36'),
(5, 1, 10, 4, 0, 'WO9142-4-4', 500.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'P', '2017-10-11 12:20:32', '2017-10-11 12:20:32'),
(6, 1, 10, 4, 10, '1507706520-10-4', 100.00, 'I', 'D', 'Project completion amount', 'Y', 'N', 'Y', 'P', '2017-10-11 12:22:00', '2017-10-11 12:22:00'),
(7, 7, 10, 4, 10, '1507706520-10-4', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'P', '2017-10-11 12:22:00', '2017-10-11 12:22:00'),
(11, 1, 0, 0, 0, '15079937081', 1125.00, 'I', 'D', 'Money withdraw request!', 'Y', 'N', 'N', 'P', '2017-10-14 20:08:28', '2017-10-14 20:08:28'),
(12, 1, 2, 1, 0, 'WO8099-8-1', 100.00, '', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-10-17 15:42:49', '2017-10-17 20:38:39'),
(14, 1, 9, 2, 0, 'WO7962-9-2', 256.00, '', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-10-17 15:42:48', '2017-10-17 20:41:26'),
(34, 0, 2, 1, 1, '1509134017-2-1', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-10-28 06:23:37', '2017-10-28 06:23:37'),
(33, 7, 2, 1, 1, '1509134017-2-1', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-10-28 06:23:37', '2017-10-28 06:23:37'),
(29, 7, 2, 1, 0, 'WO8795-17-1-3', 150.00, '', 'C', 'Invoice amount', 'Y', 'N', 'N', 'Y', '2017-10-23 21:07:45', '2017-10-23 21:07:45'),
(28, 1, 2, 1, 0, 'WO8795-17-1-3', 150.00, '', 'D', 'Invoice amount', 'Y', 'N', 'N', 'Y', '2017-10-23 21:07:45', '2017-10-23 21:07:45'),
(27, 1, 2, 1, 0, 'WO8795-17-1-3', 150.00, '', 'C', 'Invoice amount', 'Y', 'N', 'N', 'Y', '2017-10-23 21:07:45', '2017-10-23 21:07:45'),
(40, 7, 12, 5, 0, 'WO4271-22-5', 325.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-01 18:24:14', '2017-11-01 18:24:14'),
(39, 7, 12, 5, 0, 'WO4271-22-5', 325.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-01 18:24:14', '2017-11-01 18:24:14'),
(41, 1, 12, 5, 16, '1509527265-12-5', 175.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-01 19:37:45', '2017-11-01 19:37:45'),
(42, 0, 12, 5, 16, '1509527265-12-5', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-01 19:37:45', '2017-11-01 19:37:45'),
(43, 1, 12, 5, 17, '1509527313-12-5', 150.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-01 19:38:33', '2017-11-01 19:38:33'),
(44, 0, 12, 5, 17, '1509527313-12-5', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-01 19:38:33', '2017-11-01 19:38:33'),
(45, 1, 10, 4, 0, 'WO4973-24-4', 100.00, '', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-02 21:18:03', '2017-11-02 21:18:03'),
(46, 0, 20, 0, 0, 'WO1772-20', 3.00, 'D', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-06 16:54:15', '2017-11-06 16:54:15'),
(47, 1, 20, 0, 0, 'WO8288-20', 3.00, 'D', 'D', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-06 05:25:40', '2017-11-06 16:54:15'),
(48, 0, 21, 0, 0, 'WO9869-25-21-1', 3.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-06 17:12:04', '2017-11-06 17:12:04'),
(49, 0, 21, 0, 0, 'WO8979-21-1', 778.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-06 17:12:04', '2017-11-06 17:12:04'),
(50, 1, 21, 0, 0, 'WO9576-21-1', 778.00, 'S', 'D', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-06 17:12:04', '2017-11-06 17:12:04'),
(54, 0, 0, 0, 0, 'WO5288-1', 3.99, 'D', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 02:42:48', '2017-11-07 02:42:48'),
(53, 0, 0, 0, 0, 'WO5524-29-2', 7.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 02:01:58', '2017-11-07 02:01:58'),
(55, 7, 0, 0, 0, 'WO7628-1', 3.99, 'D', 'D', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 02:42:48', '2017-11-07 02:42:48'),
(56, 0, 0, 0, 0, 'WO0435-3', 9.99, 'D', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 02:45:17', '2017-11-07 02:45:17'),
(57, 7, 0, 0, 0, 'WO3984-3', 9.99, 'D', 'D', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 02:45:17', '2017-11-07 02:45:17'),
(58, 0, 22, 0, 0, 'WO1120-33-22-1', 3.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-07 21:15:53', '2017-11-07 21:15:53'),
(59, 0, 22, 0, 0, 'WO1120-33-22-1', 3.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-07 21:16:11', '2017-11-07 21:16:11'),
(60, 0, 23, 0, 0, 'WO3235-34-23-1', 3.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-07 21:17:38', '2017-11-07 21:17:38'),
(61, 0, 0, 0, 0, 'WO6817-35-2', 7.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 21:25:02', '2017-11-07 21:25:02'),
(62, 0, 0, 0, 0, 'WO9998-36-1', 4.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-07 21:25:39', '2017-11-07 21:25:39'),
(63, 0, 18, 0, 0, 'WO0573-41-18-1', 3.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-09 19:43:56', '2017-11-09 19:43:56'),
(64, 0, 26, 0, 0, 'WO9001-43-26-1', 3.00, 'S', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-09 22:08:59', '2017-11-09 22:08:59'),
(65, 0, 23, 18, 0, 'WO4476-23-18', 1.00, 'D', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 00:15:19', '2017-11-10 00:15:19'),
(66, 7, 23, 18, 0, 'WO4580-23-18', 1.00, 'D', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 00:15:19', '2017-11-10 00:15:19'),
(67, 1, 27, 20, 0, 'WO9093-46-27-20', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 00:28:33', '2017-11-10 00:28:33'),
(68, 1, 27, 20, 0, 'WO9093-46-27-20', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 00:28:33', '2017-11-10 00:28:33'),
(69, 0, 27, 20, 0, 'WO9093-46-27-20', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 00:28:33', '2017-11-10 00:28:33'),
(70, 0, 23, 18, 0, 'WO9353-23-18', 1.00, 'D', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 02:37:14', '2017-11-10 02:37:14'),
(71, 7, 23, 18, 0, 'WO0430-23-18', 1.00, 'D', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 02:37:14', '2017-11-10 02:37:14'),
(72, 0, 23, 18, 0, 'WO5052-23-18', 1.00, 'D', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 02:40:28', '2017-11-10 02:40:28'),
(73, 7, 23, 18, 0, 'WO1543-23-18', 1.00, 'D', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 02:40:28', '2017-11-10 02:40:28'),
(74, 0, 28, 0, 0, 'WO4211-28', 3.00, 'D', 'C', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-10 02:47:06', '2017-11-10 02:47:06'),
(75, 7, 28, 0, 0, 'WO5338-28', 3.00, 'D', 'D', 'Post jobs', 'Y', 'N', 'N', 'Y', '2017-11-10 02:47:06', '2017-11-10 02:47:06'),
(76, 1, 28, 22, 0, 'WO2668-48-28-22', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 22:06:51', '2017-11-10 22:06:51'),
(77, 1, 28, 22, 0, 'WO2668-48-28-22', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 22:06:51', '2017-11-10 22:06:51'),
(78, 0, 28, 22, 0, 'WO2668-48-28-22', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-10 22:06:51', '2017-11-10 22:06:51'),
(79, 0, 0, 0, 0, 'WO3217-50-1', 4.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-14 03:27:27', '2017-11-14 03:27:27'),
(80, 1, 29, 24, 0, 'WO7640-51-24', 100.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-14 03:29:38', '2017-11-14 03:29:38'),
(81, 1, 29, 24, 0, 'WO7640-51-24', 100.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-14 03:29:38', '2017-11-14 03:29:38'),
(82, 2, 29, 24, 52, '1510588796-29-24', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-14 03:29:56', '2017-11-14 03:29:56'),
(83, 0, 29, 24, 52, '1510588796-29-24', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-14 03:29:56', '2017-11-14 03:29:56'),
(84, 0, 0, 0, 0, 'WO2809-52-4', 17.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-15 07:14:34', '2017-11-15 07:14:34'),
(85, 10, 8, 3, 0, 'WO3336-53-3', 500.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-15 22:30:28', '2017-11-15 22:30:28'),
(86, 10, 8, 3, 0, 'WO3336-53-3', 500.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-15 22:30:28', '2017-11-15 22:30:28'),
(87, 0, 0, 0, 0, 'WO6635-54-4', 17.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-16 04:07:20', '2017-11-16 04:07:20'),
(88, 13, 31, 25, 0, 'WO8225-56-25', 100.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-17 21:06:56', '2017-11-17 21:06:56'),
(89, 13, 31, 25, 0, 'WO8225-56-25', 100.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-17 21:06:56', '2017-11-17 21:06:56'),
(90, 1, 8, 3, 56, '1510916448-8-3', 150.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-17 22:30:48', '2017-11-17 22:30:48'),
(91, 0, 8, 3, 56, '1510916448-8-3', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-17 22:30:48', '2017-11-17 22:30:48'),
(92, 13, 32, 26, 0, 'WO6175-58-26', 100.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-21 03:24:30', '2017-11-21 03:24:30'),
(93, 13, 32, 26, 0, 'WO6175-58-26', 100.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-21 03:24:30', '2017-11-21 03:24:30'),
(94, 13, 32, 26, 0, 'WO6175-58-26', 100.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-21 03:24:32', '2017-11-21 03:24:32'),
(95, 13, 32, 26, 0, 'WO6175-58-26', 100.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-21 03:24:32', '2017-11-21 03:24:32'),
(96, 1, 32, 26, 60, '1511193473-32-26', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-21 03:27:53', '2017-11-21 03:27:53'),
(97, 0, 32, 26, 60, '1511193473-32-26', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-21 03:27:53', '2017-11-21 03:27:53'),
(98, 10, 30, 27, 0, 'WO9671-59-30-27', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-21 04:25:19', '2017-11-21 04:25:19'),
(99, 10, 30, 27, 0, 'WO9671-59-30-27', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-21 04:25:19', '2017-11-21 04:25:19'),
(100, 0, 30, 27, 0, 'WO9671-59-30-27', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-21 04:25:19', '2017-11-21 04:25:19'),
(101, 10, 31, 25, 59, '1511197564-31-25', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-21 04:36:04', '2017-11-21 04:36:04'),
(102, 0, 31, 25, 59, '1511197564-31-25', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-21 04:36:04', '2017-11-21 04:36:04'),
(103, 14, 35, 28, 0, 'WO6428-62-28', 100.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-23 22:12:47', '2017-11-23 22:12:47'),
(104, 14, 35, 28, 0, 'WO6428-62-28', 100.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-23 22:12:47', '2017-11-23 22:12:47'),
(105, 0, 0, 0, 0, 'WO0777-63-1', 4.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-23 22:46:21', '2017-11-23 22:46:21'),
(106, 15, 30, 29, 0, 'WO4056-64-30-29', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-23 22:47:45', '2017-11-23 22:47:45'),
(107, 15, 30, 29, 0, 'WO4056-64-30-29', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-23 22:47:45', '2017-11-23 22:47:45'),
(108, 0, 30, 29, 0, 'WO4056-64-30-29', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-23 22:47:45', '2017-11-23 22:47:45'),
(109, 2, 36, 30, 0, 'WO1476-65-30', 1000.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 03:47:09', '2017-11-24 03:47:09'),
(110, 2, 36, 30, 0, 'WO1476-65-30', 1000.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 03:47:09', '2017-11-24 03:47:09'),
(111, 1, 36, 30, 64, '1511453868-36-30', 1000.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-24 03:47:48', '2017-11-24 03:47:48'),
(112, 0, 36, 30, 64, '1511453868-36-30', 0.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', 'Y', '2017-11-24 03:47:48', '2017-11-24 03:47:48'),
(113, 0, 0, 0, 0, 'WO9272-68-4', 17.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-24 08:28:28', '2017-11-24 08:28:28'),
(114, 0, 0, 0, 0, 'WO9272-68-4', 17.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-24 08:28:29', '2017-11-24 08:28:29'),
(115, 4, 39, 31, 0, 'WO6086-69-39-31', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-24 08:30:03', '2017-11-24 08:30:03'),
(116, 4, 39, 31, 0, 'WO6086-69-39-31', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-24 08:30:03', '2017-11-24 08:30:03'),
(117, 0, 39, 31, 0, 'WO6086-69-39-31', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-24 08:30:03', '2017-11-24 08:30:03'),
(118, 4, 39, 31, 0, 'WO6086-69-39-31', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-24 08:30:05', '2017-11-24 08:30:05'),
(119, 4, 39, 31, 0, 'WO6086-69-39-31', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-24 08:30:05', '2017-11-24 08:30:05'),
(120, 0, 39, 31, 0, 'WO6086-69-39-31', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-24 08:30:05', '2017-11-24 08:30:05'),
(121, 13, 39, 31, 0, 'WO6123-70-31', 45.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 08:31:01', '2017-11-24 08:31:01'),
(122, 13, 39, 31, 0, 'WO6123-70-31', 45.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 08:31:01', '2017-11-24 08:31:01'),
(123, 13, 39, 31, 0, 'WO6123-70-31', 45.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 08:31:04', '2017-11-24 08:31:04'),
(124, 13, 39, 31, 0, 'WO6123-70-31', 45.00, 'S', 'D', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 08:31:04', '2017-11-24 08:31:04'),
(125, 13, 31, 25, 0, 'WO8912-72-25', 1000000.00, '', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 09:54:59', '2017-11-24 09:54:59'),
(126, 13, 31, 25, 0, 'WO8912-72-25', 1000000.00, '', 'C', 'Proposal amount', 'Y', 'N', 'N', 'Y', '2017-11-24 09:55:00', '2017-11-24 09:55:00'),
(127, 0, 0, 0, 0, 'WO4629-73-4', 17.00, 'S', 'C', 'Bid credit', 'Y', 'N', 'N', 'Y', '2017-11-25 09:02:17', '2017-11-25 09:02:17'),
(128, 16, 38, 32, 0, 'WO0431-76-38-32', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-25 09:08:52', '2017-11-25 09:08:52'),
(129, 16, 38, 32, 0, 'WO0431-76-38-32', 1.00, 'S', 'D', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-25 09:08:52', '2017-11-25 09:08:52'),
(130, 0, 38, 32, 0, 'WO0431-76-38-32', 1.00, 'S', 'C', 'Highlight bid', 'Y', 'N', 'N', 'Y', '2017-11-25 09:08:52', '2017-11-25 09:08:52');

-- --------------------------------------------------------

--
-- Table structure for table `user_wants_notifications`
--

CREATE TABLE IF NOT EXISTS `user_wants_notifications` (
  `user_id` int(11) NOT NULL,
  `notification_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_wants_notifications`
--

INSERT INTO `user_wants_notifications` (`user_id`, `notification_id`) VALUES
(4, 2),
(4, 1),
(1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_wants_updates`
--

CREATE TABLE IF NOT EXISTS `user_wants_updates` (
  `user_id` int(11) NOT NULL,
  `update_id` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_wants_updates`
--

INSERT INTO `user_wants_updates` (`user_id`, `update_id`) VALUES
(4, 3),
(1, 3),
(1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `admins_email_unique` (`email`);

--
-- Indexes for table `budgets`
--
ALTER TABLE `budgets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_subcategory`
--
ALTER TABLE `category_subcategory`
  ADD PRIMARY KEY (`category_id`);

--
-- Indexes for table `cities`
--
ALTER TABLE `cities`
  ADD PRIMARY KEY (`id`), ADD KEY `cities_state_id_foreign` (`state_id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `experience_levels`
--
ALTER TABLE `experience_levels`
  ADD PRIMARY KEY (`level_id`);

--
-- Indexes for table `field_of_work_type`
--
ALTER TABLE `field_of_work_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `focus_type`
--
ALTER TABLE `focus_type`
  ADD PRIMARY KEY (`focus_type_id`);

--
-- Indexes for table `hirer_subscriptions`
--
ALTER TABLE `hirer_subscriptions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobassets`
--
ALTER TABLE `jobassets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `jobprovider_transactions`
--
ALTER TABLE `jobprovider_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_assesments`
--
ALTER TABLE `job_assesments`
  ADD PRIMARY KEY (`assesment_id`);

--
-- Indexes for table `job_bid_credit_lists`
--
ALTER TABLE `job_bid_credit_lists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_proposals`
--
ALTER TABLE `job_proposals`
  ADD PRIMARY KEY (`proposal_id`);

--
-- Indexes for table `job_proposal_amounts`
--
ALTER TABLE `job_proposal_amounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_ratings`
--
ALTER TABLE `job_ratings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_skill_maps`
--
ALTER TABLE `job_skill_maps`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `job_type`
--
ALTER TABLE `job_type`
  ADD PRIMARY KEY (`job_type_id`);

--
-- Indexes for table `languages`
--
ALTER TABLE `languages`
  ADD PRIMARY KEY (`id`), ADD KEY `languages_locale_index` (`locale`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `monthly_bid_details`
--
ALTER TABLE `monthly_bid_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification_masters`
--
ALTER TABLE `notification_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `portfolios_like_share_preview`
--
ALTER TABLE `portfolios_like_share_preview`
  ADD PRIMARY KEY (`action_id`), ADD KEY `portfolio_id` (`portfolio_id`);

--
-- Indexes for table `postedjobs`
--
ALTER TABLE `postedjobs`
  ADD PRIMARY KEY (`job_id`);

--
-- Indexes for table `project_lengths`
--
ALTER TABLE `project_lengths`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_settings`
--
ALTER TABLE `project_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `security_questions`
--
ALTER TABLE `security_questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings_jobs`
--
ALTER TABLE `settings_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`skill_id`);

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`), ADD KEY `states_country_id_foreign` (`country_id`);

--
-- Indexes for table `task_assigned_members`
--
ALTER TABLE `task_assigned_members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_attachments`
--
ALTER TABLE `task_attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `travel_master`
--
ALTER TABLE `travel_master`
  ADD PRIMARY KEY (`travel_id`);

--
-- Indexes for table `turn_around_times`
--
ALTER TABLE `turn_around_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `update_masters`
--
ALTER TABLE `update_masters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`), ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `users_profile_views`
--
ALTER TABLE `users_profile_views`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_chats`
--
ALTER TABLE `user_chats`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_chat_files`
--
ALTER TABLE `user_chat_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`details_id`);

--
-- Indexes for table `user_general_settings`
--
ALTER TABLE `user_general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_job_tasks`
--
ALTER TABLE `user_job_tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_logins`
--
ALTER TABLE `user_logins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_nda_settings`
--
ALTER TABLE `user_nda_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_notifications`
--
ALTER TABLE `user_notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_portfolios`
--
ALTER TABLE `user_portfolios`
  ADD PRIMARY KEY (`portfolio_id`);

--
-- Indexes for table `user_skill_map`
--
ALTER TABLE `user_skill_map`
  ADD PRIMARY KEY (`map_id`);

--
-- Indexes for table `user_transactions`
--
ALTER TABLE `user_transactions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `budgets`
--
ALTER TABLE `budgets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `category_subcategory`
--
ALTER TABLE `category_subcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=176;
--
-- AUTO_INCREMENT for table `cities`
--
ALTER TABLE `cities`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=246;
--
-- AUTO_INCREMENT for table `experience_levels`
--
ALTER TABLE `experience_levels`
  MODIFY `level_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `field_of_work_type`
--
ALTER TABLE `field_of_work_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `focus_type`
--
ALTER TABLE `focus_type`
  MODIFY `focus_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `hirer_subscriptions`
--
ALTER TABLE `hirer_subscriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `jobassets`
--
ALTER TABLE `jobassets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `jobprovider_transactions`
--
ALTER TABLE `jobprovider_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=77;
--
-- AUTO_INCREMENT for table `job_assesments`
--
ALTER TABLE `job_assesments`
  MODIFY `assesment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=89;
--
-- AUTO_INCREMENT for table `job_bid_credit_lists`
--
ALTER TABLE `job_bid_credit_lists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `job_proposals`
--
ALTER TABLE `job_proposals`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
--
-- AUTO_INCREMENT for table `job_proposal_amounts`
--
ALTER TABLE `job_proposal_amounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=68;
--
-- AUTO_INCREMENT for table `job_ratings`
--
ALTER TABLE `job_ratings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `job_skill_maps`
--
ALTER TABLE `job_skill_maps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=149;
--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `job_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `languages`
--
ALTER TABLE `languages`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `monthly_bid_details`
--
ALTER TABLE `monthly_bid_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=25;
--
-- AUTO_INCREMENT for table `notification_masters`
--
ALTER TABLE `notification_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `portfolios_like_share_preview`
--
ALTER TABLE `portfolios_like_share_preview`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `postedjobs`
--
ALTER TABLE `postedjobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `project_lengths`
--
ALTER TABLE `project_lengths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `project_settings`
--
ALTER TABLE `project_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `security_questions`
--
ALTER TABLE `security_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `settings_jobs`
--
ALTER TABLE `settings_jobs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `skill_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_assigned_members`
--
ALTER TABLE `task_assigned_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `task_attachments`
--
ALTER TABLE `task_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `travel_master`
--
ALTER TABLE `travel_master`
  MODIFY `travel_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `turn_around_times`
--
ALTER TABLE `turn_around_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `update_masters`
--
ALTER TABLE `update_masters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=17;
--
-- AUTO_INCREMENT for table `users_profile_views`
--
ALTER TABLE `users_profile_views`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=129;
--
-- AUTO_INCREMENT for table `user_chats`
--
ALTER TABLE `user_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key of this table',AUTO_INCREMENT=32;
--
-- AUTO_INCREMENT for table `user_chat_files`
--
ALTER TABLE `user_chat_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `user_general_settings`
--
ALTER TABLE `user_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_job_tasks`
--
ALTER TABLE `user_job_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `user_logins`
--
ALTER TABLE `user_logins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=268;
--
-- AUTO_INCREMENT for table `user_nda_settings`
--
ALTER TABLE `user_nda_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_notifications`
--
ALTER TABLE `user_notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=50;
--
-- AUTO_INCREMENT for table `user_portfolios`
--
ALTER TABLE `user_portfolios`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key for this table',AUTO_INCREMENT=19;
--
-- AUTO_INCREMENT for table `user_skill_map`
--
ALTER TABLE `user_skill_map`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=146;
--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=131;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
ADD CONSTRAINT `cities_state_id_foreign` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`);

--
-- Constraints for table `portfolios_like_share_preview`
--
ALTER TABLE `portfolios_like_share_preview`
ADD CONSTRAINT `portfolios_like_share_preview_ibfk_1` FOREIGN KEY (`portfolio_id`) REFERENCES `user_portfolios` (`portfolio_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `states`
--
ALTER TABLE `states`
ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `users_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
