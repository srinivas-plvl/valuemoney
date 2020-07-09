-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 06:24 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `empty_real`
--

-- --------------------------------------------------------

--
-- Table structure for table `gc_admin`
--

CREATE TABLE `vm_users` (
  `id` int(10) UNSIGNED NOT NULL,
  `mobile` varchar(25) NOT NULL,
  `firstname` varchar(32) DEFAULT NULL,
  `lastname` varchar(32) DEFAULT NULL,
  `registered_type` varchar(32) DEFAULT NULL,
  `email` varchar(128) NOT NULL,
  `profession` varchar(25) NOT NULL,
  `user_code` varchar(75) NOT NULL,
  `connector_code` varchar(75) NOT NULL,
  `interested_service` varchar(25) NOT NULL,
  `payment_mode` varchar(25) NOT NULL,
  `payment_done` tinyint(4) NOT NULL DEFAULT '0',
  `payment_done_date` date NOT NULL,
  `cashback_payment_method` varchar(25) NOT NULL,
  `cashback_receive_mobile` varchar(25) NOT NULL,
  `cashback_receive_date` date NOT NULL,
    `dcsc_email` varchar(25) NOT NULL,
  `dcsc_mobile` varchar(25) NOT NULL,
  `date_added` date NOT NULL,
  `is_connector` tinyint(4) NOT NULL DEFAULT '0',
  `password` varchar(40) NOT NULL,
   `status` tinyint(4) NOT NULL DEFAULT '1',
   `is_admin` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `gc_admin`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `gc_admin`
--
ALTER TABLE `vm_users`
  ADD PRIMARY KEY (`id`);


ALTER TABLE `vm_users`
  ADD UNIQUE KEY (`user_code`);
--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gc_admin`
--
ALTER TABLE `vm_users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2020 at 06:11 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.3.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `free_money`
--

-- --------------------------------------------------------


CREATE TABLE `vm_service_transacton` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` varchar(34) NOT NULL,
  `service_transaction_status` varchar(34) NOT NULL,
  `transaction_amount` varchar(34) NOT NULL,
  `cashback_amount` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_catgs`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `num_catgs`
--
ALTER TABLE `vm_service_transacton`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `num_catgs`
--
ALTER TABLE `vm_service_transacton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- vm user vm_services
--


CREATE TABLE `vm_services` (
  `id` int(11) NOT NULL,
  `service_name` varchar(34) NOT NULL,
  `service_title` varchar(34) NOT NULL,
  `service_description` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_catgs`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `num_catgs`
--
ALTER TABLE `vm_services`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `num_catgs`
--
ALTER TABLE `vm_services`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



--
-- Table structure for table `service trsansactions

CREATE TABLE `vm_service_transacton` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` varchar(34) NOT NULL,
  `service_transaction_status` varchar(34) NOT NULL,
  `transaction_amount` varchar(34) NOT NULL,
  `cashback_amount` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_catgs`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `num_catgs`
--
ALTER TABLE `vm_service_transacton`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `num_catgs`
--
ALTER TABLE `vm_service_transacton`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

--
-- vm user rewards
--


CREATE TABLE `vm_user_rewards` (
  `id` int(11) NOT NULL,
  `user_id` varchar(34) NOT NULL,
  `reward_type` varchar(34) NOT NULL,
  `reward_details` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_catgs`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `num_catgs`
--
ALTER TABLE `vm_user_rewards`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `num_catgs`
--
ALTER TABLE `vm_user_rewards`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



-- --------------------------------------------------------

--
-- user cash backs
--
CREATE TABLE `vm_user_cashbacks` (
  `id` int(11) NOT NULL,
  `service_id` int(11) NOT NULL,
  `user_id` varchar(34) NOT NULL,
  `service_transaction_status` varchar(34) NOT NULL,
  `transaction_amount` varchar(34) NOT NULL,
  `cashback_amount` varchar(30) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `modified_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `num_catgs`
--


--
-- Indexes for dumped tables
--

--
-- Indexes for table `num_catgs`
--
ALTER TABLE `vm_user_cashbacks`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `num_catgs`
--
ALTER TABLE `vm_user_cashbacks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;


