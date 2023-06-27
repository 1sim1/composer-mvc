CREATE TABLE `composer-mvc_db`.users (
	name varchar(100) NOT NULL,
	surname varchar(100) NOT NULL,
	email varchar(100) NOT NULL,
	password varchar(100) NOT NULL,
	CONSTRAINT users_pk PRIMARY KEY (email)
)
ENGINE=InnoDB
DEFAULT CHARSET=utf8mb4
COLLATE=utf8mb4_general_ci;