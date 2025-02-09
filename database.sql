-- Create Users Table
CREATE TABLE IF NOT EXISTS `users` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(100) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `role` ENUM('admin', 'student') NOT NULL,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Students Table
CREATE TABLE IF NOT EXISTS `students` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` VARCHAR(50) UNIQUE NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `department` VARCHAR(100),
    `contact` VARCHAR(15),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create Admins Table
CREATE TABLE IF NOT EXISTS `admins` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `admin_id` VARCHAR(50) UNIQUE NOT NULL,
    `name` VARCHAR(100) NOT NULL,
    `email` VARCHAR(100) UNIQUE NOT NULL,
    `contact` VARCHAR(15),
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Create ID Requests Table
CREATE TABLE IF NOT EXISTS `id_requests` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `student_id` INT NOT NULL,
    `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `requested_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `approved_at` TIMESTAMP NULL,
    `FOREIGN KEY` (`student_id`) REFERENCES `students`(`id`) ON DELETE CASCADE
);

-- Create Notifications Table
CREATE TABLE IF NOT EXISTS `notifications` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `recipient_id` INT NOT NULL,
    `message` TEXT NOT NULL,
    `sent_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `FOREIGN KEY` (`recipient_id`) REFERENCES `students`(`id`) ON DELETE CASCADE
);

-- Create Reports Table
CREATE TABLE IF NOT EXISTS `reports` (
    `id` INT AUTO_INCREMENT PRIMARY KEY,
    `report_name` VARCHAR(255) NOT NULL,
    `generated_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
