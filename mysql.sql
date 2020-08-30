DROP DATABASE IF EXISTS contactsApp;

CREATE DATABASE contactsApp;

CREATE USER 'contactsuser'@'localhost' IDENTIFIED BY 'tapiwa';

GRANT SELECT, INSERT, UPDATE, DELETE ON contactsApp.* TO contactsuser@'localhost' IDENTIFIED BY 'tapiwa';

USE contactsApp;

CREATE TABLE contacts(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    firstname varchar(100) not null,
    lastname varchar(100) not null
) ENGINE=INNODB;

CREATE TABLE phone(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contacts_id INT,
    phone varchar(100),
    FOREIGN KEY (contacts_id) 
        REFERENCES contacts(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=INNODB;

CREATE TABLE email(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contacts_id INT,
    email varchar(100),
    FOREIGN KEY (contacts_id) 
        REFERENCES contacts(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=INNODB;

CREATE TABLE temp_details(
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    contacts_id INT,
    firstname varchar(100) not null,
    lastname varchar(100) not null,
    phone varchar(100),
    email varchar(100),
    FOREIGN KEY (contacts_id) 
        REFERENCES contacts(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE
) ENGINE=INNODB;


SET GLOBAL general_log = 'ON';
SET GLOBAL log_output = 'TABLE';
SELECT * FROM mysql.general_log WHERE command_type='Query';
