--
-- Setup for the article:
-- https://dbwebb.se/kunskap/kom-igang-med-php-pdo-och-mysql
--

--
-- Create the database with a test user
--
CREATE DATABASE IF NOT EXISTS oophp;

-- Skapa användare
CREATE USER IF NOT EXISTS 'user'@'localhost' IDENTIFIED BY 'pass';

-- Ge rättigheter
GRANT ALL PRIVILEGES ON oophp.* TO 'user'@'localhost';
-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";

-- GRANT ALL ON oophp.* TO user@localhost IDENTIFIED BY "pass";
USE oophp;
