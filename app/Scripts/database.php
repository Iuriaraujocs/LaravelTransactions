<?php


require_once('SQL.php');

	$hostname = '127.0.0.1';
	$username = 'root';
	$password = '01ica!';
	$database = "database_trial_iuriaraujo";

	$obj = new system\mvc\SQL($hostname,'',$username,$password);

	$sql[0] = "CREATE DATABASE IF NOT EXISTS " . $database;
	$sql[1] = "USE " . $database;
	$sql[2] = "DROP TABLE IF EXISTS `transactions`";
	$sql[3] = "CREATE TABLE `transactions` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `client` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
		  `deal` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
		  `hour` datetime NOT NULL,
		  `accepted` int(11) NOT NULL,
		  `refused` int(11) NOT NULL,
		  `created_at` timestamp NULL DEFAULT NULL,
		  `updated_at` timestamp NULL DEFAULT NULL,
		  PRIMARY KEY (`id`)
		) ENGINE=InnoDB AUTO_INCREMENT=2003 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
		";

	$sql[4] = "DROP TABLE IF EXISTS `users`";	
	$sql[5] = "CREATE TABLE `users` (
		  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
		  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
		  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
		  `email_verified_at` timestamp NULL DEFAULT NULL,
		  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
		  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
		  `created_at` timestamp NULL DEFAULT NULL,
		  `updated_at` timestamp NULL DEFAULT NULL,
		  PRIMARY KEY (`id`),
		  UNIQUE KEY `users_email_unique` (`email`)
		) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
		";
	
	foreach($sql as $stm)	
	$obj->run($stm);


	