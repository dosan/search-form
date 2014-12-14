CREATE TABLE `sandor`.`song` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `artist` text COLLATE utf8_unicode_ci NOT NULL,
  `track` text COLLATE utf8_unicode_ci NOT NULL,
  `link` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `sandor`.`users` (
	user_id INT(11) NOT NULL AUTO_INCREMENT,
	user_name varchar(255) NOT NULL,
	user_password_hash varchar(255) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s password in salted and hashed format',
	user_email varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s email, unique',
	user_phone INT(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s phone',
	user_adress varchar(64) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s adress',
	time_reg INT(11) COLLATE utf8_unicode_ci NOT NULL COMMENT 'user''s registration time',
	user_range varchar(30) NOT NULL DEFAULT 'user' COMMENT 'user''s range',
	PRIMARY KEY (user_id),
	UNIQUE KEY `user_name` (user_name),
	UNIQUE KEY `user_email` (user_email)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='user data';

CREATE TABLE `sandor`.`categories` (
	cat_id INT(11) NOT NULL AUTO_INCREMENT,
	cat_name VARCHAR(25) NOT NULL,
	cat_description VARCHAR(400),
	UNIQUE KEY `cat_name` (cat_name),
	PRIMARY KEY (cat_id)
) ENGINE = MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `sandor`.`shop_categories` (
	cat_id INT(11) NOT NULL AUTO_INCREMENT,
	parent_id INT(11),
	cat_name VARCHAR(200) NOT NULL,
	cat_url VARCHAR(200) NOT NULL,
	cat_description VARCHAR(400),
	UNIQUE KEY `cat_name` (cat_name),
	PRIMARY KEY (cat_id)
) ENGINE = MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `sandor`.`news` (
	news_id INT (11) NOT NULL AUTO_INCREMENT,
	news_name varchar(255) NOT NULL,
	news_url varchar(255) NOT NULL,
	news_description TEXT NOT NULL,
	news_image varchar(1000) NOT NULL,
	news_time INT(11) NOT NULL,
	user_id INT(11) NOT NULL,
	cat_id INT(11) NOT NULL,
	news_watch tinyint(4) DEFAULT 1,
	PRIMARY KEY (news_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id),
	FOREIGN KEY (cat_id) REFERENCES Categories(cat_id)
) ENGINE = MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE `sandor`.`comments` (
	comment_id INT(16) NOT NULL AUTO_INCREMENT,
	comment_content TEXT NOT NULL,
	comment_time INT(10) NOT NULL,
	user_id INT(11) NOT NULL,
	news_id INT(11) NOT NULL,
	PRIMARY KEY (comment_id),
	FOREIGN KEY (user_id) REFERENCES Users(user_id),
	FOREIGN KEY (news_id) REFERENCES News(news_id)
) ENGINE = MyISAM DEFAULT CHARSET=utf8;


CREATE TABLE `sandor`.`products` (
	product_id INT(11) NOT NULL AUTO_INCREMENT,
	cat_id INT(11) NOT NULL,
	product_name VARCHAR(50) NOT NULL,
	product_description TEXT NOT NULL,
	product_price INT(22) NOT NULL,
	product_image VARCHAR(255),
	product_status TINYINT(4) DEFAULT 1,
	PRIMARY KEY (product_id),
	FOREIGN KEY (cat_id) REFERENCES shop_categories(cat_id)
) ENGINE = MyISAM DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `orders` (
  `order_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `date_created` int(11) NOT NULL,
  `date_payment` int(11) DEFAULT NULL,
  `date_modification` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `comment` text NOT NULL,
  `user_ip` varchar(15) NOT NULL,
  PRIMARY KEY (`order_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

CREATE TABLE IF NOT EXISTS `purchase` (
  `purchase_id` int(11) NOT NULL AUTO_INCREMENT,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `price` float NOT NULL,
  `amount` int(11) NOT NULL,
  PRIMARY KEY (`purchase_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;