DROP TABLE IF EXISTS ub_blogs;

CREATE TABLE ub_blogs (

  id INT(11) NOT NULL AUTO_INCREMENT,
  name VARCHAR(255) DEFAULT NULL,
  description LONGTEXT DEFAULT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;


DROP TABLE IF EXISTS ub_blog_posts;

CREATE TABLE ub_blog_posts (

  id INT(11) NOT NULL AUTO_INCREMENT,
  blog INT(11) NOT NULL,
  user INT(11) NOT NULL,
  title VARCHAR(100) NOT NULL,
  content LONGTEXT NOT NULL,
  likes MEDIUMTEXT DEFAULT NULL,
  visible INT(1) DEFAULT 1,
  time VARCHAR(15) DEFAULT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;


DROP TABLE IF EXISTS ub_blog_comments;

CREATE TABLE ub_blog_comments (

  id INT(11) NOT NULL AUTO_INCREMENT,
  post INT(11) NOT NULL,
  user INT(11) NOT NULL,
  comment VARCHAR(255) DEFAULT NULL,
  likes MEDIUMTEXT DEFAULT NULL,
  visible INT(1) DEFAULT 1,
  time VARCHAR(15) DEFAULT NULL,

  PRIMARY KEY (id)

)ENGINE=InnoDb;


INSERT INTO uwa_roles(name, description) VALUES
  ('Blog Admin', 'Blog Administrator for the blog.'),
  ('Blog Editor', 'Guest editor that can post on the blog.'),
  ('Blog Follower', 'Normal users that can get updates from the blog');