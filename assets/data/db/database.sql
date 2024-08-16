
--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
CREATE TABLE IF NOT EXISTS `setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `footer_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `title`, `address`, `footer_text`) VALUES
(1, 'Vehicle Management ', '123/A, Demo Street, NY-10000', 'Copyright &copy; 2017-2018\r\n');


--
-- Table structure for table `acc_account`
--

DROP TABLE IF EXISTS `acc_account`;
CREATE TABLE IF NOT EXISTS `acc_account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `sector_name` varchar(255) NOT NULL,
  `sector_type` varchar(120) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`account_id`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8;


--
-- Table structure for table `acc_bank`
--

DROP TABLE IF EXISTS `acc_bank`;
CREATE TABLE IF NOT EXISTS `acc_bank` (
  `bank_id` int(11) NOT NULL AUTO_INCREMENT,
  `bank_name` varchar(200) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `account_number` varchar(50) NOT NULL,
  `opening_credit` int(11) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`bank_id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;


--
-- Table structure for table `acc_company`
--

DROP TABLE IF EXISTS `acc_company`;
CREATE TABLE IF NOT EXISTS `acc_company` (
  `company_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `mobile_no` varchar(30) NOT NULL,
  `phone_no` varchar(30) NOT NULL,
  `fax_no` varchar(30) NOT NULL,
  `email` varchar(120) NOT NULL,
  `website` varchar(120) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;


--
-- Table structure for table `acc_inflow`
--

DROP TABLE IF EXISTS `acc_inflow`;
CREATE TABLE IF NOT EXISTS `acc_inflow` (
  `inflow_id` int(11) NOT NULL AUTO_INCREMENT,
  `received_date` date NOT NULL,
  `received_from` varchar(255) NOT NULL,
  `received_type` tinyint(1) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(120) DEFAULT NULL,
  `pay_order_number` varchar(120) DEFAULT NULL,
  `letter_of_credit` varchar(120) DEFAULT NULL,
  `deposit_bank_id` int(11) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` date NOT NULL,
  PRIMARY KEY (`inflow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

--
-- Table structure for table `acc_invoice`
--

DROP TABLE IF EXISTS `acc_invoice`;
CREATE TABLE IF NOT EXISTS `acc_invoice` (
  `invoice_id` int(11) NOT NULL AUTO_INCREMENT,
  `tracking_no` varchar(50) NOT NULL,
  `customer_name` varchar(50) NOT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `billing_address` varchar(255) NOT NULL,
  `phone` varchar(15) DEFAULT NULL,
  `mobile` varchar(15) DEFAULT NULL,
  `item` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `amount` float NOT NULL,
  `discount` float DEFAULT NULL,
  `vat` float DEFAULT NULL,
  `grand_total` float NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`invoice_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `acc_outflow`
--

DROP TABLE IF EXISTS `acc_outflow`;
CREATE TABLE IF NOT EXISTS `acc_outflow` (
  `outflow_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_date` varchar(50) NOT NULL,
  `payment_to` varchar(255) NOT NULL,
  `payment_type` tinyint(1) NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(120) DEFAULT NULL,
  `pay_order_number` varchar(120) DEFAULT NULL,
  `letter_of_credit` varchar(120) DEFAULT NULL,
  `deposit_bank_id` int(11) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `amount` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `status` tinyint(1) NOT NULL,
  `date` varchar(50) NOT NULL,
  PRIMARY KEY (`outflow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=156 DEFAULT CHARSET=utf8;


--
-- Table structure for table `add_company`
--

DROP TABLE IF EXISTS `add_company`;
CREATE TABLE IF NOT EXISTS `add_company` (
  `company_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `company_address` varchar(255) CHARACTER SET latin1 NOT NULL,
  `company_cell` varchar(100) DEFAULT NULL,
  `company_email` varchar(100) CHARACTER SET latin1 NOT NULL,
  `company_web` varchar(100) CHARACTER SET latin1 NOT NULL,
  `posting_id` int(10) NOT NULL,
  `active` int(10) NOT NULL COMMENT '0 = inactive, 1 = active, 2 = delete',
  PRIMARY KEY (`company_id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8;


--
-- Table structure for table `city`
--

DROP TABLE IF EXISTS `city`;
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `posting_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`city_id`)
) ENGINE=InnoDB AUTO_INCREMENT=114 DEFAULT CHARSET=utf8 COMMENT='city wise station';

--
-- Table structure for table `city_city_distance`
--

DROP TABLE IF EXISTS `city_city_distance`;
CREATE TABLE IF NOT EXISTS `city_city_distance` (
  `distance_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `city_id_one` int(10) NOT NULL,
  `city_id_two` int(10) NOT NULL,
  `distance` int(100) NOT NULL,
  `measurement_scale` varchar(255) CHARACTER SET latin1 NOT NULL,
  `posting_id` int(10) NOT NULL,
  `active` int(10) NOT NULL,
  PRIMARY KEY (`distance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company_rent`
--

DROP TABLE IF EXISTS `company_rent`;
CREATE TABLE IF NOT EXISTS `company_rent` (
  `company_rent_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `company_id` int(100) NOT NULL,
  `v_type_id` int(100) NOT NULL,
  `starting_station_id` int(100) NOT NULL,
  `ending_station_id` int(100) NOT NULL,
  `rent_type` int(10) NOT NULL,
  `rent` float NOT NULL,
  `vat` int(11) NOT NULL,
  `vat_status` tinyint(1) NOT NULL DEFAULT '0',
  `posting_id` int(100) NOT NULL,
  `active` int(10) NOT NULL,
  PRIMARY KEY (`company_rent_id`)
) ENGINE=InnoDB AUTO_INCREMENT=89 DEFAULT CHARSET=utf8;

--
-- Table structure for table `driver_info`
--

DROP TABLE IF EXISTS `driver_info`;
CREATE TABLE IF NOT EXISTS `driver_info` (
  `driver_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `driver_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `d_mobile` varchar(100) CHARACTER SET latin1 NOT NULL,
  `v_registration_no` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `d_license_no` varchar(255) CHARACTER SET latin1 NOT NULL,
  `d_father_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `d_mother_name` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `d_nid` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `d_join_date` date NOT NULL,
  `d_release_date` date NOT NULL,
  `d_emergency_contact_person` varchar(255) CHARACTER SET latin1 NOT NULL,
  `d_emergency_cell` varchar(255) CHARACTER SET latin1 NOT NULL,
  `d_picture` varchar(255) CHARACTER SET latin1 NOT NULL,
  `d_license_expire_date` date NOT NULL,
  `d_address_present` varchar(255) CHARACTER SET latin1 NOT NULL,
  `d_address_permanent` varchar(255) CHARACTER SET latin1 NOT NULL,
  `posting_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1' COMMENT '0 = inactive, 1 = active, 2 = delete',
  PRIMARY KEY (`driver_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;


--
-- Table structure for table `expense_data`
--

DROP TABLE IF EXISTS `expense_data`;
CREATE TABLE IF NOT EXISTS `expense_data` (
  `transection_id` int(11) NOT NULL AUTO_INCREMENT,
  `import_export` tinyint(2) DEFAULT NULL,
  `trip_link_id` varchar(255) DEFAULT NULL,
  `expense_group` int(11) NOT NULL,
  `expense_id` int(11) DEFAULT NULL,
  `expense_serial` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `v_id` int(11) DEFAULT NULL,
  `quantity` float DEFAULT NULL,
  `amount` float DEFAULT NULL,
  `posting_id` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`transection_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2438 DEFAULT CHARSET=latin1;

--
-- Table structure for table `expense_list`
--

DROP TABLE IF EXISTS `expense_list`;
CREATE TABLE IF NOT EXISTS `expense_list` (
  `expense_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `expense_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `expense_group` int(11) NOT NULL,
  `posting_id` int(11) NOT NULL,
  `active` int(11) NOT NULL,
  PRIMARY KEY (`expense_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

DROP TABLE IF EXISTS `state`;
CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `state_name` varchar(255) CHARACTER SET latin1 NOT NULL,
  `posting_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `active` int(10) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

--
-- Table structure for table `trip`
--

DROP TABLE IF EXISTS `trip`;
CREATE TABLE IF NOT EXISTS `trip` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `trip_id` varchar(250) CHARACTER SET utf8 DEFAULT NULL,
  `trip_type` int(11) DEFAULT NULL,
  `import_export` int(3) NOT NULL,
  `driver_id` int(11) DEFAULT NULL,
  `v_id` int(11) DEFAULT NULL,
  `hire_v_id` varchar(255) DEFAULT NULL,
  `v_type_id` int(11) DEFAULT NULL,
  `start_dist_id` int(11) DEFAULT NULL,
  `start_station_id` int(11) DEFAULT NULL,
  `end_dist_id` int(11) DEFAULT NULL,
  `end_station_id` int(11) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `others_company` varchar(255) DEFAULT NULL,
  `date` date NOT NULL,
  `rent` float DEFAULT NULL,
  `fare_rent` float DEFAULT NULL,
  `advance` float DEFAULT NULL,
  `trip_link_id` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `posting_id` varchar(255) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=404 DEFAULT CHARSET=latin1;


--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(255) CHARACTER SET latin1 NOT NULL,
  `username` varchar(255) CHARACTER SET latin1 NOT NULL,
  `password` varchar(100) CHARACTER SET latin1 NOT NULL,
  `type` int(10) NOT NULL,
  `last_log_date` datetime NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;


--
-- Table structure for table `vehicle_fitness`
--

DROP TABLE IF EXISTS `vehicle_fitness`;
CREATE TABLE IF NOT EXISTS `vehicle_fitness` (
  `v_fitness_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `v_id` int(11) NOT NULL,
  `reg_issue` date NOT NULL,
  `reg_expire` date NOT NULL,
  `fitness_issue` date NOT NULL,
  `fitness_expire` date NOT NULL,
  `insurance_issue` date NOT NULL,
  `insurance_expire` date NOT NULL,
  `tax_issue` date NOT NULL,
  `tax_expire` date NOT NULL,
  `root_permit_issue` date NOT NULL,
  `root_permit_expire` date NOT NULL,
  `fuel_issue` date DEFAULT NULL,
  `fuel_expire` date DEFAULT NULL,
  `posting_id` int(11) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`v_fitness_id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;


--
-- Table structure for table `vehicle_fuel_rate`
--

DROP TABLE IF EXISTS `vehicle_fuel_rate`;
CREATE TABLE IF NOT EXISTS `vehicle_fuel_rate` (
  `v_fuel_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `v_id` int(100) NOT NULL COMMENT 'vehicle id',
  `v_fuel_per_kilo_litter` varchar(255) CHARACTER SET latin1 NOT NULL,
  `v_fuel_rate` varchar(255) CHARACTER SET latin1 NOT NULL,
  `v_fuel_last_update_dat` datetime NOT NULL,
  `posting_id` int(10) NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`v_fuel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_info`
--

DROP TABLE IF EXISTS `vehicle_info`;
CREATE TABLE IF NOT EXISTS `vehicle_info` (
  `v_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `v_model_no` varchar(255) CHARACTER SET latin1 NOT NULL,
  `v_registration_no` varchar(255) CHARACTER SET latin1 NOT NULL,
  `v_chassis_no` varchar(255) CHARACTER SET latin1 NOT NULL,
  `v_engine_no` varchar(255) CHARACTER SET latin1 NOT NULL,
  `v_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `posting_id` int(10) NOT NULL,
  `active` int(2) NOT NULL,
  `v_owner` int(11) NOT NULL,
  PRIMARY KEY (`v_id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8;


--
-- Table structure for table `vehicle_type`
--

DROP TABLE IF EXISTS `vehicle_type`;
CREATE TABLE IF NOT EXISTS `vehicle_type` (
  `v_type_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `v_type` varchar(255) CHARACTER SET latin1 NOT NULL,
  `posting_id` varchar(255) CHARACTER SET latin1 NOT NULL,
  `active` int(2) NOT NULL,
  PRIMARY KEY (`v_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

