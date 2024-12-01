create table users (
	id INT AUTO_INCREMENT PRIMARY KEY,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR(255),
	gender VARCHAR(255),
	address VARCHAR(255),
	birthday DATE,
    degree VARCHAR(255),
	experience VARCHAR(255),
	position VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	added_by VARCHAR(255),
	last_updated TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	last_updated_by VARCHAR(255)
);

create table user_accounts (
	user_id INT AUTO_INCREMENT PRIMARY KEY,
	username VARCHAR(255),
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	password TEXT,
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);

CREATE TABLE activity_logs (
	activity_log_id INT AUTO_INCREMENT PRIMARY KEY,
	operation VARCHAR(255),
	id INT,
	first_name VARCHAR(255),
	last_name VARCHAR(255),
	email VARCHAR(255),
	gender VARCHAR(255),
	address VARCHAR(255),
	birthday DATE,
    degree VARCHAR(255),
	experience VARCHAR(255),
	position VARCHAR(255),
	username VARCHAR(255),
	date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);
