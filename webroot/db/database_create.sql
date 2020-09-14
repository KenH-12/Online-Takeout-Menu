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

INSERT INTO order_types (description) VALUES ('Pickup');
INSERT INTO order_types (description) VALUES ('Curbside Pickup');
INSERT INTO order_types (description, fee) VALUES ('Delivery', 5.00);

INSERT INTO item_categories (title) VALUES ('Appetizers');
INSERT INTO item_categories (title) VALUES ('Bombay''s Specials');
INSERT INTO item_categories (title, description) VALUES ('Vegetarian Entrees', 'Entrees are served with rice or naan');
INSERT INTO item_categories (title, description) VALUES ('Non-Vegetarian Entrees', 'Entrees are served with rice or naan');
INSERT INTO item_categories (title, description) VALUES ('BBQ Specials', 'All BBQ Dishes are served with a portion of rice or naan');
INSERT INTO item_categories (title) VALUES ('Breads');
INSERT INTO item_categories (title) VALUES ('Rice Dishes');
INSERT INTO item_categories (title) VALUES ('Salads');
INSERT INTO item_categories (title) VALUES ('Drinks');
INSERT INTO item_categories (title) VALUES ('Desserts');

-- Appetizers
INSERT INTO items (title, price, description, item_category_id) VALUES ('Vegetable Samosa', 3.99, '3 pcs', 1);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Potato Cutlets', 3.99, '2 pcs', 1);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Pakora', 3.99, 'Spicy lentil balls', 1);
INSERT INTO items (title, price, item_category_id) VALUES ('Onion Bhaji', 3.99, 1);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Papadum', 3.99, '4 pcs', 1);
-- Bombay's Specials
INSERT INTO items (title, price, description, item_category_id) VALUES ('Nihari', 12.99, 'Spicy curry or veal, cooked with aromatic spices in low heat, overnight', 2);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Haleem', 12.99, 'A hot blend of 9 lentils & meats, in spicy herbs, a famous Pakistani/Indian dish', 2);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Sarson Ka Saag', 12.99, 'A spicy blend of rapini & spinach with green chillies, garnished with roasted garlic & ginger', 2);
-- Vegetarian Entrees
INSERT INTO items (title, price, description, item_category_id) VALUES ('Mixed Vegetable Curry', 9.99, 'Mixed vegetables cooked in a light curry sauce', 3);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Aloo Gobhi', 9.99, 'Potatoes and cauliflower in mild spices', 3);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Paneer Tikka Masala', 9.99, 'BBQ homemade cheese in masala sauce', 3);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Daal Makhani', 9.99, 'Black lentils delicately tempered with herbs', 3);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Chana Masala', 9.99, 'Chickpeas in mild curry form', 3);
-- Non-Vegetarian Entrees
INSERT INTO items (title, price, description, item_category_id) VALUES ('Chicken Karahi', 11.99, 'Wok-cooked spicy chicken in thick curry sauce', 4);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Butter Chicken', 11.99, 'Chicken with herbs in creamy butter sauce', 4);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Vindaloo', 11.99, 'Spicy chicken and potato curry', 4);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Lamb Karahi', 13.99, 'Wok-cooked spicy lamb in thick curry sauce', 4);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Shrimp Masala', 13.99, 'Large shrimp with herbs in a special masala sauce', 4);
-- BBQ Specials
INSERT INTO items (title, price, description, item_category_id) VALUES ('Chicken Tikka', 10.99, '2 skewers of grilled chicken with hot spices', 5);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Chicken Tikka Masala', 12.99, 'Grilled chicken with hot spices in Masala sauce', 5);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Chicken Shashlik', 10.99, '2 skewers of grilled chicken and vegetables', 5);
-- Breads
INSERT INTO items (title, price, item_category_id) VALUES ('Tandoori Roti', 1.49, 6);
INSERT INTO items (title, price, item_category_id) VALUES ('Tandoori Naan', 1.49, 6);
INSERT INTO items (title, price, item_category_id) VALUES ('Garlic Naan', 2.99, 6);
INSERT INTO items (title, price, item_category_id) VALUES ('Aloo Paratha', 3.99, 6);
INSERT INTO items (title, price, item_category_id) VALUES ('Keema Naan', 3.99, 6);
-- Rice Dishes
INSERT INTO items (title, price, description, item_category_id) VALUES ('Chicken Biryani', 8.99, 'A Bombay style basmati rice with spicy chicken', 7);
INSERT INTO items (title, price, description, item_category_id) VALUES ('Vegetable Biryani', 8.99, 'A Bombay style basmati rice with vegetables', 7);
INSERT INTO items (title, price, item_category_id) VALUES ('Saffron Rice', 4.99, 7);
INSERT INTO items (title, price, item_category_id) VALUES ('Plain Boiled Rice', 3.99, 7);
-- Salads
INSERT INTO items (title, price, item_category_id) VALUES ('Mixed Green Salad', 2.99, 8);
INSERT INTO items (title, price, item_category_id) VALUES ('Tomato & Onion Salad', 2.99, 8);
INSERT INTO items (title, price, item_category_id) VALUES ('Yogurt Salad (Raita)', 1.99, 8);
-- Drinks
INSERT INTO items (title, price, item_category_id) VALUES ('Lassi (Yogurt Drink)', 1.99, 9);
INSERT INTO items (title, price, item_category_id) VALUES ('Mango Lassi', 2.99, 9);
INSERT INTO items (title, price, item_category_id) VALUES ('Doodh Patti (Masala Tea)', 2.94, 9);
-- Desserts
INSERT INTO items (title, price, item_category_id) VALUES ('Gulab Jamun', 2.99, 10);

-- Sample order
INSERT INTO orders (order_date, order_time, order_type_id) VALUES (CURDATE(), CURTIME(), 1);
INSERT INTO orders_items (order_id, item_id, quantity) VALUES (1, 1, 1);
INSERT INTO orders_items (order_id, item_id, quantity) VALUES (1, 10, 1);
INSERT INTO orders_items (order_id, item_id, quantity) VALUES (1, 12, 1);
INSERT INTO orders_items (order_id, item_id, quantity) VALUES (1, 23, 3);