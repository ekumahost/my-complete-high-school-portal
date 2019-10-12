-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 12, 2019 at 06:53 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `school_portal`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance_codes`
--

CREATE TABLE `attendance_codes` (
  `attendance_codes_id` int(8) UNSIGNED NOT NULL,
  `attendance_codes_desc` varchar(50) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `attendance_codes`
--

INSERT INTO `attendance_codes` (`attendance_codes_id`, `attendance_codes_desc`) VALUES
(1, 'No Note from Parent'),
(2, 'Fees Unpaid - Driven'),
(3, 'Driven Home - Cultism/Drug'),
(4, 'Improperly Dressed'),
(5, 'Unavoidably Absent'),
(6, 'Sent home for Misconduct'),
(7, 'Surjery'),
(8, 'Travel - Field Trip Excused '),
(9, 'Driven for Lateness'),
(10, 'Parents Traveled'),
(11, 'Note From Parent demanding child'),
(12, 'Physical Deformity'),
(13, 'Funeral'),
(14, 'Sickness'),
(15, 'Starting Home Schooling'),
(16, 'ISS Other '),
(17, 'Ran away from School');

-- --------------------------------------------------------

--
-- Table structure for table `attendance_history`
--

CREATE TABLE `attendance_history` (
  `attendance_history_id` int(10) UNSIGNED NOT NULL,
  `attendance_history_student` int(8) UNSIGNED DEFAULT NULL,
  `attendance_history_school` int(8) UNSIGNED DEFAULT NULL,
  `attendance_history_term` int(3) NOT NULL,
  `attendance_history_grade` int(3) NOT NULL,
  `attendance_history_year` int(8) UNSIGNED DEFAULT NULL,
  `attendance_history_date` varchar(30) DEFAULT NULL,
  `attendance_history_code` int(8) UNSIGNED DEFAULT NULL,
  `attendance_history_notes` tinytext DEFAULT NULL,
  `attendance_history_user` int(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `bank`
--

CREATE TABLE `bank` (
  `id` int(8) NOT NULL,
  `sort` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `location` char(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bank`
--

INSERT INTO `bank` (`id`, `sort`, `name`, `status`, `location`) VALUES
(1, '', 'First Bank PLC', 1, 'NG'),
(4, '', 'Guaranty Trust Bank', 1, 'NG'),
(5, '', 'Union Bank of Nigeria', 1, 'NG'),
(6, '', 'Afri Bank', 1, 'NG'),
(7, '', 'Sterling Bank', 1, 'NG'),
(8, '', 'EcoBank Nigeria PLC', 1, 'NG'),
(9, '', 'United Bank for Africa', 1, 'NG'),
(10, '', 'WEMA Bank', 1, 'NG'),
(11, '', 'Access Bank', 1, 'NG'),
(12, '', 'Unity Bank', 1, 'NG'),
(13, '', 'First City Monument Bank', 1, 'NG'),
(14, '', 'Heritage Bank', 1, 'NG'),
(15, '', 'Keystone Bank', 1, 'NG'),
(16, '', 'Zenith Bank', 1, 'NG'),
(17, '', 'Fidelity Bank', 1, 'NG'),
(18, '', 'Diamond Bank', 1, 'NG'),
(19, '', 'Skye Bank', 1, 'NG'),
(20, '', 'Stanbic IBTC Bank', 1, 'NG'),
(21, '', 'Citi Bank', 1, 'NG'),
(22, '', 'Standard Chartered Bank PLC', 1, 'NG');

-- --------------------------------------------------------

--
-- Table structure for table `bulk_sms_store`
--

