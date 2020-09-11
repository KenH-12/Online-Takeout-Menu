USE taste_of_bombay;

DROP TABLE IF EXISTS orders_items;
DROP TABLE IF EXISTS items;
DROP TABLE IF EXISTS item_categories;
DROP TABLE IF EXISTS orders;
DROP TABLE IF EXISTS order_types;

CREATE TABLE order_types
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	description VARCHAR(25) NOT NULL,
	fee DECIMAL(4,2) DEFAULT 0,
	
	UNIQUE KEY (description)
);

CREATE TABLE orders
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	order_date DATE,
	order_time TIME,
	order_type_id INT,
	
	FOREIGN KEY order_type_key (order_type_id) REFERENCES order_types (id)
);

CREATE TABLE item_categories
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(32) NOT NULL,
	description VARCHAR(64),
	
	UNIQUE KEY (title)
);

CREATE TABLE items
(
	id INT AUTO_INCREMENT PRIMARY KEY,
	title VARCHAR(30) NOT NULL,
	price DECIMAL(4,2) NOT NULL,
	description VARCHAR(128),
	item_category_id INT NOT NULL,
	
	UNIQUE KEY (title),
	FOREIGN KEY item_category_key (item_category_id) REFERENCES item_categories (id)
);

CREATE TABLE orders_items
(
	order_id INT NOT NULL,
	item_id INT NOT NULL,
	quantity SMALLINT NOT NULL,
	
	PRIMARY KEY (order_id, item_id),
	FOREIGN KEY order_key (order_id) REFERENCES orders (id),
	FOREIGN KEY item_key (item_id) REFERENCES items (id)
);