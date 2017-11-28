-- phpMyAdmin SQL Dump
-- version 4.3.8
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 11, 2017 at 08:37 AM
-- Server version: 5.5.51-38.2
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `team_network`
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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `budgets`
--

INSERT INTO `budgets` (`id`, `budget_type`, `status`) VALUES
(1, 'Low', '1'),
(2, 'Medium', '1'),
(3, 'High', '1');

-- --------------------------------------------------------

--
-- Table structure for table `category_subcategory`
--

CREATE TABLE IF NOT EXISTS `category_subcategory` (
  `category_id` int(11) NOT NULL,
  `parent_category_id` int(11) NOT NULL DEFAULT '0',
  `category_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('0','1') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_subcategory`
--

INSERT INTO `category_subcategory` (`category_id`, `parent_category_id`, `category_name`, `status`) VALUES
(1, 0, 'Development', '1'),
(2, 0, 'Design', '1'),
(3, 1, 'Software', '1'),
(4, 1, 'Web', '1'),
(5, 1, 'UI Dev.', '1'),
(6, 2, 'Web', '1'),
(7, 2, 'UI Dev.', '1');

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
-- Table structure for table `invoices`
--

CREATE TABLE IF NOT EXISTS `invoices` (
  `id` int(11) NOT NULL,
  `invoice_for_user` int(11) NOT NULL,
  `invoice_by_user` int(11) NOT NULL,
  `invoice_date` datetime NOT NULL,
  `invoice_no` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT 'time()-job_id-proposal_id',
  `description` text COLLATE utf8_unicode_ci,
  `status` int(11) NOT NULL,
  `gross_amt` float(10,2) NOT NULL,
  `fee_amt` float(10,2) NOT NULL,
  `job_id` int(11) NOT NULL,
  `proposal_id` int(11) DEFAULT NULL,
  `milestone_id` int(11) DEFAULT '0'
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `invoice_for_user`, `invoice_by_user`, `invoice_date`, `invoice_no`, `description`, `status`, `gross_amt`, `fee_amt`, `job_id`, `proposal_id`, `milestone_id`) VALUES
(1, 7, 1, '2017-10-10 12:28:36', '1507638516-9-2', NULL, 1, 100.00, 0.00, 9, 2, 0),
(2, 7, 1, '2017-10-11 07:22:00', '1507706520-10-4', NULL, 1, 100.00, 0.00, 10, 4, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobassets`
--

INSERT INTO `jobassets` (`id`, `name`, `is_file`, `parent_id`, `mime_type`, `size`, `asset_file_path`, `job_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'application.pdf', 1, 0, 'application/pdf', '433994', '1506147668v4UKIO7p7j-DOC.pdf', 7, 0, '2017-09-23 06:21:08', '2017-09-23 06:21:08'),
(2, 'Root folder', 0, 0, '', '', '', 7, 0, '2017-09-23 06:22:22', '2017-09-23 06:22:22'),
(3, 'Test', 0, 0, '', '', '', 7, 0, '2017-09-23 19:50:59', '2017-09-23 19:50:59'),
(4, 'hero-collaboration-partial.png', 1, 3, 'image/png', '77730', '1506196287cIClvLHlhf-DOC.png', 7, 0, '2017-09-23 19:51:27', '2017-09-23 19:51:27'),
(5, 'test', 0, 0, '', '', '', 2, 0, '2017-09-24 05:53:35', '2017-09-24 05:53:35'),
(6, '16388108_107142469802403_7153629569236143291_n.jpg', 1, 0, 'image/jpeg', '54728', '1506232438me4maBnXJX-DOC.jpg', 2, 0, '2017-09-24 05:53:58', '2017-09-24 05:53:58');

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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `jobprovider_transactions`
--

INSERT INTO `jobprovider_transactions` (`id`, `user_id`, `transaction_no`, `job_id`, `proposal_id`, `amount`, `payment_type`, `payment_status`, `payment_gateway_response`, `start_date`, `expiry_date`, `created_at`, `updated_at`) VALUES
(1, 1, 'WO3664-1-1', 2, 1, 325, 'S', 'P', NULL, NULL, NULL, '2017-10-06 14:53:54', '2017-10-06 19:53:54'),
(2, 1, 'WO8186-2-1', 2, 1, 325, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Fri, 06 Oct 2017 15:10:11 GMT\r\n\r\n{"id":"ch_1B9xSoHk4874UBnITOcRmPe3","object":"charge","amount":32500,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1B9xSpHk4874UBnIwrdShl5s","captured":true,"created":1507302610,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1B9xSoHk4874UBnITOcRmPe3\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-06 15:10:11', '2017-10-06 20:10:11'),
(3, 1, 'WO3311-3-2', 9, 2, 500, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Tue, 10 Oct 2017 06:32:08 GMT\r\n\r\n{"id":"ch_1BBHHfHk4874UBnIq7rwJ7Uk","object":"charge","amount":50000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BBHHfHk4874UBnIJZgr93Hm","captured":true,"created":1507617127,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BBHHfHk4874UBnIq7rwJ7Uk\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-10 06:32:08', '2017-10-10 11:32:08'),
(4, 1, 'WO9142-4-4', 10, 4, 500, 'S', 'S', 'HTTP/1.0 200 OK\r\nCache-Control: no-cache, private\r\nContent-Type:  application/json\r\nDate:          Wed, 11 Oct 2017 07:20:32 GMT\r\n\r\n{"id":"ch_1BBeW3Hk4874UBnICg6k0dCf","object":"charge","amount":50000,"amount_refunded":0,"application":null,"application_fee":null,"balance_transaction":"txn_1BBeW3Hk4874UBnI6CEOlUIM","captured":true,"created":1507706431,"currency":"usd","customer":"cus_BVrUljnCkvofoR","description":null,"destination":null,"dispute":null,"failure_code":null,"failure_message":null,"fraud_details":[],"invoice":null,"livemode":false,"metadata":[],"on_behalf_of":null,"order":null,"outcome":{"network_status":"approved_by_network","reason":null,"risk_level":"normal","seller_message":"Payment complete.","type":"authorized"},"paid":true,"receipt_email":"pabitra@technoexponent.com","receipt_number":null,"refunded":false,"refunds":{"object":"list","data":[],"has_more":false,"total_count":0,"url":"\\/v1\\/charges\\/ch_1BBeW3Hk4874UBnICg6k0dCf\\/refunds"},"review":null,"shipping":null,"source":{"id":"card_1B8plWHk4874UBnIprZPzvZg","object":"card","address_city":null,"address_country":null,"address_line1":null,"address_line1_check":null,"address_line2":null,"address_state":null,"address_zip":"70009","address_zip_check":"pass","brand":"Visa","country":"US","customer":"cus_BVrUljnCkvofoR","cvc_check":null,"dynamic_last4":null,"exp_month":1,"exp_year":2021,"fingerprint":"6dOPzkZwi4C7MRmk","funding":"debit","last4":"5556","metadata":[],"name":"Pabitra M","tokenization_method":null},"source_transfer":null,"statement_descriptor":null,"status":"succeeded","transfer_group":null}', NULL, NULL, '2017-10-11 07:20:32', '2017-10-11 12:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `job_assesments`
--

CREATE TABLE IF NOT EXISTS `job_assesments` (
  `assesment_id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `assesments` text NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

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
(23, 8, 'No questions!');

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
  `is_shortlisted` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT '''Y'' if the proposal is shortlisted only',
  `is_accepted` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT '''Y'' if the proposal is shortlisted & accepted',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_proposals`
--

INSERT INTO `job_proposals` (`proposal_id`, `sent_by_user`, `job_id`, `proposal_referance_no`, `description`, `interview_question_challanges`, `attached_file`, `is_shortlisted`, `is_accepted`, `created_at`, `updated_at`) VALUES
(1, 7, 2, 'JP1507300445912', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using ''Content here, content here'', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for ''lorem ipsum'' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', '1507300445LkvjSKurk4-DOC.jpg', 'Y', 'Y', '2017-10-06 14:34:05', '2017-10-06 15:10:11'),
(2, 7, 9, 'JP1507616923604', 'I am intested to work', 'I am intested to work', '1507616923uy6lXyqGEO-DOC.docx', 'Y', 'Y', '2017-10-10 06:28:43', '2017-10-10 06:32:08'),
(3, 1, 8, 'JP1507639234933', 'I am very interested', 'I am very interested', '1507639234vX1ueIsJvJ-DOC.docx', 'N', 'N', '2017-10-10 12:40:34', '2017-10-10 12:40:34'),
(4, 7, 10, 'JP1507706093421', 'asd asdasda sd', 'asd  asdasdasdas', '15077060939GYAEm9LHv-DOC.docx', 'Y', 'Y', '2017-10-11 07:14:53', '2017-10-11 07:20:32');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_proposal_amounts`
--

INSERT INTO `job_proposal_amounts` (`id`, `job_id`, `proposal_id`, `sent_by_user`, `item_description`, `amount`, `is_paid`, `updated_at`, `created_at`) VALUES
(1, 2, 1, 7, 'Mile Stone 1', '100', 0, '2017-10-06 14:34:05', '2017-10-06 14:34:05'),
(2, 2, 1, 7, 'Mile Stone 2', '225', 0, '2017-10-06 14:34:05', '2017-10-06 14:34:05'),
(3, 9, 2, 7, 'ms1', '100', 1, '2017-10-10 12:28:36', '2017-10-10 06:28:43'),
(4, 9, 2, 7, 'ms 2', '150', 0, '2017-10-10 06:28:43', '2017-10-10 06:28:43'),
(5, 9, 2, 7, 'ms 3', '150', 0, '2017-10-10 11:19:20', '2017-10-10 06:28:43'),
(6, 9, 2, 7, 'ms 4', '100', 0, '2017-10-10 06:28:43', '2017-10-10 06:28:43'),
(7, 8, 3, 1, 'Mile 1', '150', 0, '2017-10-10 12:40:34', '2017-10-10 12:40:34'),
(8, 8, 3, 1, 'mile 2', '175', 0, '2017-10-10 12:40:34', '2017-10-10 12:40:34'),
(9, 8, 3, 1, 'mile 3', '175', 0, '2017-10-10 12:40:34', '2017-10-10 12:40:34'),
(10, 10, 4, 7, 'milestone 1', '100', 1, '2017-10-11 07:22:00', '2017-10-11 07:14:53'),
(11, 10, 4, 7, 'milestone 2', '150', 0, '2017-10-11 07:14:53', '2017-10-11 07:14:53'),
(12, 10, 4, 7, 'milestone 3', '150', 0, '2017-10-11 07:14:53', '2017-10-11 07:14:53'),
(13, 10, 4, 7, 'milestone 4', '100', 0, '2017-10-11 07:14:53', '2017-10-11 07:14:53');

-- --------------------------------------------------------

--
-- Table structure for table `job_skill_maps`
--

CREATE TABLE IF NOT EXISTS `job_skill_maps` (
  `job_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `job_skill_maps`
--

INSERT INTO `job_skill_maps` (`job_id`, `skill_id`) VALUES
(1, 7),
(1, 1),
(3, 1),
(3, 8),
(2, 6),
(2, 7),
(2, 1),
(4, 7),
(4, 9),
(4, 5),
(4, 10),
(4, 2),
(4, 3),
(5, 8),
(6, 1),
(6, 9),
(7, 9),
(8, 2),
(9, 1),
(9, 3),
(10, 6),
(10, 5),
(10, 2),
(10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `job_type`
--

CREATE TABLE IF NOT EXISTS `job_type` (
  `job_type_id` int(11) NOT NULL,
  `job_title` varchar(255) NOT NULL,
  `job_type_desc` text,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT 'Visibility status. 0=>Inactive, 1=> Active'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `job_type`
--

INSERT INTO `job_type` (`job_type_id`, `job_title`, `job_type_desc`, `status`) VALUES
(1, 'All type (Hourly & Fixed Prices)', NULL, '1');

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
('nejad.saman@gmail.com', '$2y$10$yVGwOATPYkNpBlN0y8AFDuxt0cUSEvO0GLjE0J/5qZJM.2NIdQAeO', '2017-09-26 19:36:06'),
('heropersian@gmail.com', '$2y$10$aTbOOwZQijV347x6VPxIn.UzTqghmRpWDZDtJgNpxIrLhN5Xko232', '2017-09-26 19:38:21'),
('nanu_rtc@yahoo.com', '$2y$10$8fyfICp3GQLRaZsYhsYUQe2RqzwkDSIrL6ReNpkpiYvPiwHmMG/DG', '2017-10-04 20:32:11'),
('pabitra@technoexponent.com', '$2y$10$kNjUGWst1uGCNuogkARpTOZMErJNo..hkxlj8KhaKml6KybTQ/F3K', '2017-10-09 12:12:15');

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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `portfolios_like_share_preview`
--

INSERT INTO `portfolios_like_share_preview` (`action_id`, `portfolio_id`, `user_id`, `action_status`, `date_time`) VALUES
(1, 2, 1, '1', '2017-08-01 10:34:56'),
(2, 2, 1, '2', '2017-08-01 10:35:11'),
(3, 1, 1, '2', '2017-08-01 10:35:18'),
(4, 3, 2, '2', '2017-08-03 12:46:43'),
(5, 4, 4, '1', '2017-08-05 12:38:02'),
(6, 4, 4, '2', '2017-08-05 12:38:55'),
(7, 5, 4, '1', '2017-08-05 20:46:24'),
(8, 5, 4, '2', '2017-08-05 20:47:10'),
(9, 8, 4, '2', '2017-09-02 12:03:50'),
(10, 8, 1, '2', '2017-09-20 10:49:58'),
(11, 6, 4, '2', '2017-09-20 13:09:27'),
(12, 2, 4, '2', '2017-09-20 13:09:43'),
(13, 1, 4, '2', '2017-10-05 19:26:47');

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
  `budget_type` int(11) NOT NULL,
  `needs_to_design_job` varchar(255) NOT NULL,
  `category` int(11) NOT NULL,
  `subcategory` int(11) NOT NULL,
  `job_description` text NOT NULL,
  `attached_file` varchar(200) NOT NULL,
  `have_assesment` enum('0','1') NOT NULL DEFAULT '0' COMMENT '1=>Have Assesments, 0=>Does not have Assesments',
  `job_reference_id` varchar(30) NOT NULL,
  `total_proposal` int(5) DEFAULT '0',
  `created_at` datetime NOT NULL,
  `created_ip` varchar(255) NOT NULL,
  `job_status` enum('1','2','3','4') NOT NULL DEFAULT '1' COMMENT '1=>All Jobs, 2=>In Progress, 3=>Pending, 4=>Completed',
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `postedjobs`
--

INSERT INTO `postedjobs` (`job_id`, `posted_by_user`, `experience_level`, `project_length`, `location`, `turn_around_time`, `budget_type`, `needs_to_design_job`, `category`, `subcategory`, `job_description`, `attached_file`, `have_assesment`, `job_reference_id`, `total_proposal`, `created_at`, `created_ip`, `job_status`, `updated_at`) VALUES
(1, 2, 1, 1, 'kolkata', 1, 2, 'sabya', 2, 3, 'sdfsd', '1501860004UySDYGUT4H-DOC.jpg', '0', '150376125814898', 1, '2017-08-04 15:20:04', '', '1', '2017-08-26 16:45:25'),
(2, 1, 1, 1, 'Kolkata, WB, India', 1, 2, 'Need an web portal', 1, 5, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', '1501861098zGW2M3bEFz-DOC.jpg', '1', '158936778514898', 3, '2017-08-24 12:05:00', '', '2', '2017-10-06 15:10:11'),
(3, 4, 2, 3, 'London', 2, 3, 'New logo', 2, 5, 'I need a new logo', '15019371122QSJ8BWcJ7-DOC.png', '0', '150376748514898', 1, '2017-08-14 21:00:32', '', '1', '2017-09-02 17:47:22'),
(4, 9, 2, 3, 'New York', 2, 3, 'New website', 1, 3, 'New website for selling clothes online', '1503767785qpy5AnG3X6-DOC.png', '1', '150376778514898', 1, '2017-08-26 17:16:25', '', '1', '2017-08-26 17:17:56'),
(5, 9, 3, 1, 'Dubai', 2, 2, 'new logo', 2, 5, 'new logo', '1503768135uOSBKYOOEG-DOC.png', '1', '150376813591435', 1, '2017-08-26 17:22:15', '', '1', '2017-08-26 17:25:46'),
(6, 4, 1, 2, 'London', 1, 1, 'Video animator', 2, 6, 'Hello world', '1504370134Ve51Cy0Xw1-DOC.jpg', '1', '150437013464233', 1, '2017-09-02 16:35:34', '', '1', '2017-09-02 16:36:34'),
(7, 4, 3, 3, 'Oxford', 2, 2, 'Videooo', 2, 4, 'heyyy aldkjf ladjl ajdlfa jsdlf ajdlf asdlfjkasd l;fjkas;d', '15043745308s6D7fXqXg-DOC.jpg', '1', '150437453040155', 3, '2017-09-02 17:48:50', '', '1', '2017-10-04 08:09:13'),
(8, 10, 1, 1, 'Oxford', 1, 1, 'Anything', 2, 5, 'Need a developer who can deliver the job on time!', '1507104673JzZgPqw4ao-DOC.png', '1', '150710467315476', 1, '2017-10-04 08:11:13', '', '1', '2017-10-10 12:40:34'),
(9, 1, 1, 1, 'kolkata', 1, 2, 'Job to work', 1, 4, 'Job to work', '1507616750viCIzred8u-DOC.docx', '1', '150761675075359', 1, '2017-10-10 06:25:50', '', '2', '2017-10-10 11:19:20'),
(10, 1, 2, 2, 'kolkata', 2, 2, 'check job test', 1, 3, 'asdas asd asd asd', '1507705986PWstfZMVMb-DOC.docx', '1', '150770598684401', 1, '2017-10-11 07:13:06', '', '2', '2017-10-11 07:20:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) unsigned NOT NULL,
  `seller_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'seller_id of the seller, 0 for Admin',
  `category_id` int(10) unsigned DEFAULT NULL,
  `sub_category_id` int(10) unsigned DEFAULT NULL,
  `tag_id` int(10) unsigned DEFAULT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `size` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `condition` tinyint(4) NOT NULL DEFAULT '1' COMMENT '1 = New, 2 = Used',
  `department` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `standard_price` double(10,2) NOT NULL,
  `discounted_price` double(10,2) NOT NULL,
  `discounted_percentage` double(10,2) NOT NULL,
  `quantity` int(11) NOT NULL,
  `shipping_template_id` int(10) unsigned DEFAULT NULL,
  `key_feature` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `project_lengths`
--

CREATE TABLE IF NOT EXISTS `project_lengths` (
  `id` int(11) NOT NULL,
  `length_type` varchar(200) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `project_lengths`
--

INSERT INTO `project_lengths` (`id`, `length_type`, `status`) VALUES
(1, 'Weekly', '1'),
(2, 'Monthly', '1'),
(3, '1 - 6 month', '1'),
(4, 'More than 6 month', '1');

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
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `project_settings`
--

INSERT INTO `project_settings` (`id`, `job_id`, `working_days_from`, `working_days_to`, `working_hours`) VALUES
(1, 8, 3, 2, '20'),
(2, 7, 2, 3, NULL),
(3, 2, 2, 6, NULL),
(4, 10, 1, 2, '10');

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
-- Table structure for table `sellers`
--

CREATE TABLE IF NOT EXISTS `sellers` (
  `id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `admin_name`, `admin_email`, `site_title`, `contact_email`, `contact_name`, `contact_phone`, `site_logo`, `site_fb_link`, `site_twitter_link`, `site_gplus_link`, `site_linkedin_link`, `site_pinterest_link`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@admin.com', 'wholesale', 'info@admin.com', 'Contact wholesale', '1234567890', '14988183520h4QbVdYWB.png', 'https://www.facebook.com/example', 'https://www.twitter.com/example', 'https://plus.google.com/u/0/+example', 'https://www.linkedin.com/example', 'https://www.pinterest.com/example', NULL, '2017-06-30 19:01:56');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `task_attachments`
--

CREATE TABLE IF NOT EXISTS `task_attachments` (
  `id` int(11) NOT NULL,
  `job_id` int(11) NOT NULL,
  `task_id` int(11) NOT NULL,
  `file_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `status` enum('0','1') NOT NULL DEFAULT '1' COMMENT '1=>Active, 0=>Inactive'
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `turn_around_times`
--

INSERT INTO `turn_around_times` (`id`, `around_time_type`, `status`) VALUES
(1, 'Urgent', '1'),
(2, 'Normal', '1'),
(3, 'No planning', '1');

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
  `available_to` int(2) DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `username`, `first_name`, `last_name`, `phone_number_code`, `phone_number`, `password`, `remember_token`, `type`, `login_type`, `is_active`, `profile_picture`, `profile_availability`, `language_id`, `country_id`, `provider`, `provider_id`, `created_at`, `updated_at`, `profile_link`, `stripe_customer_id`, `available_from`, `available_to`) VALUES
(1, 'pabitra@technoexponent.com', 'PKM', 'Pabitra', 'M', NULL, NULL, '$2y$10$6cHokasbv0hp1VVKHrfX2OsCEO4l1x1VY/N7F2A0qVgtrtLGrAiaS', 'dDZaElxa1bo1x5RrwzQ3oY3inMDUXb6Sx37CB48F0S0LQ5JI7DQEcVgUpypi', 2, 1, 'Y', '', '1', NULL, NULL, NULL, NULL, '2017-07-25 14:49:33', '2017-10-09 19:51:33', NULL, 'cus_BVrUljnCkvofoR', 5, 5),
(2, 'technoexponent02@gmail.com', 'technoexponent02', 'S', 'Saha', NULL, NULL, '$2y$10$MvuZ4nwBOvPmLdbsFW17Y.A3R2k0rfdHqC2x0bDk9LDof.GmnjSWK', 'RWItm660qhZvHSl3Oprfc78MMIXPT4ixRgNPLREMUK6mv2dLTBZgw8K8hx7T', 1, 1, 'Y', '2-fl-18-07-2017-16-42-32.jpg', '', NULL, NULL, NULL, NULL, '2017-07-25 17:08:25', '2017-07-25 17:08:25', NULL, NULL, 0, 0),
(3, 'hello@matchpol.net', 'SJ', 'Sunny', 'Jim', NULL, NULL, '$2y$10$/tLQYWOUOSXq7nbPYR6cUOW4xoDnFLPENgnADzNgtU3z4d5.gRukW', 'SHxKjwE2QWprpoMtkqhVu0qqgj2c8v2DGwwySBzDzwvrhXOX0UWIVUaLlsHV', 2, 1, 'Y', NULL, '', NULL, NULL, NULL, NULL, '2017-07-25 19:57:39', '2017-07-25 19:57:39', NULL, NULL, 0, 0),
(4, 'nanu_rtc@yahoo.com', 'ion', 'Ion', 'Paaa', NULL, NULL, '$2y$10$UFV7F7CiUeL6kSSrPuz1FOBhE.wTDSKqQS0QCl8D4CYyOQi.oxIby', 'UrQFl4sT5gNadojiWmR8jtaV3OIoRTNT88CFBwIfQnPlAhjiPHldlX8z1RPN', 1, 1, 'Y', NULL, '1', NULL, NULL, NULL, NULL, '2017-08-05 17:33:07', '2017-08-05 17:33:07', NULL, NULL, 0, 0),
(5, 'dan.vorosky@gmail.com', 'dan', 'D', 'Vorosky', NULL, NULL, '$2y$10$AYqRoTLx5UmkHc7pRYtfj.ZTYjC0bbQVj2lpngQVJBQgSQeFNPCN6', 'vjja3hOzypFeIsUkFNCVjZgojx9shWNqD3u4fZRndWoZPdI6J9eiiIme2v3F', 1, 1, 'Y', NULL, '1', NULL, NULL, NULL, NULL, '2017-08-14 23:54:11', '2017-08-14 23:54:11', NULL, NULL, 0, 0),
(6, 'timrichardson@uymail.com', 'tim', 'Tim', 'Richardson', NULL, NULL, '$2y$10$uN5L3KYdTfQQr5eOaSbiluCQzSfotonr4No1YIivEX6e0zZ578d1S', '5p6PpE3I7iz5eyhmsyfia6zmF2VyOS7smUwAU8Nr4VmOdmyZU2Ea3WWV3dJd', 1, 1, 'Y', NULL, '1', NULL, NULL, NULL, NULL, '2017-08-15 00:12:44', '2017-08-15 00:12:44', NULL, NULL, 0, 0),
(7, 'navinr@europe.com', 'nav', 'Navin', 'Raj', NULL, NULL, '$2y$10$q9Ofssua9eVqExp9b9dk6ej0OQ4bjHheTBw5ZlDpgPTp/bQ6dwR.m', 'DyUOe7fyv6ofv3qiSCnrS3OKS4hAZlFMPIUyEGxTXS6tRFOd0Nsrjbvy3X8J', 1, 1, 'Y', NULL, '0', NULL, NULL, NULL, NULL, '2017-08-15 00:57:12', '2017-08-15 00:57:12', NULL, NULL, 0, 0),
(8, 'nejad.saman@gmail.com', 'saman', 'Sam', 'Nejad', NULL, NULL, '$2y$10$Taw4K1Cr6jyaLDLZTAc4NOuwESoPsjsbvam4To8xnePo7AcElTzvC', NULL, 2, 1, 'N', NULL, '0', NULL, NULL, NULL, NULL, '2017-08-15 17:05:00', '2017-08-15 17:05:00', NULL, NULL, 0, 0),
(9, 'nanuofficial@googlemail.com', 'ion12', 'Ion', 'Pantalon', NULL, NULL, '$2y$10$EEzgb77mrc8D67SjmB2OD.ZL4byFdLsAA7lFyEXj9EG.ZzjXSl166', 'Bgbi8wz9CKDOde2g9Ra8wBxybiyazNOnKsza7fov5IyboEOkCPa0dnkvUq3t', 2, 1, 'Y', NULL, '0', NULL, NULL, NULL, NULL, '2017-08-26 21:59:50', '2017-08-26 21:59:50', NULL, NULL, 0, 0),
(10, 'heropersian@gmail.com', 'saman123', 'sam', 'nej', NULL, NULL, '$2y$10$7Ejd8Yo/B8Uxn.OSRajfAO3aclbjN6w1LzhHLjs5z5yHCy2HQpD0S', '9JSk3q3T9plh4vvAxwVeNJ3nYPMLQ2uxv7W0AOTgd679nUaqtUFe5FLfTPdo', 1, 1, 'Y', NULL, '', NULL, NULL, NULL, NULL, '2017-09-25 22:29:18', '2017-10-09 21:43:03', NULL, NULL, 1, 3),
(11, 'avoy.php@gmail.com', 'avoydebnath', 'Avoy', 'Debnath', NULL, NULL, '$2y$10$sC7WQRiejjn69jqzpdf2zOsq8V3kEUNIm2PsN2rIFABT4wpaNn8PS', NULL, 1, 1, 'Y', NULL, '0', NULL, NULL, NULL, NULL, '2017-10-05 14:49:54', '2017-10-05 14:49:54', NULL, NULL, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users_security_questions`
--

CREATE TABLE IF NOT EXISTS `users_security_questions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `answer` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_security_questions`
--

INSERT INTO `users_security_questions` (`id`, `user_id`, `question_id`, `answer`) VALUES
(1, 1, 2, 'Pabitra'),
(2, 4, 2, 'test');

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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_chats`
--

INSERT INTO `user_chats` (`id`, `user_id`, `to_user_id`, `job_id`, `message_subject`, `message_content`, `message_read_status`, `is_starred_for_sender`, `is_starred_for_receiver`, `message_dttime`, `deleted_by_sender`, `deleted_by_receiver`) VALUES
(1, 1, 7, 2, 'Hi, I got your proposal...\r\nThe standard...', 'Hi, I got your proposal...\r\nThe standard chunk of Lorem Ipsum used since the 1500s is reproduced below for those interested. Sections 1.10.32 and 1.10.33 from "de Finibus Bonorum et Malorum" by Cicero are also reproduced in their exact original form, accompanied by English versions from the 1914 translation by H. Rackham.', 'Y', 0, 0, '2017-10-06 14:39:54', 0, 0),
(2, 1, 7, 10, 'Hi How are you', 'Hi How are you', 'Y', 0, 0, '2017-10-11 07:15:18', 1, 0),
(3, 7, 1, 10, 'I am fine how are you?', 'I am fine how are you?', 'Y', 0, 1, '2017-10-11 07:17:10', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_chat_files`
--

CREATE TABLE IF NOT EXISTS `user_chat_files` (
  `id` int(11) NOT NULL,
  `message_id` int(11) NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `behance_profile` text
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`details_id`, `user_id`, `availability_status`, `rate_per_hour`, `location`, `travel_distance`, `job_type`, `website`, `sample_video`, `focus`, `field_of_work`, `about`, `linkedin_profile`, `vimeo_profile`, `twitter_profile`, `behance_profile`) VALUES
(1, 2, 'Available', '34', 'India', '1', 1, NULL, '1501008840-download.jpeg', 1, 1, 'Hellos just testing.', NULL, NULL, NULL, NULL),
(2, 3, 'Available', NULL, NULL, NULL, 0, NULL, NULL, 1, 1, 'Expert in stuff.', NULL, NULL, NULL, NULL),
(3, 1, 'Available', '100', 'India', '1', 1, 'https://www.technoexponent.com/', NULL, 1, 1, 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'https://in.linkedin.com/', 'https://vimeo.com/', 'https://twitter.com/login', 'https://www.behance.net/'),
(4, 4, 'Available', '10', 'London, United Kingdom', '3', 1, 'www.test.com', NULL, 1, 1, 'Graphic Designdslksklcm.,mxz,.c.,mxznc.,ds;`dk;sz./cxz.,mc.,xzcmxz,mc.xz', NULL, NULL, NULL, NULL),
(5, 5, 'Available', '40', 'Dubai', '1', 1, NULL, NULL, 1, 1, 'Design', 'linkedin.com/dan', NULL, NULL, NULL),
(6, 6, 'Available', '46', 'New York', '3', 1, NULL, NULL, 1, 1, 'Hybrid', NULL, NULL, NULL, NULL),
(7, 9, 'Busy', '100', NULL, NULL, 0, NULL, NULL, 0, 0, NULL, NULL, NULL, NULL, NULL),
(8, 10, 'Available', NULL, NULL, NULL, 0, NULL, NULL, 1, 1, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_portfolios`
--

INSERT INTO `user_portfolios` (`portfolio_id`, `user_id`, `portfolio_name`, `uploaded_date`, `description`, `short_desription`, `file_path`, `file_name`, `portfolio_link`, `number_of_views`, `likes`, `shares`, `status`) VALUES
(1, 1, 'My first portfolio 1', '2017-08-01 05:25:43', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.<br />\r\nIt has survived not only five centuries, but also the leap into electronic typesetting', 'Lorem Ipsum is simply dummy te', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15015115541Hydrangeas.jpg', NULL, 1, 0, 0, '1'),
(2, 1, 'My first portfolios 2', '2017-08-10 07:52:03', 'My first portfolio 2', 'My first portfolio 2', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150156522511-7-(1).jpg', 'http://www.technoexponent.com/', 1, 1, 0, '1'),
(3, 2, 'test update', '2017-08-01 08:13:51', 'testtsts', 'testtsts', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15015752192Professional-Man-Business-Suit-Dressed.jpg', NULL, 1, 0, 0, '1'),
(4, 4, 'Portfolio 1', '2017-08-05 12:37:56', 'My first project', 'My first project', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '1501936676416388108_107142469802403_7153629569236143291_n.jpg', 'www.project1.com', 1, 1, 0, '1'),
(5, 4, 'Project 2', '2017-08-05 12:38:48', 'This is the second project', 'This is the second project', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '150193672841377071783-fd1df0b69162f1327f41386e498c27f8.png', 'www.project2.com', 1, 1, 0, '1'),
(6, 1, 'System Portfolio', '2017-08-14 05:24:02', 'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry''s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.', 'Lorem Ipsum is simply dummy te', 'http://dev4.technoexponent.net/team_network/public/assets/upload/portfolios', '15026882421Penguins.jpg', NULL, 1, 0, 0, '1'),
(7, 5, 'Website', '2017-08-14 19:01:41', 'Website for social media', 'Website for social media', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15027372525234590_633876614566045295.jpg', NULL, 0, 0, 0, '1'),
(8, 6, 'hibryd app', '2017-08-14 19:15:36', 'hibrid app done using MEAN', 'hibrid app done using MEAN', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '15027381366the-inspirations-behind-20-of-the-most-well-known-logos-in-high-fashion-05.jpg', NULL, 1, 0, 0, '1'),
(9, 9, 'Ion Pantalon', '2017-08-26 17:12:16', 'my first project', 'my first project', 'http://dev.teamupwork.co.uk/public/assets/upload/portfolios', '1503767536916388108_107142469802403_7153629569236143291_n.jpg', NULL, 0, 0, 0, '1');

-- --------------------------------------------------------

--
-- Table structure for table `user_skill_map`
--

CREATE TABLE IF NOT EXISTS `user_skill_map` (
  `map_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `skill_id` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_skill_map`
--

INSERT INTO `user_skill_map` (`map_id`, `user_id`, `skill_id`) VALUES
(10, 3, 6),
(64, 1, 6),
(65, 1, 7),
(66, 1, 1),
(67, 1, 9),
(68, 1, 5),
(69, 1, 2),
(70, 2, 6),
(71, 2, 7),
(72, 2, 9),
(73, 2, 5),
(74, 2, 10),
(75, 2, 2),
(79, 5, 8),
(81, 6, 9),
(82, 7, 7),
(93, 4, 7),
(94, 4, 1),
(95, 4, 9),
(96, 4, 5),
(97, 4, 10),
(98, 4, 8);

-- --------------------------------------------------------

--
-- Table structure for table `user_transactions`
--

CREATE TABLE IF NOT EXISTS `user_transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT '0' COMMENT 'payment made by user',
  `to_user_id` int(11) DEFAULT '0' COMMENT 'payment made for user',
  `job_id` int(11) NOT NULL DEFAULT '0' COMMENT 'paid for job',
  `proposal_id` int(11) NOT NULL DEFAULT '0' COMMENT 'paid for proposal',
  `milestone_id` int(11) DEFAULT '0',
  `transaction_id` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` float(11,2) NOT NULL,
  `paid_by` enum('P','S','I') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'P' COMMENT 'P= Paypal, S=Stripe, I=Invoice',
  `transaction_type` enum('D','C') COLLATE utf8_unicode_ci NOT NULL COMMENT 'D=Debit, C=Credit',
  `payment_for` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `payment_status` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Y',
  `is_cashout_admin` enum('Y','N','S') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N' COMMENT 'Y- Yes, N- No, S- Request scheduled but still pending',
  `is_released` enum('Y','N') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'N',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_transactions`
--

INSERT INTO `user_transactions` (`id`, `user_id`, `to_user_id`, `job_id`, `proposal_id`, `milestone_id`, `transaction_id`, `amount`, `paid_by`, `transaction_type`, `payment_for`, `payment_status`, `is_cashout_admin`, `is_released`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 2, 1, 0, 'WO8186-2-1', 325.00, 'S', 'C', 'Proposal amount', 'Y', 'Y', 'N', '2017-10-10 08:00:29', '2017-10-06 20:48:39'),
(2, 1, 0, 9, 2, 0, 'WO3311-3-2', 500.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', '2017-10-10 12:02:23', '2017-10-10 11:34:25'),
(3, 1, 0, 9, 2, 3, '1507638516-9-2', 100.00, 'I', 'D', 'Project completion amount', 'Y', 'N', 'Y', '2017-10-10 17:28:36', '2017-10-10 17:28:36'),
(4, 7, 0, 9, 2, 3, '1507638516-9-2', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', '2017-10-10 17:28:36', '2017-10-10 17:28:36'),
(5, 1, 0, 10, 4, 0, 'WO9142-4-4', 500.00, 'S', 'C', 'Proposal amount', 'Y', 'N', 'N', '2017-10-11 12:20:32', '2017-10-11 12:20:32'),
(6, 1, 0, 10, 4, 10, '1507706520-10-4', 100.00, 'I', 'D', 'Project completion amount', 'Y', 'N', 'Y', '2017-10-11 12:22:00', '2017-10-11 12:22:00'),
(7, 7, 0, 10, 4, 10, '1507706520-10-4', 100.00, 'I', 'C', 'Project completion amount', 'Y', 'N', 'Y', '2017-10-11 12:22:00', '2017-10-11 12:22:00');

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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`), ADD KEY `products_seller_id_foreign` (`seller_id`), ADD KEY `products_category_id_foreign` (`category_id`), ADD KEY `products_sub_category_id_foreign` (`sub_category_id`), ADD KEY `products_shipping_template_id_foreign` (`shipping_template_id`), ADD KEY `products_tag_id_foreign` (`tag_id`);

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
-- Indexes for table `sellers`
--
ALTER TABLE `sellers`
  ADD PRIMARY KEY (`id`), ADD KEY `sellers_user_id_foreign` (`user_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
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
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `users_email_unique` (`email`), ADD UNIQUE KEY `users_phone_number_unique` (`phone_number`), ADD KEY `users_country_id_foreign` (`country_id`);

--
-- Indexes for table `users_security_questions`
--
ALTER TABLE `users_security_questions`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `category_subcategory`
--
ALTER TABLE `category_subcategory`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `jobassets`
--
ALTER TABLE `jobassets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `jobprovider_transactions`
--
ALTER TABLE `jobprovider_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `job_assesments`
--
ALTER TABLE `job_assesments`
  MODIFY `assesment_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `job_proposals`
--
ALTER TABLE `job_proposals`
  MODIFY `proposal_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `job_proposal_amounts`
--
ALTER TABLE `job_proposal_amounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `job_type`
--
ALTER TABLE `job_type`
  MODIFY `job_type_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
-- AUTO_INCREMENT for table `portfolios_like_share_preview`
--
ALTER TABLE `portfolios_like_share_preview`
  MODIFY `action_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `postedjobs`
--
ALTER TABLE `postedjobs`
  MODIFY `job_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_lengths`
--
ALTER TABLE `project_lengths`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `project_settings`
--
ALTER TABLE `project_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `security_questions`
--
ALTER TABLE `security_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `sellers`
--
ALTER TABLE `sellers`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `task_attachments`
--
ALTER TABLE `task_attachments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
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
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) unsigned NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT for table `users_security_questions`
--
ALTER TABLE `users_security_questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `user_chats`
--
ALTER TABLE `user_chats`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key of this table',AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `user_chat_files`
--
ALTER TABLE `user_chat_files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `details_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `user_general_settings`
--
ALTER TABLE `user_general_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_job_tasks`
--
ALTER TABLE `user_job_tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_portfolios`
--
ALTER TABLE `user_portfolios`
  MODIFY `portfolio_id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key for this table',AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT for table `user_skill_map`
--
ALTER TABLE `user_skill_map`
  MODIFY `map_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=99;
--
-- AUTO_INCREMENT for table `user_transactions`
--
ALTER TABLE `user_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=8;
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
-- Constraints for table `sellers`
--
ALTER TABLE `sellers`
ADD CONSTRAINT `sellers_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

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