CREATE TABLE `bulk_sms_store` (
  `id` int(9) NOT NULL,
  `category` varchar(20) NOT NULL,
  `others` varchar(50) NOT NULL,
  `message_body` text NOT NULL,
  `date_sent` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `classnote`
--

CREATE TABLE `classnote` (
  `classnote_id` bigint(20) NOT NULL,
  `teacher_id` int(8) DEFAULT NULL,
  `session` int(3) NOT NULL,
  `term` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `subject` int(3) NOT NULL,
  `grade` int(3) NOT NULL,
  `date_uploaded` varchar(30) NOT NULL,
  `classnote_file` text NOT NULL,
  `added_info` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `cognitive_domain`
--

CREATE TABLE `cognitive_domain` (
  `id` int(3) NOT NULL,
  `value` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cognitive_domain`
--

INSERT INTO `cognitive_domain` (`id`, `value`) VALUES
(1, 'Neatness'),
(2, 'Puntuality'),
(3, 'Attitude to Property'),
(4, 'Sport');

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` char(2) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`) VALUES
('AD', 'Andorra'),
('AE', 'United Arab Emirates'),
('AF', 'Afghanistan'),
('AG', 'Antigua and Barbuda'),
('AI', 'Anguilla'),
('AL', 'Albania'),
('AM', 'Armenia'),
('AN', 'Netherlands Antilles'),
('AO', 'Angola'),
('AR', 'Argentina'),
('AS', 'American Samoa'),
('AT', 'Austria'),
('AU', 'Australia'),
('AW', 'Aruba'),
('AX', 'Aland Islands'),
('AZ', 'Azerbaijan'),
('BA', 'Bosnia and Herzegovina'),
('BB', 'Barbados'),
('BD', 'Bangladesh'),
('BE', 'Belgium'),
('BF', 'Burkina Faso'),
('BG', 'Bulgaria'),
('BH', 'Bahrain'),
('BI', 'Burundi'),
('BJ', 'Benin'),
('BM', 'Bermuda'),
('BN', 'Brunei Darussalam'),
('BO', 'Bolivia'),
('BR', 'Brazil'),
('BS', 'Bahamas'),
('BT', 'Bhutan'),
('BV', 'Bouvet Island'),
('BW', 'Botswana'),
('BY', 'Belarus'),
('BZ', 'Belize'),
('CA', 'Canada'),
('CC', 'Cocos (Keeling) Islands'),
('CD', 'Democratic Republic of the Congo'),
('CF', 'Central African Republic'),
('CG', 'Congo'),
('CH', 'Switzerland'),
('CI', 'Cote D\'Ivoire'),
('CK', 'Cook Islands'),
('CL', 'Chile'),
('CM', 'Cameroon'),
('CN', 'China'),
('CO', 'Colombia'),
('CR', 'Costa Rica'),
('CS', 'Serbia and Montenegro'),
('CU', 'Cuba'),
('CV', 'Cape Verde'),
('CX', 'Christmas Island'),
('CY', 'Cyprus'),
('CZ', 'Czech Republic'),
('DE', 'Germany'),
('DJ', 'Djibouti'),
('DK', 'Denmark'),
('DM', 'Dominica'),
('DO', 'Dominican Republic'),
('DZ', 'Algeria'),
('EC', 'Ecuador'),
('EE', 'Estonia'),
('EG', 'Egypt'),
('EH', 'Western Sahara'),
('ER', 'Eritrea'),
('ES', 'Spain'),
('ET', 'Ethiopia'),
('EU', 'European Union'),
('FI', 'Finland'),
('FJ', 'Fiji'),
('FK', 'Falkland Islands'),
('FM', 'Federated States of Micronesia'),
('FO', 'Faroe Islands'),
('FR', 'France'),
('GA', 'Gabon'),
('GB', 'Great Britain'),
('GD', 'Grenada'),
('GE', 'Georgia'),
('GF', 'French Guiana'),
('GH', 'Ghana'),
('GI', 'Gibraltar'),
('GL', 'Greenland'),
('GM', 'Gambia'),
('GN', 'Guinea'),
('GP', 'Guadeloupe'),
('GQ', 'Equatorial Guinea'),
('GR', 'Greece'),
('GS', 'S. Georgia and S. Sandwich Islands'),
('GT', 'Guatemala'),
('GU', 'Guam'),
('GW', 'Guinea-Bissau'),
('GY', 'Guyana'),
('HK', 'Hong Kong'),
('HM', 'Heard Island and McDonald Islands'),
('HN', 'Honduras'),
('HR', 'Croatia (Hrvatska)'),
('HT', 'Haiti'),
('HU', 'Hungary'),
('ID', 'Indonesia'),
('IE', 'Ireland'),
('IL', 'Israel'),
('IN', 'India'),
('IO', 'British Indian Ocean Territory'),
('IQ', 'Iraq'),
('IR', 'Iran'),
('IS', 'Iceland'),
('IT', 'Italy'),
('JM', 'Jamaica'),
('JO', 'Jordan'),
('JP', 'Japan'),
('KE', 'Kenya'),
('KG', 'Kyrgyzstan'),
('KH', 'Cambodia'),
('KI', 'Kiribati'),
('KM', 'Comoros'),
('KN', 'Saint Kitts and Nevis'),
('KP', 'Korea (North)'),
('KR', 'Korea (South)'),
('KW', 'Kuwait'),
('KY', 'Cayman Islands'),
('KZ', 'Kazakhstan'),
('LA', 'Laos'),
('LB', 'Lebanon'),
('LC', 'Saint Lucia'),
('LI', 'Liechtenstein'),
('LK', 'Sri Lanka'),
('LR', 'Liberia'),
('LS', 'Lesotho'),
('LT', 'Lithuania'),
('LU', 'Luxembourg'),
('LV', 'Latvia'),
('LY', 'Libya'),
('MA', 'Morocco'),
('MC', 'Monaco'),
('MD', 'Moldova'),
('MG', 'Madagascar'),
('MH', 'Marshall Islands'),
('MK', 'Macedonia'),
('ML', 'Mali'),
('MM', 'Myanmar'),
('MN', 'Mongolia'),
('MO', 'Macao'),
('MP', 'Northern Mariana Islands'),
('MQ', 'Martinique'),
('MR', 'Mauritania'),
('MS', 'Montserrat'),
('MT', 'Malta'),
('MU', 'Mauritius'),
('MV', 'Maldives'),
('MW', 'Malawi'),
('MX', 'Mexico'),
('MY', 'Malaysia'),
('MZ', 'Mozambique'),
('NA', 'Namibia'),
('NC', 'New Caledonia'),
('NE', 'Niger'),
('NF', 'Norfolk Island'),
('NG', 'Nigeria'),
('NI', 'Nicaragua'),
('NL', 'Netherlands'),
('NO', 'Norway'),
('NP', 'Nepal'),
('NR', 'Nauru'),
('NU', 'Niue'),
('NZ', 'New Zealand (Aotearoa)'),
('OM', 'Oman'),
('PA', 'Panama'),
('PE', 'Peru'),
('PF', 'French Polynesia'),
('PG', 'Papua New Guinea'),
('PH', 'Philippines'),
('PK', 'Pakistan'),
('PL', 'Poland'),
('PM', 'Saint Pierre and Miquelon'),
('PN', 'Pitcairn'),
('PR', 'Puerto Rico'),
('PS', 'Palestinian Territory'),
('PT', 'Portugal'),
('PW', 'Palau'),
('PY', 'Paraguay'),
('QA', 'Qatar'),
('RE', 'Reunion'),
('RO', 'Romania'),
('RU', 'Russian Federation'),
('RW', 'Rwanda'),
('SA', 'Saudi Arabia'),
('SB', 'Solomon Islands'),
('SC', 'Seychelles'),
('SD', 'Sudan'),
('SE', 'Sweden'),
('SG', 'Singapore'),
('SH', 'Saint Helena'),
('SI', 'Slovenia'),
('SJ', 'Svalbard and Jan Mayen'),
('SK', 'Slovakia'),
('SL', 'Sierra Leone'),
('SM', 'San Marino'),
('SN', 'Senegal'),
('SO', 'Somalia'),
('SR', 'Suriname'),
('ST', 'Sao Tome and Principe'),
('SU', 'USSR (former)'),
('SV', 'El Salvador'),
('SY', 'Syria'),
('SZ', 'Swaziland'),
('TC', 'Turks and Caicos Islands'),
('TD', 'Chad'),
('TF', 'French Southern Territories'),
('TG', 'Togo'),
('TH', 'Thailand'),
('TJ', 'Tajikistan'),
('TK', 'Tokelau'),
('TL', 'Timor-Leste'),
('TM', 'Turkmenistan'),
('TN', 'Tunisia'),
('TO', 'Tonga'),
('TP', 'East Timor'),
('TR', 'Turkey'),
('TT', 'Trinidad and Tobago'),
('TV', 'Tuvalu'),
('TW', 'Taiwan'),
('TZ', 'Tanzania'),
('UA', 'Ukraine'),
('UG', 'Uganda'),
('UK', 'United Kingdom'),
('UM', 'United States Minor Outlying Islands'),
('US', 'United States'),
('UY', 'Uruguay'),
('UZ', 'Uzbekistan'),
('VA', 'Vatican City State'),
('VC', 'Saint Vincent and the Grenadines'),
('VE', 'Venezuela'),
('VG', 'Virgin Islands (UK)'),
('VI', 'Virgin Islands (US)'),
('VN', 'Viet Nam'),
('VU', 'Vanuatu'),
('WF', 'Wallis and Futuna'),
('WS', 'Samoa'),
('YE', 'Yemen'),
('YT', 'Mayotte'),
('ZA', 'South Africa'),
('ZM', 'Zambia'),
('ZR', 'Zaire'),
('ZW', 'Zimbabwe');

-- --------------------------------------------------------

--
-- Table structure for table `discipline_history`
--

CREATE TABLE `discipline_history` (
  `discipline_history_id` int(10) UNSIGNED NOT NULL,
  `discipline_history_student` int(8) UNSIGNED DEFAULT NULL,
  `discipline_history_school` tinyint(1) UNSIGNED DEFAULT NULL,
  `discipline_history_term` tinyint(1) NOT NULL,
  `discipline_history_grade` int(2) NOT NULL,
  `discipline_history_year` int(3) UNSIGNED DEFAULT NULL,
  `discipline_history_code` int(3) UNSIGNED DEFAULT NULL,
  `discipline_history_date` varchar(30) DEFAULT NULL,
  `discipline_history_sdate` varchar(30) DEFAULT NULL,
  `discipline_history_edate` varchar(30) DEFAULT NULL,
  `discipline_history_action` varchar(50) DEFAULT NULL,
  `discipline_history_notes` tinytext DEFAULT NULL,
  `discipline_history_reporter` varchar(40) DEFAULT NULL,
  `discipline_history_user` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `ethnicity`
--

CREATE TABLE `ethnicity` (
  `ethnicity_id` int(3) NOT NULL,
  `ethnicity_desc` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ethnicity`
--

INSERT INTO `ethnicity` (`ethnicity_id`, `ethnicity_desc`) VALUES
(1, 'Abua'),
(2, 'Andoni'),
(3, 'Badenchi'),
(4, 'Efik'),
(5, 'Esako'),
(6, 'Esan(Ishan)'),
(7, 'Fulani'),
(8, 'Hausa'),
(9, 'Ibani'),
(10, 'Ibibio (Ibeno)'),
(11, 'Idoma'),
(12, 'Igbo'),
(13, 'Igede'),
(14, 'Ijaw'),
(15, 'Ijebu'),
(16, 'Ijesa'),
(17, 'Ikwere'),
(18, 'Isekiri'),
(19, 'Isoko'),
(20, 'Junkun'),
(21, 'kafa'),
(22, 'Kalabari'),
(23, 'kanuri'),
(24, 'Kwale'),
(25, 'Mbe'),
(26, 'Nupe'),
(27, 'Ogoni'),
(28, 'Okpe'),
(29, 'Okriki'),
(30, 'Opobo'),
(31, 'Owan'),
(32, 'TIV'),
(33, 'Urhobo'),
(34, 'Yewa'),
(35, 'Yoruba'),
(36, 'Ughelli'),
(37, 'Eggon'),
(38, 'Agbo'),
(39, 'Akaju-Ndem'),
(40, 'Amo'),
(41, 'Anaguta'),
(42, 'Bachama'),
(43, 'Banso (Panso)'),
(44, 'Baruba (Barba)'),
(45, 'Bassa'),
(46, 'Baushi'),
(47, 'Bette'),
(48, 'Bini'),
(49, 'Bobua'),
(50, 'Bunu'),
(51, 'Buru'),
(52, 'Buli (Buji)'),
(53, 'Challa'),
(54, 'Chibok (Chibbak)'),
(55, 'Daba'),
(56, 'Dakarkari'),
(57, 'Degema'),
(58, 'Deno (Denawa)'),
(59, 'Diba'),
(60, 'Ebu'),
(61, 'Egun'),
(62, 'Ejagham'),
(63, 'Etsako'),
(64, 'Etuno'),
(65, 'Gade'),
(66, 'Gombi'),
(67, 'Gonia'),
(68, 'Gude (Gudu)'),
(69, 'Gwa (Gurawa)'),
(70, 'Gwom'),
(71, 'Jaku (Jara)'),
(72, 'Kadara (Kafanchan)'),
(73, 'Kajuru (Kajurawa)'),
(74, 'Kantana'),
(75, 'Kariya'),
(76, 'Kenern (Koenoem)'),
(77, 'Kiballo (Kiwollo)'),
(78, 'Kugama'),
(79, 'Kulere (Kaler)'),
(80, 'Kwaro'),
(81, 'Limono'),
(82, 'Mambilla'),
(83, 'Mama'),
(84, 'Mbembe'),
(85, 'Mbula'),
(86, 'Mbum'),
(87, 'Miango'),
(88, 'Miya (Miyawa)'),
(89, 'Nunku'),
(90, 'Njayi'),
(91, 'Ngamo'),
(92, 'Mushere'),
(93, 'Ogori'),
(94, 'Olulumo'),
(95, 'Owan'),
(96, 'Oworo (Owe)'),
(97, 'Pkanzom (Poll)'),
(98, 'Polchi Habe'),
(99, 'Rindire (Rendre)'),
(100, 'Rubu'),
(101, 'Rumada (Rumaya)'),
(102, 'Segidi (Sigidawa)'),
(103, 'Shomo'),
(104, 'Shuwa'),
(105, 'Sura'),
(106, 'Teshena (Teshenawa)'),
(107, 'Tula'),
(108, 'Zzz - Not Listed');

-- --------------------------------------------------------

--
-- Table structure for table `exams_types`
--

CREATE TABLE `exams_types` (
  `exams_types_id` int(11) UNSIGNED NOT NULL,
  `exams_types_desc` varchar(50) DEFAULT NULL COMMENT 'good boy'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exams_types`
--

INSERT INTO `exams_types` (`exams_types_id`, `exams_types_desc`) VALUES
(1, 'Examination'),
(7, 'JAMB'),
(6, 'NECO'),
(2, 'Test 1'),
(3, 'Test 2'),
(5, 'WAEC');

-- --------------------------------------------------------

--
-- Table structure for table `forum_answer`
--

CREATE TABLE `forum_answer` (
  `question_id` int(4) NOT NULL DEFAULT 0,
  `a_id` int(4) NOT NULL DEFAULT 0,
  `a_name` varchar(65) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `a_email` varchar(65) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `a_answer` longtext COLLATE utf8_unicode_ci NOT NULL,
  `a_datetime` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '' COMMENT '03/11/10 20:12:16'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `forum_question`
--

CREATE TABLE `forum_question` (
  `id` int(4) NOT NULL,
  `topic` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `detail` longtext COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(65) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(65) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `datetime` varchar(25) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `view` int(4) NOT NULL DEFAULT 0,
  `reply` int(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `general_mailing`
--

CREATE TABLE `general_mailing` (
  `id` int(8) NOT NULL,
  `from` varchar(40) NOT NULL,
  `from_cat` varchar(20) NOT NULL,
  `to` varchar(40) NOT NULL,
  `to_cat` varchar(20) NOT NULL,
  `head` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `from_starred` tinyint(1) NOT NULL,
  `to_starred` tinyint(1) NOT NULL,
  `time` varchar(30) NOT NULL,
  `attachment` text NOT NULL,
  `from_status` tinyint(1) NOT NULL,
  `to_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `generations`
--

CREATE TABLE `generations` (
  `generations_id` int(8) UNSIGNED NOT NULL,
  `generations_desc` varchar(10) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `generations`
--

INSERT INTO `generations` (`generations_id`, `generations_desc`) VALUES
(1, 'III'),
(2, 'Sr.'),
(3, 'Jr.'),
(4, '--');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `grades_id` int(8) UNSIGNED NOT NULL,
  `grades_desc` varchar(20) NOT NULL DEFAULT '',
  `grades_active` tinyint(1) NOT NULL DEFAULT 1,
  `grades_domain` int(3) NOT NULL COMMENT 'connnect to grade_domain'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='static table';

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`grades_id`, `grades_desc`, `grades_active`, `grades_domain`) VALUES
(1, 'PRE NURSERY', 1, 1),
(2, 'NURSERY 1', 1, 2),
(3, 'NURSERY 2', 1, 2),
(4, 'NURSERY 3', 1, 2),
(5, 'PRIMARY 1 ', 1, 3),
(6, 'GRADE 2', 1, 3),
(7, 'GRADE 3', 1, 3),
(8, 'GRADE 4', 1, 3),
(9, 'GRADE 5', 1, 3),
(10, 'GRADE 6', 1, 3),
(11, 'GRADE 7', 1, 4),
(12, 'GRADE 8', 1, 4),
(13, 'GRADE 9', 1, 4),
(14, 'GRADE 10', 1, 5),
(15, 'GRADE 11', 1, 5),
(16, 'GRADE 12', 1, 5);

-- --------------------------------------------------------

--
-- Table structure for table `grades_domain`
--

CREATE TABLE `grades_domain` (
  `grades_domain_id` tinyint(1) NOT NULL,
  `grades_domain_desc` varchar(20) NOT NULL,
  `grades_domain_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades_domain`
--

INSERT INTO `grades_domain` (`grades_domain_id`, `grades_domain_desc`, `grades_domain_status`) VALUES
(4, 'Junior Secondary', 1),
(2, 'Nursery', 1),
(1, 'Pre Nursery', 1),
(3, 'Primary', 1),
(5, 'Senior Secondary', 1);

-- --------------------------------------------------------

--
-- Table structure for table `grade_history_primary`
--

CREATE TABLE `grade_history_primary` (
  `id` int(10) UNSIGNED NOT NULL,
  `exam_type` tinyint(2) NOT NULL,
  `student` int(8) NOT NULL,
  `year` int(3) NOT NULL,
  `quarter` int(3) NOT NULL COMMENT 'Semester or term',
  `course_code` int(2) NOT NULL,
  `ca_score1` int(2) NOT NULL,
  `ca_score2` int(2) NOT NULL,
  `exam_score` int(2) NOT NULL,
  `level_taken` int(3) NOT NULL,
  `date` varchar(30) NOT NULL,
  `aprove` int(1) NOT NULL COMMENT 'is it aproved by form master',
  `notes` varchar(50) NOT NULL,
  `user` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='In this table, grade_history_primary_user is the Teacher name.';

-- --------------------------------------------------------

--
-- Table structure for table `grade_subjects`
--

CREATE TABLE `grade_subjects` (
  `grade_subject_id` int(8) NOT NULL,
  `grade_subject_desc` varchar(50) NOT NULL DEFAULT '',
  `code` varchar(20) NOT NULL,
  `grade` int(3) NOT NULL,
  `describe` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='storing subject names';

--
-- Dumping data for table `grade_subjects`
--

INSERT INTO `grade_subjects` (`grade_subject_id`, `grade_subject_desc`, `code`, `grade`, `describe`) VALUES
(2, 'Social Studies', 'Sos', 0, ''),
(3, 'Use of Library', 'Lib', 0, ''),
(4, 'English', 'Eng', 0, ''),
(5, 'Business Studies', 'Bstd', 0, ''),
(6, 'Chemistry', 'Chem', 0, ''),
(7, 'Physics', 'Phy', 0, ''),
(8, 'Mathematics', 'Math', 0, ''),
(9, 'Physical and Health Education', 'Phe', 0, ''),
(10, 'Home Economics', 'H.E', 0, ''),
(11, 'Geography', 'Geo', 0, ''),
(12, 'Music', 'Music', 0, ''),
(13, 'Economics', 'Econs', 0, ''),
(17, 'Data Processing/ICT', 'ICT', 0, ''),
(19, 'Biology', 'Bio', 0, ''),
(20, 'Literature', 'Lit', 0, ''),
(21, 'Basic Science', 'B.Sci', 0, ''),
(22, 'Basic. Tech', 'B.Tech', 0, ''),
(23, 'Christian Religious Study', 'CRK', 0, ''),
(24, 'Accounting', 'Acc', 0, ''),
(25, 'Civic Education', 'C.Edu', 0, ''),
(26, 'Further Mathematics', 'F.Math', 0, ''),
(27, 'Technical Drawing', 'T.D', 0, ''),
(28, 'Agricultural Science', 'Agric', 0, ''),
(29, 'Food and Nutrition', 'F&N', 0, ''),
(30, 'Creative Art', 'Art', 0, ''),
(31, 'Yoruba', 'Yor', 0, ''),
(32, 'French', 'FR', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `grade_terms`
--

CREATE TABLE `grade_terms` (
  `grade_terms_id` int(1) NOT NULL,
  `grade_terms_desc` varchar(40) NOT NULL DEFAULT '',
  `current` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grade_terms`
--

INSERT INTO `grade_terms` (`grade_terms_id`, `grade_terms_desc`, `current`) VALUES
(1, 'First Term', 1),
(2, 'Second Term', 0),
(3, 'Third Term', 0),
(4, 'Holiday', 0);

-- --------------------------------------------------------

--
-- Table structure for table `grade_terms_days`
--

CREATE TABLE `grade_terms_days` (
  `grade_terms_days_id` int(8) NOT NULL,
  `grade_terms_days_session` int(3) NOT NULL,
  `grade_terms_days_term` tinyint(1) NOT NULL,
  `grade_terms_days_no_of_days` int(5) NOT NULL,
  `resumption` varchar(10) NOT NULL,
  `vacation` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_allergy`
--

CREATE TABLE `health_allergy` (
  `health_allergy_id` int(8) UNSIGNED NOT NULL,
  `health_allergy_desc` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_allergy`
--

INSERT INTO `health_allergy` (`health_allergy_id`, `health_allergy_desc`) VALUES
(10, 'Anger'),
(12, 'Anti-Social'),
(13, 'Anxiety'),
(9, 'Dandruff'),
(14, 'Depression'),
(11, 'Hair loss'),
(1, 'Headaches'),
(2, 'Itch or dry throat'),
(3, 'Itchy watery eyes'),
(15, 'Mood Swings'),
(4, 'Nasal'),
(5, 'Red eyes after spending time outdoors'),
(6, 'Runny nose'),
(16, 'Sinus Pain'),
(7, 'Sneezing'),
(8, 'Stuffy nose');

-- --------------------------------------------------------

--
-- Table structure for table `health_allergy_history`
--

CREATE TABLE `health_allergy_history` (
  `health_allergy_history_id` bigint(20) UNSIGNED NOT NULL,
  `health_allergy_history_student` int(8) UNSIGNED DEFAULT 0,
  `health_allergy_history_year` int(3) UNSIGNED DEFAULT 0,
  `health_allergy_history_term` tinyint(1) NOT NULL,
  `health_allergy_history_school` tinyint(1) UNSIGNED DEFAULT 0,
  `health_allergy_history_code` int(3) UNSIGNED DEFAULT 0,
  `health_allergy_history_date` varchar(30) DEFAULT '0000-00-00',
  `health_allergy_history_notes` varchar(100) DEFAULT NULL,
  `health_allergy_history_user` int(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_codes`
--

CREATE TABLE `health_codes` (
  `health_codes_id` int(8) UNSIGNED NOT NULL,
  `health_codes_desc` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_codes`
--

INSERT INTO `health_codes` (`health_codes_id`, `health_codes_desc`) VALUES
(8, 'Acne'),
(15, 'Anemia'),
(5, 'Arthritis'),
(16, 'Ask Health Question'),
(44, 'Bad breath'),
(18, 'Black Eye'),
(37, 'Body Pain'),
(19, 'Cancer'),
(20, 'Cataracts'),
(22, 'Common Cold'),
(21, 'Constipation'),
(7, 'Difficulty breathing'),
(11, 'Ear Ache'),
(23, 'Eczema'),
(24, 'Epilepsy'),
(47, 'Fever'),
(45, 'Gout'),
(25, 'Gum disease'),
(1, 'Headache'),
(26, 'Heart attack'),
(27, 'Heart Burn'),
(28, 'High blood pressure'),
(46, 'High cholesterol'),
(29, 'Hiv/aids'),
(3, 'Hungry'),
(30, 'Kidney disease'),
(31, 'Liver problems'),
(13, 'Lost Tooth'),
(32, 'Lung disease'),
(48, 'Malaria'),
(9, 'Menstural Issues'),
(33, 'Migraines'),
(34, 'Mineral deficiency'),
(14, 'Nauseous'),
(6, 'Nosebleed'),
(35, 'Nosebleeds frequent'),
(36, 'Obesity'),
(38, 'Skin rash'),
(12, 'Sore Throat '),
(2, 'Stomach Ache '),
(39, 'Stroke'),
(41, 'Tumor'),
(17, 'Twisted Ankle'),
(40, 'Ulcer'),
(42, 'Urination problems'),
(43, 'Vaginal infections');

-- --------------------------------------------------------

--
-- Table structure for table `health_history`
--

CREATE TABLE `health_history` (
  `health_history_id` int(8) UNSIGNED NOT NULL,
  `health_history_student` int(8) UNSIGNED DEFAULT NULL,
  `health_history_school` tinyint(1) UNSIGNED DEFAULT NULL,
  `health_history_year` int(3) UNSIGNED DEFAULT NULL,
  `health_history_term` tinyint(1) NOT NULL,
  `health_history_code` int(4) UNSIGNED DEFAULT NULL,
  `health_history_medicine_1` int(4) NOT NULL,
  `health_history_medicine_2` int(4) NOT NULL,
  `health_history_date` varchar(30) DEFAULT NULL,
  `health_history_notes` text DEFAULT NULL,
  `health_history_user` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_immunz`
--

CREATE TABLE `health_immunz` (
  `health_immunz_id` int(8) UNSIGNED NOT NULL,
  `health_immunz_desc` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_immunz`
--

INSERT INTO `health_immunz` (`health_immunz_id`, `health_immunz_desc`) VALUES
(2, 'Rubella'),
(3, 'Polio'),
(4, 'Mumps'),
(5, 'Chickenpox');

-- --------------------------------------------------------

--
-- Table structure for table `health_immunz_history`
--

CREATE TABLE `health_immunz_history` (
  `health_immunz_history_id` bigint(20) UNSIGNED NOT NULL,
  `health_immunz_history_student` int(11) UNSIGNED DEFAULT 0,
  `health_immunz_history_year` int(8) UNSIGNED DEFAULT 0,
  `health_immunz_history_term` tinyint(1) NOT NULL,
  `health_immunz_history_school` tinyint(1) UNSIGNED DEFAULT 0,
  `health_immunz_history_code` int(3) UNSIGNED DEFAULT 0,
  `health_immunz_history_date` varchar(30) DEFAULT '0000-00-00',
  `health_immunz_history_notes` varchar(100) DEFAULT NULL,
  `health_immunz_history_user` int(8) UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `health_medicine`
--

CREATE TABLE `health_medicine` (
  `health_medicine_id` int(8) UNSIGNED NOT NULL,
  `health_medicine_desc` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `health_medicine`
--

INSERT INTO `health_medicine` (`health_medicine_id`, `health_medicine_desc`) VALUES
(21, 'Actifed'),
(5, 'Afrin'),
(6, 'Alavert'),
(34, 'Ambien'),
(3, 'Ampicillin2'),
(18, 'Asmanex'),
(35, 'Aspirin'),
(4, 'Asthma Inhaler'),
(26, 'Avandia'),
(7, 'Beconase'),
(28, 'Blood Tonic'),
(11, 'Celebrex'),
(17, 'Chloroqin'),
(8, 'Dimetapp'),
(22, 'Dristan'),
(14, 'Fevin'),
(25, 'Fibercon'),
(27, 'Fluoxetine'),
(29, 'Insulin'),
(16, 'Medic 5-5'),
(31, 'Naproxen'),
(9, 'Nasal sprays'),
(15, 'Panadol'),
(30, 'Plavix'),
(12, 'Prednisone'),
(20, 'Prevachol'),
(32, 'Prevacid'),
(23, 'Quintex'),
(13, 'Remicade'),
(1, 'Ritalin'),
(19, 'Serevent'),
(2, 'Sominex'),
(24, 'Tamilflu'),
(10, 'Tavist'),
(33, 'Tylenol');

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `homework_id` bigint(20) NOT NULL,
  `teacher_id` int(8) DEFAULT NULL,
  `session` int(3) NOT NULL,
  `term` int(3) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `subject` int(3) NOT NULL,
  `grade` int(3) NOT NULL,
  `date_assigned` varchar(30) NOT NULL,
  `date_due` varchar(30) NOT NULL,
  `homework_file` text NOT NULL,
  `instruction` varchar(200) NOT NULL,
  `notepad_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostels`
--

CREATE TABLE `hostels` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `open_status` int(1) NOT NULL COMMENT '1 means hostel is open, 0 means closed',
  `reserve_status` int(1) NOT NULL COMMENT '1 means reserved for specifc student. only student with reserve key can be assigned. reserve key can come from hostel overide table',
  `occupant_sex` varchar(1) NOT NULL COMMENT 'm,f,b for male female both',
  `hostel_type` int(1) NOT NULL DEFAULT 1 COMMENT 'hostel_type table for executive or more ',
  `hostel_image_url` varchar(50) NOT NULL COMMENT 'uploaded by admin, stored in /files/images.. if empty use /hostels.png',
  `hostel_grade` int(11) NOT NULL DEFAULT 0 COMMENT 'which grade can use this hostel',
  `ability_type` int(11) NOT NULL DEFAULT 1 COMMENT 'from hostels-ability_types.id showing if hostel is for disabled or not. note rooms ability type overrides this'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostels_allocation`
--

CREATE TABLE `hostels_allocation` (
  `id` int(11) NOT NULL,
  `bed_space` int(11) NOT NULL COMMENT 'from hostels_bed_space. each bed spaces already have hostels, rooms and series property',
  `student` int(11) NOT NULL DEFAULT 0,
  `session` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '1 active, admin may decide to suspend room after allocation',
  `paid` int(1) NOT NULL DEFAULT 0 COMMENT '1 means the student has paid: when a student apply, student is updated, if he fail to pay after three days, colum is deleted by crone job',
  `date_pd` varchar(20) NOT NULL COMMENT 'payment date, seen as date by which student enters the room'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='this table will be used to know list of available rooms, if std=1 its asigned';

-- --------------------------------------------------------

--
-- Table structure for table `hostels_bed_space`
--

CREATE TABLE `hostels_bed_space` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL COMMENT 'sometimes bed space have names A,B,C,D, thus 1=A, 2=B etc',
  `hostel` int(11) NOT NULL,
  `series` int(11) NOT NULL,
  `room` int(11) NOT NULL COMMENT 'goten from her series table',
  `override_open_status` int(1) NOT NULL DEFAULT 1 COMMENT '1 means open, 0 means closed',
  `override_reserve_status` int(1) NOT NULL DEFAULT 0 COMMENT '1 means space is reserves for specific student ',
  `override_age` int(1) NOT NULL COMMENT 'define the age of the student for this bed space if left as default 0, all age will apply',
  `overide_sex` varchar(1) NOT NULL DEFAULT '0' COMMENT 'm,f,b',
  `override_grade` int(11) NOT NULL DEFAULT 0 COMMENT 'what geade can use this hostel room bed space',
  `type` int(11) NOT NULL DEFAULT 1 COMMENT 'from hostels_type 1 means normal',
  `override_ability` int(11) NOT NULL DEFAULT 1 COMMENT 'from hostel_ability',
  `asign` int(1) NOT NULL DEFAULT 0 COMMENT '1 means space is asigned, not important, you can know asssigned rooms from hostel allocation table, this one is just for ease of action. update when you asign '
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostels_fees`
--

CREATE TABLE `hostels_fees` (
  `id` int(11) NOT NULL,
  `session` int(11) NOT NULL,
  `term` int(11) NOT NULL,
  `hostel` int(11) NOT NULL,
  `fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `hostels_tbl_ability`
--

CREATE TABLE `hostels_tbl_ability` (
  `id` int(11) NOT NULL,
  `description` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='static table';

-- --------------------------------------------------------

--
-- Table structure for table `hostels_tbl_series`
--

CREATE TABLE `hostels_tbl_series` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='static table';

-- --------------------------------------------------------

--
-- Table structure for table `hostels_tbl_types`
--

CREATE TABLE `hostels_tbl_types` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hostels_tbl_types`
--

INSERT INTO `hostels_tbl_types` (`id`, `name`) VALUES
(1, 'Normal'),
(2, 'Executive'),
(3, 'Hall');

-- --------------------------------------------------------

--
-- Table structure for table `infraction_codes`
--

CREATE TABLE `infraction_codes` (
  `infraction_codes_id` int(8) UNSIGNED NOT NULL,
  `infraction_codes_desc` varchar(30) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `infraction_codes`
--

INSERT INTO `infraction_codes` (`infraction_codes_id`, `infraction_codes_desc`) VALUES
(1, 'Disruptive Behavior'),
(2, 'Disrespect'),
(3, 'Obscene Language'),
(4, 'Obscene Gesture'),
(5, 'Not Following Direction '),
(6, 'Throwing Objects '),
(7, 'Fighting'),
(8, 'Roughhousing'),
(9, 'Cheating'),
(10, 'Late'),
(11, 'Theft'),
(12, 'Substance Abuse'),
(13, 'Truancy'),
(14, 'Not Where Assigned '),
(15, 'Skipping Detention'),
(16, 'Vandalism'),
(17, 'Threatening Behavior'),
(18, 'Harassment'),
(19, 'Explosive devices'),
(20, 'Flammable devices'),
(21, 'Unauthorized Leaving '),
(22, 'Other'),
(23, 'Bus Issue ');

-- --------------------------------------------------------

--
-- Table structure for table `media_codes`
--

CREATE TABLE `media_codes` (
  `media_codes_id` int(8) NOT NULL,
  `media_codes_desc` varchar(50) NOT NULL,
  `id1` varchar(20) NOT NULL,
  `id2` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `media_codes`
--

INSERT INTO `media_codes` (`media_codes_id`, `media_codes_desc`, `id1`, `id2`) VALUES
(1, 'Things Fall Apart - Chinua Achebe S', 'Shelf 2', 'Slide 14'),
(7, 'There was a country - Dida', 'Shelf 2', 'Shell 1'),
(10, 'Behind the Smile - Vvone Chinyere', 'Shelf 2', 'Slot  3'),
(11, 'Faceless - Eva Bondell', 'Shelf 6', 'Slot 5');

-- --------------------------------------------------------

--
-- Table structure for table `media_history`
--

CREATE TABLE `media_history` (
  `media_history_id` bigint(20) UNSIGNED NOT NULL,
  `media_history_borrower` int(8) UNSIGNED DEFAULT NULL,
  `media_history_school` smallint(1) UNSIGNED DEFAULT NULL,
  `media_history_year` int(3) UNSIGNED DEFAULT NULL,
  `media_history_code` int(8) UNSIGNED DEFAULT NULL,
  `media_history_dateout` varchar(30) DEFAULT NULL,
  `media_history_datedue` varchar(30) DEFAULT NULL,
  `media_history_borrower_type` varchar(9) DEFAULT NULL,
  `media_history_action` varchar(50) DEFAULT NULL,
  `media_history_user` int(8) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `parent_to_kids`
--

CREATE TABLE `parent_to_kids` (
  `parent_to_kids_id` int(11) NOT NULL,
  `parent_id` int(8) NOT NULL DEFAULT 0,
  `student_id` int(8) NOT NULL DEFAULT 0,
  `confirmation` tinyint(1) NOT NULL COMMENT '0 = requested by parent, 1=approved by admin, 2=parent deleted the child'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_receipts`
--

CREATE TABLE `payment_receipts` (
  `tuition_history_id` int(10) NOT NULL,
  `tution_paid_by_user_id` int(8) NOT NULL,
  `tution_paid_by_std_par` varchar(20) NOT NULL,
  `tution_amount_paid` int(8) NOT NULL,
  `tution_paid_sch_years` int(3) NOT NULL,
  `tution_paid_grade` int(2) NOT NULL,
  `tution_paid_terms` tinyint(1) NOT NULL,
  `tution_paid_type` tinyint(1) NOT NULL,
  `school_item_price_relid` int(3) NOT NULL DEFAULT 0,
  `qty` tinyint(1) NOT NULL,
  `tution_paid_date` varchar(30) NOT NULL,
  `cleared` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `payment_recharge_receipts`
--

CREATE TABLE `payment_recharge_receipts` (
  `tuition_history_id` int(10) NOT NULL,
  `tution_recharge_by_user_id` int(8) NOT NULL,
  `tution_recharge_by_std_par` varchar(20) NOT NULL,
  `tution_amount_recharged` int(8) NOT NULL,
  `tution_recharge_sch_years` int(3) NOT NULL,
  `tution_recharge_grade` int(2) NOT NULL,
  `tution_recharge_terms` tinyint(1) NOT NULL,
  `recharge_means` varchar(30) NOT NULL,
  `tution_recharge_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg_pins`
--

CREATE TABLE `reg_pins` (
  `id` bigint(20) NOT NULL,
  `codec` varchar(14) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `used_by` int(8) NOT NULL DEFAULT 0,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `amount` int(8) NOT NULL,
  `description` varchar(70) NOT NULL,
  `creation` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `reg_pins_old`
--

CREATE TABLE `reg_pins_old` (
  `id` bigint(20) NOT NULL,
  `codec` varchar(14) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `used_by` int(8) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `description` varchar(70) NOT NULL,
  `amount` int(11) NOT NULL,
  `creation` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `relations_codes`
--

CREATE TABLE `relations_codes` (
  `relation_codes_id` int(8) UNSIGNED NOT NULL,
  `relation_codes_desc` varchar(30) DEFAULT NULL,
  `relation_codes_unique` tinyint(1) UNSIGNED DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `relations_codes`
--

INSERT INTO `relations_codes` (`relation_codes_id`, `relation_codes_desc`, `relation_codes_unique`) VALUES
(1, 'Father', 1),
(2, 'Mother', 1),
(3, 'Brother', 1),
(4, 'Sister', 1),
(5, 'Uncle', 1),
(6, 'Aunt', 1),
(7, 'Grandfather', 1),
(8, 'Grandmother', 1),
(9, 'Stepfather', 1),
(10, 'Stepmother', 1),
(12, 'Grandfather', 1),
(13, 'Guardian', 1),
(14, 'Nephew', 1),
(15, 'Niece', 1),
(16, 'Daughter-in-Law', 1),
(17, 'Son-Daughter-in-Law', 1),
(18, 'Mother-in-Law', 1),
(19, 'Father-in-Law', 1),
(20, 'Sister-in-Law', 1),
(21, 'Brother-in-Law', 1),
(22, 'Grandmother', 1),
(23, 'Zzz - Not Listed', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_calendar`
--

CREATE TABLE `school_calendar` (
  `id` int(10) NOT NULL,
  `event_name` varchar(100) NOT NULL,
  `start_date` varchar(35) NOT NULL,
  `end_date` varchar(35) NOT NULL,
  `event_color` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_class_periods`
--

CREATE TABLE `school_class_periods` (
  `id` int(4) NOT NULL,
  `periods` varchar(30) NOT NULL,
  `desc` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_class_periods`
--

INSERT INTO `school_class_periods` (`id`, `periods`, `desc`) VALUES
(1, '8:00am - 9:00am', 'First Period'),
(2, '9:00am - 10:00am', 'Second Period'),
(3, '10:00am - 11:00am', 'Third Period'),
(4, '11:00am - 12:00pm', 'Fourth Period'),
(5, '12:00pm - 1:00pm', 'Fifth Period'),
(6, '1:00pm - 2:00pm', 'Sixth Period'),
(7, '2:00pm - 3:00pm', 'Seventh Period'),
(8, '3:00pm - 4:00pm', 'Eight Period');

-- --------------------------------------------------------

--
-- Table structure for table `school_fees`
--

CREATE TABLE `school_fees` (
  `id` bigint(50) NOT NULL,
  `component` varchar(200) NOT NULL,
  `grades` int(10) NOT NULL,
  `grades_term` int(1) NOT NULL,
  `school_year` int(2) NOT NULL,
  `price` int(9) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `creator` varchar(40) NOT NULL,
  `comment` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_fees_default`
--

CREATE TABLE `school_fees_default` (
  `id` bigint(50) NOT NULL,
  `component` varchar(200) NOT NULL,
  `grades` int(10) NOT NULL,
  `grades_term` int(1) NOT NULL,
  `school_year` int(2) NOT NULL,
  `price` int(9) NOT NULL DEFAULT 0,
  `date` date NOT NULL,
  `creator` varchar(40) NOT NULL,
  `comment` text NOT NULL,
  `active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `school_fees_default`
--

INSERT INTO `school_fees_default` (`id`, `component`, `grades`, `grades_term`, `school_year`, `price`, `date`, `creator`, `comment`, `active`) VALUES
(1, 'total', 14, 1, 1, 470000, '0000-00-00', 'Principal', 'Approved', 1),
(2, 'total', 14, 2, 1, 500000, '0000-00-00', 'Principal', 'Approved', 1),
(3, 'total', 14, 3, 1, 550000, '0000-00-00', 'Principal', 'Approved', 1),
(4, 'total', 13, 1, 1, 460000, '0000-00-00', 'Principal', 'Approved', 1),
(5, 'total', 13, 2, 1, 550000, '0000-00-00', 'Principal', 'Approved', 1),
(6, 'total', 13, 3, 1, 500000, '0000-00-00', 'Principal', 'Approved', 1),
(7, 'total', 12, 1, 1, 550000, '0000-00-00', 'Principal', 'Approved', 1),
(8, 'total', 12, 2, 1, 550000, '0000-00-00', 'Principal', 'Approved', 1),
(9, 'total', 12, 3, 1, 480000, '0000-00-00', 'Principal', 'Approved', 1),
(10, 'total', 11, 1, 1, 515000, '0000-00-00', 'Principal', 'Approved', 1),
(11, 'total', 11, 2, 1, 515000, '0000-00-00', 'Principal', 'Approved', 1),
(12, 'total', 11, 3, 1, 515000, '0000-00-00', 'Principal', 'Approved', 1),
(13, 'total', 10, 1, 1, 460000, '0000-00-00', 'Principal', 'Approved', 1),
(14, 'total', 10, 2, 1, 460000, '0000-00-00', 'Principal', 'Approved', 1),
(15, 'total', 10, 3, 1, 460000, '0000-00-00', 'Principal', 'Approved', 1),
(16, 'total', 9, 1, 1, 455000, '0000-00-00', 'Principal', 'Approved', 1),
(17, 'total', 9, 2, 1, 455000, '0000-00-00', 'Principal', 'Approved', 1),
(18, 'total', 9, 3, 1, 455000, '0000-00-00', 'Principal', 'Approved', 1),
(19, 'total', 8, 1, 1, 450000, '0000-00-00', 'Principal', 'Approved', 1),
(20, 'total', 8, 2, 1, 450000, '0000-00-00', 'Principal', 'Approved', 1),
(21, 'total', 8, 3, 1, 450000, '0000-00-00', 'Principal', 'Approved', 1),
(22, 'total', 7, 1, 1, 425000, '0000-00-00', 'Principal', 'Approved', 1),
(23, 'total', 7, 2, 1, 425000, '0000-00-00', 'Principal', 'Approved', 1),
(24, 'total', 7, 3, 1, 425000, '0000-00-00', 'Principal', 'Approved', 1),
(34, 'total', 6, 1, 1, 420000, '0000-00-00', 'Principal', 'Approved', 1),
(35, 'total', 6, 2, 1, 420000, '0000-00-00', 'Principal', 'Approved', 1),
(36, 'total', 6, 3, 1, 420000, '0000-00-00', 'Principal', 'Approved', 1),
(37, 'total', 5, 1, 1, 415000, '0000-00-00', 'Principal', 'Approved', 1),
(38, 'total', 5, 2, 1, 415000, '0000-00-00', 'Principal', 'Approved', 1),
(39, 'total', 5, 3, 1, 415000, '0000-00-00', 'Principal', 'Approved', 1),
(40, 'total', 4, 1, 1, 370000, '0000-00-00', 'Principal', 'Approved', 1),
(41, 'total', 4, 2, 1, 370000, '0000-00-00', 'Principal', 'Approved', 1),
(42, 'total', 4, 3, 1, 370000, '0000-00-00', 'Principal', 'Approved', 1),
(43, 'total', 3, 1, 1, 360000, '0000-00-00', 'Principal', 'Approved', 1),
(44, 'total', 3, 2, 1, 360000, '0000-00-00', 'Principal', 'Approved', 1),
(45, 'total', 3, 3, 1, 360000, '0000-00-00', 'Principal', 'Approved', 1),
(46, 'total', 2, 1, 1, 350000, '0000-00-00', 'Principal', 'Approved', 1),
(47, 'total', 2, 2, 1, 350000, '0000-00-00', 'Principal', 'Approved', 1),
(48, 'total', 2, 3, 1, 350000, '2014-08-04', 'Principal', 'Approved', 1),
(49, 'total', 1, 1, 1, 300000, '0000-00-00', 'Principal', 'Approved', 1),
(50, 'total', 1, 2, 1, 309000, '0000-00-00', 'Principal', 'Approved', 1),
(51, 'total', 1, 3, 1, 310000, '0000-00-00', 'Principal', 'Approved', 1),
(52, 'Security', 14, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(53, 'Health Service', 14, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(54, 'Libary', 14, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(55, 'Examination', 14, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(56, 'Tuition', 14, 1, 1, 180000, '0000-00-00', 'Principal', 'Approved', 1),
(57, 'Library', 14, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(58, 'Health Service', 14, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(59, 'Security', 14, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(60, 'Examination', 14, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(61, 'Tuition', 14, 2, 1, 200000, '0000-00-00', 'Principal', 'Approved', 1),
(62, 'Development Fees', 14, 3, 1, 47000, '0000-00-00', 'Principal', 'Approved', 1),
(63, 'Hostel Fees', 14, 3, 1, 10000, '0000-00-00', 'Principal', 'Approved', 1),
(64, 'PTA', 14, 3, 1, 48000, '0000-00-00', 'Principal', 'Approved', 1),
(65, 'Tution and Security', 14, 3, 1, 6800, '0000-00-00', 'Principal', 'Approved', 1),
(66, 'Health', 14, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(67, 'Libary', 13, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(68, 'Health Service', 13, 1, 1, 45000, '0000-00-00', 'Principal', 'Approved', 1),
(69, 'Security', 13, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(70, 'Examination', 13, 1, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(71, 'Tuition', 13, 1, 1, 160000, '0000-00-00', 'Principal', 'Approved', 1),
(72, 'Security', 13, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(73, 'Libary', 13, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(74, 'ICT', 13, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(75, 'Health Service', 13, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(76, 'Tuition', 13, 2, 1, 260000, '0000-00-00', 'Principal', 'Approved', 1),
(77, 'Examination', 13, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(78, 'Health Service', 13, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(79, 'Library', 13, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(80, 'Security', 13, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(81, 'Tuition', 13, 3, 1, 250000, '0000-00-00', 'Principal', 'Approved', 1),
(82, 'Health Service', 12, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(83, 'Libary', 12, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(84, 'Security', 12, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(85, 'Examination', 12, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(86, 'Tuition', 12, 1, 1, 250000, '0000-00-00', 'Principal', 'Approved', 1),
(87, 'Books', 12, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(88, 'Health Service', 12, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(89, 'Library', 12, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(90, 'Examination', 12, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(91, 'Tuition', 12, 2, 1, 250000, '0000-00-00', 'Principal', 'Approved', 1),
(92, 'ICT', 12, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(93, 'Examination', 12, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(94, 'Health Service', 12, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(95, 'Security', 12, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(96, 'Tuition', 12, 3, 1, 190000, '0000-00-00', 'Principal', 'Approved', 1),
(97, 'Health Care', 11, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(98, 'ICT', 11, 1, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(99, 'Library', 11, 1, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(100, 'Examination', 11, 1, 1, 80000, '0000-00-00', 'Principal', 'Approved', 1),
(101, 'Tuition', 11, 1, 1, 200000, '0000-00-00', 'Principal', 'Approved', 1),
(102, 'Health Care', 11, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(103, 'ICT', 11, 2, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(104, 'Library', 11, 2, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(105, 'Examination', 11, 2, 1, 80000, '0000-00-00', 'Principal', 'Approved', 1),
(106, 'Tuition', 11, 2, 1, 200000, '0000-00-00', 'Principal', 'Approved', 1),
(107, 'Health Care', 11, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(108, 'ICT', 11, 3, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(109, 'Library', 11, 3, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(110, 'Examination', 11, 3, 1, 80000, '0000-00-00', 'Principal', 'Approved', 1),
(111, 'Tuition', 11, 3, 1, 200000, '0000-00-00', 'Principal', 'Approved', 1),
(112, 'Health Care', 10, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(113, 'ICT', 10, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(114, 'Library', 10, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(115, 'Examination', 10, 1, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(116, 'Tuition', 10, 1, 1, 185000, '0000-00-00', 'Principal', 'Approved', 1),
(117, 'Health Care', 10, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(118, 'ICT', 10, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(119, 'Library', 10, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(120, 'Examination', 10, 2, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(121, 'Tuition', 10, 2, 1, 185000, '0000-00-00', 'Principal', 'Approved', 1),
(122, 'Health Care', 10, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(123, 'ICT', 10, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(124, 'Library', 10, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(125, 'Examination', 10, 3, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(126, 'Tuition', 10, 3, 1, 185000, '0000-00-00', 'Principal', 'Approved', 1),
(127, 'Health Care', 9, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(128, 'ICT', 9, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(129, 'Library', 9, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(130, 'Examination', 9, 1, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(131, 'Tuition', 9, 1, 1, 180000, '0000-00-00', 'Principal', 'Approved', 1),
(132, 'Health Care', 9, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(133, 'ICT', 9, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(134, 'Library', 9, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(135, 'Examination', 9, 2, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(136, 'Tuition', 9, 2, 1, 180000, '0000-00-00', 'Principal', 'Approved', 1),
(137, 'Health Care', 9, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(138, 'ICT', 9, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(139, 'Library', 9, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(140, 'Examination', 9, 3, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(141, 'Tuition', 9, 3, 1, 180000, '0000-00-00', 'Principal', 'Approved', 1),
(142, 'Health Care', 8, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(143, 'ICT', 8, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(144, 'Library', 8, 1, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(145, 'Examination', 8, 1, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(146, 'Tuition', 8, 1, 1, 175000, '0000-00-00', 'Principal', 'Approved', 1),
(147, 'Health Care', 8, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(148, 'ICT', 8, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(149, 'Library', 8, 2, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(150, 'Examination', 8, 2, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(151, 'Tuition', 8, 2, 1, 175000, '0000-00-00', 'Principal', 'Approved', 1),
(152, 'Health Care', 8, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(153, 'ICT', 8, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(154, 'Library', 8, 3, 1, 35000, '0000-00-00', 'Principal', 'Approved', 1),
(155, 'Examination', 8, 3, 1, 75000, '0000-00-00', 'Principal', 'Approved', 1),
(156, 'Tuition', 8, 3, 1, 175000, '0000-00-00', 'Principal', 'Approved', 1),
(157, 'Health Care', 7, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(158, 'ICT', 7, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(159, 'Library', 7, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(160, 'Examination', 7, 1, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(161, 'Tuition', 7, 1, 1, 170000, '0000-00-00', 'Principal', 'Approved', 1),
(162, 'Health Care', 7, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(163, 'ICT', 7, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(164, 'Library', 7, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(165, 'Examination', 7, 2, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(166, 'Tuition', 7, 2, 1, 170000, '0000-00-00', 'Principal', 'Approved', 1),
(167, 'sub_total1_grade7', 7, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(168, 'sub_total2_grade7', 7, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(169, 'sub_total3_grade7', 7, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(170, 'sub_total4_grade7', 7, 3, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(171, 'sub_total5_grade7', 7, 3, 1, 170000, '0000-00-00', 'Principal', 'Approved', 1),
(172, 'Health Care', 6, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(173, 'ICT', 6, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(174, 'Library', 6, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(175, 'Examination', 6, 1, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(176, 'Tuition', 6, 1, 1, 165000, '0000-00-00', 'Principal', 'Approved', 1),
(177, 'Health Care', 6, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(178, 'ICT', 6, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(179, 'Library', 6, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(180, 'Examination', 6, 2, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(181, 'Tuition', 6, 2, 1, 165000, '0000-00-00', 'Principal', 'Approved', 1),
(182, 'Health Care', 6, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(183, 'ICT', 6, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(184, 'Library', 6, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(185, 'Examination', 6, 3, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(186, 'Tuition', 6, 3, 1, 165000, '0000-00-00', 'Principal', 'Approved', 1),
(187, 'Health Care', 5, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(188, 'ICT', 5, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(189, 'Library', 5, 1, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(190, 'Examination', 5, 1, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(191, 'Tuition', 5, 1, 1, 160000, '0000-00-00', 'Principal', 'Approved', 1),
(192, 'Health Care', 5, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(193, 'ICT', 5, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(194, 'Library', 5, 2, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(195, 'Examination', 5, 2, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(196, 'Tuition', 5, 2, 1, 160000, '0000-00-00', 'Principal', 'Approved', 1),
(197, 'Health Care', 5, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(198, 'ICT', 5, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(199, 'Library', 5, 3, 1, 30000, '0000-00-00', 'Principal', 'Approved', 1),
(200, 'Examination', 5, 3, 1, 70000, '0000-00-00', 'Principal', 'Approved', 1),
(201, 'Tuition', 5, 3, 1, 160000, '0000-00-00', 'Principal', 'Approved', 1),
(202, 'Health Care', 4, 1, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(203, 'ICT', 4, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(204, 'Library', 4, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(205, 'Examination', 4, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(206, 'Tuition', 4, 1, 1, 140000, '0000-00-00', 'Principal', 'Approved', 1),
(207, 'Health Care', 4, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(208, 'ICT', 4, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(209, 'Library', 4, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(210, 'Examination', 4, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(211, 'Tuition', 4, 2, 1, 140000, '0000-00-00', 'Principal', 'Approved', 1),
(212, 'Health Care', 4, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(213, 'ICT', 4, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(214, 'Library', 4, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(215, 'Examination', 4, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(216, 'Tuition', 4, 3, 1, 140000, '0000-00-00', 'Principal', 'Approved', 1),
(217, 'Health Care', 3, 1, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(218, 'ICT', 3, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(219, 'Library', 3, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(220, 'Examination', 3, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(221, 'Tuition', 3, 1, 1, 130000, '0000-00-00', 'Principal', 'Approved', 1),
(222, 'Health Care', 3, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(223, 'ICT', 3, 2, 1, 20500, '0000-00-00', 'Principal', 'Approved', 1),
(224, 'Library', 3, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(225, 'Examination', 3, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(226, 'Tuition', 3, 2, 1, 130000, '0000-00-00', 'Principal', 'Approved', 1),
(227, 'Health Care', 3, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(228, 'ICT', 3, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(229, 'Library', 3, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(230, 'Examination', 3, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(231, 'Tuition', 3, 3, 1, 130000, '0000-00-00', 'Principal', 'Approved', 1),
(232, 'Health Care', 2, 1, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(233, 'ICT', 2, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(234, 'Library', 2, 1, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(235, 'Examination', 2, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(236, 'Tuition', 2, 1, 1, 120000, '0000-00-00', 'Principal', 'Approved', 1),
(237, 'Health Care', 2, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(238, 'ICT', 2, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(239, 'Library', 2, 2, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(240, 'Examination', 2, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(241, 'Tuition', 2, 2, 1, 120000, '0000-00-00', 'Principal', 'Approved', 1),
(242, 'Health Care', 2, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(243, 'ICT', 2, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(244, 'Library', 2, 3, 1, 25000, '0000-00-00', 'Principal', 'Approved', 1),
(245, 'Examination', 2, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(246, 'Tuition', 2, 3, 1, 120000, '0000-00-00', 'Principal', 'Approved', 1),
(247, 'ICT', 1, 1, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(248, 'Library', 1, 1, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(249, 'Health', 1, 1, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(250, 'Examination', 1, 1, 1, 50000, '0000-00-00', 'Principal', 'Approved', 1),
(251, 'Tuition', 1, 1, 1, 100000, '0000-00-00', 'Principal', 'Approved', 1),
(252, 'ICT', 1, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(253, 'Libary', 1, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(254, 'Health', 1, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(255, 'Examination', 1, 2, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(256, 'Tuition', 1, 2, 1, 100000, '0000-00-00', 'Principal', 'Approved', 1),
(257, 'Health', 1, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(258, 'ICT', 1, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(259, 'Libary', 1, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(260, 'Examination', 1, 3, 1, 20000, '0000-00-00', 'Principal', 'Approved', 1),
(261, 'Tuition', 1, 3, 1, 100000, '0000-00-00', 'Principal', 'Approved', 1),
(262, 'total', 15, 1, 1, 500000, '0000-00-00', 'Principal', 'Approved', 1),
(263, 'total', 15, 2, 1, 530000, '0000-00-00', 'Principal', 'Approved', 1),
(264, 'total', 15, 3, 1, 520000, '0000-00-00', 'Principal', 'Approved', 1),
(265, 'Hostels', 15, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(266, 'Library', 15, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(267, 'Security', 15, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(268, 'Examination', 15, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(269, 'Tuition', 15, 1, 1, 200000, '0000-00-00', 'Principal', 'Approved', 1),
(270, 'Books', 15, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(271, 'Health Service', 15, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(272, 'Library', 15, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(273, 'Examination', 15, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(274, 'Tuition', 15, 2, 1, 220000, '0000-00-00', 'Principal', 'Approved', 1),
(275, 'Development Fees', 15, 3, 1, 47000, '0000-00-00', 'Principal', 'Approved', 1),
(276, 'Hostel Fees', 15, 3, 1, 10000, '0000-00-00', 'Principal', 'Approved', 1),
(277, 'PTA', 15, 3, 1, 48000, '0000-00-00', 'Principal', 'Approved', 1),
(278, 'Tution and Security', 15, 3, 1, 160000, '0000-00-00', 'Principal', 'Approved', 1),
(279, 'Health', 15, 3, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(280, 'total', 16, 1, 1, 470000, '2014-08-06', 'Principal', 'Approved', 1),
(281, 'total', 16, 2, 1, 490000, '0000-00-00', 'Principal', 'Approved', 1),
(282, 'total', 16, 3, 1, 500000, '0000-00-00', 'Principal', 'Approved', 1),
(283, 'Health Service', 16, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(284, 'External Exam', 16, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(285, 'Library', 16, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(286, 'Examination', 16, 1, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(287, 'Tuition', 16, 1, 1, 150000, '0000-00-00', 'Principal', 'Approved', 1),
(288, 'Library', 16, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(289, 'JAMB', 16, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(290, 'Health Service', 16, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(291, 'Examination', 16, 2, 1, 60000, '0000-00-00', 'Principal', 'Approved', 1),
(292, 'Tuition', 16, 2, 1, 150000, '0000-00-00', 'Principal', 'Approved', 1),
(293, 'Development Fees', 16, 3, 1, 47000, '0000-00-00', 'Principal', 'Approved', 1),
(294, 'Hostel Fees', 16, 3, 1, 10000, '0000-00-00', 'Principal', 'Approved', 1),
(295, 'PTA', 16, 3, 1, 48000, '0000-00-00', 'Principal', 'Approved', 1),
(296, 'Security', 16, 3, 1, 6800, '0000-00-00', 'Principal', 'Approved', 1),
(297, 'Tuition', 16, 3, 1, 150000, '0000-00-00', 'Principal', 'Approved', 1);

-- --------------------------------------------------------

--
-- Table structure for table `school_item_price`
--

CREATE TABLE `school_item_price` (
  `id` int(8) NOT NULL,
  `tution_code_rel_id` int(3) NOT NULL,
  `tuition_codes_domain` int(2) NOT NULL DEFAULT 0 COMMENT 'related tuition_codes_domain',
  `school_item_name` varchar(50) NOT NULL,
  `school_item_desc` varchar(60) NOT NULL,
  `school_item_price` int(8) NOT NULL,
  `school_item_quantity_left` int(3) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `school_rooms`
--

CREATE TABLE `school_rooms` (
  `school_rooms_id` int(4) UNSIGNED NOT NULL,
  `school_rooms_desc` varchar(35) DEFAULT NULL,
  `room_grade` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='every grade only had a hidden rooms, only add multiple rooms';

-- --------------------------------------------------------

--
-- Table structure for table `school_years`
--

CREATE TABLE `school_years` (
  `school_years_id` int(4) UNSIGNED NOT NULL,
  `school_years_desc` varchar(15) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `speak`
--

CREATE TABLE `speak` (
  `speak_id` int(11) UNSIGNED NOT NULL,
  `speak_teacherid` int(8) NOT NULL DEFAULT 0,
  `speak_day` int(1) NOT NULL DEFAULT 0,
  `speak_period` int(3) DEFAULT 0,
  `speak_date` varchar(30) NOT NULL,
  `speak_note` text NOT NULL,
  `speak_term` tinyint(1) NOT NULL,
  `speak_session` int(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `staff_id` int(8) UNSIGNED NOT NULL,
  `staff_fname` varchar(30) DEFAULT NULL,
  `staff_lname` varchar(30) DEFAULT NULL,
  `staff_mi` varchar(5) DEFAULT NULL,
  `staff_school` int(10) UNSIGNED DEFAULT 0 COMMENT 'select from tbl_school_domain, or set=0(select from tbl_config)',
  `staff_email` varchar(60) DEFAULT NULL,
  `staff_title` int(10) UNSIGNED DEFAULT NULL,
  `staff_status` int(2) NOT NULL COMMENT '0= not aproved, 1 = approved, 2 = Retired',
  `staff_country` varchar(5) NOT NULL,
  `staff_state` varchar(10) NOT NULL COMMENT 'select state name from tbl_state',
  `staff_dob` varchar(30) NOT NULL,
  `staff_mobile` varchar(20) NOT NULL,
  `staff_entry_year` int(9) NOT NULL,
  `staff_adress` varchar(100) NOT NULL,
  `staff_res_town` varchar(50) NOT NULL,
  `staff_res_state` varchar(10) NOT NULL COMMENT 'select from tbl_state',
  `staff_image` text NOT NULL COMMENT '/pictures',
  `staff_bank` varchar(50) NOT NULL COMMENT 'use bank id from bank table',
  `staff_account` varchar(15) NOT NULL,
  `staff_acc_name` varchar(50) NOT NULL,
  `staff_act_type` varchar(15) NOT NULL,
  `staff_bank_sort` varchar(20) NOT NULL COMMENT 'branch sort code',
  `staff_id_no` varchar(20) NOT NULL,
  `staff_sex` varchar(6) NOT NULL,
  `staff_salary_type` int(11) NOT NULL COMMENT 'select from salary ',
  `teaching_type` varchar(20) NOT NULL COMMENT 'to show if corpper or practise',
  `staff_ethnicity` int(10) NOT NULL COMMENT 'select from ethnicity',
  `staff_birth_city` varchar(50) NOT NULL,
  `staff_kin_name` varchar(50) NOT NULL,
  `staff_kin_phone` varchar(20) NOT NULL,
  `staff_kin_email` varchar(100) NOT NULL,
  `staff_kin_adress` varchar(100) NOT NULL,
  `staff_kin_relationship` int(11) NOT NULL COMMENT 'from relationship table',
  `staff_biography` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_calendar`
--

CREATE TABLE `staff_calendar` (
  `id` int(10) NOT NULL,
  `creator_id` int(8) NOT NULL,
  `event_name` varchar(25) NOT NULL,
  `start_date` varchar(35) NOT NULL,
  `end_date` varchar(35) NOT NULL,
  `event_color` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_notepad`
--

CREATE TABLE `staff_notepad` (
  `id` int(8) NOT NULL,
  `author` int(8) NOT NULL,
  `title` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `dateCreated` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_post`
--

CREATE TABLE `staff_post` (
  `id` int(10) NOT NULL,
  `poster_id` int(8) NOT NULL,
  `post_text` text NOT NULL,
  `post_image` text NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1,
  `post_date` varchar(30) NOT NULL,
  `views` int(4) NOT NULL DEFAULT 0,
  `liker_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_post_reply`
--

CREATE TABLE `staff_post_reply` (
  `id` int(10) NOT NULL,
  `post_rel_id` int(8) NOT NULL,
  `post_commenter_id` int(8) NOT NULL,
  `post_comment` text NOT NULL,
  `post_comment_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `staff_role`
--

CREATE TABLE `staff_role` (
  `id` int(8) NOT NULL,
  `staff_id` int(8) NOT NULL,
  `liberian` tinyint(1) NOT NULL DEFAULT 0,
  `discipline` tinyint(1) NOT NULL DEFAULT 0,
  `attendance` tinyint(1) NOT NULL DEFAULT 0,
  `health` tinyint(1) NOT NULL DEFAULT 0,
  `receipt` tinyint(1) NOT NULL DEFAULT 0,
  `timetable` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `std_report_cards`
--

CREATE TABLE `std_report_cards` (
  `id` int(10) NOT NULL,
  `student` int(8) NOT NULL,
  `session` int(3) NOT NULL,
  `term` int(2) NOT NULL,
  `grade` int(4) NOT NULL,
  `c_form_teacher` varchar(150) NOT NULL,
  `c_principal` varchar(150) NOT NULL,
  `check_result` tinyint(1) NOT NULL DEFAULT 0,
  `check_counter` tinyint(1) NOT NULL,
  `cog_1` int(3) NOT NULL DEFAULT 0,
  `cog_2` int(3) NOT NULL DEFAULT 0,
  `cog_3` int(3) NOT NULL DEFAULT 0,
  `cog_4` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `studentbio`
--

CREATE TABLE `studentbio` (
  `studentbio_id` int(8) UNSIGNED NOT NULL,
  `studentbio_internalid` varchar(20) NOT NULL DEFAULT '',
  `studentbio_title` int(3) NOT NULL,
  `studentbio_lname` varchar(30) NOT NULL DEFAULT '',
  `studentbio_fname` varchar(30) NOT NULL DEFAULT '',
  `studentbio_mname` varchar(20) DEFAULT NULL,
  `studentbio_generation` smallint(5) UNSIGNED DEFAULT NULL,
  `studentbio_entry_year` int(3) NOT NULL COMMENT 'which session selected from school_year that is current did he register',
  `studentbio_entry_grade` int(4) NOT NULL COMMENT 'grade at which student choose for admission',
  `studentbio_sped` smallint(5) UNSIGNED DEFAULT NULL,
  `studentbio_gender` varchar(6) NOT NULL DEFAULT '',
  `studentbio_pictures` text NOT NULL COMMENT '/pictures',
  `studentbio_ethnicity` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `studentbio_dob` varchar(30) DEFAULT NULL,
  `studentbio_birthcity` varchar(50) DEFAULT NULL,
  `studentbio_birthstate` varchar(30) DEFAULT NULL,
  `studentbio_birthcountry` varchar(5) DEFAULT NULL,
  `studentbio_prevschoolname` varchar(40) DEFAULT NULL,
  `studentbio_prevschooladdress` varchar(40) DEFAULT NULL,
  `studentbio_prevschoolcity` varchar(40) DEFAULT NULL,
  `studentbio_prevschoolstate` varchar(25) DEFAULT NULL,
  `studentbio_prevschoolzip` varchar(10) DEFAULT NULL,
  `studentbio_prevschoolcountry` varchar(5) DEFAULT NULL,
  `studentbio_school` smallint(5) UNSIGNED DEFAULT 0,
  `studentbio_homed` smallint(5) UNSIGNED DEFAULT NULL,
  `studentbio_primarycontact` smallint(5) UNSIGNED DEFAULT NULL,
  `studentbio_form_master` int(9) UNSIGNED DEFAULT NULL,
  `studentbio_bus` varchar(20) DEFAULT NULL,
  `admit` varchar(10) NOT NULL DEFAULT '0' COMMENT '0=not admited, 1=admited, 2= Graduate, 3= suspended, 4= expelled, 5= transferd, 6 withdrawn, 7 deceased',
  `std_bio_class_control` varchar(100) NOT NULL DEFAULT 'Change Grade' COMMENT 'DO NOTHING: this colum is only controlling student database grid, do not execute anything',
  `std_bio_address` varchar(100) NOT NULL,
  `std_bio_resident_town` varchar(100) NOT NULL,
  `std_bio_resident_state` varchar(30) NOT NULL,
  `std_bio_mobile` varchar(11) NOT NULL,
  `std_bio_phone` varchar(15) NOT NULL,
  `std_bio_living_with_parent` tinyint(1) NOT NULL DEFAULT 1,
  `admission_badge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_calendar`
--

CREATE TABLE `student_calendar` (
  `id` int(10) NOT NULL,
  `creator_id` int(8) NOT NULL,
  `event_name` varchar(25) NOT NULL,
  `start_date` varchar(35) NOT NULL,
  `end_date` varchar(35) NOT NULL,
  `event_color` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_contact`
--

CREATE TABLE `student_contact` (
  `studentcontact_id` int(8) UNSIGNED NOT NULL,
  `studentcontact_studentid` int(8) UNSIGNED DEFAULT NULL,
  `studentcontact_title` int(2) NOT NULL DEFAULT 0,
  `studentcontact_fname` varchar(30) DEFAULT NULL,
  `studentcontact_lname` varchar(30) DEFAULT NULL,
  `studentcontact_address1` varchar(40) DEFAULT NULL,
  `studentcontact_address2` varchar(40) DEFAULT NULL,
  `studentcontact_city` varchar(30) DEFAULT NULL,
  `studentcontact_state` varchar(30) DEFAULT NULL,
  `studentcontact_zip` varchar(10) DEFAULT NULL,
  `studentcontact_phone1` varchar(20) DEFAULT NULL,
  `studentcontact_phone2` varchar(20) DEFAULT NULL,
  `studentcontact_phone3` varchar(20) DEFAULT NULL,
  `studentcontact_email` varchar(50) DEFAULT NULL,
  `studentcontact_other` tinytext DEFAULT NULL,
  `studentcontact_relationship` smallint(5) UNSIGNED DEFAULT NULL,
  `studentcontact_year` int(3) NOT NULL DEFAULT 0,
  `studentcontact_primary` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_grade_year`
--

CREATE TABLE `student_grade_year` (
  `student_grade_year_id` int(8) UNSIGNED NOT NULL,
  `student_grade_year_student` int(8) DEFAULT NULL,
  `student_grade_year_year` int(3) UNSIGNED DEFAULT NULL,
  `student_grade_year_grade` int(3) UNSIGNED DEFAULT NULL,
  `student_grade_year_class_room` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_notepad`
--

CREATE TABLE `student_notepad` (
  `id` int(8) NOT NULL,
  `author` int(8) NOT NULL,
  `title` varchar(50) NOT NULL,
  `note` text NOT NULL,
  `dateCreated` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_office`
--

CREATE TABLE `student_office` (
  `id` int(8) NOT NULL,
  `student` int(8) NOT NULL,
  `office` int(11) NOT NULL COMMENT 'using tbl_std_office table',
  `session` int(3) NOT NULL,
  `comment` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_parents`
--

CREATE TABLE `student_parents` (
  `student_parents_id` int(8) NOT NULL,
  `student_parents_firstname` varchar(30) NOT NULL,
  `student_parents_lastname` varchar(30) NOT NULL,
  `student_parents_mi` varchar(20) NOT NULL,
  `student_parents_email` varchar(30) NOT NULL,
  `student_parents_sex` varchar(6) NOT NULL,
  `student_parents_title` int(3) NOT NULL,
  `student_parents_image` text NOT NULL COMMENT '/pictures',
  `student_parents_occupation` varchar(30) NOT NULL,
  `student_parents_contactaddress1` text NOT NULL,
  `student_parents_contactaddress2` text NOT NULL,
  `student_parents_mobile1` varchar(20) NOT NULL,
  `student_parents_mobile2` varchar(20) NOT NULL,
  `student_parents_city` varchar(20) NOT NULL,
  `student_parents_state` varchar(20) NOT NULL,
  `student_parents_country` varchar(5) NOT NULL,
  `student_parents_school` tinyint(1) NOT NULL,
  `student_parents_status` int(3) NOT NULL DEFAULT 0 COMMENT '1= verified by admin, 0 =pending, 2= no kid in school'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_post`
--

CREATE TABLE `student_post` (
  `id` int(10) NOT NULL,
  `poster_id` int(8) NOT NULL,
  `post_text` text NOT NULL,
  `post_image` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `post_date` varchar(30) NOT NULL,
  `views` int(4) NOT NULL DEFAULT 0,
  `liker_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_post_reply`
--

CREATE TABLE `student_post_reply` (
  `id` int(10) NOT NULL,
  `post_rel_id` int(8) NOT NULL,
  `post_commenter_id` int(8) NOT NULL,
  `post_comment` text NOT NULL,
  `post_comment_date` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_wallet`
--

CREATE TABLE `student_wallet` (
  `id` int(8) NOT NULL,
  `student_id` int(8) NOT NULL,
  `balance` int(8) NOT NULL,
  `date_last_used` varchar(30) NOT NULL,
  `status` int(1) NOT NULL DEFAULT 1 COMMENT 'for freezing the wallet, 0 means freezed'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `student_wallet_pins`
--

CREATE TABLE `student_wallet_pins` (
  `id` int(10) NOT NULL,
  `codec` varchar(50) NOT NULL,
  `sn` varchar(50) NOT NULL,
  `description` varchar(50) NOT NULL,
  `amount` int(8) NOT NULL,
  `creation` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `used_by` int(8) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admission`
--

CREATE TABLE `tbl_admission` (
  `id` int(11) NOT NULL,
  `badge_name` varchar(50) NOT NULL COMMENT 'eg. September 2014 A',
  `application_starts` varchar(20) NOT NULL,
  `application_ends` varchar(20) NOT NULL,
  `interview_date` varchar(20) NOT NULL,
  `interview_time` varchar(20) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT 1,
  `instruction` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admit_code`
--

CREATE TABLE `tbl_admit_code` (
  `id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_admit_code`
--

INSERT INTO `tbl_admit_code` (`id`, `title`) VALUES
(1, 'Admitted'),
(2, 'Graduate'),
(3, 'Suspended'),
(4, 'Expelled'),
(5, 'Transfered'),
(6, 'Withdrawn'),
(7, 'Deceased'),
(8, 'Unknown'),
(9, 'Not Admitted');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_app_config`
--

CREATE TABLE `tbl_app_config` (
  `id` int(11) NOT NULL,
  `module` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  `detail` varchar(300) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `api_user` varchar(50) NOT NULL COMMENT 'same as api id',
  `api_pass` varchar(50) NOT NULL COMMENT 'same as api secret',
  `api_def` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_app_config`
--

INSERT INTO `tbl_app_config` (`id`, `module`, `type`, `description`, `detail`, `status`, `api_user`, `api_pass`, `api_def`) VALUES
(1, 'student_registration', 'registration', 'Old Student Registration', 'Enabling this Will allow old students to Register ion the portal', 1, '', '', ''),
(2, 'student_discussion', 'main', 'Student Discussions', 'When enables, students can post and chat with themselves', 1, '', '', ''),
(3, 'student_login', 'login', 'Student Login', 'When Enabled, students will be allowed to log in', 1, '', '', ''),
(4, 'staff_registration', 'registration', 'Staff Registration', 'When enabled, new Staff can register him or herself', 1, '', '', ''),
(5, 'staff_discussion', 'main', 'Staff Discussion', 'When enabled, staff will be allowed to post and chat with themselves', 1, '', '', ''),
(6, 'staff_login', 'login', 'Staff Login', 'When enabled, staff will be able to log in', 1, '', '', ''),
(8, 'paypal_api', 'main', 'Paypal API', '', 0, '', '', ''),
(9, 'sms_api', 'api', 'Bulk SMS API', '<a href=\"http://sms.ifihear.com\">GET API </a>', 1, 'usernamw', 'password', 'sms.ifihear.com'),
(10, 'google_map', 'api', 'Google Map API', 'API to show your location in your website, copy your map url and paste it inside definitions', 1, '', '', 'http://'),
(11, 'smtp', 'api', 'SMTP Details', 'Simple Mail Transfer Protocol: enable you to send email: Instruction the API definition = SMTP serve', 1, '', '', ''),
(13, 'facebook_app', 'api', 'Facebook APP', 'API definition is serving as the app url', 1, '', '', ''),
(14, 'maintenance_mode', 'main', 'Maintenance Mode', 'When this is turned on, the portal puts itself to maintenence mode', 0, '', '', ''),
(15, 'parent_login', 'login', 'Parent Login ', 'When this is enabled, parents can log in', 1, '', '', ''),
(16, 'parent_registration', 'registration', 'Parent Registration', 'When this is Enabled, new Parents can register', 1, '', '', ''),
(17, 'student_result_checking', 'main', 'Student Result Checking Portal Enable/Disable', 'if this is open, the students can check their result else they cant', 1, '', '', ''),
(18, 'student_result_uploading', 'main', 'Staff Result Uploading', 'When enabled, Staff have the privilege to upload result', 1, '', '', ''),
(19, 'result_note', 'main', 'Show result note', 'When enabled, note will show on result', 1, '', '', ''),
(20, 'result_comment', 'main', 'Result Comment', 'when open, result comment will be shown', 1, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_automatics`
--

CREATE TABLE `tbl_automatics` (
  `id` int(11) NOT NULL,
  `autoid` varchar(50) NOT NULL,
  `value` varchar(50) NOT NULL,
  `string` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='defines automation in the portal';

--
-- Dumping data for table `tbl_automatics`
--

INSERT INTO `tbl_automatics` (`id`, `autoid`, `value`, `string`, `status`) VALUES
(1, 'principal_comment_f', 'Bad result', '', '1'),
(2, 'principal_comment_e', 'Bad results', '', '1'),
(3, 'principal_comment_d', 'Student needs extra help with homework.', '', ''),
(4, 'principal_comment_c', 'Student needs extra help with homework.', '', ''),
(5, 'principal_comment_b', 'Always does quality work.', '', ''),
(6, 'principal_comment_a', 'A truly excellent student.', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_barned_words`
--

CREATE TABLE `tbl_barned_words` (
  `id` int(11) NOT NULL,
  `word_names` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_barned_words`
--

INSERT INTO `tbl_barned_words` (`id`, `word_names`) VALUES
(1, 'Sex'),
(3, 'Fuck');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_config`
--

CREATE TABLE `tbl_config` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `school_name` varchar(50) NOT NULL,
  `current_year` int(10) UNSIGNED DEFAULT NULL,
  `messageto_staff` tinytext DEFAULT NULL,
  `messageto_parents` tinytext DEFAULT NULL,
  `messageto_students` tinytext NOT NULL,
  `messageto_all` tinytext DEFAULT NULL,
  `default_city` varchar(30) DEFAULT NULL,
  `default_state` varchar(30) DEFAULT NULL,
  `default_zip` varchar(10) DEFAULT NULL,
  `default_entry_date` varchar(10) DEFAULT NULL,
  `portal_launch_date` varchar(10) NOT NULL,
  `school_logo_path` varchar(100) NOT NULL COMMENT 'files/image',
  `school_badge_path` varchar(100) NOT NULL COMMENT '/files/images',
  `school_bar_code_app` varchar(100) NOT NULL COMMENT 'files/images',
  `app_membership` int(1) NOT NULL DEFAULT 0 COMMENT 'set to one for school that have put MySchoolApp Logo in their school',
  `school_app_version` varchar(20) NOT NULL,
  `school_app_framework` varchar(20) NOT NULL,
  `portal_url` varchar(50) NOT NULL,
  `app_licence` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_config`
--

INSERT INTO `tbl_config` (`id`, `school_name`, `current_year`, `messageto_staff`, `messageto_parents`, `messageto_students`, `messageto_all`, `default_city`, `default_state`, `default_zip`, `default_entry_date`, `portal_launch_date`, `school_logo_path`, `school_badge_path`, `school_bar_code_app`, `app_membership`, `school_app_version`, `school_app_framework`, `portal_url`, `app_licence`) VALUES
(1, 'MY SCHOOL PORTAL', 0, 'Welcome great Staff', 'Welcome Super parent     ', 'welcome students', 'welcome all', 'Abuja ', 'Abuja', '05896 ', '12/27/2014', '09/12/2015', '1515403650_lb_kasTech_large.png', '1515403647_lb_kasTech_large.png', 'qrcode.png', 0, '1.8.0', 'p7', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_days`
--

CREATE TABLE `tbl_days` (
  `days_id` tinyint(1) UNSIGNED NOT NULL,
  `days_desc` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_days`
--

INSERT INTO `tbl_days` (`days_id`, `days_desc`) VALUES
(1, 'Monday'),
(2, 'Tuesday'),
(3, 'Wednesday'),
(4, 'Thursday'),
(5, 'Friday'),
(6, 'Saturday'),
(7, 'Sunday');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_grade_domains`
--

CREATE TABLE `tbl_grade_domains` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `school_names` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `school_logo_path` varchar(50) NOT NULL COMMENT '/files/images',
  `school_badge_path` varchar(50) NOT NULL COMMENT '/files/images',
  `address` text NOT NULL,
  `term_result_fee` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_grade_domains`
--

INSERT INTO `tbl_grade_domains` (`id`, `school_names`, `status`, `school_logo_path`, `school_badge_path`, `address`, `term_result_fee`) VALUES
(1, 'Pre-nursery School', 0, 'terans.png', 'nsbadge.png', 'First Building', 0),
(2, 'Nursery School', 0, 'terans.png', 'nsbadge.png', 'First Building', 0),
(3, 'Primary School', 0, 'teraps.png', 'psbadge.png', 'First Floor', 0),
(4, 'Junior Secondary School', 0, 'terajss.png', 'jssbadge.png', 'Junior Block', 0),
(5, 'Senior Secondary School', 0, 'terasss.png', 'ssbadge.png', 'Main Building', 0);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_portal_emails`
--

CREATE TABLE `tbl_portal_emails` (
  `id` int(10) NOT NULL,
  `from_email` varchar(50) NOT NULL,
  `sender_type` varchar(3) NOT NULL COMMENT 'A=student, B= staff, C = parent, D=public',
  `from_name` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `date` varchar(20) NOT NULL,
  `status` int(2) NOT NULL COMMENT '1=read'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_salaries`
--

CREATE TABLE `tbl_salaries` (
  `id` int(200) NOT NULL,
  `staff_type` varchar(200) NOT NULL,
  `amount` int(200) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `code` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_domains`
--

CREATE TABLE `tbl_school_domains` (
  `id` tinyint(1) UNSIGNED NOT NULL,
  `school_names` varchar(100) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `school_logo_path` varchar(50) NOT NULL COMMENT '/files/images',
  `school_badge_path` varchar(50) NOT NULL COMMENT '/files/images',
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_school_profile`
--

CREATE TABLE `tbl_school_profile` (
  `id` tinyint(1) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `fax` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `mobile` varchar(11) NOT NULL,
  `adress` varchar(100) NOT NULL,
  `state` varchar(25) NOT NULL,
  `latitude` varchar(50) NOT NULL,
  `longitude` varchar(50) NOT NULL,
  `country` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_school_profile`
--

INSERT INTO `tbl_school_profile` (`id`, `phone`, `fax`, `email`, `mobile`, `adress`, `state`, `latitude`, `longitude`, `country`) VALUES
(1, '', '', 'info@--------.com', '00000000', 'Plot 7 Ave Mariah Street, Opposite Airport ', 'Abuja', '', '', 'Nigeria ');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_states`
--

CREATE TABLE `tbl_states` (
  `state_code` char(10) NOT NULL DEFAULT '',
  `state_css` varchar(20) NOT NULL,
  `state_name` varchar(30) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_states`
--

INSERT INTO `tbl_states` (`state_code`, `state_css`, `state_name`) VALUES
('ab', 'Abia', 'Abia'),
('abj', 'FCT', 'Abuja'),
('ada', 'Adamawa', 'Adamawa'),
('ak', 'Akwa-ibom', 'Akwa-ibom'),
('ana', 'Anambra', 'Anambra'),
('ba', 'Bauchi', 'Bauchi'),
('bay', 'Bayelsa', 'Bayelsa'),
('be', 'Benue', 'Benue'),
('bo', 'Borno', 'Borno'),
('cr', 'Cross-River', 'Cross-River'),
('de', 'Delta', 'Delta'),
('eb', 'Ebonyi', 'Ebonyi'),
('ed', 'Edo', 'Edo'),
('ek', 'Ekiti', 'Ekiti'),
('en', 'Enugu', 'Enugu'),
('foreign', 'foreign', 'International'),
('go', 'Gombe', 'Gombe'),
('im', 'Imo', 'Imo'),
('jig', 'Jigawa', 'Jigawa'),
('ka', 'Kano', 'Kano'),
('kad', 'Kaduna', 'Kaduna'),
('kas', 'Kastina', 'Kastina'),
('keb', 'Kebbi', 'Kebbi'),
('ko', 'Kogi', 'Kogi'),
('kw', 'Kwara', 'Kwara'),
('la', 'Lagos', 'Lagos'),
('na', 'Nasarawa', 'Nasarawa'),
('ni', 'Niger', 'Niger'),
('og', 'Ogun', 'Ogun'),
('on', 'Ondo', 'Ondo'),
('os', 'Osun', 'Osun'),
('oy', 'Oyo', 'Oyo'),
('pl', 'Plateau', 'Plateau'),
('rv', 'Rivers', 'Rivers'),
('sk', 'Sokoto', 'Sokoto'),
('tb', 'Taraba', 'Taraba'),
('yb', 'Yobe', 'Yobe'),
('za', 'Zamfara', 'Zamfara'),
('zz', 'Zzz - Not Listed', 'Zzz - Not Listed');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_std_denomination`
--

CREATE TABLE `tbl_std_denomination` (
  `id` int(2) NOT NULL,
  `deno` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_std_denomination`
--

INSERT INTO `tbl_std_denomination` (`id`, `deno`) VALUES
(1, 'Sciences'),
(2, 'Art'),
(3, 'Commercial'),
(4, 'Nursery'),
(5, 'Primary');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_std_offices`
--

CREATE TABLE `tbl_std_offices` (
  `office_id` int(200) NOT NULL,
  `office_desc` varchar(200) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_std_offices`
--

INSERT INTO `tbl_std_offices` (`office_id`, `office_desc`, `status`) VALUES
(1, 'Senior Prefect', 1),
(2, 'Labor prefect', 1),
(3, 'Head Boy', 1),
(4, 'Head Girl', 1),
(5, 'Sports Man', 1),
(6, 'Sports Woman', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_titles`
--

CREATE TABLE `tbl_titles` (
  `title_id` int(2) UNSIGNED NOT NULL,
  `title_desc` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_titles`
--

INSERT INTO `tbl_titles` (`title_id`, `title_desc`) VALUES
(1, 'Mr.'),
(2, 'Provost'),
(3, 'Professor'),
(4, 'Mrs'),
(5, 'Master'),
(6, 'Miss'),
(7, 'Doctor'),
(8, 'Barrister'),
(9, 'Coloniel'),
(10, 'Engineer'),
(11, 'Madam'),
(12, 'Senator'),
(13, 'Governor'),
(14, 'Ambassador'),
(15, 'President'),
(16, 'Governor'),
(17, 'Councillor'),
(18, 'Envagelist'),
(19, 'Prelate'),
(20, 'Reverend'),
(21, 'Pastor'),
(22, 'Bishop'),
(23, 'Prince'),
(24, 'Princess'),
(25, 'King'),
(26, 'Queen'),
(27, 'Lord'),
(28, 'Dame'),
(29, 'Advocate'),
(30, 'Justice'),
(31, 'Pope'),
(32, 'General'),
(33, 'Brigadier'),
(34, 'Captain'),
(35, 'Officer'),
(36, 'Oba'),
(37, 'Eze'),
(38, 'Obi'),
(39, 'Elder'),
(40, 'Chancellor');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_grade_year`
--

CREATE TABLE `teacher_grade_year` (
  `id` int(8) NOT NULL,
  `teacher` int(8) NOT NULL,
  `session` int(3) NOT NULL,
  `grade_class` int(3) NOT NULL DEFAULT 0,
  `grade_class_room` int(3) NOT NULL DEFAULT 0,
  `main_teacher` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher_schedule`
--

CREATE TABLE `teacher_schedule` (
  `teacher_schedule_id` int(10) NOT NULL,
  `teacher_schedule_year` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_schoolid` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_teacherid` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_subjectid` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_termid` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_classperiod` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_days` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_grade` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_room` int(3) NOT NULL DEFAULT 0,
  `teacher_schedule_type` int(2) NOT NULL DEFAULT 0,
  `teacher_schedule_subject_grade` varchar(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tuition_codes`
--

CREATE TABLE `tuition_codes` (
  `tuition_codes_id` tinyint(2) NOT NULL,
  `tuition_codes_desc` varchar(25) NOT NULL COMMENT 'icons in /files/images/tuitioncode'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COMMENT='under no circumstances will this table change, only rows add';

--
-- Dumping data for table `tuition_codes`
--

INSERT INTO `tuition_codes` (`tuition_codes_id`, `tuition_codes_desc`) VALUES
(1, 'School Fees'),
(2, 'Hostel'),
(3, 'Books'),
(4, 'Meals '),
(5, 'Clothes'),
(6, 'Shoes'),
(7, 'Medication'),
(8, 'Reparation'),
(9, 'Stationary'),
(10, 'Result Check');

-- --------------------------------------------------------

--
-- Table structure for table `tuition_codes_domain`
--

CREATE TABLE `tuition_codes_domain` (
  `tuition_codes_domain_id` int(8) NOT NULL,
  `tuition_codes_domain_name` varchar(30) NOT NULL,
  `tuition_codes_domain_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_parents`
--

CREATE TABLE `web_parents` (
  `web_parents_id` int(8) UNSIGNED NOT NULL,
  `web_parents_type` char(2) DEFAULT NULL COMMENT 'A=master admin, B=admin, T= teacher, C= parent, S= non teaching staff, Ty= nysc, Tp=practising teacher, Tl= lesson teacher',
  `web_parents_relid` int(8) UNSIGNED DEFAULT NULL COMMENT 'inserted rows from student_parent.id',
  `web_parents_username` varchar(15) DEFAULT NULL,
  `web_parents_password` varchar(50) DEFAULT NULL,
  `web_parents_flname` varchar(60) DEFAULT NULL,
  `web_parents_active` varchar(12) NOT NULL COMMENT 'email verification',
  `online` tinyint(1) NOT NULL,
  `last_log` varchar(50) NOT NULL COMMENT 'sample dd/mm/yyy 04:44:33'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_students`
--

CREATE TABLE `web_students` (
  `id` int(8) NOT NULL,
  `stdbio_id` int(8) NOT NULL COMMENT 'inserted row from studentbio.id',
  `identify` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `user_n` varchar(20) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  `reg_date` varchar(30) NOT NULL COMMENT 'current date stamp',
  `admission_badge` int(11) NOT NULL DEFAULT 1,
  `form_no` varchar(20) NOT NULL,
  `denomination` tinyint(2) NOT NULL DEFAULT 0,
  `last_log` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `web_users`
--

CREATE TABLE `web_users` (
  `web_users_id` int(8) UNSIGNED NOT NULL,
  `web_users_type` char(2) DEFAULT NULL COMMENT 'A=master admin, B=admin, T= teacher, C= parent, S= non teaching staff, Ty= nysc, Tp=practising teacher, Tl= lesson teacher, X=principal, Xp=vice principal, Y= director, Z=Developer, Yp=propritor',
  `web_users_relid` int(8) UNSIGNED DEFAULT NULL COMMENT 'inserted rows() from staff.id',
  `web_users_username` varchar(15) DEFAULT NULL,
  `web_users_password` varchar(50) DEFAULT NULL,
  `web_users_flname` varchar(60) DEFAULT NULL,
  `web_users_active` varchar(12) NOT NULL COMMENT 'email verification',
  `online` tinyint(1) NOT NULL,
  `last_log` varchar(50) NOT NULL COMMENT 'sample dd/mm/yyy 04:44:33'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `web_users`
--

INSERT INTO `web_users` (`web_users_id`, `web_users_type`, `web_users_relid`, `web_users_username`, `web_users_password`, `web_users_flname`, `web_users_active`, `online`, `last_log`) VALUES
(1, 'A', 0, 'admin', '2b1b22f52a1ae855298b6e9fe24cbdcf', 'Benjamin', '1', 0, '02/10/2015 18:04:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance_codes`
--
ALTER TABLE `attendance_codes`
  ADD PRIMARY KEY (`attendance_codes_id`);

--
-- Indexes for table `attendance_history`
--
ALTER TABLE `attendance_history`
  ADD PRIMARY KEY (`attendance_history_id`),
  ADD KEY `attendance_history_student_ndx` (`attendance_history_student`);

--
-- Indexes for table `bank`
--
ALTER TABLE `bank`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bulk_sms_store`
--
ALTER TABLE `bulk_sms_store`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classnote`
--
ALTER TABLE `classnote`
  ADD PRIMARY KEY (`classnote_id`);

--
-- Indexes for table `cognitive_domain`
--
ALTER TABLE `cognitive_domain`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discipline_history`
--
ALTER TABLE `discipline_history`
  ADD PRIMARY KEY (`discipline_history_id`),
  ADD KEY `discipline_history_student_ndx` (`discipline_history_student`);

--
-- Indexes for table `ethnicity`
--
ALTER TABLE `ethnicity`
  ADD PRIMARY KEY (`ethnicity_id`);

--
-- Indexes for table `exams_types`
--
ALTER TABLE `exams_types`
  ADD PRIMARY KEY (`exams_types_id`),
  ADD UNIQUE KEY `exams_types_desc` (`exams_types_desc`);

--
-- Indexes for table `forum_answer`
--
ALTER TABLE `forum_answer`
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `forum_question`
--
ALTER TABLE `forum_question`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_mailing`
--
ALTER TABLE `general_mailing`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `generations`
--
ALTER TABLE `generations`
  ADD PRIMARY KEY (`generations_id`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`grades_id`);

--
-- Indexes for table `grades_domain`
--
ALTER TABLE `grades_domain`
  ADD PRIMARY KEY (`grades_domain_desc`),
  ADD UNIQUE KEY `grades_domain_id` (`grades_domain_id`);

--
-- Indexes for table `grade_history_primary`
--
ALTER TABLE `grade_history_primary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `grade_subjects`
--
ALTER TABLE `grade_subjects`
  ADD PRIMARY KEY (`grade_subject_id`),
  ADD UNIQUE KEY `grade_subject_desc` (`grade_subject_desc`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `grade_terms`
--
ALTER TABLE `grade_terms`
  ADD PRIMARY KEY (`grade_terms_id`);

--
-- Indexes for table `grade_terms_days`
--
ALTER TABLE `grade_terms_days`
  ADD PRIMARY KEY (`grade_terms_days_id`);

--
-- Indexes for table `health_allergy`
--
ALTER TABLE `health_allergy`
  ADD PRIMARY KEY (`health_allergy_id`),
  ADD UNIQUE KEY `health_allergy_desc` (`health_allergy_desc`);

--
-- Indexes for table `health_allergy_history`
--
ALTER TABLE `health_allergy_history`
  ADD PRIMARY KEY (`health_allergy_history_id`);

--
-- Indexes for table `health_codes`
--
ALTER TABLE `health_codes`
  ADD PRIMARY KEY (`health_codes_id`),
  ADD UNIQUE KEY `health_codes_desc` (`health_codes_desc`);

--
-- Indexes for table `health_history`
--
ALTER TABLE `health_history`
  ADD PRIMARY KEY (`health_history_id`),
  ADD KEY `discipline_history_student_ndx` (`health_history_student`);

--
-- Indexes for table `health_immunz`
--
ALTER TABLE `health_immunz`
  ADD PRIMARY KEY (`health_immunz_id`);

--
-- Indexes for table `health_immunz_history`
--
ALTER TABLE `health_immunz_history`
  ADD PRIMARY KEY (`health_immunz_history_id`);

--
-- Indexes for table `health_medicine`
--
ALTER TABLE `health_medicine`
  ADD PRIMARY KEY (`health_medicine_id`),
  ADD UNIQUE KEY `health_medicine_desc` (`health_medicine_desc`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`homework_id`);

--
-- Indexes for table `hostels`
--
ALTER TABLE `hostels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels_allocation`
--
ALTER TABLE `hostels_allocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels_bed_space`
--
ALTER TABLE `hostels_bed_space`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels_fees`
--
ALTER TABLE `hostels_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels_tbl_ability`
--
ALTER TABLE `hostels_tbl_ability`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels_tbl_series`
--
ALTER TABLE `hostels_tbl_series`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hostels_tbl_types`
--
ALTER TABLE `hostels_tbl_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infraction_codes`
--
ALTER TABLE `infraction_codes`
  ADD PRIMARY KEY (`infraction_codes_id`);

--
-- Indexes for table `media_codes`
--
ALTER TABLE `media_codes`
  ADD PRIMARY KEY (`media_codes_id`);

--
-- Indexes for table `media_history`
--
ALTER TABLE `media_history`
  ADD PRIMARY KEY (`media_history_id`),
  ADD KEY `discipline_history_student_ndx` (`media_history_borrower`);

--
-- Indexes for table `parent_to_kids`
--
ALTER TABLE `parent_to_kids`
  ADD PRIMARY KEY (`parent_to_kids_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- Indexes for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  ADD PRIMARY KEY (`tuition_history_id`),
  ADD KEY `tution_paid_type` (`tution_paid_type`);

--
-- Indexes for table `payment_recharge_receipts`
--
ALTER TABLE `payment_recharge_receipts`
  ADD PRIMARY KEY (`tuition_history_id`);

--
-- Indexes for table `reg_pins`
--
ALTER TABLE `reg_pins`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`codec`),
  ADD UNIQUE KEY `serial` (`sn`);

--
-- Indexes for table `reg_pins_old`
--
ALTER TABLE `reg_pins_old`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pin` (`codec`),
  ADD UNIQUE KEY `serial` (`sn`);

--
-- Indexes for table `relations_codes`
--
ALTER TABLE `relations_codes`
  ADD PRIMARY KEY (`relation_codes_id`);

--
-- Indexes for table `school_calendar`
--
ALTER TABLE `school_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_class_periods`
--
ALTER TABLE `school_class_periods`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `periods` (`periods`);

--
-- Indexes for table `school_fees`
--
ALTER TABLE `school_fees`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_fees_default`
--
ALTER TABLE `school_fees_default`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_item_price`
--
ALTER TABLE `school_item_price`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_rooms`
--
ALTER TABLE `school_rooms`
  ADD PRIMARY KEY (`school_rooms_id`);

--
-- Indexes for table `school_years`
--
ALTER TABLE `school_years`
  ADD PRIMARY KEY (`school_years_id`);

--
-- Indexes for table `speak`
--
ALTER TABLE `speak`
  ADD PRIMARY KEY (`speak_id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`staff_id`),
  ADD UNIQUE KEY `staff_email` (`staff_email`);

--
-- Indexes for table `staff_calendar`
--
ALTER TABLE `staff_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_notepad`
--
ALTER TABLE `staff_notepad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_post`
--
ALTER TABLE `staff_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_post_reply`
--
ALTER TABLE `staff_post_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff_role`
--
ALTER TABLE `staff_role`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_report_cards`
--
ALTER TABLE `std_report_cards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `studentbio`
--
ALTER TABLE `studentbio`
  ADD PRIMARY KEY (`studentbio_id`),
  ADD UNIQUE KEY `studentbio_internalid_3` (`studentbio_internalid`),
  ADD KEY `studentbio_internalidndx` (`studentbio_internalid`),
  ADD KEY `studentbio_internalid` (`studentbio_internalid`),
  ADD KEY `studentbio_internalid_2` (`studentbio_internalid`);

--
-- Indexes for table `student_calendar`
--
ALTER TABLE `student_calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_contact`
--
ALTER TABLE `student_contact`
  ADD PRIMARY KEY (`studentcontact_id`),
  ADD KEY `studentcontact_studentidndx` (`studentcontact_studentid`);

--
-- Indexes for table `student_grade_year`
--
ALTER TABLE `student_grade_year`
  ADD PRIMARY KEY (`student_grade_year_id`);

--
-- Indexes for table `student_notepad`
--
ALTER TABLE `student_notepad`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_office`
--
ALTER TABLE `student_office`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_parents`
--
ALTER TABLE `student_parents`
  ADD PRIMARY KEY (`student_parents_id`);

--
-- Indexes for table `student_post`
--
ALTER TABLE `student_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_post_reply`
--
ALTER TABLE `student_post_reply`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_wallet`
--
ALTER TABLE `student_wallet`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_wallet_pins`
--
ALTER TABLE `student_wallet_pins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_admit_code`
--
ALTER TABLE `tbl_admit_code`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_app_config`
--
ALTER TABLE `tbl_app_config`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `module` (`module`);

--
-- Indexes for table `tbl_automatics`
--
ALTER TABLE `tbl_automatics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_barned_words`
--
ALTER TABLE `tbl_barned_words`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_config`
--
ALTER TABLE `tbl_config`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_days`
--
ALTER TABLE `tbl_days`
  ADD PRIMARY KEY (`days_id`);

--
-- Indexes for table `tbl_grade_domains`
--
ALTER TABLE `tbl_grade_domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_portal_emails`
--
ALTER TABLE `tbl_portal_emails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_salaries`
--
ALTER TABLE `tbl_salaries`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `staff_type` (`staff_type`);

--
-- Indexes for table `tbl_school_domains`
--
ALTER TABLE `tbl_school_domains`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_school_profile`
--
ALTER TABLE `tbl_school_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_states`
--
ALTER TABLE `tbl_states`
  ADD PRIMARY KEY (`state_code`),
  ADD UNIQUE KEY `state_code` (`state_code`);

--
-- Indexes for table `tbl_std_denomination`
--
ALTER TABLE `tbl_std_denomination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_std_offices`
--
ALTER TABLE `tbl_std_offices`
  ADD UNIQUE KEY `office_id` (`office_id`);

--
-- Indexes for table `tbl_titles`
--
ALTER TABLE `tbl_titles`
  ADD PRIMARY KEY (`title_id`);

--
-- Indexes for table `teacher_grade_year`
--
ALTER TABLE `teacher_grade_year`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  ADD PRIMARY KEY (`teacher_schedule_id`);

--
-- Indexes for table `tuition_codes`
--
ALTER TABLE `tuition_codes`
  ADD PRIMARY KEY (`tuition_codes_id`),
  ADD KEY `tuition_codes_id` (`tuition_codes_id`);

--
-- Indexes for table `tuition_codes_domain`
--
ALTER TABLE `tuition_codes_domain`
  ADD PRIMARY KEY (`tuition_codes_domain_id`),
  ADD UNIQUE KEY `tuition_codes_domain_name` (`tuition_codes_domain_name`);

--
-- Indexes for table `web_parents`
--
ALTER TABLE `web_parents`
  ADD PRIMARY KEY (`web_parents_id`),
  ADD UNIQUE KEY `web_parents_username` (`web_parents_username`);

--
-- Indexes for table `web_students`
--
ALTER TABLE `web_students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identify` (`identify`),
  ADD UNIQUE KEY `user_n` (`user_n`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `web_users`
--
ALTER TABLE `web_users`
  ADD PRIMARY KEY (`web_users_id`),
  ADD UNIQUE KEY `web_users_username` (`web_users_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance_codes`
--
ALTER TABLE `attendance_codes`
  MODIFY `attendance_codes_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `attendance_history`
--
ALTER TABLE `attendance_history`
  MODIFY `attendance_history_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank`
--
ALTER TABLE `bank`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `bulk_sms_store`
--
ALTER TABLE `bulk_sms_store`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `classnote`
--
ALTER TABLE `classnote`
  MODIFY `classnote_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cognitive_domain`
--
ALTER TABLE `cognitive_domain`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `discipline_history`
--
ALTER TABLE `discipline_history`
  MODIFY `discipline_history_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `ethnicity`
--
ALTER TABLE `ethnicity`
  MODIFY `ethnicity_id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=109;

--
-- AUTO_INCREMENT for table `exams_types`
--
ALTER TABLE `exams_types`
  MODIFY `exams_types_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `forum_question`
--
ALTER TABLE `forum_question`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `general_mailing`
--
ALTER TABLE `general_mailing`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `generations`
--
ALTER TABLE `generations`
  MODIFY `generations_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `grades_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `grades_domain`
--
ALTER TABLE `grades_domain`
  MODIFY `grades_domain_id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `grade_history_primary`
--
ALTER TABLE `grade_history_primary`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grade_subjects`
--
ALTER TABLE `grade_subjects`
  MODIFY `grade_subject_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `grade_terms`
--
ALTER TABLE `grade_terms`
  MODIFY `grade_terms_id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `grade_terms_days`
--
ALTER TABLE `grade_terms_days`
  MODIFY `grade_terms_days_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_allergy`
--
ALTER TABLE `health_allergy`
  MODIFY `health_allergy_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `health_allergy_history`
--
ALTER TABLE `health_allergy_history`
  MODIFY `health_allergy_history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_codes`
--
ALTER TABLE `health_codes`
  MODIFY `health_codes_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=49;

--
-- AUTO_INCREMENT for table `health_history`
--
ALTER TABLE `health_history`
  MODIFY `health_history_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_immunz`
--
ALTER TABLE `health_immunz`
  MODIFY `health_immunz_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `health_immunz_history`
--
ALTER TABLE `health_immunz_history`
  MODIFY `health_immunz_history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `health_medicine`
--
ALTER TABLE `health_medicine`
  MODIFY `health_medicine_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=36;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `homework_id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels`
--
ALTER TABLE `hostels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels_allocation`
--
ALTER TABLE `hostels_allocation`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels_bed_space`
--
ALTER TABLE `hostels_bed_space`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels_fees`
--
ALTER TABLE `hostels_fees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels_tbl_ability`
--
ALTER TABLE `hostels_tbl_ability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels_tbl_series`
--
ALTER TABLE `hostels_tbl_series`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hostels_tbl_types`
--
ALTER TABLE `hostels_tbl_types`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `infraction_codes`
--
ALTER TABLE `infraction_codes`
  MODIFY `infraction_codes_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `media_codes`
--
ALTER TABLE `media_codes`
  MODIFY `media_codes_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `media_history`
--
ALTER TABLE `media_history`
  MODIFY `media_history_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parent_to_kids`
--
ALTER TABLE `parent_to_kids`
  MODIFY `parent_to_kids_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_receipts`
--
ALTER TABLE `payment_receipts`
  MODIFY `tuition_history_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `payment_recharge_receipts`
--
ALTER TABLE `payment_recharge_receipts`
  MODIFY `tuition_history_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg_pins`
--
ALTER TABLE `reg_pins`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `reg_pins_old`
--
ALTER TABLE `reg_pins_old`
  MODIFY `id` bigint(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `relations_codes`
--
ALTER TABLE `relations_codes`
  MODIFY `relation_codes_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `school_calendar`
--
ALTER TABLE `school_calendar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_class_periods`
--
ALTER TABLE `school_class_periods`
  MODIFY `id` int(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `school_fees`
--
ALTER TABLE `school_fees`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_fees_default`
--
ALTER TABLE `school_fees_default`
  MODIFY `id` bigint(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `school_item_price`
--
ALTER TABLE `school_item_price`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_rooms`
--
ALTER TABLE `school_rooms`
  MODIFY `school_rooms_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `school_years`
--
ALTER TABLE `school_years`
  MODIFY `school_years_id` int(4) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `speak`
--
ALTER TABLE `speak`
  MODIFY `speak_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `staff_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_calendar`
--
ALTER TABLE `staff_calendar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_notepad`
--
ALTER TABLE `staff_notepad`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_post`
--
ALTER TABLE `staff_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_post_reply`
--
ALTER TABLE `staff_post_reply`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff_role`
--
ALTER TABLE `staff_role`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `std_report_cards`
--
ALTER TABLE `std_report_cards`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `studentbio`
--
ALTER TABLE `studentbio`
  MODIFY `studentbio_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_calendar`
--
ALTER TABLE `student_calendar`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_contact`
--
ALTER TABLE `student_contact`
  MODIFY `studentcontact_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_grade_year`
--
ALTER TABLE `student_grade_year`
  MODIFY `student_grade_year_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_notepad`
--
ALTER TABLE `student_notepad`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_office`
--
ALTER TABLE `student_office`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_parents`
--
ALTER TABLE `student_parents`
  MODIFY `student_parents_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_post`
--
ALTER TABLE `student_post`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_post_reply`
--
ALTER TABLE `student_post_reply`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_wallet`
--
ALTER TABLE `student_wallet`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_wallet_pins`
--
ALTER TABLE `student_wallet_pins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admission`
--
ALTER TABLE `tbl_admission`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admit_code`
--
ALTER TABLE `tbl_admit_code`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `tbl_app_config`
--
ALTER TABLE `tbl_app_config`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tbl_automatics`
--
ALTER TABLE `tbl_automatics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_barned_words`
--
ALTER TABLE `tbl_barned_words`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_config`
--
ALTER TABLE `tbl_config`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_days`
--
ALTER TABLE `tbl_days`
  MODIFY `days_id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_grade_domains`
--
ALTER TABLE `tbl_grade_domains`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_portal_emails`
--
ALTER TABLE `tbl_portal_emails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_salaries`
--
ALTER TABLE `tbl_salaries`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_school_domains`
--
ALTER TABLE `tbl_school_domains`
  MODIFY `id` tinyint(1) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_school_profile`
--
ALTER TABLE `tbl_school_profile`
  MODIFY `id` tinyint(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_std_denomination`
--
ALTER TABLE `tbl_std_denomination`
  MODIFY `id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_std_offices`
--
ALTER TABLE `tbl_std_offices`
  MODIFY `office_id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_titles`
--
ALTER TABLE `tbl_titles`
  MODIFY `title_id` int(2) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `teacher_grade_year`
--
ALTER TABLE `teacher_grade_year`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `teacher_schedule`
--
ALTER TABLE `teacher_schedule`
  MODIFY `teacher_schedule_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tuition_codes`
--
ALTER TABLE `tuition_codes`
  MODIFY `tuition_codes_id` tinyint(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tuition_codes_domain`
--
ALTER TABLE `tuition_codes_domain`
  MODIFY `tuition_codes_domain_id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_parents`
--
ALTER TABLE `web_parents`
  MODIFY `web_parents_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_students`
--
ALTER TABLE `web_students`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `web_users`
--
ALTER TABLE `web_users`
  MODIFY `web_users_id` int(8) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
