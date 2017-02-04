
DROP TABLE IF EXISTS uwa_roles;

CREATE TABLE uwa_roles (

  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) NOT NULL,
  description VARCHAR(255) DEFAULT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;

INSERT INTO uwa_roles(name, description) VALUES
  ('Admin', 'Web Administrator for the website.'),
  ('Moderator', 'Can moderate certain aspects of the website.');


DROP TABLE IF EXISTS uwa_users;

CREATE TABLE uwa_users (

  id INT(11) NOT NULL AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  email VARCHAR(255) DEFAULT NULL,
  ip VARCHAR(255) DEFAULT NULL,
  last_action VARCHAR(15) DEFAULT NULL,
  display_name VARCHAR(255) DEFAULT NULL,
  display_pic MEDIUMTEXT,

  PRIMARY KEY (id)

)ENGINE=InnoDb;


DROP TABLE IF EXISTS uwa_user_roles;

CREATE TABLE uwa_user_roles (

  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  role_id INT(11) NOT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;


DROP TABLE IF EXISTS uwa_user_phone_numbers;

CREATE TABLE uwa_user_phone_numbers (

  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  phone_number VARCHAR(20) NOT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;


DROP TABLE IF EXISTS uwa_user_addresses;

CREATE TABLE uwa_user_addresses (

  id INT(11) NOT NULL AUTO_INCREMENT,
  user_id INT(11) NOT NULL,
  line1 MEDIUMTEXT DEFAULT NULL,
  line2 MEDIUMTEXT DEFAULT NULL,
  city VARCHAR(100) DEFAULT NULL,
  country VARCHAR(100) DEFAULT NULL,
  zip VARCHAR(10) DEFAULT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;