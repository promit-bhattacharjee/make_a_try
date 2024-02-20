-- Active: 1706891678287@@127.0.0.1@3306@makeatry

CREATE TABLE `users` (
    `user_id` INT(20) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `user_name` VARCHAR(20) NOT NULL,
    `user_email` VARCHAR(100) NOT NULL UNIQUE,
    `user_password` VARCHAR(20) NOT NULL,
    `user_mobile` VARCHAR(20) NOT NULL UNIQUE,
    `user_address` VARCHAR(20) NOT NULL,
    `user_gender` VARCHAR(20) NOT NULL,
    `user_verification_status` VARCHAR(20) NOT NULL,
    `role` VARCHAR(20) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()
)