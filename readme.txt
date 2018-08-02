Ensure this extensions are enabled for PHP 5.2.0 or higher

For SMS
1. php_curl

For Email
    to confirm

For Excel Reading and Writing:
1. PHP extension php_zip enabled (required if you need PHPExcel to handle .xlsx .ods or .gnumeric files)
2. PHP extension php_xml enabled
3. PHP extension php_gd2 enabled (optional, but required for exact column width autocalculation)


Database updates scripts(02-08-2018)
CREATE TABLE `sms_templates` (
`id` int(10) NOT NULL,
`title` varchar(140) NOT NULL,
`template` text NOT NULL,
`type` varchar(50) NOT NULL,
`modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `sms_templates`
--

INSERT INTO `sms_templates` (`id`, `title`, `template`, `type`, `modified`) VALUES 
(2, 'Test', 'Test Template', 'DEFAULT', '2018-07-26 13:11:49');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `sms_templates`
--
ALTER TABLE `sms_templates`
ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `sms_templates`
--
ALTER TABLE `sms_templates`
MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
ALTER TABLE `settings` ADD `value9` VARCHAR(140) NOT NULL AFTER `value8`;