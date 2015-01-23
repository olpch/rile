
/*
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "-05:00";

CREATE DATABASE okydata1;
*/
-- --------------------------------------------------------
-- Estructura de tabla para la tabla users
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS users (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  uid varchar(20) NOT NULL,
  created datetime NOT NULL,
  first_name varchar(60) NOT NULL,
  last_name varchar(60) NOT NULL,
  email varchar(200) NOT NULL,
  opsw  varchar(50) NOT NULL,
  level tinyint(4) NOT NULL DEFAULT '0',
  state tinyint(4) NOT NULL DEFAULT '1',
  last_login datetime NOT NULL,
  sesion datetime NOT NULL,
  token varchar(50) NOT NULL,
  note text NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

ALTER TABLE users ADD INDEX ('email');
ALTER TABLE users ADD INDEX ('uid');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla items
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS items (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  uid varchar(20) NOT NULL,
  created datetime NOT NULL,
  category bigint(20) NOT NULL,
  subcategory bigint(20) NOT NULL,
  name varchar(100) NOT NULL,
  detail varchar(256) NOT NULL,
  color tinyint NOT NULL,
  cant int(3) NOT NULL,
  cost decimal(14,4) NOT NULL,
  sell decimal(14,4) NOT NULL,
  state tinyint NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

ALTER TABLE items ADD INDEX ('category');
ALTER TABLE items ADD INDEX ('subcategory');
ALTER TABLE items ADD INDEX ('category');

-- --------------------------------------------------------
-- Estructura de tabla para la tabla invoices
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS invoices (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  uid varchar(20) NOT NULL,
  created datetime NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------
-- Estructura de tabla para la tabla invoices_details
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS invoices_details (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  uid varchar(20) NOT NULL,
  created datetime NOT NULL,
  invoice bigint(20) NOT NULL,
  item bigint(20) NOT NULL,
  PRIMARY KEY ('id'),
  FOREIGN KEY(invoice) REFERENCES invoices(id) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY(item) REFERENCES items(id) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;



-- --------------------------------------------------------
-- Estructura de tablas categories y subcategories
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS categories (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS subcategory (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  name varchar(100) NOT NULL,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;

/*CREATE TABLE IF NOT EXISTS  (
  id bigint(20) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY ('id')
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci AUTO_INCREMENT=1 ;*/