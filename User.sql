CREATE TABLE `users` (
  id int(11) NOT NULL AUTO_INCREMENT,
  username varchar(255) NOT NULL,
  email varchar(255) NOT NULL,
  password varchar(255) NOT NULL,
  role varchar(10) NOT NULL DEFAULT 'user',
  PRIMARY KEY(id)
);

-- Data Dummy copy di SQL localhost --

INSERT INTO `users` (username, email, password, role) VALUES
('Marcha Juliadrianti', 'marcha@example.com', '$2y$10$PQZB69PKs5oUgYe5AOmay.9JESJDyz60aee2SVvQRof87pjCgJtS.', 'admin');

-- sandinya itu qwerty ---