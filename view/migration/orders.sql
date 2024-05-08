CREATE TABLE orders (
    order_id INT AUTO_INCREMENT PRIMARY KEY,
    user_name VARCHAR(255) NOT NULL,
    user_id VARCHAR(255) NOT NULL,
    user_email VARCHAR(255) NOT NULL,
    user_mobile VARCHAR(15) NOT NULL,
    user_address VARCHAR(255) NOT NULL,
    user_payment_id VARCHAR(20) NOT NULL,
    order_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    product_details TEXT NOT NULL,
    total_amount DECIMAL(10, 2) NOT NULL,
    status VARCHAR(50) DEFAULT 'Pending' NOT NULL
);
