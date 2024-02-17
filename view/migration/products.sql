-- Active: 1706891678287@@127.0.0.1@3306@makeatry
CREATE TABLE `products` (  
    `product_id` INT(100) NOT NULL AUTO_INCREMENT PRIMARY KEY,
    `product_name` VARCHAR(100) NOT NULL UNIQUE,
    `product_price` DECIMAL(10,2) NOT NULL,
    `product_category` VARCHAR(50) NOT NULL, 
    `product_description` VARCHAR(255) NOT NULL,
    `product_status` VARCHAR(100) NOT NULL,
    `product_width` INT(100) NOT NULL,
    `product_image` VARCHAR(255) NOT NULL,
    `product_height` INT(100) NOT NULL,
    `product_brand` VARCHAR(50) NOT NULL,
    `product_gender` VARCHAR(50) NOT NULL,
    `product_model` VARCHAR(50) NOT NULL,
    `product_colour` VARCHAR(50) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    `updated_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP()
);
