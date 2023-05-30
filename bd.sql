
CREATE TABLE users (
  id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL
);



CREATE TABLE Posts (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  content VARCHAR(140) NOT NULL,
  image_url VARCHAR(255),
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  KEY `fk_user_user_idx` (`id`),
  CONSTRAINT `fk_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
);



CREATE TABLE Comments (
  id INT PRIMARY KEY AUTO_INCREMENT,
  post_id INT,
  user_id INT,
  content VARCHAR(140) NOT NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (post_id) REFERENCES Posts(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);


CREATE TABLE Likes (
  post_id INT,
  user_id INT,
  PRIMARY KEY (post_id, user_id),
  FOREIGN KEY (post_id) REFERENCES Posts(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);




CREATE TABLE Reposts (
  post_id INT,
  user_id INT,
  PRIMARY KEY (post_id, user_id),
  FOREIGN KEY (post_id) REFERENCES Posts(id),
  FOREIGN KEY (user_id) REFERENCES users(id)
);



CREATE TABLE Followers (
  user_id INT,
  follower_id INT,
  PRIMARY KEY (user_id, follower_id),
  FOREIGN KEY (user_id) REFERENCES users(id),
  FOREIGN KEY (follower_id) REFERENCES users(id)
);


