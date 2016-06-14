<?php

require 'vendor/autoload.php';

$mysql_create_pma_file = "
CREATE TABLE `pma_file` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file_location` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `keywords` varchar(500) COLLATE utf8_bin DEFAULT NULL,
  `creation_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `mask` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `file_location_UNIQUE` (`file_location`),
  FULLTEXT KEY `fulltext` (`keywords`,`file_location`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;
";

