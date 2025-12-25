-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 21, 2025 at 12:27 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dolphin_crm`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL COMMENT 'primary key for contacts',
  `title` varchar(8) NOT NULL COMMENT 'a title field',
  `firstname` varchar(32) NOT NULL COMMENT 'a first name field',
  `lastname` varchar(32) NOT NULL COMMENT 'a last name field',
  `email` varchar(50) NOT NULL COMMENT 'an email field',
  `telephone` varchar(16) NOT NULL COMMENT 'a telephone field',
  `company` varchar(50) NOT NULL COMMENT 'a company field',
  `type` varchar(32) NOT NULL COMMENT 'a type field',
  `assigned_to` int(11) NOT NULL DEFAULT 1 COMMENT 'an assigned to field',
  `created_by` int(11) NOT NULL DEFAULT 1 COMMENT 'a created by field',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'a created at field',
  `updated_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'an updated at field'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int(11) NOT NULL COMMENT 'primary key of notes table',
  `contact_id` int(11) NOT NULL COMMENT 'contact id foreign key',
  `comment` text DEFAULT NULL COMMENT 'optional comment field',
  `created_by` int(11) NOT NULL COMMENT 'a created by field',
  `created_at` datetime NOT NULL DEFAULT current_timestamp() COMMENT 'a created at field'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL COMMENT 'the primary key of users',
  `firstname` varchar(32) NOT NULL COMMENT 'a first name field',
  `lastname` varchar(32) NOT NULL COMMENT 'a last name field',
  `password` varchar(16) NOT NULL COMMENT 'a password field',
  `email` varchar(50) NOT NULL COMMENT 'an email field',
  `role` varchar(32) NOT NULL COMMENT 'a role field',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() COMMENT 'a field to show when a record was created'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contacts_idx_title` (`title`),
  ADD KEY `contacts_idx_firstname` (`firstname`),
  ADD KEY `contacts_idx_lastname` (`lastname`),
  ADD KEY `contacts_idx_email` (`email`),
  ADD KEY `contacts_idx_telephone` (`telephone`),
  ADD KEY `contacts_idx_company` (`company`),
  ADD KEY `contacts_idx_type` (`type`),
  ADD KEY `contacts_idx_assigned_to` (`assigned_to`),
  ADD KEY `contacts_idx_created_by` (`created_by`),
  ADD KEY `contacts_idx_created_at` (`created_at`),
  ADD KEY `contacts_idx_updated_at` (`updated_at`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notes_idx_contact_id` (`contact_id`),
  ADD KEY `notes_idx_created_by` (`created_by`),
  ADD KEY `notes_idx_created_at` (`created_at`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `users_idx_firstname` (`firstname`),
  ADD KEY `users_idx_lastname` (`lastname`),
  ADD KEY `users_idx_password` (`password`),
  ADD KEY `users_idx_email` (`email`),
  ADD KEY `users_idx_role` (`role`),
  ADD KEY `users_idx_created_at` (`created_at`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key for contacts';

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'primary key of notes table';

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'the primary key of users';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
